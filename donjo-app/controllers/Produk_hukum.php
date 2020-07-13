<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_hukum extends CI_Controller {
    // public function index() {
    //     j(["success"=>true,"message"=>"API SID berjalan"]);
    // }

    public function index($id)
    {
        // $where = array('id' => $id);
        // $url = 'http://tawangsari-pengasih.desa.id/index.php/Api_perdes/get_perdes';
        $this->db->where('kategori', 4);
        $json_data = $this->db->get('dokumen')->result();
            $arr = array();
            foreach ($json_data as $result) {
                $j = json_decode($result->attr);
                $keterangan = $j->uraian;
                $no_ditetapkan = $j->no_ditetapkan;
                $tahun_ditetapkan = $j->tahun_ditetapkan;
            $arr[] = array(
                   'file' => $result->satuan,
                   'judul' => $result->nama,
                   'keterangan' => $keterangan,
                   'no_ditetapkan' => $no_ditetapkan,
                   'tahun_ditetapkan' => $tahun_ditetapkan
                    );
            }
        $data = json_encode($arr);
        echo "{" . $data . "}";
        // echo "{\"perdes\":" . $data . "}";
    }
   
}