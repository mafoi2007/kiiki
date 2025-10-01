<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
?>
	
	<select name='trimestre'>
		<?php 
		if(isset($_POST['clas'])){
			$cls = $_POST['clas'];
			$listeDepartement = $note->trimestresTraites($cls);
			for($j=0;$j<count($listeDepartement);$j++){
				echo "<option value='";
				echo $listeDepartement[$j]['trim'];
				echo "'>Trimestre ".strtoupper($listeDepartement[$j]['trim'])."</option>";
			}
		}
		?>
	</select>
	<?php 
		$section = $config->verifSectionClasse($cls);
	?>
	<input type='hidden' name='section' value='<?php echo $section; ?>' />
	<input type='hidden' name='to_print' value='RapportTrimestriel' />
	<input type='submit' name='print' value='Générer' />