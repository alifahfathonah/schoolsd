<?php
ob_clean();

// Include the main TCPDF library (search for installation path).
require_once('../config/tcpdf.php');

//query
$reg = $_POST['reg'];
$id_kls = $_POST['kls'];
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 048');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

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

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage('L');

$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------


// -----------------------------------------------------------------------------
$setcl = $DB_connect->query("SELECT DISTINCT ket FROM stu_nilai_ci 
               WHERE id_reg = '$reg' AND tipe_nilai = 2");
$setcl->execute();
$tgl33 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$limit = count($tgl33);

$setcl = $DB_connect->query("SELECT DISTINCT tgl_input FROM stu_absen_ci 
               INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
               WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 1");
$setcl->execute();
$tgl3 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT * FROM stu_absen_ci 
               INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
               WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 2 LIMIT $limit");
$setcl->execute();
$tgl4 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT materi FROM stu_absen_ci 
               INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
               WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 1");
$setcl->execute();
$kkm1 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT ket FROM stu_absen_ci 
               INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
               WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 2");
$setcl->execute();
$kkm2 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT materi FROM stu_absen_ci 
               INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
               WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 1");
$setcl->execute();
$kkm0 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT ket FROM stu_absen_ci 
               INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
               WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 2");
$setcl->execute();
$kkm4 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT ket FROM stu_absen_ci 
               INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
               WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 3");
$setcl->execute();
$kkm5 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT ket FROM stu_absen_ci 
               INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
               WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 4");
$setcl->execute();
$kkm8 = $setcl->fetchAll(PDO::FETCH_ASSOC);



$setcl = $DB_connect->query("SELECT * FROM studen_ci
               WHERE id_kls = '$id_kls'");
$setcl->execute();
$studen = $setcl->fetchAll(PDO::FETCH_ASSOC);

// Table with rowspans and THEAD
$tbl = <<<EOD
<table class="datatable align-center" id="tab-class" data-role="datatable">
<thead>
 <tr>
  <td align="center" style="background-color:#8c8c8c;color:#000000;"><b>No</b></td>
  <td align="center" style="background-color:#8c8c8c;color:#000000;"><b>NIS</b></td>
  <td style="background-color:#ff9933;color:#000000;"><b>Tanggal =></b></td>
EOD;

foreach ($tgl3 as $tgl3) {
$tbl .=<<<EOD
  <td style="background-color:#3399ff;color:#000000;"><b>{$tgl3['tgl_input']}</b></td>
EOD;
}

$tbl .=<<<EOD
  <td rowspan=3 align="center" style="background-color:#00ff00;color:#000000;"> <b>Rata - Rata</b></td>
EOD;

foreach ($tgl4 as $tgl4) {
$tbl .=<<<EOD
  <td align="center" style="background-color:#ffff00;color:#000000;"> <b>{$tgl4['tgl_input']}</b></td>
EOD;
}

$tbl .=<<<EOD
  <td rowspan=3 align="center" style="background-color:#00ff00;color:#000000;"> <b>Rata - Rata</b></td>
  <td rowspan=2 align="center" style="background-color:#ff9933;color:#000000;"> <b>UTS</b></td>
  <td rowspan=2 align="center" style="background-color:#ff9933;color:#000000;"> <b>UAS</b></td>
</tr>
<tr style="background-color:#FF0000;color:#FFFF00;">
  <td colspan="3" align="center"><b>Materi</b></td>


EOD;

foreach ($kkm1 as $kkm1) {
$tbl .=<<<EOD
   <th style="background-color:#3399ff;color:#000000;">{$kkm1['materi']}</th>
EOD;
}

$tbl .=<<<EOD
   <th style="background-color:#00ff00;color:#000000;"></th>
EOD;

foreach ($kkm2 as $kkm2) {
$tbl .=<<<EOD
   <th style="background-color:#ffff00;color:#000000;">{$kkm2['ket']}</th>
EOD;
}

$tbl .=<<<EOD
    <th style="background-color:#00ff00;color:#000000;"></th>
    <th style="background-color:#ff9933;color:#000000;"></th>
    <th style="background-color:#ff9933;color:#000000;"></th>
 </tr>
    <tr style="background-color:#FF0000;color:#FFFF00;">
    <th colspan="3" align="center" style="border-bottom: thin solid black;"><b>Kriteria Ketuntasan Minimal (KKM)</b></th>
EOD;

foreach ($kkm0 as $kkm0) {
        $setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci 
                       INNER JOIN stu_absen_ci on stu_nilai_ci.id_absen = stu_absen_ci.id_absen
                       WHERE stu_absen_ci.materi = '".$kkm0['materi']."'");
        $setcl->execute();
        $kkm3 = $setcl->fetch(PDO::FETCH_ASSOC);
$tbl .=<<<EOD
   <th style="background-color:#3399ff;color:#000000;border-bottom: thin solid black;">{$kkm3['kkm']}</th>
EOD;
}

$tbl .=<<<EOD
   <th style="background-color:#00ff00;color:#000000;border-bottom: thin solid black;"></th>
EOD;

foreach ($kkm4 as $kkm4) { 
        $setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci 
                       INNER JOIN stu_absen_ci on stu_nilai_ci.id_absen = stu_absen_ci.id_absen
                       WHERE ket = '".$kkm4['ket']."'");
        $setcl->execute();
        $kkm6 = $setcl->fetch(PDO::FETCH_ASSOC);
$tbl .=<<<EOD
   <th style="background-color:#ffff00;color:#000000;border-bottom: thin solid black;">{$kkm6['kkm']}</th>
EOD;
}

$tbl .=<<<EOD
   <th style="background-color:#00ff00;color:#000000;border-bottom: thin solid black;"></th>
EOD;

foreach ($kkm5 as $kkm5) { 
        $setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci 
                       INNER JOIN stu_absen_ci on stu_nilai_ci.id_absen = stu_absen_ci.id_absen
                       WHERE ket = '".$kkm5['ket']."'");
        $setcl->execute();
        $kkm7 = $setcl->fetch(PDO::FETCH_ASSOC);
$tbl .=<<<EOD
   <th style="background-color:#ff9933;color:#000000;border-bottom: thin solid black;">{$kkm7['kkm']}</th>
EOD;
}

foreach ($kkm8 as $kkm8) { 
        $setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci 
                       INNER JOIN stu_absen_ci on stu_nilai_ci.id_absen = stu_absen_ci.id_absen
                       WHERE ket = '".$kkm8['ket']."'");
        $setcl->execute();
        $kkm9 = $setcl->fetch(PDO::FETCH_ASSOC);
$tbl .=<<<EOD
   <th style="background-color:#ff9933;color:#000000;" style="border-bottom: thin solid black;">{$kkm9['kkm']}</th>
EOD;
}

$tbl .=<<<EOD
</tr>
</thead>
 <tbody>
EOD;

      foreach ($studen as $studen) { 
      $setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci
               WHERE id_stu = '".$studen['id_stu']."' AND tipe_nilai = 1");
      $setcl->execute();
      $studen2 = $setcl->fetchAll(PDO::FETCH_ASSOC);

      $setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci
               WHERE id_stu = '".$studen['id_stu']."' AND tipe_nilai = 2 LIMIT $limit");
      $setcl->execute();
      $studen3 = $setcl->fetchaLL(PDO::FETCH_ASSOC);

      $setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci
               WHERE id_stu = '".$studen['id_stu']."' AND tipe_nilai = 3 LIMIT 1");
      $setcl->execute();
      $studen4 = $setcl->fetchall(PDO::FETCH_ASSOC);

      $setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci
               WHERE id_stu = '".$studen['id_stu']."' AND tipe_nilai = 4 LIMIT 1");
      $setcl->execute();
      $studen5 = $setcl->fetchall(PDO::FETCH_ASSOC);

      $setcl = $DB_connect->query("SELECT sum(nilai_aktual)/ $limit as sumtugas FROM studen_ci
                      INNER JOIN stu_nilai_ci ON stu_nilai_ci.id_stu = studen_ci.id_stu
                      WHERE studen_ci.id_stu = '".$studen['id_stu']."' AND tipe_nilai = 2");
      $setcl->execute();
      $hasiltugas = $setcl->fetch(PDO::FETCH_ASSOC);

      $rows5 = $DB_connect->query("SELECT DISTINCT count(nilai_aktual) FROM stu_nilai_ci
               WHERE id_stu = '".$studen['id_stu']."' AND tipe_nilai = 1")->fetchColumn();

      $setcl = $DB_connect->query("SELECT sum(nilai_aktual)/ $rows5 as sumtugas FROM studen_ci
                      INNER JOIN stu_nilai_ci ON stu_nilai_ci.id_stu = studen_ci.id_stu
                      WHERE studen_ci.id_stu = '".$studen['id_stu']."' AND tipe_nilai = 1");
      $setcl->execute();
      $hasilulg = $setcl->fetch(PDO::FETCH_ASSOC);

      $no3 = 1;


$tbl .=<<<EOD
<tr>
<td class="bg-grayLight" style="background-color:#8c8c8c;color:#000000;" align="center">{$no3}</td>
<td class="bg-grayLight" style="background-color:#8c8c8c;color:#000000;" align="center">{$studen['nis']}</td>
<td>{$studen['nam_stu']}</td>
EOD;

foreach ($studen2 as $studen2) {
  $tbl .=<<<EOD
<td style="background-color:#3399ff;color:#000000;">{$studen2['nilai_aktual']}</td>
EOD;
}

$tbl .=<<<EOD
  <td class="bg-lime" style="background-color:#00ff00;color:#000000;">{$hasilulg['sumtugas']}</td>
EOD;

foreach ($studen3 as $studen3) {
$tbl .=<<<EOD
  <td class="bg-lime">{$studen3['nilai_aktual']}</td>
EOD;
}

$tbl .=<<<EOD
  <td class="bg-lime">{$hasiltugas['sumtugas']}</td>
EOD;

foreach ($studen4 as $studen4) {
$tbl .=<<<EOD
  <td class="bg-lime">{$studen4['nilai_aktual']}</td>
EOD;
}

foreach ($studen5 as $studen5) {
$tbl .=<<<EOD
  <td class="bg-lime">{$studen5['nilai_aktual']}</td>
EOD;
}

$tbl .=<<<EOD
</tr>
EOD;

$no3++;
}


$tbl .=<<<EOD
</tbody>
</table>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');


// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+