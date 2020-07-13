<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_download extends CI_Model
{
     function download($id){
		$query = $this->db->get_where('dokumen',array('id'=>$id));
		return $query->row_array();
	 }
}