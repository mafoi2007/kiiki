<?php 
$page = $config->pageEnCours();

?>
<footer>
	<div id='gauche'>
		<p><a href=''  target='_blank'>A Propos de Noteplus</a></p>
		<p><a href=''  target='_blank'>Contact Us</a></p>
		<p><a href='<?php echo $serveur.'help.php';?>' target='_blank'>Help / Aide </a></p>
	</div>
	
	<div id='droite'>
		<p><a href="<?php echo 'param.php'; ?>" target='_blank'>Paramètres</a></p>
		<p><a href="<?php echo $serveur.'deconnect.php'; ?>">Déconnexion</a></p>
		<p><a href="<?php echo $page; ?>">Retour au Haut de Page</a></p>
	</div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	
	
	
</footer>