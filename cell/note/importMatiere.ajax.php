<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
    // print_r($_POST);
    if(isset($_POST['classes'])){
        $classes = (int) $_POST['classes'];
        if($classes==0){
            echo "<h3 class='alert'>Choisir une classe.</h3>";
        }else{
            $matiere = $config->listeMatiereClasse($classes); ?>
            Matière : 
                <select name='matiere' id='matiere'>
                    <?php 
                    for($x=0;$x<count($matiere);$x++){
                        $idMat = $matiere[$x]['id_matiere'];
                        $nomMat = strtoupper($matiere[$x]['nom_matiere']);
                        echo "<option value='".$idMat."'>".$nomMat."</option>";
                    } ?>
                </select>
                <input 
                    type='file'
                    name='uploadedFile' />
                <input type='submit' name='importNote' value='Importer' />
<?php             
            
        }
    }
?>