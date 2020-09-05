<?php 
class Surat_masuk_suratku_model extends CI_Model {
    // Konfigurasi untuk library 'upload'
    protected $uploadConfig = array();

    public function __construct() {
        parent::__construct();
        $this->uri_suratku = 'http://192.168.167.14/index.php/surat_desa/';
    }

    public function get_dashboard($username) {
        /*
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
        ];

        $ch = curl_init($this->uri_suratku.'get_dashboard');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode != 200) {
            return false;
        } else {
            return json_decode($response, true);
        }*/
        return false;
    }

    public function get_list_surat_masuk($username) {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
        ];

        $ch = curl_init($this->uri_suratku.'get_list_surat');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode != 200) {
            return false;
        } else {
            return json_decode($response, true);
        }
    }

    public function get_list_surat_masuk_detil($username, $params) {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
            'id_surat'=>$params['id_surat'],
            'penerima_id_instansi'=>$params['penerima_id_instansi'],
            'penerima_id_user'=>$params['penerima_id_user'],
        ];

        $ch = curl_init($this->uri_suratku.'get_detil_surat');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode != 200) {
            return false;
        } else {
            return json_decode($response, true);
        }
    }

    public function set_status_baca($username, $params) {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
            'id_surat'=>$params['id_surat'],
            'penerima_id_instansi'=>$params['penerima_id_instansi'],
            'penerima_id_user'=>$params['penerima_id_user'],
        ];

        $ch = curl_init($this->uri_suratku.'set_status_baca');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode != 200) {
            return $response;
        } else {
            return json_decode($response, true);
        }
    }

    public function set_status_berinomor($username, $params) {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
            'id_surat'=>$params['id_surat'],
            'penerima_id_instansi'=>$params['penerima_id_instansi'],
            'penerima_id_user'=>$params['penerima_id_user'],
        ];

        $ch = curl_init($this->uri_suratku.'set_status_berinomor');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode != 200) {
            return false;
        } else {
            return json_decode($response, true);
        }
    }


    public function insert()
    {
        // Ambil semua data dari var. global $_POST
        $data = $this->input->post(NULL);
        unset($data['mdl_detil_surat_id_surat']);
        unset($data['mdl_detil_surat_penerima_id_instansi']);
        unset($data['mdl_detil_surat_penerima_id_user']);

        // file_put_contents("Tmpfile.zip", fopen("http://someurl/file.zip", 'r'));

        // Berkas lampiran
        // $data['berkas_scan'] = ;

        // penerapan transcation karena insert ke 2 tabel
        $this->db->trans_start();

        // $indikatorSukses = is_null($uploadError) && $this->db->insert('surat_masuk', $data);
        $indikatorSukses = $this->db->insert('surat_masuk', $data);

        $insert_id = $this->db->insert_id();

        // insert ke tabel disposisi surat masuk
        // $this->insert_disposisi_surat_masuk($insert_id, $jabatan);

        // transaction selesai
        $this->db->trans_complete();

        // set status sudah diberi nomor..

        $ret = [
            'success' => $indikatorSukses,
            'message' => "Surat berhasil disimpan", 
        ];
        return $ret;

        // Set session berdasarkan hasil operasi
        // $_SESSION['success'] = $indikatorSukses ? 1 : -1;
        // $_SESSION['error_msg'] = $_SESSION['success'] === 1 ? NULL : ' -> '.$uploadError;
    }
}

?>
