<h1>Mise à jour d'une classe</h1>
	
	
	<?php 
	$classe ->modifierClasse(); 
	$classeEnCours = urldecode($_GET['classe']);
	
	$sql = "SELECT * FROM classe WHERE code_classe = '$classeEnCours'";
	$req = mysql_query($sql) or die(mysql_errno());
	$res = mysql_fetch_array($req);
	?>
	
	<form method="POST" action="">
		<table border="0" width="85%">
			<tr>
				<td>
					<label for='nom_classe'><p>Nom de la Classe :</p></label>
				</td>
				<td>
					<input type="text" name="nom_classe" id="nom_classe" value="<?php echo $res['nom_classe']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<label for='code_classe'><p>Code de la Classe :</p></label>
				</td>
				<td>
					<input type="text" name="code_classe" id="code_classe" value="<?php echo $res['code_classe']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" name='azerty' value = "<?php echo $res['id']; ?>" />
					<p><input type="submit" name="Maj_classe" value="Modifier une classe" /></p>
				</td>
				<td>
					<input type="reset" value="Annuler" />
				</td>
			</tr>
		</table>
	</form>
