<?php /* Smarty version 3.1.24, created on 2016-06-26 01:53:59
         compiled from "C:/wamp/www/noteplus/admin/index.php" */ ?>
<?php
/*%%SmartyHeaderCode:26392576f35b70eaf61_60259145%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96a96dfea18d113f6446126669d93be3d1e8b35f' => 
    array (
      0 => 'C:/wamp/www/noteplus/admin/index.php',
      1 => 1466906035,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26392576f35b70eaf61_60259145',
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_576f35b73faf80_35698140',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576f35b73faf80_35698140')) {
function content_576f35b73faf80_35698140 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '26392576f35b70eaf61_60259145';
echo '<?php
	';?>session_start();
	require_once('../inc/connect.inc.php');
	// require_once('../inc/fonction.inc.php');
	
	$smarty->assign('poste', $_SESSION['poste']);
	$smarty->assign('login', $_SESSION['login']);
	$smarty->display('index.php');
	
	
	$gestionnaire = new gestionnaire();
	if($_SESSION['poste']=='admin')
		{
		
	
<?php echo '?>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="../images/banniere.png" />
	<link type="text/javascript" src="../javascript/js.js" />
	<title>Bienvenue <?php echo '<?php ';?>echo $_SESSION['login']; <?php echo '?>';?></title>
</head>

<body>
	<?php echo '<?php
		';?>require_once('../part/entete.php');
		
		require_once('../part/menu.php');
	<?php echo '?>';?>
	
	<div id="body">
		<h1>Bienvenue sur <i>Mafoi 1.0, Gestionnaire des notes scolaires.</i></h1>
		
		<h2>Gérer les classes</h2>
		<h2>Gérer les élèves</h2>
		<h2>Gérer les matières</h2>
		<h2>Gérer les gestionnaires</h2>
		<h2>Gérer les périodes séquentielles</h2>
		
	</div>
	
	
	
	<?php echo '<?php
		';?>require_once('../part/footer.php');
		 
		
	<?php echo '?>';?>
</body>
</html>



<?php echo '<?php
		';?>}
	else	// Si on est connecté mais qu'on n'est pas administrateur de l'application, la page ne doit pas s'afficher.
	/* Ceci a été conçu dans le but d'empêcher que quelqu'un réussisse à se connecter à la BD
	et pense qu'il a accès à tous les espaces. Un admin ne peut être qu'admin et un enseignant ne peut être qu'un enseignant
	*/
		{
		echo $erreur_admin;
		}
<?php }
}
?>