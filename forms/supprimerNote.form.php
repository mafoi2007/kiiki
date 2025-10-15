<?php 
	$verification = $config->verifNoteSaisie($classe, $matiere, $sequence);
	// echo '<pre>'; print_r($verification); echo '</pre>';
	if(!empty($verification)){ ?>
<form method='post' action='../traitement.php' target='_blank'>
	<input 
		type='hidden'
		name='classe'
		value='<?php echo $_POST['classe']; ?>' />
	<input 
		type='hidden'
		name='matiere'	
		value='<?php echo $_POST['subject']; ?>' />
	<input 
		type='hidden'
		name='sequence'
		value='<?php echo $_POST['periode']; ?>' />
	<fieldset>
		<legend><h3 class='bien'>Suppression des Notes Séquentielles</h3></legend>
		<p>Vous êtes sur le point de supprimer les notes de 
		<font color='blue'><?php echo $nomMatiere['nom_matiere']; ?></font>
		en classe de <font color='blue'><?php echo $nomClasse['nom_classe']; ?></font> 
		pour le compte de la Séquence
		<font color='blue'><?php echo utf8_decode($nomSequence['nom_periode']); ?></font>.
		En êtes-vous sûrs ? 
		<input type='submit' name='deleteNote' value='Oui' />
		<input type='submit' name='deleteNote' value='Non' />
		
	</fieldset>
</form>
<?php 
	}else{
		echo "<h3 class='alert'>Vous n'avez pas encore saisi les notes de cette matière pour la classe.";
	}
?>


