<h1 class='bien'>Consultation des absences</h1>

		<form method='post' action='#body3'>
			Classe : <select name='clas' id='clas' onChange='goView()'>
				<option value='null'>-Classe-</option>
				<?php 
					$regions = $config->viewClasse('actif');
					for($i=0;$i<count($regions);$i++){
						echo "<option value='";
						echo $regions[$i]['code_classe'];
						echo "'>".strtoupper($regions[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			Elève : <div id='eleve' style = 'display:inline'>
				<select name='eleve'>
					<option value='null'>-choisir un élève-</option>
				</select>
			</div>
			
		</form>



<?php 
	if(isset($_POST['viewAbsenceEleve'])){ 
		$eleve = $_POST['eleve'];
		$absences = $config->viewAbsenceEleve($eleve); 
		// echo '<pre>'; print_r($absences); echo '</pre>';
		if(empty($absences)){
			$message = "Cet élève n'a aucune absence enregistrée.";
			echo "<h3 class='alert' id='body3'>".$message."</h3>";
		}else{?>
			<div id="body3">
				<?php $nom = strtoupper($absences[0]['nom']).' '.ucwords($absences[0]['prenom']); ?>
				<?php $cls = ucwords($absences[0]['nom_classe']); ?>
				<h2 class='alert'>Absences de : <?php  echo $nom.' ('.$cls.')'; ?></h2>
				<table border='1' width='100%'>
					<tr>
						<th>Date</th>
						<th>Nombre d'Heures</th>
						<th>Situation</th>
					</tr>
					<?php 
					for($i=0;$i<count($absences);$i++){
						echo "<tr>
							<td>".$absences[$i]['date_abs']."</td>
							<td>".$absences[$i]['nombre_heure']." Heures</td>
							<td>".str_replace('ANJ','Non Justifié',$absences[$i]['justification'])."</td>
						</tr>";
						$total[$i] = $absences[$i]['nombre_heure'];
					}
					echo "<tr align='center'>
						<th>TOTAL</th>
						<th colspan='2'>".array_sum($total)." Heures d'Absences</th>
					</tr>";
					?>
				</table>
			</div>
			
			
			
			
			
			
			
			
			
<?php 			
		}
	}