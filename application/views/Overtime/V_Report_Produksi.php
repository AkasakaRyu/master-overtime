<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
	$(document).ready(function(){
			$('#myTable').DataTable({
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
								<th>Jumlah Produksi (Kg)</th>
								<th>Jumlah Produksi Overtime (Kg)</th>
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
									</tr>
								<?php endforeach ?>
							</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>