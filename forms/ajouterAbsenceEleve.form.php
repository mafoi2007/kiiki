<form method='post' action='../traitement.php'>
	<input 
		type='hidden'
		name='classe'
		value='<?php echo $classe; ?>' />
	<input 
		type='hidden'
		name='dateAbsence'
		value='<?php echo $dateSaisie; ?>' />
	<?php /*<input 
		type='hidden'
		name='sequence'
		value='<?php echo $_POST['sequence']; ?>' /> */ ?>
	<fieldset>
		<legend><h3 class='bien'>Saisie des Absences Journalières</h3></legend>
		<p>Classe : <input type='text' value='<?php echo $nomClasse['nom_classe']; ?>' disabled />
			Date du Jour : <input type='date' value='<?php echo $dateSaisie; ?>' readonly />
		</p>
	</fieldset>
	<table border='1' width='70%' align='center'>
		<tr>
			<th>N°</th>
			<th>Noms et Prénoms</th>
			<th>Heures d'Absence</th>
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
					name='absence[]'
					max = '8' />
			</td>
		</tr>
		
		<?php $a++; } ?>
		<tr>
			<td colspan='5' align='center'><input type='submit' name='addAbsence' value='Enregistrer' /></td>
		</tr>
	</table>
</form>


