<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
	$(document).ready(function(){
			$('#myTable').DataTable({
				"searching": false,
				"ordering": false
			});
	});
</script>
<?php if($Level==0) : ?>
	<section class="content-header">
		<h1><?= $Title ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard persediaan</a></li>
			<li class="active"><i class="fa fa-users"></i> Data Produksi</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<?php 
				$str = $this->session->flashdata('item');
				$x = explode("-",$str) 
			?>
			<?php if ($str!=NULL) : ?>
				<div class="col-lg-12">
					<div class="alert alert-<?= $x[0] ?>">
						<h4><i class="icon fa fa-exclamation-triangle"></i> Notice</h4>
							<?= $x[1] ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="col-lg-12">
				<div class="box box-success">
					<div class="box-header">
						<span class="pull-left">
							List Produksi
						</span>
						<span class="pull-right">
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahProduksi">Tambah Produksi</button>
						</span>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Tanggal</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Jumlah Produksi</th>
								<th>Jumlah Produksi Overtime</th>
								<th></th>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									foreach($Produksi as $k) : 
								?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $k->Tanggal_produksi ?></td>
										<td><?= $k->Kode_barang ?></td>
										<td><?= $k->Nama_barang ?></td>
										<td><?= $k->Jumlah_produksi ?></td>
										<td><?= $k->Jumlah_overtime ?></td>
										<td>
											<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit-<?= $k->Id_d_produksi ?>">Edit</button>
										</td>
									</tr>
									<div id="edit-<?= $k->Id_d_produksi ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Data <?= $k->Nama_Produksi ?></h4>
												</div>
												<?= form_open('persediaan/edit-produksi/'.$k->Id_d_produksi) ?>
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<?= form_input('Tanggal',$k->Tanggal_produksi,array('class' => 'form-control','placeholder' => 'Tanggal','required' => 'true')) ?>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<?= form_input('Jumlah_Produksi',$k->Jumlah_produksi,array('class' => 'form-control','placeholder' => 'Jumlah Produksi','required' => 'true')) ?>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<?= form_input('Jumlah_overtime',$k->Jumlah_overtime,array('class' => 'form-control','placeholder' => 'Jumlah Overtime')) ?>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-success">Simpan</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
												<?= form_close() ?>
											</div>
										</div>
									</div>
									<div id="hps-<?= $k->Id_d_produksi ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-red">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Peringatan, Anda akan menghapus Data <?= $k->Tanggal_produksi ?>!</h4>
												</div>
												<?= form_open('persediaan/hapus-produksi/'.$k->Id_d_produksi) ?>
												<div class="modal-body">
													Data yang terhapus, tidak dapat dikembalikan. Apakah anda yakin ingin menghapus data ini?
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-danger">Ya, Saya Yakin</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Tidak, Saya masih butuh data ini</button>
												</div>
												<?= form_close() ?>
											</div>
										</div>
									</div>
								<?php endforeach ?>
							</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<div id="tambahProduksi" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah <?= $Title ?></h4>
				</div>
				<?= form_open('persediaan/tambah-produksi') ?>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<?= form_input('Tanggal',date('Y-m-d'),array('class' => 'form-control','placeholder' => 'Tanggal','required' => 'true')) ?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<select name="nama_barang" class="form-control">
									<option value="">== Pilih Barang ==</option>
									<?php foreach($Barang as $b) : ?>
										<option value="<?= $b->Id_barang ?>"><?= $b->Nama_barang ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<?= form_input('Jumlah_Produksi',null,array('class' => 'form-control','placeholder' => 'Jumlah Produksi','required' => 'true')) ?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<?= form_input('Jumlah_Overtime',null,array('class' => 'form-control','placeholder' => 'Jumlah Overtime')) ?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
<?php endif ?>