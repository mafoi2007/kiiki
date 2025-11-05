<h1 id='body3'>désigner un professeur principal</h1>

	<form method='post' action = '../traitement.php'>
		<table border = '1' width = '75%'>
			<tr>
				<th>N°</th>
				<th>Classe</th>
				<th>Enseignant</th>
				
			</tr>
			<?php 
			$listeClasse = $config->listeClasseProfClasse();
			// echo '<pre>'; print_r($listeClasse);
			$a = 1;
			for($i=0;$i<count($listeClasse);$i++){ ?>
				<tr>
					<td align='center'><?php echo $a; ?></td>
					<td>
						<?php echo $listeClasse[$i]['nom_classe'];?>
						<input 
							type='hidden' 
							name='classe[]' 
							value='<?php echo $listeClasse[$i]['id_classe']; ?>' />
					</td>
					<td>
						<select name='prof[]'>
							<?php 
							$prof = $config->conseilDeClasse($listeClasse[$i]['id_classe']);
							for($j=0;$j<count($prof);$j++){
								$idProf = $prof[$j]['id_prof'];
								$nomProf = $prof[$j]['nom_complet_enseignant'];
								echo "<option value='".$idProf."'>".$nomProf."</option>";
							} ?>
							<option value='null' selected>-Choisir-</option>
						</select>
					</td>
				</tr>
<?php 
				$a++;
			}
			/*for($i=0;$i<count($listeClasse);$i++){
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
			}*/
			
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
	