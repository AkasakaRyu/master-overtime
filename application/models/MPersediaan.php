<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class MPersediaan extends CI_Model {

	protected $table = array(
														'ak_barang',
														'ak_data_permintaan',
														'ak_data_persediaan',
														'ak_data_produksi',
														'ak_data_supplier'
													);
													
    public function GetPersediaanMinMax() {
        $res = $this->db->get($this->table[0]);
        return $res->row();
    }

	public function GetData() {
		$res = $this->db->join($this->table[1],$this->table[0].'.Id_barang='.$this->table[1].'.Id_barang')
										->join($this->table[2],$this->table[2].'.Id_d_permintaan='.$this->table[1].'.Id_d_permintaan')
										->order_by($this->table[1].'.Id_d_permintaan','DESC')
										->get($this->table[0]);
		return $res->result();
	}

	public function GetBarang() {
		$res = $this->db->where('Jenis_barang','Bahan Jadi')->order_by('Id_barang','ASC')->get($this->table[0]);
		return $res->result();
	}

	public function GetTotBahan() {
		$res = $this->db->select_sum('Jumlah_barang')->where('Jenis_barang','Bahan Baku')->order_by('Kode_barang','ASC')->get($this->table[0]);
		return $res->row();
	}

	public function GetTotSBahan() {
		$res = $this->db->select_sum('Jumlah_barang')
										->where('Jenis_barang','Bahan Baku')
										->where('Nama_barang','Weast Spinning')
										->order_by('Kode_barang','ASC')
										->get($this->table[0]);
		return $res->row();
	}

	public function GetTotWBahan() {
		$res = $this->db->select_sum('Jumlah_barang')
										->where('Jenis_barang','Bahan Baku')
										->where('Nama_barang','Weast Wiping')
										->order_by('Kode_barang','ASC')
										->get($this->table[0]);
		return $res->row();
	}

	public function GetBahan() {
		$res = $this->db->where('Jenis_barang','Bahan Baku')
										->order_by('Id_barang','ASC')
										->get($this->table[0]);
		return $res->result();
	}

	public function GetSup() {
		$res = $this->db->get($this->table[4]);
		return $res->result();
	}

	public function GetProduksi() {
		$res = $this->db->join($this->table[0],$this->table[0].'.Id_barang='.$this->table[3].'.Id_barang')
										->order_by('Id_d_produksi','DESC')
										->get($this->table[3]);
		return $res->result();
	}

	public function SaveProduksi() {
		$a = $this->input->post('Tanggal');
		$b = $this->input->post('Jumlah_Produksi');
		$c = $this->input->post('Jumlah_Overtime');
		$d = $this->input->post('nama_barang');
		$data = array(
									'Tanggal_produksi' => $a,
									'Jumlah_produksi' => $b,
									'Jumlah_overtime' => $c,
									'id_barang' => $d
								 );
		$this->db->insert($this->table[3],$data);
		return "success-Data ".$b." Telah Tersimpan!";
	}

	public function EditProduksi($id) {
		$a = $this->input->post('Tanggal');
		$b = $this->input->post('Jumlah_Produksi');
		$c = $this->input->post('Jumlah_Overtime');
		$data = array(
									'Tanggal_produksi' => $a,
									'Jumlah_produksi' => $b,
									'Jumlah_overtime' => $c
								 );
		$this->db->where('Id_d_produksi',$id)
						 ->update($this->table[3],$data);
		return "success-Data ".$a." Telah Tersimpan!";
	}

	public function HapusProduksi($id) {
		$this->db->where('Id_d_produksi',$id)
						 ->delete($this->table[3]);
		return "success-Data Telah Dihapus!";
	}

	public function SaveBahan() {
		$a = $this->input->post('penjual');
		$b = $this->input->post('nama');
		$c = $this->input->post('jumlah');
		$data = array(
									'Tanggal' => date('Y-m-d'),
									'Penjual' => $a,
									'Nama_barang' => $b,
									'Jumlah_barang' => $c,
									'Jenis_barang' => "Bahan Baku"
								 );
		$this->db->insert($this->table[0],$data);
		return "success-Data ".$b." Telah Tersimpan!";
	}

	public function EditBahan($id) {
		$a = $this->input->post('penjual');
		$b = $this->input->post('nama');
		$c = $this->input->post('jumlah');
		$data = array(
									'Penjual' => $a,
									'Nama_barang' => $b,
									'Jumlah_barang' => $c,
									'Jenis_barang' => "Bahan Baku"
								 );
		$this->db->where('Id_barang',$id)
						 ->update($this->table[0],$data);
		return "success-Data ".$a." Telah Tersimpan!";
	}

	public function HapusBahan($id) {
		$this->db->where('Id_barang',$id)
						 ->delete($this->table[0]);
		return "success-Data Telah Dihapus!";
	}

	public function SaveData() {
		$a = $this->input->post('kd_brg');
		$b = $this->input->post('nama');
		$data = array(
									'Kode_barang' => $a,
									'Nama_barang' => $b,
									'Jenis_barang' => "Bahan Jadi"
								 );
		$this->db->insert($this->table[0],$data);
		return "success-Data ".$b." Telah Tersimpan!";
	}

	public function EditData($id) {
		$a = $this->input->post('kd_brg');
		$b = $this->input->post('nama');
		$data = array(
									'Kode_barang' => $a,
									'Nama_barang' => $b,
									'Jenis_barang' => "Bahan Jadi"
								 );
		$this->db->where('Id_barang',$id)
						 ->update($this->table[0],$data);
		return "success-Data ".$a." Telah Tersimpan!";
	}

	public function HapusData($id) {
		$this->db->where('Id_barang',$id)
						 ->delete($this->table[0]);
		return "success-Data Telah Dihapus!";
	}

	public function UpdatePersediaan($id) {
		$a = $this->input->post('persediaan');
		$data = array(
									'Persediaan' => $a
								 );
		$this->db->where('Id_d_persediaan',$id)
						 ->update($this->table[2],$data);
		return "success-Data ".$a." Telah Terupdate!";
	}

	public function UpdateSetting($id) {
		$a = $this->input->post('Persediaan_max');
		$b = $this->input->post('Persediaan_min');
		$data = array(
									'Persediaan_Max' => $a,
									'Persediaan_Min' => $b
								 );
		$this->db->where('Id_barang',$id)
						 ->update($this->table[0],$data);
		return "success-Data ".$a." Telah Terupdate!";
	}

}