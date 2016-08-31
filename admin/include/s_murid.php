<?php 
include '../lib/adm_cl.php';
    
try{
    $nmmrd = $_POST['nmmrd'];
    $nis = $_POST['nis'];
    $nisn = $_POST['nisn'];
    $jk = $_POST['jkel'];
    $kls = $_POST['kls'];
    $ttl = $_POST['ttl'];

    if($syscl->addstu($nmmrd,$nis,$nisn,$jk,$kls,$ttl))
    { 
            echo"<script>alert('Berhasil Disimpan')</script>";
    }

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>