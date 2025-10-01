<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);



?>
	
	
	
	<select name='sekence'>
		<?php 
		if(isset($_POST['clas'])){
			$cls = $_POST['clas'];
			$listeDepartement = $note->sequencesTraitees($cls);
			for($j=0;$j<count($listeDepartement);$j++){
				echo "<option value='";
				echo $listeDepartement[$j]['sequence'];
				echo "'>Séquence ".strtoupper($listeDepartement[$j]['sequence'])."</option>";
			}
		}
		?>
	</select>
	<input type='submit' name='TraiterMoyenneSequentielle' value='Traiter' />