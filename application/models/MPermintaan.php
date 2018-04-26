<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class MPermintaan extends CI_Model {

	protected $table = array(
														'ak_barang',
														'ak_data_permintaan',
														'ak_data_output',
														'ak_data_persediaan',
														'ak_data_overtime'
													);

	public function GetData() {
		$res = $this->db->where('Jenis_barang','Bahan Jadi')->order_by('Kode_barang','ASC')->get($this->table[0]);
		return $res->result();
	}

	public function EditData($id) {
		$a = $this->input->post('Permintaan_max');
		$b = $this->input->post('Permintaan_min');
		$data = array(
									'Permintaan_Max' => $a,
									'Permintaan_Min' => $b
								 );
		$this->db->where('Id_barang',$id)
						 ->update($this->table[0],$data);
		return "success-Data Permintaan Telah Terupdate!";
	}

}