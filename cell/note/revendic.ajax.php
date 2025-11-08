<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
    // print_r($_POST);
    if(isset($_POST['classe'])){
        $classe = (int) $_POST['classe'];
        if($classe==0){
            $msg = "<h3 class='alert'>Choisir une classe.</h3>";
            echo $msg;
        }else{
            $listeEleve = $config->listeEleve($classe, 'non_supprime');
            $listeSequence = $config->listeSequenceClasse($_POST['classe']);
            // echo '<pre>';print_r($listeSequence);
            if(empty($listeEleve)){
                $msg = "<h3 class='alert'>La classe semble n'avoir aucun élève.</h3>";
                echo $msg;
            }else{ ?>
                Eleve : 
                <select name='eleve'>
                    <?php for($i=0;$i<count($listeEleve);$i++){
                        $idEleve = $listeEleve[$i]['id'];
                        $nomEleve = $listeEleve[$i]['nom_complet'];
                        echo "<option value='".$idEleve."'>".$nomEleve."</option>";
                    } ?>
                </select>
                Séquence : 
                <select name='sequence'>
                    <?php for($a=0;$a<count($listeSequence);$a++){
                        $idPeriode = $listeSequence[$a]['id_periode'];
                        echo "<option value='".$idPeriode."'>Séquence ".$idPeriode."</option>";
                    } ?>
                </select>
                <input type='submit' name='Go' value='Ok' />
<?php 
            }
        }
    }
?>
	

























	
	
	