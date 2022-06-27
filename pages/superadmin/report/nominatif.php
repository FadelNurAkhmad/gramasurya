<?php
$filename	= "Report Nominatif";

include "../../config/koneksi.php";
require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Report Nominatif');
$sheet->setCellValue("A1", "REPORT NOMINATIF");
$sheet->setCellValue("A3", "No");
$sheet->setCellValue("B3", "Nama");
$sheet->setCellValue("C3", "TTL / NIP / Agama");
$sheet->setCellValue("D3", "Jenis Kelamin");
// $sheet->setCellValue("E3", "PKT Terakhir");
// $sheet->setCellValue("F3", "GOL / Ruang");
// $sheet->setCellValue("G3", "TMT");
$sheet->setCellValue("E3", "Jabatan");
$sheet->setCellValue("F3", "TMT");
// $sheet->setCellValue("J3", "Eselon");
$sheet->setCellValue("G3", "Pendidikan / Jurusan / T.Lulus");
$sheet->setCellValue("H3", "Alamat & Telp");
// $sheet->setCellValue("M3", "Ket");


$expPeg	= mysqli_query($koneksi, "SELECT * FROM pegawai JOIN tb_pegawai  ON pegawai.pegawai_id= tb_pegawai.pegawai_id ");
$expeg1 = mysqli_query($koneksi, "SELECT * FROM pegawai_d JOIN tb_jabatan ON pegawai_d.pegawai_id=tb_jabatan.id_jab JOIN tb_sekolah ON tb_jabatan.id_jab=tb_sekolah.id_sekolah");
$i	= 4; //Dimulai dengan baris ke dua
$no	= 1;



while ($peg	= mysqli_fetch_array($expPeg) and $peg1 = mysqli_fetch_array($expeg1)) {

	$expUni	= mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
	$uni	= mysqli_fetch_array($expUni);

	$sheet->setCellValue("A" . $i, $no);
	$sheet->setCellValue("B" . $i, $peg['pegawai_nama']);
	$sheet->setCellValue("C" . $i, $peg['tempat_lahir'] . '/' . $peg['tgl_lahir'] . '/' . $peg['pegawai_nip'] . '/' . $peg1['agama']);
	$sheet->setCellValue("D" . $i, $peg['gender']);
	// $sheet->setCellValue("E" . $i, $peg['pangkat']);
	// $sheet->setCellValue("F" . $i, $peg['gol']);
	// $sheet->setCellValue("G" . $i, $peg['tmt_pangkat']);
	$sheet->setCellValue("E" . $i, $peg1['jabatan']);
	$sheet->setCellValue("F" . $i, $peg1['tmt_jabatan']);
	// $sheet->setCellValue("J" . $i, $peg['eselon']);
	$sheet->setCellValue("G" . $i, $peg1['tingkat'] . '/' . $peg1['jurusan'] . '/' . $peg1['tgl_ijazah']);
	$sheet->setCellValue("H" . $i, $peg1['alamat'] . '/' . $peg['pegawai_telp']);
	// $sheet->setCellValue("M" . $i, $peg['status_kepeg']);


	$no++;
	$i++;
}

$writer = new Xlsx($spreadsheet);
$file	= "../../assets/excel/$filename.xlsx";
$writer->save("$file");

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
$kepala	= mysqli_query($koneksi, "SELECT * FROM tb_setup_bkd WHERE id_setup_peru='1'");
$kep	= mysqli_fetch_array($kepala, MYSQLI_ASSOC);
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/superadmin/report/print-nominatif.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Report <small>Nominatif</small></h1>
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
						<!-- <th rowspan="2">KET</th> -->
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
						<!-- <th>8</th>
						<th>9</th>
						<th>10</th>
						<th>11</th> -->
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
							<!-- <td><?php
										$idPan = mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE (id_pangkat='$peg[pegawai_id]' AND status_pan='Aktif')");
										$hpan = mysqli_fetch_array($idPan, MYSQLI_ASSOC);
										?>
								<?php echo $hpan['pangkat']; ?><br /><?php echo $hpan['gol']; ?></td>
							<td><?php echo $hpan['tmt_pangkat']; ?></td> -->
							<td><?php
								$idJab = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE (pembagian1_id='$peg[pembagian1_id]' )");
								$hjab = mysqli_fetch_array($idJab, MYSQLI_ASSOC);
								$hjab1 = isset($hjab['pembagian1_nama']) ? $hjab['pembagian1_nama'] : '';
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
								$idSek = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE (id_sekolah='$peg[pegawai_id]' AND status='Akhir')");
								$hsek = mysqli_fetch_array($idSek, MYSQLI_ASSOC);
								$hsek1 = isset($hsek['tingkat']) ? $hsek['tingkat'] : '';
								// $hsek2 = isset($hsek['nama_sekolah']) ? $hsek['nama_sekolah'] : '';
								$hsek3 = isset($hsek['jurusan']) ? $hsek['jurusan'] : '';
								$hsek4 = isset($hsek['tgl_ijazah']) ? $hsek['tgl_ijazah'] : '';
								?>
								<?php echo $hsek1; ?>
								<!-- <br /><?php echo $hsek2; ?> -->
								<br /><?php echo $hsek3; ?><br />
								<?php echo $hsek4; ?>
							</td>
							<td><?php echo $peg['alamat']; ?><br /><br /><?php echo $peg['pegawai_telp']; ?></td>
							<!-- <td><?php echo $peg['status_kepeg']; ?></td> -->
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

About