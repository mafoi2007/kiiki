<h1>Définition des Périodes</h1>
	
	<form method='post' action='../traitement.php'>
		<p>Séquence à activer : 
				<select name='sequence'>
					<?php
						$listePeriode = $config->viewPeriode();
						for($i=0;$i<count($listePeriode);$i++){
							echo "<option value='";
							echo $listePeriode[$i]['id'];
							echo "'>".$listePeriode[$i]['nom_periode']."</option>";
						}
					?>
					
				</select>
		</p>
		<p>Nombre de jours d'activation : 
				<select name='nbjour'>
					<option value=1>1</option>
					<option value=3>3</option>
					<option value=7>7</option>
					<option value=10>10</option>
				</select>
		</p>
		<p><input type='submit' name='activer' value='Activer la Séquence' /></p>
	</form>