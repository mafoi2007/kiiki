<?php 
$nombre = $config->nbGestionnaireAll('actif');

?>
<h1>Liste des Gestionnaires</h1>
	<h3>Nombre de gestionnaires : <?php echo $nombre; ?></h3>
		<table border='1' width='80%'>
			<tr>
				<th>N°</th>
				<th>Nom</th>
				<th>Poste</th>
				<th>Option</th>
				
			</tr>
<?php
		$liste = $config->viewGestionnaireAll('actif');
		$a = 1;
		// echo '<pre>';print_r($liste); echo '</pre>';
		for($x=0;$x<count($liste);$x++) {
			echo "<tr>";
				echo "<td align='center'> ".$a." </td>";
				echo "<td> ".$liste[$x]['sexe']." ".strtoupper($liste[$x]['nom'])." ".ucwords($liste[$x]['prenom'])." </td>";
				echo "<td> ";
				if($liste[$x]['poste']=='admin') {
					echo "Administrateur";
				}
				elseif($liste[$x]['poste']=='sg') {
					echo "Surveillant Général";
				}
				elseif($liste[$x]['poste']=='censeur') {
					echo ucwords($liste[$x]['poste']);
				}
				elseif($liste[$x]['poste']=='prof') {
					echo ucwords('enseignant');
				}
				elseif($liste[$x]['poste']=='proviseur') {
					echo ucwords('Proviseur	');
				}
				echo " </td>";
				echo "<td align='center'>";
				if($liste[$x]['poste']=='prof'){
					echo "<a href='config.php?cat=gestionnaire&choix=";
					echo sha1('maj');
					echo "&enseignant=";
					echo $liste[$x]['id'];
					echo "#body2'>Nommer</a>";
				}
				else{
					echo "<a href='config.php?cat=gestionnaire&choix=";
					echo sha1('maj');
					echo "&enseignant=";
					echo $liste[$x]['id'];
					echo "#body2'>Modifier Informations</a>";
				}
				echo "</td>";
				
			echo "</tr>";
			$a++;
		}
?>
		</table>