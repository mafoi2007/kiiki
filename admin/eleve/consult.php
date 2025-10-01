<h1>Liste des élèves</h1>
	
	<form method='post' action=''>
		<p>Choisir la Classe : 
			<select name='classe'>
				<?php 
					$listeClasses = $config->viewClasse('actif');
					$i = 1;
					for($i=0;$i<count($listeClasses);$i++){
						echo "<option 
							value='".$listeClasses[$i]['code_classe']."'>";
						echo $listeClasses[$i]['nom_classe']."</option>\n";
						
					}
				?>
				<option selected>-classe-</option>
			</select>
			<input type='submit' name='validerClasse' value='Choisir' />
		</p>
	</form>


	<?php 
		if(isset($_POST['validerClasse'])){
			$cls = htmlspecialchars($_POST['classe']);
			// echo $cls;
			$liste = $config->listeEleve($cls, 'non_supprime');
			// echo '<pre>'; print_r($liste); echo '</pre>';
			echo "<h2>Liste des élèves de 
				la ".strtoupper($liste[0]['nom_classe'])."</h2>"; ?>

	<table border='1' width='100%'>
		<tr>
			<th>
				N°
			</th>
			<th>
				Nom et Prénom
			</th>
			<th>
				Sexe
			</th>
			<th>
				Matricule
			</th>
			<th>
				Classe
			</th>
			
		</tr>
			
<?php 
			
			/*La vérification consiste à s'assurer que si le tableau est vide,
			alors on renvoie une valeur du genre AUCUN ELEVE*/
			if(!empty($liste)){
				$a = 1;
				for($i=0;$i<count($liste);$i++){
					echo "<tr>";
						echo "<td>".$a."</td>";
				echo "<td>";
				echo strtoupper($liste[$i]['nom']);
				echo " ";
				echo ucwords($liste[$i]['prenom']);
				echo "</td>
						<td>".$liste[$i]['sexe']."</td>
						<td>".$liste[$i]['matricule']."</td>
						<td>".$liste[$i]['nom_classe']."</td>
					</tr>";
					$a++;
				}
				echo"<tr>";
					echo"<td colspan='5'>";
						echo"<form 
								method='post' 
								action='../traitement.php' 
								target=_blank>";
							echo"<input 
									type='hidden' 
									name='to_print' 
									value='listeEleve' />";
							echo"<input 
									type='hidden' 
									name='object' 
									value='".$liste[0]['code_classe']."' />";
							echo"<input 
									type='submit' 
									name='print' 
									value='Imprimer' />";
						echo"</form>";
					echo"</td>";
				echo"</tr>";
			}
			else {
				echo "<tr>
					<th colspan='5'>AUCUN ELEVE DANS LA CLASSE</th>
				</tr>";
			}
		}
	
	
	?>
	</table>