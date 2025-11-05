<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
	// echo $_POST['classe'];
?>
	
	Séquence : <select name='sekence'>
		<?php 
		if(isset($_POST['classe'])){
			$cls = $_POST['classe'];
			$listeDepartement = $config->sequencesTraitees($cls);
			for($j=0;$j<count($listeDepartement);$j++){
				echo "<option value='";
				echo $listeDepartement[$j]['sequence'];
				echo "'>Séquence ".strtoupper($listeDepartement[$j]['sequence'])."</option>";
			}
		}
		?>
	</select>
	<input type='hidden' name='to_print' value='BulletinSequentiel' />
	<input type='submit' name='print' value='Générer' />