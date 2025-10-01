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
	$pdf = new pdf();
	
	
	
	if(isset($_SESSION['print'])){
		// On charge les informations d'entête de l'établissement
		$ministere = $_SESSION['ministere'];
		$pays = $_SESSION['pays'];
		$ets = $_SESSION['ets'];
		$devise = $_SESSION['devise'];
		$contact = $_SESSION['contact'];
		$as = $_SESSION['as'];
		$ville = ucwords($_SESSION['arrondissement']);
		$titreSignataire = ucfirst($_SESSION['titre_signataire']);
		$signataire = ucfirst($_SESSION['signataire']);
		$nomChef = $_SESSION['chef_ets'];
		/**********************************************************************
		***********************************************************************
		****************	Impression de la liste des élèves	***************
		***********************************************************************
		**********************************************************************/
		 
		if($_SESSION['print']=='listeEleve'){
			/**********************SI LA SECTION EST ANGLOPHONE**************************/
			if($_SESSION['section']=='en'){
				$pdf->addPage();
				// On met l'entête du document
				$pdf->EnteteDocAnglais($ministereAnglais, 
								$paysAnglais, 
								$etsAnglais, 
								$deviseAnglais, 
								$contact, 
								$as);
				// On met le titre du document 
				$titre = strtoupper("Student List of ");
				if(!empty($_SESSION['liste'])){ // Si le Nom de la Classe n'est pas vide.
					$titre .= strtoupper($_SESSION['liste'][0]['nom_classe']);
				}
				$pdf->Titre($titre);
				// Informations de la classe
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Sex', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Female', 1, 0 , 'C');
				$pdf->Cell(14, 7, 'Male', 1, 0 , 'C');
				$pdf->Cell(10, 7, 'Global', 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Repeater', 1, 0 , 'C');
				$pdf->Cell(12, 7, $_SESSION['infoListe']['filleRed'], 1, 0 , 'C');
				$pdf->Cell(14, 7, $_SESSION['infoListe']['garconRed'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $_SESSION['infoListe']['redoublant'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'New', 1, 0 , 'C');
				$pdf->Cell(12, 7, $_SESSION['infoListe']['filleNv'], 1, 0 , 'C');
				$pdf->Cell(14, 7, $_SESSION['infoListe']['garconNv'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $_SESSION['infoListe']['nouveau'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Global', 1, 0 , 'C');
				$pdf->Cell(12, 7, $_SESSION['infoListe']['fille'], 1, 0 , 'C');
				$pdf->Cell(14, 7, $_SESSION['infoListe']['garcon'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $_SESSION['infoListe']['total'], 1, 0 , 'C');
				$pdf->Ln(15);
				$pdf->SetFont('Arial','B',10);
				// Je positionne l'entete du tableau
				$pdf->Cell(10, 6, utf8_decode('N°'), 1, 0 , 'C');
				$pdf->Cell(28, 6, utf8_decode('National Id'), 1, 0 , 'C');
				/*$pdf->Cell(20, 6, utf8_decode('Matricule'), 1, 0 , 'C');*/
				$pdf->Cell(64, 6, utf8_decode('Name and First Name'), 1, 0 , 'C');
				$pdf->Cell(9, 6, 'Sex', 1, 0 , 'C');
				$pdf->Cell(13, 6, 'Status', 1, 0 , 'C');
				$pdf->Cell(65, 6, 'Date and Place of Birth', 1, 0 , 'C');
				$pdf->SetFont('Arial','',8);
				$i = 1;
				
				// Par boucle je récupère la liste envoyée dans une variable de session
				for($a=0;$a<count($_SESSION['liste']);$a++){
					$pdf->Ln(6);
					$pdf->Cell(10, 6, $i, 1, 0 , 'C');
					$pdf->Cell(28, 6, $_SESSION['liste'][$a]['rne'], 1, 0 , 'C');
					/*$pdf->Cell(20, 6, $_SESSION['liste'][$a]['matricule'], 1, 0 , 'C');*/
					$nom = utf8_decode(strtoupper($_SESSION['liste'][$a]['nom']));
					$nom .= ' '.utf8_decode(ucwords($_SESSION['liste'][$a]['prenom']));
					$pdf->Cell(64, 6, $nom, 1, 0 , 'L');
					$pdf->Cell(9, 6, $_SESSION['liste'][$a]['sexe'], 1, 0 , 'C');
					$pdf->Cell(13, 6, $_SESSION['liste'][$a]['statut'], 1, 0 , 'C');
					$date_et_lieu = $_SESSION['liste'][$a]['date_naissance'];
					$date_et_lieu .= ' at ';
					$date_et_lieu .= ucwords($_SESSION['liste'][$a]['lieu_naissance']);
					$pdf->Cell(65, 6, utf8_decode($date_et_lieu), 1, 0 , 'L');
					$i++;
				}
				
				// Le signataire du document 
				$pdf->Ln(10);
				$pdf->Cell(100,30, ' ');
				$arrondissement = $_SESSION['arrondissement'];
				$signataire = $_SESSION['signataire'];
				$texteFaitA = utf8_decode('Done at ');
				$texteFaitA .= ucwords($arrondissement);
				$texteFaitA .= ', on the ';
				if(DATE('d')==1){
					$texteFaitA .= DATE('d').'st Of ';
				}elseif(DATE('d')==2){
					$texteFaitA .= DATE('d').'nd Of ';
				}elseif(DATE('d')==3){
					$texteFaitA .= DATE('d').'rd Of ';
				}else{
					$texteFaitA .= DATE('d').'th Of ';
				}
				$texteFaitA .= DATE('M, Y');
				$pdf->Cell(100,30, $texteFaitA);
				$pdf->Ln(10);
				$pdf->Cell(130,30, ' ');
				$pdf->SetFont('Arial','BI',10);
				$pdf->Cell(100,25, $signataireAnglais.',');
				// $pdf->setY(-20);
				$pdf->Footer();
				
				$pdf->setAuthor('Nyambi Computer Services');
				if(!empty($_SESSION['liste'])){
					$nomFichier = 'StudentList_'.$_SESSION['liste'][0]['code_classe'].'.pdf';
				}else{
					$nomFichier = 'EmptyData.pdf';
				}
				$pdf->Output($nomFichier, 'I');
			}
			/**********************SI LA SECTION EST FRANCOPHONE**************************/
			elseif($_SESSION['section']=='fr'){
				$pdf->addPage();
				// On met l'entête du document
				$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
				// On met le titre du document 
				$titre = "Liste des élèves de la ";
				if(!empty($_SESSION['liste'])){ // Si le Nom de la Classe n'est pas vide.
					$titre .= strtoupper($_SESSION['liste'][0]['nom_classe']);
				}
				$pdf->Titre($titre);
				// Informations de la classe
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Sexe', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Feminin', 1, 0 , 'C');
				$pdf->Cell(14, 7, 'Masculin', 1, 0 , 'C');
				$pdf->Cell(10, 7, 'Total', 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Redoublant', 1, 0 , 'C');
				$pdf->Cell(12, 7, $_SESSION['infoListe']['filleRed'], 1, 0 , 'C');
				$pdf->Cell(14, 7, $_SESSION['infoListe']['garconRed'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $_SESSION['infoListe']['redoublant'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Nouveaux', 1, 0 , 'C');
				$pdf->Cell(12, 7, $_SESSION['infoListe']['filleNv'], 1, 0 , 'C');
				$pdf->Cell(14, 7, $_SESSION['infoListe']['garconNv'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $_SESSION['infoListe']['nouveau'], 1, 0 , 'C');
				$pdf->Ln(7);
				$pdf->SetFont('Times','',8);
				$pdf->Cell(90);
				$pdf->Cell(14, 7, 'Total', 1, 0 , 'C');
				$pdf->Cell(12, 7, $_SESSION['infoListe']['fille'], 1, 0 , 'C');
				$pdf->Cell(14, 7, $_SESSION['infoListe']['garcon'], 1, 0 , 'C');
				$pdf->Cell(10, 7, $_SESSION['infoListe']['total'], 1, 0 , 'C');
				$pdf->Ln(15);
				$pdf->SetFont('Arial','B',10);
				// Je positionne l'entete du tableau
				$pdf->Cell(10, 6, utf8_decode('N°'), 1, 0 , 'C');
				$pdf->Cell(28, 6, utf8_decode('Mat. National'), 1, 0 , 'C');
				// $pdf->Cell(20, 6, utf8_decode('Matricule'), 1, 0 , 'C');
				$pdf->Cell(64, 6, utf8_decode('Noms et Prénoms'), 1, 0 , 'C');
				$pdf->Cell(9, 6, 'Sexe', 1, 0 , 'C');
				$pdf->Cell(13, 6, 'Statut', 1, 0 , 'C');
				$pdf->Cell(65, 6, 'Date et Lieu de Naissance', 1, 0 , 'C');
				$pdf->SetFont('Arial','',8);
				$i = 1;
				
				// Par boucle je récupère la liste envoyée dans une variable de session
				for($a=0;$a<count($_SESSION['liste']);$a++){
					$pdf->Ln(6);
					$pdf->Cell(10, 6, $i, 1, 0 , 'C');
					$pdf->Cell(28, 6, $_SESSION['liste'][$a]['rne'], 1, 0 , 'C');
					// $pdf->Cell(20, 6, $_SESSION['liste'][$a]['matricule'], 1, 0 , 'C');
					$nom = utf8_decode(strtoupper($_SESSION['liste'][$a]['nom']));
					$nom .= ' '.utf8_decode(ucwords($_SESSION['liste'][$a]['prenom']));
					$pdf->Cell(64, 6, $nom, 1, 0 , 'L');
					$pdf->Cell(9, 6, $_SESSION['liste'][$a]['sexe'], 1, 0 , 'C');
					$pdf->Cell(13, 6, $_SESSION['liste'][$a]['statut'], 1, 0 , 'C');
					$date_et_lieu = $_SESSION['liste'][$a]['date_fr'];
					$date_et_lieu .= ' à ';
					$date_et_lieu .= ucwords($_SESSION['liste'][$a]['lieu_naissance']);
					$pdf->Cell(65, 6, utf8_decode($date_et_lieu), 1, 0 , 'L');
					$i++;
				}
				
				// Le signataire du document 
				$pdf->Ln(10);
				$pdf->Cell(100,30, ' ');
				$arrondissement = $_SESSION['arrondissement'];
				$signataire = $_SESSION['signataire'];
				$pdf->Cell(100,30, utf8_decode('Fait à ').ucwords($arrondissement).', le '.DATE('d M Y'));
				$pdf->Ln(10);
				$pdf->Cell(130,30, ' ');
				$pdf->SetFont('Arial','BI',10);
				$pdf->Cell(100,25, $signataire.',');
				// $pdf->setY(-20);
				$pdf->Footer();
				
				$pdf->setAuthor('Nyambi Computer Services');
				if(!empty($_SESSION['liste'])){
					$nomFichier = 'ListeEleve_'.$_SESSION['liste'][0]['code_classe'].'.pdf';
				}else{
					$nomFichier = 'EmptyData.pdf';
				}
				$pdf->Output($nomFichier, 'I');
			}			
			/*****************		FIN DU PDF DE LA LISTE DES ELEVES ******************/
		}
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		****************	Impression des Relevés de Notes		***************
		***********************************************************************
		**********************************************************************/
		
		elseif($_SESSION['print']=='ReleveNote'){
			/**********************SI LA SECTION EST ANGLOPHONE**************************/
			if($_SESSION['section']=='en'){
				$pdf->addPage();
				// On met l'entête du document
				$pdf->EnteteDocAnglais($ministereAnglais, $paysAnglais, 
										$etsAnglais, $deviseAnglais, $contact, $as);
				// On met le titre du document 
				$titre = strtoupper("Reported Marks of the teacher  ");
				// $titre .= strtoupper($_SESSION['liste'][0]['nom_classe']);
				$pdf->Titre($titre);
				// Informations diverses
				$pdf->SetFont('Times','B',12);
				if(!empty($_SESSION['liste'])){
					$classe = utf8_decode(strtoupper($_SESSION['liste'][0]['nom_classe']));
				}else{
					$classe = '';
				}
				$pdf->Cell(20,10,'Class : '.$classe);
				$pdf->Ln(10);
				$pdf->SetFont('Times','',12);
				$pdf->Cell(80,8,'Subjet : ______________________',0,0,'L');
				$pdf->Cell(35,8,'Coef : _____',0,0,'L');
				$pdf->Cell(100,8,'Teacher :__________________________ ',0,0,'L');
				
				
				$pdf->Ln(15);
				
				
				$pdf->SetFont('Arial','B',10);
				// Je positionne l'entete du tableau
				$pdf->Cell(10, 7, 'N-', 1, 0 , 'C');
				$pdf->Cell(21, 7, 'Status', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Sex', 1, 0 , 'C');
				$pdf->Cell(70, 7, utf8_decode('Name and FirstName'), 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 1', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 2', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 3', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 4', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 5', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 6', 1, 0 , 'C');
			}
			
			
			
			
			/**********************SI LA SECTION EST FRANCOPHONE**************************/
			elseif($_SESSION['section']=='fr'){
				$pdf->addPage();
				// On met l'entête du document
				$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
				// On met le titre du document 
				$titre = "Releve de Notes de l'enseignant  ";
				// $titre .= strtoupper($_SESSION['liste'][0]['nom_classe']);
				$pdf->Titre($titre);
				// Informations diverses
				$pdf->SetFont('Times','B',12);
				if(!empty($_SESSION['liste'])){
					$classe = utf8_decode(strtoupper($_SESSION['liste'][0]['nom_classe']));
				}else{
					$classe = '';
				}
				$pdf->Cell(20,10,'Classe : '.$classe);
				$pdf->Ln(10);
				$pdf->SetFont('Times','',12);
				$pdf->Cell(80,8,'Matiere : ______________________',0,0,'L');
				$pdf->Cell(35,8,'Coef : _____',0,0,'L');
				$pdf->Cell(100,8,'Enseignant :__________________________ ',0,0,'L');
				
				
				$pdf->Ln(15);
				
				
				$pdf->SetFont('Arial','B',10);
				// Je positionne l'entete du tableau
				$pdf->Cell(10, 7, 'N-', 1, 0 , 'C');
				$pdf->Cell(21, 7, 'Statut', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Sexe', 1, 0 , 'C');
				$pdf->Cell(70, 7, utf8_decode('Noms et Prénoms'), 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 1', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 2', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 3', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 4', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 5', 1, 0 , 'C');
				$pdf->Cell(12, 7, 'Seq 6', 1, 0 , 'C');
			}
			
			
			
			
			$pdf->SetFont('Arial','',9);
			$i = 1;
			// Par boucle je récupère la liste envoyée dans une variable de session
			for($a=0;$a<count($_SESSION['liste']);$a++){
				$pdf->Ln(7);
				$pdf->Cell(10, 6, $i, 1, 0 , 'C');
				$pdf->Cell(21, 6, $_SESSION['liste'][$a]['statut'], 1, 0 , 'C');
				$pdf->Cell(12, 6, $_SESSION['liste'][$a]['sexe'], 1, 0 , 'C');
				$nom = utf8_decode(strtoupper($_SESSION['liste'][$a]['nom']));
				$nom .= ' '.utf8_decode(ucwords($_SESSION['liste'][$a]['prenom']));
				$pdf->Cell(70, 6, $nom, 1, 0 , 'L');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$pdf->Cell(12, 6, ' ', 1, 0 , 'C');
				$i++;
			}
			if(!empty($_SESSION['liste'])){
				$nomFichier = 'ReleveNotes_'.$_SESSION['liste'][0]['code_classe'].'.pdf';
			}else{
				$nomFichier = 'emptyData.php';
			}
			
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		
		
		/**************************************************************
		***************************************************************
		********** 		IMPRESSION DU CERTIFICAT DE SCOLARITE 	*******
		***************************************************************
		**************************************************************/
		elseif($_SESSION['print']=='certificatScol'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$titre = strtoupper("certificat de scolarite");
			// $titre .= strtoupper($_SESSION['liste'][0]['nom_classe']);
			$pdf->Titre($titre);
			
			
			// Informations diverses
			$pdf->SetFont('Times','BI',14);
			$annee_scolaire = $_SESSION['certificat']['annee_scolaire'];
			$pdf->Cell(150,10,utf8_decode('Année Scolaire : ').$annee_scolaire,0,0,'C');
			$pdf->Ln(15);
			
			$pdf->SetFillColor(155, 150, 149);
			// $pdf->SetTextColor(100,45,2);
			$phrase_1 = 'Je soussigné ';
			$pdf->SetFont('Times','',14);
			$pdf->Cell(70, 7, utf8_decode($phrase_1), 0, 0 , 'C');
			$pdf->SetFont('Times','B',14);
			$pdf->Cell(70, 7, $_SESSION['certificat']['nom_chef_ets'], 0, 0 , 'C');
			$pdf->Ln(10);
			$pdf->SetFont('Times','',14);
			$pdf->Cell(80, 7, $_SESSION['certificat']['titre_chef_ets'].' du ', 0, 0 , 'C');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(60, 7, utf8_decode(strtoupper($_SESSION['certificat']['nom_ets'])), 0, 0 , 'C');
			$pdf->Ln(10);
			$pdf->SetFont('Times','',14);
			$pdf->Cell(35, 7, 'Atteste que ', 0, 0 , 'C');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(100, 7, utf8_decode($_SESSION['certificat']['nom_eleve']), 0, 0 , 'C');
			$pdf->SetFont('Times','',14);
			$pdf->Cell(25, 7, 'Matricule : ', 0, 0 , 'C');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(32, 7, utf8_decode($_SESSION['certificat']['matricule_eleve']), 0, 0 , 'C');
			$pdf->Ln(10);
			$pdf->SetFont('Times','',14);
			$pdf->Cell(25, 7, utf8_decode('Né(e) le : '), 0, 0 , 'C');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(55, 7, utf8_decode($_SESSION['certificat']['date_naissance']), 0, 0 , 'C');
			$pdf->SetFont('Times','',14);
			$pdf->Cell(15, 7, utf8_decode('à : '), 0, 0 , 'C');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(85, 7, utf8_decode($_SESSION['certificat']['lieu_naissance']), 0, 0 , 'C');
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln(10);
			$pdf->SetFont('Times','',14);
			$pdf->Cell(25, 7, utf8_decode('De : '), 0, 0 , 'C');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(115, 7, utf8_decode($_SESSION['certificat']['nom_pere']), 0, 0 , 'C');
			$pdf->Ln(10);
			$pdf->SetFont('Times','',14);
			$pdf->Cell(25, 7, utf8_decode(' Et De : '), 0, 0 , 'C');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(115, 7, utf8_decode($_SESSION['certificat']['nom_mere']), 0, 0 , 'C');
			$pdf->Ln(10);
			$pdf->SetFont('Times','',14);
			$phrase_2 = "Est inscrit comme élève de notre";
			$phrase_2 .= " établissement durant l'année scolaire ";
			$pdf->Cell(160, 7, utf8_decode($phrase_2), 0,0,'C');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(30, 7, utf8_decode($annee_scolaire), 0,0,'C');
			$pdf->Ln(10);
			$pdf->SetFont('Times','',14);
			$pdf->Cell(40, 7, utf8_decode('En classe de : '), 0,0,'C');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(100, 7, utf8_decode($_SESSION['certificat']['nom_classe']), 0,0,'C');
			$pdf->Ln(10);
			$pdf->SetFont('Times','',14);
			$pdf->Cell(70, 7, utf8_decode('Son Matricule National est : '), 0,0,'C');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(100, 7, utf8_decode($_SESSION['certificat']['rne']), 0,0,'C');
			
			
			
			// Le signataire du document 
			$pdf->Ln(10);
			$pdf->Cell(100,30, ' ');
			$arrondissement = $_SESSION['arrondissement'];
			$signataire = $_SESSION['signataire'];
			$pdf->SetFont('Times','',14);
			$pdf->Cell(100,30, utf8_decode('Fait à ').ucwords($arrondissement).', le '.DATE('d M Y'));
			$pdf->Ln(10);
			$pdf->Cell(130,30, ' ');
			$pdf->SetFont('Times','BI',14);
			$pdf->Cell(100,25, $signataire.',');
			// $pdf->setY(-20);
			// $pdf->Footer();
			
			$pdf->setAuthor('Nyambi Computer Services');
			$pdf->setCreator('Cell Info '.$_SESSION['certificat']['nom_ets']);
			$as = str_replace(' ','_',$_SESSION['certificat']['annee_scolaire']);
			$nomOut = str_replace(' ','_',$_SESSION['certificat']['nom_eleve']);
			$nomFichier = 'CERTIFICAT_DE_SCOLARITE_'.$as.'_'.$nomOut.'.pdf';
			$pdf->Output($nomFichier, 'I');
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
			$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$titre = "Enseignants de la classe de ".$_SESSION['liste'][0]['id_classe']."";
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
				$enseignant = strtoupper($_SESSION['liste'][$a]['nom']).' '.ucwords($_SESSION['liste'][$a]['prenom']);
				$pdf->Cell(100, 6, utf8_decode($enseignant), 1, 0 );
				$i++;
			}
			$nomFichier = 'ConseilDeClasse_'.$_SESSION['liste'][0]['id_classe'].'.pdf';
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
		
		elseif($_SESSION['print']=='VueEffectif'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$titre = "Vue d'Ensemble des Effectifs ";
			// $titre .= strtoupper($_SESSION['liste'][0]['nom_classe']);
			$pdf->Titre($titre);
			
			$pdf->SetFont('Times','B',10);
			$pdf->Cell(50);
			$pdf->Cell(8, 5, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(40, 5, 'Classe', 1, 0 , 'C');
			$pdf->Cell(15, 5, 'Masculin', 1, 0 , 'C');
			$pdf->Cell(15, 5, 'Feminin', 1, 0 , 'C');
			$pdf->Cell(25, 5, 'Total', 1, 0 , 'C');
			$pdf->Ln(5);
			
			$liste = $_SESSION['liste'];
			$nom_classe = $_SESSION['nom_classe'];
			$code_classe = $_SESSION['code_classe'];
			$a = 1;
			for($i=0;$i<count($liste);$i++){
				$pdf->SetFont('Times','',10);
				$pdf->Cell(50);
				$pdf->Cell(8, 5, $a, 1, 0 , 'C');
				$pdf->Cell(40, 5, utf8_decode(ucwords($nom_classe[$i])), 1, 0 , 'C');
				$pdf->Cell(15, 5, $liste[$code_classe[$i]]['garcon'], 1, 0 , 'C');
				$pdf->Cell(15, 5, $liste[$code_classe[$i]]['fille'], 1, 0 , 'C');
				$pdf->SetFont('Times','B',10);
				$pdf->Cell(25, 5, $liste[$code_classe[$i]]['total'], 1, 0 , 'C');
				$pdf->SetFont('Times','',10);
				$pdf->Ln(5);
				$a++;
				$garcon[] = $liste[$code_classe[$i]]['garcon'];
				$fille[] = $liste[$code_classe[$i]]['fille'];
				$nbGarcon = array_sum($garcon);
				$nbFille = array_sum($fille);
				$nbTotal = $nbGarcon + $nbFille;
			}
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(50);
			$pdf->Cell(48, 6, utf8_decode('TOTAL'), 1, 0 , 'C');
			$pdf->Cell(15, 6, $nbGarcon, 1, 0 , 'C');
			$pdf->Cell(15, 6, $nbFille, 1, 0 , 'C');
			$pdf->Cell(25, 6, $nbTotal, 1, 0 , 'C');
			$pdf->Ln(8);
			// Le nom du fichier sera VueDensembleDesEffectifs
			$nomFichier = 'VueDensembleDesEffectifs.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		**********	Génération du Bulletin séquentiel					*******
		***********************************************************************
		**********************************************************************/
		
		elseif($_SESSION['print']=='BullSeq'){
			
			/****** PROBABLE POSITION DU PV TRIMESTRIEL ALPHABETIQUE*****/
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
			
			
			/*Construction du tableau Informationnel statistique*/
			$pdf->Ln(15);
			$pdf->SetFont('Times','B',12);
			$pdf->SetFillColor(200,205,180);
			$pdf->Cell(40);
			$pdf->Cell(95,8, utf8_decode(strtoupper('statistiques des moyennes')),1,0,'C',true);
			$pdf->SetFont('Times','B',10);
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Libellé'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Féminin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Masculin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(35,8,utf8_decode('Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Sous - Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Moyenne Générale'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Taux Réussite'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Forte Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Faible Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$pdf->Ln(10);
			
			// Informations du PV
			$pdf->SetFont('Times','B',8);
			$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',true);
			$pdf->Cell(20,6,utf8_decode('Matricule'),1,0,'C',true);
			$pdf->Cell(55,6,utf8_decode('Noms et Prénoms'),1,0,'C',true);
			$pdf->Cell(10,6,utf8_decode('Sexe'),1,0,'C',true);
			$pdf->Cell(15,6,utf8_decode('Moyenne'),1,0,'C',true);
			$pdf->Cell(10,6,utf8_decode('Rang'),1,0,'C',true);
			$pdf->Cell(25,6,utf8_decode('Appréciation'),1,0,'C',true);
			$pdf->Cell(10,6,utf8_decode('Cote'),1,0,'C',true);
			$pdf->Cell(35,6,utf8_decode('Observations'),1,0,'C',true);
			$pdf->Ln(6);
			$a = 1;
			$pdf->SetFont('Times','',9);
			for($i=0;$i<count($_SESSION['eleve']);$i++){
				$pdf->Cell(10,6,utf8_decode($a),1,0,'C');
				$pdf->Cell(20,6,utf8_decode($_SESSION['eleve'][$i]['matricule']),1,0,'C');
				$pdf->Cell(55,6,utf8_decode($_SESSION['eleve'][$i]['nom_eleve']),1,0,'L');
				$pdf->Cell(10,6,utf8_decode($_SESSION['eleve'][$i]['sexe']),1,0,'C');
				// Si la moyenne est zéro, alors l'élève n'a pas été classé.
				if($_SESSION['eleve'][$i]['moyenne']=='0.00'){
					$pdf->Cell(15,6,utf8_decode(' '),1,0,'C');
					$pdf->Cell(10,6,utf8_decode(' '),1,0,'C');
				}
				else{
					$pdf->Cell(15,6,utf8_decode($_SESSION['eleve'][$i]['moyenne']),1,0,'C');
					$pdf->Cell(10,6,utf8_decode($_SESSION['eleve'][$i]['rang']),1,0,'C');
				}				
				$pdf->Cell(25,6,utf8_decode(ucwords($_SESSION['eleve'][$i]['appreciation'])),1,0,'L');
				$pdf->Cell(10,6,utf8_decode(ucwords($_SESSION['eleve'][$i]['cote'])),1,0,'L');
				$pdf->Cell(35,6,utf8_decode(''),1,0,'C');
				$pdf->Ln(6);
				$a++;
			}
			$pdf->Ln(10);
			$pdf->Cell(100);
			$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
			$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
			$pdf->Ln(10);
			$pdf->Cell(100);
			$pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
			
			
			/******* PROBABLE FIN DU PV TRIMESTRIEL ALPHABETIQUE ******/
			
			
			
			
			
			
			/****** PROBABLE POSITION DU PV TRIMESTRIEL DE MERITE *****/
			$pdf->addPage();
			$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
			
			$seq_impaire = 'seq1';
			$seq_paire = 'seq2';
			$codeTri = 'trim';
			
			
			$titre = "Procès Verbal de la  ".$sequence;
			$pdf->TitreSans($titre);
			
			$classe = "Classe de : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse = 'Effectif Classe: '.count($_SESSION['eleve']);
			$effectifEvalue = 'Effectif Evalué : '.$_SESSION['eleve'][0]['classes'];
			
			$pdf->SetFont('Times','B',12);
			$pdf->Text(10,50, utf8_decode($classe));
			$pdf->Text(100,50, utf8_decode($effectifClasse));
			$pdf->Text(10,60, utf8_decode($effectifEvalue));
			$pdf->Text(100,60, 'Sequence  : '.utf8_decode($sequence));
			
			
			/*Construction du tableau Informationnel statistique*/
			$pdf->Ln(15);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40);
			$pdf->Cell(95,8, utf8_decode(strtoupper('statistiques des moyennes')),1,0,'C',true);
			$pdf->SetFont('Times','B',10);
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Libellé'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Féminin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Masculin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(35,8,utf8_decode('Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Sous - Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Moyenne Générale'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Taux Réussite'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Forte Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Faible Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$pdf->Ln(10);
			
			// Informations du PV
			$pdf->SetFont('Times','B',8);
			$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',true);
			$pdf->Cell(20,6,utf8_decode('Matricule'),1,0,'C',true);
			$pdf->Cell(55,6,utf8_decode('Noms et Prénoms'),1,0,'C',true);
			$pdf->Cell(10,6,utf8_decode('Sexe'),1,0,'C',true);
			$pdf->Cell(15,6,utf8_decode('Moyenne'),1,0,'C',true);
			$pdf->Cell(10,6,utf8_decode('Rang'),1,0,'C',true);
			$pdf->Cell(25,6,utf8_decode('Appréciation'),1,0,'C',true);
			$pdf->Cell(10,6,utf8_decode('Cote'),1,0,'C',true);
			$pdf->Cell(35,6,utf8_decode('Observations'),1,0,'C',true);
			$pdf->Ln(6);
			$a = 1;
			$pdf->SetFont('Times','',9);
			for($i=0;$i<count($_SESSION['eleve2']);$i++){
				$pdf->Cell(10,6,utf8_decode($a),1,0,'C');
				$pdf->Cell(20,6,utf8_decode($_SESSION['eleve2'][$i]['matricule']),1,0,'C');
				$pdf->Cell(55,6,utf8_decode($_SESSION['eleve2'][$i]['nom_eleve']),1,0,'L');
				$pdf->Cell(10,6,utf8_decode($_SESSION['eleve2'][$i]['sexe']),1,0,'C');
				// Si la moyenne est zéro, alors l'élève n'a pas été classé.
				if($_SESSION['eleve2'][$i]['moyenne']=='0.00'){
					$pdf->Cell(15,6,utf8_decode(' '),1,0,'C');
					$pdf->Cell(10,6,utf8_decode(' '),1,0,'C');
				}
				else{
					$pdf->Cell(15,6,utf8_decode($_SESSION['eleve2'][$i]['moyenne']),1,0,'C');
					$pdf->Cell(10,6,utf8_decode($_SESSION['eleve2'][$i]['rang']),1,0,'C');
				}
				$pdf->Cell(25,6,utf8_decode(ucwords($_SESSION['eleve2'][$i]['appreciation'])),1,0,'L');
				$pdf->Cell(10,6,utf8_decode(ucwords($_SESSION['eleve2'][$i]['cote'])),1,0,'L');
				$pdf->Cell(35,6,utf8_decode(''),1,0,'C');
				$pdf->Ln(6);
				$a++;
			}
			$pdf->Ln(10);
			$pdf->Cell(100);
			$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
			$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
			$pdf->Ln(10);
			$pdf->Cell(100);
			$pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
			
			
			/******* PROBABLE FIN DU PV TRIMESTRIEL MERITE ******/
			
			
			/**** PROBABLE DEBUT DE BOUCLE *****/
			
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
				$pdf->Ln(50);
				$pdf->SetFont('Times','B',8);
				$pdf->Cell(8);
				$pdf->Cell(45,6, utf8_decode('Matière'),1,0,'C',true);
				$pdf->Cell(30,6, utf8_decode('Competence'),1,0,'C',true);
				/*$pdf->Cell(15,6, utf8_decode('Note 1'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Note 2'),1,0,'C',true);*/
				$pdf->Cell(15,6, utf8_decode('Note/20'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Coef'),1,0,'C',true);
				$pdf->Cell(20,6, utf8_decode('Produit'),1,0,'C',true);
				$pdf->Cell(25,6, utf8_decode('Appréciation'),1,0,'C',true);
				$pdf->Cell(10,6, utf8_decode('Cote'),1,0,'C',true);
				$pdf->Cell(20,6, utf8_decode('Paraphe Ens.'),1,0,'C',true);
				$pdf->SetFont('Times','',8);
				$pdf->Ln(6);
				
				// On ressort une boucle qui liste les groupes définis
				for($b=0;$b<count($_SESSION['groupe']);$b++){
					$codeGroupe = $_SESSION['groupe'];
					$totalGroupe = $codeGroupe[$b].'_total';
					$coefGroupe = $codeGroupe[$b].'_coef';
					$moyenneGroupe = $codeGroupe[$b].'_moyenne';
					
					// Pour chaque groupe, on ressort le code et le nom de la matière
					$test = $codeGroupe[$b];
					$nomMatiere = $_SESSION['nom_matiere'][$test];
					$codeMatiere = $_SESSION['code_matiere'][$test];
					
					for($c=0;$c<count($codeMatiere);$c++){
												
						$seq1 = $codeMatiere[$c].'_'.$seq_impaire;
						/*$seq2 = $codeMatiere[$c].'_'.$seq_paire;*/
						// $trim = $codeMatiere[$c].'_'.$codeTri;
						$trimCoef = $codeMatiere[$c].'_coef';
						$trimTotal = $codeMatiere[$c].'_total';
						$trimAppr = $codeMatiere[$c].'_appreciation';
						$enseignant = $codeMatiere[$c].'_enseignant';
						$competence = $codeMatiere[$c].'_competence';
						$cote = $codeMatiere[$c].'_cote';
						
						$pdf->Cell(8);
						// $matiereEnseignant = strtoupper($nomMatiere[$c]).' / ';
						// $matiereEnseignant .= $eleve[$a][$enseignant];
						$pdf->Cell(45,3, utf8_decode(strtoupper($nomMatiere[$c])),'LTR',0,'L');
						$pdf->Cell(30,3, utf8_decode($eleve[0][$competence]),'LTR',0,'L');
						// $pdf->MultiCell(55, 6, 'Mon Texte' , 1 , 0 , 'L');
						/*
						$pdf->Ln(2);
						$pdf->SetFont('Times','I',10);
						$pdf->Cell(55,3, utf8_decode($eleve[$a][$enseignant]),1,0,'L');*/
						// Les notes à valeur zéro ne doivent pas apparaitre
						if($eleve[$a][$seq1]=='0.00'){  //Séquence impaire
							$pdf->Cell(15,6, utf8_decode(' '),1,0,'C');
						}
						else{
							$pdf->Cell(15,6, utf8_decode($eleve[$a][$seq1]),1,0,'C');
						}
						/*if($eleve[$a][$seq2]=='0.00'){  //Séquence paire
							$pdf->Cell(15,6, utf8_decode(''),1,0,'C');
						}
						else{
							$pdf->Cell(15,6, utf8_decode($eleve[$a][$seq2]),1,0,'C');
						}*/
						$pdf->SetFont('Times','B',9);
						
						/*if($eleve[$a][$trim]=='0.00'){   //Note du Trimestre
							$pdf->Cell(15,6, utf8_decode(''),1,0,'C',true);
						}
						else{
							
							$pdf->Cell(15,6, utf8_decode($eleve[$a][$trim]),1,0,'C',true);
						}*/
						$pdf->SetFont('Times','',7);
						if($eleve[$a][$trimCoef]=='0.0'){  //Coef du trimestre
							$pdf->Cell(15,6, utf8_decode(''),1,0,'C');
						}
						else{
							$pdf->Cell(15,6, utf8_decode($eleve[$a][$trimCoef]),1,0,'C');
						}
						if($eleve[$a][$trimTotal]=='0.00'){  //Total Trimestriel
							$pdf->Cell(20,6, utf8_decode(''),1,0,'C');
						}
						else{
							$pdf->Cell(20,6, utf8_decode($eleve[$a][$trimTotal]),1,0,'C');
						}						
						$pdf->Cell(25,6, utf8_decode(ucfirst($eleve[$a][$trimAppr])),1,0,'L');
						$pdf->Cell(10,6, $eleve[$a][$cote],1,0,'L');
						$pdf->Cell(20,6, '',1,0,'L');
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
					$pdf->Cell(15,6, utf8_decode($eleve[$a][$moyenneGroupe]),1,0,'C',true);
					$pdf->Cell(15,6, utf8_decode($eleve[$a][$coefGroupe]),1,0,'C',true);
					$pdf->Cell(20,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C',true);
					$pdf->Cell(55,6, utf8_decode(''),1,0,'L',true);
					$pdf->Ln(6);
					$pdf->SetFont('Times','',7);
				}
				$pdf->SetFont('Times','B',9);
				$pdf->Ln(6);
				$pdf->Cell(8);
				$pdf->Cell(75,6, utf8_decode('Bilan Général'),1,0,'L',true);
				$pdf->Cell(15,6, utf8_decode($eleve[$a]['moyenne']),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode($eleve[$a]['total_coef']),1,0,'C',true);
				$pdf->Cell(20,6, utf8_decode($eleve[$a]['total_point']),1,0,'C',true);
				$pdf->Cell(25,6, utf8_decode(ucwords($eleve[$a]['appreciation'])),1,0,'L',true);
				$pdf->Cell(10,6, utf8_decode(ucwords($eleve[$a]['cote'])),1,0,'L',true);
				$pdf->Cell(20,6, '',1,0,'L',true);
				$pdf->Ln(12);
				$pdf->Cell(8);
				
				$pdf->Cell(53,6,utf8_decode('Décision du Conseil de classe'), 1,0,'C',true);
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(53,6,utf8_decode('Discipline du Trimestre'), 1,0,'C',true);
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Félicitations'), 1,0,'C');
				if($eleve[$a]['moyenne']>=15.00){
					$pdf->Cell(25,6,utf8_decode('OUI'), 1,0,'C');
				}else{
					$pdf->Cell(25,6,utf8_decode('NON'), 1,0,'C');
				}
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('T. Absences'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['absence_total']), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Encouragements'), 1,0,'C');
				if($eleve[$a]['moyenne']>=14.00){
					$pdf->Cell(25,6,utf8_decode('OUI'), 1,0,'C');
				}else{
					$pdf->Cell(25,6,utf8_decode('NON'), 1,0,'C');
				}
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Justifiées'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['absence_just']), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Tab. Hon.'), 1,0,'C');
				if($eleve[$a]['moyenne']>=12.00){
					$pdf->Cell(25,6,utf8_decode('OUI'), 1,0,'C');
				}else{
					$pdf->Cell(25,6,utf8_decode('NON'), 1,0,'C');
				}
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Non Jutsif.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['absence_non_just']), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Avert. Trav.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Avert. Cond.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Blâme Trav.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Blâme Cond.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
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
				$pdf->Text(135,200,strtoupper('Moyenne de la '.utf8_decode($sequence)));
				// On doit pouvoir dire Non Classé au Rang et à la Moyenne 
				if($eleve[$a]['moyenne']=='0.00'){
					$pdf->Text(135,210, utf8_decode(ucfirst('Moyenne : Non Classé(e)')));
					$pdf->Text(135,220, utf8_decode(ucfirst('Rang :  Non Classé(e)')));
				}
				else{
					$pdf->Text(135,210, utf8_decode(ucfirst('Moyenne : '.$eleve[$a]['moyenne'].' / 20')));
					$pdf->Text(135,220, utf8_decode(ucfirst('Rang :  '.$eleve[$a]['rang'].' / '.$eleve[$a]['classes'].'')));
				}
				$pdf->Text(135,230, utf8_decode(ucfirst('Appréciation : '.strtoupper($eleve[$a]['appreciation']))));
				
				$pdf->Text(10,250, utf8_decode('Le Parent'));
				
				$pdf->Text(50,250, utf8_decode('Le Professeur Principal'));
				
				$pdf->Text(150,250, utf8_decode($signataire));
			}
			
			
			
			
			
			
			
			/****** PROBABLE FIN DE BOUCLE *****/
			
			
			
			
			
			
			
			
			
			
			
			
			
			// Informations diverses
			/*$pdf->SetFont('Times','B',12);
			$classe = 'classe';
			$enseignant = 'enseignant';
			$matiere = 'matiere';
			$periode = 'periode';
			$pdf->Cell(20,10,'Classe : '.$classe,0,0,'C');
			$pdf->Cell(100,10,utf8_decode('Période : '.$periode),0,0,'C');
			$pdf->SetFont('Times','',12);
			$pdf->Ln(5);
			$pdf->Cell(5,20,'Enseignant :'.utf8_decode($enseignant));
			$pdf->Cell(200,20,utf8_decode('Matière :'.ucwords($matiere)),0,0,'C');
			
			$pdf->Ln(15);*/
			
			
			// Le nom du fichier sera Bull_Trimestre_NumeroTrimestre_Classe
			$nomFichier = 'Bull_sequence_'.$_SESSION['sequence'].'_'.$_SESSION['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');
			
		}
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		**********	Génération du Bulletin trimestriel					*******
		***********************************************************************
		**********************************************************************/
		elseif($_SESSION['print']=='BullTrimestriel'){
			
			/****** PROBABLE POSITION DU PV TRIMESTRIEL ALPHABETIQUE*****/
			$pdf->addPage();
			$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
			if($_SESSION['trimestre']==1){
				$trimestre = $_SESSION['trimestre'].'er trimestre';
			}
			else{
				$trimestre = $_SESSION['trimestre'].'ème trimestre';
			}
			$titre = "Procès Verbal du ".$trimestre."";
			$pdf->TitreSans($titre);
			
			$classe = "Classe de : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse = 'Effectif Classe: '.count($_SESSION['eleve']);
			$effectifEvalue = 'Effectif Evalué : '.$_SESSION['eleve'][0]['classes'];
			
			$signataire = $_SESSION['signataire'];
			
			$pdf->SetFont('Times','B',12);
			$pdf->Text(10,50, utf8_decode($classe));
			$pdf->Text(100,50, utf8_decode($effectifClasse));
			$pdf->Text(10,60, utf8_decode($effectifEvalue));
			$pdf->Text(100,60, 'Trimestre  : '.utf8_decode($trimestre));
			
			
			/*Construction du tableau Informationnel statistique*/
			$pdf->Ln(15);
			$pdf->SetFont('Times','B',12);
			$pdf->SetFillColor(200,205,180);
			$pdf->Cell(40);
			$pdf->Cell(95,8, utf8_decode(strtoupper('statistiques des moyennes')),1,0,'C',true);
			$pdf->SetFont('Times','B',10);
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Libellé'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Féminin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Masculin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(35,8,utf8_decode('Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Sous - Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Moyenne Générale'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Taux Réussite'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Forte Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Faible Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$pdf->Ln(10);
			
			// Informations du PV
			$pdf->SetFont('Times','B',8);
			$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',true);
			$pdf->Cell(20,6,utf8_decode('Matricule'),1,0,'C',true);
			$pdf->Cell(55,6,utf8_decode('Noms et Prénoms'),1,0,'C',true);
			$pdf->Cell(10,6,utf8_decode('Sexe'),1,0,'C',true);
			$pdf->Cell(15,6,utf8_decode('Moyenne'),1,0,'C',true);
			$pdf->Cell(10,6,utf8_decode('Rang'),1,0,'C',true);
			$pdf->Cell(35,6,utf8_decode('Appréciation'),1,0,'C',true);
			$pdf->Cell(35,6,utf8_decode('Observations'),1,0,'C',true);
			$pdf->Ln(6);
			$a = 1;
			$pdf->SetFont('Times','',9);
			for($i=0;$i<count($_SESSION['eleve']);$i++){
				$pdf->Cell(10,6,utf8_decode($a),1,0,'C');
				$pdf->Cell(20,6,utf8_decode($_SESSION['eleve'][$i]['matricule']),1,0,'C');
				$pdf->Cell(55,6,utf8_decode($_SESSION['eleve'][$i]['nom_eleve']),1,0,'L');
				$pdf->Cell(10,6,utf8_decode($_SESSION['eleve'][$i]['sexe']),1,0,'C');
				// Si la moyenne est zéro, alors l'élève n'a pas été classé.
				if($_SESSION['eleve'][$i]['moyenne']=='0.00'){
					$pdf->Cell(15,6,utf8_decode(' '),1,0,'C');
					$pdf->Cell(10,6,utf8_decode(' '),1,0,'C');
				}
				else{
					$pdf->Cell(15,6,utf8_decode($_SESSION['eleve'][$i]['moyenne']),1,0,'C');
					$pdf->Cell(10,6,utf8_decode($_SESSION['eleve'][$i]['rang']),1,0,'C');
				}				
				$pdf->Cell(35,6,utf8_decode(ucwords($_SESSION['eleve'][$i]['appreciation'])),1,0,'L');
				$pdf->Cell(35,6,utf8_decode(''),1,0,'C');
				$pdf->Ln(6);
				$a++;
			}
			$pdf->Ln(10);
			$pdf->Cell(100);
			$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
			$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
			$pdf->Ln(10);
			$pdf->Cell(100);
			$pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
			
			
			/******* PROBABLE FIN DU PV TRIMESTRIEL ALPHABETIQUE ******/
			
			
			
			
			
			
			/****** PROBABLE POSITION DU PV TRIMESTRIEL DE MERITE *****/
			$pdf->addPage();
			$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
			if($_SESSION['trimestre']==1){
				$trimestre = $_SESSION['trimestre'].'er trimestre';
				$trimestre_lettre = 'Premier Trimestre';
				$seq_impaire = 'seq1';
				$seq_paire = 'seq2';
				$codeTri = 'trim';
			}
			else{
				$trimestre = $_SESSION['trimestre'].'ème trimestre';
				if($_SESSION['trimestre']==2){
					$trimestre_lettre = 'Deuxième Trimestre';
					$seq_impaire = 'seq1';
					$seq_paire = 'seq2';
					$codeTri = 'trim';
				}
				elseif($_SESSION['trimestre']==3){
					$trimestre_lettre = 'Troisième Trimestre';
					$seq_impaire = 'seq1';
					$seq_paire = 'seq2';
					$codeTri ='trim';
				}
			}
			$titre = "Procès Verbal du ".$trimestre."";
			$pdf->TitreSans($titre);
			
			$classe = "Classe de : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse = 'Effectif Classe: '.count($_SESSION['eleve']);
			$effectifEvalue = 'Effectif Evalué : '.$_SESSION['eleve'][0]['classes'];
			
			$pdf->SetFont('Times','B',12);
			$pdf->Text(10,50, utf8_decode($classe));
			$pdf->Text(100,50, utf8_decode($effectifClasse));
			$pdf->Text(10,60, utf8_decode($effectifEvalue));
			$pdf->Text(100,60, 'Trimestre  : '.utf8_decode($trimestre));
			
			
			/*Construction du tableau Informationnel statistique*/
			$pdf->Ln(15);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40);
			$pdf->Cell(95,8, utf8_decode(strtoupper('statistiques des moyennes')),1,0,'C',true);
			$pdf->SetFont('Times','B',10);
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Libellé'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Féminin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Masculin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(35,8,utf8_decode('Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Sous - Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Moyenne Générale'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Taux Réussite'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Forte Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Faible Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$pdf->Ln(10);
			
			// Informations du PV
			$pdf->SetFont('Times','B',8);
			$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',true);
			$pdf->Cell(20,6,utf8_decode('Matricule'),1,0,'C',true);
			$pdf->Cell(55,6,utf8_decode('Noms et Prénoms'),1,0,'C',true);
			$pdf->Cell(10,6,utf8_decode('Sexe'),1,0,'C',true);
			$pdf->Cell(15,6,utf8_decode('Moyenne'),1,0,'C',true);
			$pdf->Cell(10,6,utf8_decode('Rang'),1,0,'C',true);
			$pdf->Cell(35,6,utf8_decode('Appréciation'),1,0,'C',true);
			$pdf->Cell(35,6,utf8_decode('Observations'),1,0,'C',true);
			$pdf->Ln(6);
			$a = 1;
			$pdf->SetFont('Times','',9);
			for($i=0;$i<count($_SESSION['eleve2']);$i++){
				$pdf->Cell(10,6,utf8_decode($a),1,0,'C');
				$pdf->Cell(20,6,utf8_decode($_SESSION['eleve2'][$i]['matricule']),1,0,'C');
				$pdf->Cell(55,6,utf8_decode($_SESSION['eleve2'][$i]['nom_eleve']),1,0,'L');
				$pdf->Cell(10,6,utf8_decode($_SESSION['eleve2'][$i]['sexe']),1,0,'C');
				// Si la moyenne est zéro, alors l'élève n'a pas été classé.
				if($_SESSION['eleve2'][$i]['moyenne']=='0.00'){
					$pdf->Cell(15,6,utf8_decode(' '),1,0,'C');
					$pdf->Cell(10,6,utf8_decode(' '),1,0,'C');
				}
				else{
					$pdf->Cell(15,6,utf8_decode($_SESSION['eleve2'][$i]['moyenne']),1,0,'C');
					$pdf->Cell(10,6,utf8_decode($_SESSION['eleve2'][$i]['rang']),1,0,'C');
				}
				$pdf->Cell(35,6,utf8_decode(ucwords($_SESSION['eleve2'][$i]['appreciation'])),1,0,'L');
				$pdf->Cell(35,6,utf8_decode(''),1,0,'C');
				$pdf->Ln(6);
				$a++;
			}
			$pdf->Ln(10);
			$pdf->Cell(100);
			$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
			$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
			$pdf->Ln(10);
			$pdf->Cell(100);
			$pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
			
			
			/******* PROBABLE FIN DU PV TRIMESTRIEL MERITE ******/
			
			
			/**** PROBABLE DEBUT DE BOUCLE *****/
			
			$eleve = $_SESSION['eleve'];
			for($a=0;$a<count($eleve);$a++){
				$pdf->addPage();
				// On met l'entête du document
				$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
				// On met le titre du document
				$titre = "Bulletin de Notes du ".$trimestre_lettre;
				$pdf->SetFont('Times','BUI',14);
				// $pdf->SetFont('Times','BU',14);
				// Informations sur l'élève 
				$pdf->Text(40,45,strtoupper(utf8_decode($titre)));
				$pdf->SetFont('Times','',10);
				$lib_nom = 'Noms et Prénoms : ';
				$lib_classe = 'Classe de  : ';
				$lib_matricule = 'Matricule National : ';
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
				$pdf->Image($image, 170, 45, 22, 22);
				// Titre du Tableau du bulletin
				
				// On créé un espace supplémentaire entre le tableau et les info du haut
				$pdf->Ln(50);
				$pdf->SetFont('Times','B',8);
				$pdf->Cell(8);
				$pdf->Cell(55,6, utf8_decode('Matière'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Note 1'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Note 2'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Moyenne'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Coef'),1,0,'C',true);
				$pdf->Cell(20,6, utf8_decode('Produit'),1,0,'C',true);
				$pdf->Cell(50,6, utf8_decode('Appréciation'),1,0,'C',true);
				$pdf->SetFont('Times','',8);
				$pdf->Ln(6);
				
				// On ressort une boucle qui liste les groupes définis
				for($b=0;$b<count($_SESSION['groupe']);$b++){
					$codeGroupe = $_SESSION['groupe'];
					$totalGroupe = $codeGroupe[$b].'_total';
					$coefGroupe = $codeGroupe[$b].'_coef';
					$moyenneGroupe = $codeGroupe[$b].'_moyenne';
					
					// Pour chaque groupe, on ressort le code et le nom de la matière
					$test = $codeGroupe[$b];
					$nomMatiere = $_SESSION['nom_matiere'][$test];
					$codeMatiere = $_SESSION['code_matiere'][$test];
					
					for($c=0;$c<count($codeMatiere);$c++){
												
						$seq1 = $codeMatiere[$c].'_'.$seq_impaire;
						$seq2 = $codeMatiere[$c].'_'.$seq_paire;
						$trim = $codeMatiere[$c].'_'.$codeTri;
						$trimCoef = $codeMatiere[$c].'_coef';
						$trimTotal = $codeMatiere[$c].'_total';
						$trimAppr = $codeMatiere[$c].'_appreciation';
						$enseignant = $codeMatiere[$c].'_enseignant';
						
						$pdf->Cell(8);
						// $matiereEnseignant = strtoupper($nomMatiere[$c]).' / ';
						// $matiereEnseignant .= $eleve[$a][$enseignant];
						$pdf->Cell(55,3, utf8_decode(strtoupper($nomMatiere[$c])),'LTR',0,'L');
						// $pdf->MultiCell(55, 6, 'Mon Texte' , 1 , 0 , 'L');
						/*
						$pdf->Ln(2);
						$pdf->SetFont('Times','I',10);
						$pdf->Cell(55,3, utf8_decode($eleve[$a][$enseignant]),1,0,'L');*/
						// Les notes à valeur zéro ne doivent pas apparaitre
						if($eleve[$a][$seq1]=='0.00'){  //Séquence impaire
							$pdf->Cell(15,6, utf8_decode(' '),1,0,'C');
						}
						else{
							$pdf->Cell(15,6, utf8_decode($eleve[$a][$seq1]),1,0,'C');
						}
						if($eleve[$a][$seq2]=='0.00'){  //Séquence paire
							$pdf->Cell(15,6, utf8_decode(''),1,0,'C');
						}
						else{
							$pdf->Cell(15,6, utf8_decode($eleve[$a][$seq2]),1,0,'C');
						}
						$pdf->SetFont('Times','B',9);
						
						if($eleve[$a][$trim]=='0.00'){   //Note du Trimestre
							$pdf->Cell(15,6, utf8_decode(''),1,0,'C',true);
						}
						else{
							
							$pdf->Cell(15,6, utf8_decode($eleve[$a][$trim]),1,0,'C',true);
						}
						$pdf->SetFont('Times','',7);
						if($eleve[$a][$trimCoef]=='0.0'){  //Coef du trimestre
							$pdf->Cell(15,6, utf8_decode(''),1,0,'C');
						}
						else{
							$pdf->Cell(15,6, utf8_decode($eleve[$a][$trimCoef]),1,0,'C');
						}
						if($eleve[$a][$trimTotal]=='0.00'){  //Total Trimestriel
							$pdf->Cell(20,6, utf8_decode(''),1,0,'C');
						}
						else{
							$pdf->Cell(20,6, utf8_decode($eleve[$a][$trimTotal]),1,0,'C');
						}						
						$pdf->Cell(50,6, utf8_decode(ucfirst($eleve[$a][$trimAppr])),1,0,'L');
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
					$pdf->Cell(85,6, utf8_decode(strtoupper('Total du Groupe '.$codeGroupe[$b])),1,0,'L',true);
					$pdf->Cell(15,6, utf8_decode($eleve[$a][$moyenneGroupe]),1,0,'C',true);
					$pdf->Cell(15,6, utf8_decode($eleve[$a][$coefGroupe]),1,0,'C',true);
					$pdf->Cell(20,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C',true);
					$pdf->Cell(50,6, utf8_decode(''),1,0,'L',true);
					$pdf->Ln(6);
					$pdf->SetFont('Times','',7);
				}
				$pdf->SetFont('Times','B',9);
				$pdf->Ln(6);
				$pdf->Cell(8);
				$pdf->Cell(85,6, utf8_decode('Bilan Général'),1,0,'L',true);
				$pdf->Cell(15,6, utf8_decode($eleve[$a]['moyenne']),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode($eleve[$a]['total_coef']),1,0,'C',true);
				$pdf->Cell(20,6, utf8_decode($eleve[$a]['total_point']),1,0,'C',true);
				$pdf->Cell(50,6, utf8_decode(ucwords($eleve[$a]['appreciation'])),1,0,'L',true);
				$pdf->Ln(12);
				$pdf->Cell(8);
				
				$pdf->Cell(53,6,utf8_decode('Décision du Conseil de classe'), 1,0,'C',true);
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(53,6,utf8_decode('Discipline du Trimestre'), 1,0,'C',true);
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Félicitations'), 1,0,'C');
				if($eleve[$a]['moyenne']>=15.00){
					$pdf->Cell(25,6,utf8_decode('OUI'), 1,0,'C');
				}else{
					$pdf->Cell(25,6,utf8_decode('NON'), 1,0,'C');
				}
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('T. Absences'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['absence_total']), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Encouragements'), 1,0,'C');
				if($eleve[$a]['moyenne']>=14.00){
					$pdf->Cell(25,6,utf8_decode('OUI'), 1,0,'C');
				}else{
					$pdf->Cell(25,6,utf8_decode('NON'), 1,0,'C');
				}
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Justifiées'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['absence_just']), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Tab. Hon.'), 1,0,'C');
				if($eleve[$a]['moyenne']>=12.00){
					$pdf->Cell(25,6,utf8_decode('OUI'), 1,0,'C');
				}else{
					$pdf->Cell(25,6,utf8_decode('NON'), 1,0,'C');
				}
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Non Jutsif.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['absence_non_just']), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Avert. Trav.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Avert. Cond.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Blâme Trav.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Blâme Cond.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				
				
				$pdf->Text(135,200,strtoupper('Moyenne du '.utf8_decode($trimestre_lettre)));
				// On doit pouvoir dire Non Classé au Rang et à la Moyenne 
				if($eleve[$a]['moyenne']=='0.00'){
					$pdf->Text(135,210, utf8_decode(ucfirst('Moyenne : Non Classé(e)')));
					$pdf->Text(135,220, utf8_decode(ucfirst('Rang :  Non Classé(e)')));
				}
				else{
					$pdf->Text(135,210, utf8_decode(ucfirst('Moyenne : '.$eleve[$a]['moyenne'].' / 20')));
					$pdf->Text(135,220, utf8_decode(ucfirst('Rang :  '.$eleve[$a]['rang'].' / '.$eleve[$a]['classes'].'')));
				}
				$pdf->Text(135,230, utf8_decode(ucfirst('Appréciation : '.strtoupper($eleve[$a]['appreciation']))));
				
				$pdf->Text(10,250, utf8_decode('Le Parent'));
				
				$pdf->Text(50,250, utf8_decode('Le Professeur Principal'));
				
				$pdf->Text(150,250, utf8_decode($signataire));
			}
			
			
			
			
			
			
			
			/****** PROBABLE FIN DE BOUCLE *****/
			
			
			
			
			
			
			
			
			
			
			
			
			
			// Informations diverses
			/*$pdf->SetFont('Times','B',12);
			$classe = 'classe';
			$enseignant = 'enseignant';
			$matiere = 'matiere';
			$periode = 'periode';
			$pdf->Cell(20,10,'Classe : '.$classe,0,0,'C');
			$pdf->Cell(100,10,utf8_decode('Période : '.$periode),0,0,'C');
			$pdf->SetFont('Times','',12);
			$pdf->Ln(5);
			$pdf->Cell(5,20,'Enseignant :'.utf8_decode($enseignant));
			$pdf->Cell(200,20,utf8_decode('Matière :'.ucwords($matiere)),0,0,'C');
			
			$pdf->Ln(15);*/
			
			
			// Le nom du fichier sera Bull_Trimestre_NumeroTrimestre_Classe
			$nomFichier = 'Bull_trimestre_'.$_SESSION['trimestre'].'_'.$_SESSION['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		**********	Génération du Bulletin Annuel					*******
		***********************************************************************
		**********************************************************************/
		elseif($_SESSION['print']=='BullAnnuel'){
			/****** PROBABLE POSITION DU PV ANNUEL ALPHABETIQUE*****/
			$pdf->addPage();
			$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
			
			$titre = "Procès Verbal Annuel ";
			$pdf->TitreSans($titre);
			
			$classe = "Classe de : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse = 'Effectif Classe: '.count($_SESSION['eleve']);
			$effectifEvalue = 'Effectif Evalué : '.$_SESSION['eleve'][0]['classes'];
			
			$pdf->SetFont('Times','B',12);
			$pdf->Text(10,50, utf8_decode($classe));
			$pdf->Text(100,50, utf8_decode($effectifClasse));
			$pdf->Text(10,60, utf8_decode($effectifEvalue));
			$pdf->SetFillColor(155, 150, 149);
			
			// Construction du tableau Informationnel statistique
			$pdf->Ln(15);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40);
			$pdf->Cell(95,8, utf8_decode(strtoupper('statistiques des moyennes')),1,0,'C', true);
			$pdf->SetFont('Times','B',10);
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Libellé'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Féminin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Masculin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(35,8,utf8_decode('Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Sous - Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Moyenne Générale'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Taux Réussite'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Forte Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Faible Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$pdf->Ln(10);
			
			// Informations du PV
			$pdf->SetFont('Times','B',8);
			$pdf->Cell(8,6,utf8_decode('N°'),1,0,'C',true);
			$pdf->Cell(55,6,utf8_decode('Noms et Prénoms'),1,0,'C',true);
			$pdf->Cell(20,6,utf8_decode('Né(e) le'),1,0,'C',true);
			$pdf->Cell(8,6,utf8_decode('Sexe'),1,0,'C',true);
			$pdf->Cell(11,6,utf8_decode('Tr1'),1,0,'C',true);
			$pdf->Cell(11,6,utf8_decode('Tr2'),1,0,'C',true);
			$pdf->Cell(11,6,utf8_decode('Tr3'),1,0,'C',true);
			$pdf->Cell(13,6,utf8_decode('Ann.'),1,0,'C',true);
			$pdf->Cell(12,6,utf8_decode('Rang'),1,0,'C',true);
			$pdf->Cell(40,6,utf8_decode('Décision du Conseil'),1,0,'C',true);
			$pdf->Ln(6);
			$a = 1;
			$pdf->SetFont('Times','',9);
			for($i=0;$i<count($_SESSION['eleve']);$i++){
				$pdf->Cell(8,6,utf8_decode($a),1,0,'C');
				$pdf->Cell(55,6,utf8_decode($_SESSION['eleve'][$i]['nom_eleve']),1,0,'L');
				$pdf->Cell(20,6,utf8_decode($_SESSION['eleve'][$i]['date_naissance']),1,0,'L');
				$pdf->Cell(8,6,utf8_decode($_SESSION['eleve'][$i]['sexe']),1,0,'C');
				$pdf->Cell(11,6,utf8_decode(str_replace('0.00','',$_SESSION['eleve'][$i]['moyenne_1'])),1,0,'C');
				$pdf->Cell(11,6,utf8_decode(str_replace('0.00','',$_SESSION['eleve'][$i]['moyenne_2'])),1,0,'C');
				$pdf->Cell(11,6,utf8_decode(str_replace('0.00','',$_SESSION['eleve'][$i]['moyenne_3'])),1,0,'C');
				$pdf->SetFont('Times','B',9);
				// La Gestion du Non Classé 
				if($_SESSION['eleve'][$i]['moyenne']=='0.00'){
					$pdf->Cell(13,6,'',1,0,'C',true);
					$pdf->Cell(12,6,'',1,0,'C');
					$pdf->Cell(40,6,'',1,0,'L');
				}else{
					$pdf->Cell(13,6,utf8_decode($_SESSION['eleve'][$i]['moyenne']),1,0,'C',true);
					$pdf->Cell(12,6,utf8_decode($_SESSION['eleve'][$i]['rang']),1,0,'C');
					$pdf->Cell(40,6,'',1,0,'L');
				}
				$pdf->SetFont('Times','',9);
				$pdf->Ln(6);
				$a++;
			}
			$pdf->Ln(10);
			$pdf->Cell(100);
			$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
			$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
			$pdf->Ln(10);
			$pdf->Cell(100);
			$pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
			
			/******* PROBABLE FIN DU PV ANNUEL ALPHABETIQUE ******/
			
			
			/****** PROBABLE POSITION DU PV ANNUEL DE MERITE *****/
			$pdf->addPage();
			$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
			$titre = "Procès Verbal Annuel ";
			$pdf->TitreSans($titre);
			
			$classe = "Classe de : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse = 'Effectif Classe: '.count($_SESSION['eleve']);
			$effectifEvalue = 'Effectif Evalué : '.$_SESSION['eleve'][0]['classes'];
			
			$pdf->SetFont('Times','B',12);
			$pdf->Text(10,50, utf8_decode($classe));
			$pdf->Text(100,50, utf8_decode($effectifClasse));
			$pdf->Text(10,60, utf8_decode($effectifEvalue));
			
			// Construction du tableau Informationnel statistique
			$pdf->Ln(15);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40);
			$pdf->Cell(95,8, utf8_decode(strtoupper('statistiques des moyennes')),1,0,'C',true);
			$pdf->SetFont('Times','B',10);
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Libellé'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Féminin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Masculin'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(35,8,utf8_decode('Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Sous - Moyennes'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Moyenne Générale'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Taux Réussite'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
			$pdf->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Forte Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$pdf->Ln(8);
			$pdf->Cell(40);
			$pdf->Cell(35,8,utf8_decode('Faible Moyenne'),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$pdf->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$pdf->Ln(10);
			
			
			// Informations du PV
			$pdf->SetFont('Times','B',8);
			$pdf->Cell(8,6,utf8_decode('N°'),1,0,'C',true);
			$pdf->Cell(55,6,utf8_decode('Noms et Prénoms'),1,0,'C',true);
			$pdf->Cell(20,6,utf8_decode('Né(e) le'),1,0,'C',true);
			$pdf->Cell(8,6,utf8_decode('Sexe'),1,0,'C',true);
			$pdf->Cell(11,6,utf8_decode('Tr1'),1,0,'C',true);
			$pdf->Cell(11,6,utf8_decode('Tr2'),1,0,'C',true);
			$pdf->Cell(11,6,utf8_decode('Tr3'),1,0,'C',true);
			$pdf->Cell(13,6,utf8_decode('Ann.'),1,0,'C',true);
			$pdf->Cell(12,6,utf8_decode('Rang'),1,0,'C',true);
			$pdf->Cell(40,6,utf8_decode('Décision du Conseil'),1,0,'C',true);
			$pdf->Ln(6);
			$a = 1;
			$pdf->SetFont('Times','',9);
			for($i=0;$i<count($_SESSION['eleve2']);$i++){
				$pdf->Cell(8,6,utf8_decode($a),1,0,'C');
				$pdf->Cell(55,6,utf8_decode($_SESSION['eleve2'][$i]['nom_eleve']),1,0,'L');
				$pdf->Cell(20,6,utf8_decode($_SESSION['eleve2'][$i]['date_naissance']),1,0,'L');
				$pdf->Cell(8,6,utf8_decode($_SESSION['eleve2'][$i]['sexe']),1,0,'C');
				$pdf->Cell(11,6,utf8_decode(str_replace('0.00','',$_SESSION['eleve2'][$i]['moyenne_1'])),1,0,'C');
				$pdf->Cell(11,6,utf8_decode(str_replace('0.00','',$_SESSION['eleve2'][$i]['moyenne_2'])),1,0,'C');
				$pdf->Cell(11,6,utf8_decode(str_replace('0.00','',$_SESSION['eleve2'][$i]['moyenne_3'])),1,0,'C');
				// Si la moyenne est zéro, alors l'élève n'a pas été classé.
				$pdf->SetFont('Times','B',9);
				// La Gestion des Non Classés 
				if($_SESSION['eleve2'][$i]['moyenne']=='0.00'){
					$pdf->Cell(13,6,'',1,0,'C',true);
					$pdf->Cell(12,6,'',1,0,'C');
					$pdf->Cell(40,6,utf8_decode(''),1,0,'C');
				}else{
					$pdf->Cell(13,6,utf8_decode($_SESSION['eleve2'][$i]['moyenne']),1,0,'C',true);
					$pdf->Cell(12,6,utf8_decode($_SESSION['eleve2'][$i]['rang']),1,0,'C');
					$pdf->Cell(40,6,utf8_decode(''),1,0,'C');
				}
				
				
				$pdf->SetFont('Times','',9);
				$pdf->Ln(6);
				$a++;
			}
			$pdf->Ln(10);
			$pdf->Cell(100);
			$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
			$pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
			$pdf->Ln(10);
			$pdf->Cell(100);
			$pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
			
			/******* PROBABLE FIN DU PV TRIMESTRIEL MERITE *****/
			
			
			/**** PROBABLE DEBUT DE BOUCLE ****/
			$eleve = $_SESSION['eleve'];
			
			for($a=0;$a<count($eleve);$a++){
				$pdf->addPage();
				// On met l'entête du document
				$pdf->EnteteDoc($ministere, $pays, $ets, $devise, $contact, $as);
				// On met le titre du document
				$titre = "Bulletin de Notes Annuel ";
				$pdf->SetFont('Times','BUI',14);
				// $pdf->SetFont('Times','BU',14);
				// Informations sur l'élève 
				$pdf->Text(40,45,strtoupper(utf8_decode($titre)));
				$pdf->SetFont('Times','',10);
				$lib_nom = 'Noms et Prénoms : ';
				$lib_classe = 'Classe de  : ';
				$lib_matricule = 'Matricule : ';
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
				$matricule = $eleve[$a]['matricule'];
				$effectif = count($eleve);
				$dateNaissance = $eleve[$a]['date_naissance'];
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
				
				$pdf->Image($image, 170, 45, 22, 22);
				// Titre du Tableau du bulletin
				
				// On créé un espace supplémentaire entre le tableau et les info du haut
				$pdf->Ln(50);
				$pdf->SetFont('Times','B',10);
				$pdf->Cell(8);
				$pdf->Cell(55,6, utf8_decode('Matière'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Coef'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Trim 1'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Trim 2'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Trim 3'),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode('Annuel'),1,0,'C',true);
				$pdf->Cell(50,6, utf8_decode('Appréciation'),1,0,'C',true);
				$pdf->SetFont('Times','',10);
				$pdf->Ln(6);
				
				// On ressort une boucle qui liste les groupes définis
				for($b=0;$b<count($_SESSION['groupe']);$b++){
					$codeGroupe = $_SESSION['groupe'];
					$totalGroupe = $codeGroupe[$b].'_total';
					$coefGroupe = $codeGroupe[$b].'_Coef';
					$moyenneGroupe = $codeGroupe[$b].'_Moyenne';
					$champGroupe1 = $codeGroupe[$b].'_tr1';
					$champGroupe2 = $codeGroupe[$b].'_tr2';
					$champGroupe3 = $codeGroupe[$b].'_tr3';
					
					// Pour chaque groupe, on ressort le code et le nom de la matière
					$test = $codeGroupe[$b];
					$nomMatiere = $_SESSION['nom_matiere'][$test];
					$codeMatiere = $_SESSION['code_matiere'][$test];
					$grTr1 = $_SESSION['gpTr1'];
					$grTr2 = $_SESSION['gpTr2'];
					$grTr3 = $_SESSION['gpTr3'];
					$libelleGpTr1 = $grTr1[$b].'_tr1';
					for($c=0;$c<count($codeMatiere);$c++){
						$annCoef = $codeMatiere[$c].'_coef';
						$trim1 = $codeMatiere[$c].'_trim1';
						$trim2 = $codeMatiere[$c].'_trim2';
						$trim3 = $codeMatiere[$c].'_trim3';
						$annuel = $codeMatiere[$c].'_ann';
						$appr = $codeMatiere[$c].'_appr';
						
						$pdf->Cell(8);
						$pdf->Cell(55,6, utf8_decode(strtoupper($nomMatiere[$c])),1,0,'L');
						// $pdf->SetFont('Times','B',10);
						if($eleve[$a][$annCoef]=='0.0'){
							$pdf->Cell(15,6, utf8_decode(''),1,0,'C');
						}
						else{
							$pdf->Cell(15,6, utf8_decode(strtoupper($eleve[$a][$annCoef])),1,0,'C');
						}
						
						// $pdf->SetFont('Times','',10);
						if($eleve[$a][$trim1]=='0.00'){
							$pdf->Cell(15,6, utf8_decode(''),1,0,'L');
						}
						else{
							$pdf->Cell(15,6, utf8_decode(strtoupper($eleve[$a][$trim1])),1,0,'L');
						}
						
						if($eleve[$a][$trim2]=='0.00'){
							$pdf->Cell(15,6, utf8_decode(''),1,0,'L');
						}
						else{
							$pdf->Cell(15,6, utf8_decode(strtoupper($eleve[$a][$trim2])),1,0,'L');
						}
						
						if($eleve[$a][$trim3]=='0.00'){
							$pdf->Cell(15,6, utf8_decode(''),1,0,'L');
						}
						else{
							$pdf->Cell(15,6, utf8_decode(strtoupper($eleve[$a][$trim3])),1,0,'L');
						}
						
						$pdf->SetFont('Times','B',10);
						if($eleve[$a][$annuel]=='0.00'){
							$pdf->Cell(15,6, utf8_decode(''),1,0,'L');
						}
						else{
							$pdf->Cell(15,6, utf8_decode(strtoupper($eleve[$a][$annuel])),1,0,'L',true);
						}
						
						$pdf->SetFont('Times','',10);
						$pdf->Cell(50,6, utf8_decode(strtoupper($eleve[$a][$appr])),1,0,'L');
						$pdf->Ln(6);
						
					}
					
					$pdf->Cell(8);
					$pdf->SetFont('Times','B',10);
					$pdf->Cell(55,6, utf8_decode(strtoupper('Total du Groupe '.$codeGroupe[$b])),1,0,'L',true);
					$pdf->Cell(15,6, utf8_decode(strtoupper('')),1,0,'L',true);
					$pdf->Cell(15,6, utf8_decode($eleve[$a][$champGroupe1]),1,0,'L',true);
					$pdf->Cell(15,6, utf8_decode($eleve[$a][$champGroupe2]),1,0,'L',true);
					$pdf->Cell(15,6, utf8_decode($eleve[$a][$champGroupe3]),1,0,'L',true);
					$pdf->Cell(15,6, utf8_decode(strtoupper('')),1,0,'L',true);
					// if($eleve[$a][$totalGroupe]=='0.00'){
						// $pdf->Cell(15,6, utf8_decode(''),1,0,'C');
						// $pdf->Cell(15,6, utf8_decode(''),1,0,'C');
						// $pdf->Cell(15,6, utf8_decode(''),1,0,'C');
						// $pdf->Cell(15,6, utf8_decode(''),1,0,'C');
						// $pdf->Cell(15,6, utf8_decode(''),1,0,'C');
					// }
					// else{
						// $pdf->Cell(15,6, utf8_decode($eleve[$a][$moyenneGroupe]),1,0,'C');
						// $pdf->Cell(15,6, utf8_decode($eleve[$a][$coefGroupe]),1,0,'C');
						// $pdf->Cell(15,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C');
						// $pdf->Cell(15,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C');
						// $pdf->Cell(15,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C');
					// }
					
					$pdf->Cell(50,6, utf8_decode(''),1,0,'L',true);
					$pdf->Ln(6);
					$pdf->SetFont('Times','',10);
				}
				$pdf->SetFont('Times','B',11);
				// $pdf->Ln(6);
				$pdf->Cell(8);
				$pdf->Cell(55,6, utf8_decode('Bilan Général'),1,0,'L',true);
				$pdf->Cell(15,6, utf8_decode($eleve[$a]['total_coef']),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode($eleve[$a]['moyenne_1']),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode($eleve[$a]['moyenne_2']),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode($eleve[$a]['moyenne_3']),1,0,'C',true);
				$pdf->Cell(15,6, utf8_decode($eleve[$a]['moyenne']),1,0,'C',true);
				$pdf->Cell(50,6, utf8_decode(ucwords($eleve[$a]['appreciation'])),1,0,'L',true);
				$pdf->Ln(12);
				$pdf->Cell(8);
				
				$pdf->Cell(53,6,utf8_decode('Décision du Conseil de classe'), 1,0,'C',true);
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(53,6,utf8_decode('Discipline Annuelle'), 1,0,'C',true);
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(53,6,utf8_decode('Rappel des Moyennes'), 1,0,'C',true);
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Félicitations'), 1,0,'C');
				if($eleve[$a]['moyenne']>=15.00){
					$pdf->Cell(25,6,utf8_decode('OUI'), 1,0,'C');
				}else{
					$pdf->Cell(25,6,utf8_decode('NON'), 1,0,'C');
				}
				
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('T. Absences'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['absence_total']), 1,0,'C');
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Moy Tr 1'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['moyenne_1']), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Encouragements'), 1,0,'C');
				if($eleve[$a]['moyenne']>=14.00){
					$pdf->Cell(25,6,utf8_decode('OUI'), 1,0,'C');
				}else{
					$pdf->Cell(25,6,utf8_decode('NON'), 1,0,'C');
				}
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Justifiées'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['absence_just']), 1,0,'C');
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Moy Tr 1'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['moyenne_2']), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Tab. Hon.'), 1,0,'C');
				if($eleve[$a]['moyenne']>=12.00){
					$pdf->Cell(25,6,utf8_decode('OUI'), 1,0,'C');
				}else{
					$pdf->Cell(25,6,utf8_decode('NON'), 1,0,'C');
				}
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Non Jutsif.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['absence_non_just']), 1,0,'C');
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Moy Tr 3'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode($eleve[$a]['moyenne_3']), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Avert. Trav.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Avert. Cond.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				$pdf->Cell(28,6,utf8_decode('Blâme Trav.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Cell(5, 6, utf8_decode(''),0,0,'C');
				$pdf->Cell(28,6,utf8_decode('Blâme Cond.'), 1,0,'C');
				$pdf->Cell(25,6,utf8_decode(''), 1,0,'C');
				$pdf->Ln(6);
				$pdf->Cell(8);
				
				
				
				// $pdf->Text(135,200,strtoupper('Moyenne du '.utf8_decode($trimestre_lettre)));
				// On doit pouvoir dire Non Classé au Rang et à la Moyenne 
				if($eleve[$a]['moyenne']=='0.00'){
					$pdf->Text(135,225, utf8_decode(ucfirst('Moyenne : Non Classé(e)')));
					$pdf->Text(135,230, utf8_decode(ucfirst('Rang :  Non Classé(e)')));
				}
				else{
					$pdf->Text(135,225, utf8_decode(ucfirst('Moyenne : '.$eleve[$a]['moyenne'].' / 20')));
					$pdf->Text(135,235, utf8_decode(ucfirst('Rang :  '.$eleve[$a]['rang'].' / '.$eleve[$a]['classes'].'')));
				}
				$pdf->Text(135,245, utf8_decode(ucwords('Appréciation : '.$eleve[$a]['appreciation'])));
				
				$pdf->Text(10,260, utf8_decode('Le Parent'));
				
				$pdf->Text(50,260, utf8_decode('Le Professeur Principal'));
				
				$pdf->Text(150,260, utf8_decode($signataire));
				$pdf->Text(20,232, utf8_decode(strtoupper('Observations Générales')));
			}
			
			/*
			
			
			
			
			
			*/
			// Le nom du fichier sera Bulletin_Annuel_NomClasse.pdf
			$nomFichier = 'Bulletin_Annuel_'.$classe.'.pdf';
			$pdf->Output($nomFichier, 'I');		
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	unset($_SESSION['liste']);
	unset($_SESSION['print']);
	unset($_SESSION['eleve']);
	unset($_SESSION['eleve2']);
	unset($_SESSION['bulletin']);
	unset($_SESSION['stat']);
	unset($_SESSION['professeurPrincipal']);
	// echo '<pre>';print_r($_SESSION['liste']);