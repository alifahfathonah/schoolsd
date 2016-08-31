<?php 
include '../lib/adm_cl.php';
try{

	$jumlah = count($_POST["checkdel"]);
	for($i=0; $i < $jumlah; $i++){
		$cid = trim($_POST['checkdel'][$i]);
		$syscl->delcls($cid);
	}

}
catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }
	

?>