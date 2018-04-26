<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Portal extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MPortal');
		if($this->session->userdata('isLogin')!=NULL) :
			redirect('dashboard','refresh');
		endif;
	}

	public function index() {
		$data['Title'] = 'Portal';
		$this->load->view('Login',$data);
	}

	public function proses_login() {
		$u = $this->input->post('usr');
		$p = $this->input->post('pwd');
		if ($res = $this->MPortal->ceklog($u,$p)) {
			$x = $this->MPortal->datauser($u);
			foreach ($x->result() as $x) :
				$newdata = array(
													'kode' => $x->Id_user,
													'nama' => $x->Nama_karyawan,
													'user' => $x->Username,
													'level' => $x->Bagian,
													'created' => $x->Created_Date,
													'isLogin' => TRUE
												);
				$this->session->set_userdata($newdata);
				if($this->session->userdata('level')=="System Administrator") {
					redirect('dashboard','refresh');
				} elseif($this->session->userdata('level')=="Admin Produksi") {
					redirect('dashboard/admin-produksi','refresh');
				} elseif($this->session->userdata('level')=="Kepala Produksi") {
					redirect('dashboard/kepala-produksi','refresh');
				} elseif($this->session->userdata('level')=="Admin Gudang") {
					redirect('dashboard/admin-gudang');
				} elseif($this->session->userdata('level')=="Quality Control") {
					redirect('dashboard/quality-control');
				} elseif($this->session->userdata('level')=="Operator") {
					redirect('dashboard/operator');
				}
			endforeach;
		} else { 
			$this->session->set_flashdata('item', 'danger-Username atau Password tidak cocok.');
					redirect('portal');
		}
	}

}