<h1 class='bien'>Relevé de Notes Numériques</h1>
	
	<form method='post' action='../traitement.php' target='_blank'>
		<p>Choisir la Classe : 
			<select name='classe'>
				<?php 
					$listeClasses = $config->viewClasse('actif');
					$i = 1;
					for($i=0;$i<count($listeClasses);$i++){
						echo "<option 
							value='".$listeClasses[$i]['id']."'>";
						echo $listeClasses[$i]['nom_classe']."</option>\n";
						
					}
				?>
				<option selected value='null'>-classe-</option>
			</select>
			<input type='hidden' name='to_export' value='releveNumerique' />
			<input type='submit' name='export' value='Exporter' />
		</p>
	</form>