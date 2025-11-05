<h1 class='bien'>Suppression des absences</h1>
<form method='post' action='../traitement.php'>
	<table border='1' width='100%'>
		<tr>
			<th>N°</th>
			<th>Date</th>
			<th>Classe</th>
			<th>Noms et Prénoms</th>
			<th>Nb Heures</th>
			<th>Option</th>
		</tr>
		<?php 
		$abs = $config->viewAbsenceJustif('ANJ');
		// echo '<pre>'; print_r($abs); echo '</pre>';
		if(!empty($abs)){
			$a = 1;
			for($i=0;$i<count($abs);$i++){
				$nom = $abs[$i]['nom_complet'];
				echo "<tr>
					<td align='center'>".$a."</td>
					<td>".$abs[$i]['date_abs']."</td>
					<td>".ucwords($abs[$i]['nom_classe'])."</td>
					<td>".$nom."</td>
					<td>".$abs[$i]['nombre_heure']."</td>
					<td><input type='checkbox' name='eleve[]' value='".$abs[$i]['id']."' /></td>
					</tr>";
				$a++;
			}
		}else{
			echo "<tr>
				<td colspan='6'>Aucune Absence Enregistrée pour le moment. ;-)</td>
			</tr>";
		}
		?>
		<tr>
			<td colspan='6' align='center'><input type='submit' name='delAbsence' value='Supprimer' /></td>
		</tr>
	</table>
</form>