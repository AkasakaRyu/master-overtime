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
			<div class="col-lg-12">
				<div class="box box-success">
					<div class="box-body">
						<table id="tbOutput" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Tanggal</th>
								<th>Nama</th>
								<th>Nama Barang</th>
								<th>Jumlah (Kg)</th>
								<th>Jumlah Jam Kerja (Jam)</th>
								<th>Status</th>
								<th></th>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									foreach($Overtime as $k) : 
								?>
								<tr>
									<td><?= $i++ ?></td>
									<td><?= $k->Tanggal ?></td>
									<td><?= $k->Nama ?></td>
									<td><?= $k->Nama_barang ?></td>
									<td><?= $k->Jumlah ?></td>
									<td><?= $k->Jumlah_jam ?></td>
									<td><?= $k->Status ?></td>
									<td>
										<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#acc-<?= $k->Id_d_lembur ?>">Setujui</button>
									</td>
								</tr>
								<div id="acc-<?= $k->Id_d_lembur ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-green">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Peringatan, Anda akan Menyetujui <?= $k->Nama ?>!</h4>
												</div>
												<?= form_open('overtime/setujui/'.$k->Id_d_lembur) ?>
												<div class="modal-footer">
													<center>
														<button type="submit" class="btn btn-success">Ya, Saya Yakin</button>
														<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
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