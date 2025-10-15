<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		if($classe==0){
			echo "<h3 class='alert'>Vous devez selectionner une classe.</h3>";
		}else{
			
		?>
			<input 
				type='hidden' 
				name='to_print' 
				value='listeEleveOld' 
			/>
			<input 
				type='submit'
				name='print'
				value='Imprimer'
			/>
<?php 
		}
	}
?>