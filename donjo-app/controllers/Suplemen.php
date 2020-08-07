<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Suplemen extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('header_model');
		$this->load->model('suplemen_model');
		$this->load->model('biodata_model');
		$this->modul_ini = 2;
		$this->sub_modul_ini = 25;
	}

	public function index()
	{
		$_SESSION['per_page'] = 50;
		$data['suplemen'] = $this->suplemen_model->list_data();
		$header = $this->header_model->get_data();
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('suplemen/daftar', $data);
		$this->load->view('footer');
	}

	public function form_terdata($id)
	{

		$desa = $this->get_data_desa();
		$kodeProp = intval($desa['kode_propinsi']);
		$kodeKab = intval($desa['kode_kabupaten']);
		$kodeKec = intval($desa['kode_kecamatan']);
		$kodeKel = intval($desa['kode_desa']);

		$data['sasaran'] = unserialize(SASARAN);
		$data['suplemen'] = $this->suplemen_model->get_suplemen($id);
		$sasaran = $data['suplemen']['sasaran'];
		$data['list_sasaran'] = $this->suplemen_model->list_sasaran($id, $sasaran);
		if (isset($_POST['terdata']))
		{
			// from 19.05 $data['individu'] = $this->suplemen_model->get_terdata($_POST['terdata'], $sasaran);
			$data['individu'] = $this->biodata_model->get_penduduk($_POST['nik']);
			if($data['individu']['nik'] == NULL) {
				$data['individu']['status_data'] = "Data Tidak ditemukan";
			} else {
				if(
					$data['individu']['no_prop'] == $kodeProp
					&& $data['individu']['no_kab'] == $kodeKab
					&& $data['individu']['no_kec'] == $kodeKec
					&& $data['individu']['no_kel'] == $kodeKel
				) {
					$this->biodata_model->save_biodata($data['individu']);

				} else {
					$data['individu']['status_data'] = "Mohon Maaf Biodata Penduduk desa ".$data['individu']['kel_name'];
				}
			}
			$data['individu']['alamat_wilayah']= $data['individu']['alamat'];
		}
		else
		{
			$data['individu'] = NULL;
		}

		$data['form_action'] = site_url("suplemen/add_terdata");
		$header = $this->header_model->get_data();

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('suplemen/form_terdata', $data);
		$this->load->view('footer');
	}

	public function panduan()
	{
		$header = $this->header_model->get_data();

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('suplemen/panduan');
		$this->load->view('footer');
	}

	public function sasaran($sasaran = 0)
	{
		$header = $this->header_model->get_data();
		$data['tampil'] = $sasaran;
		$data['program'] = $this->suplemen_model->list_suplemen($sasaran);

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('suplemen/suplemen', $data);
		$this->load->view('footer');
	}

	public function rincian($p = 1, $id)
	{
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data = $this->suplemen_model->get_rincian($p, $id);
		$data['sasaran'] = unserialize(SASARAN);
		$data['per_page'] = $_SESSION['per_page'];

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('suplemen/rincian', $data);
		$this->load->view('footer');
	}

	public function terdata($sasaran = 0, $id = 0)
	{
		$header = $this->header_model->get_data();
		$data = $this->suplemen_model->get_terdata_suplemen($sasaran, $id);

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('suplemen/terdata', $data);
		$this->load->view('footer');
	}

	public function data_terdata($id)
	{
		$header = $this->header_model->get_data();
		$data['terdata'] = $this->suplemen_model->get_suplemen_terdata_by_id($id);
		$data['suplemen'] = $this->suplemen_model->get_suplemen($data['terdata']['id_suplemen']);
		$data['individu'] = $this->suplemen_model->get_terdata($data['terdata']['id_terdata'], $data['suplemen']['sasaran']);
		
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('suplemen/data_terdata', $data);
		$this->load->view('footer');
	}

	public function add_terdata($id)
	{
		$this->suplemen_model->add_terdata($_POST, $id);
		redirect("suplemen/rincian/1/$id");
	}

	public function hapus_terdata($id_suplemen, $id_terdata)
	{
		$this->redirect_hak_akses('h', "suplemen/rincian/1/$id_suplemen");
		$this->suplemen_model->hapus_terdata($id_terdata);
		redirect("suplemen/rincian/1/$id_suplemen");
	}

	public function edit_terdata($id)
	{
		$this->suplemen_model->edit_terdata($_POST, $id);
		$id_suplemen = $_POST['id_suplemen'];
		redirect("suplemen/rincian/1/$id_suplemen");
	}

	public function edit_terdata_form($id = 0)
	{
		$data = $this->suplemen_model->get_suplemen_terdata_by_id($id);
		$data['form_action'] = site_url("suplemen/edit_terdata/$id");
		$this->load->view('suplemen/edit_terdata', $data);
	}

	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('cid', 'Sasaran', 'required');
		$this->form_validation->set_rules('nama', 'Nama Data', 'required');
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$data['form_action'] = "suplemen/create";
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('suplemen/form');
		}
		else
		{
			$this->suplemen_model->create();
			redirect("suplemen/");
		}
		$this->load->view('footer');
	}

	public function edit($id)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('cid', 'Sasaran', 'required');
		$this->form_validation->set_rules('nama', 'Nama Data', 'required');
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$data['form_action'] = "suplemen/edit/$id";
		$data['suplemen'] = $this->suplemen_model->get_suplemen($id);

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('suplemen/form', $data);
		}
		else
		{
			$this->suplemen_model->update($id);
			redirect("suplemen/");
		}

		$this->load->view('footer');
	}

	public function hapus($id)
	{
		$this->redirect_hak_akses('h', "suplemen/");
		$this->suplemen_model->hapus($id);
		redirect("suplemen/");
	}

	public function unduhsheet($id = 0)
	{
		if ($id > 0)
		{
			/*
			 * Print xls untuk data x
			 * */
			$_SESSION['per_page'] = 0; // Unduh semua data
			$data = $this->suplemen_model->get_rincian(1, $id);
			$data['sasaran'] = unserialize(SASARAN);
			$data['desa'] = $this->header_model->get_data();
			$_SESSION['per_page'] = 50; // Kembalikan ke paginasi default

			$this->load->view('suplemen/unduh-sheet', $data);

		}
	}

	public function get_data_desa()
	{
		$sql = "SELECT * FROM config WHERE 1";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
}
