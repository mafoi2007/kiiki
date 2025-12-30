<h1 class='bien'>Importation des notes</h1>
<?php 
$listeSequence = $config->viewPeriode();
 ?>
		<form method='post' action='../traitement.php' enctype='multipart/form-data' target ='_blank'>
			Séquence : 
            <select name='sequence' id='sequence' onChange='getClasseImport()'>
                <?php 
                for($i=0;$i<count($listeSequence);$i++){
                    $idPer = $listeSequence[$i]['id'];
                    $nomPer = utf8_decode($listeSequence[$i]['nom_periode']);
                    echo "<option value='".$idPer."'>".$nomPer."</option>";
                } ?>
                <option value='null' selected>-Choisir une séquence-</option>
            </select>
            <div id='classe' style = 'display:inline'>
			</div>
		</form>


<?php 

	if(isset($_POST['info'])){
		// echo '<pre>'; print_r($_POST);
		$classe = $_POST['clas'];
		$matiere = $_POST['matiere'];
		$sequence = $_POST['sequence'];
		
		// D'abord, on s'assure que la matière est enregistrée dans la classe.
		$verif = $config->verifMatiere($classe,$matiere);
		if(!is_array($verif)){
			$_SESSION['message'] = 'Matière inexistante pour la classe.';
			header('Location:'.$_SERVER['PHP_SELF']);
		}else{
			// Si les notes avaient déjà été saisies, on les affiche avec option de modification. Sinon 
			$listeNote = $note->viewNote($classe, $sequence, $matiere);
						
			if(empty($listeNote)){
				require_once('formVideNt.php');
			}else{
				require_once('formFillNt.php');
			}
		}
	}