<h1>Relevé de Notes de la classe</h1>
	<form method='post' action='../traitement.php' target = _blank>
		<p>Classe : 
			<select name='object'>
				<?php 
					$classe = $config->viewClasse('actif');
					for($i=0;$i<count($classe);$i++){
						echo "<option 
						value='";
						echo $classe[$i]['code_classe'];
						echo "'>";
						echo ucwords($classe[$i]['nom_classe']);
						echo "</option>";
					}
				?>
				<option value='null' selected>-Choix de la classe-</option>
			</select>
		</p>
		
		<input 
			type='hidden' 
			name='to_print' 
			value='ReleveNote' />
		<p><input 
				type='submit' 
				name='print' 
				value='Imprimer le Relevé de notes' /></p>
	</form>