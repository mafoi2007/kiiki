<?php
	session_start();
	require_once('../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['matier'])){
		$matiere = (int) $_POST['matier'];
		if($matiere==0){
			$msg = "Vous devez choisir une matière";
			echo "<h3 class='alert'>".$msg."</h3>";
		}else{
			$listePeriode = $config->periodeCourante();
			// echo '<pre>';print_r($listePeriode);
			if(empty($listePeriode)){
				$msg = "Aucune séquence active pour le moment.";
				echo "<h3 class='alert'>".$msg."</h3>";
			}else{ ?>
				Séquence : <select name='sequence' id='sequence'>
					<?php 
					for($i=0;$i<count($listePeriode);$i++){
						$idPer = $listePeriode[$i]['id'];
						$nomPer = utf8_decode($listePeriode[$i]['nom_periode']);
						echo "<option value='".$idPer."'>".$nomPer."</option>";
					}?>
				</select>
				<input type='submit' name='info' value='Ok' />
<?php 				
			}
		}
	}
	
	
	
	
	
	
	// 
	/*$listeMatiere = $config->listeMatiereProf($_SESSION['user']['id'],$_POST['classe']);
	echo '<pre>';print_r($listeMatiere);
?>
	
	Matière : <select name='matiere' id='matiere' onChange='selectMatiereAdd()'>
		<?php 
		if(isset($_POST['classe'])){
			$classe = $_POST['classe'];
			$user = $_SESSION['user']['id'];
			$listeMatiere = $config->listeMatiereProf($user,$classe);
			for($j=0;$j<count($listeMatiere);$j++){
				echo "<option value='";
				echo $listeMatiere[$j]['id_matiere'];
				echo "'>".strtoupper($listeMatiere[$j]['nom_matiere'])."</option>";
			}
		}
		?>
	</select>
	<div id='sequence' style = 'display:inline'>
	</div>
	
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