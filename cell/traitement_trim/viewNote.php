<h1 class='bien'>Visualisation des notes séquentielles</h1>
		<form method='post' action='../traitement.php' target ='_blank'>
			Classe : <select name='clas' id='clas' onChange='goView()'>
				<option value='null'>-Classe-</option>
				<?php 
					$regions = $note->verifNoteSaisieClasse();
					for($i=0;$i<count($regions);$i++){
						echo "<option value='";
						echo $regions[$i]['id_classe'];
						echo "'>".strtoupper($regions[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			Séquence : <div id='sequence' style = 'display:inline'>
				<select name='sequence'>
					<option value='null'>-choisir une séquence-</option>
				</select>
			</div>
			<input type='hidden' name='to_print' value='VisualiserNoteSequentielle' />
			<input type='submit' name='print' value='Valider' />
		</form>