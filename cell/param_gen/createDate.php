<h1 id='body3'>Créer les dates pour les absences</h1>
	
	<form method='post' action='../traitement.php' target='_blank'>
		<table border='01' width='50%'>
			<tr>
				<th>Libellé Séquence</th>
				<th>Date de Début</th>
				<th>Date de Fin</th>
			</tr>
			<?php 
				$listePeriode = $config->viewPeriode();
				// index->id, index->nom_periode
				for($i=0;$i<count($listePeriode);$i++){
					echo "<tr>
						<td>".$listePeriode[$i]['nom_periode']." </td>
						<input type='hidden' name='periode[]' value='".$listePeriode[$i]['id']."' />
						<td><input type='date' name='openD[]' /></td>
						<td><input type='date' name='closeD[]' /></td>
					</tr>";
				}
			?>
			
			</tr>
				<td colspan='3' align='center'>
					<input 
						type='submit'
						name='createDate'
						value='Créer les Dates' />
				</td>
			</tr>
		</table>
	</form>