<?php 
	
	
	/*************************************************************************
	**************************************************************************
	**************************************************************************
	************   G E N E R A T E U R	 D E	F I C H I E R S 	P D F	**
	**************************************************************************
	**************************************************************************
	*************************************************************************/
	session_start();
	require_once('inc/pdfL.class.php');
	$pdf = new pdf('L', 'mm', 'A4');
	
	
	
	if(isset($_SESSION['print'])){
		// On charge les informations d'entête de l'établissement
		// $ministere = strtoupper(utf8_decode($_SESSION['ministere']));
		// $pays = $_SESSION['pays'];
		// $ets = $_SESSION['ets'];
		// $devise = $_SESSION['devise'];
		// $contact = $_SESSION['contact'];
		// $as = $_SESSION['as'];
		
		
		/*$ministere = $_SESSION['ministere'];
		$pays = $_SESSION['pays'];
		$ets = $_SESSION['ets'];
		$devise = $_SESSION['devise'];
		$contact = $_SESSION['contact'];
		$as = $_SESSION['as'];
		$ville = ucwords($_SESSION['arrondissement']);
		$titreSignataire = ucfirst($_SESSION['titre_signataire']);
		$signataire = ucfirst($_SESSION['signataire']);
		$nomChef = $_SESSION['chef_ets'];
		$ministereAnglais = $_SESSION['ministere_anglais'];
		$paysAnglais = $_SESSION['pays_anglais'];
		$etsAnglais = $_SESSION['ets_anglais'];
		$deviseAnglais = $_SESSION['devise_anglais'];
		// $asAnglais = $_SESSION['as_anglais'];
		$ville = ucwords($_SESSION['arrondissement']);
		$titreSignataire = ucfirst($_SESSION['titre_signataire']);
		$signataire = ucfirst($_SESSION['signataire']);
		$nomChef = $_SESSION['chef_ets'];*/
		/**********************************************************************
		***********************************************************************
		*******	Impression/Visualisation des  Notes Séquentielles *************
		***********************************************************************
		**********************************************************************/
		
		if($_SESSION['print']=='VisualiserNoteSequentielle'){
			$pdf->SetFillColor(155, 150, 149);
			$classe = $_SESSION['classe'];
			$eleve = $_SESSION['eleve'];
			$matiere = $_SESSION['matiere'];
			if($classe['section']=='fr'){
				$pdf->addPage();
				$pdf->Entete();
				$titre = 'visualisation des notes sequentielles';
				$pdf->Titre($titre);
				$pdf->Ln(10);
				$pdf->Cell(25);
				$libClasse = 'Classe : '.$classe['nom_classe'];
				$libSequence = 'Sequence : Sequence '.$eleve['sequence'];
				$pdf->Cell(120,6,$libClasse,0,0,'L');
				$pdf->Cell(120,6,$libSequence,0,0,'L');
				$pdf->Ln(10);
				$pdf->setFont('Times', '',11);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C', true);
				$pdf->Cell(60,5,utf8_decode('Noms et Prénoms'),1,0,'C', true);
				$pdf->Cell(10,5,utf8_decode('Sexe'),1,0,'C', true);
				$pdf->Cell(10,5,utf8_decode('Statut'),1,0,'C', true);
				// On liste les matières ici 
				for($i=0;$i<count($matiere); $i++){
					$codeMatiere = strtolower($matiere[$i]['code_matiere']);
					$pdf->Cell(10,5,$codeMatiere,1,0,'C', true);
				}
				$pdf->Ln(5);
				$x = 1;
				for($a=0;$a<count($eleve['eleve']);$a++){
					$infoEleve = $eleve['eleve'];
					$nomComplet = substr($infoEleve[$a]['nom'], 0, 23);
					$sexe = $eleve['eleve'][$a]['sexe'];
					$statut = $eleve['eleve'][$a]['statut'];
					$pdf->Cell(10,5,utf8_decode($x),1,0,'C');
					$pdf->Cell(60,5,utf8_decode($nomComplet),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($sexe),1,0,'C');
					$pdf->Cell(10,5,utf8_decode($statut),1,0,'C');
					$pdf->setFont('Times', '',10);
					// On va lister d'abord les array de matières et ensuite récupérer leurs notes 
					for($b=0;$b<count($matiere);$b++){
						$codeMat = strtolower($matiere[$b]['code_matiere']);
						$noteEleve = $infoEleve[$a][$codeMat];
						$pdf->Cell(10,5,$noteEleve,1,0,'C');
					}
					$pdf->Ln(5);
					$x++;
				}
				$pdf->Ln(10);
				$pdf->setFont('Times', '',11);
				$phrase = utf8_decode('Fait à '.strtoupper($_SESSION['information']['ville']).' le ______________');
				$phrase2 = utf8_decode("L'Administration");
				$pdf->Cell(200);
				$pdf->Cell(60, 5, $phrase, 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(200);
				$pdf->Cell(60, 5, $phrase2, 0,0,'C');
				$fileName=strtoupper('etat_de_saisie_sequence_'.$eleve['sequence'].'_');
				$fileName .= strtoupper(str_replace(' ','_',$classe['nom_classe']));
				$fileName.= '.pdf';
			}
			elseif($classe['section']=='en'){
				$pdf->addPage();
				$pdf->Entete();
				$titre = 'sequential marks of the class';
				$pdf->Titre($titre);
				$pdf->Ln(10);
				$pdf->Cell(25);
				$libClasse = 'Class : '.$classe['nom_classe'];
				$libSequence = 'Sequence : Sequence '.$eleve['sequence'];
				$pdf->Cell(120,6,$libClasse,0,0,'L');
				$pdf->Cell(120,6,$libSequence,0,0,'L');
				$pdf->Ln(10);
				$pdf->setFont('Times', '',11);
				$pdf->Cell(10,5,utf8_decode('N°'),1,0,'C', true);
				$pdf->Cell(60,5,utf8_decode('Student Name'),1,0,'C', true);
				$pdf->Cell(10,5,utf8_decode('Sex'),1,0,'C', true);
				$pdf->Cell(10,5,utf8_decode('Status'),1,0,'C', true);
				// On liste les matières ici 
				for($i=0;$i<count($matiere); $i++){
					$codeMatiere = strtolower($matiere[$i]['code_matiere']);
					$pdf->Cell(10,5,$codeMatiere,1,0,'C', true);
				}
				$pdf->Ln(5);
				$x = 1;
				for($a=0;$a<count($eleve['eleve']);$a++){
					$infoEleve = $eleve['eleve'];
					$nomComplet = substr($infoEleve[$a]['nom'], 0, 23);
					$sexe = $eleve['eleve'][$a]['sexe'];
					$statut = $eleve['eleve'][$a]['statut'];
					$pdf->Cell(10,5,utf8_decode($x),1,0,'C');
					$pdf->Cell(60,5,utf8_decode($nomComplet),1,0,'L');
					$pdf->Cell(10,5,utf8_decode($sexe),1,0,'C');
					$pdf->Cell(10,5,utf8_decode($statut),1,0,'C');
					$pdf->setFont('Times', '',10);
					// On va lister d'abord les array de matières et ensuite récupérer leurs notes 
					for($b=0;$b<count($matiere);$b++){
						$codeMat = strtolower($matiere[$b]['code_matiere']);
						$noteEleve = $infoEleve[$a][$codeMat];
						$pdf->Cell(10,5,$noteEleve,1,0,'C');
					}
					$pdf->Ln(5);
					$x++;
				}
				$pdf->Ln(10);
				$pdf->setFont('Times', '',11);
				$phrase = utf8_decode('Done at '.strtoupper($_SESSION['information']['ville']).' on the ______________');
				$phrase2 = utf8_decode("The Administration");
				$pdf->Cell(200);
				$pdf->Cell(60, 5, $phrase, 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(200);
				$pdf->Cell(60, 5, $phrase2, 0,0,'C');
				$fileName=strtoupper('etat_de_saisie_sequence_'.$eleve['sequence'].'_');
				$fileName .= strtoupper(str_replace(' ','_',$classe['nom_classe']));
				$fileName.= '.pdf';
			}
			$pdf->Output($fileName, 'I');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		elseif($_SESSION['print']=='statNoteProf'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDocL($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$matiere = $_SESSION['matiere'];
			$titre = "Statistiques des Notes de ";
			$titre .= strtoupper($matiere);
			
			$pdf->TitreL($titre);
			
			
			// Informations diverses
			$pdf->SetFont('Times','B',12);
			// $classe = strtoupper($_SESSION['liste'][0]['nom_classe']);
			$texte_1 = 'Classe : '.$_SESSION['classe'];
			$texte_2 = 'Période : Séquence '.$_SESSION['sequence'];
			$pdf->Cell(20,10,utf8_decode($texte_1), 0,0,'L');
			$pdf->Cell(80,10,utf8_decode($texte_2), 0,0,'R');
			
			$pdf->Ln(15);
			
			$pdf->SetFont('Arial','B',10);
			// Je positionne l'entete du tableau
			$pdf->Cell(20, 14, 'Classe', 1, 0 , 'C');
			$pdf->Cell(30, 7, 'Effectif', 1, 0 , 'C');
			$pdf->Cell(30, 7, utf8_decode('Evalué'), 1, 0 , 'C');
			$pdf->Cell(30, 7, 'Nb Moyennes', 1, 0 , 'C');
			$pdf->Cell(30, 7, utf8_decode('% Réussite'), 1, 0 , 'C');
			$pdf->Cell(30, 7, 'Forte Note', 1, 0 , 'C');
			$pdf->Cell(30, 7, 'Faible Note', 1, 0 , 'C');
			$pdf->Cell(45, 7, utf8_decode('Moyenne Générale'), 1, 0 , 'C');
			
			$pdf->Ln(7);
			$pdf->Cell(20, 7, '', 0, 0 , 'C');
			// Effectif de la classe
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Effectif évalué
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Nombre de Moyennes
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Taux de Réussite
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Forte Note
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Faible Note
			$pdf->Cell(10, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'T', 1, 0 , 'C');
			// Moyenne Générale
			$pdf->Cell(15, 7, 'M', 1, 0 , 'C');
			$pdf->Cell(15, 7, 'F', 1, 0 , 'C');
			$pdf->Cell(15, 7, 'T', 1, 0 , 'C');
			
			// On insère maintenant les données
			$pdf->Ln(7);
			$pdf->Cell(20, 7, $_SESSION['classe'], 1, 0 , 'C');
			// Effectif de la classe
			$pdf->Cell(10, 7, $_SESSION['stat']['effM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['effF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['effT'], 1, 0 , 'C');
			// Effectif évalué
			$pdf->Cell(10, 7, $_SESSION['stat']['evalM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['evalF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['evalT'], 1, 0 , 'C');
			// Nombre de Moyennes
			$pdf->Cell(10, 7, $_SESSION['stat']['moyM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['moyF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['moyT'], 1, 0 , 'C');
			// Taux de Réussite
			$pdf->Cell(10, 7, $_SESSION['stat']['tauxM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['tauxF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['tauxT'], 1, 0 , 'C');
			// Forte Note
			$pdf->Cell(10, 7, $_SESSION['stat']['maxM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['maxF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['maxT'], 1, 0 , 'C');
			// Faible Note
			$pdf->Cell(10, 7, $_SESSION['stat']['minM'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['minF'], 1, 0 , 'C');
			$pdf->Cell(10, 7, $_SESSION['stat']['minT'], 1, 0 , 'C');
			// Moyenne Générale
			$pdf->Cell(15, 7, $_SESSION['stat']['mgM'], 1, 0 , 'C');
			$pdf->Cell(15, 7, $_SESSION['stat']['mgF'], 1, 0 , 'C');
			$pdf->Cell(15, 7, $_SESSION['stat']['mgT'], 1, 0 , 'C');
			
			
			
			// Boucle des matières ici
			/*for($i=0;$i<$_SESSION['nbCol'];$i++){
				$pdf->Cell(13, 7, $_SESSION['nomCol'][$i], 1, 0 , 'C');
			}*/
			
			// Les notes envoyées par la BD
			$x = 1;
			/*for($a=0;$a<$_SESSION['nbLn'];$a++){
				$pdf->Ln(7);
				$pdf->Cell(10, 6, $x, 1, 0 , 'C');
				$pdf->Cell(70, 6, utf8_decode($_SESSION['ligne'][$a]['nom']), 1, 0 , 'L');
				$pdf->Cell(14, 6, $_SESSION['ligne'][$a]['sexe'], 1, 0 , 'C');
				$pdf->Cell(14, 6, $_SESSION['ligne'][$a]['statut'], 1, 0 , 'C');
				$col = $_SESSION['nbCol'];
				
				for($u=0;$u<$_SESSION['nbCol'];$u++){
					$mat = $_SESSION['nomCol'][$u];
					$pdf->Cell(13, 6, $_SESSION['ligne'][$a][$mat], 1, 0 , 'C');
				}				
				$x++;
			}*/
			
			$pdf->SetFont('Arial','',10);
			$i = 1;
			// Par boucle je récupère la liste envoyée dans une variable de session
			/*for($a=0;$a<count($_SESSION['liste']);$a++){
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
			$nomFichier = 'Stat_'.$matiere.'_Sequence_'.$_SESSION['sequence'];
			$nomFichier .= '_'.$_SESSION['classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		elseif($_SESSION['print']=='statNoteSequence'){
			
		}
		elseif($_SESSION['print']=='statNoteTrimestre'){
			
		}
		elseif($_SESSION['print']=='VisualiserNoteTrimestrielle'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDocL($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$titre = strtoupper("Récapitulatif des Notes Trimestrielles");
			
			$pdf->TitreL($titre);
			
			// Informations diverses
			$pdf->SetFont('Times','B',16);
			$texte_1 = 'Classe : ';
			// $pdf->SetTextColor(100,100,255);  // Bleu
			$texte_1 .= strtoupper($_SESSION['nom_classe']);
			// $pdf->SetTextColor(0,0,0);  // Noir
			$texte_2 = 'Période : '.$_SESSION['nom_trimestre'];
			$pdf->Cell(70,10,utf8_decode($texte_1), 0,0,'L');
			$pdf->Cell(80,10,utf8_decode($texte_2), 0,0,'R');
			$pdf->Ln(15);
			
			
			
			$pdf->SetFont('Arial','B',10);
			// Je positionne l'entete du tableau
			$pdf->Cell(10, 7, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(66, 7, utf8_decode('Noms et Prénoms'), 1, 0 , 'C');
			$pdf->Cell(10, 7, 'Sexe', 1, 0 , 'C');
			$pdf->Cell(11, 7, 'Statut', 1, 0 , 'C');
			for($i=0;$i<count($_SESSION['code_matiere']);$i++){
				$pdf->Cell(12, 7, 
						$_SESSION['code_matiere'][$i],
						1, 0 , 'C');
			}
			$pdf->SetFillColor(200,205,180);
			$pdf->Cell(16, 7, 'MOY.', 1,0,'C',true);
			$pdf->Cell(16, 7, 'Rang.', 1,0,'C',true);
			
			// Les notes envoyées par la BD
			$x = 1;
			for($j=0;$j<count($_SESSION['eleve']);$j++){
				$nomEleve = $_SESSION['eleve'][$j]['nom_eleve'];
				$sexe = $_SESSION['eleve'][$j]['sexe'];
				$statut = $_SESSION['eleve'][$j]['statut'];
				
				$pdf->Ln(7);
				$pdf->Cell(10, 6, $x, 1, 0 , 'C');
				$pdf->Cell(66, 6, $nomEleve, 1, 0 , 'L');
				$pdf->Cell(10,6,$sexe,1,0,'C');
				$pdf->Cell(11,6,$statut,1,0,'C');
				for($k=0;$k<count($_SESSION['code_matiere']);$k++){
					$codeMatiere = $_SESSION['code_matiere'][$k].'_trim';
					$noteObtenue = $_SESSION['eleve'][$j][$codeMatiere];
					// On élimine la présence du Zéro
					if($noteObtenue=='0.00'){
						$pdf->Cell(12,6,'', 1,0,'C');
					}else{
						$pdf->Cell(12,6,$noteObtenue, 1,0,'C');
					}
				}
				$x++;
				// Si l'élève n'est pas classé, on le signale au tableau
				/*$pdf->SetTextColor(255,30,30); */  //Rouge sont les moyennes et les rangs
				$pdf->SetDrawColor(255,30,30);  //Rouge sont les bordures du tableau
				
				if($_SESSION['eleve'][$j]['moyenne']=='0.00'){
					$pdf->SetFillColor(230,230,0);  // Fond Jaune pour les non classés
					$pdf->Cell(16, 6, 'NC', 1,0,'C',true);
					$pdf->Cell(16, 6, 'NC', 1,0,'C',true);
				}else{
					$pdf->SetFillColor(200,205,180);  // Fond Orange ou gris pour les classés
					$pdf->Cell(16, 6, $_SESSION['eleve'][$j]['moyenne'], 1,0,'C',true);
					$pdf->Cell(16, 6, utf8_decode($_SESSION['eleve'][$j]['rang']), 1,0,'C',true);
				}
				$pdf->SetTextColor(0,0,0);
				$pdf->SetDrawColor(0,0,0);
			}
			
			$pdf->SetFont('Arial','',10);
			$i = 1;
			
			$pdf->FooterL();
			$pdf->setAuthor('Nyambi Computer Services');
			$nomFichier = 'Vue_Note_'.str_replace(' ','_',$_SESSION['nom_trimestre']).'_';
			$nomFichier .= $_SESSION['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		
		
		
		
		elseif($_SESSION['print']=='VisualiserNoteAnnuelle'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDocL($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$titre = strtoupper("Récapitulatif des Notes Annuelles");
			
			$pdf->TitreL($titre);
			
			// Informations diverses
			$pdf->SetFont('Times','B',16);
			$texte_1 = 'Classe : ';
			// $pdf->SetTextColor(100,100,255);  // Bleu
			$texte_1 .= strtoupper($_SESSION['nom_classe']);
			// $pdf->SetTextColor(0,0,0);  // Noir
			$texte_2 = 'Professeur Principal : ';
			$texte_2 .= strtoupper($_SESSION['nom_classe']);
			$pdf->Cell(70,10,utf8_decode($texte_1), 0,0,'L');
			// $pdf->Cell(80,10,utf8_decode($texte_2), 0,0,'R');
			$pdf->Ln(15);
			
			
			
			$pdf->SetFont('Arial','B',10);
			// Je positionne l'entete du tableau
			$pdf->Cell(10, 7, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(66, 7, utf8_decode('Noms et Prénoms'), 1, 0 , 'C');
			$pdf->Cell(10, 7, 'Sexe', 1, 0 , 'C');
			$pdf->Cell(11, 7, 'Statut', 1, 0 , 'C');
			for($i=0;$i<count($_SESSION['code_matiere']);$i++){
				$pdf->Cell(12, 7, 
						$_SESSION['code_matiere'][$i],
						1, 0 , 'C');
			}
			$pdf->SetFillColor(200,205,180);
			$pdf->Cell(16, 7, 'MOY.', 1,0,'C',true);
			$pdf->Cell(16, 7, 'Rang.', 1,0,'C',true);
			
			// Les notes envoyées par la BD
			$x = 1;
			for($j=0;$j<count($_SESSION['eleve']);$j++){
				$nomEleve = $_SESSION['eleve'][$j]['nom_eleve'];
				$sexe = $_SESSION['eleve'][$j]['sexe'];
				$statut = $_SESSION['eleve'][$j]['statut'];
				
				$pdf->Ln(7);
				$pdf->Cell(10, 6, $x, 1, 0 , 'C');
				$pdf->Cell(66, 6, $nomEleve, 1, 0 , 'L');
				$pdf->Cell(10,6,$sexe,1,0,'C');
				$pdf->Cell(11,6,$statut,1,0,'C');
				for($k=0;$k<count($_SESSION['code_matiere']);$k++){
					$codeMatiere = $_SESSION['code_matiere'][$k].'_ann';
					$noteObtenue = $_SESSION['eleve'][$j][$codeMatiere];
					// On élimine la présence du Zéro
					if($noteObtenue=='0.00'){
						$pdf->Cell(12,6,'', 1,0,'C');
					}else{
						$pdf->Cell(12,6,$noteObtenue, 1,0,'C');
					}
				}
				$x++;
				// Si l'élève n'est pas classé, on le signale au tableau
				/*$pdf->SetTextColor(255,30,30); */  //Rouge sont les moyennes et les rangs
				$pdf->SetDrawColor(255,30,30);  //Rouge sont les bordures du tableau
				
				if($_SESSION['eleve'][$j]['moyenne']=='0.00'){
					$pdf->SetFillColor(230,230,0);  // Fond Jaune pour les non classés
					$pdf->Cell(16, 6, 'NC', 1,0,'C',true);
					$pdf->Cell(16, 6, 'NC', 1,0,'C',true);
				}else{
					$pdf->SetFillColor(200,205,180);  // Fond Orange ou gris pour les classés
					$pdf->Cell(16, 6, $_SESSION['eleve'][$j]['moyenne'], 1,0,'C',true);
					$pdf->Cell(16, 6, utf8_decode($_SESSION['eleve'][$j]['rang']), 1,0,'C',true);
				}
				$pdf->SetTextColor(0,0,0);
				$pdf->SetDrawColor(0,0,0);
			}
			
			$pdf->SetFont('Arial','',10);
			$i = 1;
			
			$pdf->FooterL();
			$pdf->setAuthor('Nyambi Computer Services');
			$nomFichier = 'Vue_Note_Annuelles_';
			$nomFichier .= $_SESSION['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');
		}
		
		
		
		
		
		
		elseif($_SESSION['print']=='RapportSequentiel'){
			$classe = $_SESSION['infoClasse'];
			$pdf->SetFillColor(125,205,180);
			
		if($_SESSION['section']=='en'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->Entete();
			// On met le titre du document 
			$titre = strtoupper("Sequence Report");
			
			$pdf->Titre($titre);
			
			// Informations diverses
			$pdf->SetFont('Times','B',16);
			$texte_1 = 'Class : ';
			// $pdf->SetTextColor(100,100,255);  // Bleu
			$texte_1 .= strtoupper($_SESSION['nom_classe']);
			// $pdf->SetTextColor(0,0,0);  // Noir
			if($_SESSION['sequence']=='1'){
				$texte_2 = 'Period : 1st Sequence';
			}elseif($_SESSION['sequence']=='2'){
				$texte_2 = 'Period : 2nd Sequence';
			}elseif($_SESSION['sequence']=='3'){
				$texte_2 = 'Period : 3rd Sequence';
			}else{
				$texte_2 = 'Period : '.$_SESSION['sequence'].'th Sequence';
			}
			
			$pdf->Cell(70,10,utf8_decode($texte_1), 0,0,'L');
			$pdf->Cell(80,10,utf8_decode($texte_2), 0,0,'R');
			$pdf->Ln(15);
			
			
			$pdf->SetFont('Arial','B',8);
			// Je positionne l'entete du tableau
			$pdf->Cell(8, 6, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(70, 6, utf8_decode('Full Name'), 1, 0 , 'C');
			// $pdf->Cell(12, 7, 'Sexe', 1, 0 , 'C');
			$pdf->Cell(10, 6, 'Status', 1, 0 , 'C');
			$gpe = $_SESSION['groupe'];
			for($i=0;$i<count($gpe);$i++){
				$nomGp = $gpe[$i];
				$matiere = $_SESSION['code_matiere'][$nomGp];
				for($j=0;$j<count($matiere);$j++){
					$pdf->Cell(9,6,$matiere[$j]['id_matiere'],1,0,'C');
				}
				
			}
			$pdf->Cell(12, 6, 'Pts', 1, 0 , 'C');
			$pdf->Cell(11, 6, 'Coef', 1, 0 , 'C');
			$pdf->Cell(12, 6, 'Av', 1, 0 , 'C');
			$pdf->Cell(12, 6, 'Rank', 1, 0 , 'C');
			$pdf->Cell(10, 6, 'Cote', 1, 0 , 'C');
			
			
			// Les notes envoyées par la BD
			
			$y = 1;
			for($x=0;$x<count($_SESSION['eleve']);$x++){
				$nomEleve = $_SESSION['eleve'][$x]['nom_eleve'];
				$sexe = $_SESSION['eleve'][$x]['sexe'];
				$statut = $_SESSION['eleve'][$x]['statut'];
				
				$pdf->Ln(6);
				$pdf->Cell(8, 5, $y, 1, 0 , 'C');
				$pdf->Cell(70, 5, $nomEleve, 1, 0 , 'L');
				// $pdf->Cell(12,5,$sexe,1,0,'C');
				$pdf->Cell(10,5,$statut,1,0,'C');
				$groupe = $_SESSION['groupe'];
				for($z=0;$z<count($groupe);$z++){
					$nomGroupe = $groupe[$z];
					$mat = $_SESSION['matiere'][$nomGroupe];
					for($a=0;$a<count($mat);$a++){
						$champNote = $mat[$a]['id_matiere'].'_seq1';
						
						/*$champCoef
						$champMoyenne
						$champRang
						$champCote*/
						$valeurNote = $_SESSION['eleve'][$x][$champNote];
						if($valeurNote=='0.00'){
							$pdf->Cell(9,5,'--',1,0,'C');
						}else{
							$pdf->Cell(9,5,$valeurNote,1,0,'C');
						}
						
						// $pdf->Cell(10,7,$mat[$a]['id_matiere'],1,0,'C');
					}
				}
				$y++;
				$champPoint = 'total_point';
				
				$pdf->Cell(12,5,$_SESSION['eleve'][$x][$champPoint],1,0,'C');
				$pdf->Cell(11, 5, $_SESSION['eleve'][$x]['total_coef'], 1, 0 , 'C');
				$pdf->SetFillColor(200,205,180);
				if($_SESSION['eleve'][$x]['moyenne']=='0.00'){
					$pdf->Cell(12, 5, '--', 1, 0 , 'C',true);
				}else{
					$pdf->Cell(12, 5, $_SESSION['eleve'][$x]['moyenne'], 1, 0 , 'C',true);
				}
				
				$pdf->SetFillColor(125,205,180);
				if($_SESSION['eleve'][$x]['moyenne']=='0.00'){
					$pdf->Cell(12, 5, 'NC', 1, 0 , 'C',true);
				}else{
					$rangEleve = utf8_decode($_SESSION['eleve'][$x]['rang']);
					if($rangEleve=='1'){
						$pdf->Cell(12, 5, '1st', 1, 0 , 'C',true);
					}elseif($rangEleve=='2'){
						$pdf->Cell(12, 5, '2nd', 1, 0 , 'C',true);
					}elseif($rangEleve=='3'){
						$pdf->Cell(12, 5, '3rd', 1, 0 , 'C',true);
					}else{
						$ran = $rangEleve.'th';
						$pdf->Cell(12, 5, $ran, 1, 0 , 'C',true);
					}
					// $pdf->Cell(12, 5, utf8_decode($_SESSION['eleve'][$x]['rang']), 1, 0 , 'C',true);
				}
				$pdf->Cell(10, 5, $_SESSION['eleve'][$x]['cote'], 1, 0 , 'C');
			}
			
			
			
			$pdf->TitreL("In Brief");
			
			$pdf->Ln(7);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40, 5, utf8_decode("Stud Ev."), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Nbr of Av."), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Nbr of Sub Av"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Percentage"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("General Av"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Best Av"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Lower Av"), 1, 0 , 'C');
			$pdf->Ln(6);
			
			// Eff Evalué
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Nb Moyenne
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Nb Sous Moy 
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Taux de Reussite
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Moy Gle
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Forte Moy
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Faible Moy
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			$pdf->Ln(6);
			
			
			
			// Eff Evalué
			$pdf->Cell(13, 5, $_SESSION['stat']['evalFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['evalMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['evalTotal'], 1, 0 , 'C',true);
			// Nb Moyenne
			$pdf->Cell(13, 5, $_SESSION['stat']['moyFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['moyMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['moyTotal'], 1, 0 , 'C',true);
			// Nb Sous Moy 
			$pdf->Cell(13, 5, $_SESSION['stat']['sousMoyFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['sousMoyMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['sousMoyTotal'], 1, 0 , 'C',true);
			// Taux de Reussite
			$pdf->Cell(13, 5, $_SESSION['stat']['tauxFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['tauxMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['tauxTotal'], 1, 0 , 'C',true);
			// Moy Gle
			$pdf->Cell(13, 5, $_SESSION['stat']['moyGenFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['moyGenMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['moyGenTotal'], 1, 0 , 'C',true);
			// Forte Moy
			$pdf->Cell(13, 5, $_SESSION['stat']['noteForteFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['noteForteMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['noteForteTotal'], 1, 0 , 'C',true);
			// Faible Moy
			$pdf->Cell(13, 5, $_SESSION['stat']['noteFaibleFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['noteFaibleMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['noteFaibleTotal'], 1, 0 , 'C',true);
			$pdf->Ln(6);
			
			
			
			
			$pdf->FooterL();
			$pdf->setAuthor('Nyambi Computer Services');
			$nomFichier = 'Sequence_Report_'.str_replace(' ','_',$_SESSION['sequence']).'_';
			$nomFichier .= $_SESSION['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');	
		}
			
			
		elseif($_SESSION['section']=='fr'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->Entete();
			// On met le titre du document 
			$titre = strtoupper("Rapport Sequentiel");
			
			$pdf->Titre($titre);
			
			// Informations diverses
			$pdf->SetFont('Times','B',16);
			$texte_1 = 'Classe : '.$classe['nom_classe'];
			// $pdf->SetTextColor(100,100,255);  // Bleu
			$texte_1 .= strtoupper($_SESSION['nom_classe']);
			// $pdf->SetTextColor(0,0,0);  // Noir
			$texte_2 = 'Période : '.$_SESSION['nom_sequence'];
			$pdf->Cell(70,10,utf8_decode($texte_1), 0,0,'L');
			$pdf->Cell(80,10,utf8_decode($texte_2), 0,0,'R');
			$pdf->Ln(15);
			
			
			$pdf->SetFont('Arial','B',10);
			// Je positionne l'entete du tableau
			$pdf->Cell(10, 5, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(78, 5, utf8_decode('Noms et Prénoms'), 1, 0 , 'C');
			$pdf->Cell(12, 5, 'Sexe', 1, 0 , 'C');
			$pdf->Cell(12, 5, 'Statut', 1, 0 , 'C');
			$gpe = $_SESSION['groupe'];
			for($i=0;$i<count($gpe);$i++){
				$nomGp = $gpe[$i];
				$matiere = $_SESSION['matiere'][$nomGp];
				for($j=0;$j<count($matiere);$j++){
					$pdf->Cell(10,5,$matiere[$j]['code_matiere'],1,0,'C');
				}
			}
			$pdf->Cell(12, 5, 'Pts', 1, 0 , 'C');
			$pdf->Cell(11, 5, 'Coef', 1, 0 , 'C');
			$pdf->Cell(12, 5, 'Moy', 1, 0 , 'C');
			$pdf->Cell(12, 5, 'Rang', 1, 0 , 'C');
			$pdf->Cell(10, 5, 'Cote', 1, 0 , 'C');
			
			
			// Les notes envoyées par la BD
			
			$y = 1;
			for($x=0;$x<count($_SESSION['eleve']);$x++){
				$nomEleve = $_SESSION['eleve'][$x]['nom_eleve'];
				$sexe = $_SESSION['eleve'][$x]['sexe'];
				$statut = $_SESSION['eleve'][$x]['statut'];
				
				$pdf->Ln(5);
				$pdf->Cell(10, 5, $y, 1, 0 , 'C');
				$pdf->Cell(78, 5, $nomEleve, 1, 0 , 'L');
				$pdf->Cell(12,5,$sexe,1,0,'C');
				$pdf->Cell(12,5,$statut,1,0,'C');
				$groupe = $_SESSION['groupe'];
				for($z=0;$z<count($groupe);$z++){
					$nomGroupe = $groupe[$z];
					$mat = $_SESSION['matiere'][$nomGroupe];
					for($a=0;$a<count($mat);$a++){
						$champNote = strtolower($mat[$a]['code_matiere']).'_seq';
						
						/*$champCoef
						$champMoyenne
						$champRang
						$champCote*/
						$valeurNote = $_SESSION['eleve'][$x][$champNote];
						if($valeurNote=='0.00'){
							$pdf->Cell(10,5,'--',1,0,'C');
						}else{
							$pdf->Cell(10,5,$valeurNote,1,0,'C');
						}
						
						// $pdf->Cell(10,7,$mat[$a]['id_matiere'],1,0,'C');
					}
				}
				$y++;
				$champPoint = 'total_point';
				
				$pdf->Cell(12,5,$_SESSION['eleve'][$x][$champPoint],1,0,'C',true);
				$pdf->Cell(11, 5, $_SESSION['eleve'][$x]['total_coef'], 1, 0 , 'C',true);
				// $pdf->SetFillColor(200,205,180);
				if($_SESSION['eleve'][$x]['moyenne']=='0.00'){
					$pdf->Cell(12, 5, '--', 1, 0 , 'C',true);
				}else{
					$pdf->Cell(12, 5, $_SESSION['eleve'][$x]['moyenne'], 1, 0 , 'C',true);
				}
				
				// $pdf->SetFillColor(125,205,180);
				if($_SESSION['eleve'][$x]['moyenne']=='0.00'){
					$pdf->Cell(12, 5, 'NC', 1, 0 , 'C',true);
				}else{
					$rangEleve = $_SESSION['eleve'][$x]['rang'];
					if($rangEleve=='1'){
						$rangEleve = $rangEleve.'er';
						$pdf->Cell(12, 5, utf8_decode($rangEleve), 1, 0 , 'C',true);
					}elseif($rangEleve=='2'){
						$rangEleve = $rangEleve.'nd';
						$pdf->Cell(12, 5, utf8_decode($rangEleve), 1, 0 , 'C',true);
					}else{
						if($rangEleve==''){
							$rangEleve = '';
							$pdf->Cell(12, 5, utf8_decode($rangEleve), 1, 0 , 'C',true);
						}else{
							$rangEleve = $rangEleve.'ème';
							$pdf->Cell(12, 5, utf8_decode($rangEleve), 1, 0 , 'C',true);
						}
					}
				}
				$pdf->Cell(10, 5, $_SESSION['eleve'][$x]['cote'], 1, 0 , 'C',true);
			}
			
			
			$pdf->Titre("En Bref");
			
			$pdf->Ln(7);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40, 5, utf8_decode("Eff. Evalué"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Nb Moyenne"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Nb Sous - Moyenne"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Taux de Réussite"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Moy. Générale "), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Forte Moyenne "), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Faible Moyenne "), 1, 0 , 'C');
			$pdf->Ln(5);
			
			// Eff Evalué
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// // Nb Moyenne
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// // Nb Sous Moy 
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// // Taux de Reussite
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// // Moy Gle
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// // Forte Moy
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Faible Moy
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			$pdf->Ln(5);
			
			
			
			// // Eff Evalué
			$pdf->Cell(13, 5, $_SESSION['stat']['evalFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['evalMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['evalTotal'], 1, 0 , 'C',true);
			// // Nb Moyenne
			$pdf->Cell(13, 5, $_SESSION['stat']['moyFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['moyMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['moyTotal'], 1, 0 , 'C',true);
			// // Nb Sous Moy 
			$pdf->Cell(13, 5, $_SESSION['stat']['sousMoyFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['sousMoyMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['sousMoyTotal'], 1, 0 , 'C',true);
			// // Taux de Reussite
			$pdf->Cell(13, 5, $_SESSION['stat']['tauxFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['tauxMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['tauxTotal'], 1, 0 , 'C',true);
			// Moy Gle
			$pdf->Cell(13, 5, $_SESSION['stat']['moyGenFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['moyGenMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['moyGenTotal'], 1, 0 , 'C',true);
			// // Forte Moy
			$pdf->Cell(13, 5, $_SESSION['stat']['noteForteFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['noteForteMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['noteForteTotal'], 1, 0 , 'C',true);
			// // Faible Moy
			$pdf->Cell(13, 5, $_SESSION['stat']['noteFaibleFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['noteFaibleMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['noteFaibleTotal'], 1, 0 , 'C',true);
			$pdf->Ln(5);
			
			
			
			
			// $pdf->Footer();
			$pdf->setAuthor('Nyambi Computer Services');
			$nomFichier = 'Rapport_Sequence_'.$_SESSION['nom_sequence'];
			$nomFichier .= '_'.$classe['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');	
		}
			
			
			
			
		}
		
		
		
		
		
		
		
		elseif($_SESSION['print']=='RapportTrimestriel'){
			if($_SESSION['section']=='en'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDocLAnglais($ministereAnglais, $paysAnglais, $etsAnglais, $deviseAnglais, $contact, $as);
			// On met le titre du document 
			$titre = strtoupper("Term Report");
			
			$pdf->TitreL($titre);
			
			// Informations diverses
			$pdf->SetFont('Times','B',16);
			$texte_1 = 'Class : ';
			// $pdf->SetTextColor(100,100,255);  // Bleu
			$texte_1 .= strtoupper($_SESSION['nom_classe']);
			// $pdf->SetTextColor(0,0,0);  // Noir
			if($_SESSION['trimestre']=='1'){
				$texte_2 = 'Period : 1st Term';
			}elseif($_SESSION['trimestre']=='2'){
				$texte_2 = 'Period : 2nd Term';
			}elseif($_SESSION['trimestre']=='3'){
				$texte_2 = 'Period : 3rd Term';
			}
			
			$pdf->Cell(70,10,utf8_decode($texte_1), 0,0,'L');
			$pdf->Cell(80,10,utf8_decode($texte_2), 0,0,'R');
			$pdf->Ln(15);
			
			
			$pdf->SetFont('Arial','B',8);
			// Je positionne l'entete du tableau
			$pdf->Cell(8, 6, utf8_decode('N°'), 1, 0 , 'C');
			$pdf->Cell(62, 6, utf8_decode('Full Name'), 1, 0 , 'C');
			// $pdf->Cell(12, 7, 'Sexe', 1, 0 , 'C');
			$pdf->Cell(10, 6, 'Status', 1, 0 , 'C');
			$gpe = $_SESSION['groupe'];
			for($i=0;$i<count($gpe);$i++){
				$nomGp = $gpe[$i];
				$matiere = $_SESSION['matiere'][$nomGp];
				for($j=0;$j<count($matiere);$j++){
					$pdf->Cell(9,6,$matiere[$j]['id_matiere'],1,0,'C');
				}
				
			}
			$pdf->Cell(12, 6, 'Pts', 1, 0 , 'C');
			$pdf->Cell(11, 6, 'Coef', 1, 0 , 'C');
			$pdf->Cell(12, 6, 'Av', 1, 0 , 'C');
			$pdf->Cell(12, 6, 'Rank', 1, 0 , 'C');
			$pdf->Cell(10, 6, 'Cote', 1, 0 , 'C');
			
			
			// Les notes envoyées par la BD
			
			$y = 1;
			for($x=0;$x<count($_SESSION['eleve']);$x++){
				$nomEleve = $_SESSION['eleve'][$x]['nom_eleve'];
				$sexe = $_SESSION['eleve'][$x]['sexe'];
				$statut = $_SESSION['eleve'][$x]['statut'];
				
				$pdf->Ln(6);
				$pdf->Cell(8, 5, $y, 1, 0 , 'C');
				$pdf->Cell(62, 5, $nomEleve, 1, 0 , 'L');
				// $pdf->Cell(12,5,$sexe,1,0,'C');
				$pdf->Cell(10,5,$statut,1,0,'C');
				$groupe = $_SESSION['groupe'];
				for($z=0;$z<count($groupe);$z++){
					$nomGroupe = $groupe[$z];
					$mat = $_SESSION['matiere'][$nomGroupe];
					for($a=0;$a<count($mat);$a++){
						$champNote = $mat[$a]['id_matiere'].'_trim';
						
						/*$champCoef
						$champMoyenne
						$champRang
						$champCote*/
						$valeurNote = $_SESSION['eleve'][$x][$champNote];
						if($valeurNote=='0.00'){
							$pdf->Cell(9,5,'--',1,0,'C',true);
						}else{
							$pdf->Cell(9,5,$valeurNote,1,0,'C');
						}
						
						// $pdf->Cell(10,7,$mat[$a]['id_matiere'],1,0,'C');
					}
				}
				$y++;
				$champPoint = 'total_point';
				
				$pdf->Cell(12,5,$_SESSION['eleve'][$x][$champPoint],1,0,'C');
				$pdf->Cell(11, 5, $_SESSION['eleve'][$x]['total_coef'], 1, 0 , 'C');
				$pdf->SetFillColor(200,205,180);
				if($_SESSION['eleve'][$x]['moyenne']=='0.00'){
					$pdf->Cell(12, 5, '--', 1, 0 , 'C',true);
				}else{
					$pdf->Cell(12, 5, $_SESSION['eleve'][$x]['moyenne'], 1, 0 , 'C',true);
				}
				
				$pdf->SetFillColor(125,205,180);
				if($_SESSION['eleve'][$x]['moyenne']=='0.00'){
					$pdf->Cell(12, 5, 'NC', 1, 0 , 'C',true);
				}else{
					$rangEleve = utf8_decode($_SESSION['eleve'][$x]['rang']);
					if($rangEleve=='1'){
						$pdf->Cell(12, 5, '1st', 1, 0 , 'C',true);
					}elseif($rangEleve=='2'){
						$pdf->Cell(12, 5, '2nd', 1, 0 , 'C',true);
					}elseif($rangEleve=='3'){
						$pdf->Cell(12, 5, '3rd', 1, 0 , 'C',true);
					}else{
						$ran = $rangEleve.'th';
						$pdf->Cell(12, 5, $ran, 1, 0 , 'C',true);
					}
					// $pdf->Cell(12, 5, utf8_decode($_SESSION['eleve'][$x]['rang']), 1, 0 , 'C',true);
				}
				$pdf->Cell(10, 5, $_SESSION['eleve'][$x]['cote'], 1, 0 , 'C');
			}
			
			
			
			$pdf->TitreL("In Brief");
			
			$pdf->Ln(7);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40, 5, utf8_decode("Stud Ev."), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Nbr of Av."), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Nbr of Sub Av"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Percentage"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("General Av"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Best Av"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Lower Av"), 1, 0 , 'C');
			$pdf->Ln(6);
			
			// Eff Evalué
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Nb Moyenne
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Nb Sous Moy 
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Taux de Reussite
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Moy Gle
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Forte Moy
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Faible Moy
			$pdf->Cell(13, 5, utf8_decode("W"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("M"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			$pdf->Ln(6);
			
			
			
			// Eff Evalué
			$pdf->Cell(13, 5, $_SESSION['stat']['evalFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['evalMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['evalTotal'], 1, 0 , 'C',true);
			// Nb Moyenne
			$pdf->Cell(13, 5, $_SESSION['stat']['moyFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['moyMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['moyTotal'], 1, 0 , 'C',true);
			// Nb Sous Moy 
			$pdf->Cell(13, 5, $_SESSION['stat']['sousMoyFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['sousMoyMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['sousMoyTotal'], 1, 0 , 'C',true);
			// Taux de Reussite
			$pdf->Cell(13, 5, $_SESSION['stat']['tauxFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['tauxMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['tauxTotal'], 1, 0 , 'C',true);
			// Moy Gle
			$pdf->Cell(13, 5, $_SESSION['stat']['moyGenFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['moyGenMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['moyGenTotal'], 1, 0 , 'C',true);
			// Forte Moy
			$pdf->Cell(13, 5, $_SESSION['stat']['noteForteFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['noteForteMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['noteForteTotal'], 1, 0 , 'C',true);
			// Faible Moy
			$pdf->Cell(13, 5, $_SESSION['stat']['noteFaibleFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['noteFaibleMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['noteFaibleTotal'], 1, 0 , 'C',true);
			$pdf->Ln(6);
			
			
			
			
			$pdf->FooterL();
			$pdf->setAuthor('Nyambi Computer Services');
			$nomFichier = 'Term_Report_'.str_replace(' ','_',$_SESSION['trimestre']).'_';
			$nomFichier .= $_SESSION['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');	
		}
			
			
		elseif($_SESSION['section']=='fr'){
			$pdf->addPage();
			// On met l'entête du document
			$pdf->EnteteDocL($ministere, $pays, $ets, $devise, $contact, $as);
			// On met le titre du document 
			$titre = strtoupper("Rapport Trimestriel");
			
			$pdf->TitreL($titre);
			
			// Informations diverses
			$pdf->SetFont('Times','B',16);
			$texte_1 = 'Classe : ';
			// $pdf->SetTextColor(100,100,255);  // Bleu
			$texte_1 .= strtoupper($_SESSION['nom_classe']);
			// $pdf->SetTextColor(0,0,0);  // Noir
			$texte_2 = 'Période : '.$_SESSION['nom_trimestre'];
			$pdf->Cell(70,10,utf8_decode($texte_1), 0,0,'L');
			$pdf->Cell(80,10,utf8_decode($texte_2), 0,0,'R');
			$pdf->Ln(15);
			$pdf->SetFillColor(110,110,110);
			
			$pdf->SetFont('Arial','B',8);
			// Je positionne l'entete du tableau
			$pdf->Cell(8, 7, utf8_decode('N°'), 1, 0 , 'C',true);
			$pdf->Cell(70, 7, utf8_decode('Noms et Prénoms'), 1, 0 , 'C',true);
			// $pdf->Cell(12, 7, 'Sexe', 1, 0 , 'C');
			$pdf->Cell(10, 7, 'Statut', 1, 0 , 'C',true);
			$gpe = $_SESSION['groupe'];
			for($i=0;$i<count($gpe);$i++){
				$nomGp = $gpe[$i];
				$matiere = $_SESSION['matiere'][$nomGp];
				for($j=0;$j<count($matiere);$j++){
					$pdf->Cell(9,7,$matiere[$j]['id_matiere'],1,0,'C',true);
				}
				
			}
			$pdf->Cell(12, 7, 'Pts', 1, 0 , 'C',true);
			$pdf->Cell(11, 7, 'Coef', 1, 0 , 'C',true);
			$pdf->Cell(12, 7, 'Moy', 1, 0 , 'C',true);
			$pdf->Cell(12, 7, 'Rang', 1, 0 , 'C',true);
			$pdf->Cell(10, 7, 'Cote', 1, 0 , 'C',true);
			
			
			// Les notes envoyées par la BD
			
			$y = 1;
			for($x=0;$x<count($_SESSION['eleve']);$x++){
				$nomEleve = $_SESSION['eleve'][$x]['nom_eleve'];
				$sexe = $_SESSION['eleve'][$x]['sexe'];
				$statut = $_SESSION['eleve'][$x]['statut'];
				
				$pdf->SetFillColor(125,205,180);
				$pdf->Ln(7);
				$pdf->Cell(8, 5, $y, 1, 0 , 'C');
				$pdf->Cell(70, 5, $nomEleve, 1, 0 , 'L');
				// $pdf->Cell(12,5,$sexe,1,0,'C');
				$pdf->Cell(10,5,$statut,1,0,'C');
				$groupe = $_SESSION['groupe'];
				for($z=0;$z<count($groupe);$z++){
					$nomGroupe = $groupe[$z];
					$mat = $_SESSION['matiere'][$nomGroupe];
					for($a=0;$a<count($mat);$a++){
						$champNote = $mat[$a]['id_matiere'].'_trim';
						
						/*$champCoef
						$champMoyenne
						$champRang
						$champCote*/
						$valeurNote = $_SESSION['eleve'][$x][$champNote];
						if($valeurNote=='0.00'){
							$pdf->Cell(9,5,'--',1,0,'C',true);
						}else{
							$pdf->Cell(9,5,$valeurNote,1,0,'C');
						}
						
						// $pdf->Cell(10,7,$mat[$a]['id_matiere'],1,0,'C');
					}
				}
				$y++;
				$champPoint = 'total_point';
				
				$pdf->Cell(12,5,$_SESSION['eleve'][$x][$champPoint],1,0,'C');
				$pdf->Cell(11, 5, $_SESSION['eleve'][$x]['total_coef'], 1, 0 , 'C');
				$pdf->SetFillColor(200,205,180);
				if($_SESSION['eleve'][$x]['moyenne']=='0.00'){
					$pdf->Cell(12, 5, '--', 1, 0 , 'C',true);
				}else{
					$pdf->Cell(12, 5, $_SESSION['eleve'][$x]['moyenne'], 1, 0 , 'C',true);
				}
				
				
				if($_SESSION['eleve'][$x]['moyenne']=='0.00'){
					$pdf->Cell(12, 5, 'NC', 1, 0 , 'C',true);
				}else{
					$rangEleve = $_SESSION['eleve'][$x]['rang'];
					if($rangEleve=='1'){
						$rangEleve = $rangEleve.'er';
						$pdf->Cell(12, 5, utf8_decode($rangEleve), 1, 0 , 'C',true);
					}elseif($rangEleve=='2'){
						$rangEleve = $rangEleve.'nd';
						$pdf->Cell(12, 5, utf8_decode($rangEleve), 1, 0 , 'C',true);
					}else{
						$rangEleve = $rangEleve.'ème';
						$pdf->Cell(12, 5, utf8_decode($rangEleve), 1, 0 , 'C',true);
					}
					
				}
				$pdf->Cell(10, 5, $_SESSION['eleve'][$x]['cote'], 1, 0 , 'C');
			}
			
			
			$pdf->TitreL("En Bref");
			
			$pdf->Ln(7);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40, 5, utf8_decode("Eff. Evalué"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Nb Moyenne"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Nb Sous - Moyenne"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Taux de Réussite"), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Moy. Générale "), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Forte Moyenne "), 1, 0 , 'C');
			$pdf->Cell(40, 5, utf8_decode("Faible Moyenne "), 1, 0 , 'C');
			$pdf->Ln(6);
			
			// Eff Evalué
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Nb Moyenne
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Nb Sous Moy 
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Taux de Reussite
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Moy Gle
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Forte Moy
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			// Faible Moy
			$pdf->Cell(13, 5, utf8_decode("F"), 1, 0 , 'C');
			$pdf->Cell(13, 5, utf8_decode("G"), 1, 0 , 'C');
			$pdf->Cell(14, 5, utf8_decode("T"), 1, 0 , 'C',true);
			$pdf->Ln(6);
			
			
			
			// Eff Evalué
			$pdf->Cell(13, 5, $_SESSION['stat']['evalFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['evalMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['evalTotal'], 1, 0 , 'C',true);
			// Nb Moyenne
			$pdf->Cell(13, 5, $_SESSION['stat']['moyFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['moyMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['moyTotal'], 1, 0 , 'C',true);
			// Nb Sous Moy 
			$pdf->Cell(13, 5, $_SESSION['stat']['sousMoyFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['sousMoyMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['sousMoyTotal'], 1, 0 , 'C',true);
			// Taux de Reussite
			$pdf->Cell(13, 5, $_SESSION['stat']['tauxFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['tauxMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['tauxTotal'], 1, 0 , 'C',true);
			// Moy Gle
			$pdf->Cell(13, 5, $_SESSION['stat']['moyGenFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['moyGenMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['moyGenTotal'], 1, 0 , 'C',true);
			// Forte Moy
			$pdf->Cell(13, 5, $_SESSION['stat']['noteForteFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['noteForteMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['noteForteTotal'], 1, 0 , 'C',true);
			// Faible Moy
			$pdf->Cell(13, 5, $_SESSION['stat']['noteFaibleFille'], 1, 0 , 'C');
			$pdf->Cell(13, 5, $_SESSION['stat']['noteFaibleMasc'], 1, 0 , 'C');
			$pdf->Cell(14, 5, $_SESSION['stat']['noteFaibleTotal'], 1, 0 , 'C',true);
			$pdf->Ln(6);
			
			
			
			
			$pdf->FooterL();
			$pdf->setAuthor('Nyambi Computer Services');
			$nomFichier = 'Rapport_'.str_replace(' ','_',$_SESSION['nom_trimestre']).'_';
			$nomFichier .= $_SESSION['nom_classe'].'.pdf';
			$pdf->Output($nomFichier, 'I');	
		}
			
			
		}
		
		
		
		
		
		
		
		
		
		
		/***********************************************************
		************************************************************
		// Génération des tableaux d'Honneur Trimestrels 
		************************************************************
		***********************************************************/
		elseif($_SESSION['print']=='TableauTrimestriel'){
			
			$eleve = $_SESSION['eleve'];
			for($a=0;$a<count($eleve);$a++){
				$pdf->addPage();
				// On met l'entête du document 
				$pdf->EnteteDocL($ministere, $pays, $ets, $devise, $contact, $as);
				if($_SESSION['trimestre']==1){
					$trimestre = $_SESSION['trimestre'].'er trimestre';
					$trimestre_lettre = 'Premier Trimestre';
					$codeTri = 'trim';
				}else{
					$trimestre = $_SESSION['trimestre'].'ème trimestre';
					if($_SESSION['trimestre']==2){
						$trimestre_lettre = 'Deuxième Trimestre';
					}elseif($_SESSION['trimestre']==3){
						$trimestre_lettre = 'Troisième Trimestre';
					}
				}
				// Y'a t-il encouragements ou Félicitations ? 
				$moyenne = $eleve[$a]['moyenne'];
				if($moyenne>=15){
					$felicitations = "Avec Félicitations ";
				}else{$felicitations = " ";}
				if($moyenne>=14){
					$encouragements = "Avec Encouragements ";
				}else{$encouragements = " ";}
				// On met le titre du document
				$pdf->SetFont('Times','BUI',40);
				$titre = "Tableau d'Honneur";
				$pdf->Text(65,45,strtoupper(utf8_decode($titre)));
				$pdf->SetFont('Times','I',20);
				
				// Informations sur l'élève 
				$nom = $eleve[$a]['nom_eleve'];
				$dateNaissance = $eleve[$a]['date_fr'];
				$lieuNaissance = $eleve[$a]['lieu_naissance'];
				$nomClasse = strtoupper($_SESSION['nom_classe']);
				$rang = $eleve[$a]['rang'];
				$lib_nom = "Attribué à l'élève ";
				$lib_date_naissance = "Né (e) le  ";
				$lib_lieu_naissance = "à  ";
				$lib_classe = "de la Classe de ";
				$lib_trimestre1 = "Pour le  ";
				$lib_trimestre2 = "de l'Année Scolaire  ";
				$lib_moyenne_obtenue = "Moyenne Obtenue : ";
				$lib_rang_obtenu = "Rang de l'élève : ";
				$pdf->Text(20,65,utf8_decode($lib_nom));
				$pdf->Text(20,80,utf8_decode($lib_date_naissance));
				$pdf->Text(130,80,utf8_decode($lib_lieu_naissance));
				$pdf->Text(20,95,utf8_decode($lib_classe));
				$pdf->Text(20,110,utf8_decode($lib_trimestre1));
				$pdf->Text(150,110,utf8_decode($lib_trimestre2));
				$pdf->Text(20,125,utf8_decode($lib_moyenne_obtenue));
				$pdf->Text(150,125,utf8_decode($lib_rang_obtenu));
				
				
				
				
				$pdf->SetFont('Courier','B',20);
				$pdf->Text(120,65, utf8_decode($nom));
				$pdf->Text(60,80, utf8_decode($dateNaissance));
				$pdf->Text(150,80, utf8_decode($lieuNaissance));
				$pdf->Text(125,95, utf8_decode($nomClasse));
				$pdf->Text(60,110, utf8_decode($trimestre_lettre));
				$pdf->Text(210,110, utf8_decode($as));
				$pdf->Text(90,125,utf8_decode($moyenne));
				$pdf->Text(200,125,utf8_decode($rang));
				$pdf->Text(20,140,utf8_decode($encouragements));
				$pdf->Text(20,155,utf8_decode($felicitations));
				
				$pdf->SetFont('Times','I',16);
				// $pdf->Cell(55,6, utf8_decode($nom),1,0,'C');
				$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
				// $pdf->Cell(60,5, utf8_decode($texte),0,0,'R');
				// $pdf->Cell(60,5,utf8_decode($signataire),0,0,'R');
				$pdf->Text(150,170, utf8_decode($texte));
				$pdf->Text(160,180, utf8_decode($signataire));
				$image =$eleve[$a]['photo'];
				// $pdf->Image($image, 170, 45, 22, 22);
			}
			// Le Nom du Fichier sera Tableau_Honneur_Trimestre_NumTrim_Classe
			$nomFichier = "Tableau_Honneur_";
			$nomFichier .= $trimestre_lettre."_";
			$nomFichier .= $nomClasse.".pdf";
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
	unset($_SESSION['sequence']);
	unset($_SESSION['classe']);