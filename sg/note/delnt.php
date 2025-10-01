<h1 class='alert'>Suppression des notes</h1>
		<form method='post' action='../traitement.php' target ='_blank'>
			Classe : <select name='clas' id='clas' onChange='goDel()'>
				<option value='null'>-Classe-</option>
				<?php 
					$classes = $note->verifNoteSaisieClasse();
					for($i=0;$i<count($classes);$i++){
						echo "<option value='";
						echo $classes[$i]['id_classe'];
						echo "'>".strtoupper($classes[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			Matière : <div id='matiere' style = 'display:inline'>
				<select name='matiere'>
					<option value='null'>-choisir une Matière-</option>
				</select>
				
			</div>
			
		</form>