<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['true1']) == 'true1') {
        $id_approval_umum = $_GET['id_approval_umum'];

        $query       = mysqli_query($koneksi, "SELECT * FROM tb_approval_cuti_umum WHERE id_approval_umum='$id_approval_umum'");
        $data        = mysqli_fetch_array($query);
        $id_peg      = $data['id_peg'];
        $jumlah_cuti = $data['jumlah_cuti'];
        $status      = "Approve";

        $queryJenisCuti = mysqli_query($koneksi, "SELECT * FROM tb_jenis_cuti WHERE jenis = '$data[jenis_cuti]'");
        $tb_jenis_cuti = mysqli_fetch_array($queryJenisCuti, MYSQLI_ASSOC);

        if (mysqli_num_rows($query) == 0) {
            $_SESSION['pesan'] = "Oops! Data tidak ditemukan. ...";
            header("location:index.php?page=form-view-approval-tahap2");
        } else {
            $cuti   = mysqli_query($koneksi, "UPDATE tb_approval_cuti_umum SET status='$status' WHERE id_peg='$id_peg' AND id_approval_umum='$id_approval_umum'");
            $shift_result = mysqli_query($koneksi, "UPDATE shift_result SET izin_jenis_id = '$tb_jenis_cuti[id_jenis]' WHERE pegawai_id = $id_peg AND tgl_shift >= '$data[tanggal_mulai]' AND tgl_shift <= '$data[tanggal_selesai]'");

            if ($cuti) {
                $_SESSION['pesan'] = "Good!  Data izin berhasil di Approve. ...";
                header("location:index.php?page=form-view-approval-tahap2");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }

    mysqli_close($koneksi);
    ?>

    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['false1']) == 'false1') {
        $id_approval_umum1 = $_GET['id_approval_umum'];

        $query1       = mysqli_query($koneksi, "SELECT * FROM tb_approval_cuti_umum WHERE id_approval_umum='$id_approval_umum1'");
        $data1        = mysqli_fetch_array($query1);
        $id_peg1      = $data1['id_peg'];
        $jumlah_cuti1 = $data1['jumlah_cuti'];
        $status1      = "Reject";

        if (mysqli_num_rows($query1) == 0) {
            $_SESSION['pesan'] = "Oops! Data tidak ditemukan. ...";
            header("location:index.php?page=form-view-approval-tahap2");
        } else {
            $cuti1   = mysqli_query($koneksi, "UPDATE tb_approval_cuti_umum SET status='$status1' WHERE id_peg='$id_peg1' AND id_approval_umum='$id_approval_umum1'");
            // $approval1 = mysqli_query($koneksi, "UPDATE tb_approval_cuti_umum SET approval='' WHERE id_approval_umum='$id_approval_umum1'");

            if ($cuti1) {
                $_SESSION['pesan'] = "Good!  Data izin berhasil di Reject. ...";
                header("location:index.php?page=form-view-approval-tahap2");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
        mysqli_close($koneksi);
    }
    ?>
</div>