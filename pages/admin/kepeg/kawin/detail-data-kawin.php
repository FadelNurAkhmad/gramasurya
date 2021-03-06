<?php
if (isset($_GET['id_kawin'])) {
	$id_kawin = $_GET['id_kawin'];
} else {
	die("Error. No ID Selected! ");
}
include "../../config/koneksi.php";
$query	= mysqli_query($koneksi, "SELECT * FROM tb_kawin WHERE id_kawin='$id_kawin'");
$data	= mysqli_fetch_array($query);

$tampilPeg = mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id = tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id = pegawai_d.pegawai_id WHERE pegawai.pegawai_id='$data[id_peg]'");
$peg    = mysqli_fetch_array($tampilPeg);

$tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$data[id_peg]'");
$jab    = mysqli_fetch_array($tampilJab);

// $tampilUni   = mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
// $uni    = mysqli_fetch_array($tampilUni);

$tampilPeru	= mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='1'");
$peru	= mysqli_fetch_array($tampilPeru);

$pimpinan	= mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$peru[pimpinan]'");
$pim	= mysqli_fetch_array($pimpinan);

$tampilJab2   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peru[pimpinan]'");
$jab2    = mysqli_fetch_array($tampilJab2);
?>
<!-- begin page-header -->
<h1 class="page-header">Detail <small>Surat Izin Kawin</small></h1>
<!-- end page-header -->
<div class="invoice">
	<div class="invoice-company">
		<span class="pull-right hidden-print">
			<a href="index.php?page=detail-data-pegawai&pegawai_id=<?= $data['id_peg'] ?>" title="back" class="btn btn-sm btn-white m-b-10"><i class="fa fa-step-backward"></i> &nbsp;Back</a>
			<a href="../../pages/superadmin/kepeg/kawin/print-detail-kawin.php?id_kawin=<?= $id_kawin ?>" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a>
		</span>
		Detail Surat Izin Kawin Pegawai
	</div>
	<div class="invoice-header">
		<div class="invoice-from">
			<strong></strong>
		</div>
		<div class="invoice-to">
			<center>
				<strong><u>SURAT IZIN KAWIN</u></strong>
				<br />
				NOMOR : <span style="color:red"><?= $data['no_kawin'] ?></span>
			</center>
		</div>
		<div class="invoice-date">
			<strong></strong>
			<div class="invoice-detail"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="table-responsive">
				<table border="0" width="100%">
					<tr>
						<td width="50%" colspan="4">Berdasarkan surat izin kawin tanggal</td>
						<td width="2%">:</td>
						<td width="48%"><span style="color:red"><?= $data['tgl_izin'] ?></span></td>
					</tr>
					<tr>
						<td colspan="4">Dengan ini memberikan izin kepada</td>
						<td>:</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td width="6%">1.</td>
						<td width="44%" colspan="3">Nama</td>
						<td width="2%">:</td>
						<td width="48%"><span style="color:red"><?= $peg['pegawai_nama'] ?></span></td>
					</tr>
					<tr>
						<td>2.</td>
						<td colspan="3">NIP</td>
						<td>:</td>
						<td><span style="color:red"><?= $peg == 0 ? '-' : $peg['pegawai_nip']; ?></span></td>
					</tr>
					<!-- <tr>
						<td>3.</td>
						<td colspan="3">Pangkat / Golongan Ruang</td>
						<td>:</td>
						<td><span style="color:red"><?= $peg['pangkat'] ?> ( <?= $peg['urut_pangkat'] ?> )</span></td>
					</tr> -->
					<tr>
						<td>4.</td>
						<td colspan="3">Jabatan</td>
						<td>:</td>
						<td><span style="color:red"><?= $jab == 0 ? '-' : $jab['jabatan']; ?></span></td>
					</tr>
					<!-- <tr>
						<td>5.</td>
						<td colspan="3">Pada Instansi/Dinas</td>
						<td>:</td>
						<td><span style="color:red"><?= $uni['nama'] ?></span></td>
					</tr> -->
					<tr>
						<td>6.</td>
						<td colspan="3">Tempat & Tanggal Lahir</td>
						<td>:</td>
						<td><span style="color:red"><?= $peg['tempat_lahir'] ?>, <?= $peg['tgl_lahir'] ?></span></td>
					</tr>
					<tr>
						<td>7.</td>
						<td colspan="3">Kebangsaan</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['bangsa1'] ?></span></td>
					</tr>
					<tr>
						<td>8.</td>
						<td colspan="3">Agama</td>
						<td>:</td>
						<td>
							<span style="color:red">
								<?php
								switch ($peg['agama']) {
									case 1:
										echo "Islam";
										break;
									case 2:
										echo "Katolik";
										break;
									case 3:
										echo "Protestan";
										break;
									case 4:
										echo "Hindu";
										break;
									case 5:
										echo "Budha";
										break;
									case 6:
										echo "Lainnya";
										break;
								}
								?>
							</span>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td width="6%">9.</td>
						<td width="12%">Wali</td>
						<td width="12%">a. (BAPAK)</td>
						<td width="20%">a. Nama</td>
						<td width="2%">:</td>
						<td width="48%"><span style="color:red"><?= $data['nama_wali_bapak1'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>b. Pekerjaan</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['kerja_wali_bapak1'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>c. Alamat</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['alamat_wali_bapak1'] ?></span></td>
					</tr>
					<tr>
						<td width="6%">&nbsp;</td>
						<td width="12%">&nbsp;</td>
						<td width="12%">b. (IBU)</td>
						<td width="20%">a. Nama</td>
						<td width="2%">:</td>
						<td width="48%"><span style="color:red"><?= $data['nama_wali_ibu1'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>b. Pekerjaan</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['kerja_wali_ibu1'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>c. Alamat</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['alamat_wali_ibu1'] ?></span></td>
					</tr>
					<tr height="40" align="center">
						<td colspan="6"><strong>UNTUK KAWIN DENGAN</strong></td>
					</tr>
					<tr>
						<td width="6%">1.</td>
						<td width="44%" colspan="3">Nama</td>
						<td width="2%">:</td>
						<td width="48%"><span style="color:red"><?= $data['nama'] ?></span></td>
					</tr>
					<tr>
						<td>2.</td>
						<td colspan="3">Tempat & Tanggal Lahir</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['tmp_lahir'] ?>, <?= $data['tgl_lahir'] ?></span></td>
					</tr>
					<tr>
						<td>3.</td>
						<td colspan="3">Pekerjaan</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['pekerjaan'] ?></span></td>
					</tr>
					<tr>
						<td>4.</td>
						<td colspan="3">NIP/NIK</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['nik'] ?></span></td>
					</tr>
					<tr>
						<td>5.</td>
						<td colspan="3">Pangkat/Golongan</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['pangkat'] ?> / <?= $data['gol'] ?></span></td>
					</tr>
					<tr>
						<td>6.</td>
						<td colspan="3">Jabatan</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['jab'] ?></span></td>
					</tr>
					<tr>
						<td>7.</td>
						<td colspan="3">Pada Instansi/Dinas</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['instansi'] ?></span></td>
					</tr>
					<tr>
						<td>8.</td>
						<td colspan="3">Kebangsaan</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['bangsa2'] ?></span></td>
					</tr>
					<tr>
						<td>9.</td>
						<td colspan="3">Agama</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['agama'] ?></span></td>
					</tr>
					<tr>
						<td>10.</td>
						<td colspan="3">Alamat dan tempat tinggal</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['alamat'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td width="6%">11.</td>
						<td width="12%">Wali</td>
						<td width="12%">a. (BAPAK)</td>
						<td width="20%">a. Nama</td>
						<td width="2%">:</td>
						<td width="48%"><span style="color:red"><?= $data['nama_wali_bapak2'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>b. Pekerjaan</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['kerja_wali_bapak2'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>c. Alamat</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['alamat_wali_bapak2'] ?></span></td>
					</tr>
					<tr>
						<td width="6%">&nbsp;</td>
						<td width="12%">&nbsp;</td>
						<td width="12%">b. (IBU)</td>
						<td width="20%">a. Nama</td>
						<td width="2%">:</td>
						<td width="48%"><span style="color:red"><?= $data['nama_wali_ibu2'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>b. Pekerjaan</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['kerja_wali_ibu2'] ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>c. Alamat</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['alamat_wali_ibu2'] ?></span></td>
					</tr>
					<tr>
						<td colspan="6">&nbsp;</td>
					</tr>
					<tr>
						<td width="50%" colspan="4">Perkawinan akan diselenggarakan di</td>
						<td width="2%">:</td>
						<td width="48%"><span style="color:red"><?= $data['tmp_kawin'] ?></span></td>
					</tr>
					<tr>
						<td colspan="4">Pada Bulan</td>
						<td>:</td>
						<td><span style="color:red"><?= $data['tgl_kawin'] ?></span></td>
					</tr>
				</table><br />
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr>
						<td>Demikian Surat Izin Kawin ini diberikan untuk dipergunakan seperlunya.</td>
					</tr>
				</table><br />
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr>
						<td width="70%">&nbsp;</td>
						<td width="15%">Ditetapkan di</td>
						<td width="15%" style="text-transform:uppercase">: Yogyakarta</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><u>Pada Tanggal</u></td>
						<td><u><span style="color:red">: <?= $data['tgl_ditetapkan'] ?></u></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td colspan="2" style="text-transform:uppercase">An. PIMPINAN PERUSAHAAN</td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td colspan="2">PT GRAMASURYA</td>
					</tr>
					<tr>
						<td height="50">&nbsp;</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td colspan="2"><span style="color:red"><?= $pim['pegawai_nama'] ?></span></td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td colspan="2"><span style="color:red"><?= $jab2 == 0 ? '-' : $jab2['jabatan']; ?></span></td>
					</tr>
					<tr align="center">
						<td>&nbsp;</td>
						<td colspan="2">NIP : <span style="color:red"><?= $pim['pegawai_nip'] ?></span></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
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