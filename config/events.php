<?php 
include_once '../config/db_config.php';
$setcl31 = $DB_connect->prepare("SELECT DISTINCT ket FROM schedule_teach_ci WHERE tipe_jadwal != 1
								#(SELECT group_concat(DISTINCT jad_start) FROM schedule_teach_ci WHERE tipe_jadwal != 1) as a,
								#(SELECT group_concat(DISTINCT jad_end) FROM schedule_teach_ci WHERE tipe_jadwal != 1) as b,
								#(SELECT group_concat(DISTINCT ket) FROM schedule_teach_ci WHERE tipe_jadwal != 1) as c");
$setcl31->execute();
$resultdis = $setcl31->fetchAll(PDO::FETCH_ASSOC);


$no = 1;


$xml = new SimpleXMLElement('<monthly/>');

$background_colors = array('#282E33', '#25373A', '#164852', '#495E67', '#FF3838');



foreach ($resultdis as $resultdis) {

$setcl3 = $DB_connect->prepare("SELECT * FROM schedule_teach_ci where ket = '".$resultdis['ket']."'");
$setcl3->execute();
$result = $setcl3->fetch(PDO::FETCH_ASSOC);

	if ($result['tipe_jadwal'] == 2) {
		$warna = '#ff0000';
	}
	elseif ($result['tipe_jadwal'] == 3) {
		$warna = '#00ff00';
	}
	elseif ($result['tipe_jadwal'] == 4) {
		$warna = '#0066ff';
	}
	else{
		$warna = '#ffff00';
	}
	
	$event = $xml->addChild('event');
	$event->addChild('id', $no++);
	$event->addChild('name', $result['ket']);
	$event->addChild('startdate', $result['jad_start']);
	$event->addChild('enddate', $result['jad_end']);
	$event->addChild('color', $warna);

	}
	Header('Content-type: text/xml');
	print($xml->asXML());

?>