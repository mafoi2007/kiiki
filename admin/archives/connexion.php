<h1>Journal des Connexions</h1>

<?php $nb = $general->nbConnexion($_SESSION['login']);?>
<h3> Nombre de Vos Connexions : <?php echo $nb['nombre']; ?></h3>

<?php 
	$action = $general->supprimerJournal($_REQUEST['rq'], $_SESSION['login']);
?>






<table border='1' width='100%'>
	<tr>
		<th>Utilisateur</th>
		<th>Adresse IP</th>
		<th>Date de Connexion</th>
		<th>Heure de Connexion</th>
	</tr>
	<pre>
	<?php 
	$journal = $general->listeJournal($_SESSION['login']);	
	for($i=1;$i<=count($journal);$i++) {
		echo "<tr>";
			echo "<td>".strtoupper($journal[$i]['nom'])." ".ucwords($journal[$i]['prenom'])."</td>";
			echo "<td>".$journal[$i]['adresse_ip']." </td>";
			echo "<td>".$journal[$i]['jour']." </td>";
			echo "<td>".$journal[$i]['heure']." </td>";
		echo "</tr>";
	}
	if(empty($journal)) {
		echo "<tr>";
			echo "<th colspan='10'> Journal vide</th>";
		echo "</tr>";
	}
	?>
</table>

<h4><a href="<?php echo $_SERVER['PHP_SELF'];?>?choix=connexion&amp;rq=del">Vider le Journal des Connexions</a></h4>
