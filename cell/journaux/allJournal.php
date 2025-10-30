<?php 
	$listePoste = $config->userType(); print_r($listePoste);?>
<h1 class='bien'>Journal de Connexion des Enseignants</h1>
		<form method='post' action=''>
			Nom de l'enseignant : 
			<select name='enseignant' id='enseignant' onChange='journalAll()'>
				<?php 
				for($i=0;$i<count($listePoste);$i++){
					$idPoste = $listePoste[$i]['id'];
					$libellePoste = $listePoste[$i]['libelle_poste'];
					echo "<optgroup label='".$libellePoste."'></optgroup>";
					$listeEnseignant = $config->getUtilisateurType($idPoste);
					for($j=0;$j<count($listeEnseignant);$j++){
						$idEnseignant = $listeEnseignant[$j]['idEnseignant'];
						$nomEnseignant = $listeEnseignant[$j]['nom_complet_enseignant']; 
						echo "<option value='".$idEnseignant."'>".$nomEnseignant."</option>";
					}
				}
				?>
				<option value='null' selected>-Choisir Enseignant-</option>
			</select>
			
			Département : <div id='departement' style = 'display:inline'>
				<select name='livre'>
					<option value='null'>-choisir un département-</option>
				</select>
			</div>
			
		</form>
	<?php 
	// $listeJournal = $config->viewGestionnaireAll('actif');
	// echo '<pre>';print_r($listeJournal);
	?>
	<form method='post' action=''>
		<p>Choisir l'enseignant : 
			<select name='prof'>
				<?php 
					$listeJournal = $config->viewGestionnaireAll('actif');
					for($i=0;$i<count($listeJournal);$i++){
						$id = $listeJournal[$i]['login'];
						$nom = strtoupper($listeJournal[$i]['nom']);
						$nom .= ' '.ucwords($listeJournal[$i]['prenom']);
						echo "<option 
							value='".$id."'>";
						echo $nom."</option>\n";
					}
				?>
				<option value='null' selected>-choisir un nom-</option>
			</select>
			<input type='submit' name='journal' value='Valider' />
		</p>
	</form>


	<?php 
		if(isset($_POST['journal'])){
			$nomEnseignant = $_POST['prof'];
			if($nomEnseignant=='null'){
				$message = 'Aucun enseignant sélectionné.';
				echo "<script>alert('".$message."');</script>";
			}
			else{
				$journal = $config->journalConnexion($nomEnseignant); 
				// print_r($journal);
				$nom = strtoupper($journal[0]['nom']);
				$nom .= ' '.ucwords($journal[0]['prenom']);
				?>
				<table border='1' width='55%' align='center'>
					<tr>
						<th colspan='3' class='alert'><?php echo $nom;?></th>
					</tr>
					<tr>
						<th>N°</th>
						<th>Date</th>
						<th>Heure de Connexion</th>
					</tr>
					<?php 
					$a = 1;
					for($i=0;$i<count($journal);$i++){
						echo '<tr align="center">
							<td>'.$a.'</td>
							<td>'.$journal[$i]['jour'].'</td>
							<td>'.$journal[$i]['heure'].'</td>
						</tr>';
						$a++;
					}
					?>
		</table>
				
				
			<?php }
		}
	
	
	?>