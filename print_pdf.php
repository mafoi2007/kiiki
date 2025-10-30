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
	
	
	
	if(isset($_SESSION['print'])){
		// On charge les informations d'entête de l'établissement
		/**********************************************************************
		***********************************************************************
		****************	Impression de la liste des élèves	***************
		***********************************************************************
		**********************************************************************/
		 
		if($_SESSION['print']=='listeEleve'){
			$classe = $_SESSION['classe'];
			$pdf->SetFillColor(155, 150, 149);
			// La page doit s'afficher en fonction de la section 
			if($classe['section']=='en'){
				$pdf->addPage();
				$pdf->Entete();
				$titre = 'student list of ';
				$titre.= $classe['eleve'][0]['nom_classe'];
				$pdf->Titre($titre);
				
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Sex', 1, 0 , 'C', true);
				$pdf->Cell(12, 7, 'Female', 1, 0 , 'C', true);
				$pdf->Cell(14, 7, 'Male', 1, 0 , 'C', true);
				$pdf->Cell(10, 7, 'Global', 1, 0 , 'C', true);
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Repeater', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['FR'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['GR'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['R'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'New', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['FN'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['GN'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['N'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Global', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['F'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['G'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['T'], 1, 0 , 'C');
				$pdf->Ln(10);
				
				$pdf->SetFont('Times','B',10);
				// Je positionne l'entete du tableau
				$pdf->Cell(10, 6, $pdf->convert('N°'), 1, 0 , 'C',true);
				$pdf->Cell(28, 6, $pdf->convert('National Id'), 1, 0 , 'C',true);
				$pdf->Cell(75, 6, $pdf->convert('Full Name'), 1, 0 , 'C',true);
				$pdf->Cell(9, 6, $pdf->convert('Sex'), 1, 0 , 'C',true);
				$pdf->Cell(13, 6, $pdf->convert('Status'), 1, 0 , 'C',true);
				$pdf->Cell(55, 6, $pdf->convert('Date and place of birth'), 1, 0 , 'C',true);
				$pdf->SetFont('Times','',10);
				$pdf->Ln(6);
				$a = 1;
				for($i=0;$i<count($classe['eleve']);$i++){
					$pdf->Cell(10, 6, $a, 1, 0 , 'C');
					$pdf->Cell(28, 6, $pdf->convert($classe['eleve'][$i]['rne']), 1, 0 , 'C');
					$pdf->Cell(75, 6, $pdf->convert($classe['eleve'][$i]['nom_complet']), 1, 0 , 'L');
					$pdf->Cell(9, 6, $pdf->convert($classe['eleve'][$i]['sexe']), 1, 0 , 'C');
					$pdf->Cell(13, 6, $pdf->convert($classe['eleve'][$i]['statut']), 1, 0 , 'C');
					$dateNaiss = $classe['eleve'][$i]['date_fr'].' at '.ucwords($classe['eleve'][$i]['lieu_naissance']);
					$pdf->Cell(55, 6, $pdf->convert($dateNaiss), 1, 0 , 'L');
					$pdf->Ln(6);
					$a++;
				}
				$texte = 'Done at '.ucwords($_SESSION['information']['ville']);
				$texte.= ', on the '.DATE('d  M  Y');
				$pdf->Cell(110);
				$pdf->Cell(70,10, $texte,0,0,'C');
				$pdf->Cell(20);
				
				$pdf->Ln(5);
				// $pdf->Cell(130,30, ' ');
				$pdf->SetFont('Arial','BI',10);
				// $titre = $classe['information']['titre'];
				$pdf->Cell(110);
				$pdf->Cell(70,10, $classe['information']['signataire_en'],0,0,'C');
				$pdf->Cell(20);
				
				$fileName='student_list_';
				$fileName.= strtoupper(str_replace(' ','_',$classe['eleve'][0]['nom_classe']));
				$fileName.= '.pdf';
			}
			elseif($classe['section']=='fr'){
				$pdf->addPage();
				$pdf->Entete();
				$titre = 'Liste des eleves de la ';
				$titre.= $classe['eleve'][0]['nom_classe'];
				$pdf->Titre($titre);
				
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Sexe', 1, 0 , 'C', true);
				$pdf->Cell(12, 7, 'Feminin', 1, 0 , 'C', true);
				$pdf->Cell(14, 7, 'Masculin', 1, 0 , 'C', true);
				$pdf->Cell(10, 7, 'Total', 1, 0 , 'C', true);
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Redoublant', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['FR'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['GR'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['R'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Nouveau', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['FN'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['GN'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['N'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Total', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['F'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['G'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['T'], 1, 0 , 'C');
				$pdf->Ln(10);
				
				$pdf->SetFont('Times','B',10);
				// Je positionne l'entete du tableau
				$pdf->Cell(10, 6, $pdf->convert('N°'), 1, 0 , 'C',true);
				$pdf->Cell(28, 6, $pdf->convert('Matricule'), 1, 0 , 'C',true);
				$pdf->Cell(75, 6, $pdf->convert('Nom Complet'), 1, 0 , 'C',true);
				$pdf->Cell(9, 6, $pdf->convert('Sexe'), 1, 0 , 'C',true);
				$pdf->Cell(13, 6, $pdf->convert('Statut'), 1, 0 , 'C',true);
				$pdf->Cell(55, 6, $pdf->convert('Date et lieu de naissance'), 1, 0 , 'C',true);
				$pdf->SetFont('Times','',10);
				$pdf->Ln(6);
				$a = 1;
				for($i=0;$i<count($classe['eleve']);$i++){
					$pdf->Cell(10, 6, $a, 1, 0 , 'C');
					$pdf->Cell(28, 6, $pdf->convert($classe['eleve'][$i]['rne']), 1, 0 , 'C');
					$pdf->Cell(75, 6, $pdf->convert($classe['eleve'][$i]['nom_complet']), 1, 0 , 'L');
					$pdf->Cell(9, 6, $pdf->convert($classe['eleve'][$i]['sexe']), 1, 0 , 'C');
					$pdf->Cell(13, 6, $pdf->convert($classe['eleve'][$i]['statut']), 1, 0 , 'C');
					$dateNaiss = $classe['eleve'][$i]['date_fr'].' à '.ucwords($classe['eleve'][$i]['lieu_naissance']);
					$pdf->Cell(55, 6, $pdf->convert($dateNaiss), 1, 0 , 'L');
					$pdf->Ln(6);
					$a++;
				}
				$texte = 'Fait a '.ucwords($_SESSION['information']['ville']);
				$texte.= ', le '.DATE('d / m / Y');
				$pdf->Cell(110);
				$pdf->Cell(70,10, $texte,0,0,'C');
				$pdf->Cell(20);
				
				$pdf->Ln(5);
				// $pdf->Cell(130,30, ' ');
				$pdf->SetFont('Arial','BI',10);
				// $titre = $classe['information']['titre'];
				$pdf->Cell(110);
				$pdf->Cell(70,10, $classe['information']['signataire_fr'],0,0,'C');
				$pdf->Cell(20);
				
				$fileName='liste_Eleve_';
				$fileName.= strtoupper(str_replace(' ','_',$classe['eleve'][0]['nom_classe']));
				$fileName.= '.pdf';
			} 
			
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		
		
		if($_SESSION['print']=='listeEleveOld'){
			$classe = $_SESSION['classe'];
			$pdf->SetFillColor(155, 150, 149);
			// La page doit s'afficher en fonction de la section 
			if($classe['section']=='en'){
				$pdf->addPage();
				$pdf->Entete();
				$titre = 'student list of ';
				$titre.= $classe['classe']['nom_classe'];
				$pdf->Titre($titre);
				
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Sex', 1, 0 , 'C', true);
				$pdf->Cell(12, 7, 'Female', 1, 0 , 'C', true);
				$pdf->Cell(14, 7, 'Male', 1, 0 , 'C', true);
				$pdf->Cell(10, 7, 'Global', 1, 0 , 'C', true);
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Repeater', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['FR'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['GR'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['R'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'New', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['FN'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['GN'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['N'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Global', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['F'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['G'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['T'], 1, 0 , 'C');
				$pdf->Ln(10);
				
				$pdf->SetFont('Times','B',10);
				// Je positionne l'entete du tableau
				$pdf->Cell(10, 6, $pdf->convert('N°'), 1, 0 , 'C',true);
				$pdf->Cell(28, 6, $pdf->convert('National Id'), 1, 0 , 'C',true);
				$pdf->Cell(75, 6, $pdf->convert('Full Name'), 1, 0 , 'C',true);
				$pdf->Cell(9, 6, $pdf->convert('Sex'), 1, 0 , 'C',true);
				$pdf->Cell(13, 6, $pdf->convert('Status'), 1, 0 , 'C',true);
				$pdf->Cell(55, 6, $pdf->convert('Date and place of birth'), 1, 0 , 'C',true);
				$pdf->SetFont('Times','',10);
				$pdf->Ln(6);
				$a = 1;
				for($i=0;$i<count($classe['eleve']);$i++){
					$pdf->Cell(10, 6, $a, 1, 0 , 'C');
					$pdf->Cell(28, 6, $pdf->convert($classe['eleve'][$i]['rne']), 1, 0 , 'C');
					$pdf->Cell(75, 6, $pdf->convert($classe['eleve'][$i]['nom_complet']), 1, 0 , 'L');
					$pdf->Cell(9, 6, $pdf->convert($classe['eleve'][$i]['sexe']), 1, 0 , 'C');
					$pdf->Cell(13, 6, $pdf->convert($classe['eleve'][$i]['statut']), 1, 0 , 'C');
					$dateNaiss = $classe['eleve'][$i]['date_naissance'].' at '.ucwords($classe['eleve'][$i]['lieu_naissance']);
					$pdf->Cell(55, 6, $pdf->convert($dateNaiss), 1, 0 , 'L');
					$pdf->Ln(6);
					$a++;
				}
				$texte = 'Done at '.ucwords($_SESSION['information']['ville']);
				$texte.= ', on the '.DATE('d  M  Y');
				$pdf->Cell(110);
				$pdf->Cell(70,10, $texte,0,0,'C');
				$pdf->Cell(20);
				
				$pdf->Ln(5);
				// $pdf->Cell(130,30, ' ');
				$pdf->SetFont('Arial','BI',10);
				// $titre = $classe['information']['titre'];
				$pdf->Cell(110);
				$pdf->Cell(70,10, $classe['information']['signataire_en'],0,0,'C');
				$pdf->Cell(20);
				
				$fileName='student_list_';
				$fileName.= strtoupper(str_replace(' ','_',$classe['classe']['nom_classe']));
				$fileName.= '.pdf';
			}
			elseif($classe['section']=='fr'){
				$pdf->addPage();
				$pdf->Entete();
				$titre = 'Liste des eleves de la ';
				$titre.= $classe['classe']['nom_classe'];
				$pdf->Titre($titre);
				
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Sexe', 1, 0 , 'C', true);
				$pdf->Cell(12, 7, 'Feminin', 1, 0 , 'C', true);
				$pdf->Cell(14, 7, 'Masculin', 1, 0 , 'C', true);
				$pdf->Cell(10, 7, 'Total', 1, 0 , 'C', true);
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Redoublant', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['FR'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['GR'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['R'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Nouveau', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['FN'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['GN'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['N'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Total', 1, 0 , 'C');
				$pdf->Cell(12, 7,  $classe['stat']['F'], 1, 0 , 'C');
				$pdf->Cell(14, 7,  $classe['stat']['G'], 1, 0 , 'C');
				$pdf->Cell(10, 7,  $classe['stat']['T'], 1, 0 , 'C');
				$pdf->Ln(10);
				
				$pdf->SetFont('Times','B',10);
				// Je positionne l'entete du tableau
				$pdf->Cell(10, 6, $pdf->convert('N°'), 1, 0 , 'C',true);
				$pdf->Cell(28, 6, $pdf->convert('Matricule'), 1, 0 , 'C',true);
				$pdf->Cell(75, 6, $pdf->convert('Nom Complet'), 1, 0 , 'C',true);
				$pdf->Cell(9, 6, $pdf->convert('Sexe'), 1, 0 , 'C',true);
				$pdf->Cell(13, 6, $pdf->convert('Statut'), 1, 0 , 'C',true);
				$pdf->Cell(55, 6, $pdf->convert('Date et lieu de naissance'), 1, 0 , 'C',true);
				$pdf->SetFont('Times','',10);
				$pdf->Ln(6);
				$a = 1;
				for($i=0;$i<count($classe['eleve']);$i++){
					$pdf->Cell(10, 6, $a, 1, 0 , 'C');
					$pdf->Cell(28, 6, $pdf->convert($classe['eleve'][$i]['rne']), 1, 0 , 'C');
					$pdf->Cell(75, 6, $pdf->convert($classe['eleve'][$i]['nom_complet']), 1, 0 , 'L');
					$pdf->Cell(9, 6, $pdf->convert($classe['eleve'][$i]['sexe']), 1, 0 , 'C');
					$pdf->Cell(13, 6, $pdf->convert($classe['eleve'][$i]['statut']), 1, 0 , 'C');
					$dateNaiss = $classe['eleve'][$i]['date_naissance'].' à '.ucwords($classe['eleve'][$i]['lieu_naissance']);
					$pdf->Cell(55, 6, $pdf->convert($dateNaiss), 1, 0 , 'L');
					$pdf->Ln(6);
					$a++;
				}
				$texte = 'Fait a '.ucwords($_SESSION['information']['ville']);
				$texte.= ', le '.DATE('d / m / Y');
				$pdf->Cell(110);
				$pdf->Cell(70,10, $texte,0,0,'C');
				$pdf->Cell(20);
				
				$pdf->Ln(5);
				// $pdf->Cell(130,30, ' ');
				$pdf->SetFont('Arial','BI',10);
				// $titre = $classe['information']['titre'];
				$pdf->Cell(110);
				$pdf->Cell(70,10, $classe['information']['signataire_fr'],0,0,'C');
				$pdf->Cell(20);
				
				$fileName='liste_Eleve_';
				$fileName.= strtoupper(str_replace(' ','_',$classe['classe']['nom_classe']));
				$fileName.= '.pdf';
			} 
			
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
		elseif($_SESSION['print']=='certificatScol'){
			$eleve = $_SESSION['eleve'];
			$classe = $_SESSION['classe'];
			$information = $_SESSION['information'];
			$pdf->SetFillColor(155, 150, 149);
			// La page doit s'afficher en fonction de la section 
			if($classe['section']=='en'){
				$pdf->addPage();
				$pdf->Entete();
				$pdf->certificatScolariteEn($eleve, $information);
			}
			elseif($classe['section']=='fr'){
				$pdf->addPage();
				$pdf->Entete();
				$pdf->certificatScolariteFr($eleve, $information);
			}
			$fileName = 'Certificat_Scolarite_';
			$fileName .= str_replace(' ','_', $eleve['nom_complet']);
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		elseif($_SESSION['print']=='certificatScolOld'){
			$eleve = $_SESSION['eleve'];
			$classe = $_SESSION['classe'];
			$information = $_SESSION['information'];
			$pdf->SetFillColor(155, 150, 149);
			// La page doit s'afficher en fonction de la section 
			if($classe['section']=='en'){
				$pdf->addPage();
				$pdf->Entete();
				$pdf->certificatScolariteEn($eleve, $information);
			}
			elseif($classe['section']=='fr'){
				$pdf->addPage();
				$pdf->Entete();
				$pdf->certificatScolariteFr($eleve, $information);
			}
			$fileName = 'Certificat_Scolarite_';
			$fileName .= str_replace(' ','_', $eleve['nom_complet']);
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
			$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$pdf->Ln(20);
			$titre = "NOTE DE SERVICE N°_______________ ";
			$titre .= "PORTANT PROPOSITION DES ";
			$pdf->SetFont('Times', 'B', 14);
			$pdf->Cell(140, 8, utf8_decode($titre), 0, 0 , 'L');
			$pdf->Ln(8);
			$titre = "PROFESSEURS PRINCIPAUX POUR L'ANNEE SCOLAIRE ";
			$titre .= $as;
			$pdf->SetFont('Times', 'B', 14);
			$pdf->Cell(140, 8, utf8_decode($titre), 0, 0 , 'L');
			
			$pdf->Ln(15);
			
			
			$pdf->SetFont('Arial','B',10);
			// Je positionne l'entete du tableau
			$pdf->Cell(10, 7, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(60, 7, 'Classe', 1, 0 , 'C');
			$pdf->Cell(70, 7, 'Professeur Principal', 1, 0 , 'C');
			
			$pdf->SetFont('Arial','',10);
			$i = 1;
			// Par boucle je récupère la liste envoyée dans une variable de session
			for($a=0;$a<count($_SESSION['liste']);$a++){
				$pdf->Ln(7);
				$pdf->Cell(10, 7, utf8_decode($i), 1, 0 , 'C');
				$pdf->Cell(60, 7, utf8_decode(ucwords($_SESSION['liste'][$a]['nom_classe'])), 1, 0 , 'C');
				$enseignant = strtoupper($_SESSION['liste'][$a]['nom']);
				$enseignant .=' '.ucwords($_SESSION['liste'][$a]['prenom']);
				$pdf->Cell(70, 7, utf8_decode($enseignant), 1, 0 , 'C');
				
				
				$i++;
			}
			$pdf->SetFont('Arial','B',12);
			$texte = 'N.B. : Les intéressés devront remplir le cahier ';
			$texte .= 'de charges du Professeur Principal.';
			$pdf->Ln(10);
			$pdf->Cell(110,7, utf8_decode($texte),0,0,'L');
			// Le signataire du document 
			$pdf->SetFont('Arial','',10);
			$pdf->Ln(10);
			$pdf->Cell(100,30, ' ');
			$arrondissement = $_SESSION['arrondissement'];
			$signataire = $_SESSION['signataire'];
			$pdf->Cell(100,30, 'Fait a '.ucwords($arrondissement).', le ___________');
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
		
		elseif($_SESSION['print']=='BullSeq'){
			
			if($_SESSION['section']=='en'){
				/****** PV SEQUENTIEL ALPHABETIQUE*****/
				$pdf->addPage();
				$pdf->EnteteDocAnglais($ministereAnglais, $paysAnglais, $etsAnglais, $deviseAnglais, $contact, $as);
				if($_SESSION['sequence']==1){
					$sequence = 'First Sequence';
				}elseif($_SESSION['sequence']==2){
					$sequence = 'Second Sequence';
				}elseif($_SESSION['sequence']==3){
					$sequence = 'Third Sequence';
				}elseif($_SESSION['sequence']==4){
					$sequence = 'Fourth Sequence';
				}elseif($_SESSION['sequence']==5){
					$sequence = 'Fifth Sequence';
				}elseif($_SESSION['sequence']==6){
					$sequence = 'Sixth Sequence';
				}
				$titre = $sequence." Report";
				$pdf->TitreSans($titre);
				$classe = "Class : ".strtoupper($_SESSION['nom_classe']);
				$effectifClasse = 'Roll: '.count($_SESSION['eleve']);
				$effectifEvalue = 'Evaluated : '.$_SESSION['eleve'][0]['classes'];
				$signataire = $_SESSION['signataire'];
				$pdf->SetFont('Times','B',12);
				$pdf->Text(10,50, utf8_decode($classe));
				$pdf->Text(100,50, utf8_decode($effectifClasse));
				$pdf->Text(10,60, utf8_decode($effectifEvalue));
				$pdf->Text(100,60, 'Sequence  : '.utf8_decode($sequence));
				$pdf->Ln(20);
				/*Construction du tableau Informationnel statistique*/
				$pdf->Cell(55,8,'',0,0,'C');
				$pdf->Cell(35,8,utf8_decode('Object'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Female'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Male'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Global'),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->SetFont('Times','',10);
				
				$pdf->Cell(35,8,utf8_decode('Averages'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Sub - Averages'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('General Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Percentage'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				
				$pdf->Cell(35,8,utf8_decode('First Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Last Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
				$pdf->Ln(10);
				
				
				
				// On propose sa propre couleur
				$pdf->SetFillColor(200,205,180);
				// Informations du PV
				$pdf->SetFont('Times','B',8);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C',true);
				$pdf->Cell(20,5,utf8_decode('National Id.'),1,0,'C',true);
				$pdf->Cell(55,5,utf8_decode('Full Name'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Sex'),1,0,'C',true);
				$pdf->Cell(15,5,utf8_decode('Average'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Rank'),1,0,'C',true);
				$pdf->Cell(25,5,utf8_decode('Appreciation'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Grade'),1,0,'C',true);
				$pdf->Cell(35,5,utf8_decode('Observations'),1,0,'C',true);
				$pdf->Ln(5);
				$a = 1;
				$pdf->SetFont('Times','',9);
				for($i=0;$i<count($_SESSION['eleve']);$i++){
					$pdf->Cell(10,5,utf8_decode($a),1,0,'C');
					$pdf->Cell(20,5,utf8_decode($_SESSION['eleve'][$i]['rne']),1,0,'C');
					$pdf->Cell(55,5,utf8_decode($_SESSION['eleve'][$i]['nom_eleve']),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($_SESSION['eleve'][$i]['sexe']),1,0,'C');
					// Si la moyenne est zéro, alors l'élève n'a pas été classé.
					if($_SESSION['eleve'][$i]['moyenne']=='0.00'){
						$pdf->Cell(15,5,utf8_decode('--'),1,0,'C');
						$pdf->Cell(10,5,utf8_decode('--'),1,0,'C');
					}
					else{
						if($_SESSION['eleve'][$i]['rang']=='1'){
							$rang = $_SESSION['eleve'][$i]['rang'].'st';
						}elseif($_SESSION['eleve'][$i]['rang']=='2'){
							$rang = $_SESSION['eleve'][$i]['rang'].'nd';
						}elseif($_SESSION['eleve'][$i]['rang']=='3'){
							$rang = $_SESSION['eleve'][$i]['rang'].'rd';
						}else{
							$rang = $_SESSION['eleve'][$i]['rang'].'th';
						}
						$pdf->Cell(15,5,utf8_decode($_SESSION['eleve'][$i]['moyenne']),1,0,'C');
						$pdf->Cell(10,5,utf8_decode($rang),1,0,'C');
					}				
					$pdf->Cell(25,5,utf8_decode(ucwords($_SESSION['eleve'][$i]['appreciation'])),1,0,'L');
					$pdf->Cell(10,5,utf8_decode(ucwords($_SESSION['eleve'][$i]['cote'])),1,0,'L');
					$pdf->Cell(35,5,utf8_decode(''),1,0,'C');
					$pdf->Ln(5);
					$a++;
				}
				$pdf->Ln(7);
				$pdf->Cell(100);
				$texte = 'Done at '.$ville.', on the '.DATE('M d, Y').'.';
				$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
				$pdf->Ln(10);
				$pdf->Cell(100);
				$pdf->Cell(60,5,utf8_decode($signataireAnglais),0,0,'R');
								
								
								
								
								/****** PV SEQUENTIEL DE MERITE *****/
				$pdf->addPage();
				$pdf->EnteteDocAnglais($ministereAnglais, $paysAnglais, $etsAnglais, $deviseAnglais, $contact, $as);
				if($_SESSION['sequence']==1){
					$sequence = 'First Sequence';
				}elseif($_SESSION['sequence']==2){
					$sequence = 'Second Sequence';
				}elseif($_SESSION['sequence']==3){
					$sequence = 'Third Sequence';
				}elseif($_SESSION['sequence']==4){
					$sequence = 'Fourth Sequence';
				}elseif($_SESSION['sequence']==5){
					$sequence = 'Fifth Sequence';
				}elseif($_SESSION['sequence']==6){
					$sequence = 'Sixth Sequence';
				}
				$titre = $sequence." Report";
				$pdf->TitreSans($titre);
				$classe = "Class : ".strtoupper($_SESSION['nom_classe']);
				$effectifClasse = 'Roll : '.count($_SESSION['eleve']);
				$effectifEvalue = 'Evaluated : '.$_SESSION['eleve'][0]['classes'];
				$signataire = $_SESSION['signataire'];
				$pdf->SetFont('Times','B',12);
				$pdf->Text(10,50, utf8_decode($classe));
				$pdf->Text(100,50, utf8_decode($effectifClasse));
				$pdf->Text(10,60, utf8_decode($effectifEvalue));
				$pdf->Text(100,60, 'Sequence  : '.utf8_decode($sequence));
				$pdf->Ln(20);
				/*Construction du tableau Informationnel statistique*/
				$pdf->Cell(55,8,'',0,0,'C');
				$pdf->Cell(35,8,utf8_decode('Object'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Female'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Male'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Global'),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->SetFont('Times','',10);
				
				$pdf->Cell(35,8,utf8_decode('Averages'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Sub - Averages'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('General Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Percentage'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				
				$pdf->Cell(35,8,utf8_decode('First Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Last Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
				$pdf->Ln(10);
				
				
				
				// On propose sa propre couleur
				$pdf->SetFillColor(200,205,180);
				// Informations du PV
				$pdf->SetFont('Times','B',8);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C',true);
				$pdf->Cell(20,5,utf8_decode('National Id.'),1,0,'C',true);
				$pdf->Cell(55,5,utf8_decode('Full Name'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Sex'),1,0,'C',true);
				$pdf->Cell(15,5,utf8_decode('Average'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Rank'),1,0,'C',true);
				$pdf->Cell(25,5,utf8_decode('Appreciation'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Grade'),1,0,'C',true);
				$pdf->Cell(35,5,utf8_decode('Observations'),1,0,'C',true);
				$pdf->Ln(5);
				$a = 1;
				$pdf->SetFont('Times','',9);
				for($i=0;$i<count($_SESSION['eleve2']);$i++){
					$pdf->Cell(10,5,utf8_decode($a),1,0,'C');
					$pdf->Cell(20,5,utf8_decode($_SESSION['eleve2'][$i]['rne']),1,0,'C');
					$pdf->Cell(55,5,utf8_decode($_SESSION['eleve2'][$i]['nom_eleve']),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($_SESSION['eleve2'][$i]['sexe']),1,0,'C');
					// Si la moyenne est zéro, alors l'élève n'a pas été classé.
					if($_SESSION['eleve2'][$i]['moyenne']=='0.00'){
						$pdf->Cell(15,5,utf8_decode('--'),1,0,'C');
						$pdf->Cell(10,5,utf8_decode('--'),1,0,'C');
					}
					else{
						if($_SESSION['eleve2'][$i]['rang']=='1'){
							$rang = $_SESSION['eleve2'][$i]['rang'].'st';
						}elseif($_SESSION['eleve2'][$i]['rang']=='2'){
							$rang = $_SESSION['eleve2'][$i]['rang'].'nd';
						}elseif($_SESSION['eleve2'][$i]['rang']=='3'){
							$rang = $_SESSION['eleve2'][$i]['rang'].'rd';
						}else{
							$rang = $_SESSION['eleve2'][$i]['rang'].'th';
						}
						$pdf->Cell(15,5,utf8_decode($_SESSION['eleve2'][$i]['moyenne']),1,0,'C');
						$pdf->Cell(10,5,utf8_decode($rang),1,0,'C');
					}				
					$pdf->Cell(25,5,utf8_decode(ucwords($_SESSION['eleve2'][$i]['appreciation'])),1,0,'L');
					$pdf->Cell(10,5,utf8_decode(ucwords($_SESSION['eleve2'][$i]['cote'])),1,0,'L');
					$pdf->Cell(35,5,utf8_decode(''),1,0,'C');
					$pdf->Ln(5);
					$a++;
				}
				$pdf->Ln(7);
				$pdf->Cell(100);
				$texte = 'Done at '.$ville.', on the '.DATE('M d, Y').'.';
				$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
				$pdf->Ln(10);
				$pdf->Cell(100);
				$pdf->Cell(60,5,utf8_decode($signataireAnglais),0,0,'R');
				
				
				
				/**** GENERATION DU BULLETIN SEQUENTIEL PAR ELEVE *****/
				
				$eleve = $_SESSION['eleve'];
				
				for($a=0;$a<count($eleve);$a++){
					$pdf->addPage();
					// On met l'entête du document
					$pdf->EnteteDocAnglais($ministereAnglais, $paysAnglais, $etsAnglais, $deviseAnglais, $contact, $as);
					// On met le titre du document
					$titre = $sequence." Reported Marks ";
					$pdf->SetFont('Times','BUI',14);
					// $pdf->SetFont('Times','BU',14);
					// Informations sur l'élève 
					$pdf->Text(40,45,strtoupper(utf8_decode($titre)));
					$pdf->SetFont('Times','',10);
					$lib_nom = 'Full Name : ';
					$lib_classe = 'Class : ';
					$lib_matricule = 'National Id. : ';
					$lib_effectif = 'Roll : ';
					$lib_dateNaissance = 'DAte of Birth : ';
					$lib_lieuNaissance = 'At : ';
					$lib_sexe = 'Sex : ';
					$lib_redoublant = 'Repeater : ';
					$lib_titulaire = 'Class Master : ';
					$pdf->Text(20,55,utf8_decode($lib_nom));
					$pdf->Text(120,55,utf8_decode($lib_classe));
					$pdf->Text(20,60,utf8_decode($lib_matricule));
					$pdf->Text(120,60,utf8_decode($lib_effectif));
					$pdf->Text(20,65,utf8_decode($lib_dateNaissance));
					$pdf->Text(100,65,utf8_decode($lib_lieuNaissance));
					$pdf->Text(20,70,utf8_decode($lib_sexe));
					$pdf->Text(50,70,utf8_decode($lib_redoublant));
					$pdf->Text(100,70,utf8_decode($lib_titulaire));
					
					$pdf->SetFont('Times','B',10);
					$nom = $eleve[$a]['nom_eleve'];
					$nomClasse = strtoupper($_SESSION['nom_classe']);
					$matricule = $eleve[$a]['rne'];
					$effectif = count($eleve);
					$dateNaissance = $eleve[$a]['date_fr'];
					$lieuNaissance = $eleve[$a]['lieu_naissance'];
					$sexe = $eleve[$a]['sexe'];
					$redoublant = $eleve[$a]['statut'];
					$titulaire = $_SESSION['professeurPrincipal'];
					$image =$eleve[$a]['photo'];
					
					$pdf->Text(50,55,utf8_decode($nom));
					$pdf->Text(140,55,utf8_decode($nomClasse));
					$pdf->Text(40,60,utf8_decode($matricule));
					$pdf->Text(150,60,utf8_decode($effectif));
					$pdf->Text(55,65,utf8_decode($dateNaissance));
					$pdf->Text(105,65,utf8_decode($lieuNaissance));
					$pdf->Text(30,70,utf8_decode($sexe));
					$pdf->Text(70,70,utf8_decode($redoublant));
					$pdf->Text(135,70,utf8_decode($titulaire));
					 
					// $pdf->Image($image, 30, 40, 10);
					// $pdf->Image($image, 170, 45, 22, 22);
					// Titre du Tableau du bulletin
					
					// On créé un espace supplémentaire entre le tableau et les info du haut
					$pdf->Ln(55);
					$pdf->SetFont('Times','B',8);
					$pdf->Cell(8);
					$pdf->Cell(40,6, utf8_decode('Subject'),1,0,'C',true);
					$pdf->Cell(35,6, utf8_decode('Competence'),1,0,'C',true);
					$pdf->Cell(12,6, utf8_decode('Note /20'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Coef'),1,0,'C',true);
					$pdf->Cell(15,6, utf8_decode('Product'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Min'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Max'),1,0,'C',true);
					$pdf->Cell(22,6, utf8_decode('Appreciation'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Grade'),1,0,'C',true);
					$pdf->Cell(20,6, utf8_decode('Observ..'),1,0,'C',true);
					$pdf->SetFont('Times','',8);
					$pdf->Ln(6);
					
					// On ressort une boucle qui liste les groupes définis
					for($b=0;$b<count($_SESSION['groupe']);$b++){
						$codeGroupe = $_SESSION['groupe'];
						$totalGroupe = $codeGroupe[$b].'_total';
						$coefGroupe = $codeGroupe[$b].'_coef';
						$minGroupe = $codeGroupe[$b].'_min';
						$maxGroupe = $codeGroupe[$b].'_max';
						$apprGroupe = $codeGroupe[$b].'_appreciation';
						$coteGroupe = $codeGroupe[$b].'_cote';
						$moyenneGroupe = $codeGroupe[$b].'_moyenne';
						
						// Pour chaque groupe, on ressort le code et le nom de la matière
						$test = $codeGroupe[$b];
						$nomMatiere = $_SESSION['nom_matiere'][$test];
						$codeMatiere = $_SESSION['code_matiere'][$test];
						for($c=0;$c<count($codeMatiere);$c++){
							$seq1 = $codeMatiere[$c].'_seq1';
							$competence = $codeMatiere[$c].'_competence';
							$seqCoef = $codeMatiere[$c].'_coef';
							$seqTotal = $codeMatiere[$c].'_total';
							$seqAppr = $codeMatiere[$c].'_appreciation';
							$seqMin = $codeMatiere[$c].'_min';
							$seqMax = $codeMatiere[$c].'_max';
							$seqCote = $codeMatiere[$c].'_cote';
							$enseignant = $codeMatiere[$c].'_enseignant';
							
							$pdf->Cell(8);
							// $matiereEnseignant = strtoupper($nomMatiere[$c]).' / ';
							// $matiereEnseignant .= $eleve[$a][$enseignant];
							$pdf->Cell(40,3, utf8_decode(strtoupper($nomMatiere[$c])),'LTR',0,'L');
							$pdf->Cell(35,6, utf8_decode($eleve[$a][$competence]),'LTR',0,'L');
							
							// Les notes à valeur zéro ne doivent pas apparaitre
							if($eleve[$a][$seq1]=='0.00' or $eleve[$a][$seq1]==''){
								$pdf->Cell(12,6, '--',1,0,'C');
								$pdf->Cell(10,6, '--',1,0,'C');
								$pdf->SetFont('Times','B',7);
								$pdf->Cell(15,6, '--',1,0,'C',true);
							}else{
								$pdf->Cell(12,6, utf8_decode($eleve[$a][$seq1]),1,0,'C');
								$pdf->Cell(10,6, utf8_decode($eleve[$a][$seqCoef]),1,0,'C');
								$pdf->SetFont('Times','B',7);
								$pdf->Cell(15,6, utf8_decode($eleve[$a][$seqTotal]),1,0,'C',true);
							}
							$pdf->SetFont('Times','',7);
							$pdf->Cell(10,6, utf8_decode($eleve[$a][$seqMin]),1,0,'C');
							$pdf->Cell(10,6, utf8_decode($eleve[$a][$seqMax]),1,0,'C');
							$pdf->Cell(22,6, utf8_decode(ucfirst($eleve[$a][$seqAppr])),1,0,'L');
							$pdf->Cell(10,6, utf8_decode(ucfirst($eleve[$a][$seqCote])),1,0,'L');
							$pdf->Cell(20,6, utf8_decode(''),1,0,'C');
							
							// $pdf->Cell(50,6, utf8_decode(ucfirst($eleve[$a][$trimAppr])),1,0,'L');
							// On Insère ici le nom de l'enseignant de la matière
							$pdf->Ln(3);
							$pdf->SetFont('Times','I',7);
							$pdf->Cell(55,3, utf8_decode($eleve[$a][$enseignant]),0,0,'C');
							
							$pdf->SetFont('Times','',7);
							$pdf->Ln(3);
						}
						$pdf->Cell(8);
						$pdf->SetFont('Times','B',8);
						$pdf->Cell(75,6, utf8_decode(strtoupper('Total of the Group '.$codeGroupe[$b])),1,0,'L',true);
						$pdf->Cell(12,6, utf8_decode($eleve[$a][$moyenneGroupe]),1,0,'C',true);
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$coefGroupe]),1,0,'C',true);
						$pdf->Cell(15,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C',true);
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$minGroupe]),1,0,'C',true);
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$maxGroupe]),1,0,'C',true);
						$pdf->Cell(22,6, utf8_decode($eleve[$a][$apprGroupe]),1,0,'C',true);
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$coteGroupe]),1,0,'C',true);
						$pdf->Cell(20,6, '',1,0,'C',true);
						$pdf->Ln(6);
						$pdf->SetFont('Times','',7);
					}
					$pdf->SetFont('Times','B',9);
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(87,6, utf8_decode('GLOBAL'),1,0,'C',true);
					// $pdf->Cell(12,6, utf8_decode($eleve[$a]['moyenne']),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode($eleve[$a]['total_coef']),1,0,'C',true);
					$pdf->Cell(15,6, utf8_decode($eleve[$a]['total_point']),1,0,'C',true);
					$pdf->Cell(35,6, utf8_decode('Average'),1,0,'C',true);
					
					$pdf->Cell(25,6, utf8_decode(ucwords($eleve[$a]['moyenne'])),1,0,'L',true);
					// $pdf->Cell(10,6, utf8_decode(ucwords($eleve[$a]['cote'])),1,0,'L',true);
					// $pdf->Cell(20,6, '',1,0,'L',true);
					$pdf->Ln(10);
					$pdf->Cell(8);
					
					$pdf->Cell(53,6,utf8_decode('Discipline'), 1,0,'C',true);
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(53,6,utf8_decode('Work'), 1,0,'C',true);
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(53,6,utf8_decode('Class Profile'), 1,0,'C',true);
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Abs Not Just.'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Avert. Cond.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode('Total Gén.'), 1,0,'C');
					$pdf->Cell(10,6,utf8_decode($eleve[$a]['total_point']), 1,0,'C');
					$pdf->Cell(26,6,utf8_decode('Appreciation'), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('General Average'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['moyGenTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Abs Just.'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Blame. Cond.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode('Coef'), 1,0,'C');
					$pdf->Cell(10,6,utf8_decode($eleve[$a]['total_coef']), 1,0,'C');
					$pdf->Cell(26,6,utf8_decode($eleve[$a]['appreciation']), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$minMax = "[ ".$_SESSION['statistique']['noteFaibleTotal'];
					$minMax .= " - ".$_SESSION['statistique']['noteForteTotal'];
					$minMax .= " ]";
					$pdf->Cell(30,6,utf8_decode('[Min - Max]'), 1,0,'C');
					$pdf->Cell(23,6,$minMax, 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Retards'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Exclusions'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(27,6,utf8_decode('Average'), 1,0,'C');
					if($eleve[$a]['moyenne']=='0.00'){
						$pdf->Cell(26,6,'--', 1,0,'C');
					}else{
						$pdf->Cell(26,6,utf8_decode($eleve[$a]['moyenne']), 1,0,'C');
					}
					// $pdf->Cell(26,6,'', 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('Nb Moyennes'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['moyTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Consignes'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Excl. Déf.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(27,6,utf8_decode('Grade'), 1,0,'C');
					if($eleve[$a]['moyenne']=='0.00'){
						$pdf->Cell(26,6,'--', 1,0,'C');
					}else{
						$pdf->Cell(26,6,utf8_decode($eleve[$a]['cote']), 1,0,'C');
					}
					// $pdf->Cell(26,6,'', 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('Percentage'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['tauxTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(20,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(10,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(26,6,'', 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(23,6,'', 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
										
					$pdf->SetFont('Times','I',9);
					$pdf->Cell(28,6,utf8_decode('CNA: Competences Not Acquired.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(28,6,utf8_decode('CWA: Competence Well Acquired.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(28,6,utf8_decode('CAA: Competences Averagely Acquired.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(28,6,utf8_decode('CVWA: Competences Very Well Acquired.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(28,6,utf8_decode('CA: Competences Acquired.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->SetFont('Times','B',9);
					
					// On doit pouvoir dire Non Classé au Rang et à la Moyenne 
					
					$texte = 'Done at '.$ville.' on the  ________________';
					$pdf->Text(135,230, utf8_decode($texte));
					
					$pdf->Text(10,250, utf8_decode('The Parent'));
					
					$pdf->Text(50,250, utf8_decode('Principal Teacher'));
					
					$pdf->Text(150,250, utf8_decode($signataireAnglais));
				}
				
				
				// Le nom du fichier sera Bull_Trimestre_NumeroTrimestre_Classe
				$nomFichier = 'Reported_Mark_Sequence_'.$_SESSION['sequence'].'_'.$_SESSION['nom_classe'].'.pdf';
				$pdf->Output($nomFichier, 'I');
			}
			
			elseif($_SESSION['section']=='fr'){
				/****** PV SEQUENTIEL ALPHABETIQUE*****/
				$pdf->addPage();
				$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
				if($_SESSION['sequence']==1){
					$sequence = 'Premiere Sequence';
				}elseif($_SESSION['sequence']==2){
					$sequence = 'Deuxieme Sequence';
				}elseif($_SESSION['sequence']==3){
					$sequence = 'Troisieme Sequence';
				}elseif($_SESSION['sequence']==4){
					$sequence = 'Quatrieme Sequence';
				}elseif($_SESSION['sequence']==5){
					$sequence = 'Cinquieme Sequence';
				}elseif($_SESSION['sequence']==6){
					$sequence = 'Sixieme Sequence';
				}
				$titre = "Procès Verbal de la ".$sequence;
				$pdf->TitreSans($titre);
				$classe = "Classe : ".strtoupper($_SESSION['nom_classe']);
				$effectifClasse = 'Effectif : '.count($_SESSION['eleve']);
				$effectifEvalue = 'Evalués : '.$_SESSION['eleve'][0]['classes'];
				$signataire = $_SESSION['signataire'];
				$pdf->SetFont('Times','B',12);
				$pdf->Text(10,50, utf8_decode($classe));
				$pdf->Text(100,50, utf8_decode($effectifClasse));
				$pdf->Text(10,60, utf8_decode($effectifEvalue));
				$pdf->Text(100,60, utf8_decode('Période  : ').utf8_decode($sequence));
				$pdf->Ln(20);
				/*Construction du tableau Informationnel statistique*/
				$pdf->Cell(55,8,'',0,0,'C');
				$pdf->Cell(35,8,utf8_decode('Libellé'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Féminin'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Masculin'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->SetFont('Times','',10);
				
				$pdf->Cell(35,8,utf8_decode('Moyennes'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Sous - Moyennes'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Moyenne Générale'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Taux Réussite'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				
				$pdf->Cell(35,8,utf8_decode('Forte Moyenne'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Faible Moyenne'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
				$pdf->Ln(10);
				
				
				
				// On propose sa propre couleur
				$pdf->SetFillColor(200,205,180);
				// Informations du PV
				$pdf->SetFont('Times','B',8);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C',true);
				$pdf->Cell(20,5,utf8_decode('Matricule'),1,0,'C',true);
				$pdf->Cell(55,5,utf8_decode('Noms et Prénoms'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Sexe'),1,0,'C',true);
				$pdf->Cell(15,5,utf8_decode('Moyenne'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Rang'),1,0,'C',true);
				$pdf->Cell(25,5,utf8_decode('Appréciation'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Cote'),1,0,'C',true);
				$pdf->Cell(35,5,utf8_decode('Observations'),1,0,'C',true);
				$pdf->Ln(5);
				$a = 1;
				$pdf->SetFont('Times','',9);
				for($i=0;$i<count($_SESSION['eleve']);$i++){
					$pdf->Cell(10,5,utf8_decode($a),1,0,'C');
					$pdf->Cell(20,5,utf8_decode($_SESSION['eleve'][$i]['rne']),1,0,'C');
					$pdf->Cell(55,5,utf8_decode($_SESSION['eleve'][$i]['nom_eleve']),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($_SESSION['eleve'][$i]['sexe']),1,0,'C');
					// Si la moyenne est zéro, alors l'élève n'a pas été classé.
					if($_SESSION['eleve'][$i]['moyenne']=='0.00'){
						$pdf->Cell(15,5,utf8_decode('--'),1,0,'C');
						$pdf->Cell(10,5,utf8_decode('--'),1,0,'C');
					}
					else{
						if($_SESSION['eleve'][$i]['rang']=='1'){
							$rang = $_SESSION['eleve'][$i]['rang'].'er';
						}else{
							$rang = $_SESSION['eleve'][$i]['rang'].'ème';
						}
						$pdf->Cell(15,5,utf8_decode($_SESSION['eleve'][$i]['moyenne']),1,0,'C');
						$pdf->Cell(10,5,utf8_decode($rang),1,0,'C');
					}				
					$pdf->Cell(25,5,utf8_decode(ucwords($_SESSION['eleve'][$i]['appreciation'])),1,0,'L');
					$pdf->Cell(10,5,utf8_decode(ucwords($_SESSION['eleve'][$i]['cote'])),1,0,'L');
					$pdf->Cell(35,5,utf8_decode(''),1,0,'C');
					$pdf->Ln(5);
					$a++;
				}
				$pdf->Ln(7);
				$pdf->Cell(100);
				$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
				$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
				$pdf->Ln(10);
				$pdf->Cell(100);
				$pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
								
								
								
								
								/****** PV SEQUENTIEL DE MERITE *****/
				$pdf->addPage();
				$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
				if($_SESSION['sequence']==1){
					$sequence = 'Premiere Sequence';
				}elseif($_SESSION['sequence']==2){
					$sequence = 'Deuxieme Sequence';
				}elseif($_SESSION['sequence']==3){
					$sequence = 'Troisieme Sequence';
				}elseif($_SESSION['sequence']==4){
					$sequence = 'Quatrieme Sequence';
				}elseif($_SESSION['sequence']==5){
					$sequence = 'Cinquieme Sequence';
				}elseif($_SESSION['sequence']==6){
					$sequence = 'Sixieme Sequence';
				}
				$titre = "Procès Verbal de la ".$sequence."";
				$pdf->TitreSans($titre);
				$classe = "Classe de : ".strtoupper($_SESSION['nom_classe']);
				$effectifClasse = 'Effectif Classe: '.count($_SESSION['eleve']);
				$effectifEvalue = 'Effectif Evalué : '.$_SESSION['eleve'][0]['classes'];
				$signataire = $_SESSION['signataire'];
				$pdf->SetFont('Times','B',12);
				$pdf->Text(10,50, utf8_decode($classe));
				$pdf->Text(100,50, utf8_decode($effectifClasse));
				$pdf->Text(10,60, utf8_decode($effectifEvalue));
				$pdf->Text(100,60, 'Sequence  : '.utf8_decode($sequence));
				$pdf->Ln(20);
				/*Construction du tableau Informationnel statistique*/
				$pdf->Cell(55,8,'',0,0,'C');
				$pdf->Cell(35,8,utf8_decode('Libellé'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Féminin'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Masculin'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->SetFont('Times','',10);
				
				$pdf->Cell(35,8,utf8_decode('Moyennes'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Sous - Moyennes'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Moyenne Générale'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Taux Réussite'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				
				$pdf->Cell(35,8,utf8_decode('Forte Moyenne'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Faible Moyenne'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
				$pdf->Ln(10);
				
				
				
				// On propose sa propre couleur
				$pdf->SetFillColor(200,205,180);
				// Informations du PV
				$pdf->SetFont('Times','B',8);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C',true);
				$pdf->Cell(20,5,utf8_decode('Matricule'),1,0,'C',true);
				$pdf->Cell(55,5,utf8_decode('Noms et Prénoms'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Sexe'),1,0,'C',true);
				$pdf->Cell(15,5,utf8_decode('Moyenne'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Rang'),1,0,'C',true);
				$pdf->Cell(25,5,utf8_decode('Appréciation'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Cote'),1,0,'C',true);
				$pdf->Cell(35,5,utf8_decode('Observations'),1,0,'C',true);
				$pdf->Ln(5);
				$a = 1;
				$pdf->SetFont('Times','',9);
				for($i=0;$i<count($_SESSION['eleve2']);$i++){
					$pdf->Cell(10,5,utf8_decode($a),1,0,'C');
					$pdf->Cell(20,5,utf8_decode($_SESSION['eleve2'][$i]['rne']),1,0,'C');
					$pdf->Cell(55,5,utf8_decode($_SESSION['eleve2'][$i]['nom_eleve']),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($_SESSION['eleve2'][$i]['sexe']),1,0,'C');
					// Si la moyenne est zéro, alors l'élève n'a pas été classé.
					if($_SESSION['eleve2'][$i]['moyenne']=='0.00'){
						$pdf->Cell(15,5,utf8_decode('--'),1,0,'C');
						$pdf->Cell(10,5,utf8_decode('--'),1,0,'C');
					}
					else{
						if($_SESSION['eleve2'][$i]['rang']=='1'){
							$rang = $_SESSION['eleve2'][$i]['rang'].'er';
						}else{
							$rang = $_SESSION['eleve2'][$i]['rang'].'ème';
						}
						$pdf->Cell(15,5,utf8_decode($_SESSION['eleve2'][$i]['moyenne']),1,0,'C');
						$pdf->Cell(10,5,utf8_decode($rang),1,0,'C');
					}				
					$pdf->Cell(25,5,utf8_decode(ucwords($_SESSION['eleve2'][$i]['appreciation'])),1,0,'L');
					$pdf->Cell(10,5,utf8_decode(ucwords($_SESSION['eleve2'][$i]['cote'])),1,0,'L');
					$pdf->Cell(35,5,utf8_decode(''),1,0,'C');
					$pdf->Ln(5);
					$a++;
				}
				$pdf->Ln(7);
				$pdf->Cell(100);
				$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
				$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
				$pdf->Ln(10);
				$pdf->Cell(100);
				$pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
				
				
				
				/**** GENERATION DU BULLETIN SEQUENTIEL PAR ELEVE *****/
				
				$eleve = $_SESSION['eleve'];
				
				for($a=0;$a<count($eleve);$a++){
					$pdf->addPage();
					// On met l'entête du document
					$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
					// On met le titre du document
					$titre = "Bulletin de Notes de la ".$sequence;
					$pdf->SetFont('Times','BUI',14);
					// $pdf->SetFont('Times','BU',14);
					// Informations sur l'élève 
					$pdf->Text(40,45,strtoupper(utf8_decode($titre)));
					$pdf->SetFont('Times','',10);
					$lib_nom = 'Noms et Prénoms : ';
					$lib_classe = 'Classe de  : ';
					$lib_matricule = 'Mat. Nat. : ';
					$lib_effectif = 'Effectif Classe : ';
					$lib_dateNaissance = 'Date de Naissance : ';
					$lib_lieuNaissance = 'à : ';
					$lib_sexe = 'Sexe : ';
					$lib_redoublant = 'Redoublant : ';
					$lib_titulaire = 'Professeur Principal : ';
					$pdf->Text(20,55,utf8_decode($lib_nom));
					$pdf->Text(120,55,utf8_decode($lib_classe));
					$pdf->Text(20,60,utf8_decode($lib_matricule));
					$pdf->Text(120,60,utf8_decode($lib_effectif));
					$pdf->Text(20,65,utf8_decode($lib_dateNaissance));
					$pdf->Text(100,65,utf8_decode($lib_lieuNaissance));
					$pdf->Text(20,70,utf8_decode($lib_sexe));
					$pdf->Text(50,70,utf8_decode($lib_redoublant));
					$pdf->Text(100,70,utf8_decode($lib_titulaire));
					
					$pdf->SetFont('Times','B',10);
					$nom = $eleve[$a]['nom_eleve'];
					$nomClasse = strtoupper($_SESSION['nom_classe']);
					$matricule = $eleve[$a]['rne'];
					$effectif = count($eleve);
					$dateNaissance = $eleve[$a]['date_fr'];
					$lieuNaissance = $eleve[$a]['lieu_naissance'];
					$sexe = $eleve[$a]['sexe'];
					$redoublant = $eleve[$a]['statut'];
					$titulaire = $_SESSION['professeurPrincipal'];
					$image =$eleve[$a]['photo'];
					
					$pdf->Text(50,55,utf8_decode($nom));
					$pdf->Text(140,55,utf8_decode($nomClasse));
					$pdf->Text(40,60,utf8_decode($matricule));
					$pdf->Text(150,60,utf8_decode($effectif));
					$pdf->Text(55,65,utf8_decode($dateNaissance));
					$pdf->Text(105,65,utf8_decode($lieuNaissance));
					$pdf->Text(30,70,utf8_decode($sexe));
					$pdf->Text(70,70,utf8_decode($redoublant));
					$pdf->Text(135,70,utf8_decode($titulaire));
					 
					// $pdf->Image($image, 30, 40, 10);
					// $pdf->Image($image, 170, 45, 22, 22);
					// Titre du Tableau du bulletin
					
					// On créé un espace supplémentaire entre le tableau et les info du haut
					$pdf->Ln(55);
					$pdf->SetFont('Times','B',8);
					$pdf->Cell(8);
					$pdf->Cell(40,6, utf8_decode('Matière'),1,0,'C',true);
					$pdf->Cell(35,6, utf8_decode('Competence'),1,0,'C',true);
					$pdf->Cell(12,6, utf8_decode('Note /20'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Coef'),1,0,'C',true);
					$pdf->Cell(15,6, utf8_decode('Produit'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Min'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Max'),1,0,'C',true);
					$pdf->Cell(22,6, utf8_decode('Appréciation'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Cote'),1,0,'C',true);
					$pdf->Cell(20,6, utf8_decode('Paraphe Ens.'),1,0,'C',true);
					$pdf->SetFont('Times','',8);
					$pdf->Ln(6);
					
					// On ressort une boucle qui liste les groupes définis
					for($b=0;$b<count($_SESSION['groupe']);$b++){
						$codeGroupe = $_SESSION['groupe'];
						$totalGroupe = $codeGroupe[$b].'_total';
						$coefGroupe = $codeGroupe[$b].'_coef';
						$minGroupe = $codeGroupe[$b].'_min';
						$maxGroupe = $codeGroupe[$b].'_max';
						$apprGroupe = $codeGroupe[$b].'_appreciation';
						$coteGroupe = $codeGroupe[$b].'_cote';
						$moyenneGroupe = $codeGroupe[$b].'_moyenne';
						
						// Pour chaque groupe, on ressort le code et le nom de la matière
						$test = $codeGroupe[$b];
						$nomMatiere = $_SESSION['nom_matiere'][$test];
						$codeMatiere = $_SESSION['code_matiere'][$test];
						for($c=0;$c<count($codeMatiere);$c++){
							$seq1 = $codeMatiere[$c].'_seq1';
							$competence = $codeMatiere[$c].'_competence';
							$seqCoef = $codeMatiere[$c].'_coef';
							$seqTotal = $codeMatiere[$c].'_total';
							$seqAppr = $codeMatiere[$c].'_appreciation';
							$seqCote = $codeMatiere[$c].'_cote';
							$seqMin = $codeMatiere[$c].'_min';
							$seqMax = $codeMatiere[$c].'_max';
							$enseignant = $codeMatiere[$c].'_enseignant';
							
							$pdf->Cell(8);
							// $matiereEnseignant = strtoupper($nomMatiere[$c]).' / ';
							// $matiereEnseignant .= $eleve[$a][$enseignant];
							$pdf->Cell(40,3, utf8_decode(strtoupper($nomMatiere[$c])),'LTR',0,'L');
							$pdf->Cell(35,6, utf8_decode($eleve[$a][$competence]),'LTR',0,'L');
							
							// Les notes à valeur zéro ne doivent pas apparaitre
							if($eleve[$a][$seq1]=='0.00' or $eleve[$a][$seq1]==''){
								$pdf->Cell(12,6, '--',1,0,'C');
								$pdf->Cell(10,6, '--',1,0,'C');
								$pdf->SetFont('Times','B',7);
								$pdf->Cell(15,6, '--',1,0,'C',true);
							}else{
								$pdf->Cell(12,6, utf8_decode($eleve[$a][$seq1]),1,0,'C');
								$pdf->Cell(10,6, utf8_decode($eleve[$a][$seqCoef]),1,0,'C');
								$pdf->SetFont('Times','B',7);
								$pdf->Cell(15,6, utf8_decode($eleve[$a][$seqTotal]),1,0,'C',true);
							}
							$pdf->SetFont('Times','',7);
							$pdf->Cell(10,6, utf8_decode($eleve[$a][$seqMin]),1,0,'C');
							$pdf->Cell(10,6, utf8_decode($eleve[$a][$seqMax]),1,0,'C');
							$pdf->Cell(22,6, utf8_decode(ucfirst($eleve[$a][$seqAppr])),1,0,'L');
							$pdf->Cell(10,6, utf8_decode(ucfirst($eleve[$a][$seqCote])),1,0,'L');
							$pdf->Cell(20,6, utf8_decode(''),1,0,'C');
							
							// $pdf->Cell(50,6, utf8_decode(ucfirst($eleve[$a][$trimAppr])),1,0,'L');
							// On Insère ici le nom de l'enseignant de la matière
							$pdf->Ln(3);
							$pdf->SetFont('Times','I',7);
							$pdf->Cell(55,3, utf8_decode($eleve[$a][$enseignant]),0,0,'C');
							
							$pdf->SetFont('Times','',7);
							$pdf->Ln(3);
						}
						$pdf->Cell(8);
						$pdf->SetFont('Times','B',8);
						$pdf->Cell(75,6, utf8_decode(strtoupper('Total du Groupe '.$codeGroupe[$b])),1,0,'L',true);
						$pdf->Cell(12,6, utf8_decode($eleve[$a][$moyenneGroupe]),1,0,'C',true);
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$coefGroupe]),1,0,'C',true);
						$pdf->Cell(15,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C',true);
						$pdf->Cell(10,6, $eleve[$a][$minGroupe],1,0,'C',true);
						$pdf->Cell(10,6, $eleve[$a][$maxGroupe],1,0,'C',true);
						$pdf->Cell(22,6, $eleve[$a][$apprGroupe],1,0,'C',true);
						$pdf->Cell(10,6, $eleve[$a][$coteGroupe],1,0,'C',true);
						$pdf->Cell(20,6, '',1,0,'C',true);
						$pdf->Ln(6);
						$pdf->SetFont('Times','',7);
					}
					$pdf->SetFont('Times','B',9);
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(87,6, utf8_decode('TOTAL'),1,0,'C',true);
					// $pdf->Cell(12,6, utf8_decode($eleve[$a]['moyenne']),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode($eleve[$a]['total_coef']),1,0,'C',true);
					$pdf->Cell(15,6, utf8_decode($eleve[$a]['total_point']),1,0,'C',true);
					$pdf->Cell(35,6, utf8_decode('Moyenne Obtenue'),1,0,'C',true);
					
					$pdf->Cell(25,6, utf8_decode(ucwords($eleve[$a]['moyenne'])),1,0,'L',true);
					// $pdf->Cell(10,6, utf8_decode(ucwords($eleve[$a]['cote'])),1,0,'L',true);
					// $pdf->Cell(20,6, '',1,0,'L',true);
					$pdf->Ln(10);
					$pdf->Cell(8);
					
					$pdf->Cell(53,6,utf8_decode('Discipline'), 1,0,'C',true);
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(53,6,utf8_decode('Travail'), 1,0,'C',true);
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(53,6,utf8_decode('Profil de la Classe'), 1,0,'C',true);
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Abs Non Just.'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Avert. Cond.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode('Total Gén.'), 1,0,'C');
					$pdf->Cell(10,6,utf8_decode($eleve[$a]['total_point']), 1,0,'C');
					$pdf->Cell(26,6,utf8_decode('Appréciation'), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('Moyenne Générale'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['moyGenTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Abs Just.'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Blâme. Cond.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode('Coef'), 1,0,'C');
					$pdf->Cell(10,6,utf8_decode($eleve[$a]['total_coef']), 1,0,'C');
					$pdf->Cell(26,6,utf8_decode($eleve[$a]['appreciation']), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$minMax = "[ ".$_SESSION['statistique']['noteFaibleTotal'];
					$minMax .= " - ".$_SESSION['statistique']['noteForteTotal'];
					$minMax .= " ]";
					$pdf->Cell(30,6,utf8_decode('[Min - Max]'), 1,0,'C');
					$pdf->Cell(23,6,$minMax, 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Retards'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Exclusions'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(27,6,utf8_decode('Moyenne'), 1,0,'C');
					if($eleve[$a]['moyenne']=='0.00'){
						$pdf->Cell(26,6,'--', 1,0,'C');
					}else{
						$pdf->Cell(26,6,utf8_decode($eleve[$a]['moyenne']), 1,0,'C');
					}
					// $pdf->Cell(26,6,'', 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('Nb Moyennes'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['moyTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Consignes'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Excl. Déf.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(27,6,utf8_decode('Côte'), 1,0,'C');
					if($eleve[$a]['moyenne']=='0.00'){
						$pdf->Cell(26,6,'--', 1,0,'C');
					}else{
						$pdf->Cell(26,6,utf8_decode($eleve[$a]['cote']), 1,0,'C');
					}
					// $pdf->Cell(26,6,'', 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('Taux de Réussite'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['tauxTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(20,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(10,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(26,6,'', 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(23,6,'', 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
										
					$pdf->SetFont('Times','I',9);
					$pdf->Cell(28,6,utf8_decode('CNA: Compétence Non Acquise.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(28,6,utf8_decode('CBA: Compétence Bien Acquise.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(28,6,utf8_decode('CMA: Compétence Moyennement Acquise.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(28,6,utf8_decode('CTBA: Compétence Très Bien Acquise.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(28,6,utf8_decode('CA: Compétence Acquise.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->SetFont('Times','B',9);
					
					// On doit pouvoir dire Non Classé au Rang et à la Moyenne 
					
					$texte = 'Fait à '.$ville.' le ________________';
					$pdf->Text(135,230, utf8_decode($texte));
					
					$pdf->Text(10,250, utf8_decode('Le Parent'));
					
					$pdf->Text(50,250, utf8_decode('Le Professeur Principal'));
					
					$pdf->Text(150,250, utf8_decode($signataire));
				}
				
				
				// Le nom du fichier sera Bull_Trimestre_NumeroTrimestre_Classe
				$nomFichier = 'Bulletin_Sequence_'.$_SESSION['sequence'].'_'.$_SESSION['nom_classe'].'.pdf';
				$pdf->Output($nomFichier, 'I');
			}
			
		}
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		**********	Génération du Bulletin trimestriel					*******
		***********************************************************************
		**********************************************************************/
		elseif($_SESSION['print']=='BullTrimestriel'){
			if($_SESSION['section']=='en'){
				/****** PV TRIMESTRIEL ALPHABETIQUE*****/
				$pdf->addPage();
				$pdf->EnteteDocAnglais($ministereAnglais, $paysAnglais, $etsAnglais, $deviseAnglais, $contact, $as);
				if($_SESSION['trimestre']==1){
					$trimestre = 'First Term';
				}elseif($_SESSION['trimestre']==2){
					$trimestre = 'Second Term';
				}elseif($_SESSION['trimestre']==3){
					$trimestre = 'Third Term';
				}
				$titre = $trimestre." Report";
				$pdf->TitreSans($titre);
				$classe = "Class : ".strtoupper($_SESSION['nom_classe']);
				$effectifClasse = 'Roll: '.count($_SESSION['eleve']);
				$effectifEvalue = 'Evaluated : '.$_SESSION['eleve'][0]['classes'];
				$signataire = $_SESSION['signataire'];
				$pdf->SetFont('Times','B',12);
				$pdf->Text(10,50, utf8_decode($classe));
				$pdf->Text(100,50, utf8_decode($effectifClasse));
				$pdf->Text(10,60, utf8_decode($effectifEvalue));
				$pdf->Text(100,60, 'Term  : '.utf8_decode($trimestre));
				$pdf->Ln(20);
				/*Construction du tableau Informationnel statistique*/
				$pdf->Cell(55,8,'',0,0,'C');
				$pdf->Cell(35,8,utf8_decode('Object'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Female'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Male'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Global'),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->SetFont('Times','',10);
				
				$pdf->Cell(35,8,utf8_decode('Averages'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Sub - Averages'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('General Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Percentage'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				
				$pdf->Cell(35,8,utf8_decode('First Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Last Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
				$pdf->Ln(10);
				
				
				
				// On propose sa propre couleur
				$pdf->SetFillColor(200,205,180);
				// Informations du PV
				$pdf->SetFont('Times','B',8);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C',true);
				$pdf->Cell(20,5,utf8_decode('National Id.'),1,0,'C',true);
				$pdf->Cell(55,5,utf8_decode('Full Name'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Sex'),1,0,'C',true);
				$pdf->Cell(15,5,utf8_decode('Average'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Rank'),1,0,'C',true);
				$pdf->Cell(22,5,utf8_decode('Appreciation'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Grade'),1,0,'C',true);
				$pdf->Cell(35,5,utf8_decode('Observations'),1,0,'C',true);
				$pdf->Ln(5);
				$a = 1;
				$pdf->SetFont('Times','',9);
				for($i=0;$i<count($_SESSION['eleve']);$i++){
					$pdf->Cell(10,5,utf8_decode($a),1,0,'C');
					$pdf->Cell(20,5,utf8_decode($_SESSION['eleve'][$i]['rne']),1,0,'C');
					$pdf->Cell(55,5,utf8_decode($_SESSION['eleve'][$i]['nom_eleve']),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($_SESSION['eleve'][$i]['sexe']),1,0,'C');
					// Si la moyenne est zéro, alors l'élève n'a pas été classé.
					if($_SESSION['eleve'][$i]['moyenne']=='0.00'){
						$pdf->Cell(15,5,utf8_decode('--'),1,0,'C');
						$pdf->Cell(10,5,utf8_decode('--'),1,0,'C');
					}
					else{
						if($_SESSION['eleve'][$i]['rang']=='1'){
							$rang = $_SESSION['eleve'][$i]['rang'].'st';
						}elseif($_SESSION['eleve'][$i]['rang']=='2'){
							$rang = $_SESSION['eleve'][$i]['rang'].'nd';
						}elseif($_SESSION['eleve'][$i]['rang']=='3'){
							$rang = $_SESSION['eleve'][$i]['rang'].'rd';
						}else{
							$rang = $_SESSION['eleve'][$i]['rang'].'th';
						}
						$pdf->Cell(15,5,utf8_decode($_SESSION['eleve'][$i]['moyenne']),1,0,'C');
						$pdf->Cell(10,5,utf8_decode($rang),1,0,'C');
					}				
					$pdf->Cell(22,5,utf8_decode(ucwords($_SESSION['eleve'][$i]['appreciation'])),1,0,'L');
					$pdf->Cell(10,5,utf8_decode(ucwords($_SESSION['eleve'][$i]['cote'])),1,0,'L');
					$pdf->Cell(35,5,utf8_decode(''),1,0,'C');
					$pdf->Ln(5);
					$a++;
				}
				$pdf->Ln(7);
				$pdf->Cell(100);
				$texte = 'Done at '.$ville.', on the '.DATE('M d, Y').'.';
				$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
				$pdf->Ln(10);
				$pdf->Cell(100);
				$pdf->Cell(60,5,utf8_decode($signataireAnglais),0,0,'R');
								
								
								
								
								/****** PV TRIMESTRIEL DE MERITE *****/
				$pdf->addPage();
				$pdf->EnteteDocAnglais($ministereAnglais, $paysAnglais, $etsAnglais, $deviseAnglais, $contact, $as);
				if($_SESSION['trimestre']==1){
					$trimestre = 'First Term';
				}elseif($_SESSION['trimestre']==2){
					$trimestre = 'Second Term';
				}elseif($_SESSION['trimestre']==3){
					$trimestre = 'Third Term';
				}
				$titre = $trimestre." Report";
				$pdf->TitreSans($titre);
				$classe = "Class : ".strtoupper($_SESSION['nom_classe']);
				$effectifClasse = 'Roll : '.count($_SESSION['eleve']);
				$effectifEvalue = 'Evaluated : '.$_SESSION['eleve'][0]['classes'];
				$signataire = $_SESSION['signataire'];
				$pdf->SetFont('Times','B',12);
				$pdf->Text(10,50, utf8_decode($classe));
				$pdf->Text(100,50, utf8_decode($effectifClasse));
				$pdf->Text(10,60, utf8_decode($effectifEvalue));
				$pdf->Text(100,60, 'Term  : '.utf8_decode($trimestre));
				$pdf->Ln(20);
				/*Construction du tableau Informationnel statistique*/
				$pdf->Cell(55,8,'',0,0,'C');
				$pdf->Cell(35,8,utf8_decode('Object'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Female'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Male'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Global'),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->SetFont('Times','',10);
				
				$pdf->Cell(35,8,utf8_decode('Averages'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Sub - Averages'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('General Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Percentage'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				
				$pdf->Cell(35,8,utf8_decode('First Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Last Average'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
				$pdf->Ln(10);
				
				
				
				// On propose sa propre couleur
				$pdf->SetFillColor(200,205,180);
				// Informations du PV
				$pdf->SetFont('Times','B',8);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C',true);
				$pdf->Cell(20,5,utf8_decode('National Id.'),1,0,'C',true);
				$pdf->Cell(55,5,utf8_decode('Full Name'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Sex'),1,0,'C',true);
				$pdf->Cell(15,5,utf8_decode('Average'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Rank'),1,0,'C',true);
				$pdf->Cell(25,5,utf8_decode('Appreciation'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Grade'),1,0,'C',true);
				$pdf->Cell(35,5,utf8_decode('Observations'),1,0,'C',true);
				$pdf->Ln(5);
				$a = 1;
				$pdf->SetFont('Times','',9);
				for($i=0;$i<count($_SESSION['eleve2']);$i++){
					$pdf->Cell(10,5,utf8_decode($a),1,0,'C');
					$pdf->Cell(20,5,utf8_decode($_SESSION['eleve2'][$i]['rne']),1,0,'C');
					$pdf->Cell(55,5,utf8_decode($_SESSION['eleve2'][$i]['nom_eleve']),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($_SESSION['eleve2'][$i]['sexe']),1,0,'C');
					// Si la moyenne est zéro, alors l'élève n'a pas été classé.
					if($_SESSION['eleve2'][$i]['moyenne']=='0.00'){
						$pdf->Cell(15,5,utf8_decode('--'),1,0,'C');
						$pdf->Cell(10,5,utf8_decode('--'),1,0,'C');
					}
					else{
						if($_SESSION['eleve2'][$i]['rang']=='1'){
							$rang = $_SESSION['eleve2'][$i]['rang'].'st';
						}elseif($_SESSION['eleve2'][$i]['rang']=='2'){
							$rang = $_SESSION['eleve2'][$i]['rang'].'nd';
						}elseif($_SESSION['eleve2'][$i]['rang']=='3'){
							$rang = $_SESSION['eleve2'][$i]['rang'].'rd';
						}else{
							$rang = $_SESSION['eleve2'][$i]['rang'].'th';
						}
						$pdf->Cell(15,5,utf8_decode($_SESSION['eleve2'][$i]['moyenne']),1,0,'C');
						$pdf->Cell(10,5,utf8_decode($rang),1,0,'C');
					}				
					$pdf->Cell(25,5,utf8_decode(ucwords($_SESSION['eleve2'][$i]['appreciation'])),1,0,'L');
					$pdf->Cell(10,5,utf8_decode(ucwords($_SESSION['eleve2'][$i]['cote'])),1,0,'L');
					$pdf->Cell(35,5,utf8_decode(''),1,0,'C');
					$pdf->Ln(5);
					$a++;
				}
				$pdf->Ln(7);
				$pdf->Cell(100);
				$texte = 'Done at '.$ville.', on the '.DATE('M d, Y').'.';
				$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
				$pdf->Ln(10);
				$pdf->Cell(100);
				$pdf->Cell(60,5,utf8_decode($signataireAnglais),0,0,'R');
				
				
				
				/**** GENERATION DU BULLETIN TRIMESTRIEL PAR ELEVE *****/
				
				$eleve = $_SESSION['eleve'];
				
				for($a=0;$a<count($eleve);$a++){
					$pdf->addPage();
					// On met l'entête du document
					$pdf->EnteteDocAnglais($ministereAnglais, $paysAnglais, $etsAnglais, $deviseAnglais, $contact, $as);
					// On met le titre du document
					$titre = $trimestre." Reported Marks ";
					$pdf->SetFont('Times','BUI',14);
					// $pdf->SetFont('Times','BU',14);
					// Informations sur l'élève 
					$pdf->Text(40,45,strtoupper(utf8_decode($titre)));
					$pdf->SetFont('Times','',10);
					$lib_nom = 'Full Name : ';
					$lib_classe = 'Class : ';
					$lib_matricule = 'National Id. : ';
					$lib_effectif = 'Roll : ';
					$lib_dateNaissance = 'Date of Birth : ';
					$lib_lieuNaissance = 'At : ';
					$lib_sexe = 'Sex : ';
					$lib_redoublant = 'Repeater : ';
					$lib_titulaire = 'Class Master : ';
					$pdf->Text(20,55,utf8_decode($lib_nom));
					$pdf->Text(120,55,utf8_decode($lib_classe));
					$pdf->Text(20,60,utf8_decode($lib_matricule));
					$pdf->Text(120,60,utf8_decode($lib_effectif));
					$pdf->Text(20,65,utf8_decode($lib_dateNaissance));
					$pdf->Text(100,65,utf8_decode($lib_lieuNaissance));
					$pdf->Text(20,70,utf8_decode($lib_sexe));
					$pdf->Text(50,70,utf8_decode($lib_redoublant));
					$pdf->Text(100,70,utf8_decode($lib_titulaire));
					
					$pdf->SetFont('Times','B',10);
					$nom = $eleve[$a]['nom_eleve'];
					$nomClasse = strtoupper($_SESSION['nom_classe']);
					$matricule = $eleve[$a]['rne'];
					$effectif = count($eleve);
					$dateNaissance = $eleve[$a]['date_fr'];
					$lieuNaissance = $eleve[$a]['lieu_naissance'];
					$sexe = $eleve[$a]['sexe'];
					$redoublant = $eleve[$a]['statut'];
					$titulaire = $_SESSION['professeurPrincipal'];
					$image =$eleve[$a]['photo'];
					
					$pdf->Text(50,55,utf8_decode($nom));
					$pdf->Text(140,55,utf8_decode($nomClasse));
					$pdf->Text(40,60,utf8_decode($matricule));
					$pdf->Text(150,60,utf8_decode($effectif));
					$pdf->Text(55,65,utf8_decode($dateNaissance));
					$pdf->Text(105,65,utf8_decode($lieuNaissance));
					$pdf->Text(30,70,utf8_decode($sexe));
					$pdf->Text(70,70,utf8_decode($redoublant));
					$pdf->Text(135,70,utf8_decode($titulaire));
					 
					// $pdf->Image($image, 30, 40, 10);
					// $pdf->Image($image, 170, 45, 22, 22);
					// Titre du Tableau du bulletin
					
					// On créé un espace supplémentaire entre le tableau et les info du haut
					$pdf->Ln(55);
					$pdf->SetFont('Times','B',8);
					$pdf->Cell(8);
					$pdf->Cell(40,6, utf8_decode('Subject'),1,0,'C',true);
					$pdf->Cell(50,6, utf8_decode('Competences'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Ev1'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Ev2'),1,0,'C',true);
					$pdf->Cell(12,6, utf8_decode('Aver.'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Coef'),1,0,'C',true);
					$pdf->Cell(12,6, utf8_decode('Product'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Grade'),1,0,'C',true);
					$pdf->Cell(16,6, utf8_decode('Min-Max'),1,0,'C',true);
					// $pdf->Cell(20,6, utf8_decode('Appreciation'),1,0,'C',true);
					
					$pdf->Cell(18,6, utf8_decode('Observ.'),1,0,'C',true);
					$pdf->SetFont('Times','',8);
					$pdf->Ln(6);
					
					// On ressort une boucle qui liste les groupes définis
					for($b=0;$b<count($_SESSION['groupe']);$b++){
						$codeGroupe = $_SESSION['groupe'];
						$totalGroupe = $codeGroupe[$b].'_total';
						$coefGroupe = $codeGroupe[$b].'_coef';
						$minGroupe = $codeGroupe[$b].'_min';
						$maxGroupe = $codeGroupe[$b].'_max';
						$apprGroupe = $codeGroupe[$b].'_appreciation';
						$coteGroupe = $codeGroupe[$b].'_cote';
						$moyenneGroupe = $codeGroupe[$b].'_moyenne';
						
						// Pour chaque groupe, on ressort le code et le nom de la matière
						$test = $codeGroupe[$b];
						$nomMatiere = $_SESSION['nom_matiere'][$test];
						$codeMatiere = $_SESSION['code_matiere'][$test];
						for($c=0;$c<count($codeMatiere);$c++){
							$seq1 = $codeMatiere[$c].'_seq1';
							$seq2 = $codeMatiere[$c].'_seq2';
							$trim = $codeMatiere[$c].'_trim';
							$competence_a = $codeMatiere[$c].'_competence_a';
							$competence_b = $codeMatiere[$c].'_competence_b';
							$trimCoef = $codeMatiere[$c].'_coef';
							$trimTotal = $codeMatiere[$c].'_total';
							$trimAppr = $codeMatiere[$c].'_appreciation';
							$trimMin = $codeMatiere[$c].'_min';
							$trimMax = $codeMatiere[$c].'_max';
							$trimCote = $codeMatiere[$c].'_cote';
							$enseignant = $codeMatiere[$c].'_enseignant';
							
							$pdf->Cell(8);
							
							// Les notes à valeur zéro ne doivent pas apparaitre
							$note1 = $eleve[$a][$seq1];
							if($note1='0.00' or $note1=='' or empty($note1)){$note1 = '--';}
							$note2 = $eleve[$a][$seq2];
							if($note2='0.00' or $note2=='' or empty($note2)){$note2 = '--';}
							$noteTrim = $eleve[$a][$trim];
							if($noteTrim='0.00' or $noteTrim=='' or empty($noteTrim)){$noteTrim = '--';}
							
							
							
							
							
							
							
							// $matiereEnseignant = strtoupper($nomMatiere[$c]).' / ';
							// $matiereEnseignant .= $eleve[$a][$enseignant];
							$pdf->Cell(40,3, utf8_decode(strtoupper($nomMatiere[$c])),'LTR',0,'L');
							$competence = $eleve[$a][$competence_a].' , '.$eleve[$a][$competence_b];
							$pdf->Cell(50,6, utf8_decode($competence),'LTR',0,'L');
							
							// Sequence 1 
							if($eleve[$a][$seq1]=='0.00'){
								$sequence_1 = '';
							}else{
								$sequence_1 = $eleve[$a][$seq1];
							}
							// Sequence 2
							if($eleve[$a][$seq2]=='0.00'){
								$sequence_2 = '';
							}else{
								$sequence_2 = $eleve[$a][$seq2];
							}
							// Trimestre 1
							if($eleve[$a][$trim]=='0.00'){
								$trimestr = '';
								$coef = '';
								$total = '';
							}else{
								$trimestr = $eleve[$a][$trim];
								$coef = $eleve[$a][$trimCoef];
								$total = $eleve[$a][$trimTotal];
							}
							$pdf->Cell(10,6, utf8_decode($sequence_1),1,0,'C');
							$pdf->Cell(10,6, utf8_decode($sequence_2),1,0,'C');
							$pdf->Cell(12,6, utf8_decode($trimestr),1,0,'C');
							$pdf->Cell(10,6, utf8_decode($coef),1,0,'C');
							$pdf->Cell(12,6, utf8_decode($total),1,0,'C',true);
							$pdf->Cell(10,6, utf8_decode($eleve[$a][$trimAppr]),1,0,'C');
							$minMax = "[".$eleve[$a][$trimMin]." - ".$eleve[$a][$trimMax]."]";
							$pdf->Cell(16,6, utf8_decode($minMax),1,0,'C');
							$pdf->Cell(18,6, utf8_decode(''),1,0,'C');
							
							// Les notes à valeur zéro ne doivent pas apparaitre
							
							$pdf->SetFont('Times','',7);
							
							
							// $pdf->Cell(50,6, utf8_decode(ucfirst($eleve[$a][$trimAppr])),1,0,'L');
							// On Insère ici le nom de l'enseignant de la matière
							$pdf->Ln(3);
							$pdf->SetFont('Times','I',7);
							
							$pdf->Cell(55,3, utf8_decode($eleve[$a][$enseignant]),0,0,'C');
							
							
							
							$pdf->SetFont('Times','',7);
							$pdf->Ln(3);
						}
						$pdf->Cell(8);
						$pdf->SetFont('Times','B',8);
						$pdf->Cell(110,6, utf8_decode(strtoupper('Total of the Group '.$codeGroupe[$b])),1,0,'C',true);
						$pdf->Cell(12,6, utf8_decode($eleve[$a][$moyenneGroupe]),1,0,'C',true);
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$coefGroupe]),1,0,'C',true);
						$pdf->Cell(12,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C',true);
						/*$pdf->Cell(10,6, utf8_decode($eleve[$a][$minGroupe]),1,0,'C',true);
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$maxGroupe]),1,0,'C',true);*/
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$apprGroupe]),1,0,'C',true);
						$pdf->Cell(34,6, '',1,0,'C',true);
						$pdf->Ln(6);
						$pdf->SetFont('Times','',7);
					}
					$pdf->SetFont('Times','B',9);
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(122,6, utf8_decode('GLOBAL'),1,0,'C',true);
					// $pdf->Cell(12,6, utf8_decode($eleve[$a]['moyenne']),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode($eleve[$a]['total_coef']),1,0,'C',true);
					$pdf->Cell(12,6, utf8_decode($eleve[$a]['total_point']),1,0,'C',true);
					
					if($eleve[$a]['moyenne']=='0.00'){
						$valeurMoyenne = 'Average : --';
					}else{
						$valeurMoyenne = 'Average : '.$eleve[$a]['moyenne'];
					}
					
					$pdf->Cell(45,6, utf8_decode($valeurMoyenne),1,0,'C',true);
					// $pdf->Cell(10,6, utf8_decode(ucwords($eleve[$a]['cote'])),1,0,'L',true);
					// $pdf->Cell(20,6, '',1,0,'L',true);
					$pdf->Ln(10);
					$pdf->Cell(8);
					
					$pdf->Cell(53,6,utf8_decode('Discipline'), 1,0,'C',true);
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(53,6,utf8_decode('Work'), 1,0,'C',true);
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(53,6,utf8_decode('Class Profile'), 1,0,'C',true);
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Abs Not Just.'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Avert. Cond.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode('Total Gén.'), 1,0,'C');
					$pdf->Cell(10,6,utf8_decode($eleve[$a]['total_point']), 1,0,'C');
					$pdf->Cell(26,6,utf8_decode('Appreciation'), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('General Average'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['moyGenTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Abs Just.'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Blame. Cond.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode('Coef'), 1,0,'C');
					$pdf->Cell(10,6,utf8_decode($eleve[$a]['total_coef']), 1,0,'C');
					$pdf->Cell(26,6,utf8_decode($eleve[$a]['appreciation']), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$minMax = "[ ".$_SESSION['statistique']['noteFaibleTotal'];
					$minMax .= " - ".$_SESSION['statistique']['noteForteTotal'];
					$minMax .= " ]";
					$pdf->Cell(30,6,utf8_decode('[Min - Max]'), 1,0,'C');
					$pdf->Cell(23,6,$minMax, 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Retards'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Exclusions'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(27,6,utf8_decode('Average'), 1,0,'C');
					if($eleve[$a]['moyenne']=='0.00'){
						$pdf->Cell(26,6,'--', 1,0,'C');
					}else{
						$pdf->Cell(26,6,utf8_decode($eleve[$a]['moyenne']), 1,0,'C');
					}
					// $pdf->Cell(26,6,'', 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('Nb Averages'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['moyTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Consignes'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Excl. Déf.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(27,6,utf8_decode('Grade'), 1,0,'C');
					if($eleve[$a]['moyenne']=='0.00'){
						$pdf->Cell(26,6,'--', 1,0,'C');
					}else{
						$pdf->Cell(26,6,utf8_decode($eleve[$a]['cote']), 1,0,'C');
					}
					// $pdf->Cell(26,6,'', 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('Percentage'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['tauxTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(20,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(27,6,utf8_decode('Student Rank'), 1,0,'C');
					if($eleve[$a]['rang']=='1'){
						$rank = $eleve[$a]['rang'].'st';
					}elseif($eleve[$a]['rang']=='2'){
						$rank = $eleve[$a]['rang'].'nd';
					}elseif($eleve[$a]['rang']=='3'){
						$rank = $eleve[$a]['rang'].'rd';
					}else{
						if($eleve[$a]['moyenne']=='0.00'){
							$rank = '--';
						}else{
							$rank = $eleve[$a]['rang'].'th';
						}
						
						
						
					}
					$rang = $rank.' / '.$eleve[$a]['classes'];
					$pdf->Cell(26,6,$rang, 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(23,6,'', 0,0,'C');
					/*$pdf->Cell(20,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(20,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(10,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(26,6,'', 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(23,6,'', 0,0,'C');*/
					$pdf->Ln(6);
					$pdf->Cell(8);
					
										
					$pdf->SetFont('Times','I',9);
					$pdf->Cell(28,6,utf8_decode('CNA: Competences Not Acquired.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(28,6,utf8_decode('CWA: Competence Well Acquired.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(28,6,utf8_decode('CAA: Competences Averagely Acquired.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(28,6,utf8_decode('CVWA: Competences Very Well Acquired.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(28,6,utf8_decode('CA: Competences Acquired.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->SetFont('Times','B',9);
					
					// On doit pouvoir dire Non Classé au Rang et à la Moyenne 
					
					$texte = 'Done at '.$ville.' on the  ________________';
					$pdf->Text(135,250, utf8_decode($texte));
					
					$pdf->Text(10,270, utf8_decode('The Parent'));
					
					$pdf->Text(50,270, utf8_decode('Principal Teacher'));
					
					$pdf->Text(150,270, utf8_decode($signataireAnglais));
				}
				
				$pdf->Footer();
				// Le nom du fichier sera Bull_Trimestre_NumeroTrimestre_Classe
				$nomFichier = $trimestre.' Reported_Mark_'.$_SESSION['nom_classe'].'.pdf';
				$pdf->Output($nomFichier, 'I');
			}
			
			elseif($_SESSION['section']=='fr'){
				/****** PV TRIMESTRIEL ALPHABETIQUE*****/
				$pdf->addPage();
				$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
				if($_SESSION['trimestre']==1){
					$trimestre = 'Premier Trimestre';
				}elseif($_SESSION['trimestre']==2){
					$trimestre = 'Deuxieme Trimestre';
				}elseif($_SESSION['trimestre']==3){
					$trimestre = 'Troisieme Trimestre';
				}
				$titre = "Procès verbal du ".$trimestre;
				$pdf->TitreSans($titre);
				$classe = "Classe : ".strtoupper($_SESSION['nom_classe']);
				$effectifClasse = 'Effectif: '.count($_SESSION['eleve']);
				$effectifEvalue = 'Eff. Eval. : '.$_SESSION['eleve'][0]['classes'];
				$signataire = $_SESSION['signataire'];
				$pdf->SetFont('Times','B',12);
				$pdf->Text(10,50, utf8_decode($classe));
				$pdf->Text(100,50, utf8_decode($effectifClasse));
				$pdf->Text(10,60, utf8_decode($effectifEvalue));
				$pdf->Text(100,60, 'Trimestre  : '.utf8_decode($trimestre));
				$pdf->Ln(20);
				/*Construction du tableau Informationnel statistique*/
				$pdf->Cell(55,8,'',0,0,'C');
				$pdf->Cell(35,8,utf8_decode('Libellé'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Feminin'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Masculin'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->SetFont('Times','',10);
				
				$pdf->Cell(35,8,utf8_decode('Moyennes'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Sous - Moyennes'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Moyenne Générale'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Pourcentage'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				
				$pdf->Cell(35,8,utf8_decode('Forte Moyenne'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Faible Moyenne'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
				$pdf->Ln(10);
				
				
				
				// On propose sa propre couleur
				$pdf->SetFillColor(200,205,180);
				// Informations du PV
				$pdf->SetFont('Times','B',8);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C',true);
				$pdf->Cell(20,5,utf8_decode('Matricule Nat.'),1,0,'C',true);
				$pdf->Cell(55,5,utf8_decode('Nom Complet'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Sexe:'),1,0,'C',true);
				$pdf->Cell(15,5,utf8_decode('Moyenne'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Rang'),1,0,'C',true);
				$pdf->Cell(22,5,utf8_decode('Appréciation'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Côte'),1,0,'C',true);
				$pdf->Cell(35,5,utf8_decode('Observations'),1,0,'C',true);
				$pdf->Ln(5);
				$a = 1;
				$pdf->SetFont('Times','',9);
				for($i=0;$i<count($_SESSION['eleve']);$i++){
					$pdf->Cell(10,5,utf8_decode($a),1,0,'C');
					$pdf->Cell(20,5,utf8_decode($_SESSION['eleve'][$i]['rne']),1,0,'C');
					$pdf->Cell(55,5,utf8_decode($_SESSION['eleve'][$i]['nom_eleve']),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($_SESSION['eleve'][$i]['sexe']),1,0,'C');
					// Si la moyenne est zéro, alors l'élève n'a pas été classé.
					if($_SESSION['eleve'][$i]['moyenne']=='0.00'){
						$pdf->Cell(15,5,utf8_decode('--'),1,0,'C');
						$pdf->Cell(10,5,utf8_decode('--'),1,0,'C');
					}
					else{
						if($_SESSION['eleve'][$i]['rang']=='1'){
							$rang = $_SESSION['eleve'][$i]['rang'].'er';
						}else{
							$rang = $_SESSION['eleve'][$i]['rang'].'ème';
						}
						$pdf->Cell(15,5,utf8_decode($_SESSION['eleve'][$i]['moyenne']),1,0,'C');
						$pdf->Cell(10,5,utf8_decode($rang),1,0,'C');
					}				
					$pdf->Cell(22,5,utf8_decode(ucwords($_SESSION['eleve'][$i]['appreciation'])),1,0,'L');
					$pdf->Cell(10,5,utf8_decode(ucwords($_SESSION['eleve'][$i]['cote'])),1,0,'L');
					$pdf->Cell(35,5,utf8_decode(''),1,0,'C');
					$pdf->Ln(5);
					$a++;
				}
				$pdf->Ln(7);
				$pdf->Cell(100);
				$texte = 'Fait à '.$ville.', le '.DATE('d / m / Y').'.';
				$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
				$pdf->Ln(10);
				$pdf->Cell(100);
				$pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
								
								
								
								
								/****** PV TRIMESTRIEL DE MERITE *****/
				$pdf->addPage();
				$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
				if($_SESSION['trimestre']==1){
					$trimestre = 'Premier Trimestre';
				}elseif($_SESSION['trimestre']==2){
					$trimestre = 'Deuxieme Trimestre';
				}elseif($_SESSION['trimestre']==3){
					$trimestre = 'Trosieme Trimestre';
				}
				$titre = "Procès Verbal du ".$trimestre;
				$pdf->TitreSans($titre);
				$classe = "Classe : ".strtoupper($_SESSION['nom_classe']);
				$effectifClasse = 'Effectif : '.count($_SESSION['eleve']);
				$effectifEvalue = 'Eff. Eval. : '.$_SESSION['eleve'][0]['classes'];
				$signataire = $_SESSION['signataire'];
				$pdf->SetFont('Times','B',12);
				$pdf->Text(10,50, utf8_decode($classe));
				$pdf->Text(100,50, utf8_decode($effectifClasse));
				$pdf->Text(10,60, utf8_decode($effectifEvalue));
				$pdf->Text(100,60, 'Term  : '.utf8_decode($trimestre));
				$pdf->Ln(20);
				/*Construction du tableau Informationnel statistique*/
				$pdf->Cell(55,8,'',0,0,'C');
				$pdf->Cell(35,8,utf8_decode('Libellé'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Feminin'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Masculin'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->SetFont('Times','',10);
				
				$pdf->Cell(35,8,utf8_decode('Moyennes'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Sous - Moyennes'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Moyenne Générale'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Pourcentage'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
				$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				
				$pdf->Cell(35,8,utf8_decode('Forte Moyenne'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
				$pdf->Ln(8);
				$pdf->Cell(55);
				$pdf->Cell(35,8,utf8_decode('Faible Moyenne'),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
				$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
				$pdf->Ln(10);
				
				
				
				// On propose sa propre couleur
				$pdf->SetFillColor(200,205,180);
				// Informations du PV
				$pdf->SetFont('Times','B',8);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C',true);
				$pdf->Cell(20,5,utf8_decode('Matricule Nat.'),1,0,'C',true);
				$pdf->Cell(55,5,utf8_decode('Nom Complet'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Sexe'),1,0,'C',true);
				$pdf->Cell(15,5,utf8_decode('Moyenne'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Rang'),1,0,'C',true);
				$pdf->Cell(25,5,utf8_decode('Appréciation'),1,0,'C',true);
				$pdf->Cell(10,5,utf8_decode('Cote'),1,0,'C',true);
				$pdf->Cell(35,5,utf8_decode('Observations'),1,0,'C',true);
				$pdf->Ln(5);
				$a = 1;
				$pdf->SetFont('Times','',9);
				for($i=0;$i<count($_SESSION['eleve2']);$i++){
					$pdf->Cell(10,5,utf8_decode($a),1,0,'C');
					$pdf->Cell(20,5,utf8_decode($_SESSION['eleve2'][$i]['rne']),1,0,'C');
					$pdf->Cell(55,5,utf8_decode($_SESSION['eleve2'][$i]['nom_eleve']),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($_SESSION['eleve2'][$i]['sexe']),1,0,'C');
					// Si la moyenne est zéro, alors l'élève n'a pas été classé.
					if($_SESSION['eleve2'][$i]['moyenne']=='0.00'){
						$pdf->Cell(15,5,utf8_decode('--'),1,0,'C');
						$pdf->Cell(10,5,utf8_decode('--'),1,0,'C');
					}
					else{
						if($_SESSION['eleve2'][$i]['rang']=='1'){
							$rang = $_SESSION['eleve2'][$i]['rang'].'er';
						}else{
							$rang = $_SESSION['eleve2'][$i]['rang'].'ème';
						}
						$pdf->Cell(15,5,utf8_decode($_SESSION['eleve2'][$i]['moyenne']),1,0,'C');
						$pdf->Cell(10,5,utf8_decode($rang),1,0,'C');
					}				
					$pdf->Cell(25,5,utf8_decode(ucwords($_SESSION['eleve2'][$i]['appreciation'])),1,0,'L');
					$pdf->Cell(10,5,utf8_decode(ucwords($_SESSION['eleve2'][$i]['cote'])),1,0,'L');
					$pdf->Cell(35,5,utf8_decode(''),1,0,'C');
					$pdf->Ln(5);
					$a++;
				}
				$pdf->Ln(7);
				$pdf->Cell(100);
				$texte = 'Fait à '.$ville.', le '.DATE('d / m/ Y').'.';
				$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
				$pdf->Ln(10);
				$pdf->Cell(100);
				$pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
				
				
				
				/**** GENERATION DU BULLETIN TRIMESTRIEL PAR ELEVE *****/
				
				$eleve = $_SESSION['eleve'];
				
				for($a=0;$a<count($eleve);$a++){
					$pdf->addPage();
					// On met l'entête du document
					$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
					// On met le titre du document
					$titre = "Bulletin de Notes du ".$trimestre;
					$pdf->SetFont('Times','BUI',14);
					// $pdf->SetFont('Times','BU',14);
					// Informations sur l'élève 
					$pdf->Text(40,45,strtoupper(utf8_decode($titre)));
					$pdf->SetFont('Times','',10);
					$lib_nom = 'Nom Complet : ';
					$lib_classe = 'Classe : ';
					$lib_matricule = 'Matricule : ';
					$lib_effectif = 'Effectif : ';
					$lib_dateNaissance = 'Date de Naissance : ';
					$lib_lieuNaissance = 'A : ';
					$lib_sexe = 'Sexe : ';
					$lib_redoublant = 'Redoublant : ';
					$lib_titulaire = 'Titulaire de la Classe : ';
					$pdf->Text(20,55,utf8_decode($lib_nom));
					$pdf->Text(120,55,utf8_decode($lib_classe));
					$pdf->Text(20,60,utf8_decode($lib_matricule));
					$pdf->Text(120,60,utf8_decode($lib_effectif));
					$pdf->Text(20,65,utf8_decode($lib_dateNaissance));
					$pdf->Text(100,65,utf8_decode($lib_lieuNaissance));
					$pdf->Text(20,70,utf8_decode($lib_sexe));
					$pdf->Text(50,70,utf8_decode($lib_redoublant));
					$pdf->Text(100,70,utf8_decode($lib_titulaire));
					
					$pdf->SetFont('Times','B',10);
					$nom = $eleve[$a]['nom_eleve'];
					$nomClasse = strtoupper($_SESSION['nom_classe']);
					$matricule = $eleve[$a]['rne'];
					$effectif = count($eleve);
					$dateNaissance = $eleve[$a]['date_fr'];
					$lieuNaissance = $eleve[$a]['lieu_naissance'];
					$sexe = $eleve[$a]['sexe'];
					$redoublant = $eleve[$a]['statut'];
					$titulaire = $_SESSION['professeurPrincipal'];
					$image =$eleve[$a]['photo'];
					
					$pdf->Text(50,55,utf8_decode($nom));
					$pdf->Text(140,55,utf8_decode($nomClasse));
					$pdf->Text(40,60,utf8_decode($matricule));
					$pdf->Text(150,60,utf8_decode($effectif));
					$pdf->Text(55,65,utf8_decode($dateNaissance));
					$pdf->Text(105,65,utf8_decode($lieuNaissance));
					$pdf->Text(30,70,utf8_decode($sexe));
					$pdf->Text(70,70,utf8_decode($redoublant));
					$pdf->Text(135,70,utf8_decode($titulaire));
					 
					// $pdf->Image($image, 30, 40, 10);
					// $pdf->Image($image, 170, 45, 22, 22);
					// Titre du Tableau du bulletin
					
					// On créé un espace supplémentaire entre le tableau et les info du haut
					$pdf->Ln(55);
					$pdf->SetFont('Times','B',8);
					$pdf->Cell(8);
					$pdf->Cell(40,6, utf8_decode('Matière'),1,0,'C',true);
					$pdf->Cell(50,6, utf8_decode('Compétences'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Ev1'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Ev2'),1,0,'C',true);
					$pdf->Cell(12,6, utf8_decode('Note.'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Coef'),1,0,'C',true);
					$pdf->Cell(12,6, utf8_decode('Produit'),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode('Côte'),1,0,'C',true);
					$pdf->Cell(16,6, utf8_decode('Min-Max'),1,0,'C',true);
					// $pdf->Cell(20,6, utf8_decode('Appreciation'),1,0,'C',true);
					
					$pdf->Cell(18,6, utf8_decode('Observ.'),1,0,'C',true);
					$pdf->SetFont('Times','',8);
					$pdf->Ln(6);
					
					// On ressort une boucle qui liste les groupes définis
					for($b=0;$b<count($_SESSION['groupe']);$b++){
						$codeGroupe = $_SESSION['groupe'];
						$totalGroupe = $codeGroupe[$b].'_total';
						$coefGroupe = $codeGroupe[$b].'_coef';
						$minGroupe = $codeGroupe[$b].'_min';
						$maxGroupe = $codeGroupe[$b].'_max';
						$apprGroupe = $codeGroupe[$b].'_appreciation';
						$coteGroupe = $codeGroupe[$b].'_cote';
						$moyenneGroupe = $codeGroupe[$b].'_moyenne';
						
						// Pour chaque groupe, on ressort le code et le nom de la matière
						$test = $codeGroupe[$b];
						$nomMatiere = $_SESSION['nom_matiere'][$test];
						$codeMatiere = $_SESSION['code_matiere'][$test];
						for($c=0;$c<count($codeMatiere);$c++){
							$seq1 = $codeMatiere[$c].'_seq1';
							$seq2 = $codeMatiere[$c].'_seq2';
							$trim = $codeMatiere[$c].'_trim';
							$competence_a = $codeMatiere[$c].'_competence_a';
							$competence_b = $codeMatiere[$c].'_competence_b';
							$trimCoef = $codeMatiere[$c].'_coef';
							$trimTotal = $codeMatiere[$c].'_total';
							$trimAppr = $codeMatiere[$c].'_appreciation';
							$trimMin = $codeMatiere[$c].'_min';
							$trimMax = $codeMatiere[$c].'_max';
							$trimCote = $codeMatiere[$c].'_cote';
							$enseignant = $codeMatiere[$c].'_enseignant';
							
							$pdf->Cell(8);
							
							// Les notes à valeur zéro ne doivent pas apparaitre
							$note1 = $eleve[$a][$seq1];
							if($note1='0.00' or $note1=='' or empty($note1)){$note1 = '--';}
							else{$note1 = $eleve[$a][$seq1];}
							$note2 = $eleve[$a][$seq2];
							if($note2='0.00' or $note2=='' or empty($note2)){$note2 = '--';}
							$noteTrim = $eleve[$a][$trim];
							if($noteTrim='0.00' or $noteTrim=='' or empty($noteTrim)){$noteTrim = '--';}
							
							
							
							
							
							
							
							// $matiereEnseignant = strtoupper($nomMatiere[$c]).' / ';
							// $matiereEnseignant .= $eleve[$a][$enseignant];
							$pdf->Cell(40,3, utf8_decode(strtoupper($nomMatiere[$c])),'LTR',0,'L');
							$competence = $eleve[$a][$competence_a].' , '.$eleve[$a][$competence_b];
							$pdf->Cell(50,6, utf8_decode($competence),'LTR',0,'L');
							
							$pdf->Cell(10,6, utf8_decode($eleve[$a][$seq1]),1,0,'C');
							$pdf->Cell(10,6, utf8_decode($eleve[$a][$seq2]),1,0,'C');
							$pdf->Cell(12,6, utf8_decode($eleve[$a][$trim]),1,0,'C');
							$pdf->Cell(10,6, utf8_decode($eleve[$a][$trimCoef]),1,0,'C');
							$pdf->Cell(12,6, utf8_decode($eleve[$a][$trimTotal]),1,0,'C',true);
							$pdf->Cell(10,6, utf8_decode($eleve[$a][$trimCote]),1,0,'C');
							$minMax = "[".$eleve[$a][$trimMin]." - ".$eleve[$a][$trimMax]."]";
							$pdf->Cell(16,6, utf8_decode($minMax),1,0,'C');
							$pdf->Cell(18,6, utf8_decode(''),1,0,'C');
							
							// Les notes à valeur zéro ne doivent pas apparaitre
							
							$pdf->SetFont('Times','',7);
							
							
							// $pdf->Cell(50,6, utf8_decode(ucfirst($eleve[$a][$trimAppr])),1,0,'L');
							// On Insère ici le nom de l'enseignant de la matière
							$pdf->Ln(3);
							$pdf->SetFont('Times','I',7);
							
							$pdf->Cell(55,3, utf8_decode($eleve[$a][$enseignant]),0,0,'C');
							
							
							
							$pdf->SetFont('Times','',7);
							$pdf->Ln(3);
						}
						$pdf->Cell(8);
						$pdf->SetFont('Times','B',8);
						$pdf->Cell(110,6, utf8_decode(strtoupper('Total du Groupe '.$codeGroupe[$b])),1,0,'C',true);
						$pdf->Cell(12,6, utf8_decode($eleve[$a][$moyenneGroupe]),1,0,'C',true);
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$coefGroupe]),1,0,'C',true);
						$pdf->Cell(12,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C',true);
						/*$pdf->Cell(10,6, utf8_decode($eleve[$a][$minGroupe]),1,0,'C',true);
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$maxGroupe]),1,0,'C',true);*/
						$pdf->Cell(10,6, utf8_decode($eleve[$a][$apprGroupe]),1,0,'C',true);
						$pdf->Cell(34,6, '',1,0,'C',true);
						$pdf->Ln(6);
						$pdf->SetFont('Times','',7);
					}
					$pdf->SetFont('Times','B',9);
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(122,6, utf8_decode('TOTAL'),1,0,'C',true);
					// $pdf->Cell(12,6, utf8_decode($eleve[$a]['moyenne']),1,0,'C',true);
					$pdf->Cell(10,6, utf8_decode($eleve[$a]['total_coef']),1,0,'C',true);
					$pdf->Cell(12,6, utf8_decode($eleve[$a]['total_point']),1,0,'C',true);
					
					$valeurMoyenne = 'Moyenne : '.$eleve[$a]['moyenne'];
					$pdf->Cell(45,6, utf8_decode($valeurMoyenne),1,0,'C',true);
					// $pdf->Cell(10,6, utf8_decode(ucwords($eleve[$a]['cote'])),1,0,'L',true);
					// $pdf->Cell(20,6, '',1,0,'L',true);
					$pdf->Ln(10);
					$pdf->Cell(8);
					
					$pdf->Cell(53,6,utf8_decode('Discipline'), 1,0,'C',true);
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(53,6,utf8_decode('Travail'), 1,0,'C',true);
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(53,6,utf8_decode('Profil de la classe'), 1,0,'C',true);
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Abs Non Just.'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Avert. Cond.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode('Total Gén.'), 1,0,'C');
					$pdf->Cell(10,6,utf8_decode($eleve[$a]['total_point']), 1,0,'C');
					$pdf->Cell(26,6,utf8_decode('Appréciation'), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('Moyenne Gé,érale'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['moyGenTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Abs Just.'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Blame. Cond.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(17,6,utf8_decode('Coef'), 1,0,'C');
					$pdf->Cell(10,6,utf8_decode($eleve[$a]['total_coef']), 1,0,'C');
					$pdf->Cell(26,6,utf8_decode($eleve[$a]['appreciation']), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$minMax = "[ ".$_SESSION['statistique']['noteFaibleTotal'];
					$minMax .= " - ".$_SESSION['statistique']['noteForteTotal'];
					$minMax .= " ]";
					$pdf->Cell(30,6,utf8_decode('[Min - Max]'), 1,0,'C');
					$pdf->Cell(23,6,$minMax, 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Retards'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Exclusions'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(27,6,utf8_decode('Moyenne'), 1,0,'C');
					if($eleve[$a]['moyenne']=='0.00'){
						$pdf->Cell(26,6,'--', 1,0,'C');
					}else{
						$pdf->Cell(26,6,utf8_decode($eleve[$a]['moyenne']), 1,0,'C');
					}
					// $pdf->Cell(26,6,'', 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('Nb Moyennes'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['moyTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode('Consignes'), 1,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(20,6,utf8_decode('Excl. Déf.'), 1,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(27,6,utf8_decode('Côte'), 1,0,'C');
					if($eleve[$a]['moyenne']=='0.00'){
						$pdf->Cell(26,6,'--', 1,0,'C');
					}else{
						$pdf->Cell(26,6,utf8_decode($eleve[$a]['cote']), 1,0,'C');
					}
					// $pdf->Cell(26,6,'', 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode('Pourcentage'), 1,0,'C');
					$pdf->Cell(23,6,$_SESSION['statistique']['tauxTotal'], 1,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->Cell(20,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(6,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(20,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(7,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(27,6,utf8_decode('Rang'), 1,0,'C');
					if($eleve[$a]['rang']=='1'){
						$rank = $eleve[$a]['rang'].'er';
					}elseif($eleve[$a]['rang']=='2'){
						$rank = $eleve[$a]['rang'].'nd';
					}else{
						$rank = $eleve[$a]['rang'].'eme';
					}
					$rang = $rank.' / '.$eleve[$a]['classes'];
					$pdf->Cell(26,6,$rang, 1,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(30,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(23,6,'', 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
										
					$pdf->SetFont('Times','I',9);
					$pdf->Cell(28,6,utf8_decode('CNA: Competences Non Acquise.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(28,6,utf8_decode('CBA: Competence Bien Acquise.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(28,6,utf8_decode('CMA: Competences Moyennement Acquise.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
					$pdf->Cell(28,6,utf8_decode('CTBA: Competences Très Bien Acquise.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					$pdf->Cell(28,6,utf8_decode('CA: Competences Acquise.'), 0,0,'C');
					$pdf->Cell(25,6,utf8_decode(''), 0,0,'C');
					$pdf->Ln(6);
					$pdf->Cell(8);
					
					$pdf->SetFont('Times','B',9);
					
					// On doit pouvoir dire Non Classé au Rang et à la Moyenne 
					
					$texte = 'Fait à  '.$ville.' le  ________________';
					$pdf->Text(135,240, utf8_decode($texte));
					
					$pdf->Text(10,260, utf8_decode('Le Parent'));
					
					$pdf->Text(50,260, utf8_decode('Le Professeur Principal'));
					
					$pdf->Text(150,260, utf8_decode($signataire));
				}
				
				$pdf->Footer();
				// Le nom du fichier sera Bull_Trimestre_NumeroTrimestre_Classe
				$nomFichier = 'Bulletin_'.$trimestre.'_'.$_SESSION['nom_classe'].'.pdf';
				$pdf->Output($nomFichier, 'I');
			}
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
	
	unset($_SESSION['liste']);
	unset($_SESSION['print']);
	unset($_SESSION['eleve']);
	unset($_SESSION['eleve2']);
	unset($_SESSION['bulletin']);
	unset($_SESSION['stat']);
	unset($_SESSION['professeurPrincipal']);
	
	
	unset($_SESSION['section']);
	// echo '<pre>';print_r($_SESSION['liste']);