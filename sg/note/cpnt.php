<h1 class='alert'>Copie des notes</h1>
		<form method='post' action='' target ='_blank'>
			Classe : <select name='clas' id='clas' onChange='goCp()'>
				<option value='null'>-Classe-</option>
				<?php 
					$classes = $note->noteSaisieProfClasse($_SESSION['login']);
					for($i=0;$i<count($classes);$i++){
						echo "<option value='";
						echo $classes[$i]['classe'];
						echo "'>".strtoupper($classes[$i]['nom_classe'])."</option>";
					}
					/*
					
						
						
						
					}*/
				?>
			</select>
			
			Matière : <div id='matiere' style = 'display:inline'>
				<select name='matiere'>
					<option value='null'>-choisir une Matière-</option>
				</select>
				
			</div>
		</form>


<?php 

	if(isset($_POST['info'])){
		// echo '<pre>'; print_r($_POST); echo '</pre>';
		$classe = $_POST['clas'];
		$matiere = $_POST['matiere'];
		$sequence = $_POST['sequence'];
		// On vérifie que les notes existent en machine 
		$verification = $note->viewNote($classe, $sequence, $matiere);
		// print_r($verification);
		if(empty($verification)){
			$_SESSION['message'] = 'Pas de Notes pour la Séquence et la Matière choisies';
			header('Location:'.$_SERVER['PHP_SELF']);
		}else{ ?>
			<form method='post' action='../traitement.php'>
				
				<fieldset>
					<legend><h3 class='alert'>Reconduction de Notes.</h3></legend>
					<input type ='hidden' name='classe' value='<?php echo $classe; ?>' />
					<input type ='hidden' name='matiere' value='<?php echo $matiere; ?>' />
					<input type ='hidden' name='sequence_depart' value='<?php echo $sequence; ?>' />
					<h3>Reconduire les notes de la Classe de
						<select disabled>
							<option><?php echo $classe; ?></option>
						</select> en
						<select disabled>
							<option><?php echo $matiere; ?></option>
						</select> de la 
					Séquence 
						<select disabled>
							<option>Séquence <?php echo $sequence; ?></option>
						</select>
					 pour la Séquence 
						<select name='sequence_cible'>
							<?php 
							$listeSeq = $config->periodeCourante();
							for($i=0;$i<count($listeSeq);$i++){
								echo "<option value='";
								echo $listeSeq[$i]['id'];
								echo "'>".$listeSeq[$i]['nom_periode']."</option>";
							}
							?>
						</select>
						
						<input type='submit' name='cpnt' value='Copier' />
					</h3>
				</fieldset>
			</form>



<?php 		}
	}
?>