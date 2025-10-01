<h1>Visualisation des notes annuelles</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>

<form method='post' action='../traitement.php' target = _blank>
	<p>Classe : 
		<select name='classe'>
			<option value=''>-Choisir-</option>
			
		</select>
		
		<input type='hidden' name='to_print' value='VisualiserNoteAnnuelle' />
		<input type='submit' name='print' value='Visualiser' />
	</p>
</form>