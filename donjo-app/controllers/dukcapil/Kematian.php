<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kematian extends CI_Controller {

    public function __construct()
	{
        parent::__construct();
        session_start();
		$this->load->model('user_model');
		$this->load->model('laporan_penduduk_model');
		$this->load->model('program_bantuan_model');
		$this->load->model('agregat_dukcapil_model');
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
		$_SESSION['per_page'] = 500;
		$this->modul_ini = 3;
    }

    public function index() {
        $nav['act'] = 4;
		$nav['act_sub'] = 33;
		$header = $this->header_model->get_data();

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('dukcapil/kematian');
		$this->load->view('footer');
    }

}