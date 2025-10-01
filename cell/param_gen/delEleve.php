<h1>Supprimer un élève à la Base de Données</h1>
	<?php $eleve ->supprimerEleve($_POST['eleve']['id']); 
	
	
	?>
	
	
	<form method='post' action=''>
		<table border='1' width='70%' align='center'>
			<tr>
				<th>Cocher</th>
				<th>Nom et Prénom</th>
				<th>Classe</th>
			</tr>
		<?php	
			$a = 1;
			$sql = "
				SELECT eleve.id,matricule, nom, prenom, sexe, classe, eleve.etat,classe,statut 
				FROM eleve 
				WHERE eleve.etat='non_supprime' ORDER BY classe";
			$req = mysql_query($sql) or die(mysql_error());
		while($res=mysql_fetch_array($req)) {
			echo "<tr>";
				echo "<td>";
					echo "<input type = 'checkbox'  name='eleve[".$res['id']."]' value='".$res['matricule']."' />";
				echo "</td>";
				echo "<td>";
					echo ucwords($res['nom'])." ".ucwords($res['prenom']);
				echo "</td>";
				echo "<td>";
					echo $res['classe']; 
				echo "</td>";
			echo "</tr>";
			$a++;
		}
		
		?>
			
				
			
			
			<tr>
				<td colspan='3'><input type='submit' name='supprEleve' value='Supprimer Elève' /></td>
			</tr>
		</table>
	</form>