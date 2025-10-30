<?php $eleve = $config->listeEleveAbsence(); /*echo '<pre>'; print_r($eleve); echo '</pre>';*/ ?>
<h1 class='bien'>justification des absences</h1>
		<form method='post' action='../traitement.php'>
			Eleve : <select name='eleve' id='eleve' onChange='goJustif()'>
				<option value='null'>-Eleve-</option>
				<?php 
					for($i=0;$i<count($eleve);$i++){
						echo "<option value='";
						echo $eleve[$i]['id_eleve'];
						echo "'>".strtoupper($eleve[$i]['nom_complet'])."</option>";
					}
				?>
			</select>
			
			<div id='view'>
			</div>
			
		</form>





<?php 
	if(isset($_POST['viewAbsenceEleve'])){ 
		/*echo '<pre>';
		print_r($_POST);
		echo '</pre>';*/ ?>

<form method='post' action='../traitement.php' id="3">
	<table border='1' width='100%'>
		
		<tr>
			<th>N°</th>
			<th>Date</th>
			<th>Classe</th>
			<th>Noms et Prénoms</th>
			<th>Nb Heures</th>
			<th>Justifier</th>
		</tr>
		<?php 
		$abs = $config->viewAbsenceEleve($_POST['eleve']);
		if(empty($abs)){
			echo "<tr>
				<td 
					colspan='6' 
					align='center'
					class='alert'>Aucune Absence Enregistrée pour le moment.</td>
			</tr>";
		}else{
			$w = 1;
			for($x=0;$x<count($abs);$x++){
				$nom = strtoupper($abs[$x]['nom']);
				$nom .= ' '.ucwords($abs[$x]['prenom']);
				if($abs[$x]['justification']=='ANJ'){
					$justif = "<input type='checkbox' name='idAbsence[]' value='";
					$justif .= $abs[$x]['id'];
					$justif .= "' />";
				}else{
					$justif = "Absence Déja Justifée";
				}
				echo "<tr>
					<td>".$w."</td>
					<td>".$abs[$x]['date_abs']."</td>
					<td>".ucwords($abs[$x]['nom_classe'])."</td>
					<td>".$nom."</td>
					<td>".$abs[$x]['nombre_heure']."</td>
					<td>".$justif."</td>
				</tr>";
				$w++;
			}
			echo "<tr>
				<td 
					colspan='6' 
					align='center'>
				<input 
					type='submit' 
					name='updAbsence' 
					value='Justifier' /></td>
			</tr>";
		}
 	}
?>
	</table>
</form>