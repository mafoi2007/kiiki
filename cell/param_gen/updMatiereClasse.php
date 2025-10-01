<h1 id='body3'>Modifier une matière de la classe</h1>
	<h3 class='alert'>Espace en Construction</h3>
	<form method='post' action=''>
		<?php /*<p>Classe : 
			<select name='classe'>
				<?php 
					$classe = $config->viewClasse('actif');
					if(count($classe)==0){
						echo "<option value='null'>-Aucune classe enregistrée-</option>";
					}
					else{
						for($i=0;$i<count($classe);$i++){
							echo "<option value='";
							echo $classe[$i]['code_classe'];
							echo "'>";
							echo ucwords($classe[$i]['nom_classe']);
							echo "</option>";
						}
						echo "<option value='null' selected>-Choisir la classe-</option>";
					}
				?>
			</select>
			<input type='submit' name='cls' value='Ok' />
		</p> */ ?>
	</form>
	
<?php 
	if(isset($_POST['cls'])){
		echo '<pre>';
		// print_r($_POST);
		echo '</pre>';
		$class = $_POST['classe'];
		if($class=='null'){
			echo "<h3 class='alert'>Aucune classe Choisie.</h3>";
		}
		else{ ?>
			<h3 class='alert'>Classe de : <?php echo strtoupper($class); ?></h3>
		<form method='post' action='../traitement.php'>
			<input type='hidden' name = 'classe' value='<?php echo $_POST['classe'];?>' />
			<table border='0' width='75%' align='center'>
				<tr>
					<th>N°</th>
					<th>Nom de la Matière</th>
					<th>Coefficient</th>
					<th>Groupe</th>
				</tr>
				<?php 
				$listeMatiere = $config->listeMatiereClasse($class);
				echo '<pre>';print_r($listeMatiere);
				if(count($listeMatiere)==0){
					echo "<tr>
						<td colspan='4' align='center'>
							<h3 class='alert'>Aucune Matière Enregistrée</h3></td>
					</tr>";
				}
				else{
					$x = 1;
					for($a=0;$a<count($listeMatiere);$a++){
						echo "<tr>
							<td align='center'>".$x."</td>
							<td>".strtoupper($listeMatiere[$a]['nom_matiere'])."</td>
							<input type='hidden' name='matiere[]' value='".$listeMatiere[$a]['id_matiere']."' />
							<td>
								<input	
									type='text'
									name='coef[]'
									size='4'
									maxlength='5'
									value='".$listeMatiere[$a]['coef']."'
									/>
							</td>
							<td>
			<select name='groupe[]'>
				<optgroup label = 'Groupe 1,2,3'>
					<option value='gp1'>Groupe 1</option>
					<option value='gp2'>Groupe 2</option>
					<option value='gp3'>Groupe 3</option>
				</optgroup>
				<optgroup label = 'Matières Litt, Scient, autres'>
					<option value='litteraire'>Matières Littéraires</option>
					<option value='scientifique'>Matières Scientifiques</option>
					<option value='autre'>Matières Autres</option>
				</optgroup>
				<optgroup label='Matières Pro, Techn, Gén'></optgroup>
					<option value='professionnel'>Enseignements Professionnels</option>
					<option value='technique'>Enseignements Techniques</option>
					<option value='general'>Enseignements Généraux</option>
				</optgroup>
				<option value='null' selected>-Choisir le groupe-</option>
			</select></td>
						</tr>";
						$x++;
					}
				}
				?>
				<tr>
					<td colspan='4' align='center'><input 
										type='submit' 
										name='updmatclss' 
										value='Modifier les matières' /></td>
				</tr>
			</table>
		</form>
			
			
			
<?php 			
		}
	}


?>	
	
		<p></p>
	</form>