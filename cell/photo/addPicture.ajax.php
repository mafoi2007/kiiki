<?php 
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new config($db);
	// echo '<pre>'; print_r($_SESSION['information']);
	$as = $config->getCurrentYear();
	
	if(isset($_POST['classe'])){
		$classe = $_POST['classe'];
		if($classe=='null'){
			echo "<h3 class='alert'>Vous devez sélectionner une classe.</h3>";
		}else{ 
			$listeEleve = $config->listeEleve($classe, 'non_supprime', $as);
			if(empty($listeEleve)){
				echo "<h3 class='alert'>Aucun élève dans la classe.</h3>";
			}else{
		?>
	<table border='01' width='70%'>	
		<tr>
			<th>N°</th>
			<th>Noms et Prénoms</th>
			<th>Photos</th>
		</tr>
		<?php 
		$a = 1;
		for($i=0;$i<count($listeEleve);$i++){ ?>
			<tr>
				<td><?php echo $a;?></td>
				<td><?php echo $listeEleve[$i]['nom_complet']?></td>
				<td>
					<input 
						type='hidden' 
						name='eleve[]' 
						value='<?php echo $listeEleve[$i]['id'];?>' />
					<input 
						type='file'
						name='photo[]'
						/>
				</td>
			</tr>
<?php 		
			$a++;
		}
		?>
		<tr>
			<td colspan='5' align='center'>
				<input 
					type="submit" 
					name="addPhotoEleve" 
					value="Ajouter Photo" />
			</td>
		</tr>
	</table>
<?php 	
			}		
		}
	}
?>