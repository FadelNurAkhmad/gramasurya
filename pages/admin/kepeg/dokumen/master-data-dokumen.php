<div class="row">
    <?php
    if (isset($_GET['id_dokumen'])) {
        $id_dokumen = $_GET['id_dokumen'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $id_peg            = $_POST['id_peg'];
        $dokumen        = $_POST['dokumen'];
        $file            = $_FILES['file']['name'];
        $ekstensi       = array('pdf');
        $ext            = pathinfo($file, PATHINFO_EXTENSION);
        $ukuran        = $_FILES['file']['size'];

        include "../../config/koneksi.php";

        if (empty($_POST['id_peg']) || empty($_POST['dokumen'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-data-dokumen");
        } else {
            if (!in_array($ext, $ekstensi)) {
                $_SESSION['pesan'] = "Oops! File extensions not available. Only PDF ...";
                header("location:index.php?page=form-master-data-dokumen");
            } else {
                if ($ukuran > 5000000 === false) {
                    $insert = "INSERT INTO tb_dokumen (id_dokumen, id_peg, dokumen, file) VALUES ('$id_dokumen', '$id_peg', '$dokumen', '$file')";
                    $query = mysqli_query($koneksi, $insert);

                    if ($query) {
                        $_SESSION['pesan'] = "Good! Insert data dokumen success ...";
                        header("location:index.php?page=form-master-data-dokumen");
                    } else {
                        echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
                    }
                    if (strlen($file) > 0) {
                        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                            move_uploaded_file($_FILES['file']['tmp_name'], "../../assets/file/" . $file);
                        }
                    }
                } else {
                    $_SESSION['pesan'] = "Oops! Ukuran File Terlalu Besar ...";
                    header("location:index.php?page=form-master-data-dokumen");
                }
            }
        }
    }
    ?>
</div>