<h1 id='body3'>Préparer les listes</h1>
	<form method='post' action='' target ='_blank'>
		Année Précédente :
			<select name='anneeDepart' id='anneeDepart' onChange='goPrepa()'>
				<option value='null'>-Année Scolaire-</option>
				<?php 
				$oldYear = $config->listeAnnee('inactif');
				for($i=0;$i<count($oldYear);$i++){
					$libelle = str_replace(' ', '',$oldYear[$i]['libelle_annee']);
					$libelle = str_replace('/', '-',$libelle);
					$id = $oldYear[$i]['libelle_annee'];
					echo "<option value='".$libelle."'>".$id."</option>";
				}
				?>
			</select>
		<div id='sequence' style='display:inline'>
		</div>
	</form>
		



<?php
	if(isset($_POST['info'])){
		// echo '<pre>'; print_r($_POST); echo '</pre>';
		$classeDepart = $config->getClasse($_POST['classeDepart']);
		$classeBut = $config->getClasse($_POST['classeBut']);
		$anneeScolaire = $_POST['anneeDepart'];
		// print_r($classeDepart);
		// On gère le statut Redoublant ou Nouveau
		if($classeDepart['id']==$classeBut['id']){$statutEleve = 'R';}else{$statutEleve = 'N';}
		$liste = $config->listeEleveOld($classeDepart['id'], 'non_supprime', $anneeScolaire);
		// echo '<pre>'; print_r($liste); echo '</pre>'; ?>
		
		<form method='post' action='../traitement.php' target='_blank'>
			<table border='1' width='100%'>
				<tr>
					<th>
						Année Scolaire Précédente : 
						<font class='alert'>
							<?php echo $anneeScolaire;?>
						</font>
					</th>
					<th>
						Classe de Départ : 
						<font class='bien'>
							<?php echo $classeDepart['nom_classe'];?>
						</font>
					</th>
					<th>
						Classe d'Arrivée : 
						<font class='bien'>
							<?php echo $classeBut['nom_classe'];?>
						</font>
					</th>
				</tr>
				<tr>
					<td colspan='2'>
						<?php 
						for($i=0;$i<count($liste);$i++){
							$nomEleve = $liste[$i]['nom_complet'];
							$idEleve = $liste[$i]['id'];
							echo "<p><input 
								type='checkbox'
								name='eleve[]'
								value='".$idEleve."' />";
							echo $nomEleve."</p>";
						}
						?>
					</td>
					<input 
						type='hidden' 
						name='tableDepart' 
						value='<?php echo $anneeScolaire; ?>' />
					<input 
						type='hidden' 
						name='classe' 
						value='<?php echo $classeBut['id']; ?>' />
					<input 
						type='hidden' 
						name='statut' 
						value='<?php echo $statutEleve; ?>' />
					<td>
						<input 
							type = 'submit' 
							name='PrepaListe' 
							value='Transférer' />
					</td>
				</tr>
			</table>
		</form>
<?php	
	}
?>
