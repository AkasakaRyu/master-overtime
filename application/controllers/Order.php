<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MOrder');
		if($this->session->userdata('level')!="System Administrator" AND $this->session->userdata('level')!="Admin Produksi" AND $this->session->userdata('level')!="Admin Gudang") :
			redirect('portal','refresh');
		endif;
	}

	public function index() {
		$data['Title'] = 'Data Order';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Order'] = $this->MOrder->GetData();
		$data['Barang'] = $this->MOrder->GetBarang();
		$data['Customer'] = $this->MOrder->GetCust();
		$data['Konten'] = 'Order/V_Order';
		$this->load->view('Master',$data);
	}

	public function tambah_data() {
		$x = $this->MOrder->SaveData();
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('Order');
	}

	public function send_order($id) {
		$x = $this->MOrder->Send($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	public function proses_order($id) {
		$x = $this->MOrder->Proses($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	public function edit_data($id) {
		$x = $this->MOrder->EditData($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('Order');
	}

	public function hapus_data($id) {
		$x = $this->MOrder->HapusData($id);
		$this->session->set_flashdata('item',$x);
		$this->session->keep_flashdata('item');
		redirect('Order');
	}

}