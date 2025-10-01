<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
?>
	
	<select name='matiere'>
		<?php 
		if(isset($_POST['clas'])){
			$cls = $_POST['clas'];
			$listeDepartement = $config->listeMatiereClasse($cls);
			for($j=0;$j<count($listeDepartement);$j++){
				echo "<option value='";
				echo $listeDepartement[$j]['id_matiere'];
				echo "'>".strtoupper($listeDepartement[$j]['nom_matiere'])."</option>";
			}
		}
		?>
	</select>
	<select name='sequence'>
		<?php 
		$periodes = $config->viewPeriode();
		for($k=0;$k<count($periodes);$k++){
			echo "<option value='";
			echo $periodes[$k]['id'];
			echo "'>".$periodes[$k]['nom_periode']."</option>";
		}
		?>
	</select>