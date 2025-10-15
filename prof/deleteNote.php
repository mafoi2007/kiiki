<?php 
	session_start();
	require_once('../inc/connect.inc.php');
	$config = new config($db);
    // print_r($_POST);
    $periode = (int) $_POST['periode'];
    if($periode==0){
        echo "<h3 class='alert'>Choisissez la séquence pour laquelle remplir les notes.</h3>";
    }else{ ?>
        <input type='submit' name='info' value='Supprimer' />
<?php     
    }