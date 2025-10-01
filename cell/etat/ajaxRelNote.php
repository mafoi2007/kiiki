<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
?>

		<p>Classe : 
			<select name='object'>
				<?php 
					$classe = $config->viewClasseSection($_POST['section'],'actif');
					for($i=0;$i<count($classe);$i++){
						echo "<option 
						value='";
						echo $classe[$i]['code_classe'];
						echo "'>";
						echo ucwords($classe[$i]['nom_classe']);
						echo "</option>";
					}
				?>
				<option value='null' selected>-Choix de la classe-</option>
			</select>
		</p>
		
		<input 
			type='hidden' 
			name='to_print' 
			value='ReleveNote' />
		<p><input 
				type='submit' 
				name='print' 
				value='Imprimer le Relevé de notes' /></p>