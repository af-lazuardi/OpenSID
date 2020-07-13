<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hom_sid extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('user_model');
		$grup	= $this->user_model->sesi_grup($_SESSION['sesi']);
		if ($grup != 1 AND $grup != 2)
		{
			if (empty($grup))
				$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];
			else
				unset($_SESSION['request_uri']);
			redirect('siteman');
		}
		$this->load->model('header_model');
		$this->load->model('config_model');
		$this->load->model('surat_masuk_suratku_model');
		$this->modul_ini = 1;
	}

	public function index()
	{
		// Pengambilan data penduduk untuk ditampilkan widget Halaman Dashboard (modul Home SID)
		$data['penduduk'] = $this->header_model->penduduk_total();
		$data['keluarga'] = $this->header_model->keluarga_total();
		$data['miskin'] = $this->header_model->miskin_total();
		$data['kelompok'] = $this->header_model->kelompok_total();
		$data['rtm'] = $this->header_model->rtm_total();
		$data['dusun'] = $this->header_model->dusun_total();
		// Menampilkan menu dan sub menu aktif
		$nav['act'] = 1;
		$nav['act_sub'] = 16;
		$header = $this->header_model->get_data();

		$data['main'] = $this->config_model->get_data();

		$get_infodesa = cget("infodesa");

		$config = $this->config_model->get_data();
		$kode_prov = $config['kode_propinsi'];
		$kode_kab = str_pad($config['kode_kabupaten'], 2, '0', STR_PAD_LEFT);
		$kode_kec = $config['kode_kecamatan'];
		$kode_desa = $config['kode_desa'];

		$username = '003'.$kode_prov.$kode_kab.$kode_kec.$kode_desa;
		$data['info_surat'] = $this->surat_masuk_suratku_model->get_dashboard($username);
		
		$data['infodesa'] = $get_infodesa['result']['data'];
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('home/desa', $data);
		$this->load->view('footer');
	}

	public function donasi()
	{
		// Menampilkan menu dan sub menu aktif
		$nav['act'] = 1;
		$nav['act_sub'] = 19;
		$header = $this->header_model->get_data();

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('home/donasi');
		$this->load->view('footer');
	}
}
