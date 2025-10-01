<h1>Bulletin Séquentiel</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>

<form method='post' action='../traitement.php' target = _blank>
	<p>Classe : 
		<select name='classe'>
			<option value=''>-Choisir-</option>
			<?php 
			$req = mysql_query("SELECT classe, nom_classe
								FROM bull_seq, classe
								WHERE classe = code_classe
								GROUP BY classe") or die(mysql_error());
			while($res = mysql_fetch_assoc($req)){
				echo "<option value='".$res['classe']."'>
				".strtoupper($res['nom_classe'])."</option>";
			}
			?>
		</select>
		Période :
		<select name='periode'>
			<option value=''>-Choisir-</option>
			<?php 
			$req = mysql_query("SELECT seq
								FROM bull_seq
								GROUP BY seq") or die(mysql_error());
			while($res = mysql_fetch_assoc($req)){
				echo "<option value='".$res['seq']."'>
				Séquence ".strtoupper($res['seq'])."</option>";
			}
			?>
		</select>
		<input type='hidden' name='to_print' value='BulletinSequentiel' />
		<input type='submit' name='print' value='BullSeq' />
	</p>
</form>