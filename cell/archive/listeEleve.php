<h1 class='bien'>Liste des élèves</h1>
	<form method='post' action='../traitement.php' target='_blank'>
		Année Précédente :
			<select name='oldYear' id='oldYear' onChange='findClasse()'>
				<option value='null'>-Année Scolaire-</option>
				<?php 
				$oldYear = $config->listeAnnee('inactif');
				for($i=0;$i<count($oldYear);$i++){
					$libelle = str_replace(' ', '',$oldYear[$i]['libelle_annee']);
					$libelle = str_replace('/', '-',$libelle);
					$id = $oldYear[$i]['libelle_annee'];
					echo "<option value='".$libelle."'>".$id."</option>";
				}
				?>
			</select>
			<div id='liste' style='display:inline'>
			</div>
	</form>