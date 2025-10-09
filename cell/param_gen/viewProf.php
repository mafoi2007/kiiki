<h1 id='body3'>Fiche de l'enseignant</h1>
	<?php 
		if(isset($_GET['prof'])){
			$prof = urldecode($_GET['prof']); 
			$info = $config->viewGestionnaireCourant($prof);
			// $listePoste = $config->listePoste();
			// echo '<pre>';print_r($listePoste);echo '</pre>';
			// echo '<pre>';print_r($info);echo '</pre>';
			?>
			
			<form method='post' action='../traitement.php'>
				<table border='0' width='50%'>
					<tr>
						<td>Login : </td>
						<td><input 
								type='text' 
								name='login' 
								value='<?php echo $info['login'];?>' /></td>
					</tr>
					<tr>
						<td>Nom : </td>
						<td><input 
								type='text' 
								name='nom' 
								value='<?php echo $info['nom'];?>' /></td>
					</tr>
					<tr>
						<td>Prénom : </td>
						<td><input 
								type='text' 
								name='prenom' 
								value='<?php echo $info['prenom'];?>' /></td>
					</tr>
					<tr>
						<td>Sexe : </td>
						<td>
							<select name='sexe'>
								<?php 
								if($info['sexe']=='Mr'){
									echo "<option value='Mr' selected>Masculin</option>";
									echo "<option value='Mme'>Féminin</option>";
								}
								elseif($info['sexe']=='Mme'){
									echo "<option value='Mr'>Masculin</option>";
									echo "<option value='Mme' selected>Féminin</option>";
								}
								?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>Poste : </td>
						<td>
							<select name='poste'>
								<?php 
								$poste = $info['poste'];
								$listePoste = $config->listePoste();
								for($x=0;$x<count($listePoste);$x++){
									$value = "<option value='";
									$value .= $listePoste[$x]['id'];
									$value .= "' ";
									if($listePoste[$x]['id']==$poste){
										$value .= "selected";
									}
									$value .= ">";
									$value .= $listePoste[$x]['libelle_poste'];
									$value .= "</option>";
									
									echo $value;
								}
								?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td><input 
								type='submit' 
								name='majProf' 
								value='Mettre à jour' /></td>
						<td><input 
								type='submit' 
								name='majProf' 
							<?php 
							if($info['etat']=='actif'){
								echo "value='Supprimer'";
							} 
							elseif($info['etat']=='inactif'){
								echo "value='ReActiver'";
							} ?> /></td>
					</tr>
					<input 
						type='hidden' 
						name='idProf' 
						value='<?php echo $info['id'];?>' />
				</table>
			</form>
			
			
	<?php 
		}