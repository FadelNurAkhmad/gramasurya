<?php
if (isset($_GET['pegawai_id'])) {
    $pegawai_id = $_GET['pegawai_id'];

    include "../../config/koneksi.php";
    $query   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$pegawai_id'");
    $peg    = mysqli_fetch_array($query, MYSQLI_ASSOC);
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
<h1 class="page-header">Data Gaji <small><i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai : <?= $peg['pegawai_nama'] ?> </small></h1>
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
                <h4 class="panel-title">Form Jumlah Gaji Diterima</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-data-gaji-jabatan&id_jabatan=<?= $id_jabatan ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Nama</label>
                                <div class="col-md-6">
                                    <input type="text" name="nama_pegawai" maxlength="64" value="<?= $peg["pegawai_nama"] ?>" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">NIK</label>
                                <div class="col-md-6">
                                    <input type="text" name="nik_pegawai" maxlength="64"  class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Jabatan</label>
                                <div class="col-md-6">
                                    <input type="text" name="jabatan_pegawai" maxlength="64" value="<?= $peg["pembagian1_id"] ?>" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                            
                                    <label class="col-md-3 control-label">Periode</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="bulan">
                                            <?php
                                            $arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                            foreach ($arr as $key) {
                                                echo "<option value='$key'>$key";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="tahun" class="form-control">
                                            <?php
                                            for ($i = 2018; $i < 2025; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Jumlah Gaji Diterima</label>
                        <div class="col-md-6">
                            <input type="number" name="gapok" class="form-control" readonly />
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

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-6">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-validation-11">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Form master input gaji</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=master-data-presensi&id_presensi=<?= $id_presensi ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tanggal" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Gaji Pokok</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="gaji_pokok" id="gaji_pokok" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tunjangan Tetap</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="tunjangan_tetap" id="tunjangan_tetap" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Struktural</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="struktural" id="struktural" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pendidikan</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="pendidikan" id="pendidikan" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Keahlian</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="keahlian" id="keahlian" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Penyesuaian</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="penyesuaian" id="penyesuaian" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tunjangan Variabel</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="tunjangan_tetap" id="tunjangan_tetap" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Presensi</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="presensi" id="presensi" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Uang Makan</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="pendidikan" id="pendidikan" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kehadiran</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="keahlian" id="keahlian" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kedisiplinan</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="penyesuaian" id="penyesuaian" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Istri/Suami</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="penyesuaian" id="penyesuaian" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Anak</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="penyesuaian" id="penyesuaian" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>



            
                    
                </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-6 -->
    <!-- begin col-6 -->
    <div class="col-md-6">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-validation-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Keterangan</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=master-data-gaji&id_presensi=<?= $id_presensi ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                
                <h4 class="text-center">Potongan Variabel</h4>
                <div class="form-group">
                        <label class="col-md-3 control-label">Presensi</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="presensi" id="presensi" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Uang Makan</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="pendidikan" id="pendidikan" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kehadiran</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="keahlian" id="keahlian" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kedisiplinan</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="penyesuaian" id="penyesuaian" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jumlah</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="penyesuaian" id="penyesuaian" value="0" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>

                <br>
                <h4 class="text-center">Potongan Wajib</h4>
                <div class="form-group">
                        <label class="col-md-3 control-label">BPJS</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="presensi" id="presensi" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Koperasi</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="pendidikan" id="pendidikan" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Dapen Muh</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="keahlian" id="keahlian" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Lainnya</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="penyesuaian" id="penyesuaian" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jumlah</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="penyesuaian" id="penyesuaian" value="0" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <br>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-data-gaji"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
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