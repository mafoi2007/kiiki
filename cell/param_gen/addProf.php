<h1 id='body3'>Ajouter un enseignant</h1>
	<form method="POST" action="../traitement.php" enctype="multipart/form-data">
		<table border="0" width="90%">
			<tr>
				<td>
					<p>Nom du gestionnaire :</p>
				</td>
				<td>
					<input 
						name="nom" 
						id="nom" 
						type="text" 
						size="40" 
						placeholder='Nom du gestionnaire' 
						maxlength="40" 
						value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];}?>" />
				</td>
			</tr>
			<tr>
				<td>
					<p>Prénom du gestionnaire :
				</td>
				<td>
					<input 
						name="prenom" 
						id="prenom" 
						type="text" 
						size="40" 
						placeholder='Prenom du gestionnaire' 
						maxlength="40" 
						value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom'];}?>" />
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
						<?php 
						$listePoste = $config->listePoste();
						for($i=0;$i<count($listePoste);$i++){
							echo "<option value='";
							echo $listePoste[$i]['id'];
							echo "'>".$listePoste[$i]['libelle_poste']."</option>";
						}
						?>
						<option value='NULL' selected>-Poste-</option>
					</select>
				</td>
			</tr>
			
			
			<tr>
				<td>
					<p title="nom utilisé pour se connecter">Login :</p>
				</td>
				<td>
					<input 
						name="login" 
						id="login" 
						type="text" 
						size="30" 
						placeholder="Votre nom d'utilisateur" 
						maxlength="40" 
						value="<?php if(isset($_POST['login'])){echo $_POST['login'];}?>" />
				</td>
			</tr>
			<tr>
				<td>
					<p>Contact du gestionnaire :
				</td>
				<td>
					<input 
						name="contact" 
						id="contact" 
						type="text" 
						size="40" 
						placeholder='Numero de téléphone' 
						maxlength="40" 
					 />
				</td>
			</tr>
			<tr>
				<td>
					<p><input 
						type="submit" 
						name="ajout_gestionnaire" 
						id="ajout_gestionnaire" 
						value="Ajouter le Gestionnaire" /></p>
				</td>
				<td>
					<input 
						type="reset" 
						name="Reprendre" 
						value="Récommencer" />
				</td>
			</tr>
		</table>
	</form>