<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Covid19 extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->model('header_model');
		$this->load->model('covid19_model');
		$this->load->model('referensi_model');
		$this->load->model('wilayah_model');
		$this->load->model('penduduk_model');

		$this->modul_ini = 206;
	}

	public function index()
	{
		$this->pemudik(1);
	}

	public function pemudik($page = 1)
	{
		$this->sub_modul_ini = 207;

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);

		$data = $this->covid19_model->get_list_pemudik($page, "2");
		$data['per_page'] = $this->session->userdata('per_page');

		$data['title_header'] = "Daftar Pemudik Saat Pandemi Covid-19";
		$data['title_breadcumb'] = "Daftar Pemudik";
		$data['selected_nav'] = "pemudik";

		$header = $this->header_model->get_data();
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('covid19/data_pemudik', $data);
		$this->load->view('footer');
	}

	public function penduduk($page = 1)
	{

		$this->sub_modul_ini = 207;

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);

		$data = $this->covid19_model->get_list_pemudik($page, "1");
		$data['per_page'] = $this->session->userdata('per_page');

		$data['title_header'] = "Daftar Penduduk Terdata Pandemi Covid-19";
		$data['title_breadcumb'] = "Daftar Penduduk";
		$data['selected_nav'] = "penduduk";

		$header = $this->header_model->get_data();
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('covid19/data_pemudik', $data);
		$this->load->view('footer');
	}

	public function form_pemudik($form_type="pemudik")
	{
		$this->sub_modul_ini = 207;

		$data['form_type'] = $form_type;

		if ($form_type == "pemudik")
		{
			$data['title_header'] = "Penambahan Pemudik Covid-19";
			$data['title_breadcumb'] = "Daftar Pemudik Saat Covid-19";
			$data['label_button_back'] = "Kembali Ke Daftar Pemudik Saat Covid-19";
			$data['url_button_back'] = "covid19/pemudik";
		}
		else if ($form_type == "penduduk")
		{
			$data['title_header'] = "Penambahan Penduduk Terdata Covid-19";
			$data['title_breadcumb'] = "Daftar Penduduk Terdata Covid-19";
			$data['label_button_back'] = "Kembali Ke Daftar Penduduk Terdata Covid-19";
			$data['url_button_back'] = "covid19/penduduk";
		}

		$d = new DateTime('NOW');
		$data['tanggal_datang'] = $d->format('Y-m-d H:i:s');

		$data['list_penduduk'] = $this->covid19_model->get_penduduk_not_in_pemudik();

		if (isset($_POST['terdata']))
		{
			$data['individu'] = $this->covid19_model->get_penduduk_by_id($_POST['terdata']);
		}
		else
		{
			$data['individu'] = NULL;
		}

		$data['select_tujuan_mudik'] = $this->covid19_model->list_tujuan_mudik();
		$data['select_status_covid'] = $this->covid19_model->list_status_covid();

		$data['dusun'] = $this->wilayah_model->list_dusun();
		$data['rw'] = $this->wilayah_model->list_rw($data['penduduk']['dusun']);
		$data['rt'] = $this->wilayah_model->list_rt($data['penduduk']['dusun'], $data['penduduk']['rw']);
		$data['agama'] = $this->referensi_model->list_data("tweb_penduduk_agama");
		$data['golongan_darah'] = $this->referensi_model->list_data("tweb_golongan_darah");
		$data['jenis_kelamin'] = $this->referensi_model->list_data("tweb_penduduk_sex");
		$data['status_penduduk'] = $this->referensi_model->list_data("tweb_penduduk_status");

		$nav['act'] = 206;
		$header = $this->header_model->get_data();
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);

		$data['form_action'] = site_url("covid19/add_pemudik");
		$data['form_action_penduduk'] = site_url("covid19/insert_penduduk");
		$this->load->view('covid19/form_pemudik', $data);
		$this->load->view('footer');
	}

	public function insert_penduduk()
	{
		$callback_url = $_POST['callback_url'];
		unset($_POST['callback_url']);

		$id = $this->penduduk_model->insert();
		if ($_SESSION['success'] == -1)
			$_SESSION['dari_internal'] = true;
		redirect("covid19/form_pemudik");
	}

	public function add_pemudik()
	{
		$this->covid19_model->add_pemudik($_POST);

		if ($_POST["kategori"] == "1")
			redirect("covid19/penduduk");
		else if ($_POST["kategori"] == "2")
			redirect("covid19/pemudik");
		else
			redirect("covid19");
	}

	public function hapus_pemudik($form_type = "pemudik", $id_pemudik)
	{
		$this->redirect_hak_akses('h', "covid19");
		$this->covid19_model->delete_pemudik_by_id($id_pemudik);

		if ($form_type == "penduduk")
			redirect("covid19/penduduk");
		else if ($form_type == "pemudik")
			redirect("covid19/pemudik");
		else
			redirect("covid19");
	}

	public function edit_pemudik_form($form_type = "pemudik", $id = 0)
	{
		$data = $this->covid19_model->get_pemudik_by_id($id);
		$data['select_tujuan_mudik'] = $this->covid19_model->list_tujuan_mudik();
		$data['select_status_covid'] = $this->covid19_model->list_status_covid();
		$data['form_type'] = $form_type;

		$data['form_action'] = site_url("covid19/edit_pemudik/$id");
		$this->load->view('covid19/edit_pemudik', $data);
	}

	public function edit_pemudik($id)
	{
		$this->covid19_model->update_pemudik_by_id($_POST, $id);

		if ($_POST["kategori"] == "1")
			redirect("covid19/penduduk");
		else if ($_POST["kategori"] == "2")
			redirect("covid19/pemudik");
		else
			redirect("covid19");
	}

	public function detil_pemudik($id)
	{
		$nav['act'] = 206;
		$header = $this->header_model->get_data();

		$data['terdata'] = $this->covid19_model->get_pemudik_by_id($id);
		$data['individu'] = $this->covid19_model->get_penduduk_by_id($data['terdata']['id_terdata']);

		$data['terdata']['judul_terdata_nama'] = 'NIK';
		$data['terdata']['judul_terdata_info'] = 'Nama Terdata';
		$data['terdata']['terdata_nama'] = $data['individu']['nik'];
		$data['terdata']['terdata_info'] = $data['individu']['nama'];

		$data['penduduk'] = $this->penduduk_model->get_penduduk($data['terdata']['id_terdata']);
		$this->session->set_userdata('nik_lama', $data['penduduk']['nik']);

		$data['dusun'] = $this->wilayah_model->list_dusun();
		$data['rw'] = $this->wilayah_model->list_rw($data['penduduk']['dusun']);
		$data['rt'] = $this->wilayah_model->list_rt($data['penduduk']['dusun'], $data['penduduk']['rw']);
		$data['agama'] = $this->referensi_model->list_data("tweb_penduduk_agama");
		$data['golongan_darah'] = $this->referensi_model->list_data("tweb_golongan_darah");
		$data['jenis_kelamin'] = $this->referensi_model->list_data("tweb_penduduk_sex");
		$data['status_penduduk'] = $this->referensi_model->list_data("tweb_penduduk_status");

		$data['form_action_penduduk'] = site_url("covid19/update_penduduk/".$data['terdata']['id_terdata']."/".$id);

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('covid19/detil_pemudik', $data);
		$this->load->view('footer');
	}

	public function update_penduduk($id_pend, $id_pemudik)
	{
		$this->penduduk_model->update($id_pend);
		if ($_SESSION['success'] == -1)
			$_SESSION['dari_internal'] = true;
		redirect("covid19/detil_pemudik/$id_pemudik");
	}

	public function pantau($page=1, $filter_tgl=null, $filter_nik=null)
	{
		$this->sub_modul_ini = 208;

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);
		$data['per_page'] = $this->session->userdata('per_page');
		$data['page'] = $page;

		// get list pemudik
		$data['pemudik_array'] = $this->covid19_model->get_list_pemudik_wajib_pantau(true);
		// get list pemudik end

		// get list pemantauan
		$pantau_pemudik = $this->covid19_model->get_list_pantau_pemudik($page, $filter_tgl, $filter_nik);
		$data['unique_nik'] = $this->covid19_model->get_unique_nik_pantau_pemudik();
		$data['unique_date'] = $this->covid19_model->get_unique_date_pantau_pemudik();
		$data['filter_tgl'] = isset($filter_tgl) ? $filter_tgl : '0';
		$data['filter_nik'] = isset($filter_nik) ? $filter_nik : '0';

		$data['paging'] = $pantau_pemudik["paging"];
		$data['pantau_pemudik_array'] = $pantau_pemudik["query_array"];
		// get list pemantauan end

		// datetime now
		$d = new DateTime('NOW');
		$data['datetime_now'] = $d->format('Y-m-d H:i:s');

		$data['this_url'] = site_url("covid19/pantau");
		$data['form_action'] = site_url("covid19/add_pantau");


		$url_delete_front = "covid19/hapus_pantau";
		$url_delete_rare = "$page";
		$data['url_delete_front'] = $url_delete_front;
		$data['url_delete_rare'] = $url_delete_rare;

		$header = $this->header_model->get_data();
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('covid19/pantau_pemudik', $data);
		$this->load->view('footer');
	}

	public function add_pantau()
	{
		$this->covid19_model->add_pantau_pemudik($_POST);
		$url = "covid19/pantau/".$_POST["page"]."/".$_POST["data_h_plus"];
		redirect($url);
	}

	public function hapus_pantau($id_pantau_pemudik, $page=NULL, $h_plus=NULL)
	{
		$this->redirect_hak_akses('h', "covid19");
		$this->covid19_model->delete_pantau_pemudik_by_id($id_pantau_pemudik);

		$url = "covid19/pantau";
		$url .= (isset($page) ? "/$page" : "");
		$url .= (isset($h_plus) ? "/$h_plus" : "");
		redirect($url);
	}

	/*
	* $aksi = cetak/unduh
	*/
	public function daftar($aksi = '', $filter_tgl = null, $filter_nik = null)
	{
		$this->session->set_userdata('per_page', 0); // Unduh semua data

		if (isset($filter_tgl) OR isset($filter_nik))
		{
			$data = $this->covid19_model->get_list_pantau_pemudik(1, $filter_tgl, $filter_nik);
			$judul = 'pantauan';
		}
		else
		{
			$data = $this->covid19_model->get_list_pemudik(1);
			$judul = 'pendataan';
		}

		if ($aksi === 'cetak') $aksi = $aksi.'_'.$judul;

		$data['config'] = $this->config_model->get_data();
		$data['aksi'] = $aksi;
		$data['judul'] = $judul;
		$this->session->set_userdata('per_page', 10); // Kembalikan ke paginasi default

		$this->load->view('covid19/'.$data['aksi'], $data);
	}

}
