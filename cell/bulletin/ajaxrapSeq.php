<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
	// echo $_POST['clas'];
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
	<?php 
		$section = $config->verifSectionClasse($cls);
	?>
	<input type='hidden' name='section' value='<?php echo $section; ?>' />
	<input type='hidden' name='to_print' value='RapportSequentiel' />
	<input type='submit' name='print' value='Générer' />