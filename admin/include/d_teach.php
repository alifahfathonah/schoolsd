<?php 
include '../lib/adm_cl.php';
try{

	$jumlah = count($_POST["checkdel"]);
	for($i=0; $i < $jumlah; $i++){
		$tid = trim($_POST['checkdel'][$i]);
		$nip = $_POST['nip'][$i];
		$idreg = $_POST['idreg'][$i];
		$syscl->deltch($tid,$nip,$idreg);
	}

}
catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }
	

?>