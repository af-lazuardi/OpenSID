<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
* User: didikkurniawan
* Date: 10/1/16
* Time: 06:59
*/

class AjaxValidasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		/* $this->load->model('user_model');
		$grup	= $this->user_model->sesi_grup($_SESSION['sesi']);
		if ($grup != 1 AND $grup != 2) {
			$_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];
			redirect('siteman');
        }
        */
		$this->load->model('biodata_model');
	

    }

    public function get_data_desa()
	{
		$sql = "SELECT * FROM config WHERE 1";
		$query = $this->db->query($sql);
		return $query->row_array();
	}


    public function index() {

		$desa = $this->get_data_desa();
		$kodeProp = intval($desa['kode_propinsi']);
		$kodeKab = intval($desa['kode_kabupaten']);
		$kodeKec = intval($desa['kode_kecamatan']);
        $kodeKel = intval($desa['kode_desa']);
        
        $data[] = $this->biodata_model->get_penduduk($_GET['nik']);
        header('Content-Type: application/json');
        echo json_encode($data[0]);

    }
}