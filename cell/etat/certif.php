<h1 class='bien'>certificat de scolarité</h1>
	<form method='post' action='../traitement.php' target='_blank'>
		<p>Entrer le nom ou une partie du nom : 
		<input 
			type='text' 
			name='nomEleve'
			id='nomEleve'
			onKeyup='findEleve()' 
			placeholder='tapez la recherche' />
		</p>
		<div id='resultat' style = 'display:inline'>		
		</div>
	</form>