<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class First extends Web_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->helper(array('form', 'url','download'));
		$ip = $this->getRealIpAddr();
		$data_stat = array(
			"desa_id"=>$this->db->database,
			"ip_addres"=>$ip,
			"tgl"=>date('Y-m-d'),
			"hits"=>1
		);
		cpost('statistik', $data_stat);

		// Jika offline_mode dalam level yang menyembunyikan website,
		// tidak perlu menampilkan halaman website
		if ($this->setting->offline_mode >= 2)
		{
			redirect('siteman');
			exit;
		} elseif ($this->setting->offline_mode == 1)
		{
			// Jangan tampilkan website jika bukan admin/operator/redaksi
			$this->load->model('user_model');
			$grup	= $this->user_model->sesi_grup($_SESSION['sesi']);
			if ($grup != 1 AND $grup != 2 AND $grup != 3)
			{
				if (empty($grup))
					$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];
				else
					unset($_SESSION['request_uri']);
				redirect('siteman');
			}
		}

		mandiri_timeout();
		$this->load->model('header_model');
		$this->load->model('config_model');
		$this->load->model('first_m');
		$this->load->model('first_artikel_m');
		$this->load->model('first_gallery_m');
		$this->load->model('first_menu_m');
		$this->load->model('first_penduduk_m');
		$this->load->model('penduduk_model');
		$this->load->model('surat_model');
		$this->load->model('keluarga_model');
		$this->load->model('web_widget_model');
		$this->load->model('web_gallery_model');
		$this->load->model('laporan_penduduk_model');
		$this->load->model('track_model');
		$this->load->model('keluar_model');
		$this->load->model('agregat_dukcapil_model');
		// added by akhwan to add "Pamong menu in front "
		$this->load->model('pamong_model');
		$this->load->model('m_download');
	}

	public function auth()
	{
		if ($_SESSION['mandiri_wait'] != 1)
		{
			$this->first_m->siteman();
		}
		if ($_SESSION['mandiri'] == 1)
			redirect('first/mandiri/1/1');
		else
			redirect('first');
	}

	public function logout()
	{
		$this->first_m->logout();
		redirect('first');
	}

	public function ganti()
	{
		$this->first_m->ganti();
		redirect('first');
	}

	public function index($p=1)
	{
		$data = $this->includes;

		$data['p'] = $p;
		$data['paging'] = $this->first_artikel_m->paging($p);
		$data['paging_page'] = 'index';
		$data['paging_range'] = 3;
		$data['start_paging'] = max($data['paging']->start_link, $p - $data['paging_range']);
		$data['end_paging'] = min($data['paging']->end_link, $p + $data['paging_range']);
		$data['pages'] = range($data['start_paging'], $data['end_paging']);

		$data['artikel'] = $this->first_artikel_m->artikel_show(0,$data['paging']->offset,$data['paging']->per_page);
		$data['headline'] = $this->first_artikel_m->get_headline();

		$cari = trim($this->input->get('cari'));
		if ( ! empty($cari))
		{
			// Judul artikel bisa digunakan untuk serangan XSS
			$data["judul_kategori"] = $this->security->xss_clean("Hasil pencarian: $cari");
		}

		$this->_get_common_data($data);
		$this->track_model->track_desa('first');

		$this->load->view($this->template, $data);
	}
	
	public function cetak_biodata($id='')
	{
		if ($_SESSION['mandiri'] != 1)
		{
			redirect('first');
			return;
		}
		// Hanya boleh mencetak data pengguna yang login
		$id = $_SESSION['id'];

		$header = $this->header_model->get_data();
		$data['desa'] = $header['desa'];
		$data['penduduk'] = $this->penduduk_model->get_penduduk($id);
		$this->load->view('sid/kependudukan/cetak_biodata',$data);
	}

	public function cetak_kk($id='')
	{
		if ($_SESSION['mandiri'] != 1)
		{
			redirect('first');
			return;
		}
		// Hanya boleh mencetak data pengguna yang login
		$id = $_SESSION['id'];

		// $id adalah id penduduk. Cari id_kk dulu
		$id_kk = $this->penduduk_model->get_id_kk($id);
		$data = $this->keluarga_model->get_data_cetak_kk($id_kk);

		$header = $this->header_model->get_data();
		$this->load->view("sid/kependudukan/cetak_kk_all", $data);
	}

	public function kartu_peserta($id=0)
	{
		if ($_SESSION['mandiri'] != 1)
		{
			redirect('first');
			return;
		}
		$this->load->model('program_bantuan_model');
		$data = $this->program_bantuan_model->get_program_peserta_by_id($id);
		// Hanya boleh menampilkan data pengguna yang login
		// ** Bagi program sasaran pendududk **
		if ($data['peserta'] == $_SESSION['nik'])
			$this->load->view('program_bantuan/kartu_peserta',$data);
	}

	public function mandiri($p=1, $m=0)
	{
		if ($_SESSION['mandiri'] != 1)
		{
			redirect('first');
		}

		$data = $this->includes;
		$data['p'] = $p;
		$data['menu_surat2'] = $this->surat_model->list_surat2();
		$data['m'] = $m;

		$this->_get_common_data($data);

		/* nilai $m
			1 untuk menu profilku
			2 untuk menu layanan
			3 untuk menu lapor
			4 untuk menu bantuan
		*/
		switch ($m)
		{
			case 1:
				$data['penduduk'] = $this->penduduk_model->get_penduduk($_SESSION['id']);
				$data['list_kelompok'] = $this->penduduk_model->list_kelompok($_SESSION['id']);
				$data['list_dokumen'] = $this->penduduk_model->list_dokumen($_SESSION['id']);
				break;
			case 2:
				$data['surat_keluar'] = $this->keluar_model->list_data_perorangan($_SESSION['id']);
				break;
			case 4:
				$this->load->model('program_bantuan_model','pb');
				$data['daftar_bantuan'] = $this->pb->daftar_bantuan_yang_diterima($_SESSION['nik']);
				break;
			default:
				break;
		}

		$this->set_template('layouts/mandiri.php');
		$this->load->view($this->template, $data);
	}

	public function artikel($id=0, $p=1)
	{
		$data = $this->includes;

		$data['p'] = $p;
		$data['paging']  = $this->first_artikel_m->paging($p);
		$data['artikel'] = $this->first_artikel_m->list_artikel(0,$data['paging']->offset, $data['paging']->per_page);
		$data['single_artikel'] = $this->first_artikel_m->get_artikel($id);
		$data['komentar'] = $this->first_artikel_m->list_komentar($id);
		$this->_get_common_data($data);

		// Validasi pengisian komentar di add_comment()
		// Kalau tidak ada error atau artikel pertama kali ditampilkan, kosongkan data sebelumnya
		if (!isset($_SESSION['validation_error']) OR !$_SESSION['validation_error']) {
			$_SESSION['post']['owner'] = '';
			$_SESSION['post']['email'] = '';
			$_SESSION['post']['komentar'] = '';
			$_SESSION['post']['captcha_code'] = '';
		}
		$this->set_template('layouts/artikel.tpl.php');
		$this->load->view($this->template,$data);
	}

	public function arsip($p=1)
	{
		$data = $this->includes;
		$data['p'] = $p;
		$data['paging']  = $this->first_artikel_m->paging_arsip($p);
		$data['farsip'] = $this->first_artikel_m->full_arsip($data['paging']->offset,$data['paging']->per_page);

		$this->_get_common_data($data);

		$this->set_template('layouts/arsip.tpl.php');
		$this->load->view($this->template,$data);
	}

	// Halaman arsip album galeri
	public function gallery($p=1)
	{
		$data = $this->includes;
		$data['p'] = $p;
		$data['paging'] = $this->first_gallery_m->paging($p);
		$data['paging_range'] = 3;
		$data['start_paging'] = max($data['paging']->start_link, $p - $data['paging_range']);
		$data['end_paging'] = min($data['paging']->end_link, $p + $data['paging_range']);
		$data['pages'] = range($data['start_paging'], $data['end_paging']);
		$data['gallery'] = $this->first_gallery_m->gallery_show($data['paging']->offset, $data['paging']->per_page);

		$this->_get_common_data($data);

		$this->set_template('layouts/gallery.tpl.php');
		$this->load->view($this->template, $data);
	}

	// halaman rincian tiap album galeri
	public function sub_gallery($gal=0, $p=1)
	{
		$data = $this->includes;
		$data['p'] = $p;
		$data['gal'] = $gal;
		$data['paging'] = $this->first_gallery_m->paging2($gal, $p);
		$data['paging_range'] = 3;
		$data['start_paging'] = max($data['paging']->start_link, $p - $data['paging_range']);
		$data['end_paging'] = min($data['paging']->end_link, $p + $data['paging_range']);
		$data['pages'] = range($data['start_paging'], $data['end_paging']);

		$data['gallery'] = $this->first_gallery_m->sub_gallery_show($gal,$data['paging']->offset, $data['paging']->per_page);
		$data['parrent'] = $this->first_gallery_m->get_parrent($gal);
		$data['mode'] = 1;

		$this->_get_common_data($data);

		$this->set_template('layouts/sub_gallery.tpl.php');
		$this->load->view($this->template, $data);
	}

	public function statistik($stat=0, $tipe=0)
	{

		$kategori = "";
		switch ($stat) {
			case '2':
				$kategori = "statKawin";
				break;
			case '4':
					$kategori = "jenisKelamin";
					break;
			case '0':
					$kategori = "pendidikan";
				break;
			case '13':
					$kategori = "umur";
			break;
					case '1':
					$kategori = "pekerjaan";
			break;
					case '3':
					$kategori = "agama";
			break;
				case '7':
					$kategori = "golDarah";
		break;
			case '19':
					$kategori = "statHbkel";
			break;
			case '20':
					$kategori = "kkJenisKelamin";
			break;
			case '23':
					$kategori = "kkUmur";
			break;

			case '21':
					$kategori = "kkPendidikan";
			break;

			case '22':
					$kategori = "kkPekerjaan";
			break;


		}

		$tahun =  $_POST['tahun'];
		$semester =  $_POST['semester'];
		$dataAgregat =null;
		if($tahun !=null && $semester !=null) {
			$dataAgregat = $this->agregat_dukcapil_model->get_agregat($kategori, $tahun, $semester);
		}
		$exportDate = ["tahun"=> $tahun, "semester"=>$semester];


		$someArray = json_decode($dataAgregat, true);
		$hasilData = [];
		foreach($someArray as $key=>&$val) {
			$hasilData[] =[
				"no" => $key+1,
				"nama" => $val["kategori"],
				"jumlah" => $val['jumlah'],
				"laki" => $val["lakiLaki"],
				 "perempuan" => $val["perempuan"],
				 "persen1" => number_format((($val["lakiLaki"] / $val["jumlah"])* 100),2),
				 "persen2" => number_format((($val["perempuan"] / $val["jumlah"])* 100),2)
		];

		}

		$data = $this->includes;

		$data['export_date'] = $exportDate;
		$data['heading'] = $this->laporan_penduduk_model->judul_statistik($stat);
		$data['jenis_laporan'] = $this->laporan_penduduk_model->jenis_laporan($stat);
	//	$data['stat'] = $this->laporan_penduduk_model->list_data($stat);
		$data['stat'] =  $hasilData;
		$data['tipe'] = $tipe;
		$data['st'] = $stat;


	//	var_dump(json_encode($data['export_date']));
	//	exit;

		//var_dump(json_encode($data['stat']));
		//exit;

		$this->_get_common_data($data);

		$this->set_template('layouts/stat.tpl.php');
		$this->load->view($this->template, $data);
	}
	
	public function data_analisis($stat="", $sb=0, $per=0)
	{
		$data = $this->includes;

		if ($stat == "")
		{
			$data['list_indikator'] = $this->first_penduduk_m->list_indikator();
			$data['list_jawab'] = null;
			$data['indikator'] = null;
		}
		else
		{
			$data['list_indikator'] = "";
			$data['list_jawab'] = $this->first_penduduk_m->list_jawab($stat, $sb, $per);
			$data['indikator'] = $this->first_penduduk_m->get_indikator($stat);
		}

		$this->_get_common_data($data);

		$this->set_template('layouts/analisis.tpl.php');
		$this->load->view($this->template, $data);
	}

	public function dpt()
	{
		$this->load->model('dpt_model');
		$data = $this->includes;
		$data['main'] = $this->dpt_model->statistik_wilayah();
		$data['total'] = $this->dpt_model->statistik_total();
		$data['tanggal_pemilihan'] = $this->dpt_model->tanggal_pemilihan();
		$this->_get_common_data($data);
		$data['tipe'] = 4;
		$this->set_template('layouts/stat.tpl.php');
		$this->load->view($this->template, $data);
	}

	public function wilayah()
	{
		$this->load->model('wilayah_model');
		$data = $this->includes;

		$data['main']    = $this->first_penduduk_m->wilayah();
		$data['heading']="Populasi Per Wilayah";
		$data['tipe'] = 3;
		$data['total'] = $this->wilayah_model->total();
		$data['st'] = 1;
		$this->_get_common_data($data);

		$this->set_template('layouts/stat.tpl.php');
		$this->load->view($this->template, $data);
	}

	public function agenda($stat=0)
	{
		$data = $this->includes;
		$data['artikel'] = $this->first_artikel_m->agenda_show();
		$this->_get_common_data($data);
		$this->load->view($this->template,$data);
	}

	public function kategori($kat=0, $p=1)
	{
		$data = $this->includes;

		$data['p'] = $p;
		$data["judul_kategori"] = $this->first_artikel_m->get_kategori($kat);
		$data['paging']  = $this->first_artikel_m->paging_kat($p, $kat);
		$data['paging_page']  = 'kategori/'.$kat;
		$data['paging_range'] = 3;
		$data['start_paging'] = max($data['paging']->start_link, $p - $data['paging_range']);
		$data['end_paging'] = min($data['paging']->end_link, $p + $data['paging_range']);
		$data['pages'] = range($data['start_paging'], $data['end_paging']);

		$data['artikel'] = $this->first_artikel_m->list_artikel($data['paging']->offset, $data['paging']->per_page, $kat);

		$this->_get_common_data($data);
		$this->load->view($this->template, $data);
	}

	public function add_comment($id=0)
	{
		// id = 775 dipakai untuk laporan mandiri, bukan komentar artikel
		if ($id != 775)
		{
			// Periksa isian captcha
			include FCPATH . 'securimage/securimage.php';
			$securimage = new Securimage();
			$_SESSION['validation_error'] = false;
			if ($securimage->check($_POST['captcha_code']) == false)
			{
				$this->session->set_flashdata('flash_message', 'Kode anda salah. Silakan ulangi lagi.');
				$_SESSION['post'] = $_POST;
				$_SESSION['validation_error'] = true;
				redirect("first/artikel/$id");
			}
		}

		$res = $this->first_artikel_m->insert_comment($id);
		$data['data_config'] = $this->config_model->get_data();
		// cek kalau berhasil disimpan dalam database
		if ($res)
		{
			$this->session->set_flashdata('flash_message', 'Komentar anda telah berhasil dikirim dan perlu dimoderasi untuk ditampilkan.');
		}
		else
		{
			$this->session->set_flashdata('flash_message', 'Komentar anda gagal dikirim. Silakan ulangi lagi.');
		}

		if ($id != 775)
		{
			redirect("first/artikel/$id");
		}
		else
		{
			$_SESSION['sukses'] = 1;
			redirect("first/mandiri/1/3");
		}
	}

	private function _get_common_data(&$data)
	{
		$data['desa'] = $this->first_m->get_data();
		$data['menu_atas'] = $this->first_menu_m->list_menu_atas();
		$data['menu_kiri'] = $this->first_menu_m->list_menu_kiri();
		$data['teks_berjalan'] = $this->first_artikel_m->get_teks_berjalan();
		$data['slide_artikel'] = $this->first_artikel_m->slide_show();
		$data['slider_gambar'] = $this->first_artikel_m->slider_gambar();
		$data['w_cos']  = $this->web_widget_model->get_widget_aktif();
		$this->web_widget_model->get_widget_data($data);
		$data['data_config'] = $this->config_model->get_data();
		$data['flash_message'] = $this->session->flashdata('flash_message');

		// Pembersihan tidak dilakukan global, karena artikel yang dibuat oleh
		// petugas terpecaya diperbolehkan menampilkan <iframe> dsbnya..
		$list_kolom = array(
			'arsip',
			'w_cos'
		);
		foreach ($list_kolom as $kolom)
		{
			$data[$kolom] = $this->security->xss_clean($data[$kolom]);
		}

	}
	
	public function produkhukum()
	{
		$data = $this->includes;
		$this->_get_common_data($data);

		$data['prokum'] = $this->db->query("SELECT *
										FROM dokumen
										WHERE kategori = 4")->result_array();
		$data['p'] = "produk_hukum";

		$this->set_template('layouts/perangkat_desa.tpl.php');
		$this->load->view($this->template,$data);
	}
	public function tampil_dokumen($id){
		$data = $this->includes;
		$this->_get_common_data($data);

		$data['prokum'] = $this->db->query("SELECT id,satuan
										FROM dokumen
										WHERE kategori = 4 
										AND id = ".$id )->result_array();
		$data['p'] = "dokumen";

		$this->set_template('layouts/perangkat_desa.tpl.php');
		$this->load->view($this->template,$data);
	}
	public function download($id) 
    {    
        $fileinfo = $this->m_download->download($id);
        $file = 'desa/upload/dokumen/'.$fileinfo['satuan'];
        force_download($file, NULL);

        //  $nama_file=$this->input->post("file");
        // force_download('file/$nama_file',NULL);
    }
	/*
	added by akhwan
	untuk menambahkan menu perangkat desa di frontend
	*/
	public function perangkatdesa()
	{
		$data = $this->includes;
		$this->_get_common_data($data);

		$data['data_pamong'] = $this->pamong_model->list_data();
		$data['p'] = "perangkat_desa";

		$this->set_template('layouts/perangkat_desa.tpl.php');
		$this->load->view($this->template,$data);
	}
	public function profildesa()
	{
		$data = $this->includes;
		$this->_get_common_data($data);

		$data['main'] = $this->config_model->get_data();

		$data['p'] = "profil_desa";

		$this->set_template('layouts/perangkat_desa.tpl.php');
		$this->load->view($this->template,$data);
	}
	public function wilayahdesa()
	{
		$data = $this->includes;
		$this->_get_common_data($data);

		$data['main'] = $this->db->query("SELECT a.dusun,
										b.nama
										FROM tweb_wil_clusterdesa a
										INNER JOIN tweb_biodata_penduduk b ON a.id_kepala = b.nik
										GROUP BY a.dusun")->result_array();

		$data['p'] = "wilayah_desa";

		$this->set_template('layouts/perangkat_desa.tpl.php');
		$this->load->view($this->template,$data);
	}

	function getRealIpAddr()
	{
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}

}
