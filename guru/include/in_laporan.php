<?php 

$reg = $_POST['reg'][0];
$id_kls = $_POST['kls'][0];

$setcl = $DB_connect->query("SELECT DISTINCT tgl_input FROM stu_absen_ci WHERE id_reg = '$reg'");
$setcl->execute();
$tgl = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT tgl_input FROM stu_absen_ci WHERE id_reg = '$reg'");
$setcl->execute();
$tgl2 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT tgl_input FROM stu_absen_ci WHERE id_reg = '$reg'");
$setcl->execute();
$tgl3 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT materi FROM stu_absen_ci WHERE id_reg = '$reg'");
$setcl->execute();
$materi = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT materi FROM stu_absen_ci WHERE id_reg = '$reg'");
$setcl->execute();
$materi2 = $setcl->fetchAll(PDO::FETCH_ASSOC);

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
?>
<h1 class="text-light">Laporan</h1>
<h4 class="text-light">Silahkan buat rekap laporan nilai kelas <?php echo $kelas['nm_kls']; ?></h4>
<hr class="thin bg-grayLighter">

<?php if ($_POST['laporan'] == 'absen') { ?>
<div class="align-right">
	<form method="post" action="?page=p_list_absen" target="_blank">
		<input type="text" name="kls" value="<?php echo $id_kls; ?>" hidden>
        <input type="text" name="reg" value="<?php echo $reg; ?>" hidden>
		<a href="#" class="button primary" onclick="showDialog('#dialog')"><span class="mif-chart-bars"></span> Lihat grafik</a>
		<button class="button warning"><span class="mif-printer"></span> Cetak</button>
	</form>
</div>

<br><br>

Data absensi
<table class="datatable align-center" id="tab-class" data-role="datatable">
	<thead>
		<tr>
			<th class="bg-lime" rowspan="2" colspan="3">Jurnal Mengajar</th>
			<?php foreach ($tgl as $tgl) {
			?>
			<th class="bg-grayLight"><?php echo $no++; ?></th>
			<?php } ?>
		</tr>	
		<tr>
			<?php foreach ($tgl2 as $tgl2) {?>
			<th class="bg-grayLight" style="border-top: thin solid grey;"><?php echo date("d M Y", strtotime($tgl2['tgl_input'])); ?></th>
			<?php } ?>
		</tr>
		<tr>
			<th class="bg-blue" colspan="3">Materi</th>
			<?php foreach ($materi as $materi) {?>
			<th class="bg-amber" style="border-top: thin solid grey;"><?php echo $materi['materi']; ?></th>
			<?php } ?>
		</tr>
		<tr>
			<th class="bg-teal" colspan="3">Kehadiran Perkelas</th>
			<?php foreach ($id as $id) {
				  $rows = $DB_connect->query("SELECT count(kd_absen) FROM stu_absen_ci WHERE materi = '".$id['materi']."' AND kd_absen = 1 AND id_reg = '$reg'")->fetchColumn();
			?>
			<th class="bg-lightteal" style="border-top: thin solid grey;"><?php echo $rows; ?></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($murid as $murid) {?>
		<tr>
			<td style="border-right: thin solid grey;border-left: thin solid grey;border-bottom: thin solid grey;"><?php echo $no2++; ?></td>
			<td style="border-right: thin solid grey;border-bottom: thin solid grey;"><?php echo $murid['nis']; ?></td>
			<td style="border-right: thin solid grey;border-bottom: thin solid grey;"><?php echo $murid['nam_stu']; ?></td>
			<?php 
				$setcl = $DB_connect->prepare("SELECT * FROM stu_absen_ci WHERE id_stu = '".$murid['id_stu']."' AND id_reg = '$reg'");
				$setcl->execute();
				$absensi = $setcl->fetchAll(PDO::FETCH_ASSOC);
				foreach ($absensi as $absensi) {
					if ($absensi['kd_absen'] == '1') {
						$absen = '<div class="tile-small bg-blue" data-role="tile"><div class="tile-content iconic"><span class="icon mif-school"></span><span>Hadir</span></div></div>';
					}
					elseif ($absensi['kd_absen'] == '2') {
						$absen = '<div class="tile-small bg-green" data-role="tile"><div class="tile-content iconic"><span class="icon mif-school"></span><span>Sakit</span></div></div>';
					}
					elseif ($absensi['kd_absen'] == '3') {
						$absen = '<div class="tile-small bg-yellow" data-role="tile"><div class="tile-content iconic"><span class="icon mif-school"></span><span>Izin</span></div></div>';
					}
					else {
						$absen = '<div class="tile-small bg-red" data-role="tile"><div class="tile-content iconic"><span class="icon mif-school"></span><span>Alpha</span></div></div>';
					}
			?>
			<td style="border-right: thin solid grey;border-bottom: thin solid grey;"><?php echo $absen; ?></td>
			<?php } ?>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php 
include '../config/fusioncharts.php';
	
	$setcl = $DB_connect->prepare("SELECT * FROM studen_ci WHERE id_kls = '$id_kls'");
	$setcl->execute();
	$result = $setcl->fetchAll(PDO::FETCH_ASSOC);

	$setcl = $DB_connect->prepare("SELECT DISTINCT tgl_input FROM stu_absen_ci WHERE id_reg = '$reg'");
	$setcl->execute();
	$result2 = $setcl->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "Grafik kehadiran siswa ".$kelas['nm_kls']." mata pelajaran ".$kelas['nam_pel']." per siswa",
                  "paletteColors" => "#0075c2",
                  "bgColor" => "#ffffff",
                  "borderAlpha"=> "20",
                  "canvasBorderAlpha"=> "0",
                  "usePlotGradientColor"=> "0",
                  "plotBorderAlpha"=> "10",
                  "showXAxisLine"=> "1",
                  "xAxisLineColor" => "#999999",
                  "showValues" => "0",
                  "divlineColor" => "#999999",
                  "divLineIsDashed" => "1",
                  "showAlternateHGridColor" => "0"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array
    foreach ($result as $result) {
    	$rows = $DB_connect->query("SELECT count(kd_absen) FROM stu_absen_ci WHERE id_stu = '".$result['id_stu']."' AND kd_absen = 1 AND id_reg = '$reg'")->fetchColumn();

    	array_push($arrData["data"], array(
    		"label" => $result['nam_stu'],
    		"value" => $rows
    	)
    	);
    }
    /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$columnChart = new FusionCharts("column2D", "chart1" , 600, 300, "chart-1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();
}

if ($result2) {
	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "Grafik kehadiran ".$kelas['nm_kls']." mata pelajaran ".$kelas['nam_pel']." per tanggal",
                  "paletteColors" => "#0075c2",
                  "bgColor" => "#ffffff",
                  "borderAlpha"=> "20",
                  "canvasBorderAlpha"=> "0",
                  "usePlotGradientColor"=> "0",
                  "plotBorderAlpha"=> "10",
                  "showXAxisLine"=> "1",
                  "xAxisLineColor" => "#999999",
                  "showValues" => "0",
                  "divlineColor" => "#999999",
                  "divLineIsDashed" => "1",
                  "showAlternateHGridColor" => "0"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array
    foreach ($result2 as $result2) {
    	$rows = $DB_connect->query("SELECT count(kd_absen) FROM stu_absen_ci WHERE tgl_input = '".$result2['tgl_input']."' AND id_reg = '$reg' AND kd_absen = '1'")->fetchColumn();

    	array_push($arrData["data"], array(
    		"label" => $result2['tgl_input'],
    		"value" => $rows
    	)
    	);
    }
    /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$columnChart = new FusionCharts("column2D", "chart2" , 600, 300, "chart-2", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();
}
?>

<div id="dialog" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="700" data-height="550">
                                        <h3 class="align-center">Grafik kehadiran siswa</h3>
                                        <hr class="thin bg-grayLighter">
                                        <div style="height:280px">
                                        	<div class="accordion large-heading" data-role="accordion">
											    <div class="frame">
											        <div class="heading bg-lightred">Grafik per siswa</div>
											        <div class="content">
											        	<div id="chart-1"><!-- Fusion Charts will render here--></div>
											        </div>
											    </div>
											    <div class="frame">
											        <div class="heading bg-lightred">Grafik per tanggal</div>
											        <div class="content">
											        	<div id="chart-2"><!-- Fusion Charts will render here--></div>
											        </div>
											    </div>
											</div>
										</div>
                                    </div>
</div>




<!-- 
000000000000000														000000000000000
000000000000000														000000000000000
000000000000000														000000000000000										
00000000000000000000												000000000000000
000000000000000		00000											000000000000000
000000000000000			00000										000000000000000
000000000000000				00000									000000000000000
000000000000000					00000								000000000000000
000000000000000						00000							000000000000000
000000000000000							00000						000000000000000
000000000000000								00000					000000000000000
000000000000000									00000				000000000000000
000000000000000										00000			000000000000000
000000000000000											00000		000000000000000
000000000000000												00000	000000000000000
000000000000000													0000000000000000000
000000000000000														000000000000000
000000000000000														000000000000000
 -->

<?php } else { 

$setcl = $DB_connect->query("SELECT DISTINCT tgl_input FROM stu_absen_ci 
							 INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
							 WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 1");
$setcl->execute();
$tgl3 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT ket FROM stu_nilai_ci 
							 WHERE id_reg = '$reg' AND tipe_nilai = 2");
$setcl->execute();
$tgl33 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$rows4 = $DB_connect->query("SELECT DISTINCT count(ket) FROM stu_nilai_ci 
							 WHERE id_reg = '$reg' AND tipe_nilai = 2")->fetchColumn();

$limit = count($tgl33);


$setcl = $DB_connect->query("SELECT * FROM stu_absen_ci 
							 INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
							 WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 2 LIMIT $limit");
$setcl->execute();
$tgl4 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$rows3 = $DB_connect->query("SELECT count(tgl_input) FROM stu_absen_ci INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
							 WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 2")->fetchColumn();

$rows2 = $DB_connect->query("SELECT DISTINCT COUNT(tgl_input) FROM stu_absen_ci INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
							 WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 1")->fetchColumn();

$setcl = $DB_connect->query("SELECT DISTINCT materi FROM stu_absen_ci 
							 INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
							 WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 1");
$setcl->execute();
$kkm1 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT materi FROM stu_absen_ci 
							 INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
							 WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 1");
$setcl->execute();
$kkm0 = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->query("SELECT DISTINCT ket FROM stu_absen_ci 
							 INNER JOIN stu_nilai_ci ON stu_absen_ci.id_absen = stu_nilai_ci.id_absen
							 WHERE stu_absen_ci.id_reg = '$reg' AND tipe_nilai = 2");
$setcl->execute();
$kkm2 = $setcl->fetchAll(PDO::FETCH_ASSOC);

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



$setcl = $DB_connect->query("SELECT * FROM studen_ci
							 WHERE id_kls = '$id_kls'");
$setcl->execute();
$studen = $setcl->fetchAll(PDO::FETCH_ASSOC);



$no3 = 1;

?>
<div class="align-right">
	<form method="post" action="?page=p_list_nilai" target="_blank">
		<input type="text" name="kls" value="<?php echo $id_kls; ?>" hidden>
        <input type="text" name="reg" value="<?php echo $reg; ?>" hidden>
		<a href="#" class="button primary" onclick="showDialog('#dialog')"><span class="mif-chart-bars"></span> Lihat grafik</a>
		<button class="button warning"><span class="mif-printer"></span> Cetak</button>
	</form>
</div>

<table class="datatable align-center" id="tab-class" data-role="datatable">
	<thead>
		<tr>
			<th class="bg-grayLight">No</th>
			<th class="bg-grayLight">Nis</th>
			<th class="bg-amber">Tanggal <span class="mif-arrow-right"></span></th>
			<?php foreach ($tgl3 as $tgl3) {

			if (empty($tgl3['tgl_input'])) {
				echo "<th>0</th>";
			}
			else{

			?>
			<th class="bg-lighterBlue"><?php echo $tgl3['tgl_input']; ?></th>
			<?php } }?>

			<th rowspan="3" class="bg-lime"><div style="word-wrap: break-word;width:11px;">Rata - Rata</div></th>
			<?php foreach ($tgl4 as $tgl4) { ?>
			<th class="bg-green"><?php echo $tgl4['tgl_input']; ?></th>
			<?php } ?>
			<th rowspan="3" class="bg-lime"><div style="word-wrap: break-word;width:11px;">Rata - Rata</div></th>
			<th rowspan="2" class="ribbed-lightOlive">UTS</th>
			<th rowspan="2" class="ribbed-grayLight">UAS</th>
		</tr>	
		<tr>
			<th colspan="3" class="bg-yellow">Materi / Judul</th>
			<?php foreach ($kkm1 as $kkm1) { ?>
			<th class="bg-lighterBlue"><?php echo $kkm1['materi']; ?></th>
			<?php } ?>
			<?php foreach ($kkm2 as $kkm2) { ?>
			<th class="bg-green"><?php echo $kkm2['ket']; ?></th>
			<?php } ?>
		</tr>
		<tr>
			<th colspan="3" class="bg-lightOrange">Kriteria Ketuntasan Minimal (KKM)</th>
			<?php foreach ($kkm0 as $kkm0) { 
				$setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci 
											 INNER JOIN stu_absen_ci on stu_nilai_ci.id_absen = stu_absen_ci.id_absen
											 WHERE stu_absen_ci.materi = '".$kkm0['materi']."'");
				$setcl->execute();
				$kkm3 = $setcl->fetch(PDO::FETCH_ASSOC);
			?>
			<th class="bg-lighterBlue"><?php echo $kkm3['kkm']; ?></th>
			<?php } foreach ($kkm4 as $kkm4) { 
				$setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci 
											 INNER JOIN stu_absen_ci on stu_nilai_ci.id_absen = stu_absen_ci.id_absen
											 WHERE ket = '".$kkm4['ket']."'");
				$setcl->execute();
				$kkm6 = $setcl->fetch(PDO::FETCH_ASSOC);
			?>
			<th class="bg-green"><?php echo $kkm6['kkm']; ?></th>
			<?php } foreach ($kkm5 as $kkm5) { 
				$setcl = $DB_connect->query("SELECT * FROM stu_nilai_ci 
											 INNER JOIN stu_absen_ci on stu_nilai_ci.id_absen = stu_absen_ci.id_absen
											 WHERE ket = '".$kkm5['ket']."'");
				$setcl->execute();
				$kkm7 = $setcl->fetch(PDO::FETCH_ASSOC);

				if (empty($kkm7['kkm'])) {
					echo "<td>0</td>";
				}
				else{
			?>
			<th class="ribbed-lightOlive"><?php echo $kkm7['kkm']; ?></th>
			<?php } }?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($studen as $studen) { 
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

		?>
		<tr>
			<td class="bg-grayLight"><?php echo $no3++; ?></td>
			<td class="bg-grayLight"><?php echo $studen['nis']; ?></td>
			
			<td><?php echo $studen['nam_stu']; ?></td>
			<?php foreach ($studen2 as $studen2) { ?>
			<td class="bg-lighterBlue"><?php echo $studen2['nilai_aktual']; ?></td>
			<?php } ?>
			
			<td class="bg-lime"><?php echo $hasilulg['sumtugas']; ?></td>
			<?php foreach ($studen3 as $studen3) { ?>
			<td class="bg-green"><?php echo $studen3['nilai_aktual']; ?></td>
			<?php } ?>
			
			<td class="bg-lime"><?php echo $hasiltugas['sumtugas']; ?></td>
			<?php foreach ($studen4 as $studen4) { ?>
			<td class="ribbed-lightOlive"><?php echo $studen4['nilai_aktual']; ?></td>
			<?php } ?>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php } ?>