<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function kunjungan() {
		$kunjungan_hari_ini = $this->db->query("SELECT Jumlah AS Visitor FROM sys_traffic WHERE Tanggal=DATE(NOW()) LIMIT 1")->row()->Visitor;

		echo json_encode(['visitor'=>intval($kunjungan_hari_ini)]);
		exit;
	}

	public function config_desa() {
		$desa = $this->db->query("SELECT * FROM config LIMIT 1")->row();

		echo json_encode(['desa'=>$desa]);
		exit;
	}

}

/* End of file Api.php */
/* Location: .//D/laragon/www/kominfo/desaku/sid/donjo-app/controllers/kp/Api.php */