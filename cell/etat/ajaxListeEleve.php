<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
?>

		<p>Choisir la Classe : 
			<select name='classe'>
				<?php 
					
					$listeClasses = $config->viewClasseSection($_POST['section'],'actif');
					$i = 1;
					for($i=0;$i<count($listeClasses);$i++){
						echo "<option 
							value='".$listeClasses[$i]['id']."'>";
						echo $listeClasses[$i]['nom_classe']."</option>\n";
					}
				?>
				<option selected>-classe-</option>
			</select>
			<input type='hidden' name='to_print' value='listeEleve' />
			<input type='hidden' name='print' value='Imprimer' />					
									 						
			<input type='submit' name='validerClasse' value='Choisir' />
		</p>