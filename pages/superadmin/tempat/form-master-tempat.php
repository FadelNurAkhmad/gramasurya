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
<h1 class="page-header">Input <small>Lokasi <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
<!-- end page-header -->
<?php
function kdauto($tabel, $inisial)
{
    include "../../config/koneksi.php";

    $struktur   = mysqli_query($koneksi, "SELECT * FROM $tabel");
    $fieldInfo = mysqli_fetch_field_direct($struktur, 0);
    $field      = $fieldInfo->name;
    $panjang    = $fieldInfo->length;
    $qry  = mysqli_query($koneksi, "SELECT max(" . $field . ") FROM " . $tabel);
    $row  = mysqli_fetch_array($qry);
    if ($row[0] == "") {
        $angka = 0;
    } else {
        $angka = substr($row[0], strlen($inisial));
    }
    $angka++;
    $angka = strval($angka);
    $tmp  = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
        $tmp = $tmp . "0";
    }
    return $inisial . $tmp . $angka;
}
$id_lokasi    = kdauto("tb_tempat", "");
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
                </div>
                <h4 class="panel-title">Form Input Lokasi</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=master-tempat&id_lokasi=<?= $id_lokasi ?>"" class=" form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pegawai<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_nama ASC");
                            echo '<select name="id_peg" class="default-select2 form-control">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data)) {
                                echo '<option value="' . $row['pegawai_id'] . '">' . $row['pegawai_nama'] . '_' . $row['pegawai_nip'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Lokasi<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <input type="text" name="nama_lokasi" maxlength="255" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Link Lokasi<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <input type="text" name="link_lokasi" class="form-control" placeholder="Diambil dari salin tautan di gmaps" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <textarea name="alamat" maxlength="255" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-tempat"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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