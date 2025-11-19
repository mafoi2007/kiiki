<?php 
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new config($db);
	// print_r($_POST);
	if(isset($_POST['eleve'])){
		$eleve = (int) $_POST['eleve'];
		if($eleve==0){
			$msg = "Vous devez sélectionner un élève.";
			echo "<h3 class='alert'>".$msg."</h3>";
		}else{ ?>
			<input 
				type='hidden' 
				name='to_print' 
				value='certificatScolariteOld' 
			/>
			<input 
				type='submit' 
				name='print' 
				value='Editer' 
			/>
		<?php 
		}
	}