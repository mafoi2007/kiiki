<form method='post' action='../traitement.php' target='_blank'>
    <fieldset>
        <legend><h3>Informations de Base</h3></legend>
        <h3>Nom de l'élève :
            <font class='alert'>
                <?php echo strtoupper($infoEleve['nom_complet']); ?>
                <input type='hidden' name='eleve' value='<?php echo $infoEleve['id']; ?>' />
            </font>
        </h3>
        <h3>Classe de l'élève :
            <font class='alert'>
                <?php echo strtoupper($infoClasse['nom_classe']); ?>
                <input type='hidden' name='classe' value='<?php echo $infoClasse['id'];?>' />
            </font>
        </h3>
        <h3>Séquence :
            <font class='alert'>
                Séquence <?php echo strtoupper($sequence); ?>
                <input type='hidden' name='sequence' value='<?php echo $sequence;?>' />
            </font>
        </h3>
    </fieldset>
    <table border='1' width='80%'>
        <tr>
            <th>N°</th>
            <th>Matière</th>
            <th>Anc. Valeurs</th>
            <th>Nouvelles Notes</th>
            <th>Annuler la Note</th>
        </tr>
        <?php 
        $a = 1;
        for($i=0;$i<count($valeurs);$i++){ ?>
            <tr>
                <td><?php echo $a; ?></td>
                <td>
                    <?php echo strtoupper($valeurs[$i]['nom_matiere']); ?>
                    <input 
                        type='hidden' 
                        name='codeMatiere[]'
                        value='<?php echo $valeurs[$i]['id']; ?>' />
                </td>
                <td>
                    <input 
                        type='text'
                        value='<?php echo $valeurs[$i]['note']; ?>'
                        disabled
                        size='5' />
                </td>
                <td>
                    <input 
                        type='number'
                        size='5'
                        step = '0.01'
                        min='0.25'
                        max = '20'
                        name='note[]'
                        value='<?php echo $valeurs[$i]['note']; ?>'
                    />
                </td>
                <td>
                    <input 
                        type='checkbox'
                        name='annuler[]'
                        value='<?php echo $valeurs[$i]['id']; ?>'
                    />
            </tr>
        <?php 
        $a++;
        } ?>
        <tr>
            <td align='center' colspan='5'>
                <input type='submit' name='revendic' value='Valider'/>
            </td>
        </tr>
    </table>