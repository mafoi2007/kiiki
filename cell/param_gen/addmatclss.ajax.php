<?php 
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new config($db);
	print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = (int)$_POST['classe'];
        if($classe==0){
            echo "<h3 class='alert'>Vous devez choisir une classe.</h3>";
        }else{ 
			$nomClasse = $config->getClasse($classe);
		?>
           <h3 class='alert'>Classe de : <?php echo $nomClasse['nom_classe']; ?></h3>
		   <table border='0' width='75%' align='center'>
				<tr>
					<th>N°</th>
					<th>Nom de la Matière</th>
					<th>Coefficient</th>
					<th>Groupe</th>
				</tr>
				<?php 
				$listeMatiere = $config->listeMatiereAll('actif');
				$groupe = $config->getGroupe();
				// echo '<pre>';print_r($groupe);
				if(count($listeMatiere)==0){
					echo "<tr>
						<td colspan='4' align='center'>
							<h3 class='alert'>Aucune Matière Enregistrée</h3></td>
					</tr>";
				}else{
					$x = 1;
					for($a=0;$a<count($listeMatiere);$a++){
						echo "<tr>";
							echo "<td align='center'>".$x."</td>";
							echo "<td>".strtoupper($listeMatiere[$a]['nom_matiere'])."
							<input 
								type='hidden' 
								name='matiere[]' 
								value='".$listeMatiere[$a]['id']."' /></td>";
							echo "<td><input 
										type='number' 
										name='coef[]'
										size='4'
										step='0.01'
										max='10'
										/>
							</td>";
							echo "<td>
							<select name='groupe[]'>";
								for($b=0;$b<count($groupe);$b++){
									echo "<option value='".$groupe[$b]['id']."'>".$groupe[$b]['nom_groupe']."</option>";
								}
								echo "<option value='null' selected>-Choisir le groupe-</option>";
							echo "</select>
							</td>";
						echo "</tr>";
						$x++;
					}
				}
				?>
				<tr>
					<td colspan='4' align='center'>
						<input
							type='submit'
							name='addmatclss'
							value='Ajouter les matières' />
					</td>
				</tr>
		   </table>
		   
		   
<?php 		   
        }
	}