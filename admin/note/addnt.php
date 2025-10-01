<h1>Insérer une note séquentielle</h1>
<?php /*echo '<pre>'; print_r($_SERVER); */?>

<form method='post' action='#nt'>
	<p>Classe : 
		<select name='classe'>
			<option value=''>-choisir classe-</option>
			<?php 
				$listeClasse = $config->listeClasseProfClasse();
				for($i=0;$i<count($listeClasse);$i++){
					echo "<option value='";
					echo $listeClasse[$i]['id_classe'];
					echo "'>";
					echo $listeClasse[$i]['nom_classe'];
					echo "</option>";
				}
			?>
		</select> &nbsp; &nbsp; 
	
	Matière : 
		<select name='matiere'>
			<option value=''>-choisir matière-</option>
			<?php 
				$listeMatiere = $config->listeMatiereProfClasse();
				for($i=0;$i<count($listeMatiere);$i++){
					echo "<option value='";
					echo $listeMatiere[$i]['id_matiere'];
					echo "'>";
					echo $listeMatiere[$i]['nom_matiere'];
					echo "</option>";
				}
			?>
		</select>
	</p>
	<p>
		Période :
		<select name='periode'>
			
			<?php 
			$listePeriode = $config->viewPeriode();
			for($i=0;$i<count($listePeriode);$i++){
				echo "<option value='".$listePeriode[$i]['id']."'>
				".$listePeriode[$i]['nom_periode']."</option>";
			}?>
		</select> &nbsp; &nbsp; &nbsp; 
		<input type='submit' name='info' value='Ok' />
	</p>
		
</form>

<?php 
	if(isset($_POST['info'])){
		/* Le formulaire a été validé. La Première chose à faire est de
		vérifier que la matière et la classe sont présentes dans la
		Table Prof_Classe.
		Ensuite, il faut vérifier que les notes n'ont pas
		encore été entrées dans la table note. Si c'est le cas on informe
		par Js et on affiche lesdites notes avec option de modification.*/
		
		$verif = $config->verifMatiere($_POST['classe'],$_POST['matiere']);
		// echo '<pre>'; print_r($verif); echo '</pre>';
		if(!is_array($verif)){
			// La matière n'existe pas pour la classe
			$_SESSION['message'] = 'Matière inexistante pour la classe.';
			header('Location:'.$_SERVER['PHP_SELF']);
		}
		else{
			// La matière existe effectivement pour la classe
			/*Si les notes ont déjà été entrées, on propose de les modifier;
			sinon on propose leur saisie simple*/
			$listeNote = $note->viewNote($_POST['classe'],
										$_POST['periode'],
										$_POST['matiere']);
			if(!is_array($listeNote)){ // Les Notes ne sont pas saisies
				require_once('formVideNt.php');
			}
			else{
				require_once('formFillNt.php');
			}
		}
	}
	
	
?>

