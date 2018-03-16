<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Permintaan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MPermintaan');
		if($this->session->userdata('level')!="System Administrator" AND $this->session->userdata('level')!="Admin Produksi" AND $this->session->userdata('level')!="Admin Gudang") :
			redirect('portal','refresh');
		endif;
	}

	public function index() {
		$data['Title'] = 'Data Permintaan';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Permintaan'] = $this->MPermintaan->GetData();
		$data['Konten'] = 'Permintaan/V_Permintaan';
		$this->load->view('Master',$data);
	}

	public function edit_data($id) {
			$x = $this->MPermintaan->EditData($id);
			$this->session->set_flashdata('item',$x);
			$this->session->keep_flashdata('item');
			redirect('Permintaan');
	}

}