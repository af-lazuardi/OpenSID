<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Keluar extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('keluar_model');
		$this->load->model('surat_model');
		$this->load->model('biodata_model');
		$this->load->model('header_model');
		$this->load->helper('download');
		$this->load->model('pamong_model');
		$this->load->model('config_model');
		$this->modul_ini = 4;
		$this->sub_modul_ini = 32;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		unset($_SESSION['jenis']);
		$_SESSION['per_page'] = 20;
		redirect('keluar');
	}

	public function index($p=1, $o=0)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		if (isset($_SESSION['jenis']))
			$data['jenis'] = $_SESSION['jenis'];
		else $data['jenis'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->keluar_model->paging($p,$o);
		$data['main'] = $this->keluar_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['tahun_surat'] = $this->keluar_model->list_tahun_surat();
		$data['jenis_surat'] = $this->keluar_model->list_jenis_surat();
		$data['keyword'] = $this->keluar_model->autocomplete();
		$header = $this->header_model->get_data();

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('surat/surat_keluar',$data);
		$this->load->view('footer');
	}

	public function edit_keterangan($id=0)
	{
		$data['data'] = $this->keluar_model->list_data_keterangan($id);
		$data['form_action'] = site_url("keluar/update_keterangan/$id");
		$this->load->view('surat/ajax_edit_keterangan', $data);
	}

	public function update_keterangan($id='')
	{
		$data = array('keterangan' => $this->input->post('keterangan'));
		$data = $this->security->xss_clean($data);
		$data = html_escape($data);
		$this->keluar_model->update_keterangan($id, $data);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "keluar/index/$p/$o");
		session_error_clear();
		$this->keluar_model->delete($id);
		redirect("keluar/index/$p/$o");
	}

	public function search()
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		redirect('keluar');
	}

	public function perorangan_clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		unset($_SESSION['nik']);
		$_SESSION['per_page'] = 20;
		redirect('keluar/perorangan');
	}

	public function perorangan($nik='', $p=1, $o=0)
	{
		if (isset($_POST['nik']))
		{
			$nik = $_POST['nik'];
		}
		if (!empty($nik))
		{
			$data['individu'] = $this->surat_model->get_penduduk($nik);
		}
		else
		{
			$data['individu'] = null;
		}

		$data['p'] = $p;
		$data['o'] = $o;

		if (isset($_POST['per_page']))
			$_SESSION['per_page']=$_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->keluar_model->paging_perorangan($nik, $p, $o);
		$data['main'] = $this->keluar_model->list_data_perorangan($nik, $o, $data['paging']->offset, $data['paging']->per_page);

		$data['form_action'] = site_url("sid_surat_keluar/perorangan/$nik");
		$data['nik']['no'] = $nik;
		$header = $this->header_model->get_data();

		$this->load->view('header',$header);
		$this->load->view('nav', $nav);
		$this->load->view('surat/surat_keluar_perorangan', $data);
		$this->load->view('footer');
	}

	public function graph()
	{
		$data['stat'] = $this->keluar_model->grafik();
		$header = $this->header_model->get_data();

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('surat/surat_keluar_graph', $data);
		$this->load->view('footer');
	}

	public function filter()
	{
		$filter = $this->input->post('filter');
		if ($filter != 0)
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		redirect('keluar');
	}

	public function jenis()
	{
		$jenis = $this->input->post('jenis');
		if (!empty($jenis))
			$_SESSION['jenis'] = $jenis;
		else unset($_SESSION['jenis']);
		redirect('keluar');
	}

	public function cetak_surat_keluar($id)
  {
    $berkas = $this->db->select('nama_surat')->where('id', $id)->get('log_surat')->row();
    ambilBerkas($berkas->nama_surat, 'keluar');
  }

	public function unduh_lampiran($id)
  {
    $berkas = $this->db->select('lampiran')->where('id', $id)->get('log_surat')->row();
    ambilBerkas($berkas->lampiran, 'keluar');
  }

  public function dialog_cetak($o = 0)
  {
	  $data['aksi'] = "Cetak";
	  $data['pamong'] = $this->pamong_model->list_data(true);
	  $data['form_action'] = site_url("keluar/cetak/$o");
	  $this->load->view('surat/ajax_cetak', $data);
  }

	public function dialog_unduh($o = 0)
	{
		$data['aksi'] = "Unduh";
		$data['pamong'] = $this->pamong_model->list_data(true);
	  $data['form_action'] = site_url("keluar/unduh/$o");
	  $this->load->view('surat/ajax_cetak', $data);
	}

  public function cetak($o=0)
  {
	  $data['input'] = $_POST;
	  $data['pamong_ttd'] = $this->pamong_model->get_data($_POST['pamong_ttd']);
	  $data['pamong_ketahui'] = $this->pamong_model->get_data($_POST['pamong_ketahui']);
	  $data['desa'] = $this->config_model->get_data();
	  $data['main'] = $this->keluar_model->list_data();
	  $this->load->view('surat/keluar_print', $data);
  }

  public function unduh($o=0)
  {
	  $data['input'] = $_POST;
	  $data['pamong_ttd'] = $this->pamong_model->get_data($_POST['pamong_ttd']);
	  $data['pamong_ketahui'] = $this->pamong_model->get_data($_POST['pamong_ketahui']);
	  $data['desa'] = $this->config_model->get_data();
	  $data['main'] = $this->keluar_model->list_data();
	  $this->load->view('surat/keluar_excel', $data);
  }

	public function surat_keluar_cetak($id) {
		$this->db->where("a.id", $id);
		$this->db->join("tweb_surat_format AS b", "a.id_format_surat = b.id");
		$detil_log = $this->db->get("log_surat AS a")->row_array();

		$tampil = $this->db->get_where('log_surat',['id'=> $id])->row();
		$result = json_decode($tampil->detail);
		$nik= $result->pengikut;

		// print_r(json_decode($tampil->detail));

		$no_kk = $this->biodata_model->get_kk($nik);
		// echo $this->db->last_query();
		$data['jumlah'] = $this->biodata_model->countRow($no_kk);
		$data['penduduk'] = $this->biodata_model->get_individu($nik)->result_array();

		$data['data'] = $this->surat_model->get_data_pribadi($detil_log['id_pend']);


		$data['desa'] = $this->surat_model->get_data_desa();
		$data['url'] = $detil_log['url_surat'];
		$data['tanggal_sekarang'] = tgl_indo(date("Y m d"));

		$data['input']['jabatan'] = $detil_log['jabatan'];
		$data['input']['pamong'] = $detil_log['pamong_nama'];

		$pc_detail_surat = json_decode($detil_log['detail'], TRUE);


		foreach ($pc_detail_surat as $k=>$y) {
			$data['input'][$k] = $y;
		}

		// echo json_encode($data, JSON_PRETTY_PRINT);
		// exit;

		$this->load->view("surat/print_surat", $data);
	}

}
