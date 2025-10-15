<?php 
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new config($db);
	// print_r($_POST);
	if(isset($_POST['nomClasse'])){
		$classe = (string) str_replace(' ','',$_POST['nomClasse']);
		// echo var_dump($classe);
		if(empty($classe)){
			$msg = "<h3 class='alert'>Saisissez au moins une valeur.</h3>";
			echo $msg;
		}else{
			$recherche = $config->rechercherClasse($classe);
			// echo '<pre>'; print_r($recherche); echo '</pre>';
			if(!empty($recherche)){ ?>
				<table border='1' width='70%' align='center'>
					<tr>
						<th>N°</th>
						<th>Nom de la classe</th>
						<th>Code de la classe</th>
						<th>Section</th>
						<th>Option</th>
					</tr>
					<?php 
					$x = 1;
					for($i=0;$i<count($recherche);$i++){ ?>
						<tr>
							<td align='center'><?php echo $x; ?></td>
							<td><?php echo utf8_decode($recherche[$i]['nom_classe']);?></td>
							<td><?php echo utf8_decode($recherche[$i]['code_classe']); ?></td>
							<td><?php echo $recherche[$i]['section']; ?></td>
							<td>
								<?php
								$url = $_SERVER['HTTP_REFERER'];
								$url .= '&amp;classe=';
								$url .= $recherche[$i]['id'];
								$url .= '#body3';
								?>
								<a href="<?php echo $url; ?>">
									Visualiser
								</a>
							</td>
						</tr>
					<?php 
					$x++;
					} ?>
				</table>
			<?php 	
			}else{
				$msg = "<h3 class='alert'>Aucune valeur Trouvée.</h3>";
				echo $msg;
			}
		}
	}
	/*
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		if($classe==0){
			$msg = "<h3 class='alert'>Choisissez une classe.</h3>";
			echo $msg;
		}else{
			$liste = $config->listeMatiereClasse($classe);
			$className = $config->getClasse($classe);
			// echo '<pre>'; print_r($liste); echo '</pre>'; ?>
			
			<table border='1' width='85%'>
				<tr>
					<th>Classe</th>
					<th>Matière</th>
					<th>Enseignant</th>
				</tr>
				<?php 
				for($i=0;$i<count($liste);$i++){ ?>
					<tr>
						<td>
							<input
								type='text'
								value="<?php echo $className['nom_classe']; ?>"
								disabled />
						</td>
						<td>
							<input 
								type ='hidden'
								<?php echo "name='matiere[".$i."]'"; ?>
								value="<?php echo $liste[$i]['id']; ?>" />
							<input 
								type ='text'
								readonly
								value="<?php echo $liste[$i]['nom_matiere']; ?>" />
						</td>
						<td>
							<?php echo "<select name='prof[".$i."]'>"; ?>
								<option value='' selected>-Choisir-</option>
								<?php 
								$gest = $config->viewGestionnaireAll('actif');
								for($a=0;$a<count($gest);$a++){
									$nomGest = $gest[$a]['nom_complet_enseignant'];
									$idGest = $gest[$a]['id'];
									echo "<option value='".$idGest."'>".$nomGest."</option>";
								}
								?>
							</select>
							<?php 
							
							
							?>
						</td>
					</tr>
				<?php 
				}
				?>
				<tr>
					<td colspan='3' align='center'>
						<input 
							type='submit' 
							name='updmatiereclasse'
							value='Enregistrer'
						/>
					</td>
				</tr>
			</table>
		<?php 
		}
	}*/