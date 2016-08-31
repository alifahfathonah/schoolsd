<?php 
include '../lib/adm_cl.php';

if(isset($_POST["Import"]))
{
    //First we need to make a connection with the database
  
    echo $filename=$_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");
        //$sql_data = "SELECT * FROM prod_list_1 ";
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            //print_r($emapData);
            //exit();
            $vardiv1 = "STU";
            $todaydiv1 = date("ymd");
            $randdiv1 = strtoupper(substr(uniqid(sha1(time())),0,4));
            $id_stu= $vardiv1. $todaydiv1 .$randdiv1;

            $nmmrd = $emapData[0];
            $nis = $emapData[1];
            $nisn = $emapData[2];
            $jk = $emapData[3];
            $kls = $emapData[4];
            $ttl = $emapData[5];

            $syscl->addstu($id_stu,$nmmrd,$nis,$nisn,$jk,$kls,$ttl);
        }
        fclose($file);
        echo 'CSV File has been successfully Imported';
        header('Location: index.php');
    }
    else
        echo 'Invalid File:Please Upload CSV File';
}
?>