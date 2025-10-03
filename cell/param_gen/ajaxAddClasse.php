<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
?>

	
		<table border="0" width="85%">
			<tr>
				<td>
					<label for='niveau_classe'><p>Niveau de la Classe :</p></label>
				</td>
				<td>
					<select name='niveau_classe' id='niveau_classe'>
					<?php 
					$section = $_POST['section'];
					$niveau = $config->listeNiveauxSection($section);
					for($a=0;$a<count($niveau);$a++){
						echo "<option value='";
						echo $niveau[$a]['id'];
						echo "'>".$niveau[$a]['nom_niveau']."</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label for='nom_classe'><p>Nom de la Classe <i>(en lettres)</i> :</p></label>
				</td>
				<td>
					<input type="text" name="nom_classe" id="nom_classe" placeholder="Exemple: Sixième M 1" size="30" />
				</td>
			</tr>
			<tr>
				<td>
					<label for='code_classe'><p>Code de la Classe :</p></label>
				</td>
				<td>
					<input type="text" name="code_classe" id="code_classe" placeholder="Exemple: 6M1" size="30" />
				</td>
			</tr>
			
			<tr>
				<td>
					<p><input type="submit" name="ajout_classe" value="Ajouter une classe" /></p>
				</td>
				<td>
					<input type="reset" value="Annuler" />
				</td>
			</tr>
		</table>