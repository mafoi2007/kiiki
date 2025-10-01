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
		<title>Noteplus 1.0.4, Connectez-vous</title>
	</head>
	<body>
		<form method='post' action='traitement.php' id='connect'>
			<h4>Connectez-vous à votre espace de gestion</h4>
			<img src='images/cle.png' alt="connection">
			
			<p>Login :
				<input 
					type='text' 
					name='login' 
					id='login' 
					placeholder="Votre nom d'utilisateur" /></p>
			<p>Mot de Passe : 
				<input 
					type='password' 
					name='mdp' 
					id='mdp' 
					placeholder='Votre mot de passe' 
					required /></p>
			<p>
				<input 
					type='submit' 
					value='Se connecter' 
					name='connexion' />
				<input 
					type='reset' 
					value='Réinitialiser' /></p>
			<h5>Mot de passe oublié ? 
			Contacter votre cellule informatique au +237 620 26 31 44</h5>
		</form>
	</body>
</html>