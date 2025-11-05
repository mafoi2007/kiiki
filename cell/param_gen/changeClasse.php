<h1 class='alert'>Changer la classe de l'élève</h1>
<?php $listeEleve = $config->listeEleveAll('non_supprime');/* echo '<pre>'; print_r($listeEleve); echo '</pre>';*/?>
<form method='post' action='../traitement.php'>
	<p>
		Sélectionner le nom de l'élève : 
		<select name='eleve' id='eleve' onChange='findEleveClasse()'>
            <option value='null'>-Choisir Eleve-</option>
            <?php 
            for($i=0;$i<count($listeEleve);$i++){
                $idEleve = $listeEleve[$i]['id'];
                $nomEleve = $listeEleve[$i]['nom_complet'];
                echo "<option value='".$idEleve."'>".$nomEleve."</option>";
            } ?>
        </select>
	</p>
	<div id='resultat' style = 'display:inline'>		
	</div>
</form>