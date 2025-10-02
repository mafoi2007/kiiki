<?php 
	session_start();
	require_once('../inc/connect.inc.php');
	$config = new config($db);
	if(isset($_POST['userType'])){
		$userType = $_POST['userType'];
		if($userType=='null'){
			echo "<h4 class='alert'>Vous devez choisir un type d'utilisateur.</h4>";
		}else{
			$typeUtilisateur = $config->getUtilisateurType($userType);
			if(empty($typeUtilisateur)){
				echo "<h4 class='alert'>Personne ne correspond à ce critère.</h4>";
			}else{ ?>
				
				<h4>Sélectionnez votre nom : 
				<select name='login' id='login'>
					<?php 
					for($i=0;$i<count($typeUtilisateur);$i++){
						echo "<option value='";
						echo $typeUtilisateur[$i]['idEnseignant'];
						echo "'>".stripslashes($typeUtilisateur[$i]['nom'])."</option>";
					}
					?>
					
				</select>
				</h4>
				<h4>Votre Mot de Passe : 
					<input 
							type='password'
							name='mdp'
							id='mdp'
							placeholder='Votre mot de passe'
							required />
				</h4>
				<h4><input 
							type='submit' 
							value='Se connecter' 
							name='connexion' />
					 |  <input 
							type='reset' 
							value='Réinitialiser' /></h4>
				
				
				
				
<?php 				
			}
		}
	}
?>
