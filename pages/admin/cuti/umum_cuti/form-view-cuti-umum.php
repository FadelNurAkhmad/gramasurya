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
    <li><a href="index.php?page=form-master-cuti-umum" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Input Izin</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Cuti / Izin<small> <i class="fa fa-angle-right"></i> Izin&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";
// $tampilCutiUmum    = mysqli_query($koneksi, "SELECT * FROM tb_data_cuti ORDER BY id_cuti_umum DESC");
$tampilCutiUmum    = mysqli_query(
    $koneksi,
    "SELECT tb_cuti_umum.id_cuti_umum, tb_cuti_umum.id_peg, tb_cuti_umum.tanggal_cuti, tb_cuti_umum.tanggal_mulai, tb_cuti_umum.tanggal_selesai, tb_cuti_umum.lama_cuti, tb_cuti_umum.jumlah_cuti, tb_cuti_umum.jenis_cuti, tb_cuti_umum.keperluan, tb_cuti_umum.status, pegawai.pegawai_nip, pegawai.pegawai_nama
    FROM tb_cuti_umum
    INNER JOIN pegawai ON tb_cuti_umum.id_peg=pegawai.pegawai_id ORDER BY tanggal_cuti DESC"
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
                <h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilCutiUmum); ?></span> rows for "Data Izin"</h4>
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
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Lama Izin</th>
                            <th>Jenis Izin</th>
                            <th>Status</th>
                            <th class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        while ($cuti    = mysqli_fetch_array($tampilCutiUmum)) {
                            $no++
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $cuti == 0 ? '-' : $cuti['pegawai_nip']; ?></td>
                                <td><?php echo $cuti['pegawai_nama'] ?></td>
                                <td><?php echo $cuti['tanggal_cuti'] ?></td>
                                <td>
                                    <?php echo $cuti['tanggal_mulai'] ?>
                                    <b>s/d</b>
                                    <?php echo $cuti['tanggal_selesai'] ?>
                                </td>
                                <td><?php echo $cuti['lama_cuti'] ?> Hari</td>
                                <td><?php echo $cuti['jenis_cuti'] ?></td>
                                <td><?php
                                    $status = mysqli_query($koneksi, "SELECT status FROM tb_approval_cuti_umum WHERE id_approval_umum='$cuti[id_cuti_umum]'");
                                    $stat    = mysqli_fetch_array($status);

                                    if ($stat['status'] == 'Process') {
                                        echo '<span class="badge badge-primary">PROCESS</span>';
                                    } else if ($stat['status'] == 'Approve') {
                                        echo '<span class="badge badge-success">APPROVED</span>';
                                    } else if ($stat['status'] == 'Reject') {
                                        echo '<span class="badge badge-danger">REJECTED</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <!-- <a type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#Approve<?php echo $cuti['id_cuti_umum'] ?>" title="Approve"><i class="fa fa-check"> </i> Approve</a> -->
                                    <!-- <a type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Reject<?php echo $cuti['id_cuti_umum'] ?>" title="Reject"><i class="fa fa-close"> </i> Reject</a> -->
                                    <a type="button" class="btn btn-success btn-icon btn-sm" data-toggle="modal" data-target="#Detail<?php echo $cuti['id_cuti_umum'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
                                    <a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-cuti-umum&id_cuti_umum=<?= $cuti['id_cuti_umum'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
                                    <a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $cuti['id_cuti_umum'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
                                </td>
                            </tr>
                            <!-- #modal-dialog-delete -->
                            <div id="Del<?php echo $cuti['id_cuti_umum'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda yakin akan menghapus data <u><?php echo $cuti['pegawai_nama'] ?></u> dari Database ?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <a href="index.php?page=delete-cuti-umum&id_cuti_umum=<?= $cuti['id_cuti_umum'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- #modal-dialog-approve -->
                            <div id="Approve<?php echo $cuti['id_cuti_umum'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Approval</span> &nbsp; Anda yakin approve cuti <?php echo $cuti['jenis_cuti'] ?> <u><?php echo $cuti['pegawai_nama'] ?></u> ?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <p>Mohon periksa kembali data pengajuan cuti terlampir. Pastikan semua informasi telah <span class="label label-primary">SESUAI</span> !</p>
                                            <br>
                                            <a href="index.php?page=status-cuti-umum&true=true&id_cuti_umum=<?= $cuti['id_cuti_umum'] ?>" class="btn btn-success">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- #modal-dialog-reject -->
                            <div id="Reject<?php echo $cuti['id_cuti_umum'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span class="label label-inverse"> # Reject</span> &nbsp; Anda yakin reject cuti <u><?php echo $cuti['pegawai_nama'] ?></u> ?</h5>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <a href="index.php?page=status-cuti-umum&false=false&id_cuti_umum=<?= $cuti['id_cuti_umum'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="Detail<?php echo $cuti['id_cuti_umum'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">
                                                <i class="ion-ios-gear text-danger"></i>
                                                Detail Pengajuan Cuti Umum ID_<?php echo $cuti['id_cuti_umum'] ?>
                                            </h4>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="modal-body">
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">NIP</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti == 0 ? '-' : $cuti['pegawai_nip']; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Nama</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti['pegawai_nama'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Jenis Izin</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti['jenis_cuti'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Keperluan</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti['keperluan'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Tgl Pengajuan</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti['tanggal_cuti'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Tgl Pelaksanaan</label>
                                                    <div class="col-md-9">
                                                        :
                                                        <?php echo $cuti['tanggal_mulai'] ?>
                                                        <b>s/d</b>
                                                        <?php echo $cuti['tanggal_selesai'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Lama Izin</label>
                                                    <div class="col-md-9">
                                                        : <?php echo $cuti['lama_cuti'] ?> Hari
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-9">
                                                        :
                                                        <?php
                                                        $status = mysqli_query($koneksi, "SELECT status FROM tb_approval_cuti_umum WHERE id_approval_umum='$cuti[id_cuti_umum]'");
                                                        $stat    = mysqli_fetch_array($status);

                                                        if ($stat['status'] == 'Process') {
                                                            echo '<span class="badge badge-primary">PROCESS</span>';
                                                        } else if ($stat['status'] == 'Approve') {
                                                            echo '<span class="badge badge-success">APPROVED</span>';
                                                        } else if ($stat['status'] == 'Reject') {
                                                            echo '<span class="badge badge-danger">REJECTED</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
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