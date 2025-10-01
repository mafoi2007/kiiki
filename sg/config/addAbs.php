<h1 class='bien'>enregistrement des absences</h1>

<form method='post' action=''>
	<p>Classe : 
	<select name='classe'>
		<option value='null'>-Choisir Classe-</option>
		<?php 
		$listeClasse = $config->viewClasse('actif');
		for($a=0;$a<count($listeClasse);$a++){
			echo "<option value='".$listeClasse[$a]['code_classe'];
			echo "'>".strtoupper($listeClasse[$a]['nom_classe'])."</option>";
		}
		?>
	</select>
	<input type='submit' name='info' value='Ok' /></p>
</form>














<?php 
	if(isset($_POST['info'])){ 
		$classe = $_POST['classe'];
		if($classe=='null'){
			$message = 'Valeur de Classe non renseignée';
			echo "<script>alert('".$message."');</script>";
		}else{ ?>
			<h1 class='alert'>Absences de la <?php echo $classe; ?></h1>
			<form method ='post' action='../traitement.php' target='_blank'>
				<table border='0' width='75%'>
					<tr>
						<th>Elève  </th>
						<th>Date  </th>
						<th>Nb Heures  </th>
					</tr>
					<tr>
						<td>
							<select name='eleve'>
								<?php 
								$listeEleve = $config->listeEleve($classe, 'non_supprime');
								for($i=0;$i<count($listeEleve);$i++){
									$nom = strtoupper($listeEleve[$i]['nom']).' ';
									$nom .= ucwords($listeEleve[$i]['prenom']);
									echo "<option value='".$listeEleve[$i]['id'];
									echo "'>".$nom."</option>";
								}
								?>
								<option value='null' selected>-Choisir Elève-</option>
							</select>
						</td>
						<td>
							<input type='date'
									name='dateAbs' />
						</td>
						<td>
							<input type='number' name='nbHeures' max='8' size='3' />
						</td>
					</tr>
					
					<tr>
						<td colspan='3' align='center'>
							<input type='submit' name='absence' value='Enregistrer' />
						</td>
					</tr>
				</table>
			</form>










<?php 	}
 	}