    <h1 class='alert'>Modifier ses Notes</h1>
    <?php $classe = $config->listClassSaisieProf($_SESSION['user']['id']); 
    if(empty($classe)){
        echo "<h3 class='alert'>Vous n'avez encore saisi aucune note. Reportez-vous au Menu
                <i><u>Insérer des Notes</u></i> pour enregistrer vos notes.</h3>";
    }else{  ?>
    <form method='post' action=''>
        Classe : 
            <select name='classe' id='classe' onChange='getMatiereUpdNt()'>
                <option value='null' selected>-Choisir la Classe-</option>
                <?php
                for($i=0;$i<count($classe);$i++){
                    echo "<option value='".$classe[$i]['id_classe']."'>".$classe[$i]['nom_classe']."</option>";
                }
                ?>
            </select>
        <div id='matiere' style = 'display:inline'>
        </div>
    </form>
<?php 
    }




if(isset($_POST['info'])){
    // echo '<pre>'; print_r($_POST); echo '</pre>';
    $classe = (int) $_POST['classe'];
    $matiere = (int) $_POST['subject'];
    $sequence = (int) $_POST['periode'];
    $nomClasse = $config->getClasse($_POST['classe']);
    $nomMatiere = $config->getMatiere($_POST['subject']);
    $nomSequence = $config->getSequenceCourante($_POST['periode']);
    $as = $config->getCurrentYear();
    $listeEleve = $config->listeEleve($nomClasse['id'], 'non_supprime', $as);
    $listeNote = $config->listeNote($classe, $matiere, $sequence);
    require_once('../forms/modifierNote.form.php');
}
    ?>
