<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kematian extends Admin_Controller {

    public function __construct()
	{
        parent::__construct();

        $this->load->model(['user_model', 'laporan_penduduk_model', 'program_bantuan_model', 'agregat_dukcapil_model', 'header_model']);

		/*
		$grup = $this->user_model->sesi_grup($_SESSION['sesi']);
		if ($grup != 1 AND $grup != 2 AND $grup != 3)
		{
			if (empty($grup))
				$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];
			else
				unset($_SESSION['request_uri']);
			redirect('siteman');
		}*/

		$this->_set_page = ['50', '100', '200'];
		$this->_header = $this->header_model->get_data();
		$this->modul_ini = 901;
    }

    public function index() {
        $this->sub_modul_ini = 903;

		$this->load->view('header', $this->_header);
		$this->load->view('nav');
		$this->load->view('dukcapil/kematian');
		$this->load->view('footer');
    }

}