<h1>Copier des notes séquentielles</h1> En construction
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
						echo "<option value='".$res['id_classe']."'>
						".ucwords($res['nom_classe'])."</option>";
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
						echo "<option value='".$res['id_matiere']."'>
						".strtoupper($res['nom_matiere'])."</option>";
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
						echo "<option value='".$res['id_periode']."'>
						".$res['nom_periode']."</option>";
					}
			?>
		</select> &nbsp; &nbsp; &nbsp; 
		<input type='submit' name='info' value='Ok' />
	</p>
</form>

<?php 
	if(isset($_POST['info'])){
		echo "<form method='post' action='../traitement.php'>";
		echo "<fieldset>
			<legend><h3>Reconduction de Notes.</h3></legend>
			<h3>Reconduire les notes de
				<select disabled>
					<option>".$_POST['matiere']."</option>
				</select> en 
				<input type='hidden' name='matiere' value='".$_POST['matiere']."' />
				<select disabled>
					<option>".$_POST['classe']."</option>
				</select> de la séquence 
				<input type='hidden' name='classe' value='".$_POST['classe']."' />
				<select disabled>
					<option>".$_POST['periode']."</option>
				</select> pour la séquence
				<input 
					type='hidden' 
					name='sequence_depart' 
					value='".$_POST['periode']."' />
				<select name='sequence_cible'>";
					for($i=1;$i<=6;$i++){
						echo "<option value='".$i."'>".$i."</option>";
					}
					
				echo "</select>
			</h3>
			<input type='submit' name='cpnt' value='Copier' />
		</fieldset>";
		
		echo "</form>";
	}