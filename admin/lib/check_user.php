<?php 
include_once '../lib/cl.user.php';
if(!$user->is_loggedin())
{
    $user->redirect('../login');
} 
$user_id = $_SESSION['user_session'];
$stmt = $DB_connect->prepare("SELECT * FROM user_school WHERE iduser=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
if ($userRow['level'] == 'Guru') {
	echo "<script>alert('Anda tidak berhak !!')</script>";
	$user->redirect('../guru');
}
 ?>