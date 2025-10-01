<h1 class='bien'>tableau d'Honneur annuel</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */
	$bullPret = $note->bulletinAnnuelPret();
	// echo '<pre>';print_r($bullPret);
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
		
		
		
		<input type='hidden' name='to_print' value='TableauAnnuel' />
		<input type='submit' name='print' value='Générer' />
	</p>
</form>




<?php 
	/*if(isset($_POST['print'])){
		$resultat = $note->showRangEleve();
		echo '<pre>';
			// print_r($_POST);
			print_r($resultat);
		echo '</pre>';
		
	}*/