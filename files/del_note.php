<?php 
session_start();
require 'DB.php';
$db = new DB('localhost', 'root', '', 'my_note');

parse_str($_SERVER['QUERY_STRING']);


if( $db->removeNote($_SESSION['user_id'], $del) ){
	unset($_GET['del']);
	$del = null;
	header('Location: ../../');
}else{
	echo $del;
	unset($_GET['del']);
	$del = null;
	header('Location: ../../home.php?error=failed_to_delete');
}


