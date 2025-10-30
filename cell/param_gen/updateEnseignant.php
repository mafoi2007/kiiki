<div id='body3'>
    <h1 class='alert'>Mettre à jour un utilisateur</h1>
    <?php 
    if(isset($_GET['id'])){
        $prof = (int) urldecode($_GET['id']);
        $detailProf = $config->getUser($prof);
        if(empty($detailProf)){
            echo "<h3 class='alert'>L'utilisateur sollicité n'existe pas.</h3>";
        }else{ 
            $listePoste = $config->userType();
            ?>
        <form method='post' action='../traitement.php'>
            <table border='1' width='100%'>
                <tr>
                    <th>Libelle</th>
                    <th>Anc. Valeur</th>
                    <th>Nouv. Valeur</th>
                </tr>
                <tr>
                    <th>Nom </th>
                    <th><input type='text' size='40' value="<?php echo stripslashes($detailProf['nom']); ?>" disabled /></th>
                    <th>
                        <input 
                            type='text'
                            size='40'
                            name='userName'
                            id='userName'
                            value="<?php echo stripslashes($detailProf['nom']); ?>"
                            required />
                    </th>
                </tr>
				<tr>
                    <th>prenom </th>
                    <th><input type='text' size='40' value="<?php echo stripslashes($detailProf['prenom']); ?>" disabled /></th>
                    <th>
                        <input 
                            type='text'
                            size='40'
                            name='userfName'
                            id='userfName'
                            value="<?php echo stripslashes($detailProf['prenom']); ?>"
                            required />
                    </th>
                </tr>
                <tr>
                    <th>Sexe</th>
                   <th>
                        <select disabled>
                            <option><?php echo $detailProf['sexe']; ?></option>
                        </select>
                    </th>
                    <th>
                        <select name='userSex'>
                            <?php
                            echo "<option value='Mr'";
                            if($detailProf['sexe']=='M'){echo " selected";}
                            echo ">Masculin</option>";
                            echo "<option value='Mme'";
                            if($detailProf['sexe']=='Mme'){echo " selected";}
                            echo ">Féminin</option>";
                            ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th>Poste</th>
                    <th>
                        <select disabled>
                            <option><?php echo $detailProf['libelle_poste']; ?></option>
                        </select>
                    </th>
                    <th>
                        <select name='userPost'>
                            <?php 
                            for($i=0;$i<count($listePoste);$i++){
                                $option = "<option value='";
                                $option .= $listePoste[$i]['id'];
                                $option .= "' ";
                                if($detailProf['poste']==$listePoste[$i]['id']){
                                    $option .= "selected";
                                }
                                $option .= ">";
                                $option .= $listePoste[$i]['libelle_poste'];
                                $option .= "</option>";
                                echo $option;
                            }
                            ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th>Login </th>
                    <th><input type='text' value="<?php echo stripslashes($detailProf['login']); ?>" disabled /></th>
                    <th>
                        <input 
                            type='text'
                            name='userLogin'
                            id='userLogin'
                            value="<?php echo stripslashes($detailProf['login']); ?>"
                            required />
                    </th>
                </tr>
				 <tr>
                    <th>Contact </th>
                    <th><input type='text' value="<?php echo stripslashes($detailProf['contact']); ?>" disabled /></th>
                    <th>
                        <input 
                            type='text'
                            name='userContact'
                            id='userContact'
                            value="<?php echo stripslashes($detailProf['contact']); ?>"
                            required />
                    </th>
                </tr>
                <tr>                    
                    <th colspan='3'>
						Nom Complet Enregistré : 
							<input 
								type='text' 
								value="<?php echo stripslashes($detailProf['nom_complet_enseignant']); ?>" 
								size='40'
								disabled />
                        <input 
                            type='hidden' 
                            name='userId' 
                            id='userId' 
                            value="<?php echo $detailProf['id']; ?>" />
                    </th>
                </tr>
                <tr>
                    <td colspan='4' align='center'>
                        <input 
                            type='submit'
                            name='upd_utilisateur'
                            value='Mettre à Jour' />
                    </td>
                </tr>
            </table>
        </form>
<?php         }
    }
    ?>
</div>