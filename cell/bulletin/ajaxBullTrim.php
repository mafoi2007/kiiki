<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		if($classe==0){
			$msg = "<h3 class='alert'>Choisr une classe.</h3>";
			echo $msg;
		}else{ ?>
			Trimestre : 
			<select name='trimestre'>
				<?php $listeTrim = $config->trimestresTraites($classe);
				for($i=0;$i<count($listeTrim);$i++){
					$value = $listeTrim[$i]['trim'];
					echo "<option value='".$value."'>Trimestre ".$value."</option>";
				} ?>
			</select>
			<input type='hidden' name='to_print' value='BulletinTrimestriel' />
			<input type='submit' name='print' value='Générer' />
<?php 
		}
	}
?>