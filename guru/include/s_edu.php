<?php 
include '../lib/adm_cl.php';
    
try{
    $nip = $_POST['nip'];
    $namins = $_POST['namins'];
    $tglawal = $_POST['tglawal'];
    $tglakhir = $_POST['tglakhir'];
    $grade = $_POST['grade'];
    $jurusan = $_POST['jurusan'];
    $ipk = $_POST['ipk'];
    if($syscl->inedu($nip,$namins,$tglawal,$tglakhir,$grade,$jurusan,$ipk))
    { 
            echo"<script>alert('Berhasil Disimpan')</script>";
    }

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>