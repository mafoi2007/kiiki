<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
    // print_r($_POST);
    if(isset($_POST['matiere'])){
        $matiere = (int) $_POST['matiere'];
        if($matiere==0){
            $msg = "<h3 class='alert'>Vous devez choisir une matière.</h3>";
            echo $msg;
        }else{ ?>
            Trimestre :
            <?php $trimestre = $config->getTrimestre($matiere); ?> 
            <select name='trimestre'>
                <?php 
                if(empty($trimestre)){
                    echo "<option value='null'>-Aucun Trimestre Correspondant.-</option>";
                }else{
                    for($i=0;$i<count($trimestre);$i++){
                        echo "<option value='".$trimestre[$i]."'>";
                        echo "Trimestre ".$trimestre[$i]."</option>";
                    }
                    echo "<input type='hidden' name='to_print' value='RecapMatiere' />";
                    echo " <input type='submit' name='print' value='Générer' />";
                }
                ?>
            </select>
           
<?php 
        }
    }
?>