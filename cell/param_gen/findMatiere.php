<h1 id='body3'>Rechercher une matière</h1>
	<form method='post' action=''>
		<p>Entrer le nom ou une partie du nom de la matière: 
		<input type='text' name='nomMatiere' placeholder='tapez la recherche' />
		<input type='submit' name='findNameMatiere' value='Rechercher' />
		</p>
	</form>
	
	<?php 
		if(isset($_POST['findNameMatiere'])){
			$element = htmlspecialchars($_POST['nomMatiere']);
			$recherche = $config->rechercherMatiere($element);
			// echo '<pre>';print_r($recherche);
			echo "<table border='1' width='70%' align='center'>
				<tr>
					<th>Nom de la Matière</th>
					<th>Code de la Matière</th>
					<th>Option</th>
				</tr>";
			for($i=0;$i<count($recherche);$i++){
				echo "<tr>";
					echo "<td>";
					echo strtoupper($recherche[$i]['nom_matiere']);
					echo "</td>";
					echo "<td>";
						echo strtoupper($recherche[$i]['code_matiere']);
					echo "</td>";
					echo "<td><a href = 'param_gen.php?choix=";
					echo $_GET['choix'];
					echo "&action=viewMatiere";
					echo "&amp;matiere=";
					echo $recherche[$i]['id'];
					echo "#body3'>Visualiser</a></td>
				</tr>";
			}
			echo "</table>";
		}
	
	
		
		
		
		if(isset($_GET['idEleve'])){
			echo "Identification de l'élève";
		}
	