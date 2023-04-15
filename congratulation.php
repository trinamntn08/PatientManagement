<?php 
	include './config/connection.php';

  	$gotoPage = $_GET['goto_page'];

    $message = $_GET['Tin nhắn'];
     	
  	header("Location:$gotoPage?message=$message");

?>
