<h1>Bulletin trimestriel</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>

<form method='post' action='../traitement.php' target = _blank>
	<p>Classe : 
		<select name='classe'>
			<option value='null'>-Choisir-</option>
			<?php 
			$classes = $note->classesTraitees();
			for($i=0;$i<count($classes);$i++){
				echo "<option value='".$classes[$i]['classe'];
				echo "'>".$classes[$i]['nom_classe']."</option>";
			}
			?>
		</select>
		
		
		Trimestre :
		<select name='periode'>
			<option value=''>-Choisir-</option>
			<?php 
			$trimestre = $note->trimestresTraites();
			for($j=0;$j<count($trimestre);$j++){
				echo "<option value='".$trimestre[$j]['trim'];
				echo "'>Trimestre ".$trimestre[$j]['trim']."</option>";
			}
			?>
		</select>
		<input type='hidden' name='to_print' value='BulletinTrimestriel' />
		<input type='submit' name='print' value='Générer' />
	</p>
</form>




<?php 
	