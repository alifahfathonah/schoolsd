<?php 
require '../config/mailer/class.phpmailer.php';
require '../config/mailer/class.smtp.php';

$sendto = $_POST['kirimke'];
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$name = $_POST['name'];

//PHPMailer Object
$mail = new PHPMailer(); 

    $mail->IsSMTP(); 
    $mail->SMTPDebug = 1; 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = "smtp.gmail.com";

    $mail->Port = 465; 
    $mail->IsHTML(true);
    //Username to use for SMTP authentication
    $mail->Username = "citra.insani.sdit2016@gmail.com";
    $mail->Password = "CitraInsan";
//From email address and name
$mail->From = "citra.insani.sdit2016@gmail.com";
$mail->FromName = "Admin SDIT Citra Insani";

//To address and name
$mail->addAddress($sendto, $name);
$mail->addAddress($sendto); //Recipient name is optional

//Address to which recipient will reply
$mail->addReplyTo("info@sditcitrainsani.sch.id", "Reply");

//CC and BCC
//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = $judul;
$mail->Body = $isi;
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
    echo "<script>alert('Pesan gagal kode : ". $mail->ErrorInfo;"!');window.location = '?page=pesan';</script>";
} 
else 
{
    echo "<script>alert('Pesan telah berhasil dibalas !');window.location = '?page=pesan';</script>";
}

?>