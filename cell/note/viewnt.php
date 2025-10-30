<h1 class='bien'>Vue globale des notes séquentielles</h1>
		<form method='post' action='../traitement.php' target ='_blank'>
		<?php $regions = $config->verifNoteSaisieClasse(); /*print_r($regions);*/?>
			Classe : 
			<select name='classe' id='classe' onChange='goView()'>
				<option value='null'>-Classe-</option>
				<?php 
					
					for($i=0;$i<count($regions);$i++){
						echo "<option value='";
						echo $regions[$i]['id_classe'];
						echo "'>".strtoupper($regions[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			<div id='sequence' style = 'display:inline'>
			</div>
		</form>