<h1>traitement des notes annuelles</h1>
<h3 class='alert' title='Aide sur la Question'> Les bulletins annuels ne peuvent être générés que pour les 
	classes qui ont produit au moins deux bulletins trimestriels.</h3>
	<a href='../help.php#traitntann'>Consulter l'aide</a>
<?php 
	$listeClasse = $note->classePreteAnnuelle();
	// echo '<pre>'; print_r($listeClasse); echo '</pre>';
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
					echo $listeClasse['nomClasse'][$i];
					echo "</option>";
				}
			}
			?>
		</select>
		
		<input type='submit' name='TraiterNoteAnnuelle' value='Traiter' />
	</p>
</form>