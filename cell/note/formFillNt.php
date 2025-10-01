
<form method='post' action='../traitement.php' id='nt'>
	<input type='hidden' name='matiere' value='<?php echo $matiere; ?>' />
	<input type='hidden' name='classe' value='<?php echo $classe; ?>' />
	<input type='hidden' name='periode' value='<?php echo $sequence; ?>' />
	
	<fieldset>
		<legend><h3>Mise à jour des Notes</h3></legend>
		Enoncé de la Compétence : 
		<textarea name='competence'>
			ECRIRE ICI
		</textarea>
		<p>Classe : <input type='text' value='<?php echo $classe;?>' disabled size='6'/>
		Matière : <input type='text' value='<?php echo $matiere;?>' disabled size='8'/>
		Période : <input 
						type='text' 
						value='Séquence <?php echo $sequence; ?>' disabled size='10'/>
		<b class='alert'>Attention!!! Le 00/20 ne coefficie pas la note.</b>
		</p>
	</fieldset>
	
	<table border='1' width='50%' align='center'>
		<tr>
			<th>N°</th>
			<th>Noms et Prénoms</th>
			<th>Sexe</th>
			<th>Anc. Note</th>
			<th>Nv. Note/20</th>
			
		</tr>
		<?php 
		$listeEleve = $config->listeEleve($classe, 'non_supprime');
		// $listeNote = $note->viewNote($classe,$sequence,$matiere);
		// echo '<pre>';print_r($listeNote);
		$v = 1;
		for($x=0;$x<count($listeEleve);$x++){
			echo "<tr>
				<td>".$v."</td>
				<td>".strtoupper($listeEleve[$x]['nom'])." ".ucwords($listeEleve[$x]['prenom'])."</td>
				<input type='hidden' name='eleve[]' value='".$listeEleve[$x]['id']."' />
				<td>".$listeEleve[$x]['sexe']."</td>";
				$listeNote = $note->viewNote($classe,$sequence,$matiere);
				for($j=0;$j<count($listeNote);$j++){
					if($listeEleve[$x]['id']==$listeNote[$j]['id_eleve']){
						echo "<td><input 
										type='text' 
										value='".$listeNote[$j]['note_simple']."'
										size='4' maxlength='5' disabled/>";
								echo "<input 
									type='hidden' 
									name='noteSimpleOld[]' 
									value='".$listeNote[$j]['note_simple']."'</td>";
					}
				}
				echo "<td><input 
								type='text'
								name='noteSimpleNew[]'
								value=''
								size='4' maxlength='5' /></td>";
			echo "</tr>";
			$v++;
		}
		
		
		/*$listeNote = $note->viewNote($classe,$sequence,$matiere);
		// print_r($listeNote);
		$v=1;
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
				<input type='submit' name='updnt' value='Enregistrer'/>
			</td>
		</tr>
	</table>
</form>