<?php 
include '../lib/adm_cl.php';
    
try{
        $stu =  $_POST['stu'];
            foreach ($stu as $key=>$value) {
                $vardiv = "ABS-STU";
                $todaydiv = date("ymd");
                $randdiv = strtoupper(substr(uniqid(sha1(time())),0,4));
                $id_abs= $vardiv. $todaydiv .$randdiv.$key;

                $student = $value;
                
                $tgl = $_POST['tgl'];
                $reg = $_POST['reg'];
                $radio = $_POST['radio'.$value];
                $materi = $_POST['materi'];

                $syscl->sabsen($id_abs,$reg,$student,$radio,$tgl,$materi);
            }
         echo"<script>alert('Berhasil Disimpan');window.location = '?page=jurnal';</script>";
    

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>