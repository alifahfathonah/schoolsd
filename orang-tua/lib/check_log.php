<?php 
include_once '../lib/cl.user.php';
if(!$user->is_loggedin())
{
    $user->redirect('../absen/index.php');
} 
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM user WHERE iduser=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
 ?>