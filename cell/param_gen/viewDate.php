<h1 id='body3'>Consulter les dates pour les absences</h1>

		<table border='1' width='85%'>
			<tr>
				<th>Nom de la Période</th>
				<th>Date d'ouverture</th>
				<th>Date de Cloture</th>
				<th>Option</th>
			</tr>
	<?php 
			// echo '<pre>'; print_r($_SERVER);
			$periodeSequentielle = $config->viewDateAbsence();
			// echo '<pre>';print_r($periodeSequentielle);
			$pg = $_SERVER['PHP_SELF'];
			$pg .= '?choix='.$_GET['choix'];
			$pg .= '&action=updDate&';
			for($a=0;$a<count($periodeSequentielle);$a++) {
				echo "<tr>\n";
					echo "<td>".utf8_decode($periodeSequentielle[$a]['nom_periode'])."</td>\n";
					echo "<td>".$periodeSequentielle[$a]['ouverture']."</td>\n";
					echo "<td>".$periodeSequentielle[$a]['fermeture']."</td>\n";
					echo "<td><a href='".$pg."periode=".$periodeSequentielle[$a]['id']."#body3' target='_blank'>Modifier</a></td>\n";
				echo "</tr>\n";
			}
	?>
		</table>
	