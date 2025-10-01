<h1 class='bien'>Mettre à jour une photo</h1>
<form method='post' action=''>
	<?php $listeClasse = $config->viewClasse('actif'); 
	// echo '<pre>';print_r($listeClasse);echo '</pre>';
	?>
	<h3>Consulter les photos de la classe de : 
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
	<input type='submit' name='viewPhoto' value='Ok' />
	</h3>
</form>


<?php 
if(isset($_POST['viewPhoto'])){
	$classe = $_POST['classe'];
	if($classe=='null'){
		$message = 'Aucune classe choisie';
		echo "<script>alert('".$message."');</script>";
	}
	else{
		$listeEleve = $config->listeEleve($classe, 'non_supprime');
		// echo '<pre>';print_r($listeEleve);echo '</pre>';
		echo '<h3 class="alert">Classe de '.strtoupper($listeEleve[0]['nom_classe']).'</h3>'; ?>
		<form method='post' action='../traitement.php' enctype='multipart/form-data'>
			<table border='0' width='70%' align='center'>
				<tr>
					<th>N°</th>
					<th>Noms et Prénoms</th>
					<th>Photos</th>
				</tr>
				<?php 
				$a = 1;
				for($i=0;$i<count($listeEleve);$i++){
					$nom = strtoupper($listeEleve[$i]['nom']);
					$nom .= ' '.ucwords($listeEleve[$i]['prenom']);
					$matricule = $listeEleve[$i]['matricule']; 
					$idEleve = $listeEleve[$i]['id'];
					$photo = $listeEleve[$i]['photo'];
					echo "<tr>
						<td>".$a."</td>
						<td>".$nom."</td>";
						if(empty($photo)){
							echo "<td class='alert'>Aucune Photo</td>";
						}else{
							echo "<td><img src='../";
							echo utf8_decode($photo);
							echo "' width='100' height='100' border='1' /></td>";
						}
						
					echo "</tr>";
					$a++;
				}
				?>
			</table>
		</form>
<?php 
	}
}