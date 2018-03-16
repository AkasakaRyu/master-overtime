<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Output extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MOutput');
		if($this->session->userdata('level')!="System Administrator" AND $this->session->userdata('level')!="Admin Produksi" AND $this->session->userdata('level')!="Kepala Produksi" AND $this->session->userdata('level')!="Quality Control") :
			redirect('portal','refresh');
		endif;
	}

	public function index() {
		$data['Title'] = 'Data Output';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Output'] = $this->MOutput->GetBarang();
		$data['Permintaan'] = $this->MOutput->GetPermintaan();
		$data['Konten'] = 'Output/V_Output';
		$this->load->view('Master',$data);
	}

	public function output_validate() {
		$data['Title'] = 'Data Output';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Output'] = $this->MOutput->GetData();
		$data['Permintaan'] = $this->MOutput->GetPermintaan();
		$data['Konten'] = 'Output/V_Output_Validate';
		$this->load->view('Master',$data);
	}

	public function setting() {
		$data['Title'] = 'Setting Output';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Output'] = $this->MOutput->GetBarang();
		$data['Konten'] = 'Output/V_Output_Setting';
		$this->load->view('Master',$data);
	}

	public function edit_setting($id) {
		$x = $this->MOutput->EditSetting($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('Output/setting');
	}

	public function tambah_data() {
		$x = $this->MOutput->SaveData();
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('Output');
	}

	public function edit_data($id) {
		$x = $this->MOutput->EditData($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('Output');
	}

	public function validate($id) {
		$x = $this->MOutput->Validate($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('output');
	}

}