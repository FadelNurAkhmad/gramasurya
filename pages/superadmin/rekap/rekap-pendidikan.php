<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/superadmin/rekap/print-rekap-pendidikan.php" target="_blank" title="print" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Rekapitulasi <small>Pegawai Berdasarkan Pendidikan</small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
	<div class="col-md-4">
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="10%">No<br />#</th>
						<th width="65%">Tingkat<br />Pendidikan</th>
						<th width="25%">Jumlah<br />Pegawai</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=0;
						$rekapsek	=mysql_query("SELECT * FROM tb_pegawai WHERE status_mut='' GROUP BY sekolah ORDER BY sekolah DESC");
						while($sek=mysql_fetch_array($rekapsek)){
						$no++
					?>
					<tr>
						<td><?=$no?></td>
						<td><?=$sek['sekolah']?></td>
						<td><?php
								$jml=mysql_query("SELECT * FROM tb_pegawai WHERE status_mut='' AND sekolah='$sek[sekolah]'");
								echo mysql_num_rows($jml);
							?>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-inverse overflow-hidden">
			<div class="panel-heading">
				<h3 class="panel-title">
					<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					    <i class="fa fa-plus-circle pull-right"></i> 
						<i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Statistik Pendidikan
					</a>
				</h3>
			</div>
			<div id="collapseOne" class="panel-collapse collapse in">
				<div class="panel-body">
					<div id="container" class="col-sm-12" style="height:380px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../../assets/js/highcharts.js" type="text/javascript"></script>
	<script type="text/javascript">
		var chart1; // globally available
			$(document).ready(function() {
				chart1 = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						type: 'column'
					},   
					title: {
						text: 'Statistik Tingkat Pendidikan'
					},
					xAxis: {
						categories: ['Pendidikan']
					},
						yAxis: {
						title: {
							text: 'Jumlah'
						}
					},
					series:             
						[
						<?php 
						$sql   = "SELECT * FROM tb_pegawai WHERE status_mut='' GROUP BY sekolah ORDER BY sekolah DESC";
						$query = mysql_query( $sql )  or die(mysql_error());
							while( $ret = mysql_fetch_array( $query ) ){
									$sek	=$ret['sekolah'];
									
									$sql_jumlah   = "SELECT * FROM tb_pegawai WHERE status_mut='' AND sekolah='$sek'";        
									$query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
									$data = mysql_num_rows( $query_jumlah );																									
							?>
								{
									name: '<?php echo $sek; ?>',
									data: [<?php echo $data; ?>]
								},
							<?php 
							
							}
							?>
						]
				});
			});	
	</script>