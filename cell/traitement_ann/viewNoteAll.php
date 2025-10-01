<h1 class='bien'>Récapitulatif des notes Annuelles</h1>
		
<?php /*echo '<pre>'; print_r($_SERVER); */
	
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
		
		
		<input type='hidden' name='to_print' value='VisualiserNoteAnnuelle' />
	<input type='submit' name='print' value='Visualiser' />
	</p>
</form>