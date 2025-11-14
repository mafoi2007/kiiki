<h1 class='bien'>Révendications Séquentielles</h1>
		<form method='post' action=''>
			Classe : <select name='classe' id='classe' onChange='goListe()'>
				<option value='null'>-Classe-</option>
				<?php 
					$regions = $config->verifNoteSaisieClasse();
					for($i=0;$i<count($regions);$i++){
						echo "<option value='";
						echo $regions[$i]['id_classe'];
						echo "'>".strtoupper($regions[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			<div id='eleve' style = 'display:inline'>
			</div>
		</form>
		
		
		
<?php 
	if(isset($_POST['Go'])){
		echo '<pre>';
		// print_r($_POST);
		echo '</pre>';
		
		$classe = $_POST['classe'];
		$eleve = $_POST['eleve'];
		$sequence = $_POST['sequence'];
		if($classe=='null' or $eleve=='null' or $sequence=='null'){
			echo "<h3 class='alert'>Vous devez renseigner toutes les valeurs.</h3>";
		}else{ 
			// On affiche les informations de base 
            $infoEleve = $config->getEleve($eleve);
            $infoClasse = $config->getClasse($classe);
            $listeMatiere = $config->listeMatiereClasse($classe);
            // echo '<pre>'; print_r($listeMatiere); echo '</pre>';
// 			// On récupère la liste des Matières 
// 			$listeMatiere = $config->listeMatiereClasse($codeClasse);
// 			// On récupère les notes qu'il aurait obtenue 
			$valeurs = $config->getNoteEleve($eleve,$sequence);
			
			// echo '<pre>';print_r($valeurs); echo '</pre>';
			require_once('revendication.php');
 		}
	}