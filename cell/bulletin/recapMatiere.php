<h1 class='bien'>PV des Notes par Matière</h1>
		<form method='post' action='../traitement.php' target ='_blank'>
			Matière : <select name='matiere' id='matiere' onChange='recapMatiere()'>
				<option value='null'>-Matière-</option>
				<?php 
					$listeMatiere = $config->listeMatiereProfClasse();
					for($i=0;$i<count($listeMatiere);$i++){
						echo "<option value='";
						echo $listeMatiere[$i]['id_matiere'];
						echo "'>".strtoupper($listeMatiere[$i]['nom_matiere'])."</option>";
					}
				?>
			</select>
			
			<div id='trimestre' style = 'display:inline'>
			</div>
		</form>
