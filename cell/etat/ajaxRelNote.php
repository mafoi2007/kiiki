<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['section'])){
		$section = $_POST['section'];
		if($section=='null'){
			echo "<h3 class='alert'>Vous devez effectuer une sélection.</h3>";
		}else{
			$classe = $config->viewClasseSection($section, 'actif');
			if(!empty($classe)){ ?>
				Classe :<select name='object'>
					<?php 
					for($i=0;$i<count($classe);$i++){
						$idClasse = $classe[$i]['id'];
						$nomClasse = $classe[$i]['nom_classe'];
						echo "<option value='".$idClasse."'>".$nomClasse."</option>";
					}
					?>
				</select>
				<input
					type='hidden'
					name='to_print'
					value='ReleveNote' />
				<input 
					type='submit'
					name='print'
					value='Imprimer le Relevé de notes' />
<?php 				
			}else{
				echo "<h3 class='alert'>Aucune classe pour la section choisie.</h3>";
			}
		}
	}
?>