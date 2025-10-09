<h1 class='bien'>Relevé de Notes de la classe</h1>
	
	<form method='post' action='../traitement.php' target='_blank'>
			Section de la Classe : <select name='section' id='section' onChange='ReleveEleve()'>
				<option value='null'>-Choisir Section-</option>
				<option value='fr'>Section Francophone</option>
				<option value='en'>Section Anglophone</option>
			</select>
			
			<div id='niveau_classe' style = 'display:inline'>
			</div>
		</form>