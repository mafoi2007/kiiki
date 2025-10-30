<?php 
	$verification = $config->verifNoteSaisie($classe, $matiere, $sequence);
	// echo '<pre>'; print_r($listeNote); echo '</pre>';
	if(!empty($verification)){ ?>
<form method='post' action='../traitement.php' target='_blank'>
	<fieldset>
		<legend><h3 class='bien'>Consultation des Notes Séquentielles</h3></legend>
		<p>Classe : <input type='text' value='<?php echo $nomClasse['nom_classe']; ?>' disabled />
			Matière : <input type='text' value='<?php echo $nomMatiere['nom_matiere']; ?>' disabled />
			Séquence : <input type='text' value='<?php echo utf8_decode($nomSequence['nom_periode']); ?>' disabled />
		</p>
		Notes saisies le : 
			<font color='blue'><?php echo $verification['date_fr']; ?></font> à 
			<font color='blue'><?php echo $verification['heure_fr']; ?></font> par :
			<font color='blue'><?php echo $verification['nom_complet_enseignant']; ?></font>
	</fieldset>
	<table border='1' width='90%' align='center'>
		<caption>
			Compétence Visée : 
			<font color='red'>
				<?php echo stripslashes($verification['competence']); ?>
			</font>
		</caption>
		<tr>
			<th>N°</th>
			<th>Noms et Prénoms</th>
			<th>Note Enregistrée</th>
			<th>Cote</th>
			<th>Appréciation</th>
		<?php 
		$a = 1;
		for($i=0;$i<count($listeEleve);$i++){ ?>
			<tr>
				<td><?php echo $a; ?></td>
				<td>
					<?php echo $listeEleve[$i]['nom_complet']; ?>
				</td>
				<?php 
				for($x=0;$x<count($listeNote);$x++){
					if($listeEleve[$i]['id']==$listeNote[$x]['id_eleve']){
						$appr = $config->showAppreciation($listeNote[$x]['note']);
						echo '<td>'.$listeNote[$x]['note'].'</td>
						<td>'.$appr['cote'].'</td>
						<td>'.$appr['nom_appreciation_fr'].'</td>';
					}
				}
				?>
			</tr>
<?php 	
			$a++;
		} ?>
	</table>
</form>
<?php 
	}else{
		echo "<h3 class='alert'>Vous n'avez pas encore saisi les notes de cette matière pour la classe.";
	}
?>


