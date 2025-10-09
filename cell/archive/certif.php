<h1 class='bien'>certificat de scolarité</h1>
	<form method='post' action='traitement.php' target='_blank'>
		Année Précédente :
			<select name='oldYear' id='oldYear' onChange='findName()'>
				<option value='null'>-Année Scolaire-</option>
				<?php 
				$oldYear = $config->listeAnnee('inactif');
				for($i=0;$i<count($oldYear);$i++){
					$libelle = str_replace(' ', '',$oldYear[$i]['libelle_annee']);
					$libelle = str_replace('/', '-',$libelle);
					$id = $oldYear[$i]['libelle_annee'];
					echo "<option value='".$libelle."'>".$id."</option>";
				}
				?>
			</select>
			<div id='certif' style='display:inline'>
			</div>
	</form>
	
	
	
	
	
	
	
	
	
	<?php 
		if(isset($_POST['findName'])){
			$element = htmlspecialchars($_POST['nomEleve']);
			$recherche = $config->rechercherEleve($element);
			$valeurs = count($recherche);
			if($valeurs==0){
				echo "<h3 class='alert'>Aucune entrée trouvée.</h3>";
			}
			else{			
			// echo '<pre>';print_r($recherche);
			echo "<form method='post' action='../traitement.php' target='_blank'>";
			echo "<table border='1' width='70%' align='center'>
				<tr>
					<th>Cocher</th>
					<th>Année Scolaire</th>
					<th>Nom et Prénoms</th>
				</tr>";
			for($i=0;$i<count($recherche);$i++){
				echo "<tr>";
					echo "<td><input type='radio' name='eleve' value='".$recherche[$i]['id']."' /></td>";
					echo "<td><input 
									type='text' 
									value='".$recherche[$i]['a_s']."'
									disabled
									/></td>";
					
					echo "<td>";
					echo $recherche[$i]['nom_complet'];
					
					echo "</td>";

					echo "
					<input type='hidden' name='to_print' value='certificatScol' />
				</tr>";
			}
				echo "<td align='center' colspan='3'>
					<input 
						type='submit'
						name='print'
						value='Editer'
				</td>";
			echo "</table>";
			echo "</form>";
			}
		}
	
	
		
		
		
		if(isset($_GET['idEleve'])){
			echo "Identification de l'élève";
		}
	