<h1 class='bien'>traitement des notes séquentielles</h1>
		<form method='post' action='../traitement.php' target ='_blank'>
			Classe : <select name='classe' id='classe' onChange='goTraitNt()'>
				<option value='null'>-Classe-</option>
				<?php 
					$regions = $note->viewClasseNote();
					for($i=0;$i<count($regions);$i++){
						echo "<option value='";
						echo $regions[$i]['id_classe'];
						echo "'>".strtoupper($regions[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			<div id='sekence' style = 'display:inline'>
			</div>
			
		</form>