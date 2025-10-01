<h1>Traitement des moyennes trimestrielles</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */ 
	$sms = 'Vous devez absolument traiter les notes avant de traiter les moyennes.';

?>
<form method='post' action='../traitement.php' target = _blank>
	<h3 class='alert'><?php echo $sms; ?></h3>
	<p>Classe : 
		<select name='clas'>
			<option value='null'>-Choisir-</option>
			<?php 
			$classes = $note->classesTraitees();
			for($i=0;$i<count($classes);$i++){
				echo "<option value='".$classes[$i]['classe'];
				echo "'>".$classes[$i]['nom_classe']."</option>";
			}
			?>
		</select>
		 &nbsp; &nbsp; &nbsp;
		Trimestre :
		<select name='trimestre'>
			<option value='null'>-Choisir-</option>
			<?php 
			$trimestre = $note->trimestresTraites();
			for($j=0;$j<count($trimestre);$j++){
				echo "<option value='".$trimestre[$j]['trim'];
				echo "'>Trimestre ".$trimestre[$j]['trim']."</option>";
			}
			?>
		</select>
		 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<input type='submit' name='TraiterMoyenneTrimestrielle' value='Traiter' />
	</p>
</form>