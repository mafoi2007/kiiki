<h1>Rechercher un élève</h1>
	<form method='post' action=''>
		<p>Entrer le nom ou une partie du nom : 
		<input type='text' name='nomEleve' placeholder='tapez la recherche' />
		<input type='submit' name='findName' value='Rechercher' />
		</p>
	</form>
	
	<?php 
		if(isset($_POST['findName'])){
			$element = htmlspecialchars($_POST['nomEleve']);
			$recherche = $config->rechercherEleve($element);
			// echo '<pre>';print_r($recherche);
			echo "<table border='1' width='70%' align='center'>
				<tr>
					<th>Nom et Prénoms</th>
					<th>Option</th>
				</tr>";
			for($i=0;$i<count($recherche);$i++){
				echo "<tr>";
					echo "<td>";
					echo strtoupper($recherche[$i]['nom']);
					echo " ";
					echo ucwords($recherche[$i]['prenom'])."</td>";
					echo "<td><a href = 'config.php?cat=eleve&choix=";
					echo sha1('viewEleve');
					echo "&amp;eleve=";
					echo $recherche[$i]['id'];
					echo "#body2'>Visualiser</a></td>
				</tr>";
			}
			echo "</table>";
		}
	
	
		
		
		
		if(isset($_GET['idEleve'])){
			echo "Identification de l'élève";
		}
	