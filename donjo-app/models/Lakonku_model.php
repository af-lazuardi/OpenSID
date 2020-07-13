<?php class Lakonku_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	
	public function get_data_desa()
	{
		$sql = "SELECT * FROM config WHERE 1";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function get_data_lakonku()
	{

		$data = $this->get_data_desa();
	
		$kodeProp = intval($data['kode_propinsi']);
		$kodeKab = intval($data['kode_kabupaten']);
		$kodeKec = intval($data['kode_kecamatan']);
		$kodeKel = intval($data['kode_desa']);
		$urlLakonku = $this->config->item('url_lakonku');

		$url = $urlLakonku.'/api/kematian/getData?noKec='.$kodeKec.'&noKel='.$kodeKel;
		//$url = 'http://10.34.1.254:9991/api/kematian/getData?noKec=5&noKel=2004';

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
					//echo $hasil_data['json'];
					return $hasil_data['json'] ;
					
				
	}

	public function get_detail($nik=0)
	{

		$data = $this->get_data_desa();
	
	
		$urlLakonku = $this->config->item('url_lakonku');

		$url = $urlLakonku.'/api/kematian/getDetail?nik='.$nik;
	
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
					//echo $hasil_data['json'];
					return $hasil_data['json'] ;
					
				
	}

	public function verifikasi($nik=0)
	{
		
		$urlLakonku = $this->config->item('url_lakonku');

		$url = $urlLakonku.'/api/kematian/getDetail?nik='.$nik;
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
					//echo $hasil_data['json'];
					return $hasil_data['json'] ;
					
	}


}
