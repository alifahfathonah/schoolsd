<?php 
include '../lib/adm_cl.php';
    
try{
    $nip = $_POST['nip'];
    $namins = $_POST['namins'];
    $tglawal = $_POST['tglawal'];
    $tglakhir = $_POST['tglakhir'];
    $lpos = $_POST['lpos'];
    $alasan = $_POST['alasan'];
    if($syscl->inexp($nip,$namins,$tglawal,$tglakhir,$lpos,$alasan))
    { 
            echo"<script>alert('Berhasil Disimpan')</script>";
    }

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>