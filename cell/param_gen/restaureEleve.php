<div id = 'body2'>
	<?php 
	if(isset($_GET['id'])){
		$eleve = $config->getEleve($_GET['id']); ?>
		
	<h1 class='alert'>Restauration de l'élève</h1>
	<form method='post' action='../traitement.php'>
		<h3>Voulez-vous vraiment retablir l'élève  : <font class='bien'>
		<?php echo $eleve['nom_complet'];?></font> dans les listes ?
		<input type='hidden' name='eleve' value="<?php echo $eleve['id'];?>" />
		<input type='submit' name='restaureEleve' value='oui' /> &nbsp; 
		<input type='submit' name='restaureEleve' value='non' /> &nbsp; 
		</h3>
	</form>


<?php 	}else{
	echo "<h3 class='alert'>Vous devez choisir un élève pour le supprimer.</h3>";
}
	?>
</div>