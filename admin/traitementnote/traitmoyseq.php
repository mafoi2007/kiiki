<h1>Traitement des moyennes séquentielles</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>

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
			<?php 
			$req = mysql_query("SELECT id_periode, nom_periode
								FROM note, periode
								WHERE periode.id = id_periode
								GROUP BY id_periode") or die(mysql_error());
			while($res = mysql_fetch_assoc($req)){
				echo "<option value='".$res['id_periode']."'>
				".ucwords($res['nom_periode'])."</option>";
			}
			?>
		</select>
		
		<input type='submit' name='TraiterMoyenneSequentielle' value='Traiter' />
	</p>
</form>