<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$_SESSION['pesan'] ="";
		?>
	</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Riwayat <small>Jabatan <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
<!-- end page-header -->
<?php
	include "../../config/koneksi.php";
	function kdauto($tabel, $inisial){
		$struktur   = mysql_query("SELECT * FROM $tabel");
		$field      = mysql_field_name($struktur,0);
		$panjang    = mysql_field_len($struktur,0);
		$qry  = mysql_query("SELECT max(".$field.") FROM ".$tabel);
		$row  = mysql_fetch_array($qry);
		if ($row[0]=="") {
		$angka=0;
		}
		else {
		$angka= substr($row[0], strlen($inisial));
		}
		$angka++;
		$angka      =strval($angka);
		$tmp  ="";
		for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";
		}
		return $inisial.$tmp.$angka;
		}
	$id_jab	=kdauto("tb_jabatan","");
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
				<h4 class="panel-title">Form master data jabatan</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=master-data-jabatan&id_jab=<?=$id_jab?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
					<div class="form-group">
						<label class="col-md-3 control-label">Pegawai</label>
						<div class="col-md-6">
							<?php
								$data = mysql_query("SELECT * FROM tb_pegawai ORDER BY nama ASC");        
								echo '<select name="id_peg" class="default-select2 form-control">';    
								echo '<option value="">...</option>';    
									while ($row = mysql_fetch_array($data)) {    
									echo '<option value="'.$row['id_peg'].'">'.$row['nama'].'_'.$row['nip'].'</option>';    
									}    
								echo '</select>';
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jabatan</label>
						<div class="col-md-4">
							<?php
								$dataJ = mysql_query("SELECT * FROM tb_masterjab ORDER BY nama_masterjab");      
								echo '<select name="jabatan" class="default-select2 form-control">';    
								echo '<option value="">...</option>';    
									while ($rowj = mysql_fetch_array($dataJ)) {    
									echo '<option value="'.$rowj['nama_masterjab'].'">'.$rowj['nama_masterjab'].'</option>';    
									}    
								echo '</select>';
							?>
						</div>
						<div class="col-sm-2">					
							<a type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#jab"><i class="fa fa-plus-circle"></i> Add Jabatan&nbsp;</a>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Eselon</label>
						<div class="col-md-4">
							<?php
								$dataE = mysql_query("SELECT * FROM tb_masteresl ORDER BY nama_masteresl DESC");      
								echo '<select name="eselon" class="default-select2 form-control">';    
								echo '<option value="">...</option>';    
									while ($rowe = mysql_fetch_array($dataE)) {    
									echo '<option value="'.$rowe['nama_masteresl'].'">'.$rowe['nama_masteresl'].'</option>';    
									}    
								echo '</select>';
							?>
						</div>
						<div class="col-sm-2">					
							<a type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#esl"><i class="fa fa-plus-circle"></i> Add Eselon&nbsp; &nbsp;</a>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal SK</label>
						<div class="col-md-3">
							<input type="text" name="no_sk" maxlength="255" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_sk" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">TMT Jabatan</label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" name="tmt_jabatan" placeholder="Dari" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
								<input type="text" name="sampai_tgl" placeholder="Sampai" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">File SK Jabatan</label>
						<div class="col-md-6">
							<input type="file" name="file" maxlength="255" class="form-control" />
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
<div id="jab" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Master Data Jabatan</h4>
			</div>
			<div class="col-sm-12">
				<div class="modal-body">
					<form action="index.php?page=masterjab" class="form-horizontal" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Jabatan</label>
							<div class="col-md-4">
								<input type="text" name="nama_masterjab" maxlength="32" class="form-control" />
							</div>
							<div class="col-md-4">
								<p>* Ex: Kepala Dinas</p>
							</div>
							<div class="col-md-2">
								<button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>
							</div>
						</div>
					</form>
					<div class="widget-body">
						<div class="widget-main">							
							<table class="table table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<th width="10%"><i class="fa fa-caret-right"></i> No</th>
										<th width="70%"><i class="fa fa-caret-right"></i> Nama Jabatan</th>
										<th width="20%"><center><i class="fa fa-code fa-lg"></i></center></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=0;
										$tampilJ	=mysql_query("SELECT * FROM tb_masterjab ORDER BY nama_masterjab ASC");
										while($jab=mysql_fetch_array($tampilJ)){
										$no++;
									?>	
										<tr>
											<td><?=$no?></td>
											<td><?php echo $jab['nama_masterjab'];?></td>
											<td class="tools" align="center">
												<a href="index.php?page=form-edit-masterjab&id_masterjab=<?=$jab['id_masterjab'];?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;
												<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Delmasjab<?php echo $jab['id_masterjab']?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
											</td>
										</tr>
										<!-- #modal-dialog -->
										<div id="Delmasjab<?php echo $jab['id_masterjab']?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete Master Jabatan <?php echo $jab['nama_masterjab']?> from Database?</h5>
													</div>
													<div class="modal-body" align="center">
														<a href="index.php?page=delete-masterjab&id_masterjab=<?=$jab['id_masterjab']?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
				</div>
			</div>
			<div class="modal-footer no-margin-top">
			</div>
		</div>
	</div>
</div>
<div id="esl" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<div class="table-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Master Data Eselon</h4>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="modal-body">
					<form action="index.php?page=masteresl" class="form-horizontal" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Eselon</label>
							<div class="col-md-4">
								<input type="text" name="nama_masteresl" maxlength="32" class="form-control" />
							</div>
							<div class="col-md-4">
								<p>* Gunakan tanda baca "/". Ex: III/A</p>
							</div>
							<div class="col-md-2">
								<button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>
							</div>
						</div>
					</form>
					<div class="widget-body">
						<div class="widget-main">							
							<table class="table table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<th width="10%"><i class="fa fa-caret-right"></i> No</th>
										<th width="70%"><i class="fa fa-caret-right"></i> Nama Eselon</th>
										<th width="20%"><center><i class="fa fa-code fa-lg"></i></center></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=0;
										$tampilE	=mysql_query("SELECT * FROM tb_masteresl ORDER BY nama_masteresl DESC");
										while($esl=mysql_fetch_array($tampilE)){
										$no++;
									?>	
										<tr>
											<td><?=$no?></td>
											<td><?php echo $esl['nama_masteresl'];?></td>
											<td class="tools" align="center">
												<a href="index.php?page=form-edit-masteresl&id_masteresl=<?=$esl['id_masteresl'];?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;
												<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Delmasesl<?php echo $esl['id_masteresl']?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
											</td>
										</tr>
										<!-- #modal-dialog -->
										<div id="Delmasesl<?php echo $esl['id_masteresl']?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete Master Eselon <?php echo $esl['nama_masteresl']?> from Database?</h5>
													</div>
													<div class="modal-body" align="center">
														<a href="index.php?page=delete-masteresl&id_masteresl=<?=$esl['id_masteresl']?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
				</div>
			</div>
			<div class="modal-footer no-margin-top">
			</div>
		</div>
	</div>
</div>
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>