<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
	$(document).ready(function(){
			$('#myTable').DataTable({
				"paging": false,
				dom: 'Bfrtip',
		        buttons: [
		            'copy', 'csv', 'excel', 'pdf', 'print'
		        ]
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
							Report Overtime
						</span>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered">
							<thead>
								<th class="text-center">No.</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Kode Barang</th>
								<th>Nama Barang</th>
								<th class="text-center">Jumlah Overtime (Jam)</th>
								<th class="text-center">Status</th>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									foreach($Overtime as $k) : 
								?>
									<?php
										if($k->Status=="Tidak Overtime") {
											$warna = "success";
										} elseif($k->Status=="Overtime") {
											$warna = "warning";
										} else {
											$warna = "danger";
										}
									?>
									<tr>
										<td class="text-center"><?= $i++ ?></td>
										<td class="text-center"><?= $k->Tanggal ?></td>
										<td class="text-center"><?= $k->Kode_barang ?></td>
										<td><?= $k->Nama_barang ?></td>
										<td class="text-center"><?= $k->Jumlah_jam ?></td>
										<td class="text-center"><label class="label label-<?= $warna ?>"><?= $k->Status ?></label></td>
									</tr>
								<?php endforeach ?>
							</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>