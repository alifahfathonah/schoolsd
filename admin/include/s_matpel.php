<?php 
include '../lib/adm_cl.php';
    
try{
    $nampel = $_POST['nampel'];
    $kode = $_POST['kode'];
    
    if($syscl->addnampel($nampel,$kode))
    { 
            echo"<script>alert('Berhasil Disimpan')</script>";
    }

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>