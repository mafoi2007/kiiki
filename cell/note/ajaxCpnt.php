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
			$matieres = $note->verifNoteSaisieSequence($cls);
			for($j=0;$j<count($matieres);$j++){
				echo "<option value='";
				echo $matieres[$j]['matiere'];
				echo "'>".strtoupper($matieres[$j]['nom_matiere'])."</option>";
			}
		}
		?>
	</select>
	
	Séquence : <div id='sequence' style = 'display:inline'>
	<select name='sequence'>
		<?php 
			$sequences = $note->verifNoteSaisieSequenceReel($cls);
			for($k=0;$k<count($sequences);$k++){
				echo "<option value='";
				echo $sequences[$k]['sequence'];
				echo "'>Séquence ".strtoupper($sequences[$k]['sequence'])."</option>";
			}
		
		?>
	</select>
	</div>