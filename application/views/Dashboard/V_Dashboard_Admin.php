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
			<li class="active"><i class="fa fa-dashboard"></i> Dashboard Admin</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-success">
					<div class="box-header">
						<span class="pull-left">
							List Karyawan
						</span>
						<span class="pull-right">
							<a href="<?= base_url('admin') ?>" class="btn btn-success">Ke Menu Edit Karyawan</a>
						</span>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered">
							<thead>
								<th>No.</th>
								<th>Nama Karyawan</th>
								<th>Bagian</th>
								<th>Tanggal Pembuatan User</th>
							</thead>
							<tbody>
								<?php 
									$i = 1;
									foreach($Karyawan as $k) : 
								?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $k->Nama_karyawan ?></td>
										<td><?= $k->Bagian ?></td>
										<td><?= $k->Created_Date ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>