<h1 id='body3'>Modifier une date pour les absences</h1>
	<?php 
		if(isset($_GET['periode'])){
			$periode = urldecode($_GET['periode']);
			echo "<form method='post' action='../traitement.php'>
				<table border='0' width='75%' align='center'>
					<tr>
						<th>Nom de la Séquence</th>
						<th>Date de Début</th>
						<th>Date de Cloture</th>
					</tr>";
					$resultat = $config->viewDateAbsencePrecise($periode);
					// echo '<pre>'; print_r($resultat);
					echo "<tr>
						<td align='center'>".utf8_decode($resultat[0]['nom_periode'])."</td>
						<input type='hidden' name='sequence' value='".$resultat[0]['id_periode']."' />
						<td align='center'><input type='date' name='open' value='".$resultat[0]['open_date']."' /></td>
						<td align='center'><input type='date' name='close' value='".$resultat[0]['close_date']."' /></td>
					</tr>";
					echo "<tr>
						<td colspan='5' align='center'><input type='submit' name='updDate' value='Mettre à Jour' /></td>
					</tr>";
				echo "</table>
			</form>";
		}else{
			echo "<h3 class='alert'>Choisir une Séquence dans le menu CONSULTER LES DATES POUR LES ABSENCES</h3>";
		}







if(isset($_POST['updDate'])){
	echo '<pre>';print_r($_REQUEST); echo '</pre>';
	$open = str_replace(' ','',$_POST['open']);
	
}
		
		
		
		
		
		
		