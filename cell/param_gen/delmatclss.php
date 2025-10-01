<h1 id='body3' class='alert'>Retirer une matière à une classe</h1>
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
	<table border = '1' width = '50%' align='center'>
		<tr>
			<th>N°</th>
			<th>Classe</th>
			<th>Matière</th>
			<th>Supprimer</th>
		</tr>
		<?php 
		$liste = $config->listeMatiereClasse($clss);
		// echo '<pre>';print_r($liste); echo '</pre>';
		$b = 1;
		for($i=0;$i<count($liste);$i++){
			echo"<tr>";
				echo"<td align='center'><b>".$b."</b></td>";
				echo"<td><input type = 'text' value='".$clss."' disabled size='5'/></td>";
				echo"<td><input 
							type='hidden' 
							name='matiere[".$i."]' 
							value='".$liste[$i]['id_matiere']."' />
						<input 
							type = 'text' 
							value='".ucwords($liste[$i]['nom_matiere'])."' 
							readonly size='25' /></td>";
				echo"<td><input type = 'checkbox' name='idMatiere[]' value='".$liste[$i]['id']."' /></td>";
			echo"</tr>";
			$b++;
		}
		
		
		
		echo "<tr>
			<td colspan='5' align='center'>
		<input type='hidden' name='cls' value='".$clss."' />
		<input type='submit' name='delmatiereclasse' value='Valider Suppression' />
			</td>
		</td>";
		// echo '<pre>';print_r($gest);
		?>
	</table>
	</form>




<?php 	}
	?>
	
	
	
	