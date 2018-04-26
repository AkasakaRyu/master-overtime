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
			<li class="active"><i class="fa fa-users"></i> Data Persediaan</li>
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
				<div class="box-body">
					<table id="myTable" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Tanggal</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Persediaan</th>
								<th></th>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									foreach($Persediaan as $k) : 
								?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $k->Tanggal ?></td>
										<td><?= $k->Kode_barang ?></td>
										<td><?= $k->Nama_barang ?></td>
										<td><?= $k->Persediaan ?></td>
										<td>
											<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit-<?= $k->Id_d_persediaan ?>">Update</button>
										</td>
									</tr>
									<div id="edit-<?= $k->Id_d_persediaan ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Data <?= $k->Nama_barang ?></h4>
												</div>
												<?= form_open('persediaan/update-persediaan/'.$k->Id_d_persediaan) ?>
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-12">
															<div class="form-group">
																<label>Jumlah Persediaan (Kg)</label>
																<?= form_input('persediaan',$k->Persediaan,array('class' => 'form-control','required' => 'true')) ?>
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
								<?php endforeach ?>
							</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>