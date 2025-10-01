<h1 id='body3'>Liste des Matières</h1>
	<table border='1' width='60%' align='center'>
		<tr>
			<th>N°</th>
			<th>Nom de la Matière</th>
			<th>Code de la Matière</th>
		</tr>
		<?php 
			$liste = $config->viewMatiere('actif');
			// print_r($liste);
			$i = 1;
			for($a=0;$a<count($liste);$a++) {
				echo"<tr>";
					echo"<td align='center'> ".$i." </td>";
					echo"<td align='center'> ";
					echo ucwords($liste[$a]['nom_matiere'])." </td>";
					echo"<td align='center'> ".$liste[$a]['code_matiere']." </td>";
				echo"</tr>";
				$i++;
			}
		?>
	</table>
