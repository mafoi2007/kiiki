<h1 id='body3'>Rechercher une classe</h1>
	<form method='post' action='../traitement.php'>
		<p>Entrer le nom ou une partie du nom de la classe: 
		<input 
			type='text' 
			name='nomClasse'			
			id='nomClasse'			
			placeholder='tapez la recherche' 
			onKeyUp='listClasse()'/>
		</p>
		<div id='resultat'>
		</div>
	</form>
	
	<?php 
		if(isset($_POST['findNameClasse'])){
			$element = htmlspecialchars($_POST['nomClasse']);
			$recherche = $config->rechercherClasse($element);
			// echo '<pre>';print_r($recherche);
			echo "<table border='1' width='70%' align='center'>
				<tr>
					<th>Nom de la classe</th>
					<th>Code de la classe</th>
					<th>Niveau</th>
					<th>Option</th>
				</tr>";
			for($i=0;$i<count($recherche);$i++){
				echo "<tr>";
					echo "<td>";
					echo strtoupper($recherche[$i]['nom_classe']);
					echo "</td>";
					echo "<td>";
						echo strtoupper($recherche[$i]['code_classe']);
					echo "</td>";
					echo "<td>";
						echo $recherche[$i]['niveau'];
					echo "</td>";
					echo "<td><a href = 'param_gen.php?choix=";
					echo $_GET['choix'];
					echo "&action=viewClasse";
					echo "&amp;classe=";
					echo $recherche[$i]['id'];
					echo "#body3'>Visualiser</a></td>
				</tr>";
			}
			echo "</table>";
		}
	
	
		
		
		
		if(isset($_GET['idEleve'])){
			echo "Identification de l'élève";
		}
	