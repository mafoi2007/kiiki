<?php 
	$verification = $config->verifNoteSaisie($classe, $matiere, $sequence);
	if($verification==false){ ?>

<form method='post' action='../traitement.php' target='_blank'>
	<input 
		type='hidden'
		name='classe'
		value='<?php echo $_POST['classe']; ?>' />
	<input 
		type='hidden'
		name='matiere'
		value='<?php echo $_POST['matier']; ?>' />
	<input 
		type='hidden'
		name='sequence'
		value='<?php echo $_POST['sequence']; ?>' />
	<fieldset>
		<legend><h3 class='bien'>Saisie des Notes Séquentielles</h3></legend>
		<p>Classe : <input type='text' value='<?php echo $nomClasse['nom_classe']; ?>' disabled />
			Matière : <input type='text' value='<?php echo $nomMatiere['nom_matiere']; ?>' disabled />
			Séquence : <input type='text' value='<?php echo utf8_decode($nomSequence['nom_periode']); ?>' disabled />
		</p>
	</fieldset>
	<table border='1' width='75%' align='center'>
		<tr>
			<th colspan='5'>
				<textarea name='competence' required>Write Competence</textarea>
			</th>
		</tr>
		<?php 
		$a = 1;
		for($i=0;$i<count($listeEleve);$i++){ ?>
			<tr>
				<td><?php echo $a; ?></td>
				<td>
					<?php echo $listeEleve[$i]['nom_complet']; ?>
					<input 
						type='hidden'
						name='eleve[]'
						value='<?php echo $listeEleve[$i]['id']; ?>' />
				</td>
				<td>
					<input 
						type='number'
						name='note[]' 
						step='0.01' 
						max='20' 
						min='0'/>
				</td>
			</tr>
<?php 
			$a++;
		}
		?>
		<tr>
			<td colspan='5' align='center'><input type='submit' name='saveNote' value='Enregistrer' /></td>
		</tr>
	</table>
</form>
	
<?php 	
	}else{
		echo "<h3 class='alert'>Les Notes de cette matière ont été saisies le ";
		echo $verification['date_fr']." à ".$verification['heure_fr'];
		echo ". Reportez-vous au menu <i><u>Modifier des Notes</u></i> ";
		echo "pour des éventuels changements de notes.</h3>";
	}
?>


