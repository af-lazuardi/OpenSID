--HEAD--
<?php class Pamong_model extends CI_Model {

	private $urut_model;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('biodata_model');
	  require_once APPPATH.'/models/Urut_model.php';
		$this->urut_model = new Urut_Model('tweb_desa_pamong', 'pamong_id');
	}

	public function list_data($aktif = false)
	{
		$sql = "SELECT u.*, p.nama as nama, p.nik as nik, p.tempatlahir, p.tanggallahir, x.nama AS sex, b.nama AS pendidikan_kk, g.nama AS agama, x2.nama AS pamong_sex, b2.nama AS pamong_pendidikan, g2.nama AS pamong_agama
			FROM tweb_desa_pamong u
			LEFT JOIN tweb_biodata_penduduk p ON u.id_pend = p.id
			LEFT JOIN tweb_penduduk_pendidikan_kk b ON p.pendidikan_kk_id = b.id
			LEFT JOIN tweb_penduduk_sex x ON p.sex = x.id
			LEFT JOIN tweb_penduduk_agama g ON p.agama_id = g.id
			LEFT JOIN tweb_penduduk_pendidikan_kk b2 ON u.pamong_pendidikan = b2.id
			LEFT JOIN tweb_penduduk_sex x2 ON u.pamong_sex = x2.id
			LEFT JOIN tweb_penduduk_agama g2 ON u.pamong_agama = g2.id
			WHERE 1";
		$sql .= $this->search_sql();
		$sql .= $this->filter_sql($aktif);

		$query = $this->db->query($sql);
		$data  = $query->result_array();

		for ($i=0; $i<count($data); $i++)
		{
			if (empty($data[$i]['id_pend']))
			{
				// Dari luar desa
				$data[$i]['nama'] = $data[$i]['pamong_nama'];
				$data[$i]['nik'] = $data[$i]['pamong_nik'];
				$data[$i]['tempatlahir'] = !empty($data[$i]['pamong_tempatlahir']) ? $data[$i]['pamong_tempatlahir'] : '-';
				$data[$i]['tanggallahir'] = $data[$i]['pamong_tanggallahir'];
				$data[$i]['sex'] = $data[$i]['pamong_sex'];
				$data[$i]['pendidikan_kk'] = $data[$i]['pamong_pendidikan'];
				$data[$i]['agama'] = $data[$i]['pamong_agama'];
				if (empty($data[$i]['pamong_nosk'])) $data[$i]['pamong_nosk'] = '-';
				if (empty($data[$i]['pamong_nohenti'])) $data[$i]['pamong_nohenti'] = '-';
			}
			else
			{
				if (empty($data[$i]['tempatlahir'])) $data[$i]['tempatlahir'] = '-';
			}
			$data[$i]['no'] = $i + 1;
		}
		return $data;
	}

	public function autocomplete()
	{
		$sql = "SELECT * FROM
				(SELECT p.nama
					FROM tweb_desa_pamong u
					LEFT JOIN tweb_penduduk p ON u.id_pend = p.id) a
				UNION SELECT p.nik
					FROM tweb_desa_pamong u
					LEFT JOIN tweb_penduduk p ON u.id_pend = p.id
				UNION SELECT pamong_niap FROM tweb_desa_pamong
				UNION SELECT pamong_nip FROM tweb_desa_pamong";
		$query = $this->db->query($sql);
		$data  = $query->result_array();

		$outp = '';
		for ($i=0; $i<count($data); $i++)
		{
			$outp .= ",'" .addslashes($data[$i]['nama']). "'";
		}
		$outp = substr($outp, 1);
		$outp = '[' .$outp. ']';
		return $outp;
	}

	private function search_sql()
	{
		if (isset($_SESSION['cari']))
		{
			$cari = $_SESSION['cari'];
			$kw = $this->db->escape_like_str($cari);
			$kw = '%' .$kw. '%';
			$search_sql = " AND (p.nama LIKE '$kw' OR u.pamong_niap LIKE '$kw' OR u.pamong_nip LIKE '$kw' OR p.nik LIKE '$kw')";
			return $search_sql;
		}
	}

	private function filter_sql($aktif=false)
	{
		if ($aktif)
		{
			return " AND u.pamong_status = '1'";
		}
		if (!empty($_SESSION['filter']))
		{
			$kf = $_SESSION['filter'];
			$filter_sql = " AND u.pamong_status = $kf";
			return $filter_sql;
		}
	}

	public function get_data($id=0)
	{
		$sql = "SELECT u.*, p.nama as nama
			FROM tweb_desa_pamong u
			LEFT JOIN tweb_penduduk p ON u.id_pend = p.id
			WHERE pamong_id = ?";
		$query = $this->db->query($sql, $id);
		$data  = $query->row_array();
		$data['pamong_niap_nip'] = (!empty($data['pamong_nip']) and $data['pamong_nip'] != '-') ? $data['pamong_nip'] : $data['pamong_niap'];
		if (!empty($data['id_pend']))
		{
			// Dari database penduduk
			$data['pamong_nama'] = $data['nama'];
		}
		return $data;
	 }

	public function get_pamong_by_nama($nama='')
	{
		$pamong = $this->db->select('*')->from('tweb_desa_pamong')->where('pamong_nama', $nama)->limit(1)->get()->row_array();
		return $pamong;
	}

	public function insert()
	{
		$_SESSION['success'] = 1;

		$data = array();
		$data = $this->siapkan_data($data);

		$nama_file = '';
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file = $_FILES['foto']['type'];
		$nama_file = $_FILES['foto']['name'];

		if (!empty($nama_file))
		{
		  $nama_file = urlencode(generator(6)."_".$_FILES['foto']['name']);
			if (!empty($lokasi_file) AND in_array($tipe_file, unserialize(MIME_TYPE_GAMBAR)))
			{
				UploadFoto($nama_file, $old_foto='', $tipe_file);
			}
			else
			{
				$nama_file = '';
				$_SESSION['success'] = -1;
				$_SESSION['error_msg'] = " -> Jenis file salah: " . $tipe_file;
			}
			$data['foto'] = $nama_file;
		}

		// Beri urutan terakhir
		$data['urut'] = $this->urut_model->urut_max() + 1;
		$data['pamong_tgl_terdaftar'] = date('Y-m-d');
		$outp = $this->db->insert('tweb_desa_pamong', $data);
		if (!$outp) $_SESSION['success'] = -1;

		// start api
		$data = $data;
		$data['desa_id'] = $this->db->database;
		$data['mode'] = "insert";
		$data['desa_data_id'] = $this->db->insert_id();

		cpost('pamong', $data);
	}

	private function siapkan_data(&$data)
	{
		$this->data_pamong_asal($data);
		$data['pamong_nip'] = strip_tags($this->input->post('pamong_nip'));
		$data['pamong_niap'] = strip_tags($this->input->post('pamong_niap'));
		$data['jabatan'] = strip_tags($this->input->post('jabatan'));
		$data['pamong_pangkat'] = strip_tags($this->input->post('pamong_pangkat'));
		$data['pamong_status'] = $this->input->post('pamong_status');
		$data['pamong_nosk'] = strip_tags($this->input->post('pamong_nosk'));
		$data['pamong_tglsk'] = !empty($this->input->post('pamong_tglsk')) ? tgl_indo_in($this->input->post('pamong_tglsk')) : NULL;
		$data['pamong_tanggallahir'] = !empty($this->input->post('pamong_tanggallahir')) ? tgl_indo_in($this->input->post('pamong_tanggallahir')) : NULL;
		$data['pamong_nohenti'] = !empty($this->input->post('pamong_nohenti')) ? strip_tags($this->input->post('pamong_nohenti')) : NULL;
		$data['pamong_tglhenti'] = !empty($this->input->post('pamong_tglhenti')) ?tgl_indo_in($this->input->post('pamong_tglhenti')) : NULL;
		$data['pamong_masajab'] = strip_tags($this->input->post('pamong_masajab')) ?: NULL;
		$data['pamong_tgl_terdaftar'] = tgl_indo_in($this->input->post('pamong_tglsk'));
		$data['id_pend'] = $this->input->post('nik');

		return $data;
	}

	private function data_pamong_asal(&$data)
	{
		if (empty($data['id_pend']))
		{
			unset($data['id_pend']);
			$data['pamong_nama'] = strip_tags($this->input->post('pamong_nama')) ?: null;
			$data['pamong_nik'] = strip_tags($this->input->post('pamong_nik')) ?: null;
			$data['pamong_tempatlahir'] = strip_tags($this->input->post('pamong_tempatlahir')) ?: null;
			$data['pamong_tanggallahir'] = tgl_indo_in($this->input->post('pamong_tanggallahir')) ?: null;
			$data['pamong_sex'] = $this->input->post('pamong_sex') ?: null;
			$data['pamong_pendidikan'] = $this->input->post('pamong_pendidikan') ?: null;
			$data['pamong_agama'] = $this->input->post('pamong_agama') ?: null;
		}
	}

	public function update($id=0)
	{
		$data = array();
		unset($_SESSION['validation_error']);
		$_SESSION['success'] = 1;;
		unset($_SESSION['error_msg']);
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file = $_FILES['foto']['type'];
		$nama_file = $_FILES['foto']['name'];
		$old_foto = $this->input->post('old_foto');
		if (!empty($nama_file))
		{
			if (!empty($lokasi_file) AND in_array($tipe_file, unserialize(MIME_TYPE_GAMBAR)))
			{
			  $data['foto'] = urlencode(generator(6)."_".$nama_file);
				UploadFoto($data['foto'], $old_foto, $tipe_file);
			}
			else
			{
				$_SESSION['success'] = -1;
				$_SESSION['error_msg'] = " -> Jenis file salah: " . $tipe_file;
			}
		}

		$data = $this->siapkan_data($data);

		$biodata = $this->biodata_model->get_penduduk($this->input->post('nik'));
		if (empty($biodata['nik'])) {
			$data['pamong_nama'] = $this->input->post('pamong_nama');
			$data['pamong_nik'] = $this->input->post('pamong_nik');
			$data['pamong_tempatlahir'] = $this->input->post('pamong_tempatlahir');
			$data['pamong_tanggallahir'] = tgl_indo_in($this->input->post('pamong_tanggallahir'));
			$data['pamong_sex'] = $this->input->post('pamong_sex');
			$data['pamong_pendidikan'] = $this->input->post('pamong_pendidikan');
			$data['pamong_agama'] = $this->input->post('pamong_agama');
			$data['pamong_nip'] = $this->input->post('pamong_nip');
			$data['jabatan'] = $this->input->post('jabatan');
			$data['pamong_status'] = $this->input->post('pamong_status');
			$data['pamong_nosk'] = $this->input->post('pamong_nosk');
			$data['pamong_tglsk'] = tgl_indo_in($this->input->post('pamong_tglsk'));
			$data['pamong_masajab'] = $this->input->post('pamong_masajab');
			$data['urut'] = $this->urut_max() + 1;
			$data['id_pend'] = $this->input->post('nik');

		}else{
			$data['pamong_nama'] = $biodata['nama'];
			$data['pamong_nik'] = $biodata['nik'];
			$data['pamong_tempatlahir'] = $biodata['tempatlahir'];
			$data['pamong_tanggallahir'] = $biodata['tanggallahir'];
			$data['pamong_sex'] = $biodata['jenis_klmin'];
			$data['pamong_pendidikan'] = $biodata['pendidikan'];
			$data['pamong_agama'] = $biodata['agama'];
			$data['urut'] = $this->urut_max() + 1;
			$data['id_pend'] = $this->input->post('nik');
			$data['pamong_nip'] = $this->input->post('pamong_nip');
			$data['pamong_niap'] = $this->input->post('pamong_niap');
			$data['jabatan'] = $this->input->post('jabatan');
			$data['jabatan'] = $this->input->post('jabatan');
			$data['pamong_pangkat'] = $this->input->post('pamong_pangkat');
			$data['pamong_status'] = $this->input->post('pamong_status');
			$data['pamong_nosk'] = $this->input->post('pamong_nosk');
			$data['pamong_tglsk'] = tgl_indo_in($this->input->post('pamong_tglsk'));
			$data['pamong_nohenti'] = $this->input->post('pamong_nohenti');
			$data['pamong_tglhenti'] = tgl_indo_in($this->input->post('pamong_tglhenti'));
			$data['pamong_masajab'] = $this->input->post('pamong_masajab');
		}
		//$data['id_pend'] = $this->input->post('id_pend');
		//$this->data_pamong_asal($data);

		if (!empty($nama_file))
		{
			$data['foto'] = $nama_file;
		}
		$this->db->where("pamong_id", $id)->update('tweb_desa_pamong', $data);

		// start api
		$data = $data;
		$data['desa_id'] = $this->db->database;
		$data['mode'] = "update";
		$data['desa_data_id'] = $id;

		cpost('pamong', $data);
		// end api

	}

	public function delete($id='', $semua=false)
	{
		if (!$semua) $this->session->success = 1;

		$foto = $this->db->select('foto')->where('pamong_id',$id)->get('tweb_desa_pamong')->row()->foto;
		if (!empty($foto))
		{
			unlink(LOKASI_USER_PICT.$foto);
			unlink(LOKASI_USER_PICT.'kecil_'.$foto);
		}

		// start api
		$data = $data;
		$data['desa_id'] = $this->db->database;
		$data['mode'] = "delete";
		$data['desa_data_id'] = $id;

		cpost('pamong', $data);
		// end api

		$outp = $this->db->where('pamong_id', $id)->delete('tweb_desa_pamong');
		status_sukses($outp, $gagal_saja=true); //Tampilkan Pesan
	}

	public function delete_all()
	{
		$this->session->success = 1;

		$id_cb = $_POST['id_cb'];
		foreach ($id_cb as $id)
		{
			$this->delete($id, $semua=true);
		}
	}

	public function ttd($id='', $val=0)
	{
		if ($val == 1)
		{
			// Hanya satu pamong yang boleh digunakan sebagai ttd a.n / default
			$this->db->where('pamong_ttd', 1)->update('tweb_desa_pamong', array('pamong_ttd'=>0));
		}
		$this->db->where('pamong_id', $id)->update('tweb_desa_pamong', array('pamong_ttd'=>$val));
	}

	public function ub($id='', $val=0)
	{
		if ($val == 1)
		{
			// Hanya satu pamong yang boleh digunakan sebagai ttd u.b
			$this->db->where('pamong_ub', 1)->update('tweb_desa_pamong', array('pamong_ub'=>0));
		}
		$this->db->where('pamong_id', $id)->update('tweb_desa_pamong', array('pamong_ub'=>$val));
	}

	public function get_ttd()
	{
		$ttd = $this->db->where('pamong_ttd', 1)->get('tweb_desa_pamong')->row_array();
		return $ttd;
	}

	public function get_ub()
	{
		$ub = $this->db->where('pamong_ub', 1)->get('tweb_desa_pamong')->row_array();
		return $ub;
	}

	// $arah:
	//		1 - turun
	// 		2 - naik
	public function urut($id, $arah)
	{
  	$this->urut_model->urut($id, $arah);
	}

}
?>
