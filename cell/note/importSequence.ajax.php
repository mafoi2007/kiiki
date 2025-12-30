<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
    // print_r($_POST);
    if(isset($_POST['sequence'])){
        $sequence = (int) $_POST['sequence'];
        if($sequence==0){
            echo "<h3 class='alert'>Choisir une Séquence.</h3>";
        }else{ 
            $classeFr = $config->viewClasseSection('fr','actif');
            $classeEn = $config->viewClasseSection('en','actif');
            ?>
            Classe : <select name='classes' id='classes' onChange='getMatiereImport()'>
                <option value='null'>-Choisir Classe-</option>
                <optgroup label='Section Francophone'></optgroup>
                <?php 
                for($i=0;$i<count($classeFr);$i++){
                    $idClasse = $classeFr[$i]['id'];
                    $nomClasse = strtoupper($classeFr[$i]['nom_classe']);
                    echo "<option value='".$idClasse."'>".$nomClasse."</option>";
                }?>
                <optgroup label='Section Anglophone'></optgroup>
                <?php 
                for($i=0;$i<count($classeEn);$i++){
                    $idClasse = $classeEn[$i]['id'];
                    $nomClasse = strtoupper($classeEn[$i]['nom_classe']);
                    echo "<option value='".$idClasse."'>".$nomClasse."</option>";
                }?>
            </select>
            <div id='matieres' style = 'display:inline'>
			</div>
<?php 
        }
    }
?>
	