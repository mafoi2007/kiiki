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
			print_r($_POST);
			echo $table;
			echo $_POST['annee'];
            $resultat = $config->rechercherEleveOld($eleve,'www');
			echo '<pre>'; print_r($resultat); echo '</pre>';
            if(empty($resultat)){
                echo "<h3 class='alert'>Aucun élève ne correspond à votre recherche.</h3>";
            }else{ ?>
                <h1 class='bien'>Restats de la recherche</h1>
                <table border='1' width='70%' align='center'>
                    <tr>
                        <th>Cocher</th>
                        <th>Année Scolaire</th>
                        <th>Noms et Prénoms</th>
                    </tr>
			<?php 
				for($i=0;$i<count($resultat);$i++){ ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
			<?php 
				} 
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