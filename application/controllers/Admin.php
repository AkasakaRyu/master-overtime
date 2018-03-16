<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MAdmin');
		if($this->session->userdata('level')!="System Administrator") :
			redirect('portal','refresh');
		endif;
	}

	public function index() {
		$data['Title'] = 'Data Karyawan';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Karyawan'] = $this->MAdmin->GetKaryawan();
		$data['Konten'] = 'Admin/V_Karyawan';
		$this->load->view('Master',$data);
	}

	public function tambah_data() {
		$x = $this->MAdmin->SaveData();
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('admin');
	}

	public function edit_data($id) {
		$x = $this->MAdmin->EditData($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('admin');
	}

	public function hapus_data($id) {
		$x = $this->MAdmin->HapusData($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('admin');
	}

}