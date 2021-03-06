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
	<li><a href="index.php?page=form-master-data-gaji-konfigurasi" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Tambah Data Gaji</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Gaji Pegawai <small><i class="fa fa-angle-right"></i> Konfigurasi Gaji&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";

$tampilGaji   = mysqli_query(
	$koneksi,
	"SELECT * FROM tb_gaji_konfigurasi INNER JOIN pegawai on tb_gaji_konfigurasi.id_peg=pegawai.pegawai_id ORDER BY id_gaji_konfig DESC"
);


?>
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				</div>
				<h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilGaji); ?></span> rows for "Data Gaji Pegawai"</h4>
			</div>
			<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-info fa-2x pull-left"></i> Gunakan button di sebelah kanan setiap baris tabel untuk menuju instruksi view detail, edit dan hapus data...
			</div>
			<div class="panel-body">
				<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
							<th width="4%">No</th>
							<th>NIP</th>
							<th>Nama</th>
							<th>Periode Gaji</th>
							<th>Total Gaji</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 0;
						while ($data = mysqli_fetch_array($tampilGaji)) {
							$no++
						?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data['pegawai_nip'] ?></td>
								<td><?php echo $data['pegawai_nama'] ?></td>
								<td>
									<?php echo $data['bulan'] ?>
									<b>-</b>
									<?php echo $data['tahun'] ?>
								</td>
								<td align="right"><?php echo 'Rp. ' . number_format($data['gaji_diterima']); ?></td>
								<td class="text-center">
									<a type="button" class="btn btn-success btn-icon btn-sm" href="index.php?page=detail-data-gaji-konfigurasi&id_gaji_konfig=<?= $data['id_gaji_konfig'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
									<a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-data-gaji-konfigurasi&id_gaji_konfig=<?= $data['id_gaji_konfig'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
									<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?= $data['id_gaji_konfig'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
								</td>
							</tr>
							<!-- #modal-dialog -->
							<div id="Del<?php echo $data['id_gaji_konfig'] ?>" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda yakin ingin menghapus data gaji <u><?php echo $data['pegawai_nama'] ?></u> dari Database?</h5>
										</div>
										<div class="modal-body" align="center">
											<a href="index.php?page=delete-data-gaji-konfigurasi&id_gaji_konfig=<?= $data['id_gaji_konfig'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- end panel -->
	</div>
	<!-- end col-10 -->
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