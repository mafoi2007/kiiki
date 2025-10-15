<?php
	session_start();
	require_once('../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		if($classe==0){
			$msg = "Vous devez choisir une classe";
			echo "<h3 class='alert'>".$msg."</h3>";
		}else{
			$user = $_SESSION['user']['id'];
			$listeMatiere = $config->listeMatiereProf($user,$classe); ?>
			Matière : 
				<select name='matier' id='matier' onChange='selectMatiereAdd()'>
					<option value='null' selected>-Choisir Matière-</option>
					<?php 
					for($i=0;$i<count($listeMatiere);$i++){
						$idMat = $listeMatiere[$i]['id_matiere'];
						$nomMat = $listeMatiere[$i]['nom_matiere'];
						echo "<option value='".$idMat."'>".$nomMat."</option>";
					}
					?>
				</select>
				<div id='sequence' style = 'display:inline'>
				</div>
<?php 			
		}
	}
	
	
	
	
	
	
	/*
	
?>
	
	
	
	
	
	<select name='sequence'>
		<?php 
		$listePeriode = $config->periodeCourante();
		if(empty($listePeriode)){
			echo "<option value='null'>-Aucune Séquence Active-</option>";
		}else{
			for($k=0;$k<count($listePeriode);$k++){
				echo "<option value='";
				echo $listePeriode[$k]['id'];
				echo "'>".$listePeriode[$k]['nom_periode']."</option>";
			}
		}
		?>
	</select>
	<input type='submit' name='info' value='Ok' />
	*/