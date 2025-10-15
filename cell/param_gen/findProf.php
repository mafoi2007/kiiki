<h1 class='bien' id='body3'>Rechercher un enseignant</h1>
	<form method='post' action='' target ='_blank'>
		<h4 class='alert'>Tapez votre recherche ici : 
		<input type='text' name='prof' id='prof' onKeyup='findProf()' /></h4>
		<div id='resultat' style = 'display:inline'>
		</div>
	</form>















	
	<?php 
		if(isset($_POST['findName'])){
			$element = htmlspecialchars($_POST['nomEnseignant']);
			$recherche = $config->rechercherEnseignant($element);
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
					echo "<td><a href = 'param_gen.php?choix=";
					echo $_GET['choix'];
					echo "&action=viewProf";
					echo "&amp;prof=";
					echo $recherche[$i]['id'];
					echo "#body3'>Visualiser</a></td>
				</tr>";
			}
			echo "</table>";
		}
	
	
		
		
		
		if(isset($_GET['idEleve'])){
			echo "Identification de l'élève";
		}
	