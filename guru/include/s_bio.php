<?php 
include '../lib/adm_cl.php';
    
try{
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $hp = $_POST['hp'];
    $nikah = $_POST['nikah'];
    $nip = $_POST['nip'];
    if($syscl->upbio($nip,$alamat,$agama,$hp,$nikah))
    { 
            echo"<script>alert('Berhasil Disimpan')</script>";
    }

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>