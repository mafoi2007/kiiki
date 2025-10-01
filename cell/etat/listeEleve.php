<h1 class='bien'>Liste des élèves</h1>
	
		<form method='post' action='../traitement.php' target='_blank'>
			<h4>Section de la Classe : <select name='section' id='section' onChange='listeEleve()'>
				<option value='null'>-Choisir Section-</option>
				<option value='fr'>Section Francophone</option>
				<option value='en'>Section Anglophone</option>
			</select></h4>
			
			<div id='niveau_classe' style = 'display:inline'>
				
			</div>
			
		</form>