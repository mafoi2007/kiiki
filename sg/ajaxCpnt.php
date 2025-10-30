<?php
	session_start();
	require_once('../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
?>
	
	<select name='matiere'>
		<?php 
		if(isset($_POST['clas'])){
			$cls = $_POST['clas'];
			$listeMatiere = $note->noteSaisieProfClasseMatiere($_SESSION['login'], $cls);
			for($j=0;$j<count($listeMatiere);$j++){
				echo "<option value='";
				echo $listeMatiere[$j]['matiere'];
				echo "'>".strtoupper($listeMatiere[$j]['nom_matiere'])."</option>";
			}
		}
		?>
	</select>
	
	<select name='sequence'>
		<?php 
		$listePeriode = $note->noteSaisieProfClasseSequence($_SESSION['login'], $cls);
		if(empty($listePeriode)){
			echo "<option value='null'>-Aucune Séquence Active-</option>";
		}else{
			for($k=0;$k<count($listePeriode);$k++){
				echo "<option value='";
				echo $listePeriode[$k]['sequence'];
				echo "'>Séquence ".$listePeriode[$k]['sequence']."</option>";
			}
		}
		?>
	</select>
	<input type='submit' name='info' value='Ok' />