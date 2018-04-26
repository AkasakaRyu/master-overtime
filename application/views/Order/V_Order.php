<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
	$(document).ready(function(){
			$('#myTable').DataTable({
				"searching": false,
				"ordering": false,
				"paging": false
			});
	});
</script>
<?php if($Level==0) : ?>
	<section class="content-header">
		<h1><?= $Title ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard Admin</a></li>
			<li class="active"> <?= $Title ?></li>
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
							List Order
						</span>
						<span class="pull-right">
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahOrder">Tambah Order</button>
						</span>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Tanggal</th>
								<th>Customer</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Jumlah</th>
								<th></th>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									foreach($Order as $k) : 
								?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $k->Tanggal ?></td>
										<td><?= $k->Nama ?></td>
										<td><?= $k->Kode_barang ?></td>
										<td><?= $k->Nama_barang ?></td>
										<td><?= $k->Jumlah ?> Kg</td>
										<td class="text-center">
											<?php if($k->procesed==FALSE) : ?>
												<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit-<?= $k->Id_d_permintaan ?>">Edit</button>
												<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hps-<?= $k->Id_d_permintaan ?>">Hapus</button>
												<?php if($k->Status==FALSE) : ?>
													<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#pro-<?= $k->Id_d_permintaan ?>">Proses</button>
												<?php else : ?>
													<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#pin-<?= $k->Id_d_permintaan ?>">Proses</button>
												<?php endif ?>
											<?php elseif($k->procesed==1) : ?>
												<label class="label label-success">Sedang di proses</label>
											<?php elseif($k->procesed==3) : ?>
												<label class="label label-danger">Menunggu tindakan produksi</label>
											<?php endif ?>
										</td>
									</tr>
									<div id="edit-<?= $k->Id_d_permintaan ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Data <?= $k->Nama_barang ?></h4>
												</div>
												<?= form_open('order/edit-data/'.$k->Id_d_permintaan) ?>
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-12">
															<div class="form-group">
																<select name="customer" class="form-control" required="true">
																	<option value="">== Pilih Customer ==</option>
																	<?php foreach($Customer as $c) : ?>
																		<option value="<?= $c->Nama_cust ?>" <?php if($c->Nama_cust==$k->Nama) : echo "selected"; endif; ?>><?= $c->Nama_cust ?></option>
																	<?php endforeach ?>
																</select>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<select name="barang" class="form-control" required="true">
																	<option value="">== Pilih Produk ==</option>
																	<?php foreach($Barang as $b) : ?>
																		<option value="<?= $b->Id_barang ?>" <?php if($k->Id_barang==$b->Id_barang) : echo "selected"; endif; ?>><?= $b->Kode_barang ?> - <?= $b->Nama_barang ?></option>
																	<?php endforeach ?>
																</select>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<?= form_input('jumlah',$k->Jumlah,array('class' => 'form-control','placeholder' => 'Jumlah','required' => 'true')) ?>
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
									<div id="hps-<?= $k->Id_d_permintaan ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-red">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Peringatan, Anda akan menghapus Data <?= $k->Nama_barang ?>!</h4>
												</div>
												<?= form_open('order/hapus-data/'.$k->Id_d_permintaan) ?>
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
									<div id="pro-<?= $k->Id_d_permintaan ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-green">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Peringatan, Anda akan Memproses Order <?= $k->Nama_barang ?>!</h4>
												</div>
												<?= form_open('order/proses-order/'.$k->Id_d_permintaan) ?>
												<div class="modal-footer">
													<center>
														<button type="submit" class="btn btn-success">Ya, Saya Yakin</button>
														<button type="button" class="btn btn-default" data-dismiss="modal">Tidak, Kembalikan ke status Delay</button>
													</center>
												</div>
												<?= form_close() ?>
											</div>
										</div>
									</div>
									<div id="pin-<?= $k->Id_d_permintaan ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-green">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Peringatan, Anda akan Memproses Order <?= $k->Nama_barang ?>!</h4>
												</div>
												<?= form_open('order/send-order/'.$k->Id_d_permintaan) ?>
												<div class="modal-body">
													<p>Persediaan tidak mencukupi!, Apakah anda ingin mengirim report ke Produksi?</p>
												</div>
												<div class="modal-footer">
													<center>
														<button type="submit" class="btn btn-success">Ya, Saya Yakin</button>
														<button type="button" class="btn btn-default" data-dismiss="modal">Tidak, Kembalikan ke status Waiting</button>
													</center>
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
	<div id="tambahOrder" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-green">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah <?= $Title ?></h4>
				</div>
				<?= form_open('Order/tambah-data') ?>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<select name="customer" class="form-control" required="true">
									<option value="">== Pilih Customer ==</option>
									<?php foreach($Customer as $c) : ?>
										<option value="<?= $c->Nama_cust ?>"><?= $c->Nama_cust ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<select name="barang" class="form-control" required="true">
									<option value="">== Pilih Produk ==</option>
									<?php foreach($Barang as $b) : ?>
										<option value="<?= $b->Id_barang ?>"><?= $b->Kode_barang ?> - <?= $b->Nama_barang ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<?= form_input('jumlah',null,array('class' => 'form-control','placeholder' => 'Jumlah','required' => 'true')) ?>
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