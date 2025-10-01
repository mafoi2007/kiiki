<?php
	
	
		
/*****************************************************************************************************************
******************************************************************************************************************
******************************************************************************************************************
****																										  ****
****							FONCTIONS RELATIVES À L'ADMINISTRATEUR									      ****
****																							              ****
******************************************************************************************************************
******************************************************************************************************************
*****************************************************************************************************************/


	
/******************************************************************************
La fonction qui définit les périodes séquentielles
*******************************************************************************/


function definir_periode()
	{
	if(isset($_POST['def_periode']))
		{
		$debut_seq[1] = $_POST['annee_sd1']."-".$_POST['mois_sd1']."-".$_POST['jour_sd1'];
		$debut_seq[2] = $_POST['annee_sd2']."-".$_POST['mois_sd2']."-".$_POST['jour_sd2'];
		$debut_seq[3] = $_POST['annee_sd3']."-".$_POST['mois_sd3']."-".$_POST['jour_sd3'];
		$debut_seq[4] = $_POST['annee_sd4']."-".$_POST['mois_sd4']."-".$_POST['jour_sd4'];
		$debut_seq[5] = $_POST['annee_sd5']."-".$_POST['mois_sd5']."-".$_POST['jour_sd5'];
		$debut_seq[6] = $_POST['annee_sd6']."-".$_POST['mois_sd6']."-".$_POST['jour_sd6'];
		
		$fin_seq[1] = $_POST['annee_sf1']."-".$_POST['mois_sf1']."-".$_POST['jour_sf1'];
		$fin_seq[2] = $_POST['annee_sf2']."-".$_POST['mois_sf2']."-".$_POST['jour_sf2'];
		$fin_seq[3] = $_POST['annee_sf3']."-".$_POST['mois_sf3']."-".$_POST['jour_sf3'];
		$fin_seq[4] = $_POST['annee_sf4']."-".$_POST['mois_sf4']."-".$_POST['jour_sf4'];
		$fin_seq[5] = $_POST['annee_sf5']."-".$_POST['mois_sf5']."-".$_POST['jour_sf5'];
		$fin_seq[6] = $_POST['annee_sf6']."-".$_POST['mois_sf6']."-".$_POST['jour_sf6'];
		
		
		for($i=1;$i<=6;$i++)
			{
			$sql = "INSERT INTO periode VALUES('','Séquence $i','$debut_seq[$i]','$fin_seq[$i]')";
			mysql_query($sql) or die(mysql_error());
			}
		echo "<h3 class='alert'> Les périodes séquentielles ont été définies.</h3>";
		}
	}
	
	


/******************************************************************************
La fonction qui CONSULTE les périodes séquentielles
*******************************************************************************/

function consulter_periode()
	{
	$sql = "SELECT nom_periode AS periode, DATE_FORMAT(date_ouvert, '%d / %m  / %Y')AS  ouverture, 
					DATE_FORMAT(date_fermet, '%d / %m / %Y') AS fermeture FROM periode";
	$req = mysql_query($sql) or die(mysql_error());
	
	
	echo "<table border='1' width='100%'>";
		echo "<tr>";
			echo "<th>";
				echo "Nom de la Période";
			echo"</th>";
			echo "<th>";
				echo "Date d'ouverture";
			echo"</th>";
			echo "<th>";
				echo "Date de Fermeture";
			echo"</th>";
		echo "</tr>";
	while($res = mysql_fetch_array($req))
		{
		echo "<tr align='center'>";
			echo "<td>";
				echo $res['periode'];
			echo "</td>";
			echo "<td>";
				echo $res['ouverture'];
			echo "</td>";
			echo "<td>";
				echo $res['fermeture'];
			echo "</td>";
		echo "</tr>";
		}
	echo "</table>";
	}



/************************************************************************************************	
************************************************************************************************
************************************************************************************************
************************************************************************************************
La classe CORBEILLE qui s'occupe de la gestion des éléments supprimés de la BD	
************************************************************************************************	
************************************************************************************************
************************************************************************************************
*************************************************************************************************/
function corbeille_eleve()
	{
	
	}
	
	




	
	
	



function corbeille_matiere()
	{
	
	
	if(isset($_GET['cat']) and isset($_GET['dec']) and isset($_GET['mat']) and $_GET['cat']='matiere')
		{
		echo "<h3 class='alert'>Espace en construction.</h3>";
		}
	}
	
	








function corbeille_gestionnaire()
	{
	
	
	// Après avoir listé les utilisateurs, on propose maintenant de les supprimer ou de les restaurer.
	if(isset($_GET['cat']) and isset($_GET['dec']) and isset($_GET['mat']) and $_GET['cat']='gestionnaire')
		{
		if($_GET['dec']== "rest") // On a choisi de restaurer
			{
			$mat = urldecode($_GET['mat']);
			$req = "UPDATE enseignant SET etat = 'actif' WHERE id = '$mat'";
			mysql_query($req) or die(mysql_error());
			echo "<h4 class='bien'> Le gestionnaire a bien été restauré.</h4>";
			}
		elseif($_GET['dec']== "suppr") // On a choisi de supprimer définitivement
			{
			$mat = urldecode($_GET['mat']);
			$req = "DELETE FROM enseignant WHERE id = '$mat'";
			mysql_query($req) or die(mysql_error());
			echo "<h4 class='bien' title = 'plus moyen de récupérer'> Le gestionnaire a été supprimé définitivement de la Base de Données.</h4>";
			}
		else
			{
			echo "<h4 class='alert'>L'application ne prend pas en charge votre choix.</h4>";
			}
		}
	}
