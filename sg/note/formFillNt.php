<form method='post' action='../traitement.php'>
	<input type='hidden' name='matiere' value='<?php echo $matiere; ?>' />
	<input type='hidden' name='classe' value='<?php echo $classe; ?>' />
	<input type='hidden' name='periode' value='<?php echo $sequence; ?>' />
	
	<fieldset>
		<legend><h3 class='bien'>Mise à Jour des Notes</h3></legend>
		Enoncé de la Compétence : 
		<textarea name='competence'>
			ECRIRE ICI
		</textarea>
		<p>Classe : <input type='text' value='<?php echo $classe;?>' disabled />
		Matière : <input type='text' value='<?php echo $matiere;?>' disabled />
		Période : <input 
						type='text' 
						value='Séquence <?php echo $sequence; ?>' disabled />
		<b class='alert'>Attention!!! Le 00/20 ne coefficie pas la note.</b>
		</p>
	</fieldset>
	
	<table border='0' width='70%'>
		<tr>
			<th>N°</th>
			<th>Noms et Prénoms</th>
			<th>Sexe</th>
			<th>Note /20</th>
			
		</tr>
		<?php 
		$listeNote = $note->viewNote($classe,$sequence,$matiere);
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
		}
		?>
		<tr>
			<td colspan='5' align='center'>
				<input type='submit' name='updnt' value='Mettre à jour'/>
			</td>
		</tr>
	</table>
</form>