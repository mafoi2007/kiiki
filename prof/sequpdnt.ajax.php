<?php 
	session_start();
	require_once('../inc/connect.inc.php');
	$config = new config($db);
    // print_r($_POST);
    $subject = (int) $_POST['subject'];
    if($subject==0){
        echo "<h3 class='alert'>Vous devez choisir une matière.</h3>";
    }else{
        $sequenceActive = $config->periodeCourante();
        // echo '<pre>'; print_r($sequenceActive); echo '</pre>';
        if(empty($sequenceActive)){
            echo "<h3 class='alert'>Aucune séquence active pour le moment .</h3>";
        }else{ ?>
            Séquence : <select name='periode' id='periode' onChange='saveNoteUpdNt()'>
                <option value='null' selected>-Choisir Séquence-</option>
                <?php 
                for($i=0;$i<count($sequenceActive);$i++){
                    echo "<option value='".$sequenceActive[$i]['id']."'>";
                    echo utf8_decode($sequenceActive[$i]['nom_periode'])."</option>";
                } ?>
            </select>
            <div id='addNt' style = 'display:inline'>
            </div>
<?php
        }
    }