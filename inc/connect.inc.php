<?php
	/******************
	
	
	
	
	
	function Connexion($base){
		$idConnect = new mysqli(SERVEUR,UTILISATEUR,PASS, DATABASE);
		if(!$idConnect){
			<script>
			alert('Connexion Impossible à la Base de Données');
			</script>
		}
	}*******************/
	define("serveur", 'localhost');
	define("utilisateur", 'root');
	define("pass", '');
	define("database", 'kiiki');
	define("appName", "Noteplus"); 
	define("appVersion", "2.1.0");
	define("appSlogan", "Votre partenaire educatif");
	define("appContact", 675400828);
	
	
	
	
	
	function chargerClasse($classe) {
		require($classe.".class.php"); 
		/* J'inclue la classe correspondant au paramètre passé.
	 En fait cette fonction a pour but le chargement automatique de 
	 toutes les classes que je déclare. */
	}
	
	spl_autoload_register('chargerClasse');
	
	
	$db = new PDO('mysql:host='.serveur.';dbname='.database.'', 
				utilisateur, pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); 
	
	
	$serveur = "http://".$_SERVER['SERVER_NAME'];
	$serveur .= ":".$_SERVER['SERVER_PORT']."/kiiki/";
 ?>
 
		<script>
			function getXhr(){
				var xhr = null;
				if(window.XMLHttpRequest){
					xhr = new XMLHttpRequest();
				}else{
					alert('Votre Navigateur ne supportera pas le JavaScript utilisé.');
					xhr = false;
				}
				return xhr 
			}
		</script>