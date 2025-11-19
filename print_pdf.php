<?php 
	
	
	/***********************************************************************************
	************************************************************************************
	************************************************************************************
	************   G E N E R A T E U R	 D E	F I C H I E R S 	P D F	************
	************************************************************************************
	************************************************************************************
	***********************************************************************************/
	session_start();
	require_once('inc/pdf.class.php');
	$pdf = new pdf('P', 'mm', 'A4');
	// Couleur de fond par défaut 
	$pdf->SetFillColor(200,205,180);
	
	
	
	if(isset($_SESSION['print'])){
		// On charge les informations d'entête de l'établissement
		/**********************************************************************
		***********************************************************************
		****************	Impression de la liste des élèves	***************
		***********************************************************************
		**********************************************************************/
		 
		if($_SESSION['print']=='listeEleve'){
			$pdf->addPage();
			$pdf->Entete();
			$classe = $_SESSION['classe'];
			$pdf->ListeEleve($classe, $classe['section']);
			$fileName = 'Liste_Eleve_'.$classe['eleve'][0]['nom_classe'].'.pdf';
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		
		
		if($_SESSION['print']=='listeEleveOld'){
			$pdf->addPage();
			$pdf->Entete();
			$classe = $_SESSION['classe'];
			$pdf->ListeEleveOld($classe['eleve'][0]['a_s'], $classe, $classe['classe']['section']);
			$fileName = 'Liste_Eleve_'.$classe['classe']['nom_classe'].'.pdf';
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		****************	Impression des Relevés de Notes		***************
		***********************************************************************
		**********************************************************************/
		
		elseif($_SESSION['print']=='releveNote'){
			$classe = $_SESSION['classe'];
			$pdf->SetFillColor(155, 150, 149);
			// La page doit s'afficher en fonction de la section 
			if($classe['section']=='en'){
				$pdf->addPage();
				$pdf->Entete();
				$titre = "reported marks of the teacher ";
				// $titre.= $classe['eleve'][0]['nom_classe'];
				$pdf->Titre($titre);
				
				$pdf->setFont('Times', 'B', 12);
				$pdf->Cell(75, 7, 'Class : '.$classe['eleve'][0]['nom_classe'], 0,0,'C');
				$pdf->Ln(7);
				$pdf->setFont('Times', '', 10);
				$pdf->Cell(75,7, utf8_decode('Suject : _____________________'),0,0,'C');
				$pdf->Cell(35,7, utf8_decode('Coef : _______'),0,0,'C');
				$pdf->Cell(75,7, utf8_decode('Teacher Name : _____________________'),0,0,'C');
				$pdf->SetFont('Times','B',8);
				$pdf->Ln(10);
				
				// Je positionne l'entete du tableau
				$pdf->Cell(9, 5, $pdf->convert('N°'), 1, 0 , 'C',true);
				$pdf->Cell(9, 5, $pdf->convert('Sex'), 1, 0 , 'C',true);
				$pdf->Cell(13, 5, $pdf->convert('Status'), 1, 0 , 'C',true);
				$pdf->Cell(75, 5, $pdf->convert('Full Name'), 1, 0 , 'C',true);
				for($x=1;$x<=6;$x++){
					$pdf->Cell(15,5, $pdf->convert('Seq '.$x), 1, 0, 'C', true);
				}
				$pdf->SetFont('Times','',10);
				$pdf->Ln(5);
				$a = 1;
				for($i=0;$i<count($classe['eleve']);$i++){
					$pdf->Cell(9, 5, $a, 1, 0 , 'C');
					$pdf->Cell(9, 5, $pdf->convert($classe['eleve'][$i]['sexe']), 1, 0 , 'C');
					$pdf->Cell(13, 5, $pdf->convert($classe['eleve'][$i]['statut']), 1, 0 , 'C');
					$pdf->Cell(75, 5, $pdf->convert($classe['eleve'][$i]['nom_complet']), 1, 0 , 'L');
					for($j=1;$j<=6;$j++){
						$pdf->Cell(15,5, '', 1, 0, 'C');
					}
					$pdf->Ln(5);
					$a++;
				}
				$pdf->Cell(130,4,'',0,0,'L');
				$pdf->Ln(6);
				for($w=1;$w<=6;$w++){
					$texte = 'Skill evaluated '.$w.' : _________________________________________________________________';
					$pdf->Cell(130,4, utf8_decode($texte),0,0,'L');
					$pdf->Ln(6);
				}
				$pdf->SetFont('Arial','BI',10);				
				
				$fileName='Reported_Marks_';
				$fileName.= strtoupper(str_replace(' ','_',$classe['eleve'][0]['nom_classe']));
				$fileName.= '.pdf';
			}
			elseif($classe['section']=='fr'){
				$pdf->addPage();
				$pdf->Entete();
				$titre = "Releve de Notes de l'enseignant ";
				// $titre.= $classe['eleve'][0]['nom_classe'];
				$pdf->Titre($titre);
				
				$pdf->setFont('Times', 'B', 12);
				$pdf->Cell(75, 7, 'Classe : '.$classe['eleve'][0]['nom_classe'], 0,0,'C');
				$pdf->Ln(7);
				$pdf->setFont('Times', '', 10);
				$pdf->Cell(75,7, utf8_decode('Matière : _____________________'),0,0,'C');
				$pdf->Cell(35,7, utf8_decode('Coef : _______'),0,0,'C');
				$pdf->Cell(75,7, utf8_decode('Enseignant : _____________________'),0,0,'C');
				$pdf->SetFont('Times','B',8);
				$pdf->Ln(10);
				
				// Je positionne l'entete du tableau
				$pdf->Cell(9, 5, $pdf->convert('N°'), 1, 0 , 'C',true);
				$pdf->Cell(9, 5, $pdf->convert('Sexe'), 1, 0 , 'C',true);
				$pdf->Cell(13, 5, $pdf->convert('Statut'), 1, 0 , 'C',true);
				$pdf->Cell(75, 5, $pdf->convert('Nom Complet'), 1, 0 , 'C',true);
				for($x=1;$x<=6;$x++){
					$pdf->Cell(15,5, $pdf->convert('Séq '.$x), 1, 0, 'C', true);
				}
				$pdf->SetFont('Times','',10);
				$pdf->Ln(5);
				$a = 1;
				for($i=0;$i<count($classe['eleve']);$i++){
					$pdf->Cell(9, 5, $a, 1, 0 , 'C');
					$pdf->Cell(9, 5, $pdf->convert($classe['eleve'][$i]['sexe']), 1, 0 , 'C');
					$pdf->Cell(13, 5, $pdf->convert($classe['eleve'][$i]['statut']), 1, 0 , 'C');
					$pdf->Cell(75, 5, $pdf->convert($classe['eleve'][$i]['nom_complet']), 1, 0 , 'L');
					for($j=1;$j<=6;$j++){
						$pdf->Cell(15,5, '', 1, 0, 'C');
					}
					$pdf->Ln(5);
					$a++;
				}
				$pdf->Cell(130,4,'',0,0,'L');
				$pdf->Ln(6);
				for($w=1;$w<=6;$w++){
					$texte = 'Compétence évaluée '.$w.' : _________________________________________________________________';
					$pdf->Cell(130,4, utf8_decode($texte),0,0,'L');
					$pdf->Ln(6);
				}
				$pdf->SetFont('Arial','BI',10);				
				
				$fileName='Releve_Note_';
				$fileName.= strtoupper(str_replace(' ','_',$classe['eleve'][0]['nom_classe']));
				$fileName.= '.pdf';
			} 
			
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		
		
		
		
		/**************************************************************
		***************************************************************
		********** 		IMPRESSION DU CERTIFICAT DE SCOLARITE 	*******
		***************************************************************
		**************************************************************/
		elseif($_SESSION['print']=='certificatScolarite'){
			$eleve = $_SESSION['eleve'];
			$classe = $_SESSION['classe'];
			$information = $_SESSION['information'];
			$pdf->SetFillColor(155, 150, 149);
			$pdf->addPage();
			$pdf->Entete();
			$pdf->certificatScolarite($eleve, $information, $classe['section']);
			$fileName = 'Certificat_Scolarite_';
			$fileName .= str_replace(' ','_', $eleve['nom_complet']);
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		elseif($_SESSION['print']=='certificatScolariteOld'){
			$eleve = $_SESSION['eleve'];
			$information = $_SESSION['information'];
			$pdf->SetFillColor(155, 150, 149);
			$pdf->addPage();
			$pdf->Entete();
			$pdf->certificatScolariteOld($eleve, $information, $eleve['classe']['section']);
			$fileName = 'Certificat_Scolarite_.pdf';
			// $fileName .= str_replace(' ','_', $eleve['nom_complet']);
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		****************	Impression de la liste des PP		***************
		***********************************************************************
		**********************************************************************/
		elseif($_SESSION['print']=='ProfesseursPrincipaux'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->Entete();
			// On met le titre du document 
			$titre = "liste des professeurs titulaires ";
			$pdf->Titre($titre);
			$pdf->SetFont('Arial','B',10);
			// Je positionne l'entete du tableau
			$pdf->Cell(30);
			$pdf->Cell(10, 7, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(60, 7, 'Classe', 1, 0 , 'C');
			$pdf->Cell(70, 7, 'Professeur Principal', 1, 0 , 'C');
			
			$pdf->SetFont('Arial','',10);
			$i = 1;
			// Par boucle je récupère la liste envoyée dans une variable de session
			for($a=0;$a<count($_SESSION['liste']);$a++){
				$pdf->Ln(7);
				$pdf->Cell(30);
				$pdf->Cell(10, 7, utf8_decode($i), 1, 0 , 'C');
				$pdf->Cell(60, 7, utf8_decode(ucwords($_SESSION['liste'][$a]['nom_classe'])), 1, 0 , 'C');
				$enseignant = strtoupper($_SESSION['liste'][$a]['nom']);
				$enseignant .=' '.ucwords($_SESSION['liste'][$a]['prenom']);
				$pdf->Cell(70, 7, utf8_decode($enseignant), 1, 0 , 'C');
				
				
				$i++;
			}
			$pdf->SetFont('Arial','B',12);
			
			// Le signataire du document 
			$pdf->SetFont('Arial','',10);
			$pdf->Ln(10);
			$pdf->Cell(100,30, ' ');
			$arrondissement = $_SESSION['information']['ville'];
			$signataire = $_SESSION['information']['signataire_fr'];
			$pdf->Cell(100,30, 'Fait a '.ucwords($arrondissement).', le'.DATE('d / M / Y'));
			$pdf->Ln(10);
			$pdf->Cell(130,30, ' ');
			$pdf->Cell(100,25, $signataire.',');
			$nomFichier = 'Prof_Principaux.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		****************	Impression des Conseils de Classe		***********
		***********************************************************************
		**********************************************************************/
		
		elseif($_SESSION['print']=='ConseilClasse'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->Entete();
			// On met le titre du document 
			$titre = "Enseignants de la classe de ".$_SESSION['liste'][0]['nom_classe']."";
			// $titre .= strtoupper($_SESSION['liste'][0]['nom_classe']);
			$pdf->TitreSans($titre);
			
			
			$pdf->Ln(15);
			
			
			$pdf->SetFont('Arial','B',10);
			// Je positionne l'entete du tableau
			$pdf->Cell(10, 6, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(70, 6, utf8_decode('Matière'), 1, 0 , 'C');
			$pdf->Cell(100, 6, utf8_decode('Enseignant'), 1, 0 , 'C');			
			$pdf->SetFont('Arial','',10);
			$i = 1;
			// Par boucle je récupère la liste envoyée dans une variable de session
			for($a=0;$a<count($_SESSION['liste']);$a++){
				$pdf->Ln(7);
				$pdf->Cell(10, 6, $i, 1, 0 , 'C');
				$pdf->Cell(70, 6, utf8_decode(strtoupper($_SESSION['liste'][$a]['nom_matiere'])), 1, 0 );
				$enseignant = $_SESSION['liste'][$a]['nom_complet_enseignant'];
				$pdf->Cell(100, 6, utf8_decode($enseignant), 1, 0 );
				$i++;
			}
			$nomFichier = 'ConseilDeClasse_'.$_SESSION['liste'][0]['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		**********	Affichage des Notes d'un enseignant avec stat		*******
		***********************************************************************
		**********************************************************************/
		elseif($_SESSION['print']=='NoteEnseignant'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$titre = "Notes de l'enseignant ";
			// $titre .= strtoupper($_SESSION['liste'][0]['nom_classe']);
			$pdf->Titre($titre);
			
			
			// Informations diverses
			$pdf->SetFont('Times','B',12);
			$classe = $_SESSION['nomClasse'];
			$enseignant = $_SESSION['nomEnseignant'];
			$matiere = $_SESSION['nomMatiere'];
			$periode = $_SESSION['nomSequence'];
			$pdf->Cell(20,10,'Classe : '.$classe,0,0,'C');
			$pdf->Cell(100,10,utf8_decode('Période : '.$periode),0,0,'C');
			$pdf->SetFont('Times','',12);
			$pdf->Ln(5);
			$pdf->Cell(5,20,'Enseignant :'.utf8_decode($enseignant));
			$pdf->Cell(200,20,utf8_decode('Matière :'.ucwords($matiere)),0,0,'C');
			
			$pdf->Ln(15);
						
			$pdf->SetFont('Arial','B',10);
			// Je positionne le tableau statistique
			$pdf->Cell(50);
			$pdf->Cell(10, 7, ' ', 1, 0 , 'C');
			$pdf->Cell(20, 7, 'Effectif', 1, 0 , 'C');
			$pdf->Cell(20, 7, utf8_decode('Evalué'), 1, 0 , 'C');
			$pdf->Cell(20, 7, 'Nb Moy', 1, 0 , 'C');
			$pdf->Cell(20, 7, 'Taux R', 1, 0 , 'C');
			$pdf->Ln(8);
			$pdf->Cell(50);
			$pdf->Cell(10, 7, 'M ', 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['M'], 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['evalM'], 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['moyM'], 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['tauxM'], 1, 0 , 'C');
			$pdf->Ln(8);
			$pdf->Cell(50);
			$pdf->Cell(10, 7, 'F ', 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['F'], 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['evalF'], 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['moyF'], 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['tauxF'], 1, 0 , 'C');
			$pdf->Ln(8);
			$pdf->Cell(50);
			$pdf->Cell(10, 7, 'T ', 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['T'], 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['evalT'], 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['moyT'], 1, 0 , 'C');
			$pdf->Cell(20, 7, $_SESSION['stat']['tauxT'], 1, 0 , 'C');
			
			
			// Je positionne l'entete du tableau
			$pdf->Ln(20);
			$pdf->Cell(10, 7, 'N-', 1, 0 , 'C');
			$pdf->Cell(70, 7, utf8_decode('Noms et Prénoms'), 1, 0 , 'C');
			$pdf->Cell(12, 7, 'Sexe', 1, 0 , 'C');
			$pdf->Cell(30, 7, utf8_decode($periode), 1, 0 , 'C');
			
			// Par boucle je récupère la liste envoyée dans une variable de session
			$b = 1;
			for($a=0;$a<count($_SESSION['liste']);$a++){
				$pdf->Ln(8);
				$pdf->Cell(10, 7, $b, 1, 0 , 'C');
				$nom = strtoupper($_SESSION['liste'][$a]['nom']);
				$nom .= ' '.ucwords($_SESSION['liste'][$a]['prenom']);
				$pdf->Cell(70, 7, utf8_decode($nom), 1, 0 , 'L');
				$sexe = $_SESSION['liste'][$a]['sexe'];
				$pdf->Cell(12, 7, $sexe, 1, 0 , 'C');
				$note = $_SESSION['liste'][$a]['note_simple'];
				$pdf->Cell(30, 7, $note, 1, 0 , 'C');
				$b++;
			}
			
			// 
			/*
				$pdf->Ln(7);
				$pdf->Cell(10, 6, $i, 1, 0 , 'C');
				$pdf->Cell(21, 6, $_SESSION['liste'][$a]['matricule'], 1, 0 , 'C');
				$pdf->Cell(12, 6, $_SESSION['liste'][$a]['sexe'], 1, 0 , 'C');
				$nom = strtoupper($_SESSION['liste'][$a]['nom']);
				$nom .= ' '.ucwords($_SESSION['liste'][$a]['prenom']);
				$pdf->Cell(70, 6, $nom, 1, 0 , 'L');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$i++;
			}*/
			// Le nom du fichier sera Note_NomMatiere_Periode
			$nomFichier = 'Notes_'.$matiere.'_'.utf8_decode($periode).'.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		/**********************************************************************
		***********************************************************************
		**********	Vue d'ensemble des effectifs de la BD				*******
		***********************************************************************
		**********************************************************************/
		
		if($_SESSION['print']=='vueEffectif'){
			$classe = $_SESSION['classe'];
			$pdf->SetFillColor(155, 150, 149);
			$pdf->addPage();
			$pdf->Entete();
			$pdf->Titre("Vue d'ensemble des effectifs");
			$pdf->SetFont('Times','B',10);
			$pdf->Cell(50);
			$pdf->Cell(8, 5, utf8_decode('N°'), 1, 0 , 'C',true);
			$pdf->Cell(48, 5, 'Classe', 1, 0 , 'C',true);
			$pdf->Cell(18, 5, 'Masculin', 1, 0 , 'C',true);
			$pdf->Cell(18, 5, 'Feminin', 1, 0 , 'C',true);
			$pdf->Cell(25, 5, 'Total', 1, 0 , 'C',true);
			$pdf->Ln(5);

			// $pdf->SetFont('Times','',10);
			$a = 1;
			for($i=0;$i<count($classe['niveau']);$i++){
				$listeClasse = $classe['liste'];
				$effectifClasse = $classe['effectif'];
				$pdf->SetFont('Times','',10);
				for($j=0;$j<count($listeClasse[$i]);$j++){
					$masculinClasse[] = $effectifClasse[$i][$j]['G'];
					$femininClasse[] = $effectifClasse[$i][$j]['F'];
					$totalClasse[] = $effectifClasse[$i][$j]['T'];
					$pdf->Cell(50);
					$pdf->Cell(8, 5, $a, 1, 0 , 'C');
					$pdf->Cell(48, 5, $listeClasse[$i][$j]['nom_classe'], 1, 0 , 'L');
					$pdf->Cell(18, 5, $effectifClasse[$i][$j]['G'], 1, 0 , 'C');
					$pdf->Cell(18, 5, $effectifClasse[$i][$j]['F'], 1, 0 , 'C');
					$pdf->SetFont('Times','B',10);
					$pdf->Cell(25, 5, $effectifClasse[$i][$j]['T'], 1, 0 , 'C');
					$pdf->SetFont('Times','',10);
					$pdf->Ln(5);
					$a++;
				}
				$pdf->SetFont('Times','B',10);
				$pdf->Cell(50);
				$pdf->Cell(56, 5, utf8_decode('Total Niveau '.$classe['niveau'][$i]['nom_niveau']), 1, 0 , 'C',true);
				$pdf->Cell(18, 5, $classe['stat'][$i]['M'], 1, 0 , 'C',true);
				$pdf->Cell(18, 5, $classe['stat'][$i]['F'], 1, 0 , 'C',true);
				$pdf->Cell(25, 5, $classe['stat'][$i]['T'], 1, 0 , 'C',true);
				$pdf->Ln(5);
				$masc[] = $classe['stat'][$i]['M'];
				$fem[] = $classe['stat'][$i]['F'];
				$tot[] = $classe['stat'][$i]['T'];
			}
			$pdf->setFont('Times', 'B', 12);
			$pdf->Cell(50);
			$pdf->Cell(56, 5, utf8_decode('TOTAL '), 1, 0 , 'C',true);
			$pdf->Cell(18, 5, array_sum($masc), 1, 0 , 'C',true);
			$pdf->Cell(18, 5, array_sum($fem), 1, 0 , 'C',true);
			$pdf->Cell(25, 5, array_sum($tot), 1, 0 , 'C',true);
			$pdf->Ln(5);


			$fileName='Vue_Effectif.pdf';
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		**********	Génération du Bulletin séquentiel					*******
		***********************************************************************
		**********************************************************************/
		
		elseif($_SESSION['print']=='BulletinSequentiel'){
			$eleve = $_SESSION['eleve'];
			$ville = strtoupper($_SESSION['information']['ville']);
			$pdf->pvSequentielAlpha($_SESSION['section']);
			$pdf->pvSequentielMerite($_SESSION['section']);
			$_SESSION['effectif'] = count($eleve);
			for($i=0;$i<count($eleve);$i++){
				$pdf->bulletinSequentiel($eleve[$i], $_SESSION['section']);
			}
			$nomFichier = "Bulletin_Sequence_".$_SESSION['sequence']."_".$_SESSION['nom_classe'].".pdf";
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		**********	Génération du Bulletin trimestriel					*******
		***********************************************************************
		**********************************************************************/
		elseif($_SESSION['print']=='BulletinTrimestriel'){
			$eleve = $_SESSION['eleve'];
			$ville = strtoupper($_SESSION['information']['ville']);
			$pdf->pvTrimestrielAlpha($_SESSION['section']);
			$pdf->pvTrimestrielMerite($_SESSION['section']);
			$_SESSION['effectif'] = count($eleve);
			for($i=0;$i<count($eleve);$i++){
				$pdf->bulletinTrimestriel($eleve[$i], $_SESSION['section']);
			}
			$nomFichier = "Bulletin_Trimestre_".$_SESSION['trimestre']."_".$_SESSION['nom_classe'].".pdf";
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		**********	Génération du Bulletin Annuel					*******
		***********************************************************************
		**********************************************************************/
		elseif($_SESSION['print']=='BullAnnuel'){
			if($_SESSION['section']=='en'){
				$pdf->addPage();
				$pdf->EnteteDocTest($ministere, $ministereAnglais, $pays, $paysAnglais,
								$ets, $etsAnglais, $devise, $deviseAnglais, $contact, $as,
								$region, $regionAnglais, $departement, $departementAnglais);
							
				$pdf->pvAnnuelAlphabetiqueEn($_SESSION['nom_classe'], $ville,$signataireAnglais);
				
				$pdf->addPage();
				$pdf->EnteteDocTest($ministere, $ministereAnglais, $pays, $paysAnglais,
								$ets, $etsAnglais, $devise, $deviseAnglais, $contact, $as,
								$region, $regionAnglais, $departement, $departementAnglais);
				$pdf->pvAnnuelMeriteEn($_SESSION['nom_classe'], $ville, $signataire);
				
				$eleve = $_SESSION['eleve'];
				$pdf->bulletinAnnuelEn($_SESSION['nom_classe'], $eleve, $ville,
										$signataireAnglais, $ministere, $ministereAnglais, $pays, 
										$paysAnglais, $ets, $etsAnglais, $devise, $deviseAnglais, 
										$contact, $as, $region, $regionAnglais, $departement, 
										$departementAnglais);
				$nomFichier = 'Annual_report_';
				$nomFichier .= str_replace(' ','_',$_SESSION['nom_classe']).'.pdf';
				$pdf->Output($nomFichier, 'I');
			}
			
			
			elseif($_SESSION['section']=='fr'){
				$pdf->addPage();
				$pdf->EnteteDocTest($ministere, $ministereAnglais, $pays, $paysAnglais,
								$ets, $etsAnglais, $devise, $deviseAnglais, $contact, $as,
								$region, $regionAnglais, $departement, $departementAnglais);
							
				$pdf->pvAnnuelAlphabetiqueFr($_SESSION['nom_classe'], $ville,$signataire);
				
				$pdf->addPage();
				$pdf->EnteteDocTest($ministere, $ministereAnglais, $pays, $paysAnglais,
								$ets, $etsAnglais, $devise, $deviseAnglais, $contact, $as,
								$region, $regionAnglais, $departement, $departementAnglais);
				$pdf->pvAnnuelMeriteFr($_SESSION['nom_classe'], $ville, $signataire);
				
				$eleve = $_SESSION['eleve'];
				$pdf->bulletinAnnuelFr($_SESSION['nom_classe'], $eleve, $ville,
										$signataire, $ministere, $ministereAnglais, $pays, 
										$paysAnglais, $ets, $etsAnglais, $devise, $deviseAnglais, 
										$contact, $as, $region, $regionAnglais, $departement, 
										$departementAnglais);
				$nomFichier = 'Bulletin_annuel_';
				$nomFichier .= str_replace(' ','_',$_SESSION['nom_classe']).'.pdf';
				$pdf->Output($nomFichier, 'I');
			}
		}
		
		
		
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	else{
		$pdf->addPage();
		$titre = 'No data Sent';
		$pdf->Titre($titre);
		$pdf->SetFont('Times','B',12);
		// $pdf->Cell(5,20,'No Data Sent');
		$nomFichier = 'NoData.pdf';
		$pdf->Output($nomFichier, 'I');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	unset($_SESSION['classe']);
	unset($_SESSION['effectif']);
	unset($_SESSION['liste']);
	unset($_SESSION['print']);
	unset($_SESSION['eleve']);
	unset($_SESSION['eleve2']);
	unset($_SESSION['bulletin']);
	unset($_SESSION['stat']);
	unset($_SESSION['professeurPrincipal']);
	
	
	unset($_SESSION['section']);
	// echo '<pre>';print_r($_SESSION['liste']);