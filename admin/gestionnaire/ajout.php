<h1>Ajout de gestionnaire</h1>
	
	
	<form method="POST" action="../traitement.php" enctype="multipart/form-data">
		<table border="0" width="90%">
			<tr>
				<td>
					<p>Nom du gestionnaire :</p>
				</td>
				<td>
					<input name="nom" id="nom" type="text" size="30" placeholder='Nom du gestionnaire' maxlength="40" value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];}?>" />
				</td>
			</tr>
			<tr>
				<td>
					<p>Prénom du gestionnaire :
				</td>
				<td>
					<input name="prenom" id="prenom" type="text" size="30" placeholder='Prenom du gestionnaire' maxlength="40" value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom'];}?>" />
				</td>
			</tr>
			<tr>
				<td>
					<p>Sexe :
				</td>
				<td>
					<select name="sexe" id="sexe">
						<option value="Mr">Masculin</option>
						<option value="Mme">Féminin</option>
						<option value='NULL' selected>-Sexe-</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<p>Poste : </p>
				</td>
				<td>
					<select name="poste" id="poste">
						<option value="admin">Admnistrateur</option>
						<option value="cell">Cellule Informatique</option>
						<option value="censeur">Censeur</option>
						<option value="sg">Surv. Général</option>
						<option value="eco">Econome / Intendant</option>
						<option value="prof">Enseignant</option>
						<option value='NULL' selected>-Poste-</option>
					</select>
				</td>
			</tr>
			
			
			<tr>
				<td>
					<p title="nom utilisé pour se connecter">Login :</p>
				</td>
				<td>
					<input name="login" id="login" type="text" size="30" placeholder="Votre nom d'utilisateur" maxlength="40" value="<?php if(isset($_POST['login'])){echo $_POST['login'];}?>" />
				</td>
			</tr>
			<tr>
				<td>
					<p>Mot de passe :
				</td>
				<td>
					<input type="password" name="mdp" id="mdp" size="30" maxlength="15" placeholder="Votre mot de passe" value="<?php if(isset($_POST['mdp'])){echo $_POST['mdp'];}?>" />
				</td>
			</tr>
			<tr>
				<td>
					<p>Rétapez mot de passe :
				</td>
				<td>
					<input type="password" name="mdp_confirm" id="mdp_confirm" size="30" maxlength="15" placeholder="Rétapez votre mot de passe" />
				</td>
			</tr>
			<tr>
				<td>
					<p><input type="submit" name="ajout_gestionnaire" id="ajout_gestionnaire" value="Ajouter le Gestionnaire" /></p>
				</td>
				<td>
					<input type="reset" name="Reprendre" value="Récommencer" />
				</td>
			</tr>
		</table>
	</form>
