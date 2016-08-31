<?php 
include '../lib/adm_cl.php';
    
try{
        $grade = $_POST['gradekls'];
        $nmkls = $_POST['nmkls'];
        $kapkls = $_POST['kapkls'];
        $wlkls = $_POST['wlkls'];
        $kode = $_POST['kode'];

        $setcl = $DB_connect->prepare("SELECT * FROM class_ci WHERE kd_kls = '$kode'");
        $setcl->execute();
        $cek = $setcl->fetch(PDO::FETCH_ASSOC);

        if ($cek['kd_kls'] == $kode) {
             echo"<script>alert('Error kode kelas sudah ada');window.location = '?page=kelas';</script>";
        }
        else
        {

            $setcl = $DB_connect->prepare("SELECT nip FROM teacher_ci WHERE id_guru = '$wlkls'");
            $setcl->execute();
            $nip2 = $setcl->fetch(PDO::FETCH_ASSOC);

            $nip = $nip2['nip'];

            if($syscl->addcls($kode,$grade,$nmkls,$kapkls,$wlkls,$nip))
            { 
                    echo"<script>alert('Berhasil Disimpan');window.location = '?page=kelas';</script>";
            }
        }

    }
catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>