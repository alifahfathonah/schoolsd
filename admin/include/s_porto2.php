<?php 
include '../lib/adm_cl.php';
    
try{
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    $target_dir = "../style/images/";
                $temp = explode(".", $_FILES["poto"]["name"]);
                $newfilename = $judul.'.' . end($temp);
                $upload = $target_dir . basename($newfilename);
                $uploadOk = 1;
                $imageFileType = pathinfo($upload,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["upload"])) {
                $check = getimagesize($_FILES["poto"]["tmp_name"]);
                if($check !== false) {
                echo "<script>alert('File is an image - " . $check["mime"] . "'');window.location = '?page=add_news';</script>";
                    $uploadOk = 1;
                        } else {
                    echo "<script>alert('File is not an image.');window.location = '?page=add_news';</script>";
                        $uploadOk = 0;
                        }
                    }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');window.location = '?page=add_news';</script>";
                        $uploadOk = 0;
                            }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "<script>alert('Sorry, your file was not uploaded.');window.location = '?page=add_news';</script>";
                    // if everything is ok, try to upload file
                    } else {
                    if (move_uploaded_file($_FILES["poto"]["tmp_name"], $upload)) {
                        echo "<script>alert('The file ". basename( $_FILES["poto"]["name"]). " has been uploaded.');window.location = '?page=add_news';</script>";
                        } else {
                        echo "<script>alert('Sorry, there was an error uploading your file.');window.location = '?page=add_news';</script>";
                        }
                    }
   
    if($syscl->s_porto2($judul,$upload,$isi))
    { 
            echo"<script>alert('Berhasil Disimpan')</script>";
    }

    }
    catch(PDOExeption $e)
    {
        echo $e->getMessage();
    }

 ?>