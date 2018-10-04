<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if(!$user->is_logged_in())
{
	//$user->redirect('../index.php');
	$user->redirect('../admin.php');
}

if($user->is_logged_in()!="")
{
	$user->logout();	
	//$user->redirect('index.php');
	$user->redirect('../admin.php');
}
?>
