<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
?>
	
	Trimestre : <select name='trimestre'>
		<?php 
		if(isset($_POST['matiere'])){
			$trimestre = $config->getTrimestre($_POST['matiere']);
			if(empty($trimestre)){
				echo "<option value='null'>-Aucun Trimestre Correspondant.-</option>";
			}else{
				for($i=0;$i<count($trimestre);$i++){
					echo "<option value='".$trimestre[$i]."'>";
					echo "Trimestre ".$trimestre[$i]."</option>";
				}
			}	
		}
		?>
	</select>
	
	
	<input type='hidden' name='to_print' value='RecapMatiere' />
	<input type='submit' name='print' value='Générer' />