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
<h1 class="page-header">Kepegawaian <small> <i class="fa fa-angle-right"></i> Surat Perintah Tunjangan <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
<!-- end page-header -->
<?php
function kdauto($tabel, $inisial)
{
	include "../../config/koneksi.php";

	$struktur   = mysqli_query($koneksi, "SELECT * FROM $tabel");
	$fieldInfo = mysqli_fetch_field_direct($struktur, 0);
	$field      = $fieldInfo->name;
	$panjang    = $fieldInfo->length;
	$qry  = mysqli_query($koneksi, "SELECT max(" . $field . ") FROM " . $tabel);
	$row  = mysqli_fetch_array($qry);
	if ($row[0] == "") {
		$angka = 0;
	} else {
		$angka = substr($row[0], strlen($inisial));
	}
	$angka++;
	$angka = strval($angka);
	$tmp  = "";
	for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
		$tmp = $tmp . "0";
	}
	return $inisial . $tmp . $angka;
}
$id_tunjangan	= kdauto("tb_tunjangan", "");
?>
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
				<h4 class="panel-title">Form master data tunjangan</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=master-data-tunjangan&id_tunjangan=<?= $id_tunjangan ?>"" class=" form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal Tunjangan</label>
						<div class="col-md-3">
							<input type="text" name="no_tunjangan" maxlength="32" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_tunjangan" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pegawai</label>
						<div class="col-md-6">
							<?php
							$data = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id ASC");
							echo '<select name="id_peg" class="default-select2 form-control">';
							echo '<option value="">...</option>';
							while ($row = mysqli_fetch_array($data)) {
								echo '<option value="' . $row['pegawai_id'] . '">' . $row['pegawai_nama'] . '_' . $row['pegawai_nip'] . '</option>';
							}
							echo '</select>';
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Tunjangan</label>
						<div class="col-md-6">
							<input type="text" name="jns_tunjangan" maxlength="32" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Terhitung Mulai</label>
						<div class="col-md-6">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_terhitung" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Akta Perkawinan Dari</label>
						<div class="col-md-6">
							<input type="text" name="akta_kawin" maxlength="255" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal Akta Perkawinan</label>
						<div class="col-md-3">
							<input type="text" name="no_akta_kawin" maxlength="32" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_akta_kawin" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Akta Kelahiran Dari</label>
						<div class="col-md-6">
							<input type="text" name="akta_lahir" maxlength="255" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal Akta Kelahiran</label>
						<div class="col-md-3">
							<input type="text" name="no_akta_lahir" maxlength="32" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_akta_lahir" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tembusan</label>
						<div class="col-md-6">
							<input type="text" name="tembusan1" maxlength="255" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan2" maxlength="255" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan3" maxlength="255" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan4" maxlength="255" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan5" maxlength="255" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
							<a type="button" class="btn btn-default active" href="./"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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