<h1 id='body3'>Vérouiller une séquence</h1>
	<form method='post' action='../traitement.php'>
		<p>Séquence à vérouiller :
			<select name='sequence'>
				<?php 
					$listePeriode = $config->viewPeriode();
					for($i=0;$i<count($listePeriode);$i++){
						echo "<option value='";
						echo $listePeriode[$i]['id'];
						echo "'>".$listePeriode[$i]['nom_periode']."</option>";
					}
				?>
				<option value='null' selected>-Choisir Séquence-</option>
			</select>
		</p>
		<p><input type='submit' name='desactiver' value='Vérouiller la Séquence' /></p>
	</form>

