<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['true']) == 'true') {
        $id_approval_cuti = $_GET['id_approval_cuti'];

        $query       = mysqli_query($koneksi, "SELECT * FROM tb_approval_cuti_tahunan WHERE id_approval_cuti='$id_approval_cuti'");
        $data        = mysqli_fetch_array($query);
        $id_peg      = $data['id_peg'];
        $jumlah_cuti = $data['jumlah_cuti'];
        $lama_cuti   = $data['lama_cuti'];
        $status      = "Approve";

        $cekSisaCuti = mysqli_query($koneksi, "SELECT jatah_c_sisa FROM tb_jatah_cuti WHERE id_peg='$id_peg'");

        while ($cek = mysqli_fetch_array($cekSisaCuti)) {
            $sisa = $cek;
        }

        if (mysqli_num_rows($query) == 0) {
            $_SESSION['pesan'] = "Oops! Data tidak ditemukan. ...";
            header("location:index.php?page=form-view-approval-tahap2");
        } else {
            if ($sisa['jatah_c_sisa'] <= 0) {
                $_SESSION['pesan'] = "Oops! Sisa cuti telah habis. ...";
                header("location:index.php?page=form-view-approval-tahap2");
            } else {
                $cuti   = mysqli_query($koneksi, "UPDATE tb_approval_cuti_tahunan SET status='$status' WHERE id_peg='$id_peg' AND id_approval_cuti='$id_approval_cuti'");
                // $approval = mysqli_query($koneksi, "UPDATE tb_approval_cuti_tahunan SET approval='Aktif' WHERE id_approval_cuti='$id_approval_cuti'");

                if ($cuti) {
                    $approve = mysqli_query($koneksi, "UPDATE tb_jatah_cuti SET jatah_c_sisa=(jatah_c_sisa-'$lama_cuti'), jatah_c_ambil=(jatah_c_ambil+'$lama_cuti')  WHERE id_peg='$id_peg'");
                    $_SESSION['pesan'] = "Good!  Data cuti berhasil di Approve. ...";
                    header("location:index.php?page=form-view-approval-tahap2");
                } else {
                    echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
                }
            }
        }
    }
    mysqli_close($koneksi);
    ?>

    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['false']) == 'false') {
        $id_approval_cuti1 = $_GET['id_approval_cuti'];

        $query1       = mysqli_query($koneksi, "SELECT * FROM tb_approval_cuti_tahunan WHERE id_approval_cuti='$id_approval_cuti1'");
        $data1        = mysqli_fetch_array($query1);
        $id_peg1      = $data1['id_peg'];
        $jumlah_cuti1 = $data1['jumlah_cuti'];
        $status1      = "Reject";

        if (mysqli_num_rows($query1) == 0) {
            $_SESSION['pesan'] = "Oops! Data tidak ditemukan. ...";
            header("location:index.php?page=form-view-approval-tahap2");
        } else {
            $cuti1   = mysqli_query($koneksi, "UPDATE tb_approval_cuti_tahunan SET status='$status1' WHERE id_peg='$id_peg1' AND id_approval_cuti='$id_approval_cuti1'");
            $cuti2   = mysqli_query($koneksi, "UPDATE tb_data_cuti SET status='$status1' WHERE id_peg='$id_peg1' AND id_cuti='$id_approval_cuti1'");
            // $approval1 = mysqli_query($koneksi, "UPDATE tb_approval_cuti_tahunan SET approval='' WHERE id_approval_cuti='$id_approval_cuti1'");

            if ($cuti1) {
                $_SESSION['pesan'] = "Good!  Data cuti berhasil di Reject. ...";
                header("location:index.php?page=form-view-approval-tahap2");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
        mysqli_close($koneksi);
    }
    ?>
</div>