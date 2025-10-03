<h1 id='body3'>Fiche de l'élève</h1>
	<?php 
		if(isset($_GET['eleve'])){
			$eleve = urldecode($_GET['eleve']); 
			$info = $config->getEleve($eleve);
			// echo '<pre>';print_r($info);echo '</pre>';
			?>
			
			<form method='post' action='../traitement.php'>
				<table border='0' width='100%'>
					<tr>
						<td>Matricule National : </td>
						<td><input 
								type='text' 
								name='rne' 
								value='<?php echo $info['rne'];?>' /></td>
					</tr>
					<tr>
						<td>Matricule : </td>
						<td><input 
								type='text' 
								name='matricule' 
								value='<?php echo $info['matricule'];?>' /></td>
					</tr>
					<tr>
						<td>Nom : </td>
						<td><input 
								size='70'
								type='text' 
								name='nom' 
								value='<?php echo utf8_decode($info['nom_complet']);?>' /></td>
					</tr>
					
					<tr>
						<td>Sexe : </td>
						<td>
							<select name='sexe'>
								<?php 
								if($info['sexe']=='M'){
									echo "<option value='M' selected>Masculin</option>";
									echo "<option value='F'>Féminin</option>";
								}
								elseif($info['sexe']=='F'){
									echo "<option value='M'>Masculin</option>";
									echo "<option value='F' selected>Féminin</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Date de Naissance : </td>
						<td><input 
								type='text' 
								name='date_naissance' 
								value='<?php echo $info['date_naissance'];?>' /></td>
					</tr>
					<tr>
						<td>Lieu de naissance : </td>
						<td><input 
								type='text' 
								name='lieu_naissance' 
								value='<?php echo $info['lieu_naissance'];?>' /></td>
					</tr>
					<tr>
						<td>Classe : </td>
						<td>
							<select name='classe'>
								<?php 
								$cls = $config->viewClasse('actif');
								for($i=0;$i<count($cls);$i++){
									echo "<option value='";
									echo $cls[$i]['id'];
									echo "'";
									if($info['classe']==$cls[$i]['id']){
										echo "selected";
									}
									echo ">";
									echo $cls[$i]['nom_classe'];
									echo "</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Statut : </td>
						<td>
							<select name='statut'>
								<?php 
								if($info['statut']=='R'){
									echo "<option value='R' selected>Redoublant</option>";
									echo "<option value='N'>Nouveau</option>";
								}
								elseif($info['statut']=='N'){
									echo "<option value='R'>Redoublant</option>";
									echo "<option value='N' selected>Nouveau</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Nom du Père : </td>
						<td><input 
								type='text' 
								name='nom_pere' 
								value='<?php echo $info['nom_pere'];?>' /></td>
					</tr>
					<tr>
						<td>Nom de la Mère : </td>
						<td><input 
								type='text' 
								name='nom_mere' 
								value='<?php echo $info['nom_mere'];?>' /></td>
					</tr>
					<tr>
						<td>Adresse des Parents : </td>
						<td><input 
								type='text' 
								name='adresse_parent' 
								value='<?php echo $info['adresse_parent'];?>' /></td>
					</tr>
					<tr>
						<td><input 
								type='submit' 
								name='maj' 
								value='Mettre à jour' /></td>
						<td><input 
								type='submit' 
								name='maj' 
							<?php 
							if($info['etat']=='non_supprime'){
								echo "value='Supprimer'";
							} 
							elseif($info['etat']=='supprime'){
								echo "value='ReActiver'";
							} ?> /></td>
					</tr>
					<input 
						type='hidden' 
						name='idEleve' 
						value='<?php echo $info['id'];?>' />
				</table>
			</form>
			
			
	<?php 
		}