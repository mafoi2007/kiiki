<div id='body2'>
    <h1 class='bien'>statistique des notes par matière</h1>
    <?php $listeMatiere = $config->listeMatiereProfClasse(); ?>
    <form method='post' action='../traitement.php' target ='_blank'>
        Matière :
            <select name='matiere' id='matiere' onChange='recapMatiere()'>
                <option value='null' selected>-Matière-</option>
                <?php
                for($i=0;$i<count($listeMatiere);$i++){
                    $idMatiere = $listeMatiere[$i]['id_matiere'];
                    $nomMatiere = strtoupper(stripslashes(utf8_decode($listeMatiere[$i]['nom_matiere'])));
                    echo "<option value='".$idMatiere."'>".$nomMatiere."</option>";
                }
                ?>
            </select>
            <div id='trimestre' style = 'display:inline'>
            </div>
    </form>
</div>