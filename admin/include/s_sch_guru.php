<?php 
include '../lib/adm_cl.php';
    
try{

	$id = $_POST['kls1'];

	foreach ($id as $key => $value) {
			$now = date("Y-m-d");

			$tglf = $_POST['tglf'];
			$tgle = $_POST['tgle'];
			$day = $_POST['day'];

			$tipe = 1;

			$vardiv4 = "SCH-TCH";
			$todaydiv4 = date("ymd");
			$randdiv4 = strtoupper(substr(uniqid(sha1(microtime()[$key])),0,8));
			$id_sch= $vardiv4.$todaydiv4.$randdiv4[$key].$day.$key;

			$colkls = $_POST['colkls'][$key];

			$time = $_POST['time'][$key];

			$int = $_POST['int'];

			$kls = $value;

$syscl->addjad($id_sch,$time,$tglf,$tgle,$day,$now,$int,$colkls,$kls,$tipe,$ket);

	}
        
    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }


 ?>