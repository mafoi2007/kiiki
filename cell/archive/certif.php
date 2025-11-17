<h1 class='bien'>archive des certificats de scolarités</h1>
	<form method='post' action='../traitement.php' target='_blank'>
		Année Précédente :
			<select name='oldYear' id='oldYear' onChange='findName()'>
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
			<div id='certif' style='display:inline'>
			</div>
	</form>