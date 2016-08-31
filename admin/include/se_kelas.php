<?php 
include '../lib/adm_cl.php';
    
try{
        $im =  $_POST['id'];
            foreach ($im as $key=>$value) {
                $id = $value;
                
                $nmkls = $_POST['nmkls'][$key];
                $grade = trim($_POST['gradekls'][$key]); 
                $kapkls = trim($_POST['kapkls'][$key]);
                $wlkls = $_POST['wlkls'][$key];
                $kode = $_POST['kode'][$key];
                
                $syscl->addecls($id,$kode,$grade,$nmkls,$kapkls,$wlkls);
            }
    

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>