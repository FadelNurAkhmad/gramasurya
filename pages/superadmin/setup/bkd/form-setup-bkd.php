<?php
if (isset($_GET['id_setup_bkd'])) {
	$id_setup_bkd = $_GET['id_setup_bkd'];

	include "../../config/koneksi.php";
	$query   = mysql_query("SELECT * FROM tb_setup_bkd WHERE id_setup_bkd='$id_setup_bkd'");
	$data    = mysql_fetch_array($query);
} else {
	die("Error. No ID Selected!");
}
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
			echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; " . $_SESSION['pesan'] . " &nbsp; &nbsp; &nbsp;</div></span>";
		}
		$_SESSION['pesan'] = "";
		?>
	</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Setup <small>Perusahaan &nbsp;</small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Form setup perusahaan</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=setup-bkd&id_setup_bkd=<?= $id_setup_bkd ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Perusahaan</label>
						<div class="col-md-6">
							<input type="text" name="kab" value="<?= $data['kab'] ?>" maxlength="255" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<textarea type="text" name="alamat" class="form-control"><?= $data['alamat'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Kepala</label>
						<div class="col-md-6">
							<?php
							$kepala = mysql_query("SELECT * FROM tb_pegawai WHERE status_mut=''");
							echo '<select name="kepala" class="default-select2 form-control">';
							echo '<option value="' . $data['kepala'] . '">...</option>';
							while ($row = mysql_fetch_array($kepala)) {
								echo '<option value="' . $row['id_peg'] . '">' . $row['nama'] . '_' . $row['nip'] . '</option>';
							}
							echo '</select>';
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="setup" value="setup" class="btn btn-primary"><i class="fa fa-gear"></i> &nbsp;Setup</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-setup-bkd"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end panel -->
	</div>
	<!-- end col-6 -->
</div>
<!-- end row -->
<script>
	// 500 = 0,5 s
	$(document).ready(function() {
		setTimeout(function() {
			$(".pesan").fadeIn('slow');
		}, 500);
	});
	setTimeout(function() {
		$(".pesan").fadeOut('slow');
	}, 7000);
</script>