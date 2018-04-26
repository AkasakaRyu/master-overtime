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
			<div class="col-lg-6">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-cube"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Persediaan Maksimum</span>
						<span class="info-box-number"><?= $Persediaan->Persediaan_Max ?><small> Kg</small></span>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-cube"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Persediaan Minimum</span>
						<span class="info-box-number"><?= $Persediaan->Persediaan_Min ?><small> Kg</small></span>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="box box-success">
					<div class="box-body">
						<table id="tbOutput" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Nama Barang</th>
								<th>Jenis Barang</th>
							</thead>
							<tbody>
							    <?php $i=1 ?>
							    <?php foreach($Barang as $b) : ?>
							        <tr>
							            <td><?= $i++ ?></td>
							            <td><?= $b->Nama_barang ?></td>
							            <td><?= $b->Jenis_barang ?></td>
							        </tr>
							    <?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>