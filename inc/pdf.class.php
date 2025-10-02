<?php 
	require_once('fpdf.class.php');
	class pdf extends FPDF {
		
		
		function convert($texte){
			$txt = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $texte);
			return $txt;
		}
		
		
		
		function Entete(){
			$this->Image('images/logo.jpg', 90, 20, 25);
			$this->SetFont('Times','',8);
			$this->Cell(70,7, $this->convert($_SESSION['information']['pays_fr']),0,0,'C');
			$this->Cell(50,7, $this->convert(''),0,0,'C');
			$this->Cell(70,7, $this->convert($_SESSION['information']['pays_en']),0,0,'C');
			
			$this->Ln(4);
			
			$this->Cell(70,7, $this->convert($_SESSION['information']['devise_fr']),0,0,'C');
			$this->Cell(50,7, $this->convert(''),0,0,'C');
			$this->Cell(70,7, $this->convert($_SESSION['information']['devise_en']),0,0,'C');
			$this->Ln(3);
			
			$this->Cell(70,7, $this->convert('**************'),0,0,'C');
			$this->Cell(50,7, $this->convert(''),0,0,'C');
			$this->Cell(70,7, $this->convert('**************'),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(70,7, strtoupper($this->convert($_SESSION['information']['ministere_fr'])),0,0,'C');
			$this->Cell(50,7, strtoupper($this->convert('')),0,0,'C');
			$this->Cell(70,7, strtoupper($this->convert($_SESSION['information']['ministere_en'])),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(70,7, $this->convert('**************'),0,0,'C');
			$this->Cell(50,7, $this->convert(''),0,0,'C');
			$this->Cell(70,7, $this->convert('**************'),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(70,7, strtoupper($this->convert($_SESSION['information']['region_fr'])),0,0,'C');
			$this->Cell(50,7, strtoupper($this->convert('')),0,0,'C');
			$this->Cell(70,7, strtoupper($this->convert($_SESSION['information']['region_en'])),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(70,7, $this->convert('**************'),0,0,'C');
			$this->Cell(50,7, $this->convert(''),0,0,'C');
			$this->Cell(70,7, $this->convert('**************'),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(70,7, strtoupper($this->convert($_SESSION['information']['departement_fr'])),0,0,'C');
			$this->Cell(50,7, strtoupper($this->convert('')),0,0,'C');
			$this->Cell(70,7, strtoupper($this->convert($_SESSION['information']['departement_en'])),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(70,7, $this->convert('**************'),0,0,'C');
			$this->Cell(50,7, $this->convert(''),0,0,'C');
			$this->Cell(70,7, $this->convert('**************'),0,0,'C');
			$this->Ln(4);
			
			$this->SetFont('Times','B',9);
			$this->Cell(70,7, strtoupper($this->convert($_SESSION['information']['nom_etablissement_fr'])),0,0,'C');
			$this->Cell(50,7, $this->convert(''),0,0,'C');
			$this->Cell(70,7, strtoupper($this->convert($_SESSION['information']['nom_etablissement_en'])),0,0,'C');
			$this->Ln(4);
			
			$this->SetFont('Times','I',8);
			$contactFr = 'Contact : '.$_SESSION['information']['contact'];
			$contactEn = 'Contact : '.$_SESSION['information']['contact'];
			$emailFr = 'Email : '.$_SESSION['information']['email'];
			$emailEn = 'Email : '.$_SESSION['information']['email'];
			$bpFr = 'B.P. : '.$_SESSION['information']['bp'].' '.$_SESSION['information']['arrondissement'];
			$bpEn = 'P.O. Box: '.$_SESSION['information']['bp'].' '.$_SESSION['information']['arrondissement'];
			$this->Cell(70,7, $this->convert($bpFr.'. '.$contactFr),0,0,'C');
			$this->Cell(50,7, $this->convert(''),0,0,'C');
			$this->Cell(70,7, $this->convert($bpEn.'. '.$contactEn),0,0,'C');
			$this->Ln(4);
			
			$this->SetFont('Times','B',8);
			$asFr = 'Année Scolaire : '.$_SESSION['information']['annee_scolaire'];
			$asEn = 'School Year : '.$_SESSION['information']['annee_scolaire'];
			$this->Cell(70,7, $this->convert($asFr),0,0,'C');
			$this->Cell(50,7, $this->convert(''),0,0,'C');
			$this->Cell(70,7, $this->convert($asEn),0,0,'C');
			$this->Ln(10);

		}
		
		
		
		
		/*
		public function EnteteDoc($ministere, $pays, $ets, $devise, 
									$contact, $anneeScolaire){
			$this->SetFont('Times','',8);
			$this->Cell(10,20, utf8_decode($ministere),0,0,'L');
			$this->Cell(175,20, utf8_decode($pays),0,0,'R');
			$this->Image('images/logo.jpg', 100, 8, 20);
			
			$this->Ln(6);
			$this->SetFont('Times','B',11);
			$this->Cell(10,20, strtoupper(utf8_decode($ets)),0,0,'L');
			$this->SetFont('Times','',8);
			$this->Cell(165,20, $devise,0,0,'R');
			
			$this->Ln(6);
			$this->SetFont('Times','B',8);
			$this->Cell(10,20, utf8_decode($contact),0,0,'L');
			$this->Cell(165,20, 'Annee Scolaire : '.$anneeScolaire,0,0,'R');
		}*/
		
		
		
		
		
		
		
		
		/*
		public function EnteteDocAnglais($ministere, $pays, $ets, $devise, 
									$contact, $anneeScolaire){
			
			$this->SetFont('Times','',8);
			$this->Cell(10,20, utf8_decode($ministere),0,0,'L');
			$this->Cell(175,20, utf8_decode($pays),0,0,'R');
			$this->Image('images/logo.jpg', 100, 8, 20);
			
			$this->Ln(6);
			$this->SetFont('Times','B',11);
			$this->Cell(10,20, strtoupper(utf8_decode($ets)),0,0,'L');
			$this->SetFont('Times','',8);
			$this->Cell(165,20, $devise,0,0,'R');
			
			$this->Ln(6);
			$this->SetFont('Times','B',8);
			$this->Cell(10,20, utf8_decode($contact),0,0,'L');
			$this->Cell(165,20, 'School Year : '.$anneeScolaire,0,0,'R');
		}*/
		
		/*
		// POUR LE MODE PAYSAGE (LANDSCAPE)
		public function EnteteDocL($ministere, $pays, $ets, $devise,
									$contact, $anneeScolaire){
			$this->SetFont('Times','',8);
			$this->Cell(10,10, $ministere,0,0,'L');
			$this->Cell(250,10, $pays,0,0,'R');
			$this->Image('images/logo.jpg', 135, 8, 20);
			
			$this->Ln(6);
			$this->SetFont('Times','B',12);
			$this->Cell(10,10, utf8_decode($ets),0,0,'L');
			$this->SetFont('Times','',8);
			$this->Cell(245,10, $devise,0,0,'R');
			
			$this->Ln(6);
			$this->SetFont('Times','B',8);
			$this->Cell(10,10, $contact);
			$this->Cell(250,10, 'Annee Scolaire : '.$anneeScolaire,0,0,'R');
		}*/
		
		
		
		/*
		public function EnteteDocLAnglais($ministere, $pays, $ets, $devise,
									$contact, $anneeScolaire){
			$this->SetFont('Times','',8);
			$this->Cell(10,10, $ministere,0,0,'L');
			$this->Cell(250,10, $pays,0,0,'R');
			$this->Image('images/logo.jpg', 135, 8, 20);
			
			$this->Ln(6);
			$this->SetFont('Times','B',12);
			$this->Cell(10,10, utf8_decode($ets),0,0,'L');
			$this->SetFont('Times','',8);
			$this->Cell(245,10, $devise,0,0,'R');
			
			$this->Ln(6);
			$this->SetFont('Times','B',8);
			$this->Cell(10,10, $contact);
			$this->Cell(250,10, 'School Year : '.$anneeScolaire,0,0,'R');
		}*/
		
		
		function Titre($titre){
			// On crée d'abord un espace pour gérer les informations d'entête
			$this->Ln(9);
			$this->SetFont('Times', 'B', 18);
			// Déplacer à droite
			$this->Cell(10);
			// Bordure du titre
			$this->Cell(140, 8, $this->convert(strtoupper($titre)), 0, 0 , 'C');
			// Retour à la ligne
			$this->Ln(10);
		}
		
		
		
		
		
		
		public function TitreSans($titre){
			// On crée d'abord un espace pour gérer les informations d'entête
			$this->Ln(15);
			$this->SetFont('Times', 'B', 18);
			// Déplacer à droite
			$this->Cell(10);
			// Bordure du titre
			$this->Cell(140, 8, utf8_decode(strtoupper($titre)), 0, 0 , 'C');
			// Retour à la ligne
			$this->Ln(15);
		}
		
		
		
		
		public function TitreSans2($titre){
			// On crée d'abord un espace pour gérer les informations d'entête
			$this->Ln(5);
			$this->SetFont('Times', 'B', 14);
			// Déplacer à droite
			$this->Cell(10);
			// Bordure du titre
			$this->Cell(140, 8, utf8_decode($titre), 0, 0 , 'C');
			// Retour à la ligne
			$this->Ln(20);
		}
		
		
		
		function Footer(){
			$this->setFont('Arial', 'I', 6);
			$texte = $_SESSION['appName'].' '.$_SESSION['appVersion'];
			$texte .= ', votre partenaire éducatif. Tel : ';
			$texte .= $_SESSION['appContact'];
			// $numeroPage = 'Page '.$this->PageNo().' / '.$this->AliasNbPages();
			$this->Text(90,290, $this->convert($texte));
			$this->setAuthor('Nyambi Computer Services');
			$this->setCreator('Nyambi Ngikwa Richard');
			$dateGeneration = 'Edité le '.DATE('d / m / Y').' à '.DATE('H:i:s');
			$this->Text(25, 290, $this->convert($dateGeneration));
		}
		/*
		// Pour le mode Portrait
		public function Footer(){
			// $this->setY(-50);
			$this->setFont('Arial', 'I', 6);
			$texte = 'Noteplus 1.0.4, votre partenaire éducatif. Tel : ';
			$texte .= '675 - 400 - 828';
			$this->Text(60,290, utf8_decode($texte));
			// $numeroPage = 'Page '.$this->PageNo().' / '.$this->AliasNbPages();
			$dateImpr = 'Généré le ';
			$dateImpr .= DATE('d').'/'.DATE('m').'/'.DATE('Y');
			$dateImpr .= ' à '.DATE('H').':'.DATE('i').':'.DATE('s').'.';
			$this->Text(165,290, utf8_decode($dateImpr), 0,0,'R');
		}*/
		
		
		
		
		// Pour le mode Paysage
		public function FooterL(){
			// $this->setY(-50);
			$this->setFont('Arial', 'I', 6);
			$texte = 'Noteplus 1.0.4, votre partenaire éducatif. Tel : ';
			$texte .= '675 - 400 - 828';
			$this->Text(110,200, utf8_decode($texte));
			$numeroPage = 'Page '.$this->PageNo().' / '.$this->AliasNbPages();
			// $this->Text(190,290, utf8_decode($numeroPage), 0,0,'R');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function EnteteDocTest($ministere, $ministereAnglais, $pays, $paysAnglais, 
									$ets, $etsAnglais, $devise, $deviseAnglais, 
									$contact, $anneeScolaire, $region, $regionAnglais,
									$dpt, $dptAnglais){
			
			
			// Le logo !!!
			$this->Image('images/logo.jpg', 100, 8, 20);
			
			// 1ère Ligne !
			$this->setFont('Times', '', 8);
			$this->Text(10,10, utf8_decode($pays),0,0,'C');
			$this->Text(150,10, utf8_decode($paysAnglais),0,0,'L');
			
			// 2ème Ligne !
			$this->setFont('Times', '', 7);
			$this->Text(12,13, utf8_decode($devise),0,0,'C');
			$this->Text(152,13, utf8_decode($deviseAnglais),0,0,'L');
			
			// Les astérisques !
			$this->setFont('Times', '', 5);
			$this->Text(14,15, utf8_decode('******************'),0,0,'C');
			$this->Text(155,15, utf8_decode('******************'),0,0,'C');
			
			// 3ème Ligne !
			$this->setFont('Times', '', 8);
			$this->Text(8,18, utf8_decode($ministere),0,0,'C');
			$this->Text(148,18, utf8_decode($ministereAnglais),0,0,'L');
			
			// Les astérisques !
			$this->setFont('Times', '', 5);
			$this->Text(14,20, utf8_decode('******************'),0,0,'C');
			$this->Text(155,20, utf8_decode('******************'),0,0,'C');
			
			// 4ème Ligne !
			$this->setFont('Times', '', 8);
			$this->Text(10,23, utf8_decode(strtoupper($region)),0,0,'C');
			$this->Text(150,23, utf8_decode(strtoupper($regionAnglais)),0,0,'L');
			
			// Les astérisques !
			$this->setFont('Times', '', 5);
			$this->Text(14,25, utf8_decode('******************'),0,0,'C');
			$this->Text(155,25, utf8_decode('******************'),0,0,'C');
			
			// 5ème Ligne !
			$this->setFont('Times', '', 8);
			$this->Text(8,28, utf8_decode(strtoupper($dpt)),0,0,'C');
			$this->Text(140,28, utf8_decode(strtoupper($dptAnglais)),0,0,'L');
			
			// Les astérisques !
			$this->setFont('Times', '', 5);
			$this->Text(14,30, utf8_decode('******************'),0,0,'C');
			$this->Text(155,30, utf8_decode('******************'),0,0,'C');
			
			// 6ème Ligne !
			$this->setFont('Times', 'B', 9);
			$this->Text(8,33, utf8_decode(strtoupper($ets)),0,0,'C');
			$this->Text(140,33, utf8_decode(strtoupper($etsAnglais)),0,0,'L');
			
			// Les astérisques !
			$this->setFont('Times', 'B', 5);
			$this->Text(14,35, utf8_decode('******************'),0,0,'C');
			$this->Text(155,35, utf8_decode('******************'),0,0,'C');
			
			// 7ème Ligne !
			$contactFr = 'B.P. :  Bafia  Tel : '.$contact;
			$contactEn = 'P.O. Box  Bafia Phone : '.$contact;
			$mailFr = 'Adresse Email : csbcywibra@gmail.com';
			$mailEn = 'Mail : csbcywibra@gmail.com';
			$as = 'Année Scolaire : '.$anneeScolaire;
			$asAnglais = 'School Year : '.$anneeScolaire;
			$this->setFont('Times', '', 8);
			$this->Text(10,38, utf8_decode(strtoupper($contactFr)),0,0,'C');
			$this->Text(150,38, utf8_decode(strtoupper($contactEn)),0,0,'L');
			$this->setFont('Times', 'I', 8);
			$this->Text(10,41, utf8_decode($mailFr),0,0,'C');
			$this->Text(150,41, utf8_decode($mailEn),0,0,'L');
			
			// 8ème Ligne
			$this->setFont('Times', 'B', 9);
			$this->Text(10,45, utf8_decode($as),0,0,'C');
			$this->Text(150,45, utf8_decode($asAnglais),0,0,'L');
			$this->Ln(20);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function pvAnnuelAlphabetiqueFr($classe, $ville, $signataire){
			$this->SetFillColor(200,205,180);
			$titre = utf8_decode("Proces verbal annuel ");
			$this->TitreSans($titre);
			$classe = "Classe : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse = 'Effectif: '.count($_SESSION['eleve']);
			$effectifEvalue = 'Eff. Eval. : '.$_SESSION['eleve'][0]['classes'];
			$signataire = $_SESSION['signataire'];
			
			$this->SetFont('Times','B',12);
			$this->Text(10,60, utf8_decode($classe));
			$this->Text(100,60, utf8_decode($effectifClasse));
			$this->Text(170,60, utf8_decode($effectifEvalue));
			$this->Ln(10);
			/*Construction du tableau Informationnel statistique*/
			$this->SetFont('Times','B',10);
			$this->Cell(55,8,'',0,0,'C');
			$this->Cell(83,7,strtoupper(utf8_decode('statistique des moyennes')),1,0,'C',true);
			$this->Ln(7);
			$this->Cell(55);
			
			// $this->Cell(55,8,'',0,0,'C');
			$this->Cell(32,7,utf8_decode('Libellé'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Feminin'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Masculin'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Total'),1,0,'C',true);
			$this->Ln(7);
			$this->Cell(55);
			$this->SetFont('Times','',10);
			
			$this->Cell(32,7,utf8_decode('Moyennes'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Sous - Moyennes'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Moyenne Générale'),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Taux de Réussite'),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
			$this->Ln(7);
			
			$this->Cell(55);
				
			$this->Cell(32,7,utf8_decode('Forte Moyenne'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Faible Moyenne'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$this->Ln(10);
			
			
			// Informations du PV
			$this->SetFont('Times','B',8);
			$this->Cell(8,5,utf8_decode('N°'),1,0,'C',true);
			$this->Cell(20,5,utf8_decode('Matricule Nat.'),1,0,'C',true);
			$this->Cell(55,5,utf8_decode('Nom Complet'),1,0,'C',true);
			$this->Cell(8,5,utf8_decode('Sexe'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('Tr1'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('Tr2'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('Tr3'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Ann.'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Rang'),1,0,'C',true);
			$this->Cell(9,5,utf8_decode('Côte'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Appr.'),1,0,'C',true);
			$this->Cell(30,5,utf8_decode('Décision du Conseil'),1,0,'C',true);
			$this->Ln(5);
			
			$a = 1;
			$this->SetFont('Times','',8);
			for($i=0;$i<count($_SESSION['eleve']);$i++){
				$nomEleve = substr($_SESSION['eleve'][$i]['nom_eleve'],0,27);
				$this->Cell(8,5,utf8_decode($a),1,0,'C');
				$this->Cell(20,5,substr(utf8_decode($_SESSION['eleve'][$i]['rne']),0,27),1,0,'C');
				$this->Cell(55,5,utf8_decode($nomEleve),1,0,'L');
				$this->Cell(8,5,utf8_decode($_SESSION['eleve'][$i]['sexe']),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve'][$i]['moyenne_1'])),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve'][$i]['moyenne_2'])),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve'][$i]['moyenne_3'])),1,0,'C');
				
				$this->SetFont('Times','B',9);
				// La Gestion du Non Classé 
				if($_SESSION['eleve'][$i]['moyenne']=='0.00'){
					$this->Cell(12,5,'--',1,0,'C',true);
					$this->Cell(12,5,'-',1,0,'C');
					$this->Cell(9,5,'-',1,0,'C');
					$this->Cell(12,5,'-',1,0,'C');
					$this->Cell(30,5,'',1,0,'L');
				}else{
					$this->Cell(12,5,utf8_decode($_SESSION['eleve'][$i]['moyenne']),1,0,'C',true);
					if($_SESSION['eleve'][$i]['rang']==1){
						$rangEleve = $_SESSION['eleve'][$i]['rang'].'er';
					}else{$rangEleve = $_SESSION['eleve'][$i]['rang'].'ème';}
					$this->Cell(12,5,utf8_decode($rangEleve),1,0,'C');
					$this->Cell(9,5,utf8_decode($_SESSION['eleve'][$i]['cote']),1,0,'C');
					$this->Cell(12,5,utf8_decode($_SESSION['eleve'][$i]['appreciation']),1,0,'C');
					$this->Cell(30,5,'',1,0,'L');
				}
				$this->SetFont('Times','',9);
				$this->Ln(5);
				$a++;
			}
			$this->Ln(10);
			$this->Cell(100);
			$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
			$this->Cell(60,5, utf8_decode($texte),0,0,'R');
			$this->Ln(10);
			$this->Cell(100);
			$this->Cell(60,5,utf8_decode($signataire),0,0,'R');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function pvAnnuelAlphabetiqueEn($classe, $ville, $signataire){
			$this->SetFillColor(200,205,180);
			$titre = utf8_decode("Annual Report ");
			$this->TitreSans($titre);
			$classe = "Class : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse = 'Roll: '.count($_SESSION['eleve']);
			$effectifEvalue = 'Evaluated : '.$_SESSION['eleve'][0]['classes'];
			$signataire = $_SESSION['signataire_anglais'];
			
			$this->SetFont('Times','B',12);
			$this->Text(10,60, utf8_decode($classe));
			$this->Text(100,60, utf8_decode($effectifClasse));
			$this->Text(170,60, utf8_decode($effectifEvalue));
			$this->Ln(10);
			/*Construction du tableau Informationnel statistique*/
			$this->SetFont('Times','B',10);
			$this->Cell(55,8,'',0,0,'C');
			$this->Cell(83,7,strtoupper(utf8_decode('statistics')),1,0,'C',true);
			$this->Ln(7);
			$this->Cell(55);
			
			// $this->Cell(55,8,'',0,0,'C');
			$this->Cell(32,7,utf8_decode('Object'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Female'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Male'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Global'),1,0,'C',true);
			$this->Ln(7);
			$this->Cell(55);
			$this->SetFont('Times','',10);
			
			$this->Cell(32,7,utf8_decode('Averages'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Sub - Averages'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('General Average'),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Percentage'),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
			$this->Ln(7);
			
			$this->Cell(55);
				
			$this->Cell(32,7,utf8_decode('Fisrt Average'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Last Average'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$this->Ln(10);
			
			
			// Informations du PV
			$this->SetFont('Times','B',8);
			$this->Cell(8,5,utf8_decode('N°'),1,0,'C',true);
			$this->Cell(20,5,utf8_decode('National Id.'),1,0,'C',true);
			$this->Cell(55,5,utf8_decode('Full Name'),1,0,'C',true);
			$this->Cell(8,5,utf8_decode('Sex'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('T1'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('T2'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('T3'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Ann.'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Rank'),1,0,'C',true);
			$this->Cell(9,5,utf8_decode('Grade'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Appr.'),1,0,'C',true);
			$this->Cell(30,5,utf8_decode('Council Class Dec.'),1,0,'C',true);
			$this->Ln(5);
			
			$a = 1;
			$this->SetFont('Times','',8);
			for($i=0;$i<count($_SESSION['eleve']);$i++){
				$nomEleve = substr($_SESSION['eleve'][$i]['nom_eleve'],0,27);
				$this->Cell(8,5,utf8_decode($a),1,0,'C');
				$this->Cell(20,5,substr(utf8_decode($_SESSION['eleve'][$i]['rne']),0,27),1,0,'C');
				$this->Cell(55,5,utf8_decode($nomEleve),1,0,'L');
				$this->Cell(8,5,utf8_decode($_SESSION['eleve'][$i]['sexe']),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve'][$i]['moyenne_1'])),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve'][$i]['moyenne_2'])),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve'][$i]['moyenne_3'])),1,0,'C');
				
				$this->SetFont('Times','B',9);
				// La Gestion du Non Classé 
				if($_SESSION['eleve'][$i]['moyenne']=='0.00'){
					$this->Cell(12,5,'--',1,0,'C',true);
					$this->Cell(12,5,'-',1,0,'C');
					$this->Cell(9,5,'-',1,0,'C');
					$this->Cell(12,5,'-',1,0,'C');
					$this->Cell(30,5,'',1,0,'L');
				}else{
					$this->Cell(12,5,utf8_decode($_SESSION['eleve'][$i]['moyenne']),1,0,'C',true);
					if($_SESSION['eleve'][$i]['rang']==1){
						$rangEleve = $_SESSION['eleve'][$i]['rang'].'st';
					}elseif($_SESSION['eleve'][$i]['rang']==2){
						$rangEleve = $_SESSION['eleve'][$i]['rang'].'nd';
					}elseif($_SESSION['eleve'][$i]['rang']==3){
						$rangEleve = $_SESSION['eleve'][$i]['rang'].'rd';
					}else{$rangEleve = $_SESSION['eleve'][$i]['rang'].'th';}
					$this->Cell(12,5,utf8_decode($rangEleve),1,0,'C');
					$this->Cell(9,5,utf8_decode($_SESSION['eleve'][$i]['cote']),1,0,'C');
					$this->Cell(12,5,utf8_decode($_SESSION['eleve'][$i]['appreciation']),1,0,'C');
					$this->Cell(30,5,'',1,0,'L');
				}
				$this->SetFont('Times','',9);
				$this->Ln(5);
				$a++;
			}
			$this->Ln(10);
			$this->Cell(100);
			$texte = 'Done at '.$ville.', on the '.DATE('M d, Y').'.';
			$this->Cell(60,5, utf8_decode($texte),0,0,'R');
			$this->Ln(10);
			$this->Cell(100);
			$this->Cell(60,5,utf8_decode($signataire),0,0,'R');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function pvAnnuelMeriteEn($classe, $ville,$signataire){
			$this->SetFillColor(200,205,180);
			$titre = utf8_decode("Annual Report");
			$this->TitreSans($titre);
			$classe = "Class : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse = 'Roll: '.count($_SESSION['eleve']);
			$effectifEvalue = 'Evaluated : '.$_SESSION['eleve'][0]['classes'];
			$signataire = $_SESSION['signataire_anglais'];
			
			$this->SetFont('Times','B',12);
			$this->Text(10,60, utf8_decode($classe));
			$this->Text(100,60, utf8_decode($effectifClasse));
			$this->Text(170,60, utf8_decode($effectifEvalue));
			$this->Ln(10);
			/*Construction du tableau Informationnel statistique*/
			$this->SetFont('Times','B',10);
			$this->Cell(55,8,'',0,0,'C');
			$this->Cell(83,7,strtoupper(utf8_decode('statistics')),1,0,'C',true);
			$this->Ln(7);
			$this->Cell(55);
			
			// $this->Cell(55,8,'',0,0,'C');
			$this->Cell(32,7,utf8_decode('Object'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Female'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Male'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Global'),1,0,'C',true);
			$this->Ln(7);
			$this->Cell(55);
			$this->SetFont('Times','',10);
			
			$this->Cell(32,7,utf8_decode('Averages'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Sub - Averages'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('General Average'),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Percentage'),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
			$this->Ln(7);
			
			$this->Cell(55);
				
			$this->Cell(32,7,utf8_decode('First Average'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Last Average'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$this->Ln(10);
			
			
			// Informations du PV
			$this->SetFont('Times','B',8);
			$this->Cell(8,5,utf8_decode('N°'),1,0,'C',true);
			$this->Cell(20,5,utf8_decode('National Id.'),1,0,'C',true);
			$this->Cell(55,5,utf8_decode('Full Name'),1,0,'C',true);
			$this->Cell(8,5,utf8_decode('Sex'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('T1'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('T2'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('T3'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Ann.'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Rank'),1,0,'C',true);
			$this->Cell(9,5,utf8_decode('Grade'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Appr.'),1,0,'C',true);
			$this->Cell(30,5,utf8_decode('Class Council Dec.'),1,0,'C',true);
			$this->Ln(5);
			
			$a = 1;
			$this->SetFont('Times','',8);
			for($i=0;$i<count($_SESSION['eleve2']);$i++){
				$nomEleve = substr($_SESSION['eleve2'][$i]['nom_eleve'],0,27);
				$this->Cell(8,5,utf8_decode($a),1,0,'C');
				$this->Cell(20,5,substr(utf8_decode($_SESSION['eleve2'][$i]['rne']),0,27),1,0,'C');
				$this->Cell(55,5,utf8_decode($nomEleve),1,0,'L');
				$this->Cell(8,5,utf8_decode($_SESSION['eleve2'][$i]['sexe']),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve2'][$i]['moyenne_1'])),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve2'][$i]['moyenne_2'])),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve2'][$i]['moyenne_3'])),1,0,'C');
				
				$this->SetFont('Times','B',9);
				// La Gestion du Non Classé 
				if($_SESSION['eleve2'][$i]['moyenne']=='0.00'){
					$this->Cell(12,5,'--',1,0,'C',true);
					$this->Cell(12,5,'-',1,0,'C');
					$this->Cell(9,5,'-',1,0,'C');
					$this->Cell(12,5,'-',1,0,'C');
					$this->Cell(30,5,'',1,0,'L');
				}else{
					$this->Cell(12,5,utf8_decode($_SESSION['eleve2'][$i]['moyenne']),1,0,'C',true);
					if($_SESSION['eleve2'][$i]['rang']==1){
						$rangEleve = $_SESSION['eleve2'][$i]['rang'].'st';
					}elseif($_SESSION['eleve2'][$i]['rang']==2){
						$rangEleve = $_SESSION['eleve2'][$i]['rang'].'nd';
					}elseif($_SESSION['eleve2'][$i]['rang']==3){
						$rangEleve = $_SESSION['eleve2'][$i]['rang'].'rd';
					}else{$rangEleve = $_SESSION['eleve2'][$i]['rang'].'th';}
					$this->Cell(12,5,utf8_decode($rangEleve),1,0,'C');
					$this->Cell(9,5,utf8_decode($_SESSION['eleve2'][$i]['cote']),1,0,'C');
					$this->Cell(12,5,utf8_decode($_SESSION['eleve2'][$i]['appreciation']),1,0,'C');
					$this->Cell(30,5,'',1,0,'L');
				}
				$this->SetFont('Times','',9);
				$this->Ln(5);
				$a++;
			}
			$this->Ln(10);
			$this->Cell(100);
			$texte = 'Done at '.$ville.', on the'.DATE('M d, Y').'.';
			$this->Cell(60,5, utf8_decode($texte),0,0,'R');
			$this->Ln(10);
			$this->Cell(100);
			$this->Cell(60,5,utf8_decode($signataire),0,0,'R');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function pvAnnuelMeriteFr($classe, $ville,$signataire){
			$this->SetFillColor(200,205,180);
			$titre = utf8_decode("Proces verbal annuel ");
			$this->TitreSans($titre);
			$classe = "Classe : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse = 'Effectif: '.count($_SESSION['eleve']);
			$effectifEvalue = 'Eff. Eval. : '.$_SESSION['eleve'][0]['classes'];
			$signataire = $_SESSION['signataire'];
			
			$this->SetFont('Times','B',12);
			$this->Text(10,60, utf8_decode($classe));
			$this->Text(100,60, utf8_decode($effectifClasse));
			$this->Text(170,60, utf8_decode($effectifEvalue));
			$this->Ln(10);
			/*Construction du tableau Informationnel statistique*/
			$this->SetFont('Times','B',10);
			$this->Cell(55,8,'',0,0,'C');
			$this->Cell(83,7,strtoupper(utf8_decode('statistique des moyennes')),1,0,'C',true);
			$this->Ln(7);
			$this->Cell(55);
			
			// $this->Cell(55,8,'',0,0,'C');
			$this->Cell(32,7,utf8_decode('Libellé'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Feminin'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Masculin'),1,0,'C',true);
			$this->Cell(17,7,utf8_decode('Total'),1,0,'C',true);
			$this->Ln(7);
			$this->Cell(55);
			$this->SetFont('Times','',10);
			
			$this->Cell(32,7,utf8_decode('Moyennes'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Sous - Moyennes'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Moyenne Générale'),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Taux de Réussite'),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5)),1,0,'C');
			$this->Cell(17,7,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)),1,0,'C');
			$this->Ln(7);
			
			$this->Cell(55);
				
			$this->Cell(32,7,utf8_decode('Forte Moyenne'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$this->Ln(7);
			$this->Cell(55);
			$this->Cell(32,7,utf8_decode('Faible Moyenne'),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$this->Cell(17,7,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$this->Ln(10);
			
			
			// Informations du PV
			$this->SetFont('Times','B',8);
			$this->Cell(8,5,utf8_decode('N°'),1,0,'C',true);
			$this->Cell(20,5,utf8_decode('Matricule Nat.'),1,0,'C',true);
			$this->Cell(55,5,utf8_decode('Nom Complet'),1,0,'C',true);
			$this->Cell(8,5,utf8_decode('Sexe'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('Tr1'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('Tr2'),1,0,'C',true);
			$this->Cell(10,5,utf8_decode('Tr3'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Ann.'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Rang'),1,0,'C',true);
			$this->Cell(9,5,utf8_decode('Côte'),1,0,'C',true);
			$this->Cell(12,5,utf8_decode('Appr.'),1,0,'C',true);
			$this->Cell(30,5,utf8_decode('Décision du Conseil'),1,0,'C',true);
			$this->Ln(5);
			
			$a = 1;
			$this->SetFont('Times','',8);
			for($i=0;$i<count($_SESSION['eleve2']);$i++){
				$nomEleve = substr($_SESSION['eleve2'][$i]['nom_eleve'],0,27);
				$this->Cell(8,5,utf8_decode($a),1,0,'C');
				$this->Cell(20,5,substr(utf8_decode($_SESSION['eleve2'][$i]['rne']),0,27),1,0,'C');
				$this->Cell(55,5,utf8_decode($nomEleve),1,0,'L');
				$this->Cell(8,5,utf8_decode($_SESSION['eleve2'][$i]['sexe']),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve2'][$i]['moyenne_1'])),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve2'][$i]['moyenne_2'])),1,0,'C');
				$this->Cell(10,5,utf8_decode(str_replace('0.00','',$_SESSION['eleve2'][$i]['moyenne_3'])),1,0,'C');
				
				$this->SetFont('Times','B',9);
				// La Gestion du Non Classé 
				if($_SESSION['eleve2'][$i]['moyenne']=='0.00'){
					$this->Cell(12,5,'--',1,0,'C',true);
					$this->Cell(12,5,'-',1,0,'C');
					$this->Cell(9,5,'-',1,0,'C');
					$this->Cell(12,5,'-',1,0,'C');
					$this->Cell(30,5,'',1,0,'L');
				}else{
					$this->Cell(12,5,utf8_decode($_SESSION['eleve2'][$i]['moyenne']),1,0,'C',true);
					if($_SESSION['eleve2'][$i]['rang']==1){
						$rangEleve = $_SESSION['eleve2'][$i]['rang'].'er';
					}else{$rangEleve = $_SESSION['eleve2'][$i]['rang'].'ème';}
					$this->Cell(12,5,utf8_decode($rangEleve),1,0,'C');
					$this->Cell(9,5,utf8_decode($_SESSION['eleve2'][$i]['cote']),1,0,'C');
					$this->Cell(12,5,utf8_decode($_SESSION['eleve2'][$i]['appreciation']),1,0,'C');
					$this->Cell(30,5,'',1,0,'L');
				}
				$this->SetFont('Times','',9);
				$this->Ln(5);
				$a++;
			}
			$this->Ln(10);
			$this->Cell(100);
			$texte = 'Fait à '.$ville.', le '.DATE('d M Y').'.';
			$this->Cell(60,5, utf8_decode($texte),0,0,'R');
			$this->Ln(10);
			$this->Cell(100);
			$this->Cell(60,5,utf8_decode($signataire),0,0,'R');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function bulletinAnnuelFr($classe,$eleve, $ville, $signataire,
										$ministere, $ministereAnglais, $pays, $paysAnglais,
								$ets, $etsAnglais, $devise, $deviseAnglais, $contact, $as,
								$region, $regionAnglais, $departement, $departementAnglais){
			for($a=0;$a<count($eleve);$a++){
				$this->addPage();
				// On met l'entête du document
				$this->EnteteDocTest($ministere, $ministereAnglais, $pays, $paysAnglais,
						$ets, $etsAnglais, $devise, $deviseAnglais, $contact, $as,
						$region, $regionAnglais, $departement, $departementAnglais);
				// On met le titre du document
				$titre = "Bulletin de Notes Annuel ";
				$this->SetFont('Times','BUI',14);
				// $this->SetFont('Times','BU',14);
				// Informations sur l'élève 
				$this->Text(60,50,strtoupper(utf8_decode($titre)));
				$this->SetFont('Times','',10);
				$lib_nom = 'Nom : ';
				$lib_classe = 'Classe : ';
				$lib_matricule = 'Matricule : ';
				$lib_effectif = 'Effectif : ';
				$lib_dateNaissance = 'Date et Lieu de Naissance : ';
				$lib_lieuNaissance = 'A : ';
				$lib_sexe = 'Genre : ';
				$lib_redoublant = 'Redoublant : ';
				$lib_titulaire = 'Titulaire de la Classe : ';
				$lib_parent = 'Contact du Parent/Tuteur : ';
				
				$this->Text(40,55,utf8_decode($lib_nom));
				$this->Text(135,55,utf8_decode($lib_classe));
				$this->Text(40,60,utf8_decode($lib_dateNaissance));
				$this->Text(105,60,utf8_decode($lib_lieuNaissance));
				$this->Text(40,65,utf8_decode($lib_matricule));
				$this->Text(182,60,utf8_decode($lib_effectif));
				$this->Text(157,60,utf8_decode($lib_sexe));
				$this->Text(80,65,utf8_decode($lib_redoublant));
				$this->Text(120,65,utf8_decode($lib_titulaire));
				$this->Text(40,70,utf8_decode($lib_parent));
				
				$this->SetFont('Times','B',10);
				$nom = $eleve[$a]['nom_eleve'];
				$nomClasse = strtoupper(utf8_decode($_SESSION['nom_classe']));
				$matricule = $eleve[$a]['rne'];
				$effectif = count($eleve);
				$dateNaissance = $eleve[$a]['date_naissance'];
				$lieuNaissance = $eleve[$a]['lieu_naissance'];
				$sexe = $eleve[$a]['sexe'];
				$redoublant = $eleve[$a]['statut'];
				$titulaire = $_SESSION['professeurPrincipal'];
				$image =$eleve[$a]['photo'];
				$parent = $eleve[$a]['adresse_parent'];
				// Cas des élèves sans photo
				if($image==''){
					$photo = 'images/eleve/no_name.jpg';
				}else{
					$photo = $image;
				}
				// Cas des élèves sans contact de parents
				if($parent=='' or $parent=='0'){
					$parent = 'No contact Given';
				}else{
					$parent = $parent;
				}
				$this->Text(50,55,utf8_decode(substr($nom,0,40)));
				$this->Text(150,55,substr($nomClasse,0,20));
				$this->Text(80,60,utf8_decode($dateNaissance));
				$this->Text(195,60,utf8_decode($effectif));
				$this->Text(60,65,utf8_decode($matricule));
				$this->Text(110,60,utf8_decode(substr($lieuNaissance,0,20)));
				$this->Text(169,60,utf8_decode($sexe));
				$this->Text(100,65,utf8_decode($redoublant));
				$this->Text(152,65,utf8_decode(substr($titulaire,0,27)));
				$this->Text(80,70,utf8_decode($parent));
				 
				// $this->Image($image, 30, 40, 10);
				$this->Image($photo, 15, 50, 22, 22);
				
				// Titre du Tableau du bulletin
				$this->Ln(45);
				$this->SetFont('Times','B',8);
				$this->Cell(8);
				$this->Cell(45,6, utf8_decode('Matière'),1,0,'C',true);
				$this->Cell(10,6, utf8_decode('Trim 1'),1,0,'C',true);
				$this->Cell(10,6, utf8_decode('Trim 2'),1,0,'C',true);
				$this->Cell(10,6, utf8_decode('Trim 3'),1,0,'C',true);
				$this->Cell(11,6, utf8_decode('Ann'),1,0,'C',true);
				$this->Cell(10,6, utf8_decode('Coef'),1,0,'C',true);
				$this->Cell(13,6, utf8_decode('M x Coef'),1,0,'C',true);
				$this->Cell(12,6, utf8_decode('Côte'),1,0,'C',true);
				$this->Cell(12,6, utf8_decode('Appr.'),1,0,'C',true);
				$this->Cell(16,6, utf8_decode('Min-Max'),1,0,'C',true);					
				$this->Cell(20,6, utf8_decode('Visa Ens.'),1,0,'C',true);
				$this->SetFont('Times','',8);
				$this->Ln(6);
				
				// On ressort une boucle qui liste les groupes définis
				for($b=0;$b<count($_SESSION['groupe']);$b++){
					$codeGroupe = $_SESSION['groupe'];
					$totalGroupe = $codeGroupe[$b].'_total';
					$coefGroupe = $codeGroupe[$b].'_Coef';
					$minGroupe = $codeGroupe[$b].'_min';
					$maxGroupe = $codeGroupe[$b].'_max';
					$apprGroupe = $codeGroupe[$b].'_Appr';
					$coteGroupe = $codeGroupe[$b].'_cote';
					$moyenneGroupe = $codeGroupe[$b].'_moyenne';
					$groupeTr1 = $codeGroupe[$b].'_tr1';
					$groupeTr2 = $codeGroupe[$b].'_tr2';
					$groupeTr3 = $codeGroupe[$b].'_tr3';
					// Pour chaque groupe, on ressort le code et le nom de la matière
					$test = $codeGroupe[$b];
					$nomMatiere = $_SESSION['nom_matiere'][$test];
					$codeMatiere = $_SESSION['code_matiere'][$test];
					for($c=0;$c<count($codeMatiere);$c++){
						$t1 = $codeMatiere[$c].'_trim1';
						$t2 = $codeMatiere[$c].'_trim2';
						$t3 = $codeMatiere[$c].'_trim3';
						$ann = $codeMatiere[$c].'_ann';
						$coef = $codeMatiere[$c].'_coef';
						$trimTotal = $codeMatiere[$c].'_total';
						$trimAppr = $codeMatiere[$c].'_appr';
						$trimMin = $codeMatiere[$c].'_min';
						$trimMax = $codeMatiere[$c].'_max';
						$trimCote = $codeMatiere[$c].'_cote';
						$enseignant = $codeMatiere[$c].'_enseignant';
						$this->Cell(8);
						// On élimine l'apparition du Zéro sur le bulletin 
						if($eleve[$a][$t1]=='0.00'){$note1 = '';}else{$note1 = $eleve[$a][$t1];}
						if($eleve[$a][$t2]=='0.00'){$note2 = '';}else{$note2 = $eleve[$a][$t2];}
						if($eleve[$a][$t3]=='0.00'){$note3 = '';}else{$note3 = $eleve[$a][$t3];}
						if($eleve[$a][$ann]=='0.00'){
							$noteAnn = '';
							$coefficient = '';
							$produit = '';
						}else{
							$noteAnn = $eleve[$a][$ann];
							$coefficient = $eleve[$a][$coef];
							$produit = $eleve[$a][$trimTotal];
						}
						$matiereEnseignant = strtoupper($nomMatiere[$c]).' / ';
						$matiereEnseignant .= $eleve[$a][$enseignant];
						$libelleMatiere = substr($nomMatiere[$c],0,30);
						$this->Cell(45,3, utf8_decode(strtoupper($libelleMatiere)),'LTR',0,'L');
						$this->Cell(10,6, utf8_decode($note1),1,0,'C');
						$this->Cell(10,6, utf8_decode($note2),1,0,'C');
						$this->Cell(10,6, utf8_decode($note3),1,0,'C');
						$this->Cell(11,6, utf8_decode($noteAnn),1,0,'C',true);
						$this->Cell(10,6, utf8_decode($coefficient),1,0,'C');
						$this->SetFont('Times','B',7);
						$this->Cell(13,6, utf8_decode($produit),1,0,'C',true);
						$this->SetFont('Times','',7);
						$this->Cell(12,6, utf8_decode($eleve[$a][$trimCote]),1,0,'C');
						$this->Cell(12,6, utf8_decode($eleve[$a][$trimAppr]),1,0,'C');
						$minMax = "[".$eleve[$a][$trimMin]." - ".$eleve[$a][$trimMax]."]";
						$this->Cell(16,6, utf8_decode($minMax),1,0,'C');
						$this->Cell(20,6, utf8_decode(''),1,0,'C');
						
						// On Insère ici le nom de l'enseignant de la matière
						$this->Ln(3);
						$this->SetFont('Times','I',7);
						$prof = substr($eleve[$a][$enseignant],0,29);
						$this->Cell(55,3, utf8_decode($prof),0,0,'C');
						$this->SetFont('Times','',7);							
						$this->Ln(3);						
					}
					
					$this->Cell(8);
					$this->SetFont('Times','B',8);
					$this->Cell(45,6, utf8_decode(strtoupper('Total du Groupe '.$codeGroupe[$b])),1,0,'C',true);
					$this->Cell(10,6, $eleve[$a][$groupeTr1],1,0,'C');
					$this->Cell(10,6, $eleve[$a][$groupeTr2],1,0,'C');
					$this->Cell(10,6, $eleve[$a][$groupeTr3],1,0,'C');
					$this->Cell(11,6, utf8_decode($eleve[$a][$moyenneGroupe]),1,0,'C',true);
					$this->Cell(10,6, utf8_decode($eleve[$a][$coefGroupe]),1,0,'C',true);
					$this->Cell(13,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C',true);
					$this->Cell(12,6, utf8_decode($eleve[$a][$coteGroupe]),1,0,'C',true);
					$this->Cell(12,6, utf8_decode($eleve[$a][$apprGroupe]),1,0,'C',true);
					$this->Cell(16,6, '',1,0,'C',true);
					$this->Cell(20,6, '',1,0,'C',true);
					$this->Ln(6);
					$this->SetFont('Times','',7);
				}
				
				$this->SetFont('Times','BI',7);
				$this->Ln(1);
				$this->Cell(8);
				$information = utf8_decode('Bulletin Annuel de l\'élève ').$eleve[$a]['nom_eleve'];
				$information .= utf8_decode('Né(e) le ').$eleve[$a]['date_naissance'].' de la classe de';
				$information .= ' '.$nomClasse;
				$this->Cell(175,3, $information,0,0,'C');
				$this->Ln(3);
				$this->Cell(8);
				$this->SetFont('Times','B',10);
				$this->Cell(45,6, utf8_decode('TOTAL'),1,0,'C',true);
				
				if($eleve[$a]['moyenne_1']=='0.00'){ $moyenne_1 = '--';}
					else{$moyenne_1 = $eleve[$a]['moyenne_1'];}
				if($eleve[$a]['moyenne_2']=='0.00'){ $moyenne_2 = '--';}
					else{$moyenne_2 = $eleve[$a]['moyenne_2'];}
				if($eleve[$a]['moyenne_3']=='0.00'){ $moyenne_3 = '--';}
					else{$moyenne_3 = $eleve[$a]['moyenne_3'];}
				
				$this->Cell(10,6, utf8_decode($moyenne_1),1,0,'C',true);
				$this->Cell(10,6, utf8_decode($moyenne_2),1,0,'C',true);
				$this->Cell(10,6, utf8_decode($moyenne_3),1,0,'C',true);
				$this->Cell(11,6, '',1,0,'C',true);
				$this->Cell(10,6, $eleve[$a]['total_coef'],1,0,'C',true);
				// $this->Cell(10,6, utf8_decode($eleve[$a]['total_coef']),1,0,'C',true);
				// $this->Cell(12,6, utf8_decode($eleve[$a]['total_point']),1,0,'C',true);
				$this->Cell(13,6, $eleve[$a]['total_point'],1,0,'C',true);
				
				if($eleve[$a]['moyenne']=='0.00'){
					$valeurMoyenne = 'MOYENNE : --';
					$moyEleve = '--';
					$rangEleve = 'Non Classé';
				}else{
					$valeurMoyenne = 'MOYENNE : '.$eleve[$a]['moyenne'];
					$moyEleve = $eleve[$a]['moyenne'];
					$rank = $eleve[$a]['rang'];
					if($rank==1){
						$rangEleve = $rank.'er / '.$eleve[$a]['classes'];
					}else{
						$rangEleve = $rank.'ème / '.$eleve[$a]['classes'];
					}
				}
				$this->Cell(60,6, utf8_decode($valeurMoyenne),1,0,'C',true);					
				$this->Ln(6);
				$this->Cell(8);
				
				$this->SetFont('Times','B',9);
				$this->Cell(53,6,utf8_decode('Discipline'), 1,0,'C',true);
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(53,6,utf8_decode('Travail de l\'élève '), 1,0,'C',true);
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(53,6,utf8_decode('Profil de la classe'), 1,0,'C',true);
				$this->Ln(6);
				$this->Cell(8);
				
				$this->Cell(20,6,utf8_decode('Abs Non Just.'), 1,0,'C');
				$this->Cell(6,6,$eleve[$a]['absence_non_just'], 1,0,'C');
				$this->Cell(20,6,utf8_decode('Avert. Cond.'), 1,0,'C');
				$this->Cell(7,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(17,6,utf8_decode('Total Gén.'), 1,0,'C');
				$this->Cell(10,6,utf8_decode($eleve[$a]['total_point']), 1,0,'C');
				$this->Cell(26,6,utf8_decode('Déc.Cons. Classe'), 1,0,'C',true);
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(30,6,utf8_decode('Moyenne Générale'), 1,0,'C');
				
				$this->Cell(23,6,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)), 1,0,'C');
				$this->Ln(6);
				$this->Cell(8);
				
				$this->Cell(20,6,utf8_decode('Abs Just.'), 1,0,'C');
				$this->Cell(6,6,utf8_decode(''), 1,0,'C');
				$this->Cell(20,6,utf8_decode('Blame. Cond.'), 1,0,'C');
				$this->Cell(7,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(17,6,utf8_decode('Coef'), 1,0,'C');
				// $this->Cell(10,6,utf8_decode($eleve[$a]['total_coef']), 1,0,'C');
				$this->Cell(10,6,$eleve[$a]['total_coef'], 1,0,'C');
				$this->Cell(16,6,'Promu(e)', 1,0,'C');
				$this->Cell(10, 6, '',1,0,'C'); // Décision cochée au Bic
				$this->Cell(5, 6, '',0,0,'C'); // Espace vide 
				$minMax = "[ ".$_SESSION['statistique']['noteFaibleTotal'];
				$minMax .= " - ".$_SESSION['statistique']['noteForteTotal'];
				$minMax .= " ]";
				$this->Cell(30,6,utf8_decode('[Min - Max]'), 1,0,'C');
				$this->Cell(23,6,$minMax, 1,0,'C');
				$this->Ln(6);
				$this->Cell(8);
				
				$this->Cell(20,6,utf8_decode('Retards'), 1,0,'C');
				$this->Cell(6,6,utf8_decode(''), 1,0,'C');
				$this->Cell(20,6,utf8_decode('Exclusions'), 1,0,'C');
				$this->Cell(7,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace vide 
				$this->Cell(17,6,utf8_decode('Moyenne'), 1,0,'C');
				$this->Cell(10,6,utf8_decode($moyEleve), 1,0,'C');
				$this->Cell(16,6,utf8_decode('Redouble'), 1,0,'C');
				$this->Cell(10,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide
				// $this->Cell(26,6,'', 1,0,'C');
				
				$this->Cell(30,6,utf8_decode('Nb Moyennes'), 1,0,'C');
				$this->Cell(23,6,$_SESSION['statistique']['moyTotal'], 1,0,'C');
				$this->Ln(6);
				$this->Cell(8);
				
				$this->Cell(20,6,utf8_decode('Consignes'), 1,0,'C');
				$this->Cell(6,6,utf8_decode(''), 1,0,'C');
				$this->Cell(20,6,utf8_decode('Excl. Déf.'), 1,0,'C');
				$this->Cell(7,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide 
				$this->Cell(17,6,utf8_decode('Côte'), 1,0,'C');
				$this->Cell(10,6,utf8_decode($eleve[$a]['cote']), 1,0,'C');
				
				$this->Cell(16,6,utf8_decode('Exclu pour'), 1,0,'C');
				$this->Cell(10,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide 
				$this->Cell(30,6,utf8_decode('Pourcentage'), 1,0,'C');
				
				$this->Cell(23,6,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)), 1,0,'C');
				$this->Ln(6);
				$this->Cell(8);
				
				$this->Cell(20,6,utf8_decode(''), 0,0,'C');
				$this->Cell(6,6,utf8_decode(''), 0,0,'C');
				$this->Cell(20,6,utf8_decode(''), 0,0,'C');
				$this->Cell(7,6,utf8_decode(''), 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(27,6,utf8_decode('Rang : '), 1,0,'C');
				$this->Cell(26,6,utf8_decode($rangEleve), 1,0,'C');
				$this->Cell(26,6,'', 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(30,6,utf8_decode(''), 0,0,'C');
				$this->Cell(23,6,'', 0,0,'C');
				$this->Ln(6);
				$this->Cell(4);
				
				$this->SetFont('Times','B',9);
				$this->Cell(57,6,utf8_decode('Appréciation du Travail de l\'élève'), 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide
				$this->Cell(27,6,utf8_decode('Visa du Parent'), 0,0,'C');
				$this->Cell(26,6,utf8_decode('Visa du Prof. Ppal'), 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide
				
				$texte = 'Fait à  '.$ville.' le  ________________';
				$this->Cell(53,6,utf8_decode($texte), 0,0,'C');
				$this->Ln(6);
				$this->Cell(4);
				
				$this->SetFont('Times','B',9);
				$this->Cell(57,6,'', 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide
				$this->Cell(27,6,'', 0,0,'C');
				$this->Cell(26,6,'', 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide
				
				$this->Cell(53,6,utf8_decode($signataire), 0,0,'C');
				
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function bulletinAnnuelEn($classe,$eleve, $ville, $signataire,
										$ministere, $ministereAnglais, $pays, $paysAnglais,
								$ets, $etsAnglais, $devise, $deviseAnglais, $contact, $as,
								$region, $regionAnglais, $departement, $departementAnglais){
			for($a=0;$a<count($eleve);$a++){
				$this->addPage();
				// On met l'entête du document
				$this->EnteteDocTest($ministere, $ministereAnglais, $pays, $paysAnglais,
						$ets, $etsAnglais, $devise, $deviseAnglais, $contact, $as,
						$region, $regionAnglais, $departement, $departementAnglais);
				// On met le titre du document
				$titre = "Annual Report Mark ";
				$this->SetFont('Times','BUI',14);
				// $this->SetFont('Times','BU',14);
				// Informations sur l'élève 
				$this->Text(60,50,strtoupper(utf8_decode($titre)));
				$this->SetFont('Times','',10);
				$lib_nom = 'Name : ';
				$lib_classe = 'Class : ';
				$lib_matricule = 'National Id : ';
				$lib_effectif = 'Roll : ';
				$lib_dateNaissance = 'Date and place of birth : ';
				$lib_lieuNaissance = 'At : ';
				$lib_sexe = 'Gender : ';
				$lib_redoublant = 'Repeater : ';
				$lib_titulaire = 'Class Master : ';
				$lib_parent = 'Parents Contact : ';
				
				$this->Text(40,55,utf8_decode($lib_nom));
				$this->Text(135,55,utf8_decode($lib_classe));
				$this->Text(40,60,utf8_decode($lib_dateNaissance));
				$this->Text(105,60,utf8_decode($lib_lieuNaissance));
				$this->Text(40,65,utf8_decode($lib_matricule));
				$this->Text(182,60,utf8_decode($lib_effectif));
				$this->Text(157,60,utf8_decode($lib_sexe));
				$this->Text(80,65,utf8_decode($lib_redoublant));
				$this->Text(120,65,utf8_decode($lib_titulaire));
				$this->Text(40,70,utf8_decode($lib_parent));
				
				$this->SetFont('Times','B',10);
				$nom = $eleve[$a]['nom_eleve'];
				$nomClasse = strtoupper(utf8_decode($_SESSION['nom_classe']));
				$matricule = $eleve[$a]['rne'];
				$effectif = count($eleve);
				$dateNaissance = $eleve[$a]['date_naissance'];
				$lieuNaissance = $eleve[$a]['lieu_naissance'];
				$sexe = $eleve[$a]['sexe'];
				$redoublant = $eleve[$a]['statut'];
				$titulaire = $_SESSION['professeurPrincipal'];
				$image =$eleve[$a]['photo'];
				$parent = $eleve[$a]['adresse_parent'];
				// Cas des élèves sans photo
				if($image==''){
					$photo = 'images/eleve/no_name.jpg';
				}else{
					$photo = $image;
				}
				// Cas des élèves sans contact de parents
				if($parent=='' or $parent=='0'){
					$parent = 'No contact Given';
				}else{
					$parent = $parent;
				}
				$this->Text(50,55,utf8_decode(substr($nom,0,40)));
				$this->Text(150,55,substr($nomClasse,0,20));
				$this->Text(80,60,utf8_decode($dateNaissance));
				$this->Text(195,60,utf8_decode($effectif));
				$this->Text(60,65,utf8_decode($matricule));
				$this->Text(110,60,utf8_decode(substr($lieuNaissance,0,20)));
				$this->Text(169,60,utf8_decode($sexe));
				$this->Text(100,65,utf8_decode($redoublant));
				$this->Text(152,65,utf8_decode(substr($titulaire,0,27)));
				$this->Text(80,70,utf8_decode($parent));
				 
				// $this->Image($image, 30, 40, 10);
				$this->Image($photo, 15, 50, 22, 22);
				
				// Titre du Tableau du bulletin
				$this->Ln(45);
				$this->SetFont('Times','B',8);
				$this->Cell(8);
				$this->Cell(45,6, utf8_decode('Subject'),1,0,'C',true);
				$this->Cell(10,6, utf8_decode('Term 1'),1,0,'C',true);
				$this->Cell(10,6, utf8_decode('Term 2'),1,0,'C',true);
				$this->Cell(10,6, utf8_decode('Term 3'),1,0,'C',true);
				$this->Cell(11,6, utf8_decode('Ann'),1,0,'C',true);
				$this->Cell(10,6, utf8_decode('Coef'),1,0,'C',true);
				$this->Cell(13,6, utf8_decode('Product'),1,0,'C',true);
				$this->Cell(12,6, utf8_decode('Grade'),1,0,'C',true);
				$this->Cell(12,6, utf8_decode('Appr.'),1,0,'C',true);
				$this->Cell(16,6, utf8_decode('Min-Max'),1,0,'C',true);					
				$this->Cell(20,6, utf8_decode('Visa Ens.'),1,0,'C',true);
				$this->SetFont('Times','',8);
				$this->Ln(6);
				
				// On ressort une boucle qui liste les groupes définis
				for($b=0;$b<count($_SESSION['groupe']);$b++){
					$codeGroupe = $_SESSION['groupe'];
					$totalGroupe = $codeGroupe[$b].'_total';
					$coefGroupe = $codeGroupe[$b].'_Coef';
					$minGroupe = $codeGroupe[$b].'_min';
					$maxGroupe = $codeGroupe[$b].'_max';
					$apprGroupe = $codeGroupe[$b].'_Appr';
					$coteGroupe = $codeGroupe[$b].'_cote';
					$moyenneGroupe = $codeGroupe[$b].'_moyenne';
					$groupeTr1 = $codeGroupe[$b].'_tr1';
					$groupeTr2 = $codeGroupe[$b].'_tr2';
					$groupeTr3 = $codeGroupe[$b].'_tr3';
					// Pour chaque groupe, on ressort le code et le nom de la matière
					$test = $codeGroupe[$b];
					$nomMatiere = $_SESSION['nom_matiere'][$test];
					$codeMatiere = $_SESSION['code_matiere'][$test];
					for($c=0;$c<count($codeMatiere);$c++){
						$t1 = $codeMatiere[$c].'_trim1';
						$t2 = $codeMatiere[$c].'_trim2';
						$t3 = $codeMatiere[$c].'_trim3';
						$ann = $codeMatiere[$c].'_ann';
						$coef = $codeMatiere[$c].'_coef';
						$trimTotal = $codeMatiere[$c].'_total';
						$trimAppr = $codeMatiere[$c].'_appr';
						$trimMin = $codeMatiere[$c].'_min';
						$trimMax = $codeMatiere[$c].'_max';
						$trimCote = $codeMatiere[$c].'_cote';
						$enseignant = $codeMatiere[$c].'_enseignant';
						$this->Cell(8);
						// On élimine l'apparition du Zéro sur le bulletin 
						if($eleve[$a][$t1]=='0.00'){$note1 = '';}else{$note1 = $eleve[$a][$t1];}
						if($eleve[$a][$t2]=='0.00'){$note2 = '';}else{$note2 = $eleve[$a][$t2];}
						if($eleve[$a][$t3]=='0.00'){$note3 = '';}else{$note3 = $eleve[$a][$t3];}
						if($eleve[$a][$ann]=='0.00'){
							$noteAnn = '';
							$coefficient = '';
							$produit = '';
						}else{
							$noteAnn = $eleve[$a][$ann];
							$coefficient = $eleve[$a][$coef];
							$produit = $eleve[$a][$trimTotal];
						}
						$matiereEnseignant = strtoupper($nomMatiere[$c]).' / ';
						$matiereEnseignant .= $eleve[$a][$enseignant];
						$libelleMatiere = substr($nomMatiere[$c],0,30);
						$this->Cell(45,3, utf8_decode(strtoupper($libelleMatiere)),'LTR',0,'L');
						$this->Cell(10,6, utf8_decode($note1),1,0,'C');
						$this->Cell(10,6, utf8_decode($note2),1,0,'C');
						$this->Cell(10,6, utf8_decode($note3),1,0,'C');
						$this->Cell(11,6, utf8_decode($noteAnn),1,0,'C',true);
						$this->Cell(10,6, utf8_decode($coefficient),1,0,'C');
						$this->SetFont('Times','B',7);
						$this->Cell(13,6, utf8_decode($produit),1,0,'C',true);
						$this->SetFont('Times','',7);
						$this->Cell(12,6, utf8_decode($eleve[$a][$trimCote]),1,0,'C');
						$this->Cell(12,6, utf8_decode($eleve[$a][$trimAppr]),1,0,'C');
						$minMax = "[".$eleve[$a][$trimMin]." - ".$eleve[$a][$trimMax]."]";
						$this->Cell(16,6, utf8_decode($minMax),1,0,'C');
						$this->Cell(20,6, utf8_decode(''),1,0,'C');
						
						// On Insère ici le nom de l'enseignant de la matière
						$this->Ln(3);
						$this->SetFont('Times','I',7);
						$prof = substr($eleve[$a][$enseignant],0,29);
						$this->Cell(55,3, utf8_decode($prof),0,0,'C');
						$this->SetFont('Times','',7);							
						$this->Ln(3);						
					}
					
					$this->Cell(8);
					$this->SetFont('Times','B',8);
					$this->Cell(45,6, utf8_decode(strtoupper('Total of Group '.$codeGroupe[$b])),1,0,'C',true);
					$this->Cell(10,6, $eleve[$a][$groupeTr1],1,0,'C');
					$this->Cell(10,6, $eleve[$a][$groupeTr2],1,0,'C');
					$this->Cell(10,6, $eleve[$a][$groupeTr3],1,0,'C');
					$this->Cell(11,6, utf8_decode($eleve[$a][$moyenneGroupe]),1,0,'C',true);
					$this->Cell(10,6, utf8_decode($eleve[$a][$coefGroupe]),1,0,'C',true);
					$this->Cell(13,6, utf8_decode($eleve[$a][$totalGroupe]),1,0,'C',true);
					$this->Cell(12,6, utf8_decode($eleve[$a][$coteGroupe]),1,0,'C',true);
					$this->Cell(12,6, utf8_decode($eleve[$a][$apprGroupe]),1,0,'C',true);
					$this->Cell(16,6, '',1,0,'C',true);
					$this->Cell(20,6, '',1,0,'C',true);
					$this->Ln(6);
					$this->SetFont('Times','',7);
				}
				
				$this->SetFont('Times','BI',7);
				$this->Ln(1);
				$this->Cell(8);
				$information = utf8_decode('Annual Report Mark of ').$eleve[$a]['nom_eleve'];
				$information .= utf8_decode('Born on the ').$eleve[$a]['date_naissance'].' from ';
				$information .= ' '.$nomClasse;
				$this->Cell(175,3, $information,0,0,'C');
				$this->Ln(3);
				$this->Cell(8);
				$this->SetFont('Times','B',10);
				$this->Cell(45,6, utf8_decode('GLOBAL'),1,0,'C',true);
				
				if($eleve[$a]['moyenne_1']=='0.00'){ $moyenne_1 = '--';}
					else{$moyenne_1 = $eleve[$a]['moyenne_1'];}
				if($eleve[$a]['moyenne_2']=='0.00'){ $moyenne_2 = '--';}
					else{$moyenne_2 = $eleve[$a]['moyenne_2'];}
				if($eleve[$a]['moyenne_3']=='0.00'){ $moyenne_3 = '--';}
					else{$moyenne_3 = $eleve[$a]['moyenne_3'];}
				
				$this->Cell(10,6, utf8_decode($moyenne_1),1,0,'C',true);
				$this->Cell(10,6, utf8_decode($moyenne_2),1,0,'C',true);
				$this->Cell(10,6, utf8_decode($moyenne_3),1,0,'C',true);
				$this->Cell(11,6, '',1,0,'C',true);
				$this->Cell(10,6, $eleve[$a]['total_coef'],1,0,'C',true);
				// $this->Cell(10,6, utf8_decode($eleve[$a]['total_coef']),1,0,'C',true);
				// $this->Cell(12,6, utf8_decode($eleve[$a]['total_point']),1,0,'C',true);
				$this->Cell(13,6, $eleve[$a]['total_point'],1,0,'C',true);
				
				if($eleve[$a]['moyenne']=='0.00'){
					$valeurMoyenne = 'AVERAGE : --';
					$moyEleve = '--';
					$rangEleve = 'Not Evaluated';
				}else{
					$valeurMoyenne = 'AVERAGE : '.$eleve[$a]['moyenne'];
					$moyEleve = $eleve[$a]['moyenne'];
					$rank = $eleve[$a]['rang'];
					if($rank==1){
						$rangEleve = $rank.'st / '.$eleve[$a]['classes'];
					}elseif($rank==2){
						$rangEleve = $rank.'nd / '.$eleve[$a]['classes'];
					}elseif($rank==3){
						$rangEleve = $rank.'rd / '.$eleve[$a]['classes'];
					}else{
						$rangEleve = $rank.'th / '.$eleve[$a]['classes'];
					}
				}
				$this->Cell(60,6, utf8_decode($valeurMoyenne),1,0,'C',true);					
				$this->Ln(6);
				$this->Cell(8);
				
				$this->SetFont('Times','B',9);
				$this->Cell(53,6,utf8_decode('DISCIPLINE'), 1,0,'C',true);
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(53,6,utf8_decode('STUDENT WORK'), 1,0,'C',true);
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(53,6,utf8_decode('CLASS PROFILE'), 1,0,'C',true);
				$this->Ln(6);
				$this->Cell(8);
				
				$this->Cell(20,6,utf8_decode('Abs Non Just.'), 1,0,'C');
				$this->Cell(6,6,$eleve[$a]['absence_non_just'], 1,0,'C');
				$this->Cell(20,6,utf8_decode('Avert. Cond.'), 1,0,'C');
				$this->Cell(7,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(17,6,utf8_decode('Total Pts'), 1,0,'C');
				$this->Cell(10,6,utf8_decode($eleve[$a]['total_point']), 1,0,'C');
				$this->Cell(26,6,utf8_decode('Cl counc. Dec.'), 1,0,'C',true);
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(30,6,utf8_decode('General Average'), 1,0,'C');
				
				$this->Cell(23,6,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)), 1,0,'C');
				$this->Ln(6);
				$this->Cell(8);
				
				$this->Cell(20,6,utf8_decode('Abs Just.'), 1,0,'C');
				$this->Cell(6,6,utf8_decode(''), 1,0,'C');
				$this->Cell(20,6,utf8_decode('Blame. Cond.'), 1,0,'C');
				$this->Cell(7,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(17,6,utf8_decode('Coef'), 1,0,'C');
				// $this->Cell(10,6,utf8_decode($eleve[$a]['total_coef']), 1,0,'C');
				$this->Cell(10,6,$eleve[$a]['total_coef'], 1,0,'C');
				$this->Cell(16,6,'Promu(e)', 1,0,'C');
				$this->Cell(10, 6, '',1,0,'C'); // Décision cochée au Bic
				$this->Cell(5, 6, '',0,0,'C'); // Espace vide 
				$minMax = "[ ".$_SESSION['statistique']['noteFaibleTotal'];
				$minMax .= " - ".$_SESSION['statistique']['noteForteTotal'];
				$minMax .= " ]";
				$this->Cell(30,6,utf8_decode('[Min - Max]'), 1,0,'C');
				$this->Cell(23,6,$minMax, 1,0,'C');
				$this->Ln(6);
				$this->Cell(8);
				
				$this->Cell(20,6,utf8_decode('Retards'), 1,0,'C');
				$this->Cell(6,6,utf8_decode(''), 1,0,'C');
				$this->Cell(20,6,utf8_decode('Exclusions'), 1,0,'C');
				$this->Cell(7,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace vide 
				$this->Cell(17,6,utf8_decode('Average'), 1,0,'C');
				$this->Cell(10,6,utf8_decode($moyEleve), 1,0,'C');
				$this->Cell(16,6,utf8_decode('Repeat'), 1,0,'C');
				$this->Cell(10,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide
				// $this->Cell(26,6,'', 1,0,'C');
				
				$this->Cell(30,6,utf8_decode('Nb Average'), 1,0,'C');
				$this->Cell(23,6,$_SESSION['statistique']['moyTotal'], 1,0,'C');
				$this->Ln(6);
				$this->Cell(8);
				
				$this->Cell(20,6,utf8_decode('Consignes'), 1,0,'C');
				$this->Cell(6,6,utf8_decode(''), 1,0,'C');
				$this->Cell(20,6,utf8_decode('Excl. Déf.'), 1,0,'C');
				$this->Cell(7,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide 
				$this->Cell(17,6,utf8_decode('Grade'), 1,0,'C');
				$this->Cell(10,6,utf8_decode($eleve[$a]['cote']), 1,0,'C');
				
				$this->Cell(16,6,utf8_decode('Exclu pour'), 1,0,'C');
				$this->Cell(10,6,utf8_decode(''), 1,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide 
				$this->Cell(30,6,utf8_decode('Percentage'), 1,0,'C');
				
				$this->Cell(23,6,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5)), 1,0,'C');
				$this->Ln(6);
				$this->Cell(8);
				
				$this->Cell(20,6,utf8_decode(''), 0,0,'C');
				$this->Cell(6,6,utf8_decode(''), 0,0,'C');
				$this->Cell(20,6,utf8_decode(''), 0,0,'C');
				$this->Cell(7,6,utf8_decode(''), 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(27,6,utf8_decode('Rank : '), 1,0,'C');
				$this->Cell(26,6,utf8_decode($rangEleve), 1,0,'C');
				$this->Cell(26,6,'', 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C');
				$this->Cell(30,6,utf8_decode(''), 0,0,'C');
				$this->Cell(23,6,'', 0,0,'C');
				$this->Ln(6);
				$this->Cell(4);
				
				$this->SetFont('Times','B',9);
				$this->Cell(57,6,utf8_decode('Students work appreciation'), 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide
				$this->Cell(27,6,utf8_decode('Parent Signature'), 0,0,'C');
				$this->Cell(26,6,utf8_decode('Class M sign.'), 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide
				
				$texte = 'Done at  '.$ville.' on the  ________________';
				$this->Cell(53,6,utf8_decode($texte), 0,0,'C');
				$this->Ln(6);
				$this->Cell(4);
				
				$this->SetFont('Times','B',9);
				$this->Cell(57,6,'', 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide
				$this->Cell(27,6,'', 0,0,'C');
				$this->Cell(26,6,'', 0,0,'C');
				$this->Cell(5, 6, utf8_decode(''),0,0,'C'); // Espace Vide
				
				$this->Cell(53,6,utf8_decode($signataire), 0,0,'C');
				
			}
		}
		
		
	}