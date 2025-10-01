<h1>Affecter un enseignant à une classe</h1>
	<?php $listeClasse = $config->listeClasseProfClasse(); 
	/*echo '<pre>';print_r($listeClasse); echo '</pre>';*/?>
	<form method='post' action=''>
		<p>Classe : 
			<select name='classe'>
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
			<input type ='submit' name='choixClasse' value='Valider' />
		</p>
	</form>
	<?php 
		if(isset($_POST['choixClasse'])){ 
			$clss = $_POST['classe']; 
			?>
	<form method='post' action = '../traitement.php'>
	<table border = '1' width = '85%'>
		<tr>
			<th>Classe</th>
			<th>Matière</th>
			<th>Enseignant</th>
		</tr>
		<?php 
		$liste = $config->listeMatiereClasse($clss);
		// echo '<pre>';print_r($liste); echo '</pre>';
		for($i=0;$i<count($liste);$i++){
			echo"<tr>";
				echo"<td><input type = 'text' value='".$clss."' disabled/></td>";
				echo"<td><input 
							type='hidden' 
							name='matiere[".$i."]' 
							value='".$liste[$i]['id_matiere']."' />
						<input 
							type = 'text' 
							value='".ucwords($liste[$i]['nom_matiere'])."' 
							readonly /></td>";
		$gest = $config->viewGestionnaireAll('actif');
				echo "<td>";
					echo "<select name='prof[$i]'>";
						echo "<option value='' selected>-Choisir-</option>";
						for($a=0;$a<count($gest);$a++){
							echo "<option value='".$gest[$a]['login']."'";
							
							echo ">";
							echo strtoupper($gest[$a]['nom'])." 
							".ucwords($gest[$a]['prenom'])."
							</option>";
						}
					echo "</select>";
				echo"</td>";
			echo"</tr>";
		}
		
		
		
		echo "<tr>
			<td colspan='3' align='center'>
		<input type='hidden' name='cls' value='".$clss."' />
		<input type='submit' name='updmatiereclasse' value='Enregistrer' />
			</td>
		</td>";
		// echo '<pre>';print_r($gest);
		?>
	</table>
	</form>




<?php 	}
	?>
	
	
	
	