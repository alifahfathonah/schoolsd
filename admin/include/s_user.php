<?php 
include '../lib/adm_cl.php';
    
try{
    $list2 = $_POST['list'];
    $text = str_replace('</p>', '', $list2);
    $list3 = explode("<p>", $text);
    
    foreach ($list3 as $key => $value) {
            $list = $value;
            $el = explode(",", $list);

            $nis = $el[0];
            $nama = $el[1];
            $pass = $el[0];
            $syscl->adduserlist($nis,$nama,$pass);
            
    }
    echo"<script>alert('Berhasil Disimpan');window.location = '?page=murid';</script>";
        
    
}
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>