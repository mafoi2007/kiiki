<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
?>
	
	<select name='trimestre'>
		<?php 
		if(isset($_POST['classe'])){
			$cls = $_POST['classe'];
			$listeDepartement = $note->trimestresTraites($cls);
			for($j=0;$j<count($listeDepartement);$j++){
				echo "<option value='";
				echo $listeDepartement[$j]['trim'];
				echo "'>Trimestre ".strtoupper($listeDepartement[$j]['trim'])."</option>";
			}
		}
		?>
	</select>
	<input type='submit' name='TraiterMoyenneTrimestrielle' value='Traiter' />