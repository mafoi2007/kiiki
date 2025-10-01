<h1 class='bien'>période</h1>
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
	<li><h3><a href='<?php echo $page;?>openSeq#body3' target = '_blank'>Activer une séquence</a></h3></li>
	<li><h3><a href='<?php echo $page;?>closeSeq#body3' target = '_blank'>Verouiller une séquence</a></h3></li>
	<li><h3><a href='<?php echo $page;?>listSeq#body3' target = '_blank'>Consulter les séquences</a></h3></li>
	<li><h3><a href='<?php echo $page;?>createDate#body3' target = '_blank'>Créer les Dates pour les absences</a></h3></li>
	<li><h3><a href='<?php echo $page;?>viewDate#body3' target = '_blank'>Consulter les Dates pour les absences</a></h3></li>
	
</ul>

<?php 
if(isset($_GET['action'])){
	// echo '<pre>';print_r($_GET); echo '</pre>';
	$action = $_GET['action'];
	if($action=='openSeq'){ 
		include_once('openSeq.php');
	}elseif($action=='closeSeq'){
		include_once('closeSeq.php');
	}elseif($action=='listSeq'){
		include_once('listSeq.php');
	}elseif($action=='createDate'){
		include_once('createDate.php');
	}elseif($action=='viewDate'){
		include_once('viewDate.php');
	}elseif($action=='updDate'){
		include_once('updDate.php');
	}else{
		
	}		
}