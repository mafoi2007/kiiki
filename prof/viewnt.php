<h1 class='alert'>Consulter ses notes séquentielles</h1>
		<form method='post' action='#3' target ='_blank'>
			Classe : <select name='clas' id='clas' onChange='goView()'>
				<option value='null'>-Classe-</option>
				<?php 
					$classes = $note->noteSaisieProf($_SESSION['login']);
					for($i=0;$i<count($classes);$i++){
						echo "<option value='";
						echo $classes[$i]['id_classe'];
						echo "'>".strtoupper($classes[$i]['nom_classe'])."</option>";
					}
				?>
			</select>
			
			<div id='matiere' style = 'display:inline'>
				
			</div>
			
		</form>










<?php 
	if(isset($_POST['info'])){ 
		$class = $config->getClasseCode($_POST['clas']);
		$matier = $config->getMatiereInfo($_POST['matiere']);
	
	?>
		<fieldset>
			<legend><h3 id ='3'>Informations</h3></legend>
				<p>Classe : 
					<input 
						type='text' 
						value='<?php echo $class['nom_classe']; ?>' 
						disabled />
					Matière : 
					<input 
						type='text' 
						value='<?php echo $matier['nom_matiere']; ?>' 
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
				<th>Côte</th>
				<th>Appréciation</th>
			</tr>
			<?php 
			// $listeEleve = $config->listeEleve($_POST['clas'], 'non_supprime');
			$listeNote = $note->viewNote($_POST['clas'],$_POST['sequence'],$_POST['matiere']);
			$a = 1;
			// echo '<pre>'; print_r($listeNote); echo '</pre>';
			for($i=0;$i<count($listeNote);$i++){
				$nomEleve = strtoupper($listeNote[$i]['nom']).' ';
				$nomEleve .= ucwords($listeNote[$i]['prenom']);
				if($listeNote[$i]['note_simple']=='0.00' or empty($listeNote[$i]['note_simple'])){
					$noteSimple = '';
					$cote ='-';
					$appreciation = '-';
					$color='white';
				}else{
					$noteSimple = $listeNote[$i]['note_simple'];
					$apprec = $note->showAppreciation($noteSimple);
					$cote = $apprec['cote'];
					$appreciation = $apprec['nom_appreciation'];
					$color = $apprec['couleur'];
				}
				
				echo "<tr>";
					echo "<td>".$a."</td>";
					echo "<td>".$nomEleve."</td>";
					echo "<td bgcolor='".$color."' align='center'>".$noteSimple."</font></td>";
					echo "<td bgcolor='".$color."' align='center'>".$cote."</td>";
					echo "<td bgcolor='".$color."'>".$appreciation."</td>";
				echo "</tr>";
				$a++;
			}
			
			/*for($i=0;$i<count($listeEleve);$i++){
				
				
				echo "<tr>
					<td>".$a."</td>
					<td>".$nomEleve." </td>";
					if($listeNote[$i]['id_eleve']==$listeEleve[$i]['id']){
						if($listeNote[$i]['note_simple']=='0.00'){
							echo "<td>&nbsp;</td>";
						}else{
							echo "<td>".$listeNote[$i]['note_simple']."</td>";
						}
						
						
						echo "<td>".$apprec['cote']."</td>";
						echo "<td>".$apprec['nom_appreciation']."</td>";
					}
				echo "</tr>";
				$a++;
			}*/
			?>
		</table>
<?php 	}