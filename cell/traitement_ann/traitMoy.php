<h1 class='bien'>traitement des moyennes annuelles</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */
	$bullPret = $note->bulletinAnnuelPret();
?>

<form method='post' action='../traitement.php' target = _blank>
	<p>Classe : 
		<select name='classe'>
			<option value='null'>-Choisir-</option>
			<?php 
			
			for($i=0;$i<count($bullPret);$i++){
				echo "<option value = '";
				echo $bullPret[$i]['classe'];
				echo "'>";
				echo strtoupper($bullPret[$i]['nom_classe']);
				echo "</option>";
			}
			?>
		</select>
		
		<input type='submit' name='TraiterMoyenneAnnuelle' value='Traiter' />
	</p>
</form>