<?php 
	$classe = $config->viewClasse('actif'); 
	$matiere = $config->listeMatiereAll('actif');
	// echo '<pre>'; print_r($matiere); echo '</pre>';
?>
<h1 id='body3'>Insérer une matière dans la classe</h1>
	
	<form method='post' action='../traitement.php'>
		<p>Classe : 
			<select name='classe'>
				<?php 
					
					if(count($classe)==0){
						echo "<option value='null'>-Aucune classe enregistrée-</option>";
					}
					else{
						for($i=0;$i<count($classe);$i++){
							echo "<option value='";
							echo $classe[$i]['id'];
							echo "'>";
							echo ucwords($classe[$i]['nom_classe']);
							echo "</option>";
						}
						echo "<option value='null' selected>-Choisir la classe-</option>";
					}
				?>
			</select>
		</p>
		<p>Matière : 
			<select name='matiere'>
				<?php 
					
					if(count($matiere)==0){
						echo "<option value='null'>-Aucune matière enregistrée-</option>";
					}
					else{
						for($i=0;$i<count($matiere);$i++){
							echo "<option value='";
							echo $matiere[$i]['id'];
							echo "'>";
							echo ucwords($matiere[$i]['nom_matiere']);
							echo "</option>";
						}
						echo "<option value='null' selected>-Choisir la matière-</option>";
					}
				?>
			</select>
		</p>
		<p>Coef : 
			<select name='coef'>
				<?php 
					for($nb=1;$nb<=10;$nb++){
						echo "<option value=".$nb.">".$nb."</option>";
					}
				?>
			</select>
		</p>
		<p>Groupe :
			<select name='groupe'>
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
				<optgroup label="Matières Pro, Techn, Gén"></optgroup>
					<option value='professionnel'>Enseignements Professionnels</option>
					<option value='technique'>Enseignements Techniques</option>
					<option value='general'>Enseignements Généraux</option>
				</optgroup>
			</select>
		</p>
		<p><input type='submit' name='addmatcls' value='Ajouter la matière' /></p>
	</form>