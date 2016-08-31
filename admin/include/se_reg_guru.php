<?php 
include '../lib/adm_cl.php';
    
try{
        $im =  $_POST['id'];
            foreach ($im as $key=>$value) {
            	$id = $value;
            	$kls = $_POST['gradekls'][$key];
            	$matpel = $_POST['matpel'][$key];

            	$syscl->upregteach($id,$kls,$matpel);


            }

    }
  	catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }