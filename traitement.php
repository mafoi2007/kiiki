<?php 
	session_start();
	require_once('inc/connect.inc.php');
	require_once('xlsx_writer/xlsxwriter.class.php');
	
	$config = new config($db);
	$gestionnaire = new gestionnaire($db);
	$note = new note($db);
	$source = $_SERVER['HTTP_REFERER'];
	$writer = new XLSXWriter();
	
	$_SESSION['appName'] = appName;
	$_SESSION['appVersion'] = appVersion;
	$_SESSION['appContact'] = appContact;
	$_SESSION['appSlogan'] = appSlogan;
	
	
	// Authentification de l'utilisateur 
	if(isset($_POST['connexion'])){
		/*echo '<pre>';
		print_r($_POST);
		echo '</pre>';*/
		$config->connectUser($source, $_POST['login'], $_POST['mdp']);
	}
	
	
	
	
	
	
	
	
	
	// L'utilisateur courant veut changer son mot de passe
	if(isset($_POST['changer_mdp'])){
		echo '<pre>';print_r($_POST);echo '</pre>';
		$config->updateMotDePasse($source,
										$_POST['mdp_ancien'],
										$_POST['nouveau_mdp'],
										$_POST['mdp_confirm'],
										$_SESSION['idUser']);
	}
	
	
	
	
	
	
	
	
	
	// On veut réinitialiser le mot de passe perdu ou oublié
	if(isset($_POST['reset_mdp'])){
		echo '<pre>';print_r($_POST);echo '</pre>';
		$config->resetMotDePasse($source,
										$_POST['nouveau_mdp'],
										$_POST['mdp_confirm'],
										$_POST['idUser']);
	}
	
	
	
	
	// L'utilisateur courant veut changer sa photo de profil
	if(isset($_POST['ajout_photo'])){
		echo '<pre>';print_r($_POST);echo '</pre>';
		$config->setPhoto($source, 
							$_SESSION['idUser']);
	}
	
	
	
	
	
	
	
	
	
	// On ajoute les photos des élèves pour une classe 
	if(isset($_POST['addPhoto'])){
		// echo '<pre>';print_r($_POST);echo '</pre>';
		// echo '<pre>';print_r($_FILES);echo '</pre>';
		$eleve = $_POST['eleve'];
		$matricule = $_POST['matricule'];
		$imageName = $_FILES['photo']['name'];
		$imageType = $_FILES['photo']['type'];
		$imageTmpName = $_FILES['photo']['tmp_name'];
		$imageError = $_FILES['photo']['error'];
		$imageSize = $_FILES['photo']['size'];
		// echo '<pre>';print_r($infoImage);echo '</pre>';
		for($i=0;$i<count($imageName);$i++){
			if(!empty($imageName[$i])){
				$idEleve = $eleve[$i];
				$idMatricule = $matricule[$i];
				$name = $imageName[$i];
				$type = $imageType[$i];
				$tmpName = $imageTmpName[$i];
				$error = $imageError[$i];
				$size = $imageSize[$i];
				$image = array('name'=>$name,
								'type'=>$type,
								'tmp_name'=>$tmpName,
								'error'=>$error,
								'size'=>$size);
				$config->addPhotoEleve($source, $idEleve, $idMatricule, $image);
			}
		}
		/*$config->addPhotoEleve($source, $eleve, $matricule);*/
	}
	
	
	
	
	
	
	
	/********************************************
	*********************************************
	*********************************************
			Configuration des élèves		
	**********************************************
	**********************************************
	*********************************************/
	
	if(isset($_REQUEST['ajout_eleve'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		
		$config->ajouterEleve($source,
								$_REQUEST['rne'],
								$_REQUEST['matricule'],
								$_REQUEST['nom'],
								$_REQUEST['prenom'],
								$_REQUEST['sexe'],
								$_REQUEST['date_naissance'],
								$_REQUEST['lieu_naiss'],
								$_REQUEST['nom_pere'],
								$_REQUEST['nom_mere'],
								$_REQUEST['classe'],
								$_REQUEST['adresse'],
								$_REQUEST['redoublant'],
								$_REQUEST['numero']);
	}
	
	
	
	
	
	
	
	
	
	if(isset($_POST['PrepaListe'])){
		/*echo '<pre>';
		print_r($_REQUEST);
		echo '</pre>';*/
		$eleve = $_REQUEST['eleve'];
		$info = array('eleve'=>$eleve, 
					'annee'=>$_POST['tableDepart'],
					'classe'=>$_POST['classe'],
					'statut'=>$_POST['statut']);
		$config->transfererEleve($source, $info);
	}
	
	
	
	
	
	
	
	
	
	if(isset($_REQUEST['maj'])){
		$source = $_SERVER['HTTP_REFERER'];
		$choix = $_REQUEST['maj'];
		// On veut supprimer l'élève 
		if($choix=='Supprimer'){
			$config->supprimerEleve($_POST['idEleve']);
		}
		elseif($choix=='Mettre à jour'){
			echo '<pre>';
			print_r($_REQUEST);
			$update = $_REQUEST;
			$config->updEleve($update);
		}
		elseif($choix=='ReActiver'){
			$config->RestaurerEleve($_POST['idEleve']);
		}
		header('Location:'.$source);
	}
	
	
	// On met à jour un élève 
	if(isset($_POST['updEleve'])){
		// echo '<pre>'; print_r($_POST); echo '</pre>';
		$eleve = $_POST;
		$var1 = '?action=updateEleve&';
		$var2 = 'id='.$_POST['idEleve'];
		$source = str_replace($var1,'',$source);
		$source = str_replace($var2,'',$source);
		$config->updateEleve($source, $eleve);
	}
	
	
	
	// On supprime un élève 
	if(isset($_POST['delEleve'])){
		// echo '<pre>'; print_r($_POST); echo '</pre>';
		$eleve = $_POST;
		$var1 = '?action=deleteEleve&';
		$var2 = 'id='.$eleve['eleve'];
		$source = str_replace($var1,'',$source);
		$source = str_replace($var2,'',$source);
		if($eleve['delEleve']=='non'){
			$_SESSION['message'] = 'L élève ne sera pas supprimé';
			header('Location:'.$source);
		}elseif($eleve['delEleve']=='oui'){
			$config->deleteEleve($source, $eleve['eleve']);
		}
	}
	
	
	
	
	if(isset($_POST['restaureEleve'])){
		echo '<pre>'; print_r($_POST); echo '</pre>';
		$eleve = $_POST;
		$var1 = '?action=restaureEleve&';
		$var2 = 'id='.$eleve['eleve'];
		$source = str_replace($var1,'',$source);
		$source = str_replace($var2,'',$source);
		if($eleve['restaureEleve']=='non'){
			$_SESSION['message'] = 'L élève ne sera pas retabli';
			header('Location:'.$source);
		}elseif($eleve['restaureEleve']=='oui'){
			$config->restaureEleve($source, $eleve['eleve']);
		}
	}
	
	
	if(isset($_REQUEST['majClasse'])){
		$choix = $_REQUEST['majClasse'];
		echo $choix;
		// On veut supprimer la classe 
		if($choix=='Supprimer'){
			echo '<pre>';
			print_r($_REQUEST);
			$config->supprimerClasse($source, $_REQUEST['idClasse']);
		}
		elseif($choix=='Mettre à jour'){
			$config->updClasse($source, 
							$_REQUEST['idClasse'],
							$_REQUEST['nom_classe'],
							$_REQUEST['code_classe'],
							'actif',
							$_REQUEST['niveau']);
		}
		elseif($choix=='ReActiver'){
			echo '<pre>';
			print_r($_REQUEST);
			$config->RestaurerClasse($source, $_REQUEST['idClasse']);
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*********************************************
	***************************************************
	**********************************************
	***		Configuration des classes		************
	********************************************
	***********************************************
	****************************************************/
	
	if(isset($_REQUEST['ajout_classe'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		
		$config->ajouterClasse($source,
								$_REQUEST['nom_classe'],
								$_REQUEST['code_classe'],
								$_REQUEST['niveau_classe'],
								$_REQUEST['section']);
	}
	
	
	
	
	if(isset($_REQUEST['addpp'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		$config->ajouterProfPrincipal($source,
										$_REQUEST['cls'], 
										$_REQUEST['prof']);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*********************************************
	**********************************************
	********************************************
	******		Configuration des matières		************
	*******************************************
	***********************************************
	***********************************************/
	
	if(isset($_REQUEST['ajout_matiere'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		
		$config->ajouterMatiere($source,
								$_POST['nom_matiere'],
								$_POST['code_matiere']);
	}
	
	
	
	
	if(isset($_REQUEST['majMatiere'])){
		$choix = $_REQUEST['majMatiere'];
		echo '<pre>';print_r($_POST); echo '</pre>';
		echo $choix;
		// On veut supprimer la classe 
		if($choix=='Supprimer'){
			$config->supprimerMatiere($source, $_REQUEST['idMatiere']);
		}
		elseif($choix=='Mettre à jour'){
			$config->updMatiere($source, 
							$_REQUEST['idMatiere'],
							$_REQUEST['nom_matiere'],
							$_REQUEST['code_matiere'],
							'actif');
		}
		elseif($choix=='ReActiver'){
			$config->RestaurerMatiere($source, $_REQUEST['idMatiere']);
		}
	}
	
	
	
	
	if(isset($_REQUEST['updmatiereclasse'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		
		$config->addProfClasse($source, 
								$_POST['matiere'],
								$_POST['prof'],
								$_POST['cls']);
	}
	
	
	
	
	
	
	
	
	if(isset($_REQUEST['delmatiereclasse'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		
		$config->delProfClasse($source, 
								$_POST['idMatiere']);
	}
	
	
	
	
	
	
	
	
	
	/********************************************
	*********************************************
	************************************************
			Configuration des gestionnaires		********************
	*************************************************
	*******************************************
	*********************************************/
	if(isset($_REQUEST['ajout_gestionnaire'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		
		$config->ajouterGestionnaire($source,
								$_POST['nom'],
								$_POST['prenom'],
								$_POST['sexe'],
								$_POST['poste'],
								$_POST['login'],
								$_POST['mdp'],
								$_POST['mdp_confirm']);
	}
	
	// On met à jour un utilisateur 
		if(isset($_POST['upd_utilisateur'])){
			echo '<pre>'; print_r($_POST); echo '</pre>';
			$utilisateur = $_POST;
			$var1 = '?action=update&';
			$var2 = 'id='.$_POST['userId'];
			$source = str_replace($var1,'',$source);
			$source = str_replace($var2,'',$source);
			$config->updateUtilisateur($source, $utilisateur);
		}
	
	
	
	// On supprime un utilisateur 
		if(isset($_POST['delUser'])){
			echo '<pre>'; print_r($_POST); echo '</pre>';
			$utilisateur = $_POST;
			$var1 = '?action=delete&';
			$var2 = 'id='.$utilisateur['user'];
			$source = str_replace($var1,'',$source);
			$source = str_replace($var2,'',$source);
			if($utilisateur['delUser']=='non'){
				$_SESSION['message'] = 'L utilisateur ne sera pas supprimé';
				header('Location:'.$source);
			}elseif($utilisateur['delUser']=='oui'){
				$config->deleteUser($source, $utilisateur['user']);
			}
			
		}
	
	// On restaure un utilisateur 
		if(isset($_POST['restaureUser'])){
			echo '<pre>'; print_r($_POST); echo '</pre>';
			$user = $_POST;
			$var1 = '?action=restaure&';
			$var2 = 'id='.$user['user'];
			$source = str_replace($var1,'',$source);
			$source = str_replace($var2,'',$source); 
			if($user['restaureUser']=='non'){
				$_SESSION['message'] = 'L utilisateur ne sera pas restauré.';
				header('Location:'.$source);
			}elseif($user['restaureUser']=='oui'){
				$config->restaureUser($source, $classe['user']);
			}
		}
	
	if(isset($_REQUEST['majProf'])){
		$choix = $_REQUEST['majProf'];
		echo $choix;
		// On veut supprimer le prof 
		if($choix=='Supprimer'){
			echo '<pre>';
			print_r($_REQUEST);
			$config->supprimerEnseignant($source, $_REQUEST['idProf']);
		}
		elseif($choix=='Mettre à jour'){
			$config->updEnseignant($source, $_REQUEST['idProf'],
							$_REQUEST['nom'],
							$_REQUEST['prenom'],
							$_REQUEST['sexe'],
							$_REQUEST['poste'],
							$_REQUEST['login']);
		}
		elseif($choix=='ReActiver'){
			echo '<pre>';
			print_r($_REQUEST);
			$config->RestaurerEnseignant($source, $_REQUEST['idProf']);
		}
		
		
		
		
		
		
		
		
		
		
		
		/*$source = $_SERVER['HTTP_REFERER'];
		$choix = $_REQUEST['majProf'];
		// On veut supprimer l'élève 
		if($choix=='Nommer'){
			$config->nommerEnseignant($_POST['idEnseignant'],$_POST['poste']);
		}
		elseif($choix=='Mettre à jour'){
			echo '<pre>';
			print_r($_REQUEST);
			
		}
		header('Location:'.$source);*/
	}
	
	
	
	
	
	
	
	
	
	
	
	/***************************************
	********************************************************
	*******************************************************
			Configuration des périodes			********************
	************************************************
	**************************************************
	***********************************************/
	
	if(isset($_REQUEST['activer'])){
		// echo '<pre>';
		// print_r($_REQUEST);
		$sequence = $_POST['sequence'];
		$nbJour = $_POST['nbjour'];
		if($sequence=='null' or $nbJour=='null'){
			$_SESSION['message'] = 'Valeur de Séquence et/ou de nombre de jours non précisée';
			header('Location:'.$source);
		}
		else{
			$config->ouvrirPeriode($source, $sequence, $nbJour);
		}
	}
	
	
	
	
	
	
	
	
	
	if(isset($_REQUEST['desactiver'])){
		// echo '<pre>';
		// print_r($_REQUEST);
		$sequence = $_POST['sequence'];
		if($sequence=='null'){
			$_SESSION['message'] = 'Valeur de Séquence non précisée';
			header('Location:'.$source);
		}
		else{
			$config->fermerPeriode($source, $sequence);
		}
	}
	
	
	
	
	
	
	
	
	
	if(isset($_REQUEST['createDate'])){
		echo '<pre>';
		print_r($_REQUEST);
		echo '</pre>';
		$dates = $_REQUEST['periode'];
		$opDate = $_REQUEST['openD'];
		$clDate = $_REQUEST['closeD'];
		for($i=0;$i<count($dates);$i++){
			$config->createDateAbsence($source, $dates[$i], $opDate[$i], $clDate[$i]);
		}
	}
	
	
	
	
	
	
	
	/**********************************************
	************************************************
	******************************************
		Configuration spécifique			********************
	*********************************************
	************************************************
	*****************************************/
	
	if(isset($_REQUEST['addmatcls'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		$config->addMatClasse($source,
								$_POST['classe'],
								$_POST['matiere'],
								$_POST['coef'],
								$_POST['groupe']
								);
	}
	
	
	
	
	
	
	
	
	if(isset($_REQUEST['addmatclss'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		$classe = $_REQUEST['classe'];
		$listeMatiere = $_REQUEST['matiere'];
		$listeCoef = $_REQUEST['coef'];
		$listeGroupe = $_REQUEST['groupe'];
		for($i=0;$i<count($listeMatiere);$i++){
			if($listeCoef[$i]=='null' or $listeGroupe[$i]=='null'){
				echo 'Rien à faire';
			}
			else{
				echo "<p>La matière ".$listeMatiere[$i];
				echo " a pour coef ".$listeCoef[$i]." dans le Groupe ".$listeGroupe[$i]." </p>";
				$config->addMatClasse($source,
								$_REQUEST['classe'],
								$listeMatiere[$i],
								$listeCoef[$i],
								$listeGroupe[$i]);
			}
		}
	}
	
	
	
	
	/**************************************
	************************************************
	*********************************************
			TRAITEMENT DES NOTES GLE			********************
	**************************************************
	*****************************************
	**********************************************/
	
	
	/*On veut enregistrer les notes saisies*/
	if(isset($_REQUEST['addnt'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		$note->ajouterNote($source, 
							$_POST['classe'],
							$_POST['matiere'],
							$_POST['periode'],
							$_POST['eleve'],
							$_POST['note'],
							$_POST['competence']
							);
	}
	
	
	
	/*On veut modifier les notes saisies */
	if(isset($_REQUEST['updnt'])){
		$source = $_SERVER['HTTP_REFERER'];
		$matiere = $_POST['matiere'];
		$sequence = $_POST['periode'];
		$competence = $_POST['competence'];
		$eleve = $_POST['eleve'];
		$classe = $_POST['classe'];
		$oldNote = $_POST['oldNote'];
		$newNote = $_POST['newNote'];
		/*echo '<pre>';
		print_r($_REQUEST);*/
		$note->modifierNote($source, $classe, $matiere, $sequence, 
							$competence, $eleve, $oldNote, $newNote);
	}
	
	
	
	
	/* On veut supprimer les notes de la Séquence pour la classe et la matière */
	if(isset($_REQUEST['delnt'])){
		echo '<pre>';
		print_r($_REQUEST);
		echo '</pre>';
		$note->supprimerNote($source,
								$_POST['clas'],
								$_POST['sequence'],
								$_POST['matiere']);
	}
	
	
	
	/* On veut copier les notes d'une séquence à l'autre */
	if(isset($_REQUEST['cpnt'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		echo '</pre>';
		$note->copierNote($source, 
							$_POST['matiere'],
							$_POST['classe'],
							$_POST['sequence_depart'],
							$_POST['sequence_cible']);
	}
	
	
	
	
	if(isset($_REQUEST['TraiterNoteSequentielle'])){
		$source = $_SERVER['HTTP_REFERER'];
		echo '<pre>';
		print_r($_REQUEST);
		$note->traiterNoteSequence($source,
									$_POST['sekence'],
									$_POST['clas']);
	}
	
	
	
	
	if(isset($_REQUEST['TraiterMoyenneSequentielle'])){
		echo '<pre>';
		print_r($_REQUEST);
		$note->traiterMoyenneSequence($source,
									$_POST['sekence'],
									$_POST['clas']);
	}
	
	
	
	
	
	
	if(isset($_REQUEST['TraiterNoteTrimestrielle'])){
		/*echo '<pre>';
		print_r($_REQUEST);*/
		$trimestre = $_POST['trimestre'];
		$classe = $_POST['clas'];
		if($classe=='null' or $trimestre=='null'){
			$_SESSION['message'] = 'La Classe et/ou le Trimestre doivent être renseignés.';
			header('Location:'.$source);
		}else{
			$note->traiterNoteTrimestre($source, $trimestre, $classe);
		}
	}
	
	
	
	
	
	
	
	
	
	if(isset($_REQUEST['TraiterMoyenneTrimestrielle'])){
		$source = $_SERVER['HTTP_REFERER'];
		$trimestre = $_POST['trimestre'];
		$classe = $_POST['clas'];
		echo '<pre>';
		print_r($_REQUEST);
		$note->traiterMoyenneTrimestre($source, $trimestre, $classe);
		echo '</pre>';
	}
	
	
	
	
	
	
	
	// Traitement des Notes Annuelles
	
	if(isset($_REQUEST['TraiterNoteAnnuelle'])){
		$source = $_SERVER['HTTP_REFERER'];
		$class = $_POST['classe'];
		if($class=='null'){
			$_SESSION['message'] = 'Choisir une classe';
			header('Location:'.$source);
		}else{
			$note->TraiterNoteAnnuelle($source, $class);
		}
		
	}
	
	
	
	
	
	
	/***************************************************************
	*****************  EXPORTATION EXCEL   *************************
	***************************************************************/
	if(isset($_POST['export'])){
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		// Liste des Elèves par classe
		if($_POST['to_export']=='listeEleve'){
			$object = $_POST['classe'];
			$liste = $config->listeEleve($object,'non_supprime');
			$info = $config->getNavigateur();
			$fileName="downloads/";
			$fileName .= "listeEleve_".$object.".xlsx";
			
			$titre[] = array('N°','Matricule','Nom et Prénom','Sexe','Statut',
								'Date de Naissance','Lieu de Naissance');
			$a = 1;
			for($i=0;$i<count($liste);$i++){
				$sousTitre = array($a,$liste[$i]['rne'],$liste[$i]['nom'].' '.$liste[$i]['prenom'],
									$liste[$i]['sexe'],$liste[$i]['statut'],$liste[$i]['date_fr'],
									$liste[$i]['lieu_naissance']);
				$titre[] = $sousTitre;
				$a++;
			}
			$writer->writeSheet($titre);
			$writer->writeToFile($fileName);
			$_SESSION['message'] = "Exportation Réussie. ";
			$_SESSION['message'] .= "Vérifiez ".addslashes($fileName);
			header('Location:downloads/');
		}
		
		
		// Liste Globale des Elèves 
		if($_POST['to_export']=='listeEleveAll'){
			$liste = $config->listeEleveAll('non_supprime');
			// echo '<pre>'; print_r($liste);
			$fileName="downloads/";
			$fileName .= "Liste_Globale_des_Eleves.xlsx";
			$titre[] = array('N°','Matricule','Nom et Prénom','Sexe',
							'Statut','Date de Naissance','Lieu de Naissance','Classe');
			$a = 1;
			for($i=0;$i<count($liste);$i++){
				$sousTitre = array($a,$liste[$i]['rne'],$liste[$i]['nom'].' '.$liste[$i]['prenom'],
									$liste[$i]['sexe'],$liste[$i]['statut'],$liste[$i]['date_fr'],
									$liste[$i]['lieu_naissance'],$liste[$i]['nom_classe']);
				$titre[] = $sousTitre;
				$a++;
				
			}
			$writer->writeSheet($titre);
			$writer->writeToFile($fileName);
			$_SESSION['message'] = 'Listes Globales exportées.';
			$_SESSION['message'] .= ' Verifiez '.addslashes($fileName);
			header('Location:downloads/');
		}
		
		
		// Notes Annuelles des Elèves 
		if($_POST['to_export']=='notesAnnuelles'){
			if($_POST['classe']=='null'){
				$_SESSION['message'] = 'Choisir une Classe';
				header('Location:'.$source);
			}else{
				$codeClasse = $_POST['classe'];
				$nom_classe = $config->viewNomClasse($codeClasse);
				$nomClasse = $nom_classe['nom_classe'];
				$bullEleve = $note->bulletinAnnuel($codeClasse);
				$listeMatiere = $config->listeMatiereClasse($codeClasse);
				// echo '<pre>'; print_r($_SERVER); echo '</pre>';
				$fileName="downloads/";
				$fileName.= "Notes_Annuelles_".str_replace(' ','_',$nomClasse).".xlsx";
				$titre[0] = array('N°','Matricule','Nom et Prénom','Sexe','Classe',
								'Trim 1','Trim 2','Trim 3','Annuel');
				// On prépare l'entête de notre Fichier Excel 
				for($i=0;$i<count($listeMatiere);$i++){
					$idMatiere = $listeMatiere[$i]['id_matiere'];
					$champNote[] = $idMatiere.'_ann';
					$matiere[] = $idMatiere;
					$titre[0][] = $idMatiere;
				}
				$j = 1;
				for($a=0;$a<count($bullEleve);$a++){
					$matriculeEleve = $bullEleve[$a]['rne'];
					$nomEleve = $bullEleve[$a]['nom_eleve'];
					$sexeEleve = $bullEleve[$a]['sexe'];
					$classeEleve = $nomClasse;
					$titre[$j] = array($j,$matriculeEleve,$nomEleve,$sexeEleve,$classeEleve);
					$k=9;
					for($b=0;$b<count($champNote);$b++){
						$valeurChamp = $champNote[$b];
						$titre[$j][5] = $bullEleve[$a]['moyenne_1'];
						$titre[$j][6] = $bullEleve[$a]['moyenne_2'];
						$titre[$j][7] = $bullEleve[$a]['moyenne_3'];
						$titre[$j][8] = $bullEleve[$a]['moyenne'];
						$titre[$j][$k] = $bullEleve[$a][$valeurChamp];
						$k++;
					}
					$j++;
				}
				$writer->writeSheet($titre);
				$writer->writeToFile($fileName);
				$_SESSION['message'] = 'Notes Annuelles exportées. ';
				$_SESSION['message'] .= 'Vérifiez '.addslashes($fileName);
				header('Location:downloads/');
			}
		}
	}
	
	
	
	/*if(isset($_REQUEST['export'])){
		// On veut exporter les notes annuelles 
			echo '<pre>'; print_r($_POST); echo '</pre>';
			$classe = $_POST['classe'];
			if($classe=='null'){
				$_SESSION['message'] = 'Choisir une classe.';
				header('Location:'.$source);
			}else{
				$note->exportExcel($source, $classe);
			}	
	}*/
	
	
	
	
	
	
	
	
	
	if(isset($_REQUEST['TraiterMoyenneAnnuelle'])){
		$source = $_SERVER['HTTP_REFERER'];
		$class = $_REQUEST['classe'];
		if($class=='null'){
			$_SESSION['message'] = 'Choisir une classe';
			header('Location:'.$source);
		}else{
			$note->TraiterMoyenneAnnuelle($source, $class);
		}
	}
	
	
	
	
	
	
	
	
	
	if(isset($_REQUEST['statDuProf'])){
		echo '<pre>';
		print_r($_REQUEST);
		echo '<pre>';
		$classe = $_POST['clas'];
		$matiere = $_POST['matiere'];
		$sequence = $_POST['sequence'];
		$stat = $note->statDuProf($classe,$_SESSION['login'],$matiere,$sequence);
		$_SESSION['print'] = 'statNoteProf';
		$_SESSION['matiere'] = $matiere;
		$_SESSION['classe'] = $classe;
		$_SESSION['sequence'] = $sequence;
		$_SESSION['stat'] = $stat;
		
		// print_r($_SESSION);
		header('Location:print_pdf_landscape.php');
	}
	
	
	
	
	/***************************************
	******************************************
	********************************************
					GENERATION DE PDF			
	********************************************
	********************************************
	********************************************/
	
	
	
	
	
	if(isset($_POST['print'])){
		$print = $_POST['to_print'];
		echo '<pre>'; print_r($_POST); echo '</pre>';
		$as = $config->getCurrentYear();  // Année Scolaire en Cours
		
		// On édite le certificat de scolarité 
		if($_POST['to_print']=='certificatScol'){
			if(!$_POST['eleve']){
				$_SESSION['message'] = 'Vous devez choisir un élève';
				header('Location:'.$source);
			}else{
				$eleve = $config->getEleve($_POST['eleve']);
				$section = $config->getSectionclasse($eleve['classe']);
				$_SESSION['eleve'] = $eleve;
				$_SESSION['classe']['section'] = $section;
				$_SESSION['print'] = 'certificatScol';
				// echo var_dump($eleve);
				header('Location:print_pdf.php');
			}
			
		}
		
		
		
		
		
		
		
		
		/*---------------------------------------------------------
		------------------------------------------------------------
		-----------------------------------------------------------
		On veut imprimer la liste des élèves
		-------------------------------------------------------------
		-----------------------------------------------------------*/
		if($_POST['to_print']=='listeEleve'){
			$classe = $_POST['classe'];
				if($classe=='null'){
					$_SESSION['message'] = 'Vous devez choisir une classe.';
					header('Location:'.$source);
				}else{
					$listeEleve = $config->listeEleve($_POST['classe'], 'non_supprime', $as );
					$nbValue = count($listeEleve); // Si ça vaut 0, y'a pas d'élèves dans la classe.
					if($nbValue===0){
						$_SESSION['message'] = 'Classe sans élèves.';
						header('Location:'.$source);
					}else{
						$section = $config->getSectionClasse($classe);
						$_SESSION['classe']['information'] = $_SESSION['information'];
						$_SESSION['classe']['eleve'] = $listeEleve;
						$_SESSION['classe']['section'] = $section;
						$_SESSION['classe']['stat'] = $config->listeEleveStat($_POST['classe'], 'non_supprime', $as);
						$_SESSION['print'] = 'listeEleve';
						header('Location:print_pdf.php');
					}
				}			
		}
		/*---------------------------------------------------------
		------------------------------------------------------------
		-----------------------------------------------------------
		On veut imprimer les relevés de notes
		-------------------------------------------------------------
		-----------------------------------------------------------*/ 
		elseif($_POST['to_print']=='ReleveNote'){
			$classe = $_POST['object'];
				if($classe=='null'){
					$_SESSION['message'] = 'Vous devez choisir une classe.';
					header('Location:'.$source);
				}else{
					$listeEleve = $config->listeEleve($classe, 'non_supprime', $as );
					$nbValue = count($listeEleve); // Si ça vaut 0, y'a pas d'élèves dans la classe.
					// print_r($listeEleve);
					if($nbValue===0){
						$_SESSION['message'] = 'Classe sans élèves.';
						header('Location:'.$source);
					}else{
						$section = $config->getSectionClasse($classe);
						$_SESSION['classe']['information'] = $_SESSION['information'];
						$_SESSION['classe']['eleve'] = $listeEleve;
						$_SESSION['classe']['section'] = $section;
						$_SESSION['classe']['stat'] = $config->listeEleveStat($classe, 'non_supprime', $as);
						$_SESSION['print'] = 'releveNote';
						header('Location:print_pdf.php');
					}
				}
		}
		/*---------------------------------------------------------
		------------------------------------------------------------
		-----------------------------------------------------------
		On veut imprimer la liste des professeurs principaux
		-------------------------------------------------------------
		-----------------------------------------------------------*/ 
		elseif($_POST['to_print']=='ProfesseursPrincipaux'){
			$liste =$config->classePrincipale();
			$_SESSION['liste'] = $liste;
			$_SESSION['print'] = 'ProfesseursPrincipaux';	
			// echo '<pre>';print_r($liste);
			header('Location:print_pdf.php');	
		}
		/*---------------------------------------------------------
		------------------------------------------------------------
		-----------------------------------------------------------
		On veut imprimer le conseil de classe
		-------------------------------------------------------------
		-----------------------------------------------------------*/ 
		elseif($_POST['to_print']=='ConseilClasse'){
			$object = $_POST['object'];
			if($object=='null'){
				$_SESSION['message'] = 'Aucune Classe sélectionnée.';
				header('Location:'.$_SERVER['HTTP_REFERER']);
			}
			else{
				$liste = $config->conseilDeClasse($object);
				$_SESSION['liste'] = $liste;
				$_SESSION['print'] = 'ConseilClasse';
				// echo '<pre>';print_r($liste);
				header('Location:print_pdf.php');
			}
		}
		/*---------------------------------------------------------
		------------------------------------------------------------
		-----------------------------------------------------------
		On veut visualiser les notes séquentielles
		-------------------------------------------------------------
		-----------------------------------------------------------*/ 
		// 
		elseif($_POST['to_print']=='VisualiserNoteSequentielle'){
			// On veut visualiser les notes séquentielles 
			// echo '<pre>'; print_r($_POST); echo '</pre>';
			$classe = $_POST['clas'];
			$sequence = $_POST['sequence'];
			if($classe=='null' or $sequence=='null'){
				$_SESSION['message'] = 'Aucune Valeur transmise.';
				header('Location:'.$source);
			}else{
				// On stocke les données dans une table particulère
				$resultat = $note->viewNoteSequentielle($sequence, $classe);
				
				// Ensuite on extrait ces données pour l'affichage PDF ou XML 
				$export = $note->exportNoteSequence($sequence, $classe);
				// echo '<pre>'; print_r($export); echo '</pre>';
				$listeMatiere = $config->listeMatiereClasse($classe);
				
				$listeEleve = $config->listeEleve($classe,'non_supprime');
				
				$nomClasse = $config->viewNomClasse($classe);
				// echo '<pre>'; print_r($listeEleve);
				
				
				
				$_SESSION['matiere'] = $listeMatiere;
				$_SESSION['note'] = $export['eleve'];
				$_SESSION['eleve'] = $listeEleve;
				$_SESSION['nom_sequence'] = 'Séquence '.$sequence;
				$_SESSION['nom_classe'] = $nomClasse['nom_classe'];
				$_SESSION['print'] ='VisualiserNoteSequentielle';
				echo '<pre>'; print_r($_SESSION['matiere']);
				header('Location:print_pdf_landscape.php');
			}
			
		}
		
		/*********************************************
		En construction
		*****************************/
		elseif($_POST['to_print']=='VisualiserNoteTrimestrielle'){
			// On veut visualiser les notes trimestrielles 
			echo '<pre>'; print_r($_POST); echo '</pre>';
			$classe = $_POST['clas'];
			$trimestre = $_POST['trimestre'];
			if($classe=='null' or $trimestre=='null'){
				$_SESSION['message'] = 'Aucune Valeur transmise.';
				header('Location:'.$source);
			}else{
				// On stocke les données de notes trimestrielles dans une variable 
				$_SESSION['nom_trimestre'] = 'Trimestre '.$_POST['trimestre'];
				$_SESSION['trimestre'] = $_POST['trimestre'];
				$_SESSION['code_classe'] = $_POST['clas'];
				$nom_classe = $config->viewNomClasse($_POST['clas']);
				$_SESSION['nom_classe'] = $nom_classe['nom_classe'];
				$_SESSION['print'] = 'VisualiserNoteTrimestrielle';
				$_SESSION['eleve'] = $note->tableTrimestre($_POST['trimestre'],$_POST['clas']);
				$listeMatiere = $config->listeMatiereClasse($classe);
				
				for($x=0;$x<count($listeMatiere);$x++){
					$codeMatiere[] = $listeMatiere[$x]['id_matiere'];
					$nomMatiere[] = $listeMatiere[$x]['nom_matiere'];
				}
				$_SESSION['code_matiere'] = $codeMatiere;
				$_SESSION['nom_matiere'] = $nomMatiere;
				
				
				
				$_SESSION['eleve2'] = $note->tableTrimestreMerite($_POST['trimestre'],$_POST['clas']);
				$_SESSION['statistique'] = $note->statSequence($_POST['trimestre'], $_POST['clas']);
				$_SESSION['groupe'] = $note->getGroupeClasse($_POST['clas']);
				// $_SESSION['rang'] = $note->showRangEleve($_POST['periode'],$_POST['classe']);
				
			
				// On extrait le Prof Principal de la Classe
				$classePrincipale = $config->classePrincipale();
				for($a=0;$a<count($classePrincipale);$a++){
					if($classePrincipale[$a]['code_classe']==$_SESSION['code_classe']){
						$_SESSION['professeurPrincipal'] = $classePrincipale[$a]['sexe'].' ';
						$_SESSION['professeurPrincipal'] .= strtoupper($classePrincipale[$a]['nom']).' ';
						$_SESSION['professeurPrincipal'] .= ucwords($classePrincipale[$a]['prenom']).' ';
					}
				}
			
			
				// echo '<pre>';print_r($_SESSION['eleve']);echo '</pre>';
				header('Location:print_pdf_landscape.php');
			}			
		}
		
		
		
		
		
		
		
		
		/*---------------------------------------------------------
		------------------------------------------------------------
		-----------------------------------------------------------
		On veut visualiser les notes annuelles
		-------------------------------------------------------------
		-----------------------------------------------------------*/
		elseif($_POST['to_print']=='VisualiserNoteAnnuelle'){
			// On veut visualiser les notes annuelles 
			echo '<pre>'; print_r($_POST); echo '</pre>';
			$classe = $_POST['classe'];
			if($classe=='null'){
				$_SESSION['message'] = 'Choisir une classe.';
				header('Location:'.$source);
			}else{
				$_SESSION['print'] = 'VisualiserNoteAnnuelle';
				// On stocke les données de notes annuelles dans une variable
				$_SESSION['code_classe'] = $classe;
				$nom_classe = $config->viewNomClasse($classe);
				$_SESSION['nom_classe'] = $nom_classe['nom_classe'];
				$_SESSION['eleve'] = $note->tableAnnuelle($classe);
				// echo '<pre>';print_r($_SESSION['eleve']); echo '</pre>';
				$listeMatiere = $config->listeMatiereClasse($classe);
				for($x=0;$x<count($listeMatiere);$x++){
					$codeMatiere[] = $listeMatiere[$x]['id_matiere'];
					$nomMatiere[] = $listeMatiere[$x]['nom_matiere'];
				}
				$_SESSION['code_matiere'] = $codeMatiere;
				$_SESSION['nom_matiere'] = $nomMatiere;
				
				
				header('Location:print_pdf_landscape.php');
			}	
		}
		
		
		
		
		/*---------------------------------------------------------
		------------------------------------------------------------
		-----------------------------------------------------------
		On veut visualiser la vue d'ensemble des effectifs
		-------------------------------------------------------------
		-----------------------------------------------------------*/
		
		
		elseif($_POST['to_print']=='VueEffectif'){
			$listeNiveau = $config->listeNiveaux();
			for($a=0;$a<count($listeNiveau);$a++){
				$listeClasse = $config->getClasseByNiveau($listeNiveau[$a]['id']);
				$myClasse[$a] = $listeClasse;
				for($b=0;$b<count($listeClasse);$b++){
					$statClasse = $config->listeEleveStat($listeClasse[$b]['id'],'non_supprime', $as);
					$myStat[$a][$b] = $statClasse;
				}
				$statNiveau = $config->statEleveNiveau($listeNiveau[$a]['id'], 'non_supprime', $as);
				$stat[$a] = $statNiveau;
				// echo '<pre>'; print_r($statNiveau); echo '</pre>';
			}
			$_SESSION['classe']['niveau'] = $listeNiveau;
			$_SESSION['classe']['liste'] = $myClasse;
			$_SESSION['classe']['effectif'] = $myStat;
			$_SESSION['classe']['stat'] = $stat;
			// echo '<pre>'; print_r($myStat); echo '</pre>';
			$_SESSION['print'] = 'vueEffectif';
			header('Location:print_pdf.php');
		}
		elseif($_POST['to_print']=='BulletinSequentiel'){
			print_r($_POST);
			$_SESSION['print'] ='BullSeq';
			// echo $_SESSION['print'];
			$_SESSION['sequence'] = $_POST['sekence'];
			$_SESSION['classe'] = $_POST['clas'];
			$_SESSION['nomClasse'] = $config->viewNomClasse($_POST['clas']);
			$section = $config->verifSectionClasse($_POST['clas']);
			$_SESSION['section'] = $section;
			$eleve = $note->moySequenceClasse($_POST['sekence'], 
												$_POST['clas']);
			$eleve2 = $note->moySequenceClasseMerite($_POST['sekence'], 
												$_POST['clas']);
			$tableBulletin = $note->sequenceClasse($_POST['sekence'],
												$_POST['clas']);
			$tableStat = $note->statSequence($_POST['sekence'], 
												$_POST['clas']);
			$nbGroupe = $note->afficheGroupe($_POST['clas']);
			for($w=0;$w<count($nbGroupe);$w++){
				$nomGpe = $nbGroupe[$w]['groupe'];
				$matiereGroupe[$nomGpe] = $note->getmatiereGroupe($nbGroupe[$w]['groupe'],
														$_POST['clas']);
			}
			for($x=0;$x<count($_SESSION['groupe']);$x++){
				$gpCode = $_SESSION['groupe'][$x];
				$listeMatiere = $note->getMatiereGroupe($gpCode,
														$_SESSION['classe']);
				$j=0;
				while($j<count($listeMatiere)){
					$codeMatiere[$gpCode][] = $listeMatiere[$j]['id_matiere'];
					$nomMatiere[$gpCode][] = $listeMatiere[$j]['nom_matiere'];
					$j++;
				}
			}
			$_SESSION['code_matiere'] = $codeMatiere;
			$_SESSION['nom_matiere'] = $nomMatiere;
			
			$_SESSION['eleve'] = $eleve;
			$_SESSION['eleve2'] = $eleve2;
			$_SESSION['bulletin'] = $tableBulletin;
			$_SESSION['statistique'] = $tableStat;
			$_SESSION['matiereGroupe'] = $matiereGroupe;
			$nom_classe = $config->viewNomClasse($_POST['clas']);
			$_SESSION['nom_classe'] = $nom_classe['nom_classe'];
			$_SESSION['groupe'] = $note->getGroupeClasse($_POST['clas']);
				// On extrait le Prof Principal de la Classe
				$classePrincipale = $config->classePrincipale();
				// echo '<pre>';print_r($classePrincipale); echo '</pre>';
				for($a=0;$a<count($classePrincipale);$a++){
					if($classePrincipale[$a]['code_classe']==$_SESSION['classe']){
						$_SESSION['professeurPrincipal'] = $classePrincipale[$a]['sexe'].' ';
						$_SESSION['professeurPrincipal'] .= strtoupper($classePrincipale[$a]['nom']).' ';
						$_SESSION['professeurPrincipal'] .= ucwords($classePrincipale[$a]['prenom']).' ';
					}
				}
			// echo '<pre>';print_r($section);
			// echo '<pre>';print_r($matiereGroupe);
			// echo '<pre>';print_r($_SESSION['groupe']);
			// echo $_SESSION['professeurPrincipal'];
			header('Location:print_pdf.php');
		}
		
		
		elseif($_POST['to_print']=='BulletinTrimestriel'){
			echo '<pre>';print_r($_POST);echo '</pre>';
			$_SESSION['trimestre'] = $_POST['trimestre'];
			$_SESSION['code_classe'] = $_POST['clas'];
			$nom_classe = $config->viewNomClasse($_POST['clas']);
			$_SESSION['nom_classe'] = $nom_classe['nom_classe'];
			$_SESSION['print'] = 'BullTrimestriel';
			$section = $config->verifSectionClasse($_POST['clas']);
			$_SESSION['section'] = $section;
			$_SESSION['eleve'] = $note->tableTrimestre($_POST['trimestre'],$_POST['clas']);
			$_SESSION['eleve2'] = $note->tableTrimestreMerite($_POST['trimestre'],$_POST['clas']);
			$_SESSION['statistique'] = $note->statTrimestre($_POST['trimestre'], $_POST['clas']);
			$_SESSION['groupe'] = $note->getGroupeClasse($_POST['clas']);
			// $_SESSION['rang'] = $note->showRangEleve($_POST['periode'],$_POST['classe']);
			for($x=0;$x<count($_SESSION['groupe']);$x++){
				$gpCode = $_SESSION['groupe'][$x];
				$listeMatiere = $note->getMatiereGroupe($gpCode,
														$_SESSION['code_classe']);
				$j=0;
				while($j<count($listeMatiere)){
					$codeMatiere[$gpCode][] = $listeMatiere[$j]['id_matiere'];
					$nomMatiere[$gpCode][] = $listeMatiere[$j]['nom_matiere'];
					$j++;
				}
			}
			$_SESSION['code_matiere'] = $codeMatiere;
			$_SESSION['nom_matiere'] = $nomMatiere;
			
			// On extrait le Prof Principal de la Classe
			$classePrincipale = $config->classePrincipale();
			for($a=0;$a<count($classePrincipale);$a++){
				if($classePrincipale[$a]['code_classe']==$_SESSION['code_classe']){
					$_SESSION['professeurPrincipal'] = $classePrincipale[$a]['sexe'].' ';
					$_SESSION['professeurPrincipal'] .= strtoupper($classePrincipale[$a]['nom']).' ';
					$_SESSION['professeurPrincipal'] .= ucwords($classePrincipale[$a]['prenom']).' ';
				}
			}
			
			
			// echo '<pre>';print_r($_SESSION['eleve']);echo '</pre>';
			// echo '<pre>';print_r($_SESSION['eleve']);echo '</pre>';
			// echo '<pre>';print_r($_SESSION['eleve']);echo '</pre>';
			header('Location:print_pdf.php');
		}
		
		
		
		
		
		elseif($_POST['to_print']=='RapportSequentiel'){
			echo "<pre>";
				print_r($_POST);
			echo "</pre>";
			$_SESSION['print'] =$_POST['to_print'];
			$_SESSION['sequence'] = $_POST['sekence'];
			$_SESSION['classe'] = $_POST['clas'];
			$_SESSION['nom_sequence'] = "Séquence ".$_POST['sekence'];
			$_SESSION['nom_sequence_anglais'] = "Sequence ".$_POST['sekence'];
			$_SESSION['nomClasse'] = $config->viewNomClasse($_POST['clas']);
			$_SESSION['nom_classe'] = $_SESSION['nomClasse']['nom_classe'];
			$_SESSION['code_classe'] = $_SESSION['nomClasse']['code_classe'];
			$_SESSION['section'] = $_POST['section'];
			/*On appelle la table qui contient les notes et moyennes séquentielles générées*/
			$eleve = $note->moySequenceClasse($_POST['sekence'], 
												$_POST['clas']);
			
			$nbGroupe = $note->afficheGroupe($_POST['clas']);
			for($w=0;$w<count($nbGroupe);$w++){
				$nomGpe = $nbGroupe[$w]['groupe'];
				$matiereGroupe[$nomGpe] = $note->getMatiereGroupe($nbGroupe[$w]['groupe'],
														$_POST['clas']);
				$infoGroupe[] = $nomGpe;
			}							
			$tableStat = $note->statSequence($_POST['sekence'], 
												$_POST['clas']);
			
			$_SESSION['stat'] = $tableStat;
			$_SESSION['groupe'] = $infoGroupe;
			$_SESSION['matiere'] = $matiereGroupe;
			$_SESSION['eleve'] = $eleve;
			
			// echo '<pre>';print_r($_SESSION['stat']); echo '</pre>';
			// echo '<pre>';print_r($infoGroupe); echo '</pre>';
			header('Location:print_pdf_landscape.php');
		}
		
		
		
		
		
		
		
		
		
		elseif($_POST['to_print']=='RapportTrimestriel'){
			echo "<pre>";
				print_r($_POST);
			echo "</pre>";
			
			$_SESSION['print'] = $_POST['to_print'];
			$_SESSION['trimestre'] = $_POST['trimestre'];
			$_SESSION['classe'] = $_POST['clas'];
			$_SESSION['nom_trimestre'] = "Trimestre ".$_POST['trimestre'];
			$_SESSION['nom_trimestre_anglais'] = "Term ".$_POST['trimestre'];
			$_SESSION['nomClasse'] = $config->viewNomClasse($_POST['clas']);
			$_SESSION['nom_classe'] = $_SESSION['nomClasse']['nom_classe'];
			$_SESSION['code_classe'] = $_SESSION['nomClasse']['code_classe'];
			$_SESSION['section'] = $_POST['section'];
			/*On appelle la table qui contient les notes et moyennes trimestrielles générées*/
			$eleve = $note->tableTrimestre($_POST['trimestre'], 
												$_POST['clas']);
			$nbGroupe = $note->afficheGroupe($_POST['clas']);
			for($w=0;$w<count($nbGroupe);$w++){
				$nomGpe = $nbGroupe[$w]['groupe'];
				$matiereGroupe[$nomGpe] = $note->getMatiereGroupe($nbGroupe[$w]['groupe'],
														$_POST['clas']);
				$infoGroupe[] = $nomGpe;
			}
			$tableStat = $note->statTrimestre($_POST['trimestre'], 
												$_POST['clas']);
			$_SESSION['stat'] = $tableStat;
			$_SESSION['groupe'] = $infoGroupe;
			$_SESSION['matiere'] = $matiereGroupe;
			$_SESSION['eleve'] = $eleve;
			
			
			// echo '<pre>';print_r($_SESSION['stat']); echo '</pre>';
			// echo '<pre>';print_r($infoGroupe); echo '</pre>';
			header('Location:print_pdf_landscape.php');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		elseif($_POST['to_print']=='TableauTrimestriel'){
			echo '<pre>';print_r($_POST);echo '</pre>';
			
			$_SESSION['trimestre'] = $_POST['trimestre'];
			$_SESSION['code_classe'] = $_POST['clas'];
			$nom_classe = $config->viewNomClasse($_POST['clas']);
			$_SESSION['nom_classe'] = $nom_classe['nom_classe'];
			$_SESSION['print'] = 'TableauTrimestriel';
			$_SESSION['eleve'] = $note->tableauTrimestre($_POST['trimestre'],$_POST['clas']);
			
			
			
			// echo '<pre>'; print_r($_SESSION['eleve']); echo '</pre>';
			// echo $_SESSION['code_classe'];
			header('Location:print_pdf_landscape.php');
			/*
			
			
			
			
			
			
			$_SESSION['statistique'] = $note->statSequence($_POST['trimestre'], $_POST['clas']);
			$_SESSION['groupe'] = $note->getGroupeClasse($_POST['clas']);
			// $_SESSION['rang'] = $note->showRangEleve($_POST['periode'],$_POST['classe']);
			for($x=0;$x<count($_SESSION['groupe']);$x++){
				$gpCode = $_SESSION['groupe'][$x];
				$listeMatiere = $note->getMatiereGroupe($gpCode,
														$_SESSION['code_classe']);
				$j=0;
				while($j<count($listeMatiere)){
					$codeMatiere[$gpCode][] = $listeMatiere[$j]['id_matiere'];
					$nomMatiere[$gpCode][] = $listeMatiere[$j]['nom_matiere'];
					$j++;
				}
			}
			$_SESSION['code_matiere'] = $codeMatiere;
			$_SESSION['nom_matiere'] = $nomMatiere;
			
			// On extrait le Prof Principal de la Classe
			$classePrincipale = $config->classePrincipale();
			for($a=0;$a<count($classePrincipale);$a++){
				if($classePrincipale[$a]['code_classe']==$_SESSION['code_classe']){
					$_SESSION['professeurPrincipal'] = $classePrincipale[$a]['sexe'].' ';
					$_SESSION['professeurPrincipal'] .= strtoupper($classePrincipale[$a]['nom']).' ';
					$_SESSION['professeurPrincipal'] .= ucwords($classePrincipale[$a]['prenom']).' ';
				}
			}
			
			
			// echo '<pre>';print_r($_SESSION['eleve']);echo '</pre>';
			*/
		}
		
		
		
		
		
		
		
		elseif($_POST['to_print']=='BulletinAnnuel'){
			
			$_SESSION['print'] = 'BullAnnuel';
			if($_POST['classe']=='null'){
				$_SESSION['message'] = 'Choisir une Classe';
				header('Location:'.$source);
			}else{
				$_SESSION['code_classe'] = $_POST['classe'];
				$nom_classe = $config->viewNomClasse($_POST['classe']);
				$section = $config->verifSectionClasse($_POST['classe']);
				$_SESSION['section'] = $section;
				$_SESSION['nom_classe'] = $nom_classe['nom_classe'];
				$_SESSION['eleve'] = $note->bulletinAnnuel($_POST['classe']);
				$_SESSION['eleve2'] = $note->bulletinAnnuelMerite($_POST['classe']);
				$_SESSION['statistique'] = $note->statAnnuelle($_POST['classe']);
				$_SESSION['groupe'] = $note->getGroupeClasse($_POST['classe']);
				for($x=0;$x<count($_SESSION['groupe']);$x++){
					$gpCode = $_SESSION['groupe'][$x];
					$gpTr1[] = $gpCode.'_tr1';
					$gpTr2 = $gpCode.'_tr2';
					$gpTr3 = $gpCode.'_tr3';
					$gpMoyenne = $gpCode.'_moyenne';
					$listeMatiere = $note->getMatiereGroupe($gpCode,$_SESSION['code_classe']);
					$j=0;
					while($j<count($listeMatiere)){
						$codeMatiere[$gpCode][] = $listeMatiere[$j]['id_matiere'];
						$nomMatiere[$gpCode][] = $listeMatiere[$j]['nom_matiere'];
						$j++;
					}
				}
				$_SESSION['code_matiere'] = $codeMatiere;
				$_SESSION['nom_matiere'] = $nomMatiere;
				$_SESSION['gpTr1'] = $gpTr1;
				$_SESSION['gpTr2'] = $gpTr2;
				$_SESSION['gpTr3'] = $gpTr3;
				echo '<pre>';print_r($_SESSION['gpTr1']);
				
				
				
				// On extrait le Prof Principal de la Classe
				$classePrincipale = $config->classePrincipale();
				for($a=0;$a<count($classePrincipale);$a++){
					if($classePrincipale[$a]['code_classe']==$_SESSION['code_classe']){
						$_SESSION['professeurPrincipal'] = $classePrincipale[$a]['sexe'].' ';
						$_SESSION['professeurPrincipal'] .= strtoupper($classePrincipale[$a]['nom']).' ';
						$_SESSION['professeurPrincipal'] .= ucwords($classePrincipale[$a]['prenom']).' ';
					}
				}
				header('Location:print_pdf.php');
			}
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		elseif($_POST['to_print']=='TableauAnnuel'){
			$_SESSION['print'] = 'BullAnnuel';
			if($_POST['classe']=='null'){
				$_SESSION['message'] = 'Choisir une Classe';
				header('Location:'.$source);
			}else{
				$_SESSION['code_classe'] = $_POST['classe'];
				$nom_classe = $config->viewNomClasse($_POST['classe']);
				$_SESSION['nom_classe'] = $nom_classe['nom_classe'];
				$_SESSION['eleve'] = $note->bulletinAnnuel($_POST['classe']);
				$_SESSION['eleve2'] = $note->bulletinAnnuelMerite($_POST['classe']);
				$_SESSION['statistique'] = $note->statAnnuelle($_POST['classe']);
				$_SESSION['groupe'] = $note->getGroupeClasse($_POST['classe']);
				for($x=0;$x<count($_SESSION['groupe']);$x++){
					$gpCode = $_SESSION['groupe'][$x];
					$gpTr1[] = $gpCode.'_tr1';
					$gpTr2 = $gpCode.'_tr2';
					$gpTr3 = $gpCode.'_tr3';
					$gpMoyenne = $gpCode.'_moyenne';
					$listeMatiere = $note->getMatiereGroupe($gpCode,$_SESSION['code_classe']);
					$j=0;
					while($j<count($listeMatiere)){
						$codeMatiere[$gpCode][] = $listeMatiere[$j]['id_matiere'];
						$nomMatiere[$gpCode][] = $listeMatiere[$j]['nom_matiere'];
						$j++;
					}
				}
				$_SESSION['code_matiere'] = $codeMatiere;
				$_SESSION['nom_matiere'] = $nomMatiere;
				$_SESSION['gpTr1'] = $gpTr1;
				$_SESSION['gpTr2'] = $gpTr2;
				$_SESSION['gpTr3'] = $gpTr3;
				echo '<pre>';print_r($_SESSION['gpTr1']);
				
				
				
				// On extrait le Prof Principal de la Classe
				$classePrincipale = $config->classePrincipale();
				for($a=0;$a<count($classePrincipale);$a++){
					if($classePrincipale[$a]['code_classe']==$_SESSION['code_classe']){
						$_SESSION['professeurPrincipal'] = $classePrincipale[$a]['sexe'].' ';
						$_SESSION['professeurPrincipal'] .= strtoupper($classePrincipale[$a]['nom']).' ';
						$_SESSION['professeurPrincipal'] .= ucwords($classePrincipale[$a]['prenom']).' ';
					}
				}
				header('Location:print_pdf.php');
			}
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	if(isset($_POST['absence'])){
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		if($_POST['eleve']=='null'){
			$_SESSION['message'] = 'Choisir un élève.';
			header('Location:'.$source);
		}else{
			$dateAbs = $_POST['dateAbs'];
			$nbHeures = (int) $_POST['nbHeures'];
			$eleve = (int) $_POST['eleve'];
			echo $nbHeures;
			$config->addAbsence($source, $eleve, $dateAbs, $nbHeures);
		}
	}
	
	
	
	
	
	
	
	
	
	if(isset($_POST['delAbsence'])){
		echo '<pre>';
			print_r($_POST);
			for($i=0;$i<count($_POST['eleve']);$i++){
				$eleve = $_POST['eleve'][$i];
				$config->deleteAbsenceEleve($source, $eleve);
			}
		echo '</pre>';
	}
	
	
	
	
	
	
	
	
	
	
	
	if(isset($_POST['updAbsence'])){
		echo '<pre>';
			print_r($_POST);
			if(!empty($_POST['idAbsence'])){
				for($i=0;$i<count($_POST['idAbsence']);$i++){
					$ligne = $_POST['idAbsence'][$i];
					$config->updateAbsenceEleve($source, $ligne);
				}
			}else{
				$_SESSION['message'] = 'Aucune Valeur Transmise.';
				header('Location:'.$source);
			}
		echo '</pre>';
	}
	
	
	
	
	
	
	
	
	
	if(isset($_POST['closeYear'])){
		$close = $_POST['closeYear'];
		echo $close;
		if($close=='Non'){
			// On ne cloture pas l'année scolaire 
			$_SESSION['message'] = 'Année Scolaire non cloturée.';
			header('Location:'.$source);
		}
		elseif($close=='Oui'){
			// On cloture l'année scolaire
			$endYear = $_POST['endYear'];
			$openYear = $_POST['newYear'];
			echo var_dump($openYear);
			if(empty($openYear)){
				$_SESSION['message'] = 'Renseignez la Nouvelle Année Scolaire';
				header('Location:'.$source);
			}else{
				echo '<pre>';
				print_r($_POST);
				echo '</pre>';
				$config->cloturerAnnee($source,
								$_POST['endYear'],
								$_POST['newYear']);
			}
		}
	}
	