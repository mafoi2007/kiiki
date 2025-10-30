<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
?>
	
	<select name='eleve'>
		<?php 
		if(isset($_POST['clas'])){
			$cls = $_POST['clas'];
			$listeDepartement = $config->listeEleve($cls,'non_supprime');
			for($j=0;$j<count($listeDepartement);$j++){
				$nom = strtoupper($listeDepartement[$j]['nom']).' ';
				$nom .= ucwords($listeDepartement[$j]['prenom']);
				echo "<option value='";
				echo $listeDepartement[$j]['id'];
				echo "'>".$nom."</option>";
			}
		}
		?>
	</select>
	
	<input type='submit' name='viewAbsenceEleve' value='Ok' />