<?php 
	require_once('fpdf.class.php');
	
	
	class pdf extends FPDF {
		
		function convert($texte){
			$txt = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $texte);
			return $txt;
		}
		
		
		
			
		function Entete(){
			$this->Image('images/logo.jpg', 125, 20, 25);
			$this->SetFont('Times','',8);
			$this->Cell(90,10, $this->convert($_SESSION['information']['pays_fr']),0,0,'C');
			$this->Cell(80,10, $this->convert(''),0,0,'C');
			$this->Cell(90,10, $this->convert($_SESSION['information']['pays_en']),0,0,'C');
			
			$this->Ln(4);
			
			$this->Cell(90,10, $this->convert($_SESSION['information']['devise_fr']),0,0,'C');
			$this->Cell(80,10, $this->convert(''),0,0,'C');
			$this->Cell(90,10, $this->convert($_SESSION['information']['devise_en']),0,0,'C');
			$this->Ln(3);
			
			$this->Cell(90,10, $this->convert('**************'),0,0,'C');
			$this->Cell(80,10, $this->convert(''),0,0,'C');
			$this->Cell(90,10, $this->convert('**************'),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(90,10, strtoupper($this->convert($_SESSION['information']['ministere_fr'])),0,0,'C');
			$this->Cell(80,10, strtoupper($this->convert('')),0,0,'C');
			$this->Cell(90,10, strtoupper($this->convert($_SESSION['information']['ministere_en'])),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(90,10, $this->convert('**************'),0,0,'C');
			$this->Cell(80,10, $this->convert(''),0,0,'C');
			$this->Cell(90,10, $this->convert('**************'),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(90,10, strtoupper($this->convert($_SESSION['information']['region_fr'])),0,0,'C');
			$this->Cell(80,10, strtoupper($this->convert('')),0,0,'C');
			$this->Cell(90,10, strtoupper($this->convert($_SESSION['information']['region_en'])),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(90,10, $this->convert('**************'),0,0,'C');
			$this->Cell(80,10, $this->convert(''),0,0,'C');
			$this->Cell(90,10, $this->convert('**************'),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(90,10, strtoupper($this->convert($_SESSION['information']['departement_fr'])),0,0,'C');
			$this->Cell(80,10, strtoupper($this->convert('')),0,0,'C');
			$this->Cell(90,10, strtoupper($this->convert($_SESSION['information']['departement_en'])),0,0,'C');
			$this->Ln(4);
			
			$this->Cell(90,10, $this->convert('**************'),0,0,'C');
			$this->Cell(80,10, $this->convert(''),0,0,'C');
			$this->Cell(90,10, $this->convert('**************'),0,0,'C');
			$this->Ln(4);
			
			$this->SetFont('Times','B',9);
			$this->Cell(90,10, strtoupper($this->convert($_SESSION['information']['nom_etablissement_fr'])),0,0,'C');
			$this->Cell(80,10, $this->convert(''),0,0,'C');
			$this->Cell(90,10, strtoupper($this->convert($_SESSION['information']['nom_etablissement_en'])),0,0,'C');
			$this->Ln(4);
			
			$this->SetFont('Times','I',8);
			$contactFr = 'Contact : '.$_SESSION['information']['contact'];
			$contactEn = 'Contact : '.$_SESSION['information']['contact'];
			$emailFr = 'Email : '.$_SESSION['information']['email'];
			$emailEn = 'Email : '.$_SESSION['information']['email'];
			$bpFr = 'B.P. : '.$_SESSION['information']['bp'].' '.$_SESSION['information']['arrondissement'];
			$bpEn = 'P.O. Box: '.$_SESSION['information']['bp'].' '.$_SESSION['information']['arrondissement'];
			$this->Cell(90,10, $this->convert($bpFr.'. '.$contactFr),0,0,'C');
			$this->Cell(80,10, $this->convert(''),0,0,'C');
			$this->Cell(90,10, $this->convert($bpEn.'. '.$contactEn),0,0,'C');
			$this->Ln(4);
			
			$this->SetFont('Times','B',8);
			$asFr = 'Année Scolaire : '.$_SESSION['information']['annee_scolaire'];
			$asEn = 'School Year : '.$_SESSION['information']['annee_scolaire'];
			$this->Cell(90,10, $this->convert($asFr),0,0,'C');
			$this->Cell(80,10, $this->convert(''),0,0,'C');
			$this->Cell(90,10, $this->convert($asEn),0,0,'C');
			$this->Ln(4);
			
		}
		
		
		
		
		function Footer(){
			$this->setFont('Arial', 'I', 8);
			$texte = $_SESSION['appName'].' '.$_SESSION['appVersion'];
			$texte .= ', votre partenaire éducatif. Tel : ';
			$texte .= $_SESSION['appContact'];
			$numeroPage = 'Page '.$this->PageNo().' / {nb}';
			$printed = 'Edition Date : '.DATE('d / m / Y  H:i:s');
			$this->Text(25,200, $this->convert($printed));
			$this->Text(100,200, $this->convert($texte));
			$this->Text(250,200, $this->convert($numeroPage));
			$this->setAuthor('Nyambi Computer Services');
			$this->setCreator('Nyambi Ngikwa Richard');
			$this->AliasNbPages();
		}









		public function rapportSequence($classe, $section){
			$titre['fr'] = "Rapport sequentiel";
			$titre['en'] = "Sequential report";
			$this->Titre($titre[$section]);
			$libClasse['fr'] = "Classe : ".$classe['classe']['nom_classe'];
			$libPeriode['fr'] = "Période : Sequence ".$classe['periode'];
			$libClasse['en'] = "Class : ".$classe['classe']['nom_classe'];
			$libPeriode['en'] = "Period : Sequence ".$classe['periode'];

			$this->Ln(5);
			$this->setFont('Times', 'B', 14);
			$this->Cell(85,6,utf8_decode($libClasse[$section]),0,0,'L');
			$this->Cell(85,6,'',0,0,'C');
			$this->Cell(85,6,utf8_decode($libPeriode[$section]),0,0,'L');

			$libNum['fr'] = 'N°';
			$libNom['fr'] = "Nom de l'élève";
			$libSexe['fr'] = "Sexe";
			$libStatut['fr'] = "Statut";
			$libNum['en'] = 'N°';
			$libNom['en'] = "Student Name";
			$libSexe['en'] = "Sex";
			$libStatut['en'] = "Status";
			$libTot['fr'] = 'Total';
			$libMoy['fr'] = 'Moyenne';
			$libRank['fr'] = 'Rang';
			$libCote['fr'] = 'Cote';
			$libAppr['fr'] = 'Appr';
			$libTot['en'] = 'Total';
			$libMoy['en'] = 'Average';
			$libRank['en'] = 'Rank';
			$libCote['en'] = 'Grade';
			$libAppr['en'] = 'Appr';
			
			$this->Ln(8);
			$this->setFont('Times', '', 10);
			$this->Cell(10, 5, utf8_decode($libNum[$section]), 1,0, 'C', true);
			$this->Cell(45, 5, utf8_decode($libNom[$section]), 1,0, 'C', true);
			$this->Cell(8, 5, utf8_decode($libSexe[$section]), 1,0, 'C', true);
			$this->Cell(8, 5, utf8_decode($libStatut[$section]), 1,0, 'C', true);
			for($i=0;$i<count($classe['matiere']);$i++){
				$codeMat = $classe['matiere'][$i]['code_matiere'];
				$this->Cell(10,5,strtolower($codeMat),1,0,'C', true);
			}
			$this->Cell(12, 5, utf8_decode($libTot[$section]), 1,0, 'C', true);
			$this->Cell(12, 5, utf8_decode($libMoy[$section]), 1,0, 'C', true);
			$this->Cell(10, 5, utf8_decode($libRank[$section]), 1,0, 'C', true);
			$this->Cell(10, 5, utf8_decode($libCote[$section]), 1,0, 'C', true);
			$this->Cell(10, 5, utf8_decode($libAppr[$section]), 1,0, 'C', true);
			$this->Ln(5);

			$a = 1;
			for($x=0;$x<count($classe['eleve']);$x++){
				$nomEleve = substr($classe['eleve'][$x]['nom_eleve'],0,20);
				$sexeEleve = $classe['eleve'][$x]['sexe'];
				$statutEleve = $classe['eleve'][$x]['statut'];
				$this->Cell(10, 5, utf8_decode($a), 1,0, 'C');
				$this->Cell(45, 5, utf8_decode($nomEleve), 1,0, 'L');
				$this->Cell(8, 5, utf8_decode($sexeEleve), 1,0, 'C');
				$this->Cell(8, 5, utf8_decode($statutEleve), 1,0, 'C');
				for($y=0;$y<count($classe['matiere']);$y++){
					$codeMat = strtolower($classe['matiere'][$y]['code_matiere']);
					$cle = $codeMat.'_seq';
					$noteEleve = $classe['eleve'][$x][$cle];
					$this->Cell(10,5,strtolower($noteEleve),1,0,'C');
				}
				$totalpoint = $classe['eleve'][$x]['total_point'];
				$moyenneEleve = $classe['eleve'][$x]['moyenne'];
				$rangEleve = $classe['eleve'][$x]['rang'];
				$coteEleve = $classe['eleve'][$x]['cote'];
				$apprEleve = $classe['eleve'][$x]['appreciation'];
				$this->Cell(12, 5, utf8_decode($totalpoint), 1,0, 'C');
				$this->Cell(12, 5, utf8_decode($moyenneEleve), 1,0, 'C', true);
				$this->Cell(10, 5, utf8_decode($rangEleve), 1,0, 'C');
				$this->Cell(10, 5, utf8_decode($coteEleve), 1,0, 'C');
				$this->Cell(10, 5, utf8_decode($apprEleve), 1,0, 'L');
				$a++;
				$this->Ln(5);
			}
			$this->Ln(5);
		}









		public function brefSequence($classe, $section){
			$titre['fr'] = 'En Bref';
			$titre['en'] = 'In Brief';
			$this->Titre($titre[$section]);

			
			$libEff['fr'] = 'Effectif';
			$libEval['fr'] = 'Evalués';
			$libMoy['fr'] = 'Nb Moyenne';
			$libTaux['fr'] = 'Taux';
			$libForte['fr'] = 'Forte Moy';
			$libFaible['fr'] = 'Faible Moy';
			$libEff['en'] = 'Roll';
			$libEval['en'] = 'Evaluated';
			$libMoy['en'] = 'Averages';
			$libTaux['en'] = 'Percentage';
			$libForte['en'] = 'Best Aver';
			$libFaible['en'] = 'Weak Aver';
			$this->Ln(5);
			$this->setFont('Times', 'B', 12);
			$this->Cell(45,5,utf8_decode($libEff[$section]),1,0,'C',true);
			$this->Cell(45,5,utf8_decode($libEval[$section]),1,0,'C',true);
			$this->Cell(45,5,utf8_decode($libMoy[$section]),1,0,'C',true);
			$this->Cell(45,5,utf8_decode($libTaux[$section]),1,0,'C',true);
			$this->Cell(45,5,utf8_decode($libForte[$section]),1,0,'C',true);
			$this->Cell(45,5,utf8_decode($libFaible[$section]),1,0,'C',true);
			$this->Ln(5);
			for($i=0;$i<6;$i++){
				$this->Cell(15,5,'F',1,0,'C');
				$this->Cell(15,5,'M',1,0,'C');
				$this->Cell(15,5,'T',1,0,'C');
			}
			$this->Ln(5);
			$this->Cell(15,5,$classe['stat']['effFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['effMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['effTotal'],1,0,'C',true);
			$this->Cell(15,5,$classe['stat']['evalFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['evalMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['evalTotal'],1,0,'C',true);
			$this->Cell(15,5,$classe['stat']['moyFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['moyMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['moyTotal'],1,0,'C',true);
			$this->Cell(15,5,$classe['stat']['tauxFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['tauxMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['tauxTotal'],1,0,'C',true);
			$this->Cell(15,5,$classe['stat']['noteForteFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['noteForteMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['noteForteTotal'],1,0,'C',true);
			$this->Cell(15,5,$classe['stat']['noteFaibleFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['noteFaibleMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['noteFaibleTotal'],1,0,'C',true);
		}









		public function rapportTrimestre($classe, $section){
			$titre['fr'] = "Rapport Trimestriel";
			$titre['en'] = "End of Term report";
			$this->Titre($titre[$section]);
			$libClasse['fr'] = "Classe : ".$classe['classe']['nom_classe'];
			$libPeriode['fr'] = "Période : Trimestre ".$classe['periode'];
			$libClasse['en'] = "Class : ".$classe['classe']['nom_classe'];
			$libPeriode['en'] = "Period : Term ".$classe['periode'];

			$this->Ln(5);
			$this->setFont('Times', 'B', 14);
			$this->Cell(85,6,utf8_decode($libClasse[$section]),0,0,'L');
			$this->Cell(85,6,'',0,0,'C');
			$this->Cell(85,6,utf8_decode($libPeriode[$section]),0,0,'L');

			$libNum['fr'] = 'N°';
			$libNom['fr'] = "Nom de l'élève";
			$libSexe['fr'] = "Sexe";
			$libStatut['fr'] = "Statut";
			$libNum['en'] = 'N°';
			$libNom['en'] = "Student Name";
			$libSexe['en'] = "Sex";
			$libStatut['en'] = "Status";
			$libTot['fr'] = 'Total';
			$libMoy['fr'] = 'Moyenne';
			$libRank['fr'] = 'Rang';
			$libCote['fr'] = 'Cote';
			$libAppr['fr'] = 'Appr';
			$libTot['en'] = 'Total';
			$libMoy['en'] = 'Average';
			$libRank['en'] = 'Rank';
			$libCote['en'] = 'Grade';
			$libAppr['en'] = 'Appr';
			
			$this->Ln(8);
			$this->setFont('Times', '', 10);
			$this->Cell(10, 5, utf8_decode($libNum[$section]), 1,0, 'C', true);
			$this->Cell(45, 5, utf8_decode($libNom[$section]), 1,0, 'C', true);
			$this->Cell(8, 5, utf8_decode($libSexe[$section]), 1,0, 'C', true);
			$this->Cell(8, 5, utf8_decode($libStatut[$section]), 1,0, 'C', true);
			for($i=0;$i<count($classe['matiere']);$i++){
				$codeMat = $classe['matiere'][$i]['code_matiere'];
				$this->Cell(10,5,strtolower($codeMat),1,0,'C', true);
			}
			$this->Cell(12, 5, utf8_decode($libTot[$section]), 1,0, 'C', true);
			$this->Cell(12, 5, utf8_decode($libMoy[$section]), 1,0, 'C', true);
			$this->Cell(10, 5, utf8_decode($libRank[$section]), 1,0, 'C', true);
			$this->Cell(10, 5, utf8_decode($libCote[$section]), 1,0, 'C', true);
			$this->Cell(10, 5, utf8_decode($libAppr[$section]), 1,0, 'C', true);
			$this->Ln(5);

			$a = 1;
			for($x=0;$x<count($classe['eleve']);$x++){
				$nomEleve = substr($classe['eleve'][$x]['nom_eleve'],0,20);
				$sexeEleve = $classe['eleve'][$x]['sexe'];
				$statutEleve = $classe['eleve'][$x]['statut'];
				$this->Cell(10, 5, utf8_decode($a), 1,0, 'C');
				$this->Cell(45, 5, utf8_decode($nomEleve), 1,0, 'L');
				$this->Cell(8, 5, utf8_decode($sexeEleve), 1,0, 'C');
				$this->Cell(8, 5, utf8_decode($statutEleve), 1,0, 'C');
				for($y=0;$y<count($classe['matiere']);$y++){
					$codeMat = strtolower($classe['matiere'][$y]['code_matiere']);
					$cle = $codeMat.'_trim';
					$noteEleve = $classe['eleve'][$x][$cle];
					$this->Cell(10,5,strtolower($noteEleve),1,0,'C');
				}
				$totalpoint = $classe['eleve'][$x]['total_point'];
				$moyenneEleve = $classe['eleve'][$x]['moyenne'];
				$rangEleve = $classe['eleve'][$x]['rang'];
				$coteEleve = $classe['eleve'][$x]['cote'];
				$apprEleve = $classe['eleve'][$x]['appreciation'];
				$this->Cell(12, 5, utf8_decode($totalpoint), 1,0, 'C');
				$this->Cell(12, 5, utf8_decode($moyenneEleve), 1,0, 'C', true);
				$this->Cell(10, 5, utf8_decode($rangEleve), 1,0, 'C');
				$this->Cell(10, 5, utf8_decode($coteEleve), 1,0, 'C');
				$this->Cell(10, 5, utf8_decode($apprEleve), 1,0, 'L');
				$a++;
				$this->Ln(5);
			}
			$this->Ln(5);
		}









		public function brefTrimestre($classe, $section){
			$titre['fr'] = 'En Bref';
			$titre['en'] = 'In Brief';
			$this->Titre($titre[$section]);

			
			$libEff['fr'] = 'Effectif';
			$libEval['fr'] = 'Evalués';
			$libMoy['fr'] = 'Nb Moyenne';
			$libTaux['fr'] = 'Taux';
			$libForte['fr'] = 'Forte Moy';
			$libFaible['fr'] = 'Faible Moy';
			$libEff['en'] = 'Roll';
			$libEval['en'] = 'Evaluated';
			$libMoy['en'] = 'Averages';
			$libTaux['en'] = 'Percentage';
			$libForte['en'] = 'Best Aver';
			$libFaible['en'] = 'Weak Aver';
			$this->Ln(5);
			$this->setFont('Times', 'B', 12);
			$this->Cell(45,5,utf8_decode($libEff[$section]),1,0,'C',true);
			$this->Cell(45,5,utf8_decode($libEval[$section]),1,0,'C',true);
			$this->Cell(45,5,utf8_decode($libMoy[$section]),1,0,'C',true);
			$this->Cell(45,5,utf8_decode($libTaux[$section]),1,0,'C',true);
			$this->Cell(45,5,utf8_decode($libForte[$section]),1,0,'C',true);
			$this->Cell(45,5,utf8_decode($libFaible[$section]),1,0,'C',true);
			$this->Ln(5);
			for($i=0;$i<6;$i++){
				$this->Cell(15,5,'F',1,0,'C');
				$this->Cell(15,5,'M',1,0,'C');
				$this->Cell(15,5,'T',1,0,'C');
			}
			$this->Ln(5);
			$this->Cell(15,5,$classe['stat']['effFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['effMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['effTotal'],1,0,'C',true);
			$this->Cell(15,5,$classe['stat']['evalFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['evalMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['evalTotal'],1,0,'C',true);
			$this->Cell(15,5,$classe['stat']['moyFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['moyMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['moyTotal'],1,0,'C',true);
			$this->Cell(15,5,$classe['stat']['tauxFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['tauxMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['tauxTotal'],1,0,'C',true);
			$this->Cell(15,5,$classe['stat']['noteForteFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['noteForteMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['noteForteTotal'],1,0,'C',true);
			$this->Cell(15,5,$classe['stat']['noteFaibleFille'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['noteFaibleMasc'],1,0,'C');
			$this->Cell(15,5,$classe['stat']['noteFaibleTotal'],1,0,'C',true);
		}
		
		
		
		
		function Titre($titre){
			// On crée d'abord un espace pour gérer les informations d'entête
			$this->Ln(9);
			$this->SetFont('Times', 'B', 18);
			// Déplacer à droite
			$this->Cell(10);
			// Bordure du titre
			$this->Cell(250, 10, $this->convert(strtoupper($titre)), 0, 0 , 'C');
			// Retour à la ligne
			$this->Ln(5);
		}
		
		
		function SousTitre($titre){
			// On crée d'abord un espace pour gérer les informations d'entête
			$this->Ln(2);
			$this->SetFont('Times', 'BI', 14);
			// Déplacer à droite
			$this->Cell(10);
			// Bordure du titre
			$this->Cell(200, 8, $this->convert(strtoupper($titre)), 0, 0 , 'C');
			// Retour à la ligne
			$this->Ln(5);
		}
		
		
		
	}