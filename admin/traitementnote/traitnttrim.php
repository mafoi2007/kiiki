<h1>Traitement des notes trimestrielles</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>

<form method='post' action='../traitement.php' target = _blank>
	<p>Classe : 
		<select name='clas'>
			<option value='null'>-Choisir-</option>
			<?php 
			$classe = $note->viewClasseNote();
			for($i=0;$i<count($classe);$i++){
				echo "<option value='";
				echo $classe[$i]['id_classe'];
				echo "'>";
				echo $classe[$i]['nom_classe'];
				echo "</option>";
			}
			?>
		</select>
		 &nbsp; &nbsp; &nbsp;
		Trimestre :
		<select name='trimestre'>
			<option value='null'>-Choisir-</option>
			<option value='1'>Trimestre 1</option>
			<option value='2'>Trimestre 2</option>
			<option value='3'>Trimestre 3</option>
		</select>
		 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<input type='submit' name='TraiterNoteTrimestrielle' value='Traiter' />
	</p>
</form>