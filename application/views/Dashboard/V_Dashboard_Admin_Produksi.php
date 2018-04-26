<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
	$(document).ready(function(){
			$('#tbOutput').DataTable();
			$('#tbPermintaan').DataTable();
	});
</script>
<?php if($Level==0) : ?>
	<section class="content-header">
		<h1><?= $Title ?></h1>
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-3">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-arrows-h"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Lembur Maksimum</span>
						<span class="info-box-number"><?= $Overtime->Overtime_Max ?><small> Jam</small></span>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-arrows-h"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Lembur Maksimum</span>
						<span class="info-box-number"><?= $Overtime->Overtime_Min ?><small> Jam</small></span>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-envelope-open"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Permintaan Minimum</span>
						<span class="info-box-number"><?= $Overtime->Permintaan_Min ?><small> Kg</small></span>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-envelope-open"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Permintaan Maksimum</span>
						<span class="info-box-number"><?= $Overtime->Permintaan_Max ?><small> Kg</small></span>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="box box-success">
					<div class="box-header"><h4 class="text-center">Data Order</h4></div>
					<div class="box-body">
						<table id="tbOutput" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Tanggal</th>
								<th>Kode</th>
								<th>Nama</th>
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
										<td><?= $k->Kode_barang ?></td>
										<td><?= $k->Nama_barang ?></td>
										<td><?= $k->Jumlah ?> Kg</td>
										<td class="text-center">
											<?php if($k->procesed==3) : ?>
												<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#pro-<?= $k->Id_d_permintaan ?>">Proses</button>
											<?php elseif($k->procesed==TRUE) : ?>
												<label class="label label-success">Sedang di proses</label>
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
																<?= form_input('customer',$k->Nama,array('class' => 'form-control','placeholder' => 'Customer','required' => 'true')) ?>
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
		</div>
	</section>
<?php endif ?>