<div id='body3'>
    <h1 class='alert'>supprimer un utilisateur</h1>
    <?php 
    if(isset($_GET['id'])){
        $user = (int) urldecode($_GET['id']);
        $detailUser = $config->getUser($user);
        if(empty($detailUser)){
            echo "<h3 class='alert'>L'utilisateur sollicité n'existe pas.</h3>";
        }else{ 
            ?>
        <form method='post' action='../traitement.php'>
            <h4>Vous avez choisi de supprimer l'utilisateur <?php echo $detailUser['nom']; ?>.
            En êtes -vous sûr ? 
            <input 
                type='hidden' 
                name='user' 
                value='<?php echo $detailUser['id']; ?>' />
            <input 
                type='submit' 
                name='delUser' 
                id='delUser'
                value='oui' />  
            <input 
                type='submit' 
                name='delUser' 
                id='delUser'
                value='non' />
        </form>
<?php         }
    }
    ?>
</div>