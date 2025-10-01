<h1>Visualisation des notes séquentielles</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>

<form method='post' action='../traitement.php' target = _blank>
	<p>Classe : 
		<select name='classe'>
			<option value=''>-Choisir-</option>
			<?php 
			$listeClasse = $note->viewClasseNote();
			for($i=0;$i<count($listeClasse);$i++){
				echo "<option value='";
				echo $listeClasse[$i]['id_classe'];
				echo "'>";
				echo $listeClasse[$i]['nom_classe'];
				echo "</option>";
			}
			?>
		</select>
		Période :
		<select name='periode'>
			<option value=''>-Choisir-</option>
			<?php 
			$listeSequence = $note->viewSequenceNote();
			for($i=0;$i<count($listeSequence);$i++){
				echo "<option value='";
				echo $listeSequence[$i]['id_periode'];
				echo "'>";
				echo $listeSequence[$i]['nom_periode'];
				echo "</option>";
			}
			?>
		</select>
		<input type='hidden' name='to_print' value='VisualiserNoteSequentielle' />
		<input type='submit' name='print' value='Visualiser' />
	</p>
</form>