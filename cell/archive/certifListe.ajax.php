<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
	// print_r($_POST);
	
	if(isset($_POST['oldYear'])){
		$annee = $_POST['oldYear'];
		if($annee=='null'){
			echo "<h3 class='alert'>Vous devez selectionner une année scolaire.</h3>";
		}else{
			$table = $annee.'_eleve';
		?>
			Entrer le nom ou une partie du nom :
				<input 
					type='text' 
					name='eleve' 
					id='eleve'
					placeholder='tapez la recherche'					
					onKeyup='findEleve()' />
				<input 
					type='hidden'
					name='annee'
					id='annee'
					value='<?php echo $table; ?>' />
				
			<div id='resultat' style = 'display:inline'>
			</div>
<?php 
		}
	}
?>