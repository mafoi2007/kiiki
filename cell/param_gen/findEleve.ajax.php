<?php 
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new config($db);
	if(isset($_POST['eleve'])){
		$eleve = $_POST['eleve'];
        if(strlen($eleve)==0){
            echo "<h3 class='alert'>Vous devez saisir une valeur pour automatiser la recherche.</h3>";
        }else{
            // $resultat = $config->findEleve($eleve);
            $resultat = $config->rechercherEleve($eleve);
			// echo '<pre>'; print_r($resultat); echo '</pre>';
            if(empty($resultat)){
                echo "<h3 class='alert'>Aucun élève ne correspond à votre recherche.</h3>";
            }else{ ?>
                <h1 class='bien'>Resultats de la recherche</h1>
                <table border='1' width='100%'>
                    <tr>
                        <th>N°</th>
                        <th>Nom et Prénoms</th>
                        <th>Détail</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
<?php 
$a = 1;
for($i=0;$i<count($resultat);$i++){
	$page = 'param_gen.php?choix='.sha1('eleve').'&amp;action=';
	$detail = $page.'detailEleve&amp;id='.$resultat[$i]['id'];
	$update = $page.'updateEleve&amp;id='.$resultat[$i]['id'];
	$delete = $page.'deleteEleve&amp;id='.$resultat[$i]['id'];
	$restaure = $page.'restaureEleve&amp;id='.$resultat[$i]['id'];
    echo "<tr>
        <td align='center'>".$a."</td>
        <td>".$resultat[$i]['nom_complet']."</td>
        <td><a href='".$detail."'>Détail</a></td>
        <td><a href='".$update."'>Modifier</a></td>";
        if($resultat[$i]['etat']=='non_supprime'){
            echo "<td><a href='".$delete."'>Supprimer</a></td>";
        }elseif($resultat[$i]['etat']=='supprime'){
            echo "<td><a href='".$restaure."'><font class='alert'>Restaurer</font></a></td>";
        }
        
    echo "</tr>";
    $a++;
}            
?>
                </table>
<?php 
            }
        }
	}