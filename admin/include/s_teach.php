<?php 
include '../lib/adm_cl.php';
    
try{
    $nmguru = $_POST['nmguru'];
    $nuptk = $_POST['nuptk'];
    $nip = $_POST['nip'];
    $jkel = $_POST['jkel'];
    $ttl = $_POST['ttl'];

        $setcl = $DB_connect->prepare("SELECT * FROM teacher_ci WHERE nip = '$nip'");
        $setcl->execute();
        $cek = $setcl->fetch(PDO::FETCH_ASSOC);

        if ($cek['nip'] == $nip) {
             echo"<script>alert('Error NIP sudah ada')</script>";
        }
        else
        {

            if($syscl->addtch($nmguru,$nuptk,$nip,$jkel,$ttl))
            { 
                    echo"<script>alert('Berhasil Disimpan')</script>";
            }
        }
    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>