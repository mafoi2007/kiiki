<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
  if(isset($_POST['prof'])){
    $prof = $_POST['prof']; ?>
    <h1 class='alert'>Resultats de la Recherche</h1>
    <table border='1' width='100%'>
        <tr>
            <th>N°</th>
            <th>Nom de l'enseignant</th>
            <th>Détails</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
<?php 
        $listeProf = $config->findProf($prof);
        $page = "param_gen.php?choix=";
		$page .=sha1('enseignant')."&amp;action=";
		
		$detail = $page.'detailEnseignant&amp;id=';
		$update = $page.'updateEnseignant&amp;id=';
		$delete = $page.'deleteEnseignant&amp;id=';
		$restaure = $page.'restaureEnseignant&amp;id=';
		// echo $page;
        if(empty($listeProf)){
            echo "<tr>
                    <th colspan='9' class='alert'>Aucun enseignant correspondant.</th>
                </tr>";
        }else{
            $a = 1;
            for($i=0;$i<count($listeProf); $i++){ ?>
        <tr>
            <td><?php echo $a; ?></td>
            <td><?php echo stripslashes($listeProf[$i]['nom_complet_enseignant']); ?></td>
            <td><a href="<?php echo $detail.$listeProf[$i]['id']; ?>#body3">Détails</a></td>
            
            <td><a href="<?php echo $update.$listeProf[$i]['id']; ?>#body3">Modifier</a></td>
            <?php 
            if($listeProf[$i]['etat']=='actif'){ ?>
            <td><a href="<?php echo $delete.$listeProf[$i]['id']; ?>#body3">Supprimer</a></td>
    <?php
            }
            elseif($listeProf[$i]['etat']=='inactif'){ ?>
            <td class='alert' align='center'><i class='alert'><a href="<?php echo $restaure.$listeProf[$i]['id']; ?>#body3">Restaurer</a></i></td>
            <?php }
            ?>
            
            
        </tr>
<?php 
            $a++;
            }
        }
  }
?>
	</table>	