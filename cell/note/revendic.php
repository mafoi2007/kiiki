<h1 class='bien'>Révendications Séquentielles</h1>
		<form method='post' action=''>
			Classe : <select name='classe' id='classe' onChange='goListe()'>
				<option value='null'>-Classe-</option>
				<?php 
					$regions = $config->verifNoteSaisieClasse();
					for($i=0;$i<count($regions);$i++){
						echo "<option value='";
						echo $regions[$i]['id_classe'];
						echo "'>".strtoupper($regions[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			<div id='eleve' style = 'display:inline'>
			</div>
		</form>
		
		
		
<?php 
	if(isset($_POST['Go'])){
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		$classe = $_POST['classe'];
		$eleve = $_POST['eleve'];
		$sequence = $_POST['sequence'];
		if($classe=='null' or $eleve=='null' or $sequence=='null'){
			echo "<h3 class='alert'>Vous devez renseigner toutes les valeurs.</h3>";
		}else{ 
			// On affiche les informations de base 
            $infoEleve = $config->getEleve($eleve);
            $infoClasse = $config->getClasse($classe);
            $listeMatiere = $config->listeMatiereClasse($classe);
            print_r($listeMatiere);
// 			// On récupère la liste des Matières 
// 			$listeMatiere = $config->listeMatiereClasse($codeClasse);
// 			// On récupère les notes qu'il aurait obtenue 
// 			$valeurs = $config->getNoteEleve($eleve,$sequence);
			
			echo '<pre>';print_r($infoEleve); echo '</pre>';
?>
			<form method='post' action='../traitement.php' target='_blank'>
				<fieldset>
					<legend><h3>Informations de Base</h3></legend>
					<h3>Nom de l'élève :
						<font class='alert'>
						<?php echo strtoupper($infoEleve['nom_complet']); ?>
						<input type='hidden' name='eleve' value='<?php echo $infoEleve['id']; ?>' />
						</font>
					</h3>
					<h3>Classe de l'élève :
						<font class='alert'>
						<?php echo strtoupper($infoClasse['nom_classe']); ?>
						<input type='hidden' name='classe' value='<?php echo $infoClasse['id'];?>' />
						</font>
					</h3>
					<h3>Séquence :
						<font class='alert'>
						Séquence <?php echo strtoupper($sequence); ?>
						<input type='hidden' name='sequence' value='<?php echo $sequence;?>' />
						</font>
					</h3>
				</fieldset>
				<table border='1' width='75%'>
					<tr>
						<th>N°</th>
						<th>Matière</th>
						<th>Anc. Valeurs</th>
						<th>Nouvelles Notes</th>
						<th>Annuler la Note</th>
					</tr>
					<?php 
					$a = 1;
// 					for($i=0;$i<count($listeMatiere);$i++){
						
// 						echo "<tr>";
// 							echo "<td>".$a."</td>";
// 							echo "<input type='hidden' name='matiere[]' value='".$listeMatiere[$i]['id_matiere']."' />";
// 							echo "<td>".strtoupper($listeMatiere[$i]['nom_matiere'])."</td>";
// 							echo "<td>";
// 								for($j=0;$j<count($valeurs);$j++){
// 									if($listeMatiere[$i]['id_matiere']==$valeurs[$j]['id_matiere']){
// 										echo "<input 
// 											type='text' 
// 											value='".$valeurs[$j]['note_simple']."'
// 											size='5'
// 											disabled
// 											/>";
// 									}
// 								}
// 							echo "</td>
// 							<td><input 
// 								type='text' 
// 								name='note[]' 
// 								size='5' 
// 								maxlength='5' /></td>
// 							<td><input type='checkbox' name='reset[".$listeMatiere[$i]['id_matiere']."]' /></td>
// 						</tr>";
// 						$a++;
// 					}
// 					?>
// 					<tr>
// 						<td align='center' colspan='5'>
// 							<input type='submit' name='revendic' value='Valider'/>
// 						</td>
// 					</tr>
// 				</table>
// 			</form>
			
			
			
			
<?php 		}
	}