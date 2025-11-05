<?php
	session_start();
	require_once('../inc/connect.inc.php');
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['eleve'])){
		$eleve = (int) $_POST['eleve'];
		if($eleve==0){
			$msg = "<h3 class='alert'>Vous devez selectionner un élève.</h3>";
			echo $msg;
		}else{
			$absence = $config->viewAbsenceEleve($eleve); ?>
			<table border='1' width='100%'>
				<tr>
					<th>N°</th>
					<th>Noms et Prénoms</th>
					<th>Classe</th>
					<th>Date d'absence</th>
					<th>Nb Heures</th>
					<th>Nb Heures justifiées</th>
					<th>Heures Non Justifiées</th>
				</tr>
	<?php 		
			$a = 1;
			for($i=0;$i<count($absence);$i++){
				$max = (int)$absence[$i]['nombre_heure'] - (int)$absence[$i]['justification'];
                $totalH[] = (int)$absence[$i]['nombre_heure'];
                $totalHJ[] = (int)$absence[$i]['justification'];
				echo "<tr>
					<td align='center'>".$a."
					<input type='hidden' name='ligne[]' value='".$absence[$i]['id']."'
					</td>
					<td>".$absence[$i]['nom_complet']."</td>
					<td>".$absence[$i]['nom_classe']."</td>
					<td>".$absence[$i]['date_abs']."</td>
					<td align='center'>".$absence[$i]['nombre_heure']."</td>
					<td>".$absence[$i]['justification']."</td>
					<td align='center'>".$max."</td>
				</tr>";
				$a++;
			} 
            $totalHeure = array_sum($totalH);
            $totalHeureJustifiee = array_sum($totalHJ);
            $totalHeureNonJustifiee = $totalHeure - $totalHeureJustifiee;
            ?>
				<tr>
					<th colspan='4' align='center'>
						TOTAL
					</th>
                    <th><?php echo $totalHeure; ?></th>
                    <th><?php echo $totalHeureJustifiee; ?></th>
                    <th><?php echo $totalHeureNonJustifiee; ?></th>
				</tr>
			</table>
		<?php }
		
	}
?>