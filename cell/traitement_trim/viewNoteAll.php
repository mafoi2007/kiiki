<h1 class='bien'>Récapitulatif des notes trimestrielles</h1>
		<form method='post' action='../traitement.php' target ='_blank'>
			Classe : <select name='clas' id='clas' onChange='goViewAll()'>
				<option value='null'>-Classe-</option>
				<?php 
					$regions = $note->classesTraitees();
					for($i=0;$i<count($regions);$i++){
						echo "<option value='";
						echo $regions[$i]['classe'];
						echo "'>".strtoupper($regions[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			Trimestre : <div id='trimestre' style = 'display:inline'>
				<select name='trimestre'>
					<option value='null'>-choisir un trimestre-</option>
				</select>
			</div>
			
		</form>