<h1 class='bien' title='Changer son mot de passe'>Mon mot de passe</h1>

<form method='post' action='../traitement.php'>
	<table border='0' width='60%'>
		<tr>
			<td>Entrez votre mot de passe Actuel :</td>
			<td>
				<input 
					type = 'password'
					name = 'mdp_ancien'
					id = 'mdp_ancien' />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Entrez votre <b class='alert'>nouveau</b> mot de passe :</td>
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
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan='2' align='center'>
				<input 
					type = 'submit'
					name = 'changer_mdp'
					value = 'Changer Mot de Passe' />
			</td>
		</tr>
	</table>
</form>