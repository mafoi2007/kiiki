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