<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
	if(isset($_POST['oldYear'])){
		$annee = $_POST['oldYear'];
		if($annee=='null'){
			echo "<h3 class='alert'>Vous devez selectionner une année scolaire.</h3>";
		}else{
			$listeClasseFr = $config->viewClasseSection('fr', 'actif');
			$listeClasseEn = $config->viewClasseSection('en', 'actif');
			// echo '<pre>'; print_r($listeClasseEn); echo '</pre>';
		?>
			Classe : 
			<select 
				name = 'classe' 
				id = 'classe' 
				OnChange='findButtonEleve()'>
				<option value='null' selected>-Choisir Classe-</option>
				<optgroup label='Section Francophone'>
				<?php 
				for($i=count($listeClasseFr)-1;$i>=0;$i--){
					$idClasse = $listeClasseFr[$i]['id'];
					$nomClasse = $listeClasseFr[$i]['nom_classe'];
					echo "<option value='".$idClasse."'>".$nomClasse."</option>";
				}
				?>
				</optgroup>
				<optgroup label='Section Anglophone'>
				<?php 
				for($i=0;$i<count($listeClasseEn);$i++){
					$idClasse = $listeClasseEn[$i]['id'];
					$nomClasse = $listeClasseEn[$i]['nom_classe'];
					echo "<option value='".$idClasse."'>".$nomClasse."</option>";
				}
				?>
				</optgroup>
			</select>
			<div id='resultat' style = 'display:inline'>
			</div>
<?php 
		}
	}
?>