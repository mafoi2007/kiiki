<?php 
	$prof = $_SESSION['login'];
	$listeClasse = $config->listeClasseProf($prof);
	// echo '<pre>'; print_r($_SESSION); echo '</pre>';
	// echo '<pre>'; print_r($listeClasse); echo '</pre>';
?>
<h1 class='alert'>saisie des notes</h1>
		<form method='post' action=''>
			Classe : <select name='clas' id='clas' onChange='goAdd()'>
				<option value='null'>-Classe-</option>
				<?php 
					for($i=0;$i<count($listeClasse);$i++){
						echo "<option value='";
						echo $listeClasse[$i]['id_classe'];
						echo "'>".strtoupper($listeClasse[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			Matière : <div id='matiere' style = 'display:inline'>
				<select name='matiere'>
					<option value='null'>-choisir une matière-</option>
				</select>
				
			</div>
		</form>


<?php 

	if(isset($_POST['info'])){
		// echo '<pre>'; print_r($_POST);
		$classe = $_POST['clas'];
		$matiere = $_POST['matiere'];
		$sequence = $_POST['sequence'];
		/*D'abord, on s'assure que la matière est enregistrée dans la classe
		et que le prof a le droit de remplir lesidtes notes. */
		$verification = $config->verifMatiereClasseProf($prof,$classe,$matiere);
		// print_r($verification);
		if(!is_array($verification)){
			// echo 'Verification est vide';
			$_SESSION['message'] = "Matière non présente dans la classe";
			header('Location : '.$_SERVER['PHP_SELF']);
		}else{
			// On verifie ensuite que la Séquence est activée et valide.
			if($sequence==1 or 
				$sequence==2 or 
				$sequence==3 or 
				$sequence==4 or 
				$sequence==5 or 
				$sequence==6){
					
					$listeNote = $note->viewNote($classe, $sequence, $matiere);
					if(empty($listeNote)){
						require_once('formVideNt.php');
					}else{
						require_once('formFillNt.php');
					}
				
			}else {  // Sinon On Affiche un message d'erreur 
				$_SESSION['message'] = "Aucune Séquence Valide Choisie.";
				header('Location : '.$_SERVER['PHP_SELF']);
			}
			
			
			
			if(strlen($sequence)>1){
				
				
			}else{
				/*A présent, si les notes avaient été saisies, on les pré-remplit.
				Sinon on propose de les saisir tout simplement. */
				
				if(empty($listeNote)){
					
				}else{
					
				}
			}
		}
	}
?>