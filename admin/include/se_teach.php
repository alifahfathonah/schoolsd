<?php 
include '../lib/adm_cl.php';
    
try{
        $im =  $_POST['id'];
            foreach ($im as $key=>$value) {
                $id = $value;
                
                $nmguru = $_POST['nmguru'][$key];
                $nuptk = $_POST['nuptk'][$key];
                $nip = $_POST['nip'][$key];
                $jkel = $_POST['jkel'][$key];
                $ttl = $_POST['ttl'][$key];
                $img = $_POST['img'][$key];
                
                $syscl->addetch($id,$nmguru,$nuptk,$nip,$jkel,$ttl,$img);
            }
    

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>