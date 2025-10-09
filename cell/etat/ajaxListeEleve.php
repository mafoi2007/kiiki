<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['section'])){
		$section = $_POST['section'];
		if($section=='null'){
			echo "<h3 class='alert'>Choisissez une section.</h3>";
		}else{
			$listeClasses = $config->viewClasseSection($section,'actif');
			if(!empty($listeClasses)){ ?>
				Choisir la Classe :
				<select name='classe'>
					<?php 
					$i=1;
					for($i=0;$i<count($listeClasses);$i++){
						$idClasse = $listeClasses[$i]['id'];
						$nomClasse = $listeClasses[$i]['nom_classe'];
						echo "<option value='".$idClasse."'>".$nomClasse."</option>";
					}
					?>
				</select>
				<input
					type='hidden' 
					name='to_print' 
					value='listeEleve' />
				<input 
					type='hidden' 
					name='print' 
					value='Imprimer' />
				<input 
					type='submit' 
					name='validerClasse' 
					value='Choisir' />
<?php 			
			}else{
				echo "<h3 class='alert'>Aucune classe pour la section.</h3>";
			}
		}
	}
?>