
	<?php 
	if(isset($_GET['id'])){
		$eleve = $config->getEleve($_GET['id']); /*echo '<pre>'; print_r($eleve); echo '</pre>'; */?>
		
	<h1 class='alert'>Mise à Jour de l'élève</h1>
	<h2>Elève à modifier : <font class='bien'><?php echo $eleve['nom_complet'];?></font></h2>
	<form method='post' action='../traitement.php' target='_blank'>
		<input type='hidden' name='idEleve' value="<?php echo $eleve['id'];?>" />
		<table border='0' width='100%'>
			<tr>
				<th>Libellé</th>
				<th>Anciennces Informations</th>
				<th>Nouvelles Informations</th>
			</tr>
			<tr>
				<td>Nom</td>
				<td><input 
						type='text'
						disabled
						size='40'
						value='<?php echo $eleve['nom_complet']; ?>'
						/>
				</td>
				<td><input 
						type='text'
						name='nomEleve'
						id='nomEleve'
						required
						size='40'
						maxlength='50'
						value='<?php echo $eleve['nom_complet']; ?>'
						/>
				</td>
			</tr>
			<tr>
				<td colspan='5'>&nbsp;</td>
			</tr>
			<tr>
				<td>Matricule National</td>
				<td><input 
						type='text'
						disabled
						size='20'
						maxlength='20'
						value='<?php echo $eleve['rne']; ?>'
						/>
				</td>
				<td><input 
						type='text'
						name='rneEleve'
						id='rneEleve'
						size='20'
						maxlength='20'
						value='<?php echo $eleve['rne']; ?>'
						/>
				</td>
			</tr>
			<tr>
				<td colspan='5'>&nbsp;</td>
			</tr>
			<tr>
				<td>Matricule</td>
				<td><input 
						type='text'
						disabled
						size='20'
						maxlength='20'
						value='<?php echo $eleve['matricule']; ?>'
						/>
				</td>
				<td><input 
						type='text'
						name='matriculeEleve'
						id='matriculeEleve'
						size='20'
						maxlength='20'
						value='<?php echo $eleve['matricule']; ?>'
						/>
				</td>
			</tr>
			<tr>
				<td colspan='5'>&nbsp;</td>
			</tr>
			<tr>
				<td>Sexe</td>
				<td>
					<select>
						<option disabled selected>
							<?php 
							if($eleve['sexe']=='F'){
								echo 'Feminin';
							}elseif($eleve['sexe']=='M'){
								echo 'Masculin';
							}
								?>
						</option>
					</select>
				</td>
				<td>
					<select name='sexeEleve'>
					<?php 
					$listeSexe= $config->listeSexe();
					for($i=1;$i<count($listeSexe['libelle']);$i++){
						echo "<option value='";
						echo $listeSexe['code'][$i];
						echo "'";
						if($listeSexe['code'][$i]===$eleve['sexe']){
							echo "selected";
						}
						echo">".$listeSexe['libelle'][$i]."</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan='5'>&nbsp;</td>
			</tr>
			<tr>
				<td>Statut</td>
				<td>
					<select>
						<option disabled selected>
							<?php if($eleve['statut']=='N'){
								echo 'Nouveau';
							}elseif($eleve['statut']=='R'){
								echo 'Redoublant';
							}
							?>
						</option>
					</select>
				</td>
				<td>
					<select name='statutEleve'>
					<?php 
					$listeStatut= $config->listeStatut();
					for($i=1;$i<count($listeStatut['libelle']);$i++){
						echo "<option value='";
						echo $listeStatut['code'][$i];
						echo "'";
						if($listeStatut['code'][$i]===$eleve['statut']){
							echo "selected";
						}
						echo">".$listeStatut['libelle'][$i]."</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan='5'>&nbsp;</td>
			</tr>
			<tr>
				<td>Date de Naissance</td>
				<td><input 
						type='text'
						disabled
						size='20'
						maxlength='20'
						value='<?php echo $eleve['date_fr']; ?>'
						/>
				</td>
				<td><input 
						type='date'
						name='dateNaissEleve'
						id='dateNaissEleve'
						value='<?php echo $eleve['date_naissance']; ?>'
						/>
				</td>
			</tr>
			<tr>
				<td colspan='5'>&nbsp;</td>
			</tr>
			<tr>
				<td>Lieu de Naissance</td>
				<td><input 
						type='text'
						disabled
						size='25'
						maxlength='50'
						value='<?php echo $eleve['lieu_naissance']; ?>'
						/>
				</td>
				<td><input 
						type='text'
						name='lieuNaissEleve'
						id='lieuNaissEleve'
						size='25'
						maxlength='50'
						required
						value='<?php echo $eleve['lieu_naissance']; ?>'
						/>
				</td>
			</tr>
			<tr>
				<td colspan='5'>&nbsp;</td>
			</tr>
			<tr>
				<td>Nom du Père</td>
				<td><input 
						type='text'
						disabled
						size='40'
						maxlength='50'
						value='<?php echo $eleve['nom_pere']; ?>'
						/>
				</td>
				<td><input 
						type='text'
						name='nomPereEleve'
						id='nomPereEleve'
						size='40'
						maxlength='50'
						value='<?php echo $eleve['nom_pere']; ?>'
						/>
				</td>
			</tr>
			<tr>
				<td colspan='5'>&nbsp;</td>
			</tr>
			<tr>
				<td>Nom de la Mère</td>
				<td><input 
						type='text'
						disabled
						size='40'
						maxlength='50'
						value='<?php echo $eleve['nom_mere']; ?>'
						/>
				</td>
				<td><input 
						type='text'
						name='nomMereEleve'
						id='nomMereEleve'
						size='40'
						required
						maxlength='50'
						value='<?php echo $eleve['nom_mere']; ?>'
						/>
				</td>
			</tr>
			<tr>
				<td colspan='5'>&nbsp;</td>
			</tr>
			<tr>
				<td>Contact des Parents</td>
				<td><input 
						type='text'
						disabled
						size='40'
						maxlength='25'
						value='<?php echo $eleve['adresse_parent']; ?>'
						/>
				</td>
				<td><input 
						type='text'
						name='contactParentEleve'
						id='contactParentEleve'
						size='40'
						required
						maxlength='25'
						value='<?php echo $eleve['adresse_parent']; ?>'
						/>
				</td>
			</tr>
			<tr>
				<td colspan='5'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan='5' align='center'>
					<input 
						type='submit' 
						name='updEleve' 
						value='Mettre à Jour' />
				</td>
			</tr>
		</table>
		
	</form>


<?php 	}else{
	echo "<h3 class='alert'>Vous devez choisir un élève pour modifier ses informations.</h3>";
}
	?>
