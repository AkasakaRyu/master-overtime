<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MAdmin');
		$this->load->model('MOvertime');
		$this->load->model('MPersediaan');
		$this->load->model('MOrder');
		if($this->session->userdata('isLogin')==NULL) :
			redirect('portal','refresh');
		endif;
	}

	public function index() {
		$data['Title'] = 'Dashboard';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Karyawan'] = $this->MAdmin->GetKaryawan();
		$data['Konten'] = 'Dashboard/V_Dashboard_Admin';
		$this->load->view('Master',$data);
	}

	public function admin_produksi() {
		$data['Title'] = 'Dashboard';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Overtime'] = $this->MOvertime->GetOvertimeMinMax();
		$data['Order'] = $this->MOrder->GetDataProduksi();
		$data['Barang'] = $this->MOrder->GetBarang();
		$data['Konten'] = 'Dashboard/V_Dashboard_Admin_Produksi';
		$this->load->view('Master',$data);
	}
	
	public function admin_gudang() {
		$data['Title'] = 'Dashboard';
		$data['Nama'] = $this->session->userdata('nama');
		$data['Level'] = $this->session->userdata('level');
		$data['Persediaan'] = $this->MPersediaan->GetPersediaanMinMax();
		$data['Barang'] = $this->MPersediaan->GetBarang();
		$data['Konten'] = 'Dashboard/V_Dashboard_Gudang';
		$this->load->view('Master',$data);
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('portal','refresh');
	}

}