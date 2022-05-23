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
    <li><a href="index.php?page=form-master-hari-jam-kerja" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Tambah Hari/Jam Kerja</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Hari/Jam<small> Kerja&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";
$tampilDataPre    = mysql_query("SELECT * FROM tb_presensi ORDER BY id_presensi DESC");
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
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Results <span class="text-info"><?php echo mysql_num_rows($tampilDataPre); ?></span> rows for "Hari/Jam Kerja"</h4>
            </div>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-info fa-2x pull-left"></i> Gunakan button di sebelah kanan setiap baris tabel untuk menuju instruksi view detail, edit dan hapus data ...
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                        <tr>
                            <th width="4%">No</th>
                            <th>Shift</th>
                            <th>Hari</th>
                            <th>Jam Mulai Absen Masuk)</th>
                            <th>Jam Mulai Absen Pulang)</th>
                            <th>Jam Masuk Kerja</th>
                            <th>Batas Absen Masuk)</th>
                            <th>Jam Pulang Kerja</th>
                            <th>Batas Absen Pulang)</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        while ($dataPre    = mysql_fetch_array($tampilDataPre)) {
                            $no++;
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td>Pagi</td>
                                <td>Senin</td>
                                <td>08:15</td>
                                <td>16:00</td>
                                <td>08:15</td>
                                <td>11:59</td>
                                <td>16:00</td>
                                <td>23:59</td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-hari-jam-kerja" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
                                    <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $dataPre['id_presensi'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td>Malam</td>
                                <td>Senin</td>
                                <td>14:15</td>
                                <td>22:00</td>
                                <td>14:15</td>
                                <td>17:59</td>
                                <td>22:00</td>
                                <td>23:59</td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-hari-jam-kerja" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
                                    <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $dataPre['id_presensi'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
                                </td>
                            </tr>
                            <!-- #modal-dialog -->
                            <div id="Del<?php echo $dataPre['id_presensi'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete <u><?php echo $dataPre['nama_jabatan'] ?></u> from Database?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <a href="index.php?page=delete-data-presensi&id_presensi=<?= $dataPre['id_presensi'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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