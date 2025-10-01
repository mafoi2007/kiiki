<?php
	require_once('inc/connect.inc.php');
	session_start();
	
	session_destroy();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="images/homme.png" />
	<link type="text/javascript" src="javascript/js.js" />
	<title>Page de Déconnexion</title>
</head>

<body>
	
		<h2>Vous avez été correctement déconnectés de l'application. Merci et à bientôt;<br />
		Si vous êtes arrivés ici par erreur, <a href="index.php">cliquez</a> pour vous reconnecter.</h2>
	
</body>
</html>
