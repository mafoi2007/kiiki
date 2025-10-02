<?php 
	if(isset($_SESSION['message'])){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}unset($_SESSION['message']);
	
	
	if(isset($_SESSION['connected'])){
		// echo '<pre>'; print_r($_SESSION); echo '</pre>';
		if(isset($_SESSION['user']['userPost'])){
			$page = $_SESSION['user']['userPost'].'/';
			header('Location:'.$page);
		}
	}else{
		require_once('forms/connect.form.php');
	}