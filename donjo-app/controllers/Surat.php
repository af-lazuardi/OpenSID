<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Surat extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('header_model');
		$this->load->model('penduduk_model');
		$this->load->model('keluarga_model');
		$this->load->model('surat_model');
		$this->load->model('keluar_model');
		$this->load->model('config_model');
		$this->load->model('referensi_model');
		$this->load->model('penomoran_surat_model');
		$this->load->model('biodata_model');
		$this->load->model('permohonan_surat_model');
		$this->modul_ini = 4;
		$this->sub_modul_ini = 31;
	}

	public function index()
	{
		$header = $this->header_model->get_data();
		$data['menu_surat'] = $this->surat_model->list_surat();
		$data['menu_surat2'] = $this->surat_model->list_surat2();
		$data['surat_favorit'] = $this->surat_model->list_surat_fav();

		// Reset untuk surat yang menggunakan session variable
		unset($_SESSION['id_pria']);
		unset($_SESSION['id_wanita']);
		unset($_SESSION['id_ibu']);
		unset($_SESSION['id_bayi']);
		unset($_SESSION['id_saksi1']);
		unset($_SESSION['id_saksi2']);
		unset($_SESSION['id_pelapor']);
		unset($_SESSION['id_diberi_izin']);
		unset($_SESSION['post']);
		unset($_SESSION['id_pemberi_kuasa']);
		unset($_SESSION['id_penerima_kuasa']);

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('surat/format_surat', $data);
		$this->load->view('footer');
	}

	public function panduan()
	{
		$this->sub_modul_ini = 33;
		$header = $this->header_model->get_data();

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('surat/panduan');
		$this->load->view('footer');
	}

	public function cari_nik($nik) {
		$get_penduduk = get_penduduk($nik);

		j($get_penduduk);
		exit;
	}

	public function form($url = '', $clear = '')
	{
		$desa = $this->get_data_desa();
		$kodeProp = intval($desa['kode_propinsi']);
		$kodeKab = intval($desa['kode_kabupaten']);
		$kodeKec = intval($desa['kode_kecamatan']);
		$kodeKel = intval($desa['kode_desa']);

		$data['url'] = $url;
		$data['anchor'] = $this->input->post('anchor');
		$data['individu'] = NULL;
		$data['anggota'] = NULL;
		$data['kepala_kk'] = NULL;

		if (!empty($_POST['nik']))
		{
			$get_data_individu = $this->surat_model->get_penduduk($_POST['nik']);

			if (empty($get_data_individu)) {
				$data['individu'] = [
					'status_data'=> '',
					'nama'=> ' - tidak ditemukan - ',
					'tempatlahir'=> ' - tidak ditemukan - ',
					'tanggallahir'=> ' - tidak ditemukan - ',
					'umur'=> ' - tidak ditemukan - ',
					'alamat_wilayah'=> ' - tidak ditemukan - ',
					'pendidikan'=> ' - tidak ditemukan - ',
					'warganegara'=> ' - tidak ditemukan - ',
					'agama'=> ' - tidak ditemukan - ',
					'id'=> ' - tidak ditemukan - ',
					'no_kk'=> ' - tidak ditemukan - ',
					'eksis'=> $_POST['nik'],
				];
			} else {
				$data['individu'] = $get_data_individu;
				$data['individu']['eksis'] = $_POST['nik'];
			}

		}

		if (!empty($_POST['nik_kk']))
		{
			$get_data_kepala_kk = $this->surat_model->get_penduduk($_POST['nik_kk']);

			if (empty($get_data_kepala_kk)) {
				$data['kepala_kk'] = [
					'status_data'=> '',
					'nama'=> ' - tidak ditemukan - ',
					'tempatlahir'=> ' - tidak ditemukan - ',
					'tanggallahir'=> ' - tidak ditemukan - ',
					'umur'=> ' - tidak ditemukan - ',
					'alamat_wilayah'=> ' - tidak ditemukan - ',
					'pendidikan'=> ' - tidak ditemukan - ',
					'warganegara'=> ' - tidak ditemukan - ',
					'agama'=> ' - tidak ditemukan - ',
					'id'=> ' - tidak ditemukan - ',
					'no_kk'=> ' - tidak ditemukan - ',
					'eksis'=> $_POST['nik_kk'],
				];
			} else {
				if ($get_data_kepala_kk['no_kk'] != $data['individu']['no_kk']) {
					$data['kepala_kk'] = [
						'status_data'=> '',
						'nama'=> ' - No KK tidak sama - ',
						'tempatlahir'=> ' - No KK tidak sama - ',
						'tanggallahir'=> ' - No KK tidak sama - ',
						'umur'=> ' - No KK tidak sama - ',
						'alamat_wilayah'=> ' - No KK tidak sama - ',
						'pendidikan'=> ' - No KK tidak sama - ',
						'warganegara'=> ' - No KK tidak sama - ',
						'agama'=> ' - No KK tidak sama - ',
						'id'=> ' - No KK tidak sama - ',
						'no_kk'=> ' - No KK tidak sama - ',
						'eksis'=> $_POST['nik_kk'],
					];
				} else {
					$data['kepala_kk'] = $get_data_kepala_kk;
					$data['kepala_kk']['eksis'] = $_POST['nik_kk'];
				}
			}

			// $data['kepala_kk'] = $this->surat_model->get_penduduk($_POST['nik_kk']);
		} 

		
		$this->get_data_untuk_form($url, $data);

		$data['surat_url'] = rtrim($_SERVER['REQUEST_URI'], "/clear");
		$data['form_action'] = site_url("surat/doc_kp/$url");
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 0;

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view("surat/form_surat", $data);
		$this->load->view('footer');
		// echo $this->db->last_query();

	}

	public function periksa_doc($id, $url)
	{
		// Ganti status menjadi 'Menunggu Tandatangan'
		$this->permohonan_surat_model->update_status($id, array('status' => 2));
		$this->cetak_doc($url);
	}

	public function doc($url = '')
	{
		$this->cetak_doc($url);
	}

	public function doc_kp($url = '')
	{
		$this->cetak_doc_kp($url);
		
	}

	private function cetak_doc($url)
	{
		$format = $this->surat_model->get_surat($url);
		$log_surat['url_surat'] = $format['id'];
		$log_surat['id_pamong'] = $_POST['pamong_id'];
		$log_surat['id_user'] = $_SESSION['user'];
		$log_surat['no_surat'] = $_POST['nomor'];
		$id = $_POST['nik'];
		$keperluan = $_POST['keperluan'];
		$keterangan = $_POST['keterangan'];
		switch ($url)
		{
			case 'surat_ket_kelahiran':
				// surat_ket_kelahiran id-nya ibu atau bayi
				if (!$id) $id = $_SESSION['id_ibu'];
				if (!$id) $id = $_SESSION['id_bayi'];
				break;
			case 'surat_ket_nikah':
				// id-nya calon pasangan pria atau wanita
				if (!$id) $id = $_POST['id_pria'];
				if (!$id) $id = $_POST['id_wanita'];
				break;
			case 'surat_kuasa':
				// id-nya pemberi kuasa atau penerima kuasa
				if (!$id) $id = $_POST['id_pemberi_kuasa'];
				if (!$id) $id = $_POST['id_penerima_kuasa'];
				break;
			default:
				# code...
				break;
		}

		if ($id)
		{
			$log_surat['id_pend'] = $id;

			//edit candta
			$nik=$this->surat_model->get_penduduk($_POST['nik']);
			//$nik=$this->biodata_model->get_biodata_local($_POST['nik']);
			$nik = $this->db->select('nik')->where('nik', $id)->get('tweb_penduduk')
					->row()->nik;



		}
		else
		{
			// Surat untuk non-warga
			$log_surat['nama_non_warga'] = $_POST['nama_non_warga'];
			$log_surat['nik_non_warga'] = $_POST['nik_non_warga'];
			$nik = $log_surat['nik_non_warga'];
		}

		$log_surat['keterangan'] = $keterangan ? $keterangan : $keperluan;
		$nama_surat = $this->keluar_model->nama_surat_arsip($url, $nik, $_POST['nomor']);
		$lampiran = '';
		$this->surat_model->buat_surat($url, $nama_surat, $lampiran);
		$log_surat['nama_surat'] = $nama_surat;
		$log_surat['lampiran'] = $lampiran;
		$this->keluar_model->log_surat($log_surat);

		if ($lampiran)
		{
			$nama_file = str_replace('rtf', 'zip', $nama_surat);
			$berkas_zip = array();
			$berkas_zip[] = LOKASI_ARSIP.$nama_surat;
			$berkas_zip[] = LOKASI_ARSIP.$lampiran;
			# Masukkan semua berkas ke dalam zip
			$berkas_zip = masukkan_zip($berkas_zip);
	    # Unduh berkas zip
	    header('Content-disposition: attachment; filename='.$nama_file.'.zip');
	    header('Content-type: application/zip');
			header($this->security->get_csrf_token_name().':'.$this->security->get_csrf_hash());
	    readfile($berkas_zip);
		}
		else
		{
			header($this->security->get_csrf_token_name().':'.$this->security->get_csrf_hash());
			header("location:".base_url(LOKASI_ARSIP.$nama_surat));
		}
	}

	private function cetak_doc_kp($url)
	{
		$format = $this->surat_model->get_surat($url);
		$log_surat['url_surat'] = $format['id'];
		$log_surat['id_pamong'] = $_POST['pamong_id'];
		$log_surat['id_user'] = $_SESSION['user'];
		$log_surat['no_surat'] = $_POST['nomor'];
		$id = $_POST['nik'];
		$keperluan = $_POST['keperluan'];
		$keterangan = $_POST['keterangan'];

		if ($id)
		{
			$get_id_penduduk = $this->db->select('id')->where('nik', $id)->get('tweb_penduduk')
					->row()->id;
			$log_surat['id_pend'] = $get_id_penduduk;
			$nik = $id;
		}


		$log_surat['keterangan'] = $keterangan ? $keterangan : $keperluan;
		$nama_surat = $this->keluar_model->nama_surat_arsip($url, $nik, $_POST['nomor']);
		$lampiran = '';
		$buat_surat = $this->surat_model->buat_surat($url, $nama_surat, $lampiran);
		$log_surat['nama_surat'] = $nama_surat;
		$log_surat['lampiran'] = $lampiran;
		$log_surat['detil'] = json_encode($this->input->post());
		$q_log_surat = $this->keluar_model->log_surat($log_surat);


		$data = $buat_surat;
		$data['url'] = $url;
		$data['data'] = $buat_surat['individu'];
		$data['desa'] = $buat_surat['config'];
		$data['tanggal_sekarang'] = tgl_indo2(date('Y-m-d'));

		$no_kk = $buat_surat['individu']['no_kk'];
		$this->db->where('no_kk', $no_kk);
		$this->db->select('nik_kepala');
		$get_kepala_kk = $this->db->get('tweb_keluarga')->row()->nik_kepala;
		$data['kepalakk'] = $this->surat_model->get_detil_penduduk($get_kepala_kk);

		// j($buat_surat);
		// exit;

		$this->load->view("surat/print_surat", $data);
	}

	public function nomor_surat_duplikat()
	{
		$hasil = $this->penomoran_surat_model->nomor_surat_duplikat('log_surat', $_POST['nomor'], $_POST['url']);
   	echo $hasil ? 'false' : 'true';
	}

	public function search()
	{
		$cari = $this->input->post('nik');
		if ($cari != '')
			redirect("surat/form/$cari");
		else
			redirect('surat');
	}

	private function get_data_untuk_form($url, &$data)
	{
		$this->load->model('pamong_model');
		$data['surat_terakhir'] = $this->surat_model->get_last_nosurat_log($url);
		$data['surat'] = $this->surat_model->get_surat($url);
		$data['input'] = $this->input->post();
		$data['input']['nomor'] = $data['surat_terakhir']['no_surat_berikutnya'];
		$data['format_nomor_surat'] = $this->penomoran_surat_model->format_penomoran_surat($data);
		$data['lokasi'] = $this->config_model->get_data();
		$data['penduduk'] = $this->surat_model->list_penduduk();
		$data['pamong'] = $this->surat_model->list_pamong();
		$pamong_ttd = $this->pamong_model->get_ttd();
		$pamong_ub = $this->pamong_model->get_ub();
		$data['perempuan'] = $this->surat_model->list_penduduk_perempuan();
		if ($pamong_ttd)
		{
			$str_ttd = ucwords($pamong_ttd['jabatan'].' '.$data['lokasi']['nama_desa']);
			$data['atas_nama'][] = "a.n {$str_ttd}";
			if ($pamong_ub)
				$data['atas_nama'][] = "u.b {$pamong_ub['jabatan']}";
		}
		$data_form = $this->surat_model->get_data_form($url);
		if (is_file($data_form))
			include($data_form);
	}

	public function favorit($id = 0, $k = 0)
	{
		$this->load->model('surat_master_model');
		$this->surat_master_model->favorit($id, $k);
		redirect("surat");
	}

	public function get_data_desa()
	{
		$sql = "SELECT * FROM config WHERE 1";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function save_surat($url = '')
	{

		$log_surat['url_surat'] = $url;
		$log_surat['id_pamong'] = $_POST['pamong_id'];
		$log_surat['pamong_nama'] = $_POST['pamong'];
		$log_surat['id_user'] = $_SESSION['user'];
		$log_surat['no_surat'] = $_POST['nomor'];
		$log_surat['detail'] = json_encode($this->input->post());

		$id = $_POST['nik'];

		$nik = $_POST['pengikut'];
		$no_kk = $this->biodata_model->get_kk($nik);
		$data['jumlah'] = $this->biodata_model->countRow($no_kk);
		$data['penduduk'] = $this->biodata_model->get_individu($nik)->result_array();
		// echo $data['kk'];
		// echo $this->db->last_query();

		$log_surat['id_pend'] = $id;
		$data['input'] = $_POST;
		$data['tanggal_sekarang'] = tgl_indo(date("Y m d"));

		$data['data'] = $this->surat_model->get_data_surat($id);

		$data['pribadi'] = $this->surat_model->get_data_pribadi($id);
		$data['kk'] = $this->surat_model->get_data_kk($id);
		$data['ayah'] = $this->surat_model->get_data_ayah($id);
		$data['ibu'] = $this->surat_model->get_data_ibu($id);

		$data['desa'] = $this->surat_model->get_data_desa();
		$data['pamong'] = $this->surat_model->get_pamong($_POST['pamong']);

		$data['pengikut'] = $this->surat_model->pengikut();

		// $data['anggota'] = $this->biodata_model->get_kartu_keluarga($_POST['nik'], $_POST['tujuan'], $_POST['nik_b'], $_POST['hubkeluarga']);
		$this->keluar_model->log_surat($log_surat);

		// echo var_dump($data['anggota']);
		// exit;

		$data['url'] = $url;

		$data_stat = array(
			"desa_id"=>$this->db->database,
			"id_surat"=>$url,
			"tgl"=>date('Y-m-d'),
			"jml"=>1
		);
		cpost('statistik_layanan_surat', $data_stat);


		$this->load->view("surat/print_surat", $data);
	}

	public function download()
    {
    	force_download('desa/file/petunjuk.pdf',NULL);

        // $nama='petunjuk.pdf';
        // $file = 'desa/file'.$nama;
        // force_download($file, NULL);

        //  $nama_file=$this->input->post("file");
        // force_download('file/$nama_file',NULL);
    }

	/*
		Ajax POST data:
		url -- url surat
		nomor -- nomor surat
	*/
	public function format_nomor_surat()
	{
		$data['surat'] = $this->surat_model->get_surat($this->input->post('url'));
		$data['input']['nomor'] = $this->input->post('nomor');
		$format_nomor = $this->penomoran_surat_model->format_penomoran_surat($data);
		echo json_encode($format_nomor);
	}

	/*
		Ajax url query data:
		q -- kata pencarian
		page -- nomor paginasi
	*/
	public function list_penduduk_ajax()
	{
		$cari = $this->input->get('q');
		$page = $this->input->get('page');
		$filter_sex = $this->input->get('filter_sex');
		$filter['sex'] = ($filter_sex == 'perempuan') ? 2 : $filter_sex;
		$penduduk = $this->surat_model->list_penduduk_ajax($cari, $filter, $page);
		echo json_encode($penduduk);
	}

	// list untuk dropdown arsip layanan tampil hanya yg bersurat saja
	public function list_penduduk_bersurat_ajax()
	{
		$cari = $this->input->get('q');
		$page = $this->input->get('page');
		$penduduk = $this->surat_model->list_penduduk_bersurat_ajax($cari,$page);
		echo json_encode($penduduk);
	}

}