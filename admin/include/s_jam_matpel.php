<?php 
include '../lib/adm_cl.php';
    
try{
        $im =  $_POST['id'];
            foreach ($im as $key=>$value) {
                $id_reg = $value;
                
                $nim = $_POST['nip'][$key];
                $jams = $_POST['jams'][$key];
                $jame = $_POST['jame'][$key];
                $day = $_POST['day'][$key];
                $int = $_POST['int'][$key];
                
                $syscl->addjad($id_reg,$nim,$jams,$jame,$day,$int);

               
            }
    
 echo "<script>alert('Berhasil');</script>";
    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>