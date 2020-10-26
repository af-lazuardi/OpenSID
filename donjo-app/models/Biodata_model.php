<?php class Biodata_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	

	public function get_penduduk($id=0)
	{
		$url = $this->config->item('url_dwh');
        $instansi = $this->config->item('instansi');
        $metode = $this->config->item('metode');
		$nik = $id;
		$userDwh = $this->config->item('usename_dwh');
		$passwordDwh = $this->config->item('password_dwh');

        $data = array(
            "nik" => $nik,
            "user_id" => $userDwh,
            "password" => $passwordDwh,
			"instansi" => $instansi
        );

		
        $data_string = json_encode($data);
		$url = $url."dukcapil/get_json/".$instansi."/".$metode;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		); 
        $hasil = curl_exec($ch);
        if ($hasil === false)
        {
            echo curl_error($ch); 
        }
        { 
	
						$tmp = $hasil;
						$hasil_data = json_decode($hasil, true, 512);

						$hasil_data['json'] = $tmp;
					}

			
					curl_close($ch);
					
					if (!empty($hasil_data["RESPON"]))
					{
					$this->load->view('css/link');
			
						$this->load->view('v_respon');
					} else {
						$data = null;
						$keluarga =null;
						foreach($hasil_data['content'] as &$val) {

							if ($val['NIK'] == $nik) {
								$data = $val;
							}
						}
						$hasil_data = $data;

					}
		
		$biodata['nik']=$hasil_data['NIK'];
		$biodata['nama']=$hasil_data['NAMA_LGKP'];
		$biodata['tempatlahir']=$hasil_data['TMPT_LHR'];
		$biodata['tanggallahir']=$hasil_data['TGL_LHR'];
		//$biodata['alamat_wilayah']=$hasil_data['ALAMAT']." RT/RW ".$hasil_data['NO_RT']."/".$hasil_data['NO_RW'].", ".$hasil_data['KEL_NAME'].", ".$hasil_data['KEC_NAME'];
		$biodata['alamat']=$hasil_data['ALAMAT'];
		$biodata['no_rt']=$hasil_data['NO_RT'];
		$biodata['no_rw']=$hasil_data['NO_RW'];
		$biodata['prop_name']=$hasil_data['PROP_NAME'];
		$biodata['kab_name']=$hasil_data['KAB_NAME'];
		$biodata['kec_name']=$hasil_data['KEC_NAME'];
		$biodata['kel_name']=$hasil_data['KEL_NAME'];
		$biodata['pendidikan']=$hasil_data['PDDK_AKH'];
		$biodata['pekerjaan']=$hasil_data['JENIS_PKRJN'];
		$biodata['no_kk']=$hasil_data['NO_KK'];
		$biodata['jenis_klmin']=$hasil_data['JENIS_KLMIN'];
		$biodata['warganegara']='WNI';
		$biodata['agama']=$hasil_data['AGAMA'];
		$biodata['stat_kwn']=$hasil_data['STATUS_KAWIN'];
		$biodata['kepala_kk']=$hasil_data['NAMA_KK'];
		$biodata['nama_ayah']=$hasil_data['NAMA_LGKP_AYAH'];
		$biodata['nama_ibu']=$hasil_data['NAMA_LGKP_IBU'];
		$biodata['golongan_darah']=$hasil_data['GOL_DARAH'];
		$biodata['no_kel']=$hasil_data['NO_KEL'];
		$biodata['no_kec']=$hasil_data['NO_KEC'];
		$biodata['no_kab']=$hasil_data['NO_KAB'];
		$biodata['no_prop']=$hasil_data['NO_PROP'];
		$biodata['stat_hbkel']=$hasil_data['STAT_HBKEL'];
		$biodata['no_akta_lhr']=$hasil_data['NO_AKTA_LHR'];
		$biodata['no_akta_kwn']=$hasil_data['NO_AKTA_KWN'];
		$biodata['tgl_kwn']=$hasil_data['TGL_KWN'];
		return  $biodata;
				
	}

	public function get_kartu_keluarga($id=0)
	{
		$url = $this->config->item('url_dwh');
        $instansi = $this->config->item('instansi');
        $metode = $this->config->item('metode');
		$nik = $id;
		$userDwh = $this->config->item('usename_dwh');
		$passwordDwh = $this->config->item('password_dwh');

        $data = array(
            "nik" => $nik,
            "user_id" => $userDwh,
            "password" => $passwordDwh,
			"instansi" => $instansi
        );

		
        $data_string = json_encode($data);
		$url = $url."dukcapil/get_json/".$instansi."/".$metode;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		); 
        $hasil = curl_exec($ch);
        if ($hasil === false)
        {
            echo curl_error($ch); 
        }
        { 
	
						$tmp = $hasil;
						$hasil_data = json_decode($hasil, true, 512);

						$hasil_data['json'] = $tmp;
					}

			
					curl_close($ch);
					
					if (!empty($hasil_data["RESPON"]))
					{
					$this->load->view('css/link');
			
						$this->load->view('v_respon');
					} else {
						$data = [];
						$total = 0;
						foreach($hasil_data['content'] as $val) {
					
$xbiodata['nik']=$val['NIK'];
							$xbiodata['nama']=$val['NAMA_LGKP'];
							$xbiodata['tempatlahir']=$val['TMPT_LHR'];
							$xbiodata['tanggallahir']=$val['TGL_LHR'];
							//$biodata['alamat_wilayah']=$hasil_data['ALAMAT']." RT/RW ".$hasil_data['NO_RT']."/".$hasil_data['NO_RW'].", ".$hasil_data['KEL_NAME'].", ".$hasil_data['KEC_NAME'];
							$xbiodata['alamat']=$val['ALAMAT'];
							$xbiodata['no_rt']=$val['NO_RT'];
							$xbiodata['no_rw']=$val['NO_RW'];
							$xbiodata['prop_name']=$val['PROP_NAME'];
							$xbiodata['kab_name']=$val['KAB_NAME'];
							$xbiodata['kec_name']=$val['KEC_NAME'];
							$xbiodata['kel_name']=$val['KEL_NAME'];
							$xbiodata['pendidikan']=$val['PDDK_AKH'];
							$xbiodata['pekerjaan']=$val['JENIS_PKRJN'];
							$xbiodata['no_kk']=$val['NO_KK'];
							$xbiodata['jenis_klmin']=$val['JENIS_KLMIN'];
							$xbiodata['warganegara']='WNI';
							$xbiodata['agama']=$val['AGAMA'];
							$xbiodata['stat_kwn']=$val['STATUS_KAWIN'];
							$xbiodata['kepala_kk']=$val['NAMA_KK'];
							$xbiodata['nama_ayah']=$val['NAMA_LGKP_AYAH'];
							$biodata['nama_ibu']=$val['NAMA_LGKP_IBU'];
							$xbiodata['golongan_darah']=$val['GOL_DARAH'];
							$xbiodata['no_kel']=$val['NO_KEL'];
							$xbiodata['no_kec']=$val['NO_KEC'];
							$xbiodata['no_kab']=$val['NO_KAB'];
							$xbiodata['no_prop']=$val['NO_PROP'];
							$xbiodata['stat_hbkel']=$val['STAT_HBKEL'];
							$xbiodata['no_akta_lhr']=$val['NO_AKTA_LHR'];
							$xbiodata['no_akta_kwn']=$val['NO_AKTA_KWN'];
							$xbiodata['tgl_kwn']=$val['TGL_KWN'];	
$this->save_biodata($xbiodata);						
}
						//$hasil_data = $data;

					}
		$biodata['total'] = $total;
		$biodata['content'] =  $hasil_data['content'];
		return  $biodata;
				
	}

    public function countRow($no_kk){
        $this->db->select('count(nik) as jumlah');
        $this->db->where('no_kk', $no_kk);
        $hasil=$this->db->get('tweb_penduduk');
        return $hasil;
    }

   	public function get_kk($nik){
       $this->db->select("id_kk");
       $this->db->where('nik', $nik);
       $query=$this->db->get('tweb_penduduk');
       if ($query->num_rows() > 0) {
         return $query->row()->no_kk;
     }
     return false;
    }

    public  function get_individu($nik){
            $this->db->select('*');
            $this->db->from('tweb_penduduk');
            $this->db->where('nik', $nik);
            return $this->db->get();
    }

	public function get_photo($id=0)
	{
	
		$nik = $id;
	

		$url = "http://10.34.1.254:9898/api/faces/".$nik;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);                                                                
        $hasil = curl_exec($ch);
	    if ($hasil === false)
        {
            echo curl_error($ch); 
        }
        { 
	
						$tmp = $hasil;
						$hasil_data = json_decode($hasil, true, 512);

						$hasil_data['json'] = $tmp;
					}

			
					curl_close($ch);
					
					if (!empty($hasil_data["RESPON"]))
					{
					$this->load->view('css/link');
			
						$this->load->view('v_respon');
					} else {
						$data = [];
						$total = 0;
						foreach($hasil_data['data'] as $val) {

						}
						//$hasil_data = $data;

					}
		$photo['content'] =  $hasil_data['data'];
		return  $photo;

				
	}


	public function save_biodata($biodata=0) {
		$log_id = $this->db->select('nik')->from('tweb_penduduk')->
				where('nik', $biodata['nik'])->
				limit(1)->get()->row()->nik;
			
		if($log_id) {
			$this->db->where('nik', $log_id);
			$this->db->update('tweb_penduduk',$biodata);
		} else {
			$this->db->insert('tweb_penduduk',$biodata);
		}

	}

	public function delete($id='')
	{
		$sql = "DELETE FROM tweb_penduduk WHERE nik = ?";
		$outp = $this->db->query($sql, array($id));

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	public function delete_all()
	{
		$id_cb = $_POST['id_cb'];

		if (count($id_cb))
		{
			foreach ($id_cb as $id)
			{
				$sql = "DELETE FROM tweb_penduduk WHERE nik = ?";
				$outp = $this->db->query($sql, array($id));
			}
		}
		else $outp = false;

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}





}
