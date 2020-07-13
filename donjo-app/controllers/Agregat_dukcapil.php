<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Agregat_dukcapil extends CI_Controller {

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

	public function index($kateg=0)
	{
		
		$kategori = $kateg;
		$tahun =  $_POST['tahun'];
		$semester =  $_POST['semester'];
		$data =null;
		if($tahun !=null && $semester !=null) {
			$data = $this->agregat_dukcapil_model->get_agregat($kategori, $tahun, $semester);
		}
	    $exportDate = ["tahun"=> $tahun, "semester"=>$semester];
		$agregat=["jenis" => $kategori, "content"=> json_decode($data), "export_date"=>$exportDate];
		$nav['act'] = 3;
		$nav['act_sub'] = 27;
		$header = $this->header_model->get_data();
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view("agregat/penduduk", $agregat);
		$this->load->view('footer');
		
		
	}

	public function cetak($kategori=0, $tahun=0, $semester=0)
	{
		$data =null;
		if($tahun !=null && $semester !=null) {
			$data = $this->agregat_dukcapil_model->get_agregat($kategori, $tahun, $semester);
		}
		
		$exportDate = ["tahun"=> $tahun, "semester"=>$semester];
		$agregat=["config"=>$this->laporan_penduduk_model->get_config(),"jenis" => $kategori, "content"=> json_decode($data), "export_date"=>$exportDate];
		$this->load->view('agregat/penduduk_print', $agregat);
	}

}
