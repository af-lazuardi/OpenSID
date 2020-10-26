<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Surat_masuk_suratku extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		// Untuk bisa menggunakan helper force_download()
		$this->load->helper('download');
		$this->load->model('user_model');
		$grup = $this->user_model->sesi_grup($_SESSION['sesi']);
		if ($grup != (1 or 2))
		{
			if (empty($grup))
				$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];
			else
				unset($_SESSION['request_uri']);
			redirect('siteman');
		}
		$this->load->model('surat_masuk_model');
		$this->load->model('klasifikasi_model');
		$this->load->model('config_model');
		$this->load->model('pamong_model');
		$this->load->model('header_model');
		$this->load->model('penomoran_surat_model');
		$this->load->model('surat_masuk_suratku_model');
		$this->modul_ini = 15;
		$this->tab_ini = 2;
	}

	public function index() {
		$nav['act'] = 15;
		$nav['act_sub'] = 57;
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 0;
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('surat_masuk_suratku/table', $data);
		$this->load->view('footer');
	}

	public function dashboard() {
		$config = $this->config_model->get_data();
		$kode_prov = $config['kode_propinsi'];
		$kode_kab = str_pad($config['kode_kabupaten'], 2, '0', STR_PAD_LEFT);
		$kode_kec = $config['kode_kecamatan'];
		$kode_desa = $config['kode_desa'];

		$username = '003'.$kode_prov.$kode_kab.$kode_kec.$kode_desa;
		$get_dashboard = $this->surat_masuk_suratku_model->get_dashboard($username);
		
		j($get_dashboard);
		exit;
	}

	public function index_ajax() {
		$config = $this->config_model->get_data();
		$kode_prov = $config['kode_propinsi'];
		$kode_kab = str_pad($config['kode_kabupaten'], 2, '0', STR_PAD_LEFT);
		$kode_kec = $config['kode_kecamatan'];
		$kode_desa = $config['kode_desa'];

		$username = '003'.$kode_prov.$kode_kab.$kode_kec.$kode_desa;
		$get_surat = $this->surat_masuk_suratku_model->get_list_surat_masuk($username);

		j($get_surat);
		exit;
	}

	public function detil_surat() {
		$p = $this->input->post();

		$config = $this->config_model->get_data();
		$kode_prov = $config['kode_propinsi'];
		$kode_kab = str_pad($config['kode_kabupaten'], 2, '0', STR_PAD_LEFT);
		$kode_kec = $config['kode_kecamatan'];
		$kode_desa = $config['kode_desa'];

		$params = [
			'id_surat' => $p['id_surat'],
			'penerima_id_instansi' => $p['penerima_id_instansi'],
			'penerima_id_user' => $p['penerima_id_user']
		];


		$username = '003'.$kode_prov.$kode_kab.$kode_kec.$kode_desa;
		$get_surat = $this->surat_masuk_suratku_model->get_list_surat_masuk_detil($username, $params);
		$set_status_baca = $this->surat_masuk_suratku_model->set_status_baca($username, $params);

		

		$get_nomor_surat = $this->penomoran_surat_model->get_surat_terakhir('surat_masuk');
		$get_surat['nomor_surat_preview'] = $get_nomor_surat['no_surat'] + 1;

		j($get_surat);
		exit;
		
	}

	public function simpan_surat_masuk() {
		$simpan_surat = $this->surat_masuk_suratku_model->insert();
		
		$p = $this->input->post();

		$config = $this->config_model->get_data();
		$kode_prov = $config['kode_propinsi'];
		$kode_kab = str_pad($config['kode_kabupaten'], 2, '0', STR_PAD_LEFT);
		$kode_kec = $config['kode_kecamatan'];
		$kode_desa = $config['kode_desa'];

		$params = [
			'id_surat' => $p['mdl_detil_surat_id_surat'],
			'penerima_id_instansi' => $p['mdl_detil_surat_penerima_id_instansi'],
			'penerima_id_user' => $p['mdl_detil_surat_penerima_id_user']
		];

		$username = '003'.$kode_prov.$kode_kab.$kode_kec.$kode_desa;
		$set_status_berinomor = $this->surat_masuk_suratku_model->set_status_berinomor($username, $params);

		j($simpan_surat);
		exit;
	}
}
