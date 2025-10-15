<h1 id='body3'>Visualisation de la classe</h1>
	<?php 
		if(isset($_GET['classe'])){
			$classe = $_GET['classe']; 
			$info = $config->getClasse($classe);
			// echo '<pre>';print_r($info);echo '</pre>';
			?>
			
			<form method='post' action='../traitement.php'>
				<table border='01' width='80%' align='center'>
					<tr>
						<th>Libellé Informations</th>
						<th>Anc. Informations</th>
						<th>Nouv. Informations</th>
					</tr>
					<tr>
						<td>Nom de la Classe</td>
						<td>
							<input 
								type='text'
								value="<?php echo $info['nom_classe'];?>"
								disabled />
						</td>
						<td>
							<input 
								type='text'
								name='nom_classe'
								id='nom_classe'
								required
								size='30'
								value="<?php echo $info['nom_classe'];?>"
							/>
						</td>
					</tr>
					<tr>
						<td>Code de la Classe</td>
						<td>
							<input 
								type='text'
								value="<?php echo $info['code_classe'];?>"
								disabled />
						</td>
						<td>
							<input 
								type='text'
								name='code_classe'
								id='code_classe'
								required
								size='20'
								maxlength='10'
								value="<?php echo $info['code_classe'];?>"
							/>
						</td>
					</tr>
					<tr>
						<td>Section</td>
						<td>
							<select disabled>
								<?php 
								if($info['section']=='fr'){
									echo "<option value='fr'>Section Francophone</option>";
								}elseif($info['section']=='en'){
									echo "<option value='en'>Section Anglophone</option>";
								}
								?>
							</select>
						</td>
						<td>
							<select name='section'>
								<option 
									value='fr'
									<?php if($info['section']=='fr'){ echo "selected";} ?>
									>Section Francophone</option>
								<option 
									value='en'
									<?php if($info['section']=='en'){ echo "selected";} ?>
									>Section Anglophone</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Niveau</td>
						<td>
							<select disabled>
								<option><?php echo $info['nom_niveau']; ?></option>
							</select>
						</td>
						<td>
							<select name='niveau'>
								<?php 
								$cls = $config->listeNiveaux();
								for($i=0;$i<count($cls);$i++){
									echo "<option value='";
									echo $cls[$i]['id']."'";
									if($cls[$i]['id']==$info['niveau_classe']){
										echo " selected";
									}
									echo ">";
									echo $cls[$i]['nom_niveau']."</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan='2' align='center'>
							<input 
								type='submit'
								name='majClasse'
								value='Mettre à jour'
							/>
						</td>
						<td align='center'>
							<input 
								type='submit'
								name='majClasse'
							<?php 
							if($info['etat_classe']=='actif'){
								echo "value='Supprimer'";
							}elseif($info['etat_classe']=='inactif'){
								echo "value='ReActiver'";
							}?>
							/>
						</td>
					</tr>
					<input 
						type='hidden' 
						name='idClasse' 
						value='<?php echo $info['id'];?>' />
				</table>
			</form>
			
			
	<?php 
		}