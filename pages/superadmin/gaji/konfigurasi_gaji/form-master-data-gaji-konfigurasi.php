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
<h1 class="page-header">Data <small>Gaji Konfigurasi <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
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
$id_gaji_konfig   = kdauto("tb_gaji_konfigurasi", "");
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
                <h4 class="panel-title">Form Jumlah Gaji Diterima</h4>
            </div>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-info fa-2x pull-left"></i> Gunakan button <b>"Hitung"</b> untuk menghitung jumlah gaji yang diterima...
            </div>
            <div class="panel-body">
                <form action="index.php?page=master-data-gaji-konfigurasi&id_gaji_konfig=<?= $id_gaji_konfig ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Pegawai<span aria-required="true" class="text-danger"> * </span></label>
                                <div class="col-md-6">
                                    <?php
                                    $data = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_nama ASC");
                                    echo '<select name="id_peg" class="default-select2 form-control" required>';
                                    echo '<option value="">...</option>';
                                    while ($row = mysqli_fetch_array($data)) {
                                        echo '<option value="' . $row['pegawai_id'] . '">' . $row['pegawai_nama'] . '_' . $row['pegawai_nip'] . '</option>';
                                    }
                                    echo '</select>';
                                    ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Tanggal<span aria-required="true" class="text-danger"> * </span></label>
                                <div class="col-md-6">
                                    <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                                        <input type="text" name="tanggal_gaji_konfig" id="tanggal_gaji_konfig" class="form-control" required />
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Periode<span aria-required="true" class="text-danger"> * </span></label>
                                <div class="col-md-3">
                                    <select class="form-control" name="bulan" id="bulan" required>
                                        <?php
                                        $arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                        foreach ($arr as $key) {
                                            echo "<option value='$key'>$key";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="tahun" id="tahun" class="form-control" required>
                                        <?php
                                        for ($i = 2021; $i < 2031; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Jumlah Gaji Diterima</label>
                                <div class="col-md-6">
                                    <div class="form-inline">
                                        Rp. <input type="text" name="gaji_diterima" id="gaji_diterima" value="0" class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Gaji Pokok</label>
                                <div class="col-md-6">
                                    <div class="form-inline">
                                        Rp. <input class="form-control number-separator" type="text" name="gaji_pokok" id="gaji_pokok" value="0" data-parsley-required="true" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div id="tunj_tetap">
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Tunjangan Tetap</label>
                                <div class="col-md-6">
                                    <div class="form-inline">
                                        Rp. <input class="form-control" type="text" name="tunjangan_tetap" id="tunjangan_tetap" value="0" data-parsley-required="true" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Struktural</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="struktural" id="struktural" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Pendidikan</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="pendidikan" id="pendidikan" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Keahlian</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="keahlian" id="keahlian" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Penyesuaian</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="penyesuaian" id="penyesuaian" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <br>
                    <div id="tunj_variabel">
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">Tunjangan Variabel</label>
                                <div class="col-md-6">
                                    <div class="form-inline">
                                        Rp. <input class="form-control" type="text" name="tunjangan_variabel" id="tunjangan_variabel" value="0" data-parsley-required="true" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Presensi</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="presensi" id="presensi" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Uang Makan</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="uang_makan" id="uang_makan" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Kehadiran</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="kehadiran" id="kehadiran" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Kedisiplinan</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="kedisiplinan" id="kedisiplinan" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Istri/Suami</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="istri_suami" id="istri_suami" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label number-separator">Anak</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="anak" id="anak" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <h4 class="text-start">Potongan Variabel</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="potongan_variabel">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Presensi</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="presensi_pot" id="presensi_pot" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Uang Makan</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="uang_makan_pot" id="uang_makan_pot" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Kehadiran</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="kehadiran_pot" id="kehadiran_pot" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Kedisiplinan</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="kedisiplinan_pot" id="kedisiplinan_pot" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Jumlah</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="text" name="jumlah_pot_var" id="jumlah_pot_var" value="0" data-parsley-required="true" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <h4 class="text-start">Potongan Wajib</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="potongan_wajib">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">BPJS</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="bpjs" id="bpjs" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Koperasi</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="koperasi" id="koperasi" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Dapen Muh</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="dapen_muh" id="dapen_muh" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Lainnya</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control number-separator" type="text" name="lainya" id="lainya" value="0" data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-md-3 control-label">Jumlah</label>
                                    <div class="col-md-6">
                                        <div class="form-inline">
                                            Rp. <input class="form-control" type="text" name="jumlah_pot_wajib" id="jumlah_pot_wajib" value="0" data-parsley-required="true" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6 ">
                                    <a type="button" value="hitung" id="hitung" class="btn btn-danger btn-block"><i class="fa fa-calculator"></i>&nbsp;&nbsp;Hitung</a>&nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-data-gaji-konfigurasi"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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


<script type="text/javascript">
    $(document).ready(function() {

        $("#tunj_tetap").keyup(function() {
            var struktural = parseInt($("#struktural").val().replaceAll(',', ''));
            var pendidikan = parseInt($("#pendidikan").val().replaceAll(',', ''));
            var keahlian = parseInt($("#keahlian").val().replaceAll(',', ''));
            var penyesuaian = parseInt($("#penyesuaian").val().replaceAll(',', ''));

            var total_tunj_tetap = parseInt(struktural + pendidikan + keahlian + penyesuaian).toLocaleString('en-US');
            $("#tunjangan_tetap").val(total_tunj_tetap);
        });

        $("#tunj_variabel").keyup(function() {
            var presensi = parseInt($("#presensi").val().replaceAll(',', ''));
            var uang_makan = parseInt($("#uang_makan").val().replaceAll(',', ''));
            var kehadiran = parseInt($("#kehadiran").val().replaceAll(',', ''));
            var kedisiplinan = parseInt($("#kedisiplinan").val().replaceAll(',', ''));
            var istri_suami = parseInt($("#istri_suami").val().replaceAll(',', ''));
            var anak = parseInt($("#anak").val().replaceAll(',', ''));

            var total_tunj_var = parseInt(presensi + uang_makan + kehadiran + kedisiplinan + istri_suami + anak).toLocaleString('en-US');
            $("#tunjangan_variabel").val(total_tunj_var);
        });

        $("#potongan_wajib").keyup(function() {
            var bpjs = parseInt($("#bpjs").val().replaceAll(',', ''));
            var koperasi = parseInt($("#koperasi").val().replaceAll(',', ''));
            var dapen_muh = parseInt($("#dapen_muh").val().replaceAll(',', ''));
            var lainya = parseInt($("#lainya").val().replaceAll(',', ''));

            var total_wajib = parseInt(bpjs + koperasi + dapen_muh + lainya).toLocaleString('en-US');
            $("#jumlah_pot_wajib").val(total_wajib);
        });

        $("#potongan_variabel").keyup(function() {
            var presensi_pot = parseInt($("#presensi_pot").val().replaceAll(',', ''));
            var uang_makan_pot = parseInt($("#uang_makan_pot").val().replaceAll(',', ''));
            var kehadiran_pot = parseInt($("#kehadiran_pot").val().replaceAll(',', ''));
            var kedisiplinan_pot = parseInt($("#kedisiplinan_pot").val().replaceAll(',', ''));

            var total_var = parseInt(presensi_pot + uang_makan_pot + kehadiran_pot + kedisiplinan_pot).toLocaleString('en-US');
            $("#jumlah_pot_var").val(total_var);
        });

        $("#hitung").on("click", function hitung() {
            var gaji_pokok = parseInt($("#gaji_pokok").val().replaceAll(',', ''));
            var tunjangan_tetap = parseInt($("#tunjangan_tetap").val().replaceAll(',', ''));
            var tunjangan_variabel = parseInt($("#tunjangan_variabel").val().replaceAll(',', ''));
            var jumlah_pot_var = parseInt($("#jumlah_pot_var").val().replaceAll(',', ''));
            var jumlah_pot_wajib = parseInt($("#jumlah_pot_wajib").val().replaceAll(',', ''));

            var gd = parseInt((gaji_pokok + tunjangan_tetap + tunjangan_variabel) - (jumlah_pot_var + jumlah_pot_wajib)).toLocaleString('en-US');
            $("#gaji_diterima").val(gd);

        });

        $("#jumlah_pot_wajib").on("keyup keypress keydown blur change focus", function() {
            hitung();
        });
        $("#jumlah_pot_var").on("keyup keypress keydown blur change focus", function() {
            hitung();
        });
        $("#tunjangan_variabel").on("keyup keypress keydown blur change focus", function() {
            hitung();
        });
        $("#tunjangan_tetap").on("keyup keypress keydown blur change focus", function() {
            hitung();
        });
        $("#gaji_pokok").on("keyup keypress keydown blur change focus", function() {
            hitung();
        });

    });
</script>