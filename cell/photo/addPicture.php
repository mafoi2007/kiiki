<h1 class='bien'>ajouter des photos</h1>
<form method='post' action=''>
	<?php $listeClasse = $config->viewClasse('actif'); 
	// echo '<pre>';print_r($listeClasse);echo '</pre>';
	?>
	<h3>Ajouter les photos en classe de : 
		<select name='classe'>
			<?php 
				for($i=0;$i<count($listeClasse);$i++){
					echo "<option value='";
					echo $listeClasse[$i]['code_classe'];
					echo "'>";
					echo strtoupper($listeClasse[$i]['nom_classe']);
					echo "</option>";
				}
			?>
			<option value='null' selected>-Choisir la classe-</option>
		</select>
	<input type='submit' name='prepaPhoto' value='Ok' />
	</h3>
</form>

<?php 
if(isset($_POST['prepaPhoto'])){
	$classe = $_POST['classe'];
	if($classe=='null'){
		$message = "<script>alert('";
		$message .= "Aucune classe choisie";
		$message .="');</script>";
		echo $message;
		unset($message);
	}
	else{
		$listeEleve = $config->listeEleveSansPhoto($classe, 'non_supprime');
		// echo '<pre>';print_r($listeEleve);echo '</pre>';
		echo '<h3 class="alert">Classe de '.strtoupper($listeEleve[0]['nom_classe']).'</h3>'; ?>
		<form method='post' action='../traitement.php' enctype='multipart/form-data'>
			<table border='1' width='70%' align='center'>
				<tr>
					<th>N°</th>
					<th>Noms et Prénoms</th>
					<th>Ajout Photo</th>
				</tr>
				<?php 
				$a = 1;
				for($i=0;$i<count($listeEleve);$i++){
					$nom = strtoupper($listeEleve[$i]['nom']);
					$nom .= ' '.ucwords($listeEleve[$i]['prenom']);
					$matricule = $listeEleve[$i]['matricule']; 
					$idEleve = $listeEleve[$i]['id'];
					echo "<input type='hidden' name='eleve[]' value='".$idEleve."' />";
					echo "<input type='hidden' name='matricule[]' value='".$matricule."' />";
					echo "<tr>
						<td>".$a."</td>
						<td>".$nom."</td>
						<td><input type='file' name='photo[]' /></td>
					</tr>";
					$a++;
				}
				?>
				<tr>
					<td colspan='3' align='center''><input 
							type='submit' 
							name='addPhoto' 
							value='Valider' /></td>
				</tr>
			</table>
		</form>
<?php 
	}
}