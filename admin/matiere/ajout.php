<h1>Ajouter une matière</h1>







	<form method = "POST" action="../traitement.php">
		<p title="Le Nom de la Matière tel qu'il apparait dans le bulletin">
			Nom de la Matière : <input 
								type="text" 
								name="nom_matiere" 
								id="nom_matiere" 
								placeholder="Nom de la matière" 
								/>
		</p>
		<p>Code de la Matière : 
								<input 
								type="text" 
								name="code_matiere" 
								id="code_matiere" 
								placeholder="Code de la matière" 
								/>
		</p>
		
		<input type="submit" name="ajout_matiere" value="ajouter la matiere" />
	</form>
