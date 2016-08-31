<?php 
include '../lib/adm_cl.php';
    
try{
        $im =  $_POST['checkdel'];
        $or = $_POST['or'];
       	if (!isset($im)) {
       		echo "<script>alert('maaf anda belum memilih');window.location = '?page=in_pesan&tipe=".$or."';</script>";
       	}
            foreach ($im as $key=>$value) {
                $to_dest = $value;

                $vardiv3 = "MSG";
	            $todaydiv3 = date("ymd");
	            $randdiv3 = strtoupper(substr(uniqid(sha1(time())),0,4));
	            $id_msg= $vardiv3. $todaydiv3 .$randdiv3.$key;
                
                $title = $_POST['title'];
                $isi = $_POST['isi']; 
                $sender = $_POST['sender'];
                $attach = $_POST['attach'];

                $maxsize    = 2097152;
                $target_dir = "../style/images/";
	            $temp = explode(".", $_FILES["attach"]["name"]);
	            $newfilename = $title.$to_dest.'.' . end($temp);
	            $target_file = $target_dir . basename($newfilename);
	            $uploadOk = 1;
	            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	            // Check if image file is a actual image or fake image
	            if(isset($_POST["upload"])) {
	            // Check if $uploadOk is set to 0 by an error
		            if(($_FILES['attach']['size'] >= $maxsize) || ($_FILES["attach"]["size"] == 0)) {
				        $errors[] = 'File too large. File must be less than 2 megabytes.';
				    }
		                if (move_uploaded_file($_FILES["attach"]["tmp_name"], $target_file)) {
		                    echo "<script>alert('The file ". basename( $_FILES["attach"]["name"]). " has been uploaded.');window.location = '?page=in_pesan&tipe=".$or."';</script>";
		                    }
		                
	            }
                
                $syscl->addmsg($id_msg,$title,$isi,$sender,$to_dest,$attach);
                echo "<script>alert('berhasil kirim pesan');window.location = '?page=in_pesan&tipe=".$or."';</script>";
            }
    

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>