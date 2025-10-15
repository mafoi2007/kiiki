<h1 id='body3'>Liste des Enseignants</h1>
	<table border='1' width='100%' align='center'>
		<tr>
			<th>N°</th>
			<th>Nom de l'enseignant</th>
			<th>Login de l'enseignant</th>
			<th>Poste</th>
		</tr>
		<?php 
			$liste = $config->viewGestionnaireAll('actif');
			// print_r($liste);
			$i = 1;
			for($a=0;$a<count($liste);$a++) {
				echo"<tr>";
					echo"<td align='center'> ".$i." </td>";
					echo"<td> ";
					echo strtoupper($liste[$a]['nom'])." ".ucwords($liste[$a]['prenom'])." </td>";
					echo"<td> ".$liste[$a]['login']." </td>";
					echo "<td> ".utf8_decode($liste[$a]['libelle_poste'])." </td>";
				echo"</tr>";
				$i++;
			}
		?>
	</table>
