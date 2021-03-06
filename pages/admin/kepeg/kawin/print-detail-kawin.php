<?php
ob_start();
include'../../../../assets/plugins/tcpdf/tcpdf.php';

class MYPDF extends TCPDF {
	public function Header() {
        // Logo
        //$image_file ='../../../assets/images/avatars/print.png';
		//$this->Image($image_file, 10, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Header
        //$html = '<p><b>REPORT STOCK</b></p>';
		//$this->writeHTMLCell($w = 0, $h = 0, $x = 40, $y = 10, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
    }
}

$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Andi Hatmoko');
$pdf->SetTitle('Report');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(25, 8, 20);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 20);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8.1);

	include "../../../../config/koneksi.php";
	
	if (isset($_GET['id_kawin'])) {
		$id_kawin = $_GET['id_kawin'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	$query	=mysqli_query($koneksi, "SELECT * FROM tb_kawin WHERE id_kawin='$id_kawin'");
	$data	=mysqli_fetch_array($query, MYSQLI_ASSOC);
	list($y1,$m1,$d1)	=explode ("-",$data['tgl_izin']);
	list($y2,$m2,$d2)	=explode ("-",$data['tgl_lahir']);
	list($y3,$m3,$d3)	=explode ("-",$data['tgl_kawin']);
	list($y4,$m4,$d4)	=explode ("-",$data['tgl_ditetapkan']);
	
	//
	if ($m1 == "01"){
		$m1	="Januari";
	}
	else if ($m1 == "02"){
		$m1 ="Februari";
	}
	else if ($m1 == "03"){
		$m1 ="Maret";
	}
	else if ($m1 == "04"){
		$m1 ="April";
	}
	else if ($m1 == "05"){
		$m1 ="Mei";
	}
	else if ($m1 == "06"){
		$m1 ="Juni";
	}
	else if ($m1 == "07"){
		$m1 ="Juli";
	}
	else if ($m1 == "08"){
		$m1 ="Agustus";
	}
	else if ($m1 == "09"){
		$m1 ="September";
	}
	else if ($m1 == "10"){
		$m1 ="Oktober";
	}
	else if ($m1 == "11"){
		$m1 ="November";
	}
	else if ($m1 == "12"){
		$m1 ="Desember";
	}
	
	//
	if ($m2 == "01"){
		$m2	="Januari";
	}
	else if ($m2 == "02"){
		$m2 ="Februari";
	}
	else if ($m2 == "03"){
		$m2 ="Maret";
	}
	else if ($m2 == "04"){
		$m2 ="April";
	}
	else if ($m2 == "05"){
		$m2 ="Mei";
	}
	else if ($m2 == "06"){
		$m2 ="Juni";
	}
	else if ($m2 == "07"){
		$m2 ="Juli";
	}
	else if ($m2 == "08"){
		$m2 ="Agustus";
	}
	else if ($m2 == "09"){
		$m2 ="September";
	}
	else if ($m2 == "10"){
		$m2 ="Oktober";
	}
	else if ($m2 == "11"){
		$m2 ="November";
	}
	else if ($m2 == "12"){
		$m2 ="Desember";
	}
	
	//
	if ($m3 == "01"){
		$m3	="Januari";
	}
	else if ($m3 == "02"){
		$m3 ="Februari";
	}
	else if ($m3 == "03"){
		$m3 ="Maret";
	}
	else if ($m3 == "04"){
		$m3 ="April";
	}
	else if ($m3 == "05"){
		$m3 ="Mei";
	}
	else if ($m3 == "06"){
		$m3 ="Juni";
	}
	else if ($m3 == "07"){
		$m3 ="Juli";
	}
	else if ($m3 == "08"){
		$m3 ="Agustus";
	}
	else if ($m3 == "09"){
		$m3 ="September";
	}
	else if ($m3 == "10"){
		$m3 ="Oktober";
	}
	else if ($m3 == "11"){
		$m3 ="November";
	}
	else if ($m3 == "12"){
		$m3 ="Desember";
	}
	
	//
	if ($m4 == "01"){
		$m4	="Januari";
	}
	else if ($m4 == "02"){
		$m4 ="Februari";
	}
	else if ($m4 == "03"){
		$m4 ="Maret";
	}
	else if ($m4 == "04"){
		$m4 ="April";
	}
	else if ($m4 == "05"){
		$m4 ="Mei";
	}
	else if ($m4 == "06"){
		$m4 ="Juni";
	}
	else if ($m4 == "07"){
		$m4 ="Juli";
	}
	else if ($m4 == "08"){
		$m4 ="Agustus";
	}
	else if ($m4 == "09"){
		$m4 ="September";
	}
	else if ($m4 == "10"){
		$m4 ="Oktober";
	}
	else if ($m4 == "11"){
		$m4 ="November";
	}
	else if ($m4 == "12"){
		$m4 ="Desember";
	}
	
	$tampilPeg   =mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$data[id_peg]'");
	$peg    =mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
	
	$tampilUni   =mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
	$uni    =mysqli_fetch_array($tampilUni, MYSQLI_ASSOC);
	
	$tampilSek	=mysqli_query($koneksi, "SELECT * FROM tb_setup_sekda WHERE id_setup_sekda='1'");
	$setsek	=mysqli_fetch_array($tampilSek, MYSQLI_ASSOC);
	
	$sekda	=mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$setsek[sekda]'");
	$sek	=mysqli_fetch_array($sekda, MYSQLI_ASSOC);
	
$head ='<table border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td width="100" rowspan="3"><img src="../../../../assets/img/logo.png" width="70" height="70"/></td>
				<td width="385" align="center"><font size="10" style="text-transform:uppercase;">PEMERINTAH KABUPATEN '.$setsek['kab'].'</font></td>	
				<td width="100" rowspan="3"></td>
			</tr>
			<tr>
				<td align="center"><font size="12" style="text-transform:uppercase;font-weight:bold;">SEKRETARIAT DAERAH</font></td>	
			</tr>
			<tr>
				<td align="center"><font size="9">'.$setsek['alamat'].'</font></td>	
			</tr>
		</table>
		<table border="2" cellspacing="0" cellpadding="0">
		</table>';	
$pdf->writeHTML($head, true, false, false, false, '');

$subhead ='<table border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td width="585" align="center"><font size="9" style="text-transform:uppercase;"><u><b>SURAT KETERANGAN IZIN KAWIN</b></u></font></td>	
			</tr>
			<tr>
				<td align="center"><font size="8"><b>NOMOR: '.$data['no_kawin'].'</b></font></td>	
			</tr>
		</table><br />';	
$pdf->writeHTML($subhead, true, false, false, false, '');

$html ='<table border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td width="50%" colspan="4">Berdasarkan surat izin kawin tanggal</td>
				<td width="2%">:</td>
				<td width="48%">'.$d1.' '.$m1.' '.$y1.'</td>
			</tr>
			<tr>
				<td colspan="4">Dengan ini memberikan izin kepada</td>
				<td>:</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td width="6%">1.</td>
				<td width="44%" colspan="3">Nama</td>
				<td width="2%">:</td>
				<td width="48%">'.$peg['nama'].'</td>
			</tr>
			<tr>
				<td>2.</td>
				<td colspan="3">NIP/NIK</td>
				<td>:</td>
				<td>'.$peg['nip'].'</td>
			</tr>
			<tr>
				<td>3.</td>
				<td colspan="3">Pangkat / Golongan Ruang</td>
				<td>:</td>
				<td>'.$peg['pangkat'].' / '.$peg['urut_pangkat'].'</td>
			</tr>
			<tr>
				<td>4.</td>
				<td colspan="3">Jabatan</td>
				<td>:</td>
				<td>'.$peg['jabatan'].'</td>
			</tr>
			<tr>
				<td>5.</td>
				<td colspan="3">Pada Instansi/Dinas</td>
				<td>:</td>
				<td>'.$uni['nama'].'</td>
			</tr>
			<tr>
				<td>6.</td>
				<td colspan="3">Tempat & Tanggal Lahir</td>
				<td>:</td>
				<td>'.$peg['tempat_lhr'].', '.$peg['tgl_lhr'].'</td>
			</tr>
			<tr>
				<td>7.</td>
				<td colspan="3">Kebangsaan</td>
				<td>:</td>
				<td>'.$data['bangsa1'].'</td>
			</tr>
			<tr>
				<td>8.</td>
				<td colspan="3">Agama</td>
				<td>:</td>
				<td>'.$peg['agama'].'</td>
			</tr>
			<tr>
				<td width="6%">9.</td>
				<td width="12%">Wali</td>
				<td width="12%">a. (BAPAK)</td>
				<td width="20%">a. Nama</td>
				<td width="2%">:</td>
				<td width="48%">'.$data['nama_wali_bapak1'].'</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>b. Pekerjaan</td>
				<td>:</td>
				<td>'.$data['kerja_wali_bapak1'].'</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>c. Alamat</td>
				<td>:</td>
				<td>'.$data['alamat_wali_bapak1'].'</td>
			</tr>
			<tr>
				<td width="6%">&nbsp;</td>
				<td width="12%">&nbsp;</td>
				<td width="12%">b. (IBU)</td>
				<td width="20%">a. Nama</td>
				<td width="2%">:</td>
				<td width="48%">'.$data['nama_wali_ibu1'].'</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>b. Pekerjaan</td>
				<td>:</td>
				<td>'.$data['kerja_wali_ibu1'].'</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>c. Alamat</td>
				<td>:</td>
				<td>'.$data['alamat_wali_ibu1'].'</td>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="10">
			<tr align="center">
				<td colspan="6"><b>UNTUK KAWIN DENGAN</b></td>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td width="6%">1.</td>
				<td width="44%" colspan="3">Nama</td>
				<td width="2%">:</td>
				<td width="48%">'.$data['nama'].'</td>
			</tr>
			<tr>
				<td>2.</td>
				<td colspan="3">Tempat & Tanggal Lahir</td>
				<td>:</td>
				<td>'.$data['tmp_lahir'].', '.$d2.' '.$m2.' '.$y2.'</td>
			</tr>
			<tr>
				<td>3.</td>
				<td colspan="3">Pekerjaan</td>
				<td>:</td>
				<td>'.$data['pekerjaan'].'</td>
			</tr>
			<tr>
				<td>4.</td>
				<td colspan="3">NIP/NIK</td>
				<td>:</td>
				<td>'.$data['nik'].'</td>
			</tr>
			<tr>
				<td>5.</td>
				<td colspan="3">Pangkat/Golongan</td>
				<td>:</td>
				<td>'.$data['pangkat'].' / '.$data['gol'].'</td>
			</tr>
			<tr>
				<td>6.</td>
				<td colspan="3">Jabatan</td>
				<td>:</td>
				<td>'.$data['jab'].'</td>
			</tr>
			<tr>
				<td>7.</td>
				<td colspan="3">Pada Instansi/Dinas</td>
				<td>:</td>
				<td>'.$data['instansi'].'</td>
			</tr>
			<tr>
				<td>8.</td>
				<td colspan="3">Kebangsaan</td>
				<td>:</td>
				<td>'.$data['bangsa2'].'</td>
			</tr>
			<tr>
				<td>9.</td>
				<td colspan="3">Agama</td>
				<td>:</td>
				<td>'.$data['agama'].'</td>
			</tr>
			<tr>
				<td>10.</td>
				<td colspan="3">Alamat dan tempat tinggal</td>
				<td>:</td>
				<td>'.$data['alamat'].'</td>
			</tr>
			<tr>
				<td width="6%">11.</td>
				<td width="12%">Wali</td>
				<td width="12%">a. (BAPAK)</td>
				<td width="20%">a. Nama</td>
				<td width="2%">:</td>
				<td width="48%">'.$data['nama_wali_bapak2'].'</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>b. Pekerjaan</td>
				<td>:</td>
				<td>'.$data['kerja_wali_bapak2'].'</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>c. Alamat</td>
				<td>:</td>
				<td>'.$data['alamat_wali_bapak2'].'</td>
			</tr>
			<tr>
				<td width="6%">&nbsp;</td>
				<td width="12%">&nbsp;</td>
				<td width="12%">b. (IBU)</td>
				<td width="20%">a. Nama</td>
				<td width="2%">:</td>
				<td width="48%">'.$data['nama_wali_ibu2'].'</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>b. Pekerjaan</td>
				<td>:</td>
				<td>'.$data['kerja_wali_ibu2'].'</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>c. Alamat</td>
				<td>:</td>
				<td>'.$data['alamat_wali_ibu2'].'</td>
			</tr>
			<tr>
				<td width="50%" colspan="4">Perkawinan akan diselenggarakan di</td>
				<td width="2%">:</td>
				<td width="48%">'.$data['tmp_kawin'].'</td>
			</tr>
			<tr>
				<td colspan="4">Pada Bulan</td>
				<td>:</td>
				<td>'.$d3.' '.$m3.' '.$y3.'</td>
			</tr>
		</table><br /><br />
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>Demikian Surat Keterangan Izin Kawin ini diberikan untuk dipergunakan seperlunya.</td>
			</tr>
		</table>';
$pdf->writeHTML($html, true, false, false, false, '');

$sign = '<table cellpadding="1" border="0">
			<tr>
				<td width="60%"></td>
				<td width="20%">Ditetapkan di</td>
				<td width="20%">: <font style="text-transform:uppercase;">'.$setsek['kab'].'</font></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><u>Pada Tanggal &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : '.$d4.' '.$m4.' '.$y4.' </u></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr align="center">
				<td>&nbsp;</td>
				<td colspan="2"><font size="8" style="text-transform:uppercase;font-weight:bold;">An. BUPATI '.$setsek['kab'].'</font></td>
			</tr>
			<tr align="center">
				<td></td>
				<td colspan="2"><font size="8" style="text-transform:uppercase;font-weight:bold;">SEKRETARIS DAERAH</font></td>
			</tr>
			<tr>
				<td height="50"></td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2" align="center"><font size="8"><b>'.$sek['nama'].'</b></font></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2" align="center"><font size="8">'.$sek['pangkat'].'</font></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2" align="center"><font size="8"><b>NIP. '.$sek['nip'].'</b></font></td>
			</tr>
		</table>';
$pdf->writeHTML($sign, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('IZIN_KAWIN_'.$data['no_kawin'].'.pdf', 'I');
?>