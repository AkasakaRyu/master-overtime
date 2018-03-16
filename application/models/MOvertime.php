<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Movertime extends CI_Model {

	protected $table = array(
														'ak_barang',
														'ak_data_permintaan',
														'ak_data_overtime'
													);

	public function GetData() {
		$res = $this->db->where('Jenis_barang','Bahan Jadi')->order_by('Kode_barang','ASC')->get($this->table[0]);
		return $res->result();
	}
	
	public function GetOvertimeMinMax() {
	    $res = $this->db->get($this->table[0]);
	    return $res->row();
	}

	public function GetDataOvertime() {
		$res = $this->db->Select($this->table[2].'.*,'.
								 $this->table[1].'.Id_d_permintaan,'.
								 $this->table[1].'.Tanggal,'.
								 $this->table[0].'.*')
						->join($this->table[1],$this->table[1].'.Id_d_permintaan='.$this->table[2].'.Id_d_permintaan')
						->join($this->table[0],$this->table[0].'.Id_barang='.$this->table[1].'.Id_barang')
						->order_by('Id_d_lembur','DESC')
						->get($this->table[2]);
		return $res->result();
	}

	public function GetDataOvertimeQC() {
		$res = $this->db->where('Status','ACC')
										->join($this->table[1],$this->table[1].'.Id_d_permintaan='.$this->table[2].'.Id_d_permintaan')
										->join($this->table[0],$this->table[0].'.Id_barang='.$this->table[1].'.Id_barang')
										->get($this->table[2]);
		return $res->result();
	}

	public function GetDataProduksi() {
		$res = $this->db->join($this->table[1],$this->table[1].'.Id_d_permintaan='.$this->table[2].'.Id_d_permintaan')
										->join($this->table[0],$this->table[0].'.Id_barang='.$this->table[1].'.Id_barang')
										->get($this->table[2]);
		return $res->result();
	}

	public function Setujui($id) {
		$data = array(
									'Status' => 'ACC'
								 );
		$this->db->where('Id_d_lembur',$id)
						 ->update($this->table[2],$data);
		return "success-Data Overtime Telah Terupdate!";
	}

	public function UpHasil($id) {
		$data = array(
									'O_Hasil' => $this->input->post('hasil')
								 );
		$this->db->where('Id_d_lembur',$id)
						 ->update($this->table[2],$data);
		return "success-Data Overtime Telah Terupdate!";
	}

	public function EditData($id) {
		$a = $this->input->post('overtime_max');
		$b = $this->input->post('overtime_min');
		$data = array(
									'Overtime_Max' => $a,
									'Overtime_Min' => $b
								 );
		$this->db->where('Id_barang',$id)
						 ->update($this->table[0],$data);
		return "success-Data Overtime Telah Terupdate!";
	}

}