<h1>désigner un professeur principal</h1>
		
	<form method='post' action = '../traitement.php'>
		<table border = '1' width = '75%'>
			<tr>
				<th>N°</th>
				<th>Classe</th>
				<th>Enseignant</th>
				
			</tr>
			<?php 
			$listeClasse = $config->listeClasseProfClasse();
			$a = 1;
			for($i=0;$i<count($listeClasse);$i++){
				echo "<tr>
					<td align='center'>".$a."</td>
					<td>".$listeClasse[$i]['nom_classe'];
					echo "<input type='hidden' name='cls[]' value='";
					echo $listeClasse[$i]['id_classe']."' /></td>
					<td>
						<select name='prof[]'>";
							$prof = $config->conseilDeClasse($listeClasse[$i]['id_classe']);
							for($j=0;$j<count($prof);$j++){
								echo "<option value='";
								echo $prof[$j]['id_prof'];
								echo "'>";
								echo strtoupper($prof[$j]['nom'])." ";
								echo ucwords($prof[$j]['prenom']);
								echo "</option>";
							}
							echo "<option value='null' selected>-Choisir-</option>";
						echo "</select>
					</td>
				</tr>";
				$a++;
			}
			
			?>
			<tr>
				<td colspan='3' align='center'><input 
										type='submit' 
										name='addpp' 
										value='Ajouter' />
				</td>
			</tr>
		</table>
	</form>
	