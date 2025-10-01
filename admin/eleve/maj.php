<h1>Mise à jour d'élèves à la Base de Données</h1>
	<?php modifier_eleve(); ?>
	
	<?php 
	if(isset($_GET['choix']) and $_GET['choix']==sha1('maj'))
		{
		
		
	if(isset($_GET['choix']) and isset($_GET['id']))
		{
		$id = $_GET['id'];
		$sql = "SELECT * FROM eleve WHERE id='$id'";
		$req = mysql_query($sql) or die(mysql_error());
		while($res = mysql_fetch_array($req))
			{
?>
			<form method="POST" action="">
				<p>Nom : <input type="text" name="nom"  value ="<?php echo $res['nom']; ?>" /></p>
				<p>Prenom : <input type="text" name="prenom"  value ="<?php echo $res['prenom']; ?>" /></p>
				<p>Sexe : <input type="text" name="sexe"  value ="<?php echo $res['sexe']; ?>" /></p>
				<p>Lieu de naissance : <input type="text" name="lieu_naissance"  value ="<?php echo $res['lieu_naissance']; ?>" /></p>
				<p>Matricule : <input type="text" name="matricule"  value ="<?php echo $res['matricule']; ?>" /></p>
				<input type="submit" name="maj_eleve" value="Mettre à jour l'élève" />
			</form>
<?php
			}
			
		
		echo "<h2 class='alert'>Espace en construction.</h2>";
		echo "<p class='alert'>Je n'ai pas encore traité le formulaire qui s'affiche ci-dessus.</p>";
		}
		
		}
