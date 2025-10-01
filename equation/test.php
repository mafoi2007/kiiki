<?php
	if(isset($_POST['calculer']))
		{
		//On vérifie si les données ne sont pas renseignées
		if($_POST['a']==NULL or $_POST['b']==NULL or $_POST['c']==NULL)
			{
			echo "<p>Il y a des données non renseignées dans votre équation.</p>";
			}
		if($_POST['a']!=NULL and $_POST['b']!=NULL and $_POST['c']!=NULL)  //Si les données sont quand même renseignées, on les convertit en nombres flottants
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
		elseif($delta = 0) //P(x) admet une solution
			{
			//$x = 
			$ixe = -($b) / (2*$a);
			echo "<p>Delta = ".$delta. " P(x) admet une racine : X = ".$ixe. "</p>";
			}
		elseif($delta >0) // P(x) admet deux solutions
			{
			$ixe1 = (-$b - (sqrt($delta))) / (2 * $a);
			$ixe2 = (-$b + (sqrt($delta))) / (2 * $a);
			echo "<p>Delta = ".$delta. ". P(x) admet deux solutions: <br /> X1 = ".$ixe1. "<br /> X2 = ".$ixe2. "</p>";
			}
			
			}
		
		
		
		}