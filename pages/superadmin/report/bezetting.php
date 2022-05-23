<?php
	include "../../config/koneksi.php";
	$kepala	=mysql_query("SELECT * FROM tb_setup_bkd WHERE id_setup_bkd='1'");
	$kep	=mysql_fetch_array($kepala);
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/superadmin/report/print-bezetting.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Report <small>Bezetting</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="table-responsive">
			<h5 align="center">DAFTAR BEZETTING PNS</h5>
			<h6 align="center" style="text-transform:uppercase">PEMERINTAH KABUPATEN <?=$kep['kab']?> PERIODE BULAN <?php echo date ("m");?> TAHUN <?php echo date ("Y");?></h6>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th>No</th>
					<th>NAMA<br />TEMPAT TANGGAL LAHIR</th>
					<th>NIP</th>
					<th>PANGKAT<br />GOL/RUANG</th>
					<th>JABATAN</th>
					<th>PENDIDIKAN<br />TERAKHIR</th>
					<th>UMUR (THN)</th>
					<th>KET</th>
				</tr>
				<tr>
					<th>1</th>
					<th>2</th>
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
					$no=0;
					$idPeg=mysql_query("SELECT * FROM tb_pegawai WHERE status_kepeg='PNS' AND status_mut='' ORDER BY urut_pangkat DESC");
					while($peg=mysql_fetch_array($idPeg)){
					$no++
					?>
					<td><?=$no;?></td>
					<td><?php echo $peg['nama']; ?><br /><?php echo $peg['tempat_lhr']; ?>, <?php echo $peg['tgl_lhr']; ?></td>
					<td><?php echo $peg['nip']; ?></td>
					<td><?php
						$idPan=mysql_query("SELECT * FROM tb_pangkat WHERE (id_peg='$peg[id_peg]' AND status_pan='Aktif')");
						$hpan=mysql_fetch_array($idPan);
						?>
						<?php echo $hpan['pangkat']; ?><br /><?php echo $hpan['gol']; ?></td>
					<td><?php
						$idJab=mysql_query("SELECT * FROM tb_jabatan WHERE (id_peg='$peg[id_peg]' AND status_jab='Aktif')");
						$hjab=mysql_fetch_array($idJab);
						?>
						<?php echo $hjab['jabatan']; ?></td>
					<td><?php
						$idSek=mysql_query("SELECT * FROM tb_sekolah WHERE (id_peg='$peg[id_peg]' AND status='Akhir')");
						$hsek=mysql_fetch_array($idSek);
						?>
						<?php echo $hsek['tingkat']; ?>
					</td>
					<td><?php
						$lhr	= new DateTime($peg['tgl_lhr']);
						$today	= new DateTime();										
						$selisih	= $today->diff($lhr);										
							echo $selisih->y;
						?>											
					</td>
					<td><?php echo $peg['status_kepeg']; ?></td>
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
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>