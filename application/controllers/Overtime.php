<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Overtime extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MOvertime');
		$this->load->model('MPersediaan');
		if($this->session->userdata('level')!="System Administrator" AND $this->session->userdata('level')!="Admin Produksi" AND $this->session->userdata('level')!="Kepala Produksi" AND $this->session->userdata('level')!="Quality Control") :
			redirect('portal','refresh');
		endif;
	}

	public function index() {
		$data['Title'] = 'Data Overtime';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Overtime'] = $this->MOvertime->GetData();
		$data['Konten'] = 'Overtime/V_Overtime';
		$this->load->view('Master',$data);
	}

	public function report() {
		$data['Title'] = 'Report';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Overtime'] = $this->MOvertime->GetDataOvertime();
		$data['Konten'] = 'Overtime/V_Report';
		$this->load->view('Master',$data);
	}

	public function report_produksi() {
		$data['Title'] = 'Report';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Produksi'] = $this->MPersediaan->GetProduksi();
		$data['Konten'] = 'Overtime/V_Report_Produksi';
		$this->load->view('Master',$data);
	}

	public function setujui($id) {
		$x = $this->MOvertime->Setujui($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('dashboard/kepala-produksi');
	}

	public function update_hasil($id) {
		$x = $this->MOvertime->UpHasil($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('overtime/report');
	}

	public function edit_data($id) {
		$x = $this->MOvertime->EditData($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('overtime');
	}

}