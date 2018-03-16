<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
	$(document).ready(function(){
			$('#myTable').DataTable();
	});
</script>
<?php if($Level==0) : ?>
	<section class="content-header">
		<h1><?= $Title ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard persediaan</a></li>
			<li class="active"><i class="fa fa-users"></i> Data Barang</li>
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
							List Barang
						</span>
						<span class="pull-right">
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahBarang">Tambah Barang</button>
						</span>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th></th>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									foreach($Barang as $k) : 
								?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $k->Kode_barang ?></td>
										<td><?= $k->Nama_barang ?></td>
										<td>
											<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit-<?= $k->Id_barang ?>">Edit</button>
											<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hps-<?= $k->Id_barang ?>">Hapus</button>
										</td>
									</tr>
									<div id="edit-<?= $k->Id_barang ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Data <?= $k->Nama_barang ?></h4>
												</div>
												<?= form_open('persediaan/edit-data/'.$k->Id_barang) ?>
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<label>Kode Barang</label>
																<?= form_input('kd_brg',$k->Kode_barang,array('class' => 'form-control','placeholder' => 'Kode Barang','required' => 'true')) ?>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label>Nama Barang</label>
																<?= form_input('nama',$k->Nama_barang,array('class' => 'form-control','placeholder' => 'Nama Barang','required' => 'true')) ?>
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
									<div id="hps-<?= $k->Id_barang ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-red">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Peringatan, Anda akan menghapus Data <?= $k->Nama_barang ?>!</h4>
												</div>
												<?= form_open('persediaan/hapus-data/'.$k->Id_barang) ?>
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
	<div id="tambahBarang" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah <?= $Title ?></h4>
				</div>
				<?= form_open('persediaan/tambah-data') ?>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<?= form_input('kd_brg',null,array('class' => 'form-control','placeholder' => 'Kode Barang','required' => 'true')) ?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<?= form_input('nama',null,array('class' => 'form-control','placeholder' => 'Nama Barang','required' => 'true')) ?>
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