<h1 class='bien'>traitement des notes annuelles</h1>

<?php 
	$listeClasse = $note->classePreteAnnuelle();
?>

<form method='post' action='../traitement.php' target = _blank>
	<p>Classe : 
		<select name='classe'>
			<option value='null'>-Choisir-</option>
			<?php 
			if($listeClasse==NULL){
				echo "<option value='null'>Aucune classe Prête</option>";
			}
			else{
				for($i=0;$i<count($listeClasse['codeClasse']);$i++){
					echo "<option value='";
					echo $listeClasse['codeClasse'][$i];
					echo "'>";
					echo strtoupper($listeClasse['nomClasse'][$i]);
					echo "</option>";
				}
			}
			?>
		</select>
		
		<input type='submit' name='TraiterNoteAnnuelle' value='Traiter' />
	</p>
</form>