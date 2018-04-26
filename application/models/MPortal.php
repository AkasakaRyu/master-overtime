<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MPortal extends CI_Model {

	protected $table = 'ak_user';

	public function ceklog($u,$p) {
		$x = $this->db->select('Username,Password')
				 	  ->from($this->table)
				 	  ->where(array('Username' => ''.$u.''))
				 	  ->get()->row('Password');
		return $this->verifikasi($p,$x);
	}

	public function datauser($u) {
		$x = $this->db->select('*')
					  ->from($this->table)
					  ->where(array('Username' => ''.$u.''))
					  ->get();
		return $x;
	}

	private function verifikasi($password,$hash) {
		return password_verify($password, $hash);
	}

}