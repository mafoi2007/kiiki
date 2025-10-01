<h1 class='bien'>matière</h1>
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
	<li><h3><a href='<?php echo $page;?>addMatiere#body3' target = '_blank'>Ajouter une matière</a></h3></li>
	<li><h3><a href='<?php echo $page;?>viewMatiere#body3' target = '_blank'>Visualiser une matière</a></h3></li>
	<li><h3><a href='<?php echo $page;?>viewMatiere#body3' target = '_blank'>Modifier une matière</a></h3></li>
	<li><h3><a href='<?php echo $page;?>updMatiereClasse#body3' target = '_blank'>Modifier une matière de la classe</a></h3></li>
</ul>

<?php 
if(isset($_GET['action'])){
	// echo '<pre>';print_r($_GET); echo '</pre>';
	$action = $_GET['action'];
	if($action=='addMatiere'){ 
		include_once('addMatiere.php');
	}elseif($action=='viewMatiere'){
		$idMatiere = $_GET['matiere'];
		if(empty($idMatiere)){
			include_once('findMatiere.php');
		}else{
			include_once('viewMatiere.php');
		}
	}elseif($action=='listMatiere'){
		include_once('listMatiere.php');
	}elseif($action=='updMatiereClasse'){
		include_once('updMatiereClasse.php');
	}else{
		
	}		
}