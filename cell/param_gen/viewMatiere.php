<h1 id='body3'>Visualisation de la Matière</h1>
	<?php 
		if(isset($_GET['matiere'])){
			$matiere = urldecode($_GET['matiere']); 
			$info = $config->getMatiere($matiere);
			// echo '<pre>';print_r($info);echo '</pre>';
			?>
			
			<form method='post' action='../traitement.php'>
				<table border='0' width='50%' align='center'>
					<tr>
						<td>Nom de la Matière : </td>
						<td><input 
								type='text' 
								name='nom_matiere' 
								id='nom_matiere' 
								value='<?php echo $info['nom_matiere'];?>' /></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Code de la Matière</td>
						<td><input 
								type='text' 
								name='code_matiere' 
								id='code_matiere' 
								value='<?php echo $info['code_matiere'];?>' /></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td><input 
								type='submit' 
								name='majMatiere' 
								value='Mettre à jour' /></td>
						<td><input 
								type='submit' 
								name='majMatiere' 
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
						name='idMatiere' 
						value='<?php echo $info['id'];?>' />
				</table>
			</form>
			
			
	<?php 
		}