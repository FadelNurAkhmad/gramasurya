<?php
if (isset($_GET['id_lokasi'])) {
    $id_lokasi = $_GET['id_lokasi'];

    include "../../config/koneksi.php";
    $query   = mysqli_query($koneksi, "SELECT * FROM tb_lokasi WHERE id_lokasi='$id_lokasi'");
    $data    = mysqli_fetch_array($query);

    $tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$data[id_peg]'");
    $peg    = mysqli_fetch_array($tampilPeg);
} else {
    die("Error. No ID Selected!");
}
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
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Form <small>Edit Lokasi <i class="fa fa-angle-right"></i> <i class="fa fa-key"></i> Pegawai: <?= $peg['pegawai_nama'] ?> &nbsp;&nbsp;<i class="fa fa-lock"></i> NIP : <?= $peg == 0 ? '-' : $peg['pegawai_nip']; ?></small></h1>
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
                </div>
                <h4 class="panel-title">Form edit lokasi</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-lokasi&id_lokasi=<?= $id_lokasi ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Lokasi<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <input type="text" name="nama_lokasi" maxlength="255" value="<?= $data['nama_lokasi'] ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Latitude<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <input type="text" name="lat" value="<?= $data['lat'] ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Longitude<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <input type="text" name="lng" value="<?= $data['lng'] ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <textarea name="alamat" maxlength="255" class="form-control"><?= $data['alamat'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-lokasi"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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