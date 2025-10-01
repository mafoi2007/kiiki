<h1 class='bien'>Mon Journal de Connexion</h1>
	<?php 
	// echo '<pre>'; print_r($_SESSION); echo '</pre>';
	$journal = $config->journalConnexion($_SESSION['login']); 
	// echo '<pre>'; print_r($journal); echo '</pre>';
	?>
	<form method='post' action='../traitement.php' target='_blank'>
		<table border='1' width='55%' align='center'>
			<tr>
				<th>N°</th>
				<th>Date</th>
				<th>Heure de Connexion</th>
			</tr>
			<?php 
			$a = 1;
			for($i=0;$i<count($journal);$i++){
				echo '<tr align="center">
					<td>'.$a.'</td>
					<td>'.$journal[$i]['jour'].'</td>
					<td>'.$journal[$i]['heure'].'</td>
				</tr>';
				$a++;
			}
			?>
		</table>
	</form>


	<?php 
		if(isset($_POST['validerEnseignant'])){
			echo "<h3 class='alert'>Espace en Construction.</h3>";			
		}	
	?>