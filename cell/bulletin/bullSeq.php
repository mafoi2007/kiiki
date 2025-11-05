<h1 class='bien'>Bulletin Séquentiel</h1>
		<form method='post' action='../traitement.php' target ='_blank'>
			Classe : <select name='classe' id='classe' onChange='goBullSeq()'>
				<option value='null'>-Classe-</option>
				<?php 
					$regions = $config->classesTraiteesSeq();
					for($i=0;$i<count($regions);$i++){
						echo "<option value='";
						echo $regions[$i]['classe'];
						echo "'>".strtoupper($regions[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			<div id='sekence' style = 'display:inline'>
			</div>
			
		</form>
