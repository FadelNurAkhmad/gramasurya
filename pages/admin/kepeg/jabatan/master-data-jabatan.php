<div class="row">
	<?php
	if (isset($_GET['id_jab'])) {
		$id_jab = $_GET['id_jab'];
	} else {
		die("Error. No ID Selected! ");
	}

	if ($_POST['save'] == "save") {
		$id_peg			= $_POST['pegawai_id'];
		$unit			= $_POST['unit'];
		$jabatan		= $_POST['jabatan'];
		$no_sk			= $_POST['no_sk'];
		$tgl_sk			= $_POST['tgl_sk'];
		$tmt_jabatan	= $_POST['tmt_jabatan'];
		$sampai_tgl		= $_POST['sampai_tgl'];
		$file			= $_FILES['file']['name'];

		include "../../config/koneksi.php";

		if (empty($_POST['pegawai_id']) || empty($_POST['unit']) || empty($_POST['jabatan'])) {
			$_SESSION['pesan'] = "Oops! Please fill jabatan column ...";
			header("location:index.php?page=form-master-data-jabatan");
		} else {
			$insert = "INSERT INTO tb_jabatan (id_jab, id_peg, unit, jabatan, no_sk, tgl_sk, tmt_jabatan, sampai_tgl, file) VALUES ('$id_jab', '$id_peg', '$unit', '$jabatan', '$no_sk', '$tgl_sk', '$tmt_jabatan', '$sampai_tgl', '$file')";
			$query = mysqli_query($koneksi, $insert);

			if ($query) {
				$_SESSION['pesan'] = "Good! Insert data jabatan success ...";
				header("location:index.php?page=form-master-data-jabatan");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
			if (strlen($file) > 0) {
				if (is_uploaded_file($_FILES['file']['tmp_name'])) {
					move_uploaded_file($_FILES['file']['tmp_name'], "../../assets/file/" . $file);
				}
			}
		}
	}
	?>
</div>