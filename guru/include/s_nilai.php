<?php 
include '../lib/adm_cl.php';
    
try{
        $stu =  $_POST['stu'];
            foreach ($stu as $key=>$value) {
                $vardiv = "NIL-STU";
                $todaydiv = date("ymd");
                $randdiv = strtoupper(substr(md5(uniqid(sha1(time()))),0,7));
                $id_nil= $vardiv. $todaydiv.$randdiv;

                $student = $value;

                $kkm = $_POST['kkm'];
                $absen = $_POST['absen'][$key];
                
                $tipe = $_POST['tipe'];
                $tgl = $_POST['tgl'];
                $reg = $_POST['reg'];
                $nilai = $_POST['nilai'][$key];
                $ket = $_POST['ket'];

                $syscl->snilai($id_nil,$reg,$student,$absen,$kkm,$nilai,$tipe,$ket);
            }
        echo "<script>alert('Berhasil disimpan');window.location = '?page=nilai_stu';</script>";
    

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>