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
	define("database", 'cywibra');
	$serveur = 'localhost';
	$utilisateur = 'root';
	$pass = '';
	
	$database = 'cywibra';
	
	
	
	// mysql_pconnect($serveur,$utilisateur,$pass) or die(mysql_error());
	
	// mysql_select_db($database) or die(mysql_error());
	
	
	
	
	
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
	$serveur .= ":".$_SERVER['SERVER_PORT']."/cywibra/";
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