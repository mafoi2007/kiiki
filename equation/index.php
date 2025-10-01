<?php
	session_start();
	require_once('equation.inc.php');
?>
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link rel ='stylesheet' href= "style.css" />
			<title>EQUAMAF, le résoluteur d'équations</title>
		</head>
		<body>
			<?php /*
			<h1>
			<script>
				if(var nom = NULL)
					{
					var nom = prompt("Entrez votre nom avant de continuer");
					document.write("Bienvenue, ");
					document.write(nom);
					}
				else
					{
					document.write("Bienvenue, ");
					document.write(nom);
					}				
			</script>
			</h1>
			*/ ?>
			<div id ="article">
				<p>Bienvenue à <b><i>EQUAMAF</i></b>, le résoluteur d'équations.</p>
				<p>Pour commencer, vous devez choisir le type d'équations à résoudre par <b><i>EQUAMAF</i></b></p>
				<p>
				<ol>
					<li><a href="index.php?type=equadra">équations du second degré</a></li>
					<li><a href="index.php?type=equadeux">équations à deux inconnues</a></li>
					<li><a href="index.php?type=equatrois">équations à trois inconnues</a></li>
				</ol>
			</div>
			
			<?php
			
			if(isset($_GET['type']))	//On a choisit le type d'équations à résoudre
				{
				if($_GET['type']=='equadra') // On a pris les équations de second dégré
					{
					require_once('equadra.php');
					}
				if($_GET['type']=='equadeux') // On a pris les équations à deux inconnues
					{
					include('equadeux.php');
					}
				if($_GET['type']=='equatrois') // On a pris les équations à trois inconnues
					{
					include('equatrois.php');
					}
				}
			?>
			
			
		</body>
	</html>
