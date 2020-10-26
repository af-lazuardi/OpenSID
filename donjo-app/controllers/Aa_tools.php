<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aa_tools extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->api_konversi = "http://192.168.64.23/konversi/index.php/ok/";
	}

	public function cek_nik($nik) {
		$nik = get_penduduk($nik);

		j($nik);
	}

	public function index() {
		echo '<ul>
				<li><a href="'.base_url('index.php/aa_tools/kosongkan').'">Kosongkan Data</a></li>
				<li><a href="'.base_url('index.php/aa_tools/config_desa').'">Config Desa</a></li>
				<li><a href="'.base_url('index.php/aa_tools/wilayah').'">Wilayah</a></li>
				<li><a href="'.base_url('index.php/aa_tools/pamong').'">Pamong</a></li>
				<li><a href="'.base_url('index.php/aa_tools/menu').'">Menu</a></li>
				<li><a href="'.base_url('index.php/aa_tools/artikel').'">Artikel</a></li>
			</ul>';
	}

	public function kosongkan() {
		$this->db->query("TRUNCATE TABLE tweb_keluarga");
		$this->db->query("TRUNCATE TABLE tweb_wil_clusterdesa");
		$this->db->query("TRUNCATE TABLE menu");
		$this->db->query("TRUNCATE TABLE artikel");

		$this->db->query("SET FOREIGN_KEY_CHECKS = 0;");
		$this->db->query("TRUNCATE TABLE tweb_desa_pamong");

		$this->db->query("SET FOREIGN_KEY_CHECKS = 0;");
		$this->db->query("TRUNCATE TABLE tweb_penduduk");
	}

	public function config_desa() {
		$get_desa = file_get_contents($this->api_konversi."desa");
		$get_desa_array = json_decode($get_desa, true);

		unset($get_desa_array['g_analytic']);

		$this->db->where('id', 1);
		$cek_satu_sudah_ada = $this->db->get('config')->row_array();

		if (empty($cek_satu_sudah_ada)) {
			$ok = $this->db->insert('config', $get_desa_array);
			
			if ($ok) {
				echo "insert ok. ID: ".$this->db->insert_id();
			} else {
				j($this->db->error());
			}
		} else {
			$this->db->where('id', 1);
			$this->db->update('config', $get_desa_array);
			echo "update ok";
		}
	}

	public function wilayah() {
		$get_wilayah = file_get_contents($this->api_konversi."wilayah");
		$get_wilayah_array = json_decode($get_wilayah, true);


		foreach ($get_wilayah_array as $wl) {

			$cek_nik = get_penduduk($wl['id_kepala']);

			if ($cek_nik) {
				$wl['id_kepala'] = $cek_nik['id_penduduk_sistem'];

				$ok = $this->db->insert('tweb_wil_clusterdesa', $wl);

				if ($ok) {
					echo "insert, rt: ".$wl['rt'].", rw: ".$wl['rw'].", dusun: ".$wl['dusun'].". ID: ".$this->db->insert_id()."\r";
				} else {
					j($this->db->error());
				}
			}
		}
	}

	public function pamong() {
		$get_pamong = file_get_contents($this->api_konversi."pamong");
		$get_pamong_array = json_decode($get_pamong, true);


		foreach ($get_pamong_array as $wl) {
			
			$cek_nik = get_penduduk($wl['pamong_nik']);
			$wl['id_pend'] = $cek_nik['id_penduduk_sistem'];
			$wl['pamong_sex'] = konversi_jk($cek_nik['detil_nik']['JENIS_KLMIN']);
			$wl['pamong_pendidikan'] = konversi_pendidikan($cek_nik['detil_nik']['PDDK_AKH']);
			$wl['pamong_agama'] = konversi_agama($cek_nik['detil_nik']['AGAMA']);
			$wl['pamong_tgl_terdaftar'] = date('Y-m-d H:i:s');
			$wl['pamong_tglsk'] = ($wl['pamong_tglsk'] == "0000-00-00") ? null : $wl['pamong_tglsk'];

			$ok = $this->db->insert('tweb_desa_pamong', $wl);

			if ($ok) {
				echo "insert, pamong_nama: ".$wl['pamong_nama'].", jabatan: ".$wl['jabatan'].". ID: ".$this->db->insert_id()."\r";
			} else {
				j($this->db->error());
			}
		}
	}

	public function menu() {
		$get_data = file_get_contents($this->api_konversi."menu");
		$get_data_array = json_decode($get_data, true);

		$this->db->query("TRUNCATE TABLE menu");

		foreach ($get_data_array as $wl) {
			

			$ok = $this->db->insert('menu', $wl);

			if ($ok) {
				echo "ID: ".$this->db->insert_id()."\r";
			} else {
				j($this->db->error());
			}
		}
	}

	public function artikel() {
		$get_data = file_get_contents($this->api_konversi."artikel");
		$get_data_array = json_decode($get_data, true);

		$this->db->query("SET FOREIGN_KEY_CHECKS = 0;");
		$this->db->query("TRUNCATE TABLE artikel");

		foreach ($get_data_array as $wl) {
			unset($wl['urut']);
			unset($wl['jenis_widget']);
			$slug = url_title($wl['judul'], "-", true);
			$wl['slug'] = $slug;

			$ok = $this->db->insert('artikel', $wl);

			if ($ok) {
				echo "ID: ".$this->db->insert_id()."\r";
			} else {
				j($this->db->error());
			}
		}
	}

	

}

/* End of file konversi.php */
/* Location: ./application/controllers/konversi.php */