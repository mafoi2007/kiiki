
<h1>Supprimer une classe</h1>


<?php $classe -> supprimerClasse(); ?>



<form method="POST" action="">
	<p>Pour commencer, cochez la (les) classes à supprimer.</p>
	<table border='1' width='50%'>
	<tr>
		<th>Cocher</th>
		<th>Nom de la Classe</th>
		<th>Code</th>
	</tr>
	<?php
	$sql = "SELECT * FROM classe WHERE etat='actif' ORDER BY code_classe";
	$req = mysql_query($sql) or die(mysql_error());
	while($res = mysql_fetch_array($req))
		{
	?>
	<tr>
	<td><input type="checkbox" name="classe[<?php echo $res['id']; ?>]" id="classe<?php echo $res['id']; ?>" value="<?php echo $res['code_classe']; ?>" /></td>
	<td><label for="classe<?php echo $res['id']; ?>"> <?php echo $res['nom_classe']; ?> </label><br /></td>
	<td><label for="classe<?php echo $res['id']; ?>"> <?php echo $res['code_classe']; ?> </label><br /></td>
	</tr>
	<?php
		}
	?>
	<tr><td colspan='2'><input type="submit" name="suppr_classe" value="Supprimer la Classe" /></td></tr>
	</table>
</form>
