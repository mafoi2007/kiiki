<div id = 'body2'>
	<h1 class='alert'>Fiche de l'élève</h1>
	<?php 
	if(isset($_GET['id'])){
		$eleve = (int) urldecode($_GET['id']);
		$detail = $config->getEleve($eleve);
		if(empty($detail)){
			echo "<h3 class='alert'>Votre requête n'a pas abouti.</h3>";
		}else{ 
			if(empty($detail['photo'])){
				$photo = '../images/student/no_name.png';
			}else{
				$photo = $detail['photo'];
			}
			?>
			<form method='post' action='../traitement.php' targer='_blank'>
				<table border='0' width='90%'>
					<tr>
						<th>Classe : </th>
						<th><font class='bien'><?php echo $detail['nom_classe']; ?></font></th>
					</tr>
					<tr>
						<th>Matricule National : </th>
						<th><font class='bien'><?php echo $detail['rne']; ?></font></th>
						<th>Photo de l'élève : </th>
						<th><img src='<?php echo $photo; ?>' /></th>
					</tr>
					<tr>
						<th>Matricule Etablissement : </th>
						<th><font class='bien'><?php echo $detail['matricule']; ?></font></th>
					</tr>
					<tr>
						<th>Nom de l'élève : </th>
						<th><font class='bien'><?php echo $detail['nom_complet']; ?></font></th>
					</tr>
					<tr>
						<th>Sexe : </th>
						<th><font class='bien'><?php echo $detail['sexe']; ?></font></th>
						<th>Statut : </th>
						<th><font class='bien'><?php echo $detail['statut']; ?></font></th>
					</tr>
					<tr>
						<th>Date de Naissance : </th>
						<th><font class='bien'><?php echo $detail['date_fr']; ?></font></th>
						<th>Lieu de Naissance : </th>
						<th><font class='bien'><?php echo $detail['lieu_naissance']; ?></font></th>
					</tr>
					<tr>
						<th>Nom du Père : </th>
						<th><font class='bien'><?php echo $detail['nom_pere']; ?></font></th>
						<th>Nom de la Mère : </th>
						<th><font class='bien'><?php echo $detail['nom_mere']; ?></font></th>
					</tr>
					<tr>
						<th>Contact des Parents : </th>
						<th><font class='bien'><?php echo $detail['adresse_parent']; ?></font></th>
					</tr>
					
				</table>
			</form>

<?php 			
		}
	
 	}else{
	echo "<h3 class='alert'>Vous devez choisir un élève pour générer sa fiche.</h3>";
}
	?>
</div>