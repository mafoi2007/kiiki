<h1 class='bien'>Bulletin trimestriel</h1>
		<form method='post' action='../traitement.php' target ='_blank'>
			Classe : <select name='classe' id='classe' onChange='goBullTrim()'>
				<option value='null'>-Classe-</option>
				<?php 
					$regions = $config->classesTraiteesTrim();
					for($i=0;$i<count($regions);$i++){
						echo "<option value='";
						echo $regions[$i]['classe'];
						echo "'>".strtoupper($regions[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			<div id='trimestre' style = 'display:inline'>
			</div>
			
		</form>
