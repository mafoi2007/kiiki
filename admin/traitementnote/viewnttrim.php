<h1>Visualisation des notes trimestrielles</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>
<script language='javascript'>
	var message = 'Vous devez avoir visualisé les deux séquences du trimestre';
	message += ' pour lequel vous voulez visulaiser les notes trimestrielles';
	alert(message);
</script>
<form method='post' action='../traitement.php' target = _blank>
	<p>Classe : 
		<select name='classe'>
			<option value=''>-Choisir-</option>
			<?php 
			$req = mysql_query("SELECT id_classe, nom_classe
								FROM note, classe
								WHERE id_classe = code_classe
								GROUP BY id_classe") or die(mysql_error());
			while($res = mysql_fetch_assoc($req)){
				echo "<option value='".$res['id_classe']."'>
				".strtoupper($res['nom_classe'])."</option>";
			}
			?>
		</select>
		Période :
		<select name='periode'>
			<option value=''>-Choisir-</option>
			<option value='1'>Trimestre 1 </option>
			<option value='2'>Trimestre 2 </option>
			<option value='3'>Trimestre 3 </option>
		</select>
		<input type='hidden' name='to_print' value='VisualiserNoteTrimestre' />
		<input type='submit' name='print' value='Visualiser' />
	</p>
</form>