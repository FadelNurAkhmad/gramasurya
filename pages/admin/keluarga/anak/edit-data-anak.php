<div class="row">
	<?php
	if (isset($_GET['id_anak'])) {
		$id_anak = $_GET['id_anak'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$tampilAna	= mysqli_query($koneksi, "SELECT * FROM tb_anak WHERE id_anak='$id_anak'");
	$hasil	= mysqli_fetch_array($tampilAna);
	$notnik	= $hasil['nik'];
	$id_peg	= $hasil['id_peg'];

	if ($_POST['edit'] == "edit") {
		$nik			= $_POST['nik'];
		$nama			= $_POST['nama'];
		$tmp_lhr		= $_POST['tmp_lhr'];
		$tgl_lhr		= $_POST['tgl_lhr'];
		$jk				= $_POST['jk'];
		$pendidikan		= $_POST['pendidikan'];
		$pekerjaan		= $_POST['pekerjaan'];
		$status_hub		= $_POST['status_hub'];

		$ceknik	= mysqli_num_rows(mysqli_query($koneksi, "SELECT nik FROM tb_anak WHERE nik='$_POST[nik]' AND nik!='$notnik'"));

		if (empty($_POST['nik']) || empty($_POST['nama']) || empty($_POST['tmp_lhr']) || empty($_POST['tgl_lhr']) || empty($_POST['jk']) || empty($_POST['status_hub'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-anak&id_anak=$id_anak");
		} else if ($ceknik > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-data-anak&id_anak=$id_anak");
		} else {
			$update = mysqli_query($koneksi, "UPDATE tb_anak SET nik='$nik', nama='$nama', tmp_lhr='$tmp_lhr', tgl_lhr='$tgl_lhr', jk='$jk', pendidikan='$pendidikan', pekerjaan='$pekerjaan', status_hub='$status_hub' WHERE id_anak='$id_anak'");
			if ($update) {
				$_SESSION['pesan'] = "Good! edit data anak success ...";
				header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>