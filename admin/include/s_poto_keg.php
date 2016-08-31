<?php 
include '../lib/adm_cl.php';
try
	{
	if (isset($_POST['upload'])) {
		
		$nampo = $_POST['nampo'];
		$ket = $_POST['ket'];
		$target_dir = "../style/images/";
	            $temp = explode(".", $_FILES["poto"]["name"]);
	            $newfilename = $nampo . '.' . end($temp);
	            $target_file = $target_dir . basename($newfilename);
	            $uploadOk = 1;
	            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	            // Check if image file is a actual image or fake image
	            if(isset($_POST["upload"])) {
	            $check = getimagesize($_FILES["poto"]["tmp_name"]);
	            if($check !== false) {
	            echo "<script>alert('File is an image - " . $check["mime"] . "'');window.location = '?page=up_kegiatan';</script>";
	                $uploadOk = 1;
	                    } else {
	                echo "<script>alert('File is not an image.');window.location = '?page=up_kegiatan';</script>";
	                    $uploadOk = 0;
	                    }
	                }
	            // Allow certain file formats
	            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	                && $imageFileType != "gif" ) {
	                echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');window.location = '?page=up_kegiatan';</script>";
	                    $uploadOk = 0;
	                        }
	            // Check if $uploadOk is set to 0 by an error
	            if ($uploadOk == 0) {
	                echo "<script>alert('Sorry, your file was not uploaded.');window.location = '?page=up_kegiatan';</script>";
	                // if everything is ok, try to upload file
	                } else {
	                if (move_uploaded_file($_FILES["poto"]["tmp_name"], $target_file)) {
	                    echo "<script>alert('The file ". basename( $_FILES["poto"]["name"]). " has been uploaded.');window.location = '?page=up_kegiatan';</script>";
	                    } else {
	                    echo "<script>alert('Sorry, there was an error uploading your file.');window.location = '?page=up_kegiatan';</script>";
	                    }
	                }

	    if ($syscl->uppotkeg($nampo,$target_file,$ket)) {
	     	echo "<script>alert('Anda berhasil upload foto');window.location = '?page=up_kegiatan';</script>";
	     }

	} 
	}
	catch (PDOException $e) {
			echo $e->getMessage();
		}
 ?>