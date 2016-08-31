<?php 
include '../lib/adm_cl.php';
    
try{
       $id = $_POST['kelas'];
       foreach ($id as $key => $value) {
            $kelas = $value;
                $vardiv3 = "REG-TCH-PEL";
                $todaydiv3 = date("ymd");
                $randdiv3 = strtoupper(substr(uniqid(sha1(time())),0,4));
                $id= $vardiv3. $todaydiv3 .$randdiv3.$key;


           $nip = $_POST['nip'];
           $guru = $_POST['guru'];
           $matpel = $_POST['matpel'];

            $syscl->addregteach($id,$guru,$matpel,$kelas,$nip);
       }
        
    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }
?>