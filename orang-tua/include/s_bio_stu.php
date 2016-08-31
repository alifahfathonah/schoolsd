<?php 
include '../lib/adm_cl.php';
    
try{
    $alamat = $_POST['alamat'];
    $temp_lhr = $_POST['templhr'];
    $kwrg = $_POST['kwrg'];
    $agama = $_POST['agama'];
    $telp = $_POST['telp'];
    $anakke = $_POST['anakke'];
    $jumsau = $_POST['jumsau'];
    $statanak = $_POST['statanak'];
    $bahasa = $_POST['bahasa'];
    $tgldg = $_POST['tgldg'];
    $jarak = $_POST['jarak'];
    $trans = $_POST['trans'];
    $goldrh = $_POST['goldrh'];
    $disease = $_POST['disease'];
    $tinggi = $_POST['tinggi'];
    $berat = $_POST['berat'];
    $id = $_POST['id'];


    if($syscl->upbiostu($temp_lhr,$agama,$kwrg,$anakke,$jumsau,$bahasa,$statanak,$alamat,$telp,$tgldg,$jarak,$trans,$goldrh,$disease,$tinggi,$berat,$id))
    { 
            echo"<script>alert('Berhasil Disimpan')</script>";
    }

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>