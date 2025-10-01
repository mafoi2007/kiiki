<h1 class='bien'>traitement des notes séquentielles</h1>
		<form method='post' action='../traitement.php' target ='_blank'>
			Classe : <select name='clas' id='clas' onChange='goTraitNt()'>
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
			
			Séquence : <div id='sekence' style = 'display:inline'>
				<select name='sekence'>
					<option value='null'>-choisir une séquence-</option>
				</select>
			</div>
			
		</form>