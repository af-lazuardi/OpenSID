<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengurus extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('pamong_model');
		$this->load->model('header_model');
		$this->load->model('penduduk_model');
		$this->load->model('biodata_model');
		$this->load->model('config_model');
		$this->modul_ini = 200;
		$this->sub_modul_ini = 18;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('pengurus');
	}

	public function index()
	{
		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		$data['main'] = $this->pamong_model->list_data();
		$data['keyword'] = $this->pamong_model->autocomplete();
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('home/pengurus', $data);
		$this->load->view('footer');
	}

	public function form($id = '')
	{

		$desa = $this->get_data_desa();
		$kodeProp = intval($desa['kode_propinsi']);
		$kodeKab = intval($desa['kode_kabupaten']);
		$kodeKec = intval($desa['kode_kecamatan']);
		$kodeKel = intval($desa['kode_desa']);
		if ($id)
		{
			$data['pamong'] = $this->pamong_model->get_data($id);
			if (!isset($_POST['id_pend'])) $_POST['id_pend'] = $data['pamong']['id_pend'];
			$data['form_action'] = site_url("pengurus/update/$id");
		}
		else
		{
			$data['pamong'] = NULL;
			$data['form_action'] = site_url("pengurus/insert");
		}

		$data['penduduk'] = $this->pamong_model->list_penduduk();
		$data['pendidikan_kk'] = $this->penduduk_model->list_pendidikan_kk();
		$data['agama'] = $this->penduduk_model->list_agama();

		$data['penduduk'] = $this->penduduk_model->list_penduduk();
		if (!empty($_POST['id_pend'])) {
			$data['individu'] = $this->biodata_model->get_penduduk($_POST['id_pend']);

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

			//v20.05
			//$data['individu'] = $this->penduduk_model->get_penduduk($_POST['id_pend']);

		} else {
			$data['individu'] = NULL;
		}
		$header = $this->header_model->get_data();

		// $data['p_jabatan'] = array(
		// 	""=>" - ",
		// 	"Kepala Desa"=>"Lurah",
		// 	"Sekretaris Desa"=>"Carik",
		// 	"Kasi Pemerintahan"=>"Jogo Boyo",
		// 	"Kasi Kemasyarakatan"=>"Kamituwa",
		// 	"Kaur Umum Aparatur Desa & Aset"=>"Pranata Laksana Sarta Pangripta",
		// 	"Kasi Pembanguanan & Pemberdayaan"=>"Ulu-Ulu",
		// 	"Kaur Perencanaan & Keuangan"=>"Danarta",
		// 	"Staff Desa"=>"Staff Desa",
		// 	"Lainnya"=>"Lainnya",
		// );
		$data['p_jabatan'] = array(
			""=>" - ",
			"Lurah"=>"Lurah",
			"Carik"=>"Carik",
			"Jogobyo"=>"Jogoboyo",
			"Kamituwa"=>"Kamituwa",
			"Panata Laksana Sarta Pangripta"=>"Panata Laksana Sarta Pangripta",
			"Ulu-Ulu"=>"Ulu-Ulu",
			"Danarta"=>"Danarta",
			"Staff Desa"=>"Staff Desa",
			"Lainnya"=>"Lainnya",
			"Dukuh"=>"Dukuh",
		);

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('home/pengurus_form', $data);
		$this->load->view('footer');
	}

	public function filter()
	{
		$filter = $this->input->post('filter');
		if ($filter != "")
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		redirect('pengurus');
	}

	public function search()
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		redirect('pengurus');
	}

	public function insert()
	{
		$this->pamong_model->insert();
		redirect('pengurus');
	}

	public function update($id = '')
	{
		$this->pamong_model->update($id);
		redirect('pengurus');
	}

	public function delete($id = '')
	{
		$this->redirect_hak_akses('h', 'pengurus');
		$outp = $this->pamong_model->delete($id);
		redirect('pengurus');
	}

	public function delete_all()
	{
		$this->redirect_hak_akses('h', 'pengurus');
		$this->pamong_model->delete_all();
		redirect('pengurus');
	}

	public function ttd_on($id = '')
	{
		$this->pamong_model->ttd($id, 1);
		redirect('pengurus');
	}

	public function ttd_off($id = '')
	{
		$this->pamong_model->ttd($id, 0);
		redirect('pengurus');
	}

	public function ub_on($id = '')
	{
		$this->pamong_model->ub($id, 1);
		redirect('pengurus');
	}

	public function ub_off($id = '')
	{
		$this->pamong_model->ub($id, 0);
		redirect('pengurus');
	}

	public function dialog_cetak($o = 0)
	{
		$data['aksi'] = "Cetak";
		$data['pamong'] = $this->pamong_model->list_data(true);
		$data['form_action'] = site_url("pengurus/cetak/$o");
		$this->load->view('home/ajax_cetak_pengurus', $data);
	}

	public function dialog_unduh($o = 0)
	{
		$data['aksi'] = "Unduh";
		$data['pamong'] = $this->pamong_model->list_data(true);
		$data['form_action'] = site_url("pengurus/unduh/$o");
		$this->load->view('home/ajax_cetak_pengurus', $data);
	}

	public function cetak($o = 0)
	{
		$data['input'] = $_POST;
		$data['pamong_ttd'] = $this->pamong_model->get_data($_POST['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($_POST['pamong_ketahui']);
  	$data['desa'] = $this->config_model->get_data();
    $data['main'] = $this->pamong_model->list_data();
		$this->load->view('home/pengurus_print', $data);
	}

	public function unduh($o = 0)
	{
		$data['input'] = $_POST;
		$data['pamong_ttd'] = $this->pamong_model->get_data($_POST['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($_POST['pamong_ketahui']);
  	$data['desa'] = $this->config_model->get_data();
    $data['main'] = $this->pamong_model->list_data();
		$this->load->view('home/pengurus_excel', $data);
	}

	public function urut($id = 0, $arah = 0)
	{
		$this->pamong_model->urut($id, $arah);
		redirect("pengurus");
	}

	public function get_data_desa()
	{
		$sql = "SELECT * FROM config WHERE 1";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

}
