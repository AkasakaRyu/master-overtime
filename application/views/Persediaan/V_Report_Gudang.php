<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
	$(document).ready(function(){
			$('#myTable').DataTable({
				dom: 'Bfrtip',
        buttons: [
            'print'
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
							Report Bahan Baku
						</span>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Tanggal</th>
								<th>Penjual</th>
								<th>Nama Barang</th>
								<th>Jumlah (Kg)</th>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									foreach($Barang as $k) : 
								?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $k->Tanggal_barang ?></td>
										<td><?= $k->Penjual ?></td>
										<td><?= $k->Nama_barang ?></td>
										<td><?= $k->Jumlah_barang ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2"><h4><b>Weast Spinning</b></h4></td>
									<td colspan="3"><?= $TotalS->Jumlah_barang ?></td>
								</tr>
								<tr>
									<td colspan="2"><h4><b>Weast Wipping</b></h4></td>
									<td colspan="3"><?= $TotalW->Jumlah_barang ?></td>
								</tr>
								<tr>
									<td colspan="2"><h4><b>Total Keseluruhan</b></h4></td>
									<td colspan="3"><?= $Total->Jumlah_barang ?></td>
								</tr>
							</tfoot>
					</table>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>