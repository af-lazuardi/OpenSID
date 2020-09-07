<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_dukcapil extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model(['user_model', 'laporan_penduduk_model', 'laporan_dukcapil_model', 'header_model']);

		$grup = $this->user_model->sesi_grup($_SESSION['sesi']);
		if ($grup != 1 AND $grup != 2 AND $grup != 3)
		{
			if (empty($grup))
				$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];
			else
				unset($_SESSION['request_uri']);
			redirect('siteman');
		}

		$this->_set_page = ['50', '100', '200'];
		$this->_header = $this->header_model->get_data();
		$this->modul_ini = 904;
	}

	public function index($kateg=0)
	{

	}

	public function pindah() {
		$this->sub_modul_ini = 905;
		$this->loadView("pindah");
	}

	public function datang() {
		$this->sub_modul_ini = 906;
		$this->loadView("datang");
	}

	public function lahir() {
		$this->sub_modul_ini = 907;
		$this->loadView("lahir");
	}

	public function mati() {
		$this->sub_modul_ini = 908;
		$this->loadView("mati");
	}

	private function loadView($kateg=0)
	{
		

	 	$kategori = $kateg;
		$startDate =  $_POST['startDate'];
		$endDate =  $_POST['endDate'];

		$data =null;
		if($startDate !=null && $endDate !=null) {
			$data = $this->laporan_dukcapil_model->get_laporan($kategori, $startDate, $endDate);
		}
		$exportDate = ["startDate"=> $startDate, "endDate"=>$endDate];
		$agregat=["jenis" => $kategori, "content"=> json_decode($data), "export_date"=>$exportDate];

		$this->load->view('header', $this->_header);
		$this->load->view('nav');
		$this->load->view("laporan_dukcapil/".$kategori, $agregat);
		$this->load->view('footer');
	}

	public function cetak($jenis=0, $startDate=0, $endDate=0)
	{
		$data =null;
		if($startDate !=null && $endDate !=null) {
			$data = $this->laporan_dukcapil_model->get_laporan($jenis, $startDate, $endDate);
		}
	
		$exportDate = ["startDate"=> $startDate, "endDate"=>$endDate];
		$agregat=["config"=>$this->laporan_penduduk_model->get_config(),"jenis" => $jenis, "content"=> json_decode($data), "export_date"=>$exportDate];
		
		$this->load->view('laporan_dukcapil/print_'.$jenis, $agregat);
	}

}
