<h1 class='alert'>Suppression des notes</h1>
		<form method='post' action='../traitement.php' target ='_blank'>
			Classe : <select name='clas' id='clas' onChange='goDel()'>
				<option value='null'>-Classe-</option>
				<?php 
					$classes = $note->noteSaisieProf($_SESSION['login']);
					for($i=0;$i<count($classes);$i++){
						echo "<option value='";
						echo $classes[$i]['id_classe'];
						echo "'>".strtoupper($classes[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			<div id='matiere' style = 'display:inline'>
				
			</div>
			
		</form>