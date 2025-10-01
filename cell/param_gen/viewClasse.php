<h1 id='body3'>Visualisation de la classe</h1>
	<?php 
		if(isset($_GET['classe'])){
			$classe = urldecode($_GET['classe']); 
			$info = $config->getClasse($classe);
			// echo '<pre>';print_r($info);echo '</pre>';
			?>
			
			<form method='post' action='../traitement.php'>
				<table border='0' width='50%'>
					<tr>
						<td>Nom de la Classe : </td>
						<td><input 
								type='text' 
								name='nom_classe' 
								id='nom_classe' 
								value='<?php echo $info['nom_classe'];?>' /></td>
					</tr>
					<tr>
						<td>Code de la Classe</td>
						<td><input 
								type='text' 
								name='code_classe' 
								id='code_classe' 
								value='<?php echo $info['code_classe'];?>' /></td>
					</tr>
					
					<tr>
						<td>Niveau : </td>
						<td>
							<select name='niveau'>
								<?php 
								$cls = $config->listeNiveaux();
								for($i=0;$i<count($cls);$i++){
									echo "<option value='";
									echo $cls[$i]['nom_niveau'];
									echo "'";
									if($info['niveau']==$cls[$i]['nom_niveau']){
										echo "selected";
									}
									echo ">";
									echo $cls[$i]['nom_niveau'];
									echo "</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td><input 
								type='submit' 
								name='majClasse' 
								value='Mettre à jour' /></td>
						<td><input 
								type='submit' 
								name='majClasse' 
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
						name='idClasse' 
						value='<?php echo $info['id'];?>' />
				</table>
			</form>
			
			
	<?php 
		}