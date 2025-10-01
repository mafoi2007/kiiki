<?php
	if(isset($_POST['calculer']))
		{
		//On vérifie si les données ne sont pas renseignées
		if(empty($_POST['a']) or empty($_POST['b']) or empty($_POST['c']))
			{
			echo "<p>Il y a des données non renseignées dans votre équation.</p>";
			}
		if(!empty($_POST['a']) and !empty($_POST['b']) and !empty($_POST['c']))  //Si les données sont quand même renseignées, on les convertit en nombres flottants
			{
			$a = $_POST['a'];
			$b = $_POST['b'];
			$c = $_POST['c'];
			settype($a,"float");
			settype($b,"float");
			settype($c,"float");
			
			
		// On calcule le discriminant delta = b au carré moins 4AC
		$delta = ($b * $b) - (4 * $a * $c);
		echo "<p> Delta = <b>".$delta. "</b>.</p>";
		if($delta < 0) // P(x) n'admet pas de racines.
			{
			echo "<p> P(x) n'admet donc pas de racines.</p>";
			}
		if($delta == 0) //P(x) admet une solution
			{
			//$x = 
			$ixe = -($b) / (2*$a);
			echo "<p>P(x) admet une racine : X = <b>".$ixe. "</b></p>";
			}
		if($delta >0) // P(x) admet deux solutions
			{
			$ixe1 = (-$b - (sqrt($delta))) / (2 * $a);
			$ixe2 = (-$b + (sqrt($delta))) / (2 * $a);
			echo "<p>P(x) admet deux solutions: <br /> X<sub>1</sub> = <b>".$ixe1. "</b><br /> X<sub>2</sub> = <b>".$ixe2. "</b></p>";
			}
			
			}
		
		
		
		}