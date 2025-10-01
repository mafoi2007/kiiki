<h1 class='bien'>Liste des professeurs principaux</h1>
	
	<table border='1' width='90%'>
		<tr>
			<th>N°</th>
			<th>Classe</th>
			<th>Enseignant</th>
		</tr>
		<form method='post' action='../traitement.php' target = _blank>
		<?php 
		$conseil = $config->classePrincipale();
		if(!empty($conseil[0]['id'])){
			$i=1;
			for($a=0;$a<count($conseil);$a++){
				echo "<tr>
					<td>".$i."</td>
					<td>".strtoupper($conseil[$a]['nom_classe'])."</td>
					<td>".strtoupper($conseil[$a]['nom'])." 
						".ucwords($conseil[$a]['prenom'])."</td>
				</tr>";
				$i++;
			}
		}
		else{
			echo "<tr>
				<th colspan='3' class='alert'>Il n'y a pas encore de Prof Principal désigné. </th>
			</tr>";
		}
		?>
		<tr>
			<td colspan='3'>
			<input 
			type='hidden' 
			name='to_print' 
			value='ProfesseursPrincipaux' />
			<input 
				type='submit' 
				name='print' 
				value='Imprimer la liste des PP' />
			</td>
		</tr>
		</form>
		
	</table>