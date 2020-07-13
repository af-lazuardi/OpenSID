<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper(array('url','download'));		
		$this->load->model('user_model');
		$grup = $this->user_model->sesi_grup($_SESSION['sesi']);
		if ($grup != 1 AND $grup != 2 AND $grup != 3)
		{
			if (empty($grup))
				$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];
			else
				unset($_SESSION['request_uri']);
			redirect('siteman');
		}
		$this->load->model('header_model');
		$this->load->model('penduduk_model');
		$this->load->model('keluarga_model');
		$this->load->model('surat_model');
		$this->load->model('keluar_model');
		$this->load->model('config_model');
		$this->load->model('referensi_model');
		$this->load->model('penomoran_surat_model');
		$this->load->model('biodata_model');
		$this->modul_ini = 4;
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

		$nav['act'] = 4;
		$nav['act_sub'] = 31;
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('surat/format_surat', $data);
		$this->load->view('footer');
	}

	public function panduan()
	{
		$nav['act'] = 4;
		$nav['act_sub'] = 33;
		$header = $this->header_model->get_data();

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('surat/panduan');
		$this->load->view('footer');
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
		$nik = $_POST['id'];
		$no_kk = $this->biodata_model->get_kk($nik);
		$data['jumlah'] = $this->biodata_model->countRow($no_kk);
		if (!empty($_POST['nik']))
		{
			$nik = $_POST['nik'];

			$data['individu'] = $this->biodata_model->get_penduduk($_POST['nik']);
			$data['anggota'] = $this->biodata_model->get_kartu_keluarga($_POST['nik']);


			if($data['individu']['nik'] == NULL) {
				$data['individu']['status_data'] = "Data Tidak ditemukan";
			} else {
				if(
					$data['individu']['no_prop'] == $kodeProp
					&& $data['individu']['no_kab'] == $kodeKab
					&& $data['individu']['no_kec'] == $kodeKec
					&& $data['individu']['no_kel'] == $kodeKel
				) {
					$this->biodata_model->save_biodata($data['individu']);
				        //$this->biodata_model->save_biodata($data['anggota']);	
				} else {
					if($url == 'surat_ket_domisili'){
						$this->biodata_model->save_biodata($data['individu']);
					}else{
						$data['individu']['status_data'] = "Mohon Maaf Biodata Penduduk desa ".$data['individu']['kel_name'];
					}
				}	
			}
			
			$data['individu']['alamat_wilayah']= $data['individu']['alamat'];
	
			
		}
		else
		{
			$data['individu'] = NULL;
			$data['anggota'] = NULL;
		}

		//var_dump($data['anggota']);
	//	exit;	
		$this->get_data_untuk_form($url, $data);

		$data['surat_url'] = rtrim($_SERVER['REQUEST_URI'], "/clear");
		$data['form_action'] = site_url("surat/save_surat/$url");
		// $data['form_action'] = site_url("surat/cetak/$url");
		// $data['form_action2'] = site_url("surat/doc/$url");
		$nav['act'] = 4;
		$nav['act_sub'] = 31;
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 0;
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view("surat/form_surat", $data);
		$this->load->view('footer');
		// echo $this->db->last_query();
		
	}

	public function cetak($url = '')
	{
		$log_surat['url_surat'] = $url;
		$log_surat['pamong_nama'] = $_POST['pamong'];
		$log_surat['id_user'] = $_SESSION['user'];
		$log_surat['no_surat'] = $_POST['nomor'];

		$id = $_POST['nik'];
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
		$data['anggota'] = $this->keluarga_model->list_anggota($data['kk']['id_kk']);
		$this->keluar_model->log_surat($log_surat);

		$data['url'] = $url;
		$this->load->view("surat/print_surat", $data);
	}

	public function doc($url = '')
	{
		$format = $this->surat_model->get_surat($url);
		$log_surat['url_surat'] = $format['id'];
		$log_surat['id_pamong'] = $_POST['pamong_id'];
		$log_surat['id_user'] = $_SESSION['user'];
		$log_surat['no_surat'] = $_POST['nomor'];
		$id = $_POST['nik'];
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

		$nama_surat = $this->keluar_model->nama_surat_arsip($url, $nik, $_POST['nomor']);
		$lampiran = '';
		$this->surat_model->buat_surat($url, $nama_surat, $lampiran);
		$log_surat['nama_surat'] = $nama_surat;
		$log_surat['lampiran'] = $lampiran;
		$this->keluar_model->log_surat($log_surat);
		
		header("location:".base_url(LOKASI_ARSIP.$nama_surat));
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
		$data['surat_terakhir'] = $this->surat_model->get_last_nosurat_log($url);
		$data['lokasi'] = $this->config_model->get_data();
		$data['penduduk'] = $this->surat_model->list_penduduk();
		$data['pamong'] = $this->surat_model->list_pamong();
		$data['perempuan'] = $this->surat_model->list_penduduk_perempuan();

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
}
