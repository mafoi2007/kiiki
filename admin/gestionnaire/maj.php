<h1>Mise à jour / Nomination Enseignant</h1>
	<?php 
		if(isset($_GET['enseignant'])){
			$enseignant = urldecode($_GET['enseignant']); 
			$info = $config->getGestionnaire($enseignant);
			// echo '<pre>';print_r($info);echo '</pre>';
			?>
			
			<form method='post' action='../traitement.php'>
				<table border='1' width='80%'>
					<tr>
						<td>Nom du Gestionnaire : </td>
						<td><input 
								type='text' 
								name='nom' 
								value='<?php echo $info['nom'];?>' /></td>
					</tr>
					<tr>
						<td>Prénom du Gestionnaire : </td>
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
						<td>Poste : </td>
						<td>
							<select name='poste'>
								<?php 
								$poste = $config->getPosteAll();
								for($i=0;$i<count($poste);$i++){
									echo "<option value='";
									echo $poste[$i]['code_utilisateur'];
									echo "'";
									if($info['poste']==$poste[$i]['code_utilisateur']){
										echo "selected";
									}
									echo ">";
									echo $poste[$i]['libelle_utilisateur'];
									echo "</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Login : </td>
						<td><input 
								type='text' 
								name='login' 
								value='<?php echo $info['login'];?>' /></td>
					</tr>
					<tr>
						<td><input 
								type='submit' 
								name='majProf' 
								value='Mettre à jour' /></td>
						<td> 
								
								
							<?php 
							if($info['poste']=='prof'){
								echo "<input type='submit' ";
									echo "name='majProf' ";
									echo "value='Nommer'";
								echo " />";
							}
							
							 ?> </td>
					</tr>
					<input 
						type='hidden' 
						name='idEnseignant' 
						value='<?php echo $info['id'];?>' />
				</table>
			</form>
			
			
	<?php 
		}