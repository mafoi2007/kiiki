<?php
	session_start();
	require_once('../inc/connect.inc.php');
	$note = new Note($db);
?>
	
	<select name='departement'>
		<?php 
		if(isset($_POST['region'])){
			$reg = $_POST['region'];
			$listeDepartement = $note->listeDepartement($reg);
			for($j=0;$j<count($listeDepartement);$j++){
				echo "<option value='";
				echo $listeDepartement[$j]['id'];
				echo "'>".$listeDepartement[$j]['libelle_departement']."</option>";
			}
		}
		?>
	</select>