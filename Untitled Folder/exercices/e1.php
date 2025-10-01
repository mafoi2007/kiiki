
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
	<head>
		<title>Le son c'est, s'est, ces, ses, sais ...</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<article>
			<?php 
				if(!isset($_GET['exo']))// Quand on attérit sur la page, on propose par défaut la liste des exercices à faire
					{
			?>
			<form method='get' action=''>
				<p>Choisir le numero de l'exercice : 
					<select name='exo'>
						<option value='null'>N° de l'exercice</option>
						<option value='e1_1'>Exercice 1</option>
						<option value='e1_2'>Exercice 2</option>
						<option value='e1_3'>Exercice 3</option>
						<option value='e1_4'>Exercice 4</option>
					</select>
				</p>
				<p><input type='submit' value='Valider' />
			</form>
			<?php
					}
			?>
			
				
				
				
				
				<?php
				if(isset($_GET['exo'])) // On a déjà choisi le numero de l'exercice
					{
					
					if($_GET['exo']=='e1_1') // On a choisi de faire l'exercice 1, alors on le présente à l'élève.
						{
				?>
				<ul type='A'>
				<form method='post' action=''>
					
					<li><h3>Choisir entre les différents /S€/ <font color='red'> <i>10 pts</i></font></h3></li>
					<ul type='1'>
						<li><p><input type='text' name='rep1' size= '3' value="<?php if(isset($_POST['rep1'])) { echo $_POST['rep1']; }?>" /> à toi de jouer, il <input type='text' name='rep2' size= '3' value="<?php if(isset($_POST['rep2'])) { echo $_POST['rep2']; }?>" /> trompé de carte.</p></li>
						<li><p><input type='text' name='rep3' size= '3' value="<?php if(isset($_POST['rep3'])) { echo $_POST['rep3']; }?>" /> le sentier où j'ai vu trottiner l'âne et <input type='text' name='rep4' size= '3' value="<?php if(isset($_POST['rep4'])) { echo $_POST['rep4']; }?>" /> frères.</p></li>
						<li><p>Patricia m'a prêté <input type='text' name='rep5' size= '3' value="<?php if(isset($_POST['rep5'])) { echo $_POST['rep5']; }?>" /> disques de jazz, <input type='text' name='rep6' size= '3' value="<?php if(isset($_POST['rep6'])) { echo $_POST['rep6']; }?>" /> une chance !</p></li>
						<li><p>Il <input type='text' name='rep7' size= '3' value="<?php if(isset($_POST['rep7'])) { echo $_POST['rep7']; }?>" /> appliqué à illustrer  <input type='text' name='rep8' size= '3' value="<?php if(isset($_POST['rep8'])) { echo $_POST['rep8']; }?>" /> cahiers, <input type='text' name='rep9' size= '3' value="<?php if(isset($_POST['rep9'])) { echo $_POST['rep9']; }?>" /> derniers temps.</p></li>
						<li><p><input type='text' name='rep10' size= '3' value="<?php if(isset($_POST['rep10'])) { echo $_POST['rep10']; }?>" /> oiseaux-là sont familiers et confiants.</p></li>
						<p><input type='submit' name='e1_1' value="Fin de l'exercice A" /></p>
					</ul>
				</form>	
				<?php e1_1(); ?>
				
				
				
				
				<?php		
						}
					elseif($_GET['exo']=='e1_2') // On a choisi de faire l'exercice 2, alors on le présente à l'élève.
						{
				?>
				
				
				<li><h3>Choisir entre les différents /S€/ <font color='red'> <i>10 pts</i></font></h3></li>
				<form method='post' action=''>
					<ul type='1'>
						<li><p>Elle ne <input type='text' name='rep1' size= '3' value="<?php if(isset($_POST['rep1'])) { echo $_POST['rep1']; }?>" /> plus où sont <input type='text' name='rep2' size= '3' value="<?php if(isset($_POST['rep2'])) { echo $_POST['rep2']; }?>" /> affaires, tellement <input type='text' name='rep3' size= '3' value="<?php if(isset($_POST['rep3'])) { echo $_POST['rep3']; }?>" /> un fouillis!</p></li>
						<li><p><input type='text' name='rep4' size= '3' value="<?php if(isset($_POST['rep4'])) { echo $_POST['rep4']; }?>" /> lui le professeur de français.</p></li>
						<li><p>Il <input type='text' name='rep5' size= '3' value="<?php if(isset($_POST['rep5'])) { echo $_POST['rep5']; }?>" /> tu, n'ayant plus rien à dire.</p></li>
						<li><p>Si <input type='text' name='rep6' size= '3' value="<?php if(isset($_POST['rep6'])) { echo $_POST['rep6']; }?>" /> toi qui le  <input type='text' name='rep7' size= '3' value="<?php if(isset($_POST['rep7'])) { echo $_POST['rep7']; }?>" />, dis-le nous.</p></li>
						<li><p><input type='text' name='rep8' size= '3' value="<?php if(isset($_POST['rep8'])) { echo $_POST['rep8']; }?>" /> -tu ce que tu vas dire ?</p></li>
						<li><p>Il <input type='text' name='rep9' size= '3' value="<?php if(isset($_POST['rep9'])) { echo $_POST['rep9']; }?>" /> esquivé sur la pointe des pieds</p></li>
						<li><p><input type='text' name='rep10' size= '3' value="<?php if(isset($_POST['rep10'])) { echo $_POST['rep10']; }?>" /> notes, quand nous les donnera-t-il ?</p></li>
						<p><input type='submit' name='e1_2' value="Fin de l'exercice B" /></p>
					</ul>
				</form>
				<?php e1_2(); ?>
				
				
				
				
				
				<?php	
						}
					elseif($_GET['exo']=='e1_3') // On a choisi de faire l'exercice 3, alors on le présente à l'élève.
						{
				?>
				
				<li><h3>Choisir entre les différents /S€/ <font color='red'> <i>10 pts</i></font> </h3></li>
				<form method='post' action=''>
					<ul type='1'>
						<li><p>L'eau <input type='text' name='rep1' size= '3' value="<?php if(isset($_POST['rep1'])) { echo $_POST['rep1']; }?>" /> subitement colorée en bleu.</p></li>
						<li><p><input type='text' name='rep2' size= '3' value="<?php if(isset($_POST['rep2'])) { echo $_POST['rep2']; }?>" /> grâce à elle que j'ai pu apprendre l'anglais.</p></li>
						<li><p><input type='text' name='rep3' size= '3' value="<?php if(isset($_POST['rep3'])) { echo $_POST['rep3']; }?>" /> trop tard pour cette séance de cinéma, et pourtant il <input type='text' name='rep4' size= '3' value="<?php if(isset($_POST['rep4'])) { echo $_POST['rep4']; }?>" /> dépêché.</p></li>
						<li><p>Ce sont <input type='text' name='rep5' size= '3' value="<?php if(isset($_POST['rep5'])) { echo $_POST['rep5']; }?>" /> propres parents qui l'ont dit.</p></li>
						<li><p><input type='text' name='rep6' size= '3' value="<?php if(isset($_POST['rep6'])) { echo $_POST['rep6']; }?>" /> mon nouvel équipement sportif.</p></li>
						<li><p>Tu ne <input type='text' name='rep7' size= '3' value="<?php if(isset($_POST['rep7'])) { echo $_POST['rep7']; }?>" /> pas manoeuvrer cet engin.</p></li>
						<li><p>Le chasseur <input type='text' name='rep8' size= '3' value="<?php if(isset($_POST['rep8'])) { echo $_POST['rep8']; }?>" /> embusqué, et <input type='text' name='rep9' size= '3' value="<?php if(isset($_POST['rep9'])) { echo $_POST['rep9']; }?>" /> à l'aube qu'il a aperçu un lapin.</p></li>
						<li><p>Il <input type='text' name='rep10' size= '3' value="<?php if(isset($_POST['rep10'])) { echo $_POST['rep10']; }?>" /> caché chez les voisins.</p></li>
						<p><input type='submit' name='e1_3' value="Fin de l'exercice C" /> &nbsp; &nbsp;  </p>
					</ul>
				</form>
				<?php e1_3(); ?>
				
				
				
				
				
				<?php		
						}
					elseif($_GET['exo']=='e1_4') // On a choisi de faire l'exercice 4, alors on le présente à l'élève.
						{
						echo "<h3> Exercice en cours de conception.</h3>";
						}
					else // Le choix n'est pas pris en charge.
						{
						echo "<h3> Veuillez effectuer un choix valide.</h3>";
						}
					}
				?>
				
				
				
				</ul>
			
		</article>
	</body>
</html>
