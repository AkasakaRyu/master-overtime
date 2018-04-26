<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class MOutput extends CI_Model {

	protected $table = array(
														'ak_barang',
														'ak_data_permintaan',
														'ak_data_output'
													);

	public function GetData() {
		$res = $this->db->select($this->table[1].'.*,'.$this->table[2].'.*,'.$this->table[0].'.Kode_barang,'.$this->table[0].'.Nama_barang')
										->join($this->table[0],$this->table[0].'.Id_barang='.$this->table[1].'.Id_barang')
										->join($this->table[2],$this->table[1].'.Id_d_permintaan='.$this->table[2].'.Id_d_permintaan')
										->get($this->table[1]);
		return $res->result();
	}

	public function GetBarang() {
		$res = $this->db->where('Jenis_barang','Bahan Jadi')->order_by('Kode_barang','ASC')->get($this->table[0]);
		return $res->result();
	}

	public function GetPermintaan() {
		$res = $this->db->get($this->table[1]);
		return $res->result();
	}

	public function SaveData() {
		$a = $this->input->post('permintaan');
		$b = $this->input->post('output');
		$data = array(
									'Id_d_permintaan' => $a,
									'Output' => $b
								 );
		$this->db->insert($this->table[2],$data);
		return "success-Data ".$a." Telah Tersimpan!";
	}

	public function EditSetting($id) {
		$a = $this->input->post('Output_min');
		$b = $this->input->post('Output_max');
		$c = $this->input->post('usr');
		//$d = $this->input->post('pwd');
		$data = array(
									'Output_Min' => $a,
									'Output_Max' => $b
								 );
		$this->db->where('Id_barang',$id)
						 ->update($this->table[0],$data);
		return "success-Data ".$a." Telah Tersimpan!";
	}

	public function EditData($id) {
		$a = $this->input->post('Output');
		$data = array(
									'Output' => $a
								 );
		$this->db->where('Id_barang',$id)
						 ->update($this->table[0],$data);
		return "success-Data ".$a." Telah Tersimpan!";
	}

	public function HapusData($id) {
		$this->db->where('Id_d_output',$id)
						 ->delete($this->table[0],$data);
		return "success-Data ".$a." Telah Tersimpan!";
	}

	public function Validate($id) {
		$data = array(
									'Status' => 'Validate'
								 );
		$this->db->where('Id_d_output',$id)
						 ->update($this->table[2],$data);
		return "success-Data Output Telah Disetujui!";
	}

}