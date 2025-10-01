<h1 class='bien'>classe</h1>
<?php 
$page = $_SERVER['PHP_SELF'];
$page .= '?';
$page .= $_SERVER['QUERY_STRING'];
$page .= '&';
$page .= 'action=';
// echo $page;
// echo '<pre>';print_r($_SERVER); echo '</pre>';
?>
<ul>
	<li><h3><a href='<?php echo $page;?>addClasse#body3' target = '_blank'>Ajouter une classe</a></h3></li>
	<li><h3><a href='<?php echo $page;?>viewClasse#body3' target = '_blank'>Visualiser une classe</a></h3></li>
	<li><h3><a href='<?php echo $page;?>listClasse#body3' target = '_blank'>Liste des classes</a></h3></li>
	<li><h3><a href='<?php echo $page;?>addmatcls#body3' target = '_blank'>Attribuer une matière à la classe</a></h3></li>
	<li><h3><a href='<?php echo $page;?>addmatclss#body3' target = '_blank'>Attribuer plusieurs matières à une classe</a></h3></li>
	<li><h3><a href='<?php echo $page;?>delmatclss#body3' target = '_blank'>Retirer une matière à une classe</a></h3></li>
</ul>

<?php 
if(isset($_GET['action'])){
	// echo '<pre>';print_r($_GET); echo '</pre>';
	$action = $_GET['action'];
	if($action=='addClasse'){ 
		include_once('addClasse.php');
	}elseif($action=='viewClasse'){
		$idClasse = $_GET['classe'];
		echo $idClasse;
		if(empty($idClasse)){
			include_once('findClasse.php');
		}else{
			include_once('viewClasse.php');
		}
	}elseif($action=='listClasse'){ 
		include_once('listClasse.php');
	}elseif($action=='addmatcls'){ 
		include_once('addmatcls.php');
	}elseif($action=='addmatclss'){ 
		include_once('addmatclss.php');
	}elseif($action=='delmatclss'){ 
		include_once('delmatclss.php');
	}else{
		
	}		
}