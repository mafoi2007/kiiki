<h1 class='alert'>rechercher un élève</h1>
<form method='post' action='../traitement.php'>
	<p>
		Saisir le nom de l'élève : 
		<input 
			type='text' 
			name='eleve' 
			id='eleve' 
			onKeyup='findEleve()' />
	</p>
	<div id='resultat' style = 'display:inline'>
				
	</div>
</form>