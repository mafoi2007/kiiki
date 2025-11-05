<?php 
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new config($db);
	if(isset($_POST['eleve'])){
		$eleve = (int) $_POST['eleve'];
        if($eleve==0){
            echo "<h3 class='alert'>Vous devez sélectionner un élève.</h3>";
        }else{
            $infoEleve = $config->getEleve($eleve);
            // print_r($infoEleve);
            $listeClasse = $config->viewClasseAll('actif');
            // echo '<pre>';print_r($listeClasse); echo '</pre>';
            echo "<h3 class='alert'>Classe Actuelle : ".$infoEleve['nom_classe']."</h3>"; ?>
            <h3 class='bien'>Nouvelle Classe : 
                <select name='classe' id='classe'>
                    <?php 
                    for($i=0;$i<count($listeClasse);$i++){
                        $idClasse = $listeClasse[$i]['id'];
                        $nomClasse = $listeClasse[$i]['nom_classe'];
                        echo "<option value='".$idClasse."'>".$nomClasse."</option>";
                    } ?>
                </select>
            <input type='submit' name='changeClasseEleve' value='Modifier' />
<?php 
        }
	}