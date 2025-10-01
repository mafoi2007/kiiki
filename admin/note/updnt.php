<h1>Modifier une note séquentielle</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>
<form method='post' action=''>
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
		<input type='submit' name='info' value='Ok' />
	</p>
</form>

<?php 
	if(isset($_POST['info'])){ ?>
		<fieldset>
			<legend><h3>Informations</h3></legend>
				<p>Classe : <input type='text' value='<?php echo $_POST['classe']; ?>' disabled />
					Matière : <input type='text' value='<?php echo $_POST['matiere']; ?>' disabled />
					Période : <input type='text' value='Séquence <?php echo $_POST['periode']; ?>' disabled />
		</fieldset>
		<form method='post' action='../traitement.php'>
		<table border='0' width='100%'>
			<tr>
				<th>N°</th>
				<th>Noms et Prénoms</th>
				<th>Note /20</th>
				<th>Nouvelle Note</th>
				
			</tr>"
		<?php 
			$listeNote = $note->viewNote($_POST['classe'],$_POST['periode'],$_POST['matiere']);
					$z = 1;
					for($i=0;$i<count($listeNote);$i++){
						echo "<tr>
							<td align='center'>".$z."</td>
							<td>".$listeNote[$i]['nom']." ".$listeNote[$i]['prenom']."</td>
							<input type='hidden' name='eleve[]' value='".$listeNote[$i]['id']."'/>
							<td align='center'>".$listeNote[$i]['note_simple']."</td>
							<td align='center'><input type='text' name='note[]' size=5' /></td>
							
						</tr>"; $z++;
					}
		?>
			<tr>
				<td colspan='5' align='center'><input type='submit' name='updnt' value='Modifier' /></td>
			</tr>
		</table>
		</form>
<?php 	}