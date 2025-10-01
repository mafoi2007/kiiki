<h1 id='body3'>Préparer les listes</h1>



		<form method='post' action='' target ='_blank'>
			Année Précédente : <select name='anneeDepart' id='anneeDepart' onChange='goPrepa()'>
				<option value='null'>-Année Scolaire-</option>
				<?php 
					$oldYear = $config->listeAnnee('inactif');
					for($i=0;$i<count($oldYear);$i++){
						echo "<option value='";
						echo $oldYear[$i]['libelle_annee'];
						echo "'>".strtoupper($oldYear[$i]['libelle_annee'])."</option>";
					}
				?>
			</select>
			
			Classe Départ : <div id='sequence' style = 'display:inline'>
				<select name='sequence'>
					<option value='null'>-classe de départ-</option>
				</select>
				
			</div>
			
		</form>







<?php
	if(isset($_POST['info'])){ 
		$classeDepart = $_POST['classeDepart'];
		$classeBut = $_POST['classeBut'];
		// On gère le statut Redoublant ou Nouveau
		if($classeDepart==$classeBut){$statutEleve = 'R';}else{$statutEleve = 'N';}
		$anneeScolaire = str_replace(' ','',$_POST['anneeDepart']);
		$liste = $config->listeEleveOld($classeDepart, 'non_supprime', $anneeScolaire);
		// echo '<pre>';print_r($liste); echo '</pre>';
		/*echo "<pre>";print_r($_POST);echo "</pre>"; */?>
		<form method='post' action='../traitement.php' target='_blank'>
			<table border='1' width='100%'>
				<tr>
					<th>Année Scolaire Précédente : <font class='alert'><?php echo $_POST['anneeDepart'];?></font></th>
					<th>Classe de Départ : <font class='bien'><?php echo $_POST['classeDepart'];?></font></th>
					<th>Classe d'Arrivée : <font class='bien'><?php echo $_POST['classeBut'];?></font></th>
				</tr>
				<tr>
					<td colspan='2'>
						<?php 
						for($j=0;$j<count($liste);$j++){
							$nomEleve = strtoupper($liste[$j]['nom'])." ".ucwords($liste[$j]['prenom']);
							echo "<p><input 
										type='checkbox' 
										name = 'eleve[]'
										value='".$liste[$j]['id']."' />
									".$nomEleve."</p>";
						}
						?>
					</td>
					<input type='hidden' name='tableDepart' value='<?php echo $anneeScolaire; ?>' />
					<input type='hidden' name='classe' value='<?php echo $classeBut; ?>' />
					<input type='hidden' name='statut' value='<?php echo $statutEleve; ?>' />
					<td><input type = 'submit' name='PrepaListe' value='Transférer' /></td>
				</tr>
				
			</table>
		</form>
<?php	}





?>
