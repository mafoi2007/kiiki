<h1>traitement des moyennes annuelles</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */
	$sms = 'Vous devez absolument traiter les notes avant de traiter les moyennes.';
	$listeClasse = $note->classePreteAnnuelle();
?>

<form method='post' action='../traitement.php' target = _blank>
	<h3 class='alert'><?php echo $sms; ?></h3>
	<p>Classe : 
		<select name='classe'>
			<option value=''>-Choisir-</option>
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
		
		<input type='submit' name='TraiterMoyenneAnnuelle' value='Traiter' />
	</p>
</form>