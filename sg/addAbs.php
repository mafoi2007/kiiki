<h1 class='alert'>enregistrement des absences</h1>
<form method='post' action=''>
	<select name='classe' id='classe' onChange='showDateAdd()'>
		<option value='null'>-Choisir Classe-</option>
		<optgroup label='Section Anglophone'></optgroup>
		<?php $listeClasseEn = $config->viewClasseSection('en', 'actif');
		for($i=0;$i<count($listeClasseEn);$i++){
			$idClasse = $listeClasseEn[$i]['id'];
			$nomClasse = utf8_decode($listeClasseEn[$i]['nom_classe']);
			echo "<option value='".$idClasse."'>".$nomClasse."</option>";
		}?>
		<optgroup label='Section Francophone'></optgroup>
		<?php $listeClasseFr = $config->viewClasseSection('fr', 'actif');
		for($i=0;$i<count($listeClasseFr);$i++){
			$idClasse = $listeClasseFr[$i]['id'];
			$nomClasse = utf8_decode($listeClasseFr[$i]['nom_classe']);
			echo "<option value='".$idClasse."'>".$nomClasse."</option>";
		}?>
	</select>
	<div id='date' style='display:inline'>
	</div>
</form>








<?php 
	if(isset($_POST['info'])){ 
		$classe = $_POST['classe'];
		// echo '<pre>'; print_r($_POST); echo '</pre>';
		$nomClasse = $config->getClasse($classe);
		$dateSaisie = $_POST['dateAbsence'];
		if(empty($_POST['dateAbsence'])){
			$msg = 'Entrez une date';
			echo "<h3 class='alert'>".$msg."</h3>";
		}else{
			$listeEleve = $config->listeEleve($classe,'non_supprime');
			require_once('../forms/ajouterAbsenceEleve.form.php');
		}
 	}