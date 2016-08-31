<?php
ob_clean();

// Include the main TCPDF library (search for installation path).
require_once('../config/tcpdf.php');

//query
$reg = $_POST['reg'];
$id_kls = $_POST['kls'];

$setcl = $DB_connect->query("SELECT DISTINCT tgl_input FROM stu_absen_ci WHERE id_reg = '$reg'");
$setcl->execute();
$tgl2 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT materi FROM stu_absen_ci WHERE id_reg = '$reg'");
$setcl->execute();
$materi = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT materi FROM stu_absen_ci WHERE id_reg = '$reg'");
$setcl->execute();
$id = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->prepare("SELECT * FROM studen_ci WHERE id_kls = '$id_kls'");
$setcl->execute();
$murid = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->prepare("SELECT * FROM reg_teach_ci 
                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
                                 WHERE reg_teach_ci.id_reg = '$reg'
                                 ORDER BY grade_kls");
$setcl->execute();
$kelas = $setcl->fetch(PDO::FETCH_ASSOC);

$no = 1;
$no2 = 1;


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Deny');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage('L', 'A4');

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$tbl = '
<table>
	<thead>
		<tr>
			<th rowspan="2" colspan="3" style="border-top: thin solid black;border-bottom: 1px solid black;">Jurnal Mengajar</th>';

$setcl = $DB_connect->query("SELECT DISTINCT tgl_input FROM stu_absen_ci WHERE id_reg = '$reg'");
$setcl->execute();
$tgl = $setcl->fetchAll(PDO::FETCH_ASSOC);

foreach ($tgl as $tgl) {
$tbl = $tbl .'<th style="border-top: thin solid black;">'.$no++.'</th>';
}

$tbl = $tbl .'
		</tr>
		<tr>
';

foreach ($tgl2 as $tgl2) {
$tanggal = date("d M Y", strtotime($tgl2['tgl_input']));
$tbl = $tbl .'
			<th class="bg-grayLight" style="border-top: 1px solid black;">'.$tanggal.'</th>
';
}

$tbl = $tbl .'
		</tr>
		<tr>
			<th class="bg-blue" colspan="3" style="border-bottom: 1px solid black;">Materi</th>
';

foreach ($materi as $materi) {

$tbl = $tbl .'
			<th style="border-top: 1px solid black;">'.$materi['materi'].'</th>
';
}

$tbl = $tbl .'
		</tr>
		<tr>
			<th class="bg-teal" colspan="3" style="border-bottom: thin solid black;">Jumlah Kehadiran</th>
';

foreach ($id as $id) {
$rows = $DB_connect->query("SELECT count(kd_absen) FROM stu_absen_ci WHERE materi = '".$id['materi']."' AND kd_absen = 1 AND id_reg = '$reg'")->fetchColumn();
$tbl = $tbl .'
		<th style="border-top: 1px solid black;border-bottom: thin solid black;">'.$rows.'</th>
';
}

$tbl = $tbl .'
		</tr>
	</thead>
	<tbody>
';

foreach ($murid as $murid) {
	$tbl = $tbl .'
			<tr>
				<td style="border-right: 1px solid grey;border-left: 1px solid grey;border-bottom: 1px solid grey;">'.$no2++.'</td>
				<td style="border-right: 1px solid grey;border-bottom: 1px solid grey;">'.$murid['nis'].'</td>
				<td style="border-right: 1px solid grey;border-bottom: 1px solid grey;">'.$murid['nam_stu'].'</td>
	';
	$setcl = $DB_connect->prepare("SELECT * FROM stu_absen_ci WHERE id_stu = '".$murid['id_stu']."'");
	$setcl->execute();
	$absensi = $setcl->fetchAll(PDO::FETCH_ASSOC);
	foreach ($absensi as $absensi) {
			if ($absensi['kd_absen'] == '1') {
				$absen = 'Hadir';
			}
			elseif ($absensi['kd_absen'] == '2') {
				$absen = 'Sakit';
			}
			elseif ($absensi['kd_absen'] == '3') {
				$absen = 'Izin';
			}
			else{
				$absen = 'Alpha';
			}
			$tbl = $tbl .'<td style="border-right: 1px solid grey;border-bottom: 1px solid grey;">'.$absen.'</td>';
		}
	$tbl = $tbl .'</tr>';
}



$tbl = $tbl .'
	</tbody>
	</table>
';

$pdf->writeHTML($tbl, true, false, false, false, '');

// Close and output PDF document
// This method has several options, check the source code documentation for more information.

$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>