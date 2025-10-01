<?php
	function equadra()
		{
		if(isset($_POST['calculer']))
			{
			// On vérifie que toutes les valeurs ont été renseignées.
			if(empty($_POST['a']) or empty($_POST['b']) or empty($_POST['c']))
				{
				echo "<p>Il y a des données non renseignées dans votre équation.</p>";
				}
			elseif(!empty($_POST['a']) and !empty($_POST['b']) and !empty($_POST['c']))  //Si les données sont quand même renseignées, on les convertit en nombres flottants
				{
				$a = $_POST['a'];
				$b = $_POST['b'];
				$c = $_POST['c'];
				settype($a,"float");
				settype($b,"float");
				settype($c,"float");
				
				$delta = ($b * $b) - (4 * $a * $c);
				
				if($delta < 0)
					{
					echo "<p>Delta = ".$delta." , ce qui correspond à une valeur négative. L'équation n'admet donc pas de racines.</p>";
					}
				else
					{
					if($delta == 0)
						{
						$ixe = -($b) / (2*$a);
						echo "<p>Delta = ".$delta." , ce qui correspond à une valeur nulle. <br />
						La solution unique est X = ".$ixe."</p>"; 
						}
					else
						{
						if($delta > 0)
							{
							$ixe1 = (-$b - (sqrt($delta))) / (2 * $a);
							$ixe2 = (-$b + (sqrt($delta))) / (2 * $a);
							echo "<p>Delta = ".$delta." , ce qui correspond à une valeur positive. <br />
							L'équation admet deux solutions X<sub>1</sub> et X<sub>2</sub> :</p>";
							echo "<h4> X<sub>1</sub> = ".$ixe1." </h4>";
							echo "<h4> X<sub>2</sub> = ".$ixe2." </h4>";
							}
						else
							{
							echo "<p>Je ne sais pasq koi dire.</p>";
							}
						}
					}
				}
			}
		}
		
		
		
		
/**************************************************************************
**********************************************************************************
****************************************************************************************
***************************************************************************************/


function equadeux()
	{
	if(isset($_POST['calculer']))
		{
		echo "<p>Équation en cours de traitement.</p>";
		}
	
	}
