<h1 class='bien' title='Changer mot de passe enseignant'>mot de passe enseignant</h1>

	<form method='post' action=''>
		<p>Choisir l'enseignant : 
			<select name='prof'>
				<?php 
					$listeEnseignant = $config->viewGestionnaireAll('actif');
					for($i=0;$i<count($listeEnseignant);$i++){
						$id = $listeEnseignant[$i]['login'];
						$nom = strtoupper($listeEnseignant[$i]['nom']);
						$nom .= ' '.ucwords($listeEnseignant[$i]['prenom']);
						echo "<option 
							value='".$id."'>";
						echo $nom."</option>\n";
					}
				?>
				<option value='null' selected>-choisir un nom-</option>
			</select>
			<input type='submit' name='choixEnseignant' value='Valider' />
		</p>
	</form>

<?php 
	if(isset($_POST['choixEnseignant'])){
		/*echo '<pre>';print_r($_POST);echo '</pre>';*/ ?>
	
<form method='post' action='../traitement.php'>
	<h3 class='bien'></h3>
	<table border='0' width='60%'>
		<tr>
			<th colspan='2' class='alert'>Réinitialiser le Mot de Passe de 
				<i><?php echo $_POST['prof']; ?></i></th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Entrez un nouveau mot de passe :</td>
			<td>
				<input
					type = 'password'
					name = 'nouveau_mdp'
					id = 'nouveau_mdp' />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><b class='alert'>Confirmez le nouveau</b> mot de passe :</td>
			<td>
				<input
					type = 'password'
					name = 'mdp_confirm'
					id = 'mdp_confirm' />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input
					type = 'hidden'
					name = 'idUser'
					value = '<?php echo $_POST['prof'];?>'
					id = 'idUser' />
			</td>
		</tr>
		<tr>
			<td colspan='2' align='center'>
				<input 
					type = 'submit'
					name = 'reset_mdp'
					value = 'Réinitialiser Mot de Passe' />
			</td>
		</tr>
	</table>
</form>

	
		
		
<?php 	
	}