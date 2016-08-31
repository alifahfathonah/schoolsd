<?php 
include '../lib/adm_cl.php';
try{

	$jumlah = count($_POST["checkdel"]);
	for($i=0; $i < $jumlah; $i++){
		$nid = trim($_POST['checkdel'][$i]);
		$syscl->delmatpel($nid);
	}

}
catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }
	

?>