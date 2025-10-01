<h1>Supprimer une Matière</h1>
	
	
	<?php $matiere ->supprimerMatiere(); ?>
	
	<hr />
	<h4>Cocher les matières à supprimer </h4>
	<hr />
	<form method="POST" action="">
	
	<table border='1' width="75%" align="center">
		<tr>
			<th>N°</th>
			<th>Nom Matière</th>
			<th>Supprimer</th>
		</tr>
		<?php
			$sql = "SELECT * FROM matiere WHERE etat='actif' ORDER BY nom_matiere";
			$req = mysql_query($sql) or die(mysql_error());
			$i = 1;
			while($res=mysql_fetch_array($req))
				{ 
		?>
		<tr>
			<td><?php echo $i; $i++; ?></td>
			<td><label for="matiere<?php echo $res['id']; ?>"> <?php echo $res['nom_matiere']; ?> </label><br /></td>
			<td><input type="checkbox" name="matiere[<?php echo $res['id']; ?>]" id="matiere<?php echo $res['id']; ?>" value="<?php echo $res['nom_matiere']; ?>" /></td>
	
	</tr>
		
	
		<?php
				}
		?>
		<tr><td colspan='5'><input type="submit" name="suppr_matiere" value="Supprimer la Matière" /></td></tr>
	</table>
	
</form>
