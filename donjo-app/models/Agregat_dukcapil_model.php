<?php class Agregat_dukcapil_model extends CI_Model {

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

	public function get_agregat($kategori=0, $tahun=0, $semester=0)
	{

		$data = $this->get_data_desa();
	
		$kodeProp = intval($data['kode_propinsi']);
		$kodeKab = intval($data['kode_kabupaten']);
		$kodeKec = intval($data['kode_kecamatan']);
		$kodeKel = intval($data['kode_desa']);
		$urlDwhAgregat = $this->config->item('url_dwh_agregat');

		$url = $urlDwhAgregat.'/api/kategori/'.$kategori.'?tahun='.$tahun.'&semester='.$semester.'&noProp='.$kodeProp.'&noKab='.$kodeKab.'&noKec='.$kodeKec.'&noKel='.$kodeKel;
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
				
					return $hasil_data['json'] ;
					
				
	}

	public function save_agregat($biodata=0) {
		
			$this->db->insert('tweb_agregat',$biodata);
		

	}



}
