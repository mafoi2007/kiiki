<form method='post' action='../traitement.php'>
	<input type='hidden' name='matiere' value='<?php echo $matiere; ?>' />
	<input type='hidden' name='classe' value='<?php echo $classe; ?>' />
	<input type='hidden' name='periode' value='<?php echo $sequence; ?>' />
	
	
	<fieldset>
		<legend><h3 class='bien'>Saisie des Notes</h3></legend>
		
		<p>Classe : <input type='text' value='<?php echo $classe;?>' disabled />
		Matière : <input type='text' value='<?php echo $matiere;?>' disabled />
		Période : <input 
						type='text' 
						value='Séquence <?php echo $sequence; ?>' disabled />
		<b class='alert'><blink>Attention!!! Le 00/20 ne coefficie pas la note.</blink></b>
		</p>
	</fieldset>
	 
		
	<table border='1' width='40%' align='center'>
		<caption>
			<b>Enoncé de la Compétence :</b>
			<textarea name='competence'>Write Competence</textarea>
		</caption>
		<tr>
			<th>N°</th>
			<th>Noms et Prénoms</th>
			
			<th>Note /20</th>
		</tr>
		<?php 
		$listeEleve = $config->listeEleve($classe, 'non_supprime');
		$v=1;
		// echo '<pre>';print_r($listeEleve);
		for($x=0;$x<count($listeEleve);$x++){
			echo "<tr>
				<td>".$v."</td>
				<td>".strtoupper($listeEleve[$x]['nom'])." 
						".ucwords($listeEleve[$x]['prenom'])."</td>
				<input type='hidden' name='eleve[]' value='".$listeEleve[$x]['id']."' />
				
				<td align='center'>
					<input type ='text' name='note[]' size='4' maxlength='5' />
				</td>
			</tr>";
			$v++;
		}
		?>
		<tr>
			<td colspan='5' align='center'>
				<input type='submit' name='addnt' value='Enregistrer'/>
			</td>
		</tr>
		
	</table>
</form>