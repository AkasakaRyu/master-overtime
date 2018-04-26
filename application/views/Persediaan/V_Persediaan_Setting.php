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
							List Persediaan
						</span>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Persediaan Maksimum</th>
								<th>Persediaan Minimum</th>
								<th></th>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									foreach($Persediaan as $k) : 
								?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $k->Kode_barang ?></td>
										<td><?= $k->Nama_barang ?></td>
										<td><?= $k->Persediaan_Max ?></td>
										<td><?= $k->Persediaan_Min ?></td>
										<td>
											<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit-<?= $k->Id_barang ?>">Update Persediaan</button>
										</td>
									</tr>
									<div id="edit-<?= $k->Id_barang ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit <?= $Title ?> <?= $k->Nama_barang ?></h4>
												</div>
												<?= form_open('Persediaan/update-setting/'.$k->Id_barang) ?>
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<label>Persediaan Maksimum (Kg)</label>
																<?= form_input('Persediaan_max',$k->Persediaan_Max,array('class' => 'form-control','required' => 'true')) ?>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label>Persediaan Minimum (Kg)</label>
																<?= form_input('Persediaan_min',$k->Persediaan_Min,array('class' => 'form-control','required' => 'true')) ?>
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