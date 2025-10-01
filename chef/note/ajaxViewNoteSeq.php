<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
?>
	
	<select name='sequence'>
		<?php 
		if(isset($_POST['clas'])){
			$cls = $_POST['clas'];
			$listeDepartement = $note->verifNoteSaisieSequenceReel($cls);
			for($j=0;$j<count($listeDepartement);$j++){
				echo "<option value='";
				echo $listeDepartement[$j]['sequence'];
				echo "'>Séquence ".$listeDepartement[$j]['sequence']."</option>";
			}
		}
		?>
	</select>