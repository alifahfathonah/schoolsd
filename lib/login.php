<?php
require_once '../lib/cl.user.php';

if($user->is_loggedin()!="")
{
	$user->redirect('../index.php');

}

if(isset($_POST['submit']))
{
	$uname = $_POST['uname'];
	$upass = $_POST['upass'];
		
	if($user->login($uname,$upass))
	{
		$user->redirect('../index.php');
	}
	else
	{
		echo"<script>alert('Username or password wrong !!')</script>";
		echo"<script>location='../index.php'</script>";

	}	
}
?>