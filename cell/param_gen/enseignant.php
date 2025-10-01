<h1 class='bien'>enseignant</h1>
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
	<li><h3><a href='<?php echo $page;?>addProf#body3' target = '_blank'>Ajouter un enseignant</a></h3></li>
	<li><h3><a href='<?php echo $page;?>viewProf#body3' target = '_blank'>Visualiser un enseignant</a></h3></li>
	<li><h3><a href='<?php echo $page;?>listProf#body3' target = '_blank'>Liste des Enseignants</a></h3></li>
	<li><h3><a href='<?php echo $page;?>addProfCls#body3' target = '_blank'>Attribuer une matière à un enseignant</a></h3></li>
	<li><h3><a href='<?php echo $page;?>addPP#body3' target = '_blank'>Désigner un professeur principal</a></h3></li>
	
	
</ul>

<?php 
if(isset($_GET['action'])){
	// echo '<pre>';print_r($_GET); echo '</pre>';
	$action = $_GET['action'];
	if($action=='addProf'){ 
		include_once('addProf.php');
	}elseif($action=='viewProf'){
		$idProf = $_GET['prof'];
		if(empty($idProf)){
			include_once('findProf.php');
		}else{
			include_once('viewProf.php');
		}
	}elseif($action=='addProfCls'){
		include_once('addProfCls.php');
	}elseif($action=='listProf'){
		include_once('listProf.php');
	}elseif($action=='addPP'){
		include_once('addPP.php');
	}else{
		
	}	
}