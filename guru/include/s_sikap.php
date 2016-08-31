<?php 
include '../lib/adm_cl.php';
    
try{
        $id =  $_POST['aspek'];
            foreach ($id as $key=>$value) {
                $vardiv = "NIL-SKP";
                $todaydiv = date("ymd");
                $randdiv = strtoupper(substr(md5(uniqid(sha1(time()))),0,4));
                $id_skp= $vardiv. $todaydiv .$randdiv.$key;

                $aspek = $value;
                $nis = $_POST['nis'];
                $nilai = $_POST['nilai'][$key];
                $ket = $_POST['ket'][$key];


                $syscl->ssikap($id_skp,$aspek,$nis,$nilai,$ket);
            }
    
            echo"<script>alert('Berhasil Disimpan');window.location = '?page=rapot';</script>";
    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>