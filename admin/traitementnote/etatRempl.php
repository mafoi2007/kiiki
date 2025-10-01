<h1>Etat de Remplissage des notes séquentielles</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>
<h3>Les Notes ayant déjà été saisies</h3>
<form method='post' action='' target = _blank>
	<p>Classe : 
		<select name='classe'>
			<option value=''>-Choisir-</option>
			<?php 
			$listeClasse = $note->viewClasseNote();
			for($i=0;$i<count($listeClasse);$i++){
				echo "<option value='";
				echo $listeClasse[$i]['id_classe'];
				echo "'>";
				echo $listeClasse[$i]['nom_classe'];
				echo "</option>";
			}
			?>
		</select>
		Période :
		<select name='periode'>
			<option value=''>-Choisir-</option>
			<?php 
			$listeSequence = $note->viewSequenceNote();
			for($i=0;$i<count($listeSequence);$i++){
				echo "<option value='";
				echo $listeSequence[$i]['id_periode'];
				echo "'>";
				echo $listeSequence[$i]['nom_periode'];
				echo "</option>";
			}
			?>
		</select>
		<input type='submit' name='etat' value='Visualiser' />
	</p>
</form>

<?php 
	if(isset($_POST['etat'])){ 
		// print_r($_POST);
		$matiereDefinies = $note->listeMatiereClasse($_POST['classe']);
		$NbMatiere = count($matiereDefinies);
		$resultat = $note->etatRemplissage($_POST['classe'], $_POST['periode']);
		$NbMatiereSaisie = count($resultat);
		$difference = $NbMatiere - $NbMatiereSaisie;
		// echo '<pre>';print_r($resultat);echo '</pre>';
	?>
		<h3>Classe : <font color='red'><?php echo $resultat[0]['nom_classe']; ?></font> &nbsp; &nbsp; 
			Période :<font color='red'><?php echo 'Séquence '.$_POST['periode']; ?></font> </h3>
		<table border='1' width='100%'>
			<tr>
				<th>N°</th>
				<th>Code Matière</th>
				<th>Nom Matière</th>
				<th>Enseignant</th>
				<th>Etat de Saisie</th>
			</tr>
			<?php 
			$a = 1;
			for($i=0;$i<count($resultat);$i++){
				$enseignant = strtoupper($resultat[$i]['nom']);
				$enseignant .= ' ';
				$enseignant .= ucwords($resultat[$i]['prenom']);
				echo '<tr>
					<td>'.$a.'</td>
					<td>'.strtoupper($resultat[$i]['matiere']).'</td>
					<td>'.ucwords($resultat[$i]['nom_matiere']).'</td>
					<td>'.$enseignant.'</td>
					<td>Ok</td>
				</tr>';
				$a++;
			}
			?>
		</table>
		<fieldset>
			<legend>Informations</legend>
			<h3>Matières Définies : <?php echo $NbMatiere;?></h3>
			<h3>Matières Saisies : <?php echo $NbMatiereSaisie;?></h3>
			<h3>Reste à Saisir : <?php echo $difference;?></h3>
		</fieldset>
<?php 	}