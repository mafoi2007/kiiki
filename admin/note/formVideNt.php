<form method='post' action='../traitement.php' id='nt'>
	<input type='hidden' name='matiere' value='<?php echo $_POST['matiere']; ?>' />
	<input type='hidden' name='classe' value='<?php echo $_POST['classe']; ?>' />
	<input type='hidden' name='periode' value='<?php echo $_POST['periode']; ?>' />
	
	
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
		$listeEleve = $config->listeEleve($_POST['classe'], 'non_supprime');
		$v=1;
		for($x=0;$x<count($listeEleve);$x++){
			echo "<tr>
				<td>".$v."</td>
				<td>".strtoupper($listeEleve[$x]['nom'])." 
						".ucwords($listeEleve[$x]['prenom'])."</td>
				<input type='hidden' name='eleve[]' value='".$listeEleve[$x]['id']."' />
				<td align='center'>".$listeEleve[$x]['sexe']."</td>
				<td align='center'>
					<input type ='text' name='note[]' size='5' />
				</td>
			</tr>";
			$v++;
		}
		?>
		<tr>
			<td colspan='5' align='center'>
				<input type='submit' name='addnt' value='Enregistrer'/>
			</td>
		</tr>
	</table>
</form>