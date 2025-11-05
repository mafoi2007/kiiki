<div id='body2'>
	<h1 class='bien'>conseil de classe</h1>
</div>

	<form method='post' action='../traitement.php' target = _blank>
		<p>Classe : 
			<select name='object'>
				<?php 
					$listeClasse = $config->listeClasseProfClasse();
					for($i=0;$i<count($listeClasse);$i++){
						echo "<option value='";
						echo $listeClasse[$i]['id_classe'];
						echo "'>".$listeClasse[$i]['nom_classe']."</option>";
					}
				?>
				<option value='null' selected>-Choix de la classe-</option>
			</select>
		</p>
		
		<input 
			type='hidden' 
			name='to_print' 
			value='ConseilClasse' />
		<p><input 
				type='submit' 
				name='print' 
				value='Imprimer le Conseil de Classe' /></p>
	</form>
	
<?php 
		if(isset($_POST['choixClasse'])){ 
			$clss = $_POST['classe'];
			?>
	
	<table border = '1' width = '100%'>
		<tr>
			<th>Classe</th>
			<th>Matière</th>
			<th>Enseignant</th>
			<th>Coef</th>
			<th>Groupe</th>
		</tr>
		<?php 
		$liste = $config->conseilDeClasse($clss);
		// echo '<pre>'; print_r($liste);
		for($i=0;$i<count($liste);$i++){
			echo "<tr>
				<td>".ucwords($liste[$i]['nom_classe'])."</td>
				<td>".ucwords($liste[$i]['nom_matiere'])."</td>
				<td>".strtoupper($liste[$i]['nom'])." 
				".ucwords($liste[$i]['prenom'])."</td>
				<td>".$liste[$i]['coef']."</td>
				<td>".$liste[$i]['groupe']."</td>
				
			</tr>";
		}
?>	
	
	
	
	
	
	
	

	</table>
	
		<?php 	}?>