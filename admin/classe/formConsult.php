
<h1>Liste des Classes</h1>
	<table border='1' width='60%' align='center'>
		<tr>
			<th>N°</th>
			<th>Nom Complet</th>
			<th>Code de la classe</th>
		</tr>
		<?php 
			$liste = $config->viewClasse('actif');
			$i = 1;
			for($a=0;$a<count($liste);$a++) {
				echo"<tr>";
					echo"<td align='center'> ".$i." </td>";
					echo"<td align='center'> ";
					echo ucwords($liste[$a]['nom_classe'])." </td>";
					echo"<td align='center'> ".$liste[$a]['code_classe']." </td>";
				echo"</tr>";
				$i++;
			}
		?>
	</table>
