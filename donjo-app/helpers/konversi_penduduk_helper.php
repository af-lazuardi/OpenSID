<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function get_penduduk_raw($nik)
{
	$CI =& get_instance();


	$url = $CI->config->item('url_dwh');
    $instansi = $CI->config->item('instansi');
    $metode = $CI->config->item('metode');
	$nik = $nik;
	$userDwh = $CI->config->item('usename_dwh');
	$passwordDwh = $CI->config->item('password_dwh');

    $data = array(
        "nik" => $nik,
        "user_id" => $userDwh,
        "password" => $passwordDwh,
		"instansi" => $instansi
    );

	
    $data_string = json_encode($data);
	$url = $url."/".$instansi."/".$metode;
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


    if ($hasil === false) {
        return curl_error($ch); 
    } else {
    	$ret = json_decode($hasil, true);

    	return $ret;
    }
}

function get_penduduk($nik) {

	$CI =& get_instance();

	$url = $CI->config->item('url_dwh');
    $instansi = $CI->config->item('instansi');
    $metode = $CI->config->item('metode');
	$nik = $nik;
	$userDwh = $CI->config->item('usename_dwh');
	$passwordDwh = $CI->config->item('password_dwh');

    $data = array(
        "nik" => $nik,
        "user_id" => $userDwh,
        "password" => $passwordDwh,
		"instansi" => $instansi
    );

	
    $data_string = json_encode($data);
	$url = $url."/".$instansi."/".$metode;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',                                                                                
		'Content-Length: ' . strlen($data_string))                                                                       
	); 
    $respon_nik = curl_exec($ch);


    if ($respon_nik === false) {
        return curl_error($ch); 
    } else {
    	$ret = json_decode($respon_nik, true);

    	$response_code = $ret['content'][0]['RESPONSE_CODE'];

    	if (empty($response_code)) {

	    	$hasil = $ret['content'][0];
	    	$nik_kepala_kk = $hasil['NO_KK'];
	    	$nik = $hasil['NIK'];

			// insert ke db jika belum ada 
			$CI->db->where('nik', $nik);
			$CI->db->select('nik, id');
			$get_sudah_ada = $CI->db->get('tweb_penduduk');

    		$id_cluster = 0;

    		// insert tabel kk
    		// cek dulu
    		$CI->db->where('no_kk', $hasil['NO_KK']);
    		$CI->db->select('no_kk, id');
    		$get_kk_ada = $CI->db->get('tweb_keluarga');


    		if ($get_kk_ada->num_rows() < 1) {
    			$CI->db->insert('tweb_keluarga', [
    				'no_kk'=>$hasil['NO_KK'],
    				'tgl_daftar'=>date('Y-m-d H:i:s'),
    				'id_cluster'=>$id_cluster,
    			]);
    			$id_kk = $CI->db->insert_id();
    		} else {
    			$get_kk = $get_kk_ada->row_array();
    			$id_kk = $get_kk['id'];
    		}

    		// cek jika KEPALA KELUARGA
    		if ($hasil['STAT_HBKEL'] == "KEPALA KELUARGA") {
    			$CI->db->where('id', $id_kk);
    			$CI->db->update('tweb_keluarga', [
    				'nik_kepala'=>$nik,
    			]);
    		}

    		$interval = date_diff(date_create(), date_create($hasil['TGL_LHR']));
    		$usia_tahun = $interval->format("%Y");
    		$usia_bulan = $interval->format("%M");
    		$usia_hari = $interval->format("%d");

	    	$data_penduduk = [
				'nama'=>$hasil['NAMA_LGKP'],
				'nik'=>$hasil['NIK'],
				'id_kk'=>$id_kk,
				'sex'=>konversi_jk($hasil['JENIS_KLMIN']),
				'tempatlahir'=>$hasil['TMPT_LHR'],
				'tanggallahir'=>$hasil['TGL_LHR'],
				'agama_id'=>konversi_agama($hasil['AGAMA']),
				'pendidikan_kk_id'=>konversi_pendidikan($hasil['PDDK_AKH']),
				'pekerjaan_id'=>konversi_pekerjaan($hasil['JENIS_PKRJN']),
				'status_kawin'=>konversi_status_kawin($hasil['STATUS_KAWIN']),
				'nama_ayah'=>$hasil['NAMA_LGKP_AYAH'],
				'nama_ibu'=>$hasil['NAMA_LGKP_IBU'],
				'golongan_darah_id'=>konversi_gol_darah($hasil['GOL_DARAH']),
				'alamat_sekarang'=>$hasil['ALAMAT'],
				'created_by'=>1,
				'akta_lahir'=>$hasil['NO_AKTA_LHR'],
				'akta_lahir'=>$hasil['NO_AKTA_LHR'],
				'akta_lahir'=>$hasil['NO_AKTA_LHR'],
				'no_rt'=>$hasil['NO_RT'],
				'no_rw'=>$hasil['NO_RW'],
    			'kk_level'=>konversi_status_hubkel($hasil['STAT_HBKEL']),
    			'id_cluster'=>$id_cluster,
			];

			$hasil['usia_tahun'] = $usia_tahun;
    		$hasil['usia_bulan'] = $usia_bulan;
    		$hasil['usia_hari'] = $usia_hari;

	    	if ($get_sudah_ada->num_rows() < 1) {
	    		$CI->db->insert('tweb_penduduk', $data_penduduk);
	    		$id_didapat = $CI->db->insert_id();
	    		$type = "insert";
	    	} else {
	    		$CI->db->where('nik', $nik);
	    		$CI->db->update('tweb_penduduk', $data_penduduk);

	    		$get_id_penduduk = $get_sudah_ada->row_array();
	    		$id_didapat = $get_id_penduduk['id'];
	    		$type = "update";
	    	}


	    	return [
	    		'detil_nik'=>$hasil,
	    		'id_penduduk_sistem'=>$id_didapat,
	    		'type'=>$type
	    	];
    	} else {
    		return false;
    	}
    }
}

function get_penduduk_lokal($nik) {

	$CI =& get_instance();


	$url = $CI->config->item('lokal_url_dwh');
    $instansi = $CI->config->item('lokal_instansi');
    $metode = $CI->config->item('lokal_metode');
	$userDwh = $CI->config->item('lokal_usename_dwh');
	$passwordDwh = $CI->config->item('lokal_password_dwh');

    $data = array(
        "nik" => $nik,
        "user_id" => $userDwh,
        "password" => $passwordDwh,
		"instansi" => $instansi
    );

	
    $data_string = json_encode($data);
	$url = $url."/".$instansi."/".$metode;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',                                                                                
		'Content-Length: ' . strlen($data_string))                                                                       
	); 
    $respon_nik = curl_exec($ch);


    $kembali = false;

    if ($respon_nik === false) {
        $kembali = curl_error($ch); 
    } else {
    	$ret = json_decode($respon_nik, true);


		$id_cluster = 0;


    	if (!empty($ret['content'][0]['NIK'])) {
    		foreach ($ret['content'] as $anggota_kk) {
    			$id_kk_ditemukan = $anggota_kk['NO_KK'];
    			$nik_ditemukan = $anggota_kk['NIK'];
    			$status_keluarga = $anggota_kk['STAT_HBKEL'];

    			$nik_kepala_kk = 0;
    			if ($status_keluarga == "KEPALA KELUARGA") {
    				$nik_kepala_kk = $nik_ditemukan;	
    			}

    			$CI->db->where('no_kk', $id_kk_ditemukan);
				$CI->db->select('no_kk, id');
				$get_kk_ada = $CI->db->get('tweb_keluarga');

				if ($get_kk_ada->num_rows() < 1) {
					$CI->db->insert('tweb_keluarga', [
						'no_kk'=>$id_kk_ditemukan,
						'nik_kepala'=>$nik_kepala_kk,
						'tgl_daftar'=>date('Y-m-d H:i:s'),
						'id_cluster'=>$id_cluster,
					]);
					$id_kk = $CI->db->insert_id();
					$kk_status = "insert KK";
				} else {
					$get_kk = $get_kk_ada->row_array();
					$id_kk = $get_kk['id'];
					$kk_status = "edit KK";
				}


    			$data_penduduk = [
					'nama'=>$anggota_kk['NAMA_LGKP'],
					'nik'=>$anggota_kk['NIK'],
					'id_kk'=>$id_kk,
					'sex'=>konversi_jk($anggota_kk['JENIS_KLMIN']),
					'tempatlahir'=>$anggota_kk['TMPT_LHR'],
					'tanggallahir'=>$anggota_kk['TGL_LHR'],
					'agama_id'=>konversi_agama($anggota_kk['AGAMA']),
					'pendidikan_kk_id'=>konversi_pendidikan($anggota_kk['PDDK_AKH']),
					'pekerjaan_id'=>konversi_pekerjaan($anggota_kk['JENIS_PKRJN']),
					'status_kawin'=>konversi_status_kawin($anggota_kk['STATUS_KAWIN']),
					'nama_ayah'=>$anggota_kk['NAMA_LGKP_AYAH'],
					'nama_ibu'=>$anggota_kk['NAMA_LGKP_IBU'],
					'golongan_darah_id'=>konversi_gol_darah($anggota_kk['GOL_DARAH']),
					'alamat_sekarang'=>$anggota_kk['ALAMAT'],
					'created_by'=>1,
					'akta_lahir'=>$anggota_kk['NO_AKTA_LHR'],
					'akta_lahir'=>$anggota_kk['NO_AKTA_LHR'],
					'akta_lahir'=>$anggota_kk['NO_AKTA_LHR'],
					'no_rt'=>$anggota_kk['NO_RT'],
					'no_rw'=>$anggota_kk['NO_RW'],
					'kk_level'=>konversi_status_hubkel($anggota_kk['STAT_HBKEL']),
					'id_cluster'=>$id_cluster,
				];


				// insert ke db jika belum ada 
				$CI->db->where('nik', $nik_ditemukan);
				$CI->db->select('nik, id');
				$get_sudah_ada = $CI->db->get('tweb_penduduk');

		    	if ($get_sudah_ada->num_rows() < 1) {
		    		$CI->db->insert('tweb_penduduk', $data_penduduk);
		    		$id_didapat = $CI->db->insert_id();
		    	} else {
		    		$CI->db->where('nik', $nik);
		    		$CI->db->update('tweb_penduduk', $data_penduduk);

		    		$get_id_penduduk = $get_sudah_ada->row_array();
		    		$id_didapat = $get_id_penduduk['id'];
		    	}

    			log_message('error', $nik_ditemukan." ID KK".$id_kk_ditemukan.", status kk".$kk_status);
    			log_message('error', "ID KK: ".$id_kk_ditemukan."\n");

    			if ($nik == $nik_ditemukan) {

			    	
			    	$kembali = [
			    		'detil_nik'=>$anggota_kk,
			    		'id_penduduk_sistem'=>$id_didapat
			    	];
			    } 
			    /*else {
			    	return [
			    		'detil_nik'=>null,
			    		'id_penduduk_sistem'=>null,
			    		'message'=>'NIK tidak ditemukan',
			    	];
			    }*/
    		}
    	} /*else {
	    	return [
	    		'detil_nik'=>null,
	    		'id_penduduk_sistem'=>null,
	    		'message'=>'Response tidak sesuai',
	    	];
    	}*/
		
    }

    return $kembali;
}

function konversi_jk($data) {
	$CI =& get_instance();

	$data = trim(str_replace(" ", "", $data));

	$CI->db->where("REPLACE(nama, ' ', '') = ", $data);
	$get_data = $CI->db->get('tweb_penduduk_sex')->row_array();

	if (!empty($get_data)) {
		return $get_data['id'];
	} else {
		return 0;
	}
}

function konversi_agama($data) {
	$CI =& get_instance();
	
	$data = trim(str_replace(" ", "", $data));

	$CI->db->where("REPLACE(nama, ' ', '') = ", $data);
	$get_data = $CI->db->get('tweb_penduduk_agama')->row_array();

	if (!empty($get_data)) {
		return $get_data['id'];
	} else {
		return 0;
	}
}

function konversi_pendidikan($data) {
	$CI =& get_instance();
	
	$data = trim(str_replace(" ", "", $data));

	$CI->db->where("REPLACE(nama, ' ', '') = ", $data);
	$get_data = $CI->db->get('tweb_penduduk_pendidikan_kk')->row_array();

	if (!empty($get_data)) {
		return $get_data['id'];
	} else {
		return 0;
	}
}

function konversi_pekerjaan($data) {
	$CI =& get_instance();
	
	$data = trim(str_replace(" ", "", $data));

	$CI->db->where("REPLACE(nama, ' ', '') = ", $data);
	$get_data = $CI->db->get('tweb_penduduk_pekerjaan')->row_array();


	if (!empty($get_data)) {
		return $get_data['id'];
	} else {
		return 0;
	}
}

function konversi_status_kawin($data) {
	$CI =& get_instance();
	
	$data = trim(str_replace(" ", "", $data));

	$CI->db->where("REPLACE(nama, ' ', '') = ", $data);
	$get_data = $CI->db->get('tweb_penduduk_kawin')->row_array();

	if (!empty($get_data)) {
		return $get_data['id'];
	} else {
		return 0;
	}
}

function konversi_gol_darah($data) {
	$CI =& get_instance();
	$data = trim(str_replace(" ", "", $data));

	$CI->db->where("REPLACE(nama, ' ', '') = ", $data);
	$get_data = $CI->db->get('tweb_golongan_darah')->row_array();

	if (!empty($get_data)) {
		return $get_data['id'];
	} else {
		return 0;
	}
}

function konversi_status_hubkel($data) {
	$CI =& get_instance();
	$data = trim(str_replace(" ", "", $data));

	$CI->db->where("REPLACE(nama, ' ', '') = ", $data);
	$get_data = $CI->db->get('tweb_penduduk_hubungan')->row_array();

	if (!empty($get_data)) {
		return $get_data['id'];
	} else {
		return 0;
	}
}

function get_foto($nik) {
	$url = "http://10.34.1.254:9898/api/faces/".$nik;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);                                                                
    $hasil = curl_exec($ch);

    return json_decode($hasil, true);
}

function hitung_umur($tanggal_lahir){
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) { 
	    exit("0 tahun 0 bulan 0 hari");
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	return $y." tahun ".$m." bulan ".$d." hari";
}

function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp ); 

    return $output_file; 
}