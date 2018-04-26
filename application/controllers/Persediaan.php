<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Persediaan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MPersediaan');
		if($this->session->userdata('level')!="System Administrator" AND $this->session->userdata('level')!="Admin Gudang" AND $this->session->userdata('level')!="Admin Produksi") :
			redirect('portal','refresh');
		endif;
	}

	public function index() {
		$data['Title'] = 'Data Persediaan';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Persediaan'] = $this->MPersediaan->GetData();
		$data['Konten'] = 'Persediaan/V_Persediaan';
		$this->load->view('Master',$data);
	}

	public function setting() {
		$data['Title'] = 'Setting Persediaan';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Persediaan'] = $this->MPersediaan->GetBarang();
		$data['Konten'] = 'Persediaan/V_Persediaan_Setting';
		$this->load->view('Master',$data);
	}

	public function barang() {
		$data['Title'] = 'Data Barang';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Barang'] = $this->MPersediaan->GetBarang();
		$data['Konten'] = 'Persediaan/V_Barang';
		$this->load->view('Master',$data);
	}

	public function bahan_baku() {
		$data['Title'] = 'Data Bahan Baku';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Barang'] = $this->MPersediaan->GetBahan();
		$data['Supplier'] = $this->MPersediaan->GetSup();
		$data['Konten'] = 'Persediaan/V_Bahan_Baku';
		$this->load->view('Master',$data);
	}

	public function report() {
		$data['Title'] = 'Report Gudang';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Barang'] = $this->MPersediaan->GetBahan();
		$data['Total'] = $this->MPersediaan->GetTotBahan();
		$data['TotalS'] = $this->MPersediaan->GetTotSBahan();
		$data['TotalW'] = $this->MPersediaan->GetTotWBahan();
		$data['Konten'] = 'Persediaan/V_Report_Gudang';
		$this->load->view('Master',$data);
	}

	public function produksi_hari_ini() {
		$data['Title'] = 'Data Produksi';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Barang'] = $this->MPersediaan->GetBarang();
		$data['Produksi'] = $this->MPersediaan->GetProduksi();
		$data['Konten'] = 'Persediaan/V_Produksi';
		$this->load->view('Master',$data);
	}

	public function tambah_produksi() {
		$x = $this->MPersediaan->SaveProduksi();
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan/produksi-hari-ini');
	}

	public function edit_produksi($id) {
		$x = $this->MPersediaan->EditProduksi($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan/produksi-hari-ini');
	}

	public function hapus_produksi($id) {
		$x = $this->MPersediaan->HapusProduksi($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan/produksi-hari-ini');
	}

	public function tambah_bahan() {
		$x = $this->MPersediaan->SaveBahan();
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan/bahan-baku');
	}

	public function edit_bahan($id) {
		$x = $this->MPersediaan->EditBahan($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan/bahan-baku');
	}

	public function hapus_bahan($id) {
		$x = $this->MPersediaan->HapusBahan($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan/bahan-baku');
	}

	public function tambah_data() {
		$x = $this->MPersediaan->SaveData();
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan/barang');
	}

	public function edit_data($id) {
		$x = $this->MPersediaan->EditData($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan/barang');
	}

	public function hapus_data($id) {
		$x = $this->MPersediaan->HapusData($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan/barang');
	}

	public function update_persediaan($id) {
		$x = $this->MPersediaan->UpdatePersediaan($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan');
	}

	public function update_setting($id) {
		$x = $this->MPersediaan->UpdateSetting($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('persediaan/setting');
	}

}