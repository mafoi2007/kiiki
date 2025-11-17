<?php 
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new config($db);
    // print_r($_POST);
    if(isset($_POST['nomEleve'])){
        $element = htmlspecialchars($_POST['nomEleve']);
        $recherche = $config->rechercherEleve($element);
        $valeurs = count($recherche);
        if($valeurs==0){
            $msg = "<h3 class='alert'>Aucune entrée trouvée.</h3>";
            echo $msg;
        }else{ ?>
            <table border='1' width='70%' align='center'>
                <tr>
                    <th>Cocher</th>
                    <th>Année Scolaire</th>
                    <th>Nom et Prénoms</th>
                </tr>
        <?php for($i=0;$i<count($recherche);$i++){ ?>
                <tr>
                    <td>
                        <input 
                            type='radio' 
                            name='eleve' 
                            value='<?php echo $recherche[$i]['id']; ?>' 
                        />
                    </td>
                    <td>
                        <input 
                            type='text' 
                            value='<?php echo $recherche[$i]['libelle_annee']; ?>'
							disabled
						/>
                    </td>
                    <td>
                        <?php echo $recherche[$i]['nom_complet']; ?>
                    </td>
                </tr>
            <?php } ?>
                <tr>
                    <td colspan='5' align='center'>
                        <input 
                            type='hidden' 
                            name='to_print' 
                            value='certificatScolarite' 
                        />
                        <input 
                            type='submit'
                            name='print'
                            value='Editer'
                        />
                    </td>
                </tr>
            </table>
<?php 
        }
    }