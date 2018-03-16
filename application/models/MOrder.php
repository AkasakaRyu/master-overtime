<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class MOrder extends CI_Model {

	protected $table = array(
														'ak_barang',
														'ak_data_permintaan',
														'ak_data_output',
														'ak_data_persediaan',
														'ak_data_overtime',
														'ak_data_produksi',
														'ak_data_customer'
													);

	public function GetCust() {
		return $this->db->get($this->table[6])->result();
	}

	public function GetData() {
		$res = $this->db->select($this->table[1].'.*,'.$this->table[0].'.Kode_barang,'.$this->table[0].'.Nama_barang')
										->join($this->table[0],$this->table[0].'.Id_barang='.$this->table[1].'.Id_barang')
										->order_by($this->table[1].'.Id_d_permintaan','DESC')
										->get($this->table[1]);
		return $res->result();
	}

	public function GetDataProduksi() {
		$res = $this->db->select($this->table[1].'.*,'.$this->table[0].'.Kode_barang,'.$this->table[0].'.Nama_barang')
										->where('procesed',3)
										->join($this->table[0],$this->table[0].'.Id_barang='.$this->table[1].'.Id_barang')
										->order_by($this->table[1].'.Id_d_permintaan','DESC')
										->get($this->table[1]);
		return $res->result();
	}

	public function GetBarang() {
		$res = $this->db->where('Jenis_barang','Bahan Jadi')->order_by('Kode_barang','ASC')->get($this->table[0]);
		return $res->result();
	}

	public function SaveData() {
		$a = $this->input->post('customer');
		$b = $this->input->post('barang');
		$c = $this->input->post('jumlah');
		$f = date('d-m-Y');
		if($b==1) : 
			$persediaan_kemarin = $this->db->where('Id_barang',1)
											 ->join($this->table[1],$this->table[1].'.Id_d_permintaan='.$this->table[3].'.Id_d_permintaan')
											 ->order_by('Id_d_persediaan','DESC')
											 ->get($this->table[3])
											 ->row('Persediaan');
			$permintaan_kemarin = $this->db->where('Id_barang',1)
											 ->order_by('Id_d_permintaan','DESC')
											 ->get($this->table[1])
											 ->row('Jumlah');
			$output = $this->db->where('Id_barang',1)->get($this->table[0])->row('Output');
		elseif($b==2) : 
			$persediaan_kemarin = $this->db->where('Id_barang',2)
											 ->join($this->table[1],$this->table[1].'.Id_d_permintaan='.$this->table[3].'.Id_d_permintaan')
											 ->order_by('Id_d_persediaan','DESC')
											 ->get($this->table[3])
											 ->row('Persediaan');
			$permintaan_kemarin = $this->db->where('Id_barang',2)
											 ->order_by('Id_d_permintaan','DESC')
											 ->get($this->table[1])
											 ->row('Jumlah');
			$output = $this->db->where('Id_barang',2)->get($this->table[0])->row('Output');
		endif;
		//$jumlah_produksi = $this->db->order_by('Id_d_produksi','DESC')->get($this->table[5])->row('jumlah_produksi');
		//$jumlah_overtime = $this->db->order_by('Id_d_produksi','DESC')->get($this->table[5])->row('jumlah_overtime');
		//$yolo = $jumlah_produksi+$jumlah_overtime;
		//$ok = $persediaan_kemarin-$c;
		if($permintaan_kemarin==0) {
			$param_1 = $persediaan_kemarin-$permintaan_kemarin+$output; //4800
		} else {
			$param_1 = $persediaan_kemarin-$permintaan_kemarin;
		}
		$param_2 = (abs($param_1))+$output;
		if($param_1<0) {
			if($c>$param_2) {
				$status = 0;
				$persediaan = $param_2;//+$yolo;
			} else {
				$status = 1;
				$persediaan = $param_2;//+$yolo;
			}
		} elseif($c>$param_1) {
			$status = 0;
			$persediaan = $param_2;//+$yolo;
		} else {
			$status = 1;
			$persediaan = $param_1;//+$yolo;
		}
		$data1 = array(
									'Tanggal' => $f,
									'Nama' => $a,
									'Id_barang' => $b,
									'Jumlah' => $c,
									'Petugas' => $this->session->userdata('kode'),
									'Status' => $status
								 );
		$this->db->insert($this->table[1],$data1);
		$last = $this->db->insert_id();
		$data2 = array(
									'Id_d_permintaan' => $last,
									'Output' => $output
								 );
		$this->db->insert('ak_data_output',$data2);
		$data3 = array(
									'Id_d_permintaan' => $last,
									'Persediaan' => $persediaan
								 );
		$this->db->insert('ak_data_persediaan',$data3);
		return "success-Data ".$this->db->insert_id()." Telah Tersimpan!";
	}

	public function Send($id) {
		$data = array(
									'procesed' => 3
								 );
		$this->db->where('Id_d_permintaan',$id)
						 ->update($this->table[1],$data);
		return "success-Data ".$a." Telah Terkirim!";
	}

	public function EditData($id) {
		$a = $this->input->post('customer');
		$b = $this->input->post('barang');
		$c = $this->input->post('jumlah');
		$f = date('Y-m-d');
		$data = array(
									'Tanggal' => $f,
									'Nama' => $a,
									'Id_barang' => $b
								 );
		$this->db->where('Id_d_permintaan',$id)
						 ->update($this->table[1],$data);
		return "success-Data ".$a." Telah Tersimpan!";
	}

	public function HapusData($id) {
		$this->db->where('Id_d_permintaan',$id)
						 ->delete($this->table[1]);
		return "success-Data Telah Terhapus!";
	}

	public function Proses($id) {
		$res = $this->db->select('*')
										->from($this->table[1])
										->where($this->table[1].'.Id_d_permintaan',$id)
										->join($this->table[0],$this->table[0].'.Id_barang='.$this->table[1].'.Id_barang')
										->join($this->table[2],$this->table[1].'.Id_d_permintaan='.$this->table[2].'.Id_d_permintaan')
										->join($this->table[3],$this->table[1].'.Id_d_permintaan='.$this->table[3].'.Id_d_permintaan')
										->get()->row();
		// Logic
		$permintaan_rendah = round(($res->Permintaan_Max-$res->Jumlah)/($res->Permintaan_Max-$res->Permintaan_Min),1);
		$permintaan_tertinggi = round(($res->Jumlah-$res->Permintaan_Min)/($res->Permintaan_Max-$res->Permintaan_Min),1);
		$persediaan_sedikit = round(($res->Persediaan_Max-$res->Persediaan)/($res->Persediaan_Max-$res->Persediaan_Min),1);
		$persediaan_banyak = round(($res->Persediaan-$res->Persediaan_Min)/($res->Persediaan_Max-$res->Persediaan_Min),2);
		$output_kurang = round(($res->Output_Max-$res->Output)/($res->Output_Max-$res->Output_Min),2);
		$output_tambah = round(($res->Output-$res->Output_Min)/($res->Output_Max-$res->Output_Min),2);
		// Predikat 1
		$P1 = min($permintaan_tertinggi,$persediaan_sedikit,$output_kurang);
		$S1 = ($res->Overtime_Max-$res->Overtime_Min);
		$Z1S2 = $P1*$S1;
		$Z1 = $res->Overtime_Min+$Z1S2;
		//Predikat 2
		$P2 = min($permintaan_tertinggi,$persediaan_banyak,$output_kurang);
		$Z2S2 = $P2*$S1;
		$Z2 = $res->Overtime_Min+$Z2S2;
		// Predikat 3
		$P3 = min($permintaan_tertinggi,$persediaan_sedikit,$output_tambah);
		$Z3S2 = $P3*$S1;
		$Z3 = $res->Overtime_Min+$Z3S2;
		// Defuzyfikasi
		if($P1*$Z1+$P2*$Z2+$P3*$Z3>0) {
			$Z = round(($P1*$Z1+$P2*$Z2+$P3*$Z3)/($P1+$P2+$P3),1);
		} else {
			$Z = 0;
		}
		$cek = $this->db->where('Id_d_permintaan',$id)
										->get($this->table[4]);
		if($cek->num_rows()<=0) {
			if($Z<=$res->Overtime_Min) {
				$status = "Tidak Overtime";
			} elseif($Z>=$res->Overtime_Min AND $Z<=$res->Overtime_Max) {
				$status = "Overtime";
			} elseif($Z>=$res->Overtime_Max) {
				$status = "Pending";
			}
			if($Z<0)
				$hasil = 0;
			else {
				$hasil = $Z;
			}
			$data = array(
									'Id_d_permintaan' => $id,
									'Jumlah_jam' => $hasil,
									'Status' => $status
								 );
			$this->db->insert($this->table[4],$data);
			$this->db->where('Id_d_permintaan',$id)
							 ->update($this->table[1],array('procesed' => 1));
			return "success-Order telah di proses";
		} else {
			return "danger-Order ini telah di proses";
		}
	}

	/*public function Proses($id) {
		$res = $this->db->select('*')
										->from($this->table[1])
										->where($this->table[1].'.Id_d_permintaan',$id)
										->join($this->table[0],$this->table[0].'.Id_barang='.$this->table[1].'.Id_barang')
										->join($this->table[2],$this->table[1].'.Id_d_permintaan='.$this->table[2].'.Id_d_permintaan')
										->join($this->table[3],$this->table[1].'.Id_d_permintaan='.$this->table[3].'.Id_d_permintaan')
										->get()->row();
		// Logic
		$permintaan_rendah = round(($res->Permintaan_Max-$res->Jumlah)/($res->Permintaan_Max-$res->Permintaan_Min),1);
		$permintaan_tertinggi = round(($res->Jumlah-$res->Permintaan_Min)/($res->Permintaan_Max-$res->Permintaan_Min),1);
		$persediaan_sedikit = round(($res->Persediaan_Max-$res->Persediaan)/($res->Persediaan_Max-$res->Persediaan_Min),1);
		$persediaan_banyak = round(($res->Persediaan-$res->Persediaan_Min)/($res->Persediaan_Max-$res->Persediaan_Min),2);
		if($res->Output_Max-$res->Output_Min<=0) {
			$output_kurang = 0;
			$output_tambah = 0;
		} else {
			$output_kurang = round(($res->Output_Max-$res->Output)/($res->Output_Max-$res->Output_Min),2);
			$output_tambah = round(($res->Output-$res->Output_Min)/($res->Output_Max-$res->Output_Min),2);
		}
		// Predikat 1
		$P1 = min($permintaan_tertinggi,$persediaan_sedikit,$output_kurang);
		$S1 = ($res->Overtime_Max-$res->Overtime_Min);
		$Z1S2 = $P1*$S1;
		$Z1 = $res->Overtime_Min+$Z1S2;
		//Predikat 2
		$P2 = min($permintaan_tertinggi,$persediaan_banyak,$output_kurang);
		$Z2S2 = $P2*$S1;
		$Z2 = $res->Overtime_Min+$Z2S2;
		// Predikat 3
		$P3 = min($permintaan_tertinggi,$persediaan_sedikit,$output_tambah);
		$Z3S2 = $P3*$S1;
		$Z3 = $res->Overtime_Min+$Z3S2;
		// Defuzyfikasi
		$Z = round(($P1*$Z1+$P2*$Z2+$P3*$Z3)/($P1+$P2+$P3),1);
		$cek = $this->db->where('Id_d_permintaan',$id)
										->get($this->table[4]);
		if($cek->num_rows()<=0) {
			if($Z<=$res->Overtime_Min AND $Z<=$res->Overtime_Max) {
				$status = "Proses";
			} else {
				$status = "Delayed";
			}
			$data = array(
									'Id_d_permintaan' => $id,
									'Jumlah_jam' => $Z,
									'Status' => $status
								 );
			$this->db->insert($this->table[4],$data);
			return "success-Order telah di proses";
		} else {
			return "danger-Order ini telah di proses";
		}
	}*/

}