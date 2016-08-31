<?php 
include '../lib/adm_cl.php';
    
try{
    $part = $_POST['partisipan'];
    $expart2 =  preg_replace('/,$/','',trim($part));
    $expart = explode(",", $expart2);

    foreach ($expart as $key => $value) {
        $dur = $_POST['dur'];
        $exdur = explode(",", $dur);
        $fdur = $exdur[0];
        $edur = $exdur[1];

        $tipe = $_POST['tipe'];
        $tglf = $_POST['tglf'];
        $tgle = $_POST['tgle'];
        $ket = $_POST['ket'];
        $now = date("Y-m-d");
        $colkls = $value;
        $ket = $_POST['ket'];

        $time = NULL;
        $int = NULL;
        $kls = NULL;
        $day = NULL;

            $vardiv4 = "SCH-TCH";
            $todaydiv4 = date("ymd");
            $randdiv4 = strtoupper(substr(uniqid(sha1(microtime()[$key])),0,8));
            $id_sch= $vardiv4.$todaydiv4.$randdiv4[$key].$key;

        if ($tglf <= $fdur || $tgle >= $edur) {
           echo "<script>alert('Maaf anda setting durasi diluar jadwal');window.location = '?page=jam_matpel';</script>";
        }
        else{
            $syscl->addjad($id_sch,$time,$tglf,$tgle,$day,$now,$int,$colkls,$kls,$tipe,$ket);
            
        }
    }
        echo "<script>alert('Berhasil');indow.location = '?page=jam_matpel';</script>";
    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>