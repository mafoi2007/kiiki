<h1>Supprimer une note séquentielle</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>
<form method='post' action='../traitement.php'>
	<p>Classe : 
		<select name='classe'>
			<option value=''>-choisir-</option>
			<?php 
				$req = mysql_query("SELECT id_classe, nom_classe
					FROM note, classe
					WHERE id_classe = code_classe
					GROUP BY id_classe ORDER BY id_classe DESC ")or die(mysql_error());
					while($res = mysql_fetch_assoc($req)){
						echo "<option value='".$res['id_classe']."'>".ucwords($res['nom_classe'])."</option>";
					}
			?>
		</select> &nbsp; &nbsp; 
	
	Matière : 
		<select name='matiere'>
			<option value=''>-choisir-</option>
			<?php 
				$req = mysql_query("SELECT id_matiere, nom_matiere
					FROM note, matiere
					WHERE id_matiere = code_matiere
					GROUP BY id_matiere ORDER BY id_matiere DESC ")or die(mysql_error());
					while($res = mysql_fetch_assoc($req)){
						echo "<option value='".$res['id_matiere']."'>".strtoupper($res['nom_matiere'])."</option>";
					}
			?>
		</select>
	</p>
	<p>
		Période :
		<select name='periode'>
			<option value=''>-choisir-</option>
			<?php 
				$req = mysql_query("SELECT id_periode, nom_periode
					FROM note, periode
					WHERE id_periode = periode.id
					GROUP BY id_periode ORDER BY id_periode DESC ")or die(mysql_error());
					while($res = mysql_fetch_assoc($req)){
						echo "<option value='".$res['id_periode']."'>".$res['nom_periode']."</option>";
					}
			?>
		</select> &nbsp; &nbsp; &nbsp; 
		<input type='submit' name='delnt' value='Supprimer' />
	</p>
</form>
