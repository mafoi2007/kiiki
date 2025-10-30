<?php 
	$prof = $_SESSION['user']['id'];
	$listeClasse = $config->listeClasseProf($prof);
	if(empty($listeClasse)){
		$msg = "Aucune classe ne vous a encore été attribuée";
		echo "<h3 class='alert'>".$msg."</h3>";
	}else{ ?>

<h1 class='alert'>saisie des notes</h1>
	<form method='post' action=''>
		Classe : 
		<select name='classe' id='classe' onChange='goAdd()'>
			<option value='null'>-Classe-</option>
			<?php 
			for($i=0;$i<count($listeClasse);$i++){
				$idClasse = $listeClasse[$i]['id_classe'];
				$nomClasse = $listeClasse[$i]['nom_classe'];
				echo "<option value='".$idClasse."'>".$nomClasse."</option>";
			}
			?>
		</select>
		<div id='matiere' style = 'display:inline'>
		</div>
	</form>
<?php 
		if(isset($_POST['info'])){
			$classe = (int) $_POST['classe'];
			$matiere = (int) $_POST['matier'];
			$sequence = (int) $_POST['sequence'];
			$nomClasse = $config->getClasse($classe);
			$nomMatiere = $config->getMatiere($matiere);
			$nomSequence = $config->getSequenceCourante($sequence);
			$as = $config->getCurrentYear();
			$listeEleve = $config->listeEleve($nomClasse['id'], 'non_supprime', $as);
			require_once('../forms/ajouterNote.form.php');
		}
	
	}