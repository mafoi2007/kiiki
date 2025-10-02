<html>
	<head>
		<meta 
			http-equiv="Content-Type" 
			content="text/html; charset=utf-8" />
		<link 
			rel="stylesheet" 
			type="text/css" 
			href="styles/style.css" />
		<link 
			rel ="shortcut icon" 
			type="image/x-icon" 
			href="images/homme.png" />
		<link type="text/javascript" src="javascript/js.js" />
		<script>
			function typeUtilisateur(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('connector').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "forms/connect.ajax.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Region par exemple
				sel = document.getElementById('userType');
				userType = sel.options[sel.selectedIndex].value;
				xhr.send("userType="+userType);
			}
			
		</script>
		<title><?php echo appName.' '.appVersion; ?>, Connectez-vous</title>
	</head>
	<body id='image'>
		<form method='post' action='traitement.php' id='connect'>
			<h4>Connectez-vous à votre espace de gestion</h4>
			<img src='images/cle.png' alt="connection">
			<p>
				A l'établissement, je suis : 
					<select name='userType' id='userType' onChange='typeUtilisateur()'>
						<?php 
						$userType = $config->userType();
						for($i=0;$i<count($userType);$i++){
							echo "<option value='".$userType[$i]['id']."'>".$userType[$i]['libelle_poste']."</option>";
						}
						?>
						<option value='null' selected>-Type Utilisateur-</option>
					</select>
			</p>
			<div id='connector' style = 'display:inline'>
				
			</div>
		</form>