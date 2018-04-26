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
			<li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard Admin</a></li>
			<li class="active"><i class="fa fa-users"></i> Data Karyawan</li>
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
							List Karyawan
						</span>
						<span class="pull-right">
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahKaryawan">Tambah Karyawan</button>
						</span>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Nama Karyawan</th>
								<th>Username</th>
								<th>Bagian</th>
								<th>Tanggal Pembuatan User</th>
								<th></th>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									foreach($Karyawan as $k) : 
								?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $k->Nama_karyawan ?></td>
										<td><?= $k->Username ?></td>
										<td><?= $k->Bagian ?></td>
										<td><?= $k->Created_Date ?></td>
										<td>
											<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit-<?= $k->Id_user ?>">Edit</button>
											<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hps-<?= $k->Id_user ?>">Hapus</button>
										</td>
									</tr>
									<div id="edit-<?= $k->Id_user ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Data <?= $k->Nama_karyawan ?></h4>
												</div>
												<?= form_open('admin/edit-data/'.$k->Id_user) ?>
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<label>Nama Karyawan</label>
																<?= form_input('nama',$k->Nama_karyawan,array('class' => 'form-control','placeholder' => 'Nama Lengkap','required' => 'true')) ?>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label>Username</label>
																<?= form_input('usr',$k->Username,array('class' => 'form-control','placeholder' => 'Username','required' => 'true')) ?>
															</div>
														</div>
														<div class="col-lg-12">
															<div class="form-group">
																<label>Bagian</label>
																<select name="bagian" class="form-control" required="true">
																	<option value="" <?php if($k->Bagian=="Operator") : echo "selected"; endif ?>>======= Pilih Bagian =======</option>
																	<option value="Operator" <?php if($k->Bagian==NULL) : echo "selected"; endif ?>>Operator</option>
																	<option value="Quality Control" <?php if($k->Bagian=="Quality Control") : echo "selected"; endif ?>>Quality Control</option>
																	<option value="Admin Gudang" <?php if($k->Bagian=="Admin Gudang") : echo "selected"; endif ?>>Admin Gudang</option>
																	<option value="Kepala Produksi" <?php if($k->Bagian=="Kepala Produksi") : echo "selected"; endif ?>>Kepala Produksi</option>
																	<option value="Admin Produksi" <?php if($k->Bagian=="Admin Produksi") : echo "selected"; endif ?>>Admin Produksi</option>
																	<option value="System Administrator" <?php if($k->Bagian=="System Administrator") : echo "selected"; endif ?>>System Administrator</option>
																</select>
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
									<div id="hps-<?= $k->Id_user ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-red">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Peringatan, Anda akan menghapus Data <?= $k->Nama_karyawan ?>!</h4>
												</div>
												<?= form_open('admin/hapus-data/'.$k->Id_user) ?>
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
	<div id="tambahKaryawan" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah <?= $Title ?></h4>
				</div>
				<?= form_open('admin/tambah-data') ?>
				<div class="modal-body">
					<div class="col-lg-6">
						<div class="form-group">
							<?= form_input('nama',null,array('class' => 'form-control','placeholder' => 'Nama Lengkap','required' => 'true')) ?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<select name="bagian" class="form-control" required="true">
								<option value="">======= Pilih Bagian =======</option>
								<option value="Operator">Operator</option>
								<option value="Quality Control">Quality Control</option>
								<option value="Admin Gudang">Admin Gudang</option>
								<option value="Kepala Produksi">Kepala Produksi</option>
								<option value="Admin Produksi">Admin Produksi</option>
								<option value="System Administrator">System Administrator</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<?= form_input('usr',null,array('class' => 'form-control','placeholder' => 'Username','required' => 'true')) ?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<?= form_password('pwd',null,array('class' => 'form-control','placeholder' => 'Password','required' => 'true')) ?>
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