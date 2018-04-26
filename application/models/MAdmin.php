<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class MAdmin extends CI_Model {

	protected $table = array(
								'ak_user'
							);

	public function GetKaryawan() {
		$res = $this->db->get($this->table);
		return $res->result();
	}

	public function SaveData() {
		$a = $this->input->post('nama');
		$b = $this->input->post('bagian');
		$c = $this->input->post('usr');
		$d = $this->input->post('pwd');
		$data = array(
						'Nama_karyawan' => $a,
						'Bagian' => $b,
						'Username' => $c,
						'Password' => $this->hash_pwd($d)
					 );
		$this->db->insert($this->table[0],$data);
		return "success-Data ".$a." Telah Tersimpan!";
	}

	public function EditData($id) {
		$a = $this->input->post('nama');
		$b = $this->input->post('bagian');
		$c = $this->input->post('usr');
		$d = $this->input->post('pwd');
		$data = array(
						'Nama_karyawan' => $a,
						'Bagian' => $b,
						'Username' => $c,
						'Password' => $this->hash_pwd($d)
					 );
		$this->db->where('Id_user',$id)
						 ->update($this->table[0],$data);
		return "success-Data ".$a." Telah Tersimpan!";
	}

	public function HapusData($id) {
		$this->db->where('Id_user',$id)
				 ->delete($this->table[0]);
		return "success-Data Telah Terhapus!";
	}

	private function hash_pwd($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}

}