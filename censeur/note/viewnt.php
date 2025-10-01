<h1 class='alert'>Consulter ses notes séquentielles</h1>
		<form method='post' action='#3' target ='_blank'>
			Classe : <select name='clas' id='clas' onChange='goView()'>
				<option value='null'>-Classe-</option>
				<?php 
					$classes = $note->verifNoteSaisieClasse();
					for($i=0;$i<count($classes);$i++){
						echo "<option value='";
						echo $classes[$i]['id_classe'];
						echo "'>".strtoupper($classes[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			Matière : <div id='matiere' style = 'display:inline'>
				<select name='matiere'>
					<option value='null'>-choisir une Matière-</option>
				</select>
				
			</div>
			
		</form>










<?php 
	if(isset($_POST['info'])){ ?>
		<fieldset>
			<legend><h3 id ='3'>Informations</h3></legend>
				<p>Classe : 
					<input 
						type='text' 
						value='<?php echo $_POST['clas']; ?>' 
						disabled />
					Matière : 
					<input 
						type='text' 
						value='<?php echo $_POST['matiere']; ?>' 
						disabled />
					Période : 
					<input 
						type='text' 
						value='Séquence <?php echo $_POST['sequence']; ?>' 
						disabled />
		</fieldset>
		<table border='1' width='90%'>
			<tr>
				<th>N°</th>
				<th>Noms et Prénoms</th>
				<th>Note /20</th>
				<th>Coef</th>
				<th>Produit</th>
				<th>Appréciation</th>
			</tr>
		<?php 
			$cls = $_POST['clas'];
			$mat = $_POST['matiere'];
			$per = $_POST['sequence'];
			$listeNote = $note->viewNote($cls,$per,$mat);
			// $conseil = $config->listeMatiereClasse($cls);
			echo '<pre>';
			// print_r($conseil);
			echo '</pre>';
			$a = 1;
			for($i=0;$i<count($listeNote);$i++){
				$nom = strtoupper($listeNote[$i]['nom']);
				$nom .= ' '.ucwords($listeNote[$i]['prenom']);
				if($listeNote[$i]['note_simple']=='0.00'){
					$pt = '';
				}
				else{
					$pt = $listeNote[$i]['note_simple'];
				}
				
				$conseil = $config->listeMatiereClasse($cls);
				for($j=0;$j<count($conseil);$j++){
					if($conseil[$j]['id_matiere']==$mat){
						$coef = $conseil[$j]['coef'];
					}
				}
				if($pt==''){
					$produit='';
					$coef='';
				}else{
					$produit = $note->genereProduit($pt,$coef);
				}
				
				$appreciation = $note->showAppreciation($pt);
				echo "<tr>
					<td>".$a."</td>
					<td>".$nom."</td>
					<td align='center'><font color='";
					echo $appreciation['couleur']."'>".$pt."</font></td>
					<td align='center'><font color='";
					echo $appreciation['couleur']."'>".$coef."</font></td>
					<td align='center'><font color='";
					echo $appreciation['couleur']."'>".$produit."</font></td>
					<td><font color='";
					echo $appreciation['couleur']."'>";
					echo ucwords(utf8_decode($appreciation['nom_appreciation']));
					echo "</font></td>
				</tr>";
				$a++;
			}
		?>
		</table>
<?php 	}