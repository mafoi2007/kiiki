
<form method='post' action='../traitement.php' id='nt'>
	<input type='hidden' name='matiere' value='<?php echo $_POST['matiere']; ?>' />
	<input type='hidden' name='matiere' value='<?php echo $_POST['classe']; ?>' />
	<input type='hidden' name='matiere' value='<?php echo $_POST['periode']; ?>' />
	<input type='hidden' name='matiere' value='<?php echo $_POST['coef']; ?>' />
	
	<fieldset>
		<legend><h3>Informations</h3></legend>
		<p>Classe : <input type='text' value='<?php echo $_POST['classe'];?>' disabled />
		Matière : <input type='text' value='<?php echo $_POST['matiere'];?>' disabled />
		Période : <input 
						type='text' 
						value='Séquence <?php echo $_POST['periode']; ?>' disabled />
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
		$listeNote = $note->viewNote($_POST['classe'],
										$_POST['periode'],
										$_POST['matiere']);
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
				<input type='submit' name='updnt' value='Enregistrer'/>
			</td>
		</tr>
	</table>
</form>