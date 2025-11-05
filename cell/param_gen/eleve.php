<h1 class='bien'>élève</h1>
<?php 
$page = $_SERVER['PHP_SELF'];
$page .= '?';
$page .= $_SERVER['QUERY_STRING'];
$page .= '&';
$page .= 'action=';
// echo $page;
// print_r($_SERVER);
?>
<ul>
	<li>
		<h3>
			<a 
				href='<?php echo $page;?>addEleve#body2' 
				target = '_blank'>Ajouter un élève
			</a>
		</h3></li>
	<li>
		<h3>
			<a 
				href='<?php echo $page;?>viewEleve#body2' 
				target = '_blank'>Visualiser un élève
			</a>
		</h3></li>
	<li>
		<h3>
			<a 
				href='<?php echo $page;?>prepaListe#body2'  
				target = '_blank'>Préparer les listes
			</a>
		</h3></li>
	<li>
		<h3>
			<a 
				href='<?php echo $page;?>changeClasse#body2'  
				target = '_blank'>Changer de Classe
			</a>
		</h3></li>
</ul>



<?php 
if(isset($_GET['action'])){
	// echo '<pre>';print_r($_GET); echo '</pre>';
	$action = $_GET['action'];
	if($action=='addEleve'){ 
		include_once('addEleve.php');
	}elseif($action=='detailEleve'){
		include_once('detailEleve.php');
	}elseif($action=='updateEleve'){
		include_once('updateEleve.php');
	}elseif($action=='deleteEleve'){
		include_once('deleteEleve.php');
	}elseif($action=='restaureEleve'){
		include_once('restaureEleve.php');
	}elseif($action=='changeClasse'){
		include_once('changeClasse.php');
	}
	
	
	
	
	elseif($action=='viewEleve'){
		$idEleve = $_GET['eleve'];
		// echo $idEleve;
		if(empty($idEleve)){
			include_once('findEleve.php');
		}else{
			include_once('viewEleve.php');
		}
	}elseif($action=='prepaListe'){ 
		include_once('prepaListe.php');
	}elseif($action=='delEleve'){ 
		$idEleve = $_GET['eleve'];
		echo $idEleve;
		if(empty($idEleve)){
			include_once('findEleve.php');
		}else{
			include_once('viewEleve.php');
		}
	}else{
		
	}
		
}
