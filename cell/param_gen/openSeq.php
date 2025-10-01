<h1 id='body3'>Définition des Périodes</h1>
	
	<form method='post' action='../traitement.php'>
		<table border='0' width='50%'>
			<tr>
				<td>Séquence à activer :</td>
				<td> &nbsp; </td>
				<td>
					<select name='sequence'>
						<?php 
						$listePeriode = $config->viewPeriode();
						for($i=0;$i<count($listePeriode);$i++){
							echo "<option value='";
							echo $listePeriode[$i]['id'];
							echo "'>".$listePeriode[$i]['nom_periode']."</option>";
						}
						?>
						<option value='null'selected>-Choisir Séquence-</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Nombre de jours d'activation :</td>
				<td> &nbsp; </td>
				<td>
					<select name='nbjour'>
						<option value=1>1</option>
						<option value=3>3</option>
						<option value=7>7</option>
						<option value=10>10</option>
						<option value='null' selected>-Nombre de Jours-</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			</tr>
				<td colspan='3' align='center'>
					<input 
						type='submit'
						name='activer'
						value='Activer la Séquence' />
				</td>
			</tr>
		</table>
	</form>