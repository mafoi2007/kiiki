<div id='body2'>
    <h1 class='alert'>restaurer un utilisateur</h1>
    <?php 
    if(isset($_GET['id'])){
       $user = (int) urldecode($_GET['id']);
        $detailUser = $config->getUser($user);
        if(empty($detailUser)){
            echo "<h3 class='alert'>L'utilisateur' sollicité n'existe pas.</h3>";
        }else{ 
            ?>
        <form method='post' action='../traitement.php'>
            <h4>Vous avez choisi de restaurer l'utilisateur <?php echo $detailUser['nom']; ?>.
            En êtes -vous sûr ? 
            <input 
                type='hidden' 
                name='user' 
                value='<?php echo $detailUser['id']; ?>' />
            <input 
                type='submit' 
                name='restaureUser' 
                id='restaureUser'
                value='oui' />  
            <input 
                type='submit' 
                name='restaureUser' 
                id='restaureUser'
                value='non' />
        </form>
<?php         }
    }
    ?>
</div>