<form method='post' action='../traitement.php' target='_blank'>
	<input type='hidden' name='matiere' value='<?php echo $matiere; ?>' />
	<input type='hidden' name='classe' value='<?php echo $classe; ?>' />
	<input type='hidden' name='periode' value='<?php echo $sequence; ?>' />
	
	<fieldset>
		<legend><h3 class='bien'>Mise à Jour des Notes</h3></legend>
		 
		
		
		
		<p>Classe : <input type='text' value='<?php echo $classe;?>' disabled />
		Matière : <input type='text' value='<?php echo $matiere;?>' disabled />
		Période : <input 
						type='text' 
						value='Séquence <?php echo $sequence; ?>' disabled />
		<b class='alert'>Attention!!! Le 00/20 ne coefficie pas la note.</b>
		</p>
	</fieldset>
	
	<table border='01' width='60%' align='center'>
		<caption>
			Enoncé de la Compétence :
			<textarea name='competence'><?php if(isset($listeNote)){echo $listeNote[0]['competence'];} ?></textarea>
		</caption>
		<tr>
			<th>N°</th>
			<th>Noms et Prénoms</th>
			
			<th>Anc. Note</th>
			<th>Nv. Note</th>
			
		</tr>
		<?php 
		$listeEleve = $config->listeEleve($classe, 'non_supprime');
		$listeNote = $note->viewNote($classe,$sequence,$matiere);
		// echo '<pre>';print_r($listeNote); echo '</pre>';
		$v=1;
		for($x=0;$x<count($listeEleve);$x++){
			echo "<tr>";
				echo "<td>".$v."</td>";
				$nomEleve = strtoupper($listeEleve[$x]['nom']);
				$nomEleve .= ' '.ucwords($listeEleve[$x]['prenom']);
				$sexeEleve = $listeEleve[$x]['sexe'];
				$idEleve = $listeEleve[$x]['id'];
				echo "<td>".$nomEleve."
								<input 
								type='hidden' 
								name='eleve[]'
								value='".$idEleve."' /></td>";
				echo "<td>";
				for($w=0;$w<count($listeNote);$w++){
					if($idEleve==$listeNote[$w]['id_eleve']){
						$noteOld = $listeNote[$x]['note_simple'];
						if($noteOld=='0.00'){$noteOld='';}
						echo "<input 
							type='text' 
							value='".$noteOld."' 
							size='4' disabled/>";
						echo "<input 
							type='hidden' 
							name='oldNote[]' 
							value='".$noteOld."' 
							size='4' />";
					}
				}
				echo "</td>";
				echo "<td><input 
								type='text' 
								name='newNote[]' 
								value='' 
								size='4' 
								maxlength='5' /></td>";
			echo "</tr>";
			$v++;
		}
		// $listeNote = $note->viewNote($classe,$sequence,$matiere);
		// print_r($listeNote);
		/*
		for($x=0;$x<count($listeNote);$x++){
			echo "<tr>
				<td>".$v."</td>
				<td>".strtoupper($listeNote[$x]['nom'])." 
						".ucwords($listeNote[$x]['prenom'])."</td>
				<input type='hidden' name='eleve[]' value='".$listeNote[$x]['id']."' />
				<td align='center'>".$listeNote[$x]['sexe']."</td>
				<td align='center'>
					<input 
						type ='text' 
						name='note[]' 
						value='".$listeNote[$x]['note_simple']."'
						size='5' />
				</td>
				
			</tr>";
			$v++;
		}*/
		?>
		<tr>
			<td colspan='5' align='center'>
				<input type='submit' name='updnt' value='Mettre à jour'/>
			</td>
		</tr>
	</table>
</form>