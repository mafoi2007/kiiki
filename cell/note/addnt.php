<h1 class='bien'>saisie des notes</h1>
		<form method='post' action='' target ='_blank'>
			Classe : <select name='clas' id='clas' onChange='goAdd()'>
				<option value='null'>-Classe-</option>
				<?php 
					$regions = $config->listeClasseProfClasse();
					for($i=0;$i<count($regions);$i++){
						echo "<option value='";
						echo $regions[$i]['id_classe'];
						echo "'>".strtoupper($regions[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			Matière : <div id='sequence' style = 'display:inline'>
				<select name='sequence'>
					<option value='null'>-choisir une matière-</option>
				</select>
				
			</div>
			<input type='submit' name='info' value='Ok' />
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