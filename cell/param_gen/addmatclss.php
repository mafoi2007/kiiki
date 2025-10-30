<h1 id='body3'>Insérer plusieurs matières dans la classe</h1>
	<form method='post' action='../traitement.php'>
		<p>Classe : 
			<select name='classe' id='classe' onChange='showMatiere()'>
				<?php 
					$classe = $config->viewClasse('actif');
					if(count($classe)==0){
						echo "<option value='null'>-Aucune classe enregistrée-</option>";
					}
					else{
						for($i=0;$i<count($classe);$i++){
							echo "<option value='";
							echo $classe[$i]['id'];
							echo "'>";
							echo ucwords($classe[$i]['nom_classe']);
							echo "</option>";
						}
						echo "<option value='null' selected>-Choisir la classe-</option>";
					}
				?>
			</select>
			<div id='resultat'>
			</div>
		</p>