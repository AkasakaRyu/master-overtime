<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>CV. LOEN MANDIRI JAYA - <?= $Title ?></title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/logo.ico') ?>" />
		<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminLTE/css/AdminLTE.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminLTE/css/skins/skin-green.css') ?>">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" />
		<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
		<script src="<?= base_url('assets/bootstrap/js/bootstrap.js') ?>"></script>
		<script src="<?= base_url('assets/jquery/jquery.slimscroll.js') ?>"></script>
		<script src="<?= base_url('assets/fastclick/lib/fastclick.js') ?>"></script>
		<script src="<?= base_url('assets/adminLTE/js/adminlte.min.js') ?>"></script>
		<script src="<?= base_url('assets/datatables.net-bs/js/jquery.dataTables.js') ?>"></script>
		<script src="<?= base_url('assets/datatables.net-bs/js/dataTables.bootstrap.js') ?>"></script>
		<script src="<?= base_url('assets/datatables.net-bs/js/dataTables.buttons.min.js') ?>"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
		<script src="<?= base_url('assets/datatables.net-bs/js/buttons.print.min.js') ?>"></script>
	</head>
	<body class="hold-transition skin-green sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<a href="" class="logo">
		      <span class="logo-mini">Loen Mandiri Jaya</span>
		      <span class="logo-lg">CV. <b>LOEN MANDIRI JAYA</b></span>
				</a>
				<nav class="navbar navbar-static-top">
					<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?= base_url('assets/images/avatar/avatar.png') ?>" class="user-image" alt="User Image">
									<span class="hidden-xs"><?= $Nama ?></span>
								</a>
								<ul class="dropdown-menu">
									<li class="user-header">
										<img src="<?= base_url('assets/images/avatar/avatar.png') ?>" class="img-circle" alt="User Image">
										<p>
											<?= $Nama ?>
											<small>Employee since <?= $this->session->userdata('created') ?></small>
										</p>
									</li>
									<li class="user-footer">
										<div class="pull-left">
											<a href="#" class="btn btn-default btn-flat">Profile</a>
										</div>
										<div class="pull-right">
											<a href="<?= base_url('dashboard/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header">MAIN NAVIGATION</li>
						<?php if($Level=="System Administrator") : ?>
							<li class="<?php if($Title=='Dashboard') : echo 'active'; endif; ?>">
								<a href="<?= base_url('dashboard') ?>">
									<i class="fa fa-dashboard"></i>
									<span>Dashboard</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Karyawan') : echo 'active'; endif; ?>">
								<a href="<?= base_url('admin') ?>">
									<i class="fa fa-users"></i>
									<span>Database Karyawan</span>
								</a>
							</li>
							<li class="<?php if($Title=='Admin Produksi') : echo 'active'; endif; ?> treeview">
								<a href="#">
									<i class="fa fa-user"></i>
									<span>Admin Produksi</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="<?= base_url('order') ?>"><i class="fa fa-circle-o"></i> Data Order</a></li>
									<li><a href="<?= base_url('overtime') ?>"><i class="fa fa-circle-o"></i> Setting Overtime</a></li>
									<li><a href="<?= base_url('output') ?>"><i class="fa fa-circle-o"></i> Setting Output</a></li>
									<li><a href="<?= base_url('permintaan') ?>"><i class="fa fa-circle-o"></i> Setting Permintaan</a></li>
								</ul>
							</li>
							<li class="<?php if($Title=='Gudang') : echo 'active'; endif; ?> treeview">
								<a href="#">
									<i class="fa fa-user-circle-o"></i>
									<span>Gudang</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="<?= base_url('persediaan/barang') ?>"><i class="fa fa-circle-o"></i> Data Barang</a></li>
									<li><a href="<?= base_url('persediaan') ?>"><i class="fa fa-circle-o"></i> Data Persediaan</a></li>
									<li><a href="<?= base_url('persediaan/setting') ?>"><i class="fa fa-circle-o"></i> Setting Persediaan</a></li>
								</ul>
							</li>
						<?php elseif($Level=="Admin Produksi") : ?>
							<li class="<?php if($Title=='Dashboard') : echo 'active'; endif; ?>">
								<a href="<?= base_url('dashboard/admin-produksi') ?>">
									<i class="fa fa-dashboard"></i>
									<span>Dashboard</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Produksi') : echo 'active'; endif; ?>">
								<a href="<?= base_url('persediaan/produksi-hari-ini') ?>">
									<i class="fa fa-cube"></i>
									<span>Produksi Hari Ini</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Overtime') : echo 'active'; endif; ?>">
								<a href="<?= base_url('overtime') ?>">
									<i class="fa fa-clock-o"></i>
									<span>Setting Overtime</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Output') : echo 'active'; endif; ?>">
								<a href="<?= base_url('output') ?>">
									<i class="fa fa-arrows-h"></i>
									<span>Setting Output Hari Ini</span>
								</a>
							</li>
							<li class="<?php if($Title=='Setting Output') : echo 'active'; endif; ?>">
								<a href="<?= base_url('output/setting') ?>">
									<i class="fa fa-arrows-h"></i>
									<span>Setting Output Max dan Min</span>
								</a>
							</li>
							<li class="<?php if($Title=='Report') : echo 'active'; endif; ?> treeview">
								<a href="#">
									<i class="fa fa-book"></i>
									<span>Report</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="<?= base_url('overtime/report') ?>"><i class="fa fa-circle-o"></i> Report Overtime</a></li>
									<li><a href="<?= base_url('overtime/report-produksi') ?>"><i class="fa fa-circle-o"></i> Report Produksi</a></li>
								</ul>
							</li>
						<?php elseif($Level=="Kepala Produksi") : ?>
							<li class="<?php if($Title=='Dashboard') : echo 'active'; endif; ?>">
								<a href="<?= base_url('dashboard/kepala-produksi') ?>">
									<i class="fa fa-dashboard"></i>
									<span>Dashboard</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Order') : echo 'active'; endif; ?>">
								<a href="<?= base_url('order') ?>">
									<i class="fa fa-shopping-cart"></i>
									<span>Data Order</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Overtime') : echo 'active'; endif; ?>">
								<a href="<?= base_url('overtime') ?>">
									<i class="fa fa-clock-o"></i>
									<span>Setting Overtime</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Output') : echo 'active'; endif; ?>">
								<a href="<?= base_url('output') ?>">
									<i class="fa fa-arrows-h"></i>
									<span>Setting Output</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Permintaan') : echo 'active'; endif; ?>">
								<a href="<?= base_url('permintaan') ?>">
									<i class="fa fa-envelope-open"></i>
									<span>Setting Permintaan</span>
								</a>
							</li>
							<li class="<?php if($Title=='Report') : echo 'active'; endif; ?> treeview">
								<a href="#">
									<i class="fa fa-book"></i>
									<span>Report</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="<?= base_url('overtime/report') ?>"><i class="fa fa-circle-o"></i> Report Overtime</a></li>
								</ul>
							</li>
						<?php elseif($Level=="Quality Control") : ?>
							<li class="<?php if($Title=='Dashboard') : echo 'active'; endif; ?>">
								<a href="<?= base_url('dashboard/quality-control') ?>">
									<i class="fa fa-dashboard"></i>
									<span>Dashboard</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Output') : echo 'active'; endif; ?> treeview">
								<a href="#">
									<i class="fa fa-arrows-h"></i>
									<span>Setting Output</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="<?= base_url('output/output-validate') ?>"><i class="fa fa-circle-o"></i> Validasi Output</a></li>
									<li><a href="<?= base_url('output/setting') ?>"><i class="fa fa-circle-o"></i> Setting Min dan Max</a></li>
								</ul>
							</li>
						<?php elseif($Level=="Admin Gudang") : ?>
							<li class="<?php if($Title=='Dashboard') : echo 'active'; endif; ?>">
								<a href="<?= base_url('dashboard/admin-gudang') ?>">
									<i class="fa fa-dashboard"></i>
									<span>Dashboard</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Order') : echo 'active'; endif; ?>">
								<a href="<?= base_url('order') ?>">
									<i class="fa fa-shopping-cart"></i>
									<span>Data Order</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Permintaan') : echo 'active'; endif; ?>">
								<a href="<?= base_url('permintaan') ?>">
									<i class="fa fa-envelope-open"></i>
									<span>Setting Permintaan</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Barang') : echo 'active'; endif; ?>">
								<a href="<?= base_url('persediaan/barang') ?>">
									<i class="fa fa-cube"></i>
									<span>Data Barang</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Bahan Baku') : echo 'active'; endif; ?>">
								<a href="<?= base_url('persediaan/bahan-baku') ?>">
									<i class="fa fa-cube"></i>
									<span>Bahan Baku</span>
								</a>
							</li>
							<li class="<?php if($Title=='Data Persediaan') : echo 'active'; endif; ?>">
								<a href="<?= base_url('persediaan') ?>">
									<i class="fa fa-cube"></i>
									<span>Persediaan</span>
								</a>
							</li>
							<li class="<?php if($Title=='Setting Persediaan') : echo 'active'; endif; ?>">
								<a href="<?= base_url('persediaan/setting') ?>">
									<i class="fa fa-cube"></i>
									<span>Setting Persediaan</span>
								</a>
							</li>
							<li class="<?php if($Title=='Report Gudang') : echo 'active'; endif; ?>">
								<a href="<?= base_url('persediaan/report') ?>">
									<i class="fa fa-archive"></i>
									<span>Report Gudang</span>
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</section>
			</aside>
			<div class="content-wrapper">
				<?php $this->load->view($Konten) ?>
			</div>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					Page rendered in <strong>{elapsed_time}</strong> seconds.
				</div>
				<strong>Copyright &copy; <?= date('Y') ?> <a href="http://tomorinao.esy.es/">Maelani</a>.</strong> All rights reserved.
			</footer>
		</div>
		<script>
		$(document).ready(function () {
			$('.sidebar-menu').tree()
		})
		</script>
	</body>
</html>