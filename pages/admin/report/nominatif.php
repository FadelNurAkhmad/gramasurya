<?php
$filename	= "Report Nominatif";

include "../../config/koneksi.php";
require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';
require 'report/export-nominatif.php';

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
	<li><a href="<?php echo $file; ?>" class="btn btn-sm btn-success m-b-10" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a></li>

</ol>

<?php
include "../../config/koneksi.php";
$kepala	= mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='1'");
$kep	= mysqli_fetch_array($kepala, MYSQLI_ASSOC);
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/superadmin/report/print-nominatif.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Report <small> <i class="fa fa-angle-right"></i> Nominatif</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="table-responsive">
			<h5 align="center">DAFTAR NOMINATIF PEGAWAI</h5>
			<h6 align="center" style="text-transform:uppercase">PER <?php echo date("j F Y"); ?></h6>
			<h6 style="text-transform:uppercase"><?= $kep['nama_peru'] ?></h6>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th rowspan="2">NO</th>
						<th colspan="2">NAMA</th>
						<th rowspan="2">JNS KELAMIN</th>
						<!-- <th colspan="2">PKT TERAKHIR</th> -->
						<th colspan="2">JABATAN</th>
						<!-- <th rowspan="2">ESL</th> -->
						<th rowspan="2">PEND / JURUSAN / T.LULUS</th>
						<th rowspan="2">ALAMAT & NO. TELP</th>
						<th rowspan="2">KET</th>
					</tr>
					<tr>
						<th colspan="2">TTL / NIP / AGAMA</th>
						<!-- <th>GOL/RUANG</th>
						<th>TMT</th> -->
						<th>NAMA</th>
						<th>TMT</th>
					</tr>
					<tr>
						<th>1</th>
						<th colspan="2">2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$idPeg = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id JOIN tb_pegawai ON pegawai_d.pegawai_id=tb_pegawai.pegawai_id ORDER BY urut_pangkat DESC");
					while ($peg = mysqli_fetch_array($idPeg, MYSQLI_ASSOC)) {
						$no++
					?>
						<tr>
							<td><?= $no; ?></td>
							<td colspan="2"><?php echo $peg['pegawai_nama']; ?><br /><br />
								<?php echo $peg['tempat_lahir']; ?>
								<?php echo $peg['tgl_lahir']; ?><br />
								<?php echo $peg['pegawai_nip']; ?><br />
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
								?></td>
							<td><?php
								if ($peg['gender'] == "1") {
									echo "Laki-laki";
								} else if ($peg['gender'] == "2") {
									echo "Perempuan";
								}
								?></td>


							<td><?php
								$idJab = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]' ");
								$hjab = mysqli_fetch_array($idJab, MYSQLI_ASSOC);
								$hjab1 = isset($hjab['jabatan']) ? $hjab['jabatan'] : '';
								?>

								<?php echo $hjab1; ?></td>
							<td>
								<?php
								$tmt = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE  (id_jab='$peg[pegawai_id]' )");
								$idtmt = mysqli_fetch_array($tmt);
								$idtmt1 = isset($idtmt['tmt_jabatan']) ? $idtmt['tmt_jabatan'] : '';
								?>

								<?php echo $idtmt1; ?>
								<!-- <td><?php echo $hjab['eselon']; ?></td> -->
							</td>
							<td><?php
								$expeg3 = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg=$peg[pegawai_id]");
								$peg3 = mysqli_fetch_array($expeg3, MYSQLI_ASSOC);

								$idSek = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$peg[pegawai_id]' AND status='Akhir'");
								$hsek = mysqli_fetch_array($idSek, MYSQLI_ASSOC);

								$hsek1 = isset($hsek['tingkat']) ? $hsek['tingkat'] : '';
								$hsek2 = isset($hsek['nama_sekolah']) ? $hsek['nama_sekolah'] : '';
								$hsek3 = isset($hsek['jurusan']) ? $hsek['jurusan'] : '';
								$hsek4 = isset($hsek['tgl_ijazah']) ? $hsek['tgl_ijazah'] : '';
								?>
								<?php echo $hsek1; ?>
								<br /><?php echo $hsek2; ?>
								<br /><?php echo $hsek3; ?><br />
								<?php echo $hsek4; ?>
							</td>

							<td><?php echo $peg['alamat']; ?><br /><br /><?php echo $peg['pegawai_telp']; ?></td>
							<td><?php echo $pgw; ?></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- end profile-section -->
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