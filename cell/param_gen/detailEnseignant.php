<div id="body3">
   <?php 
   if(isset($_GET['id'])){
        $prof = (int) urldecode($_GET['id']);
        $detailProf = $config->getUser($prof);
        if(empty($detailProf)){
            echo "<h3 class='alert'>L'utilisateur sollicité n'existe pas.</h3>";
        }else{ ?>
        <table border='1' width='75%'>
			<tr>
				<th colspan='5'>
					Détail sur l'utilisateur
				</th>
			</tr>
            <tr>
                <th>Nom de l'utilisateur</th>
                <th class='bien'><?php echo stripslashes($detailProf['nom_complet_enseignant']); ?></th>
            </tr>
            <tr>
                <th>Titre</th>
                <th class='bien'><?php echo $detailProf['sexe']; ?></th>
            </tr>
            <tr>
                <th>Poste</th>
                <th class='bien'><?php echo $detailProf['libelle_poste']; ?></th>
            </tr>
            <tr>
                <th>Login</th>
                <th class='bien'><?php echo stripslashes($detailProf['login']); ?></th>
            </tr>
			<tr>
                <th>Contact</th>
                <th class='bien'><?php echo stripslashes($detailProf['contact']); ?></th>
            </tr>
        </table>
<?php         }
        // echo '<pre>';print_r(detailProf); echo '</pre>';
   }
   ?>
</div>