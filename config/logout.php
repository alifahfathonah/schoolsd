<?php
require_once '../lib/cl.user.php';

if($_SESSION['user_session']!="")
{
	$user->redirect('../hrd');
}
if(isset($_GET['logout']) && $_GET['logout']=="true")
{
	$user->logout();
	$user->redirect('../login/index.php');
}
if(!isset($_SESSION['user_session']))
{
	$user->redirect('../login/index.php');
}