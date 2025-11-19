<?php 
	require_once('fpdf.class.php');
	class PDF extends FPDF {
		
		
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









		public function certificatScolarite($eleve, $information, $section){
			$titre['fr'] = 'certificat de scolarite';
			$titre['en'] = 'attendance school certificate';
			$this->Titre($titre[$section]);
			// Informations diverses
			$this->SetFont('Times','BI',14);
			$this->Ln(5);
			$soussigne['fr'] = 'Je soussigné ';
			$soussigne['en'] = 'I, undersigned ';
			$titre['fr'] = 'Principal du ';
			$titre['en'] = 'Principal of ';
			$nomEtablissement['en'] = strtoupper($information['nom_etablissement_en']);
			$nomEtablissement['fr'] = strtoupper($information['nom_etablissement_fr']);
			$certifie['fr'] = "Certifie que l'élève ";
			$certifie['en'] = "hereby certifies that ";
			$matricule['fr'] = "Matricule ";
			$matricule['en'] = "National Id ";
			$fils['fr'] = "Fils / Fille de ";
			$fils['en'] = "Son / Daugther of :";
			$etDe['fr'] = "Et de : ";
			$etDe['en'] = "And of : ";
			$neLe['fr'] = "Né(e) le :";
			$neLe['en'] = "Born on the :";
			$at['fr'] = "à : ";
			$at['en'] = "at :";
			$estInscrit['fr'] = "Est inscrit(e) dans mon établissement en classe de :";
			$estInscrit['en'] = "Is effectively in class :";
			$pourLannee['fr'] = "Pour l'année scolaire : ";
			$pourLannee['en'] = "For the school Year : ";
			$enFoi['fr'] = "En foi de quoi le présent certificat de scolarité est délivré pour servir et valoir ce que de droit/.";
			$enFoi['en'] = "In witness whereof, the present school certificate is issued to serve and attest as may be required by law/.";
			$arrondissement = $information['ville'];
			$faitA['fr'] = "Fait à ".ucwords($arrondissement)." le ".DATE('d / m / Y');
			$faitA['en'] = "Done at ".ucwords($arrondissement)." the ".DATE('d / m / Y');
			$signataire['fr'] = $information['signataire_fr'];
			$signataire['en'] = $information['signataire_en'];

			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($soussigne[$section]), 0, 0 , 'L');
			$this->SetFont('Times','B',14);
			$this->Cell(80, 7, strtoupper($information['chefEts']), 0, 0 , 'C');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($titre[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(120, 7, utf8_decode($nomEtablissement[$section]), 0, 0 , 'C');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($certifie[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(80, 7, utf8_decode($eleve['nom_complet']), 0, 0 , 'L');
			$this->SetFont('Times','',14);
			$this->Cell(25, 7, $matricule[$section], 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(25, 7, utf8_decode($eleve['rne']), 0, 0 , 'L');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($fils[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(120, 7, utf8_decode($eleve['nom_pere']), 0, 0 , 'L');
			$this->SetFont('Arial','B',10);
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($etDe[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(120, 7, $this->convert($eleve['nom_mere']), 0, 0 , 'L');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($neLe[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(50, 7, utf8_decode($eleve['date_fr']), 0, 0 , 'C');
			$this->SetFont('Times','',14);
			$this->Cell(15, 7, utf8_decode($at[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(50, 7, utf8_decode($eleve['lieu_naissance']), 0, 0 , 'C');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(110, 7, utf8_decode($estInscrit[$section]), 0,0,'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(60, 7, utf8_decode($eleve['nom_classe']), 0,0,'L');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(70, 7, utf8_decode($pourLannee[$section]), 0,0,'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(100, 7, utf8_decode($information['annee_scolaire']),0,0,'L');
			$this->Ln(10);
			$this->SetFont('Times','',12);
			$this->Cell(190, 7, utf8_decode($enFoi[$section]), 0,0,'C');
			$this->SetFont('Times','BI',14);
			$this->Ln(10);
			$this->Cell(100,30, ' ');
			$this->SetFont('Times','',14);
			$this->Cell(100,30, utf8_decode($faitA[$section]),0,0,'C');
			$this->Ln(10);
			$this->Cell(130,30, ' ');
			$this->SetFont('Times','BI',14);
			$this->Cell(100,25, $signataire[$section].',');
		}









		public function certificatScolariteOld($eleve, $information, $section){
			$titre['fr'] = 'certificat de scolarite';
			$titre['en'] = 'attendance school certificate';
			$this->Titre($titre[$section]);
			// Informations diverses
			$this->SetFont('Times','BI',14);
			$this->Ln(5);
			$soussigne['fr'] = 'Je soussigné ';
			$soussigne['en'] = 'I, undersigned ';
			$titre['fr'] = 'Principal du ';
			$titre['en'] = 'Principal of ';
			$nomEtablissement['en'] = strtoupper($information['nom_etablissement_en']);
			$nomEtablissement['fr'] = strtoupper($information['nom_etablissement_fr']);
			$certifie['fr'] = "Certifie que l'élève ";
			$certifie['en'] = "hereby certifies that ";
			$matricule['fr'] = "Matricule ";
			$matricule['en'] = "National Id ";
			$fils['fr'] = "Fils / Fille de ";
			$fils['en'] = "Son / Daugther of :";
			$etDe['fr'] = "Et de : ";
			$etDe['en'] = "And of : ";
			$neLe['fr'] = "Né(e) le :";
			$neLe['en'] = "Born on the :";
			$at['fr'] = "à : ";
			$at['en'] = "at :";
			$estInscrit['fr'] = "a été inscrit(e) dans mon établissement en classe de :";
			$estInscrit['en'] = "has been effectively in class :";
			$pourLannee['fr'] = "Pour l'année scolaire : ";
			$pourLannee['en'] = "For the school Year : ";
			$enFoi['fr'] = "En foi de quoi le présent certificat de scolarité est délivré pour servir et valoir ce que de droit/.";
			$enFoi['en'] = "In witness whereof, the present school certificate is issued to serve and attest as may be required by law/.";
			$arrondissement = $information['ville'];
			$faitA['fr'] = "Fait à ".ucwords($arrondissement)." le ".DATE('d / m / Y');
			$faitA['en'] = "Done at ".ucwords($arrondissement)." the ".DATE('d / m / Y');
			$signataire['fr'] = $information['signataire_fr'];
			$signataire['en'] = $information['signataire_en'];

			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($soussigne[$section]), 0, 0 , 'L');
			$this->SetFont('Times','B',14);
			$this->Cell(80, 7, strtoupper($information['chefEts']), 0, 0 , 'C');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($titre[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(120, 7, utf8_decode($nomEtablissement[$section]), 0, 0 , 'C');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($certifie[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(80, 7, utf8_decode($eleve['eleve']['nom_complet']), 0, 0 , 'L');
			$this->SetFont('Times','',14);
			$this->Cell(25, 7, $matricule[$section], 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(25, 7, utf8_decode($eleve['eleve']['rne']), 0, 0 , 'L');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($fils[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(120, 7, utf8_decode($eleve['eleve']['nom_pere']), 0, 0 , 'L');
			$this->SetFont('Arial','B',10);
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($etDe[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(120, 7, $this->convert($eleve['eleve']['nom_mere']), 0, 0 , 'L');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(50, 7, utf8_decode($neLe[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(50, 7, utf8_decode($eleve['eleve']['date_naissance']), 0, 0 , 'C');
			$this->SetFont('Times','',14);
			$this->Cell(15, 7, utf8_decode($at[$section]), 0, 0 , 'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(50, 7, utf8_decode($eleve['eleve']['lieu_naissance']), 0, 0 , 'C');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(110, 7, utf8_decode($estInscrit[$section]), 0,0,'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(60, 7, utf8_decode($eleve['classe']['nom_classe']), 0,0,'L');
			$this->Ln(10);
			$this->SetFont('Times','',14);
			$this->Cell(70, 7, utf8_decode($pourLannee[$section]), 0,0,'L');
			$this->SetFont('Times','BI',14);
			$this->Cell(100, 7, utf8_decode($eleve['eleve']['a_s']),0,0,'L');
			$this->Ln(10);
			$this->SetFont('Times','',12);
			$this->Cell(190, 7, utf8_decode($enFoi[$section]), 0,0,'C');
			$this->SetFont('Times','BI',14);
			$this->Ln(10);
			$this->Cell(100,30, ' ');
			$this->SetFont('Times','',14);
			$this->Cell(100,30, utf8_decode($faitA[$section]),0,0,'C');
			$this->Ln(10);
			$this->Cell(130,30, ' ');
			$this->SetFont('Times','BI',14);
			$this->Cell(100,25, $signataire[$section].',');
		}









		public function listeEleve($classe, $section){
			$titre['fr'] = "liste des eleves de la ".$classe['eleve'][0]['nom_classe'];
			$titre['en'] = "student list of ".$classe['eleve'][0]['nom_classe'];
			$this->Titre($titre[$section]);
			$libSexe['fr'] = 'Sexe';
			$libMasc['fr'] = 'Masculin'; 
			$libFem['fr'] = 'Feminin';
			$libTot['fr'] = 'Total';
			$libRed['fr'] = 'Redoublant';
			$libNouv['fr'] = 'Nouveau';
			$libSexe['en'] = 'Sex';
			$libMasc['en'] = 'Male'; 
			$libFem['en'] = 'Female';
			$libTot['en'] = 'Global';
			$libRed['en'] = 'Repeater';
			$libNouv['en'] = 'New';

			$libNumber['fr'] = 'N°';
			$libMatricule['fr'] = 'Matricule';
			$libNom['fr'] = 'Nom Complet';
			$libStatut['fr'] = 'Statut';
			$libDate['fr'] = 'Date et Lieu de Naissance';
			$libNumber['en'] = 'N°';
			$libMatricule['en'] = 'National Id';
			$libNom['en'] = 'Student Name';
			$libStatut['en'] = 'Status';
			$libDate['en'] = 'Date and place of birth';

			$this->SetFont('Times','',8);
			$this->Cell(60);
			$this->Cell(14, 7, $libSexe[$section], 1, 0 , 'C', true);
			$this->Cell(12, 7, $libFem[$section], 1, 0 , 'C', true);
			$this->Cell(14, 7, $libMasc[$section], 1, 0 , 'C', true);
			$this->Cell(10, 7, $libTot[$section], 1, 0 , 'C', true);
			$this->Ln(7);
			$this->SetFont('Times','',8);
			$this->Cell(60);
			$this->Cell(14, 7, $libRed[$section], 1, 0 , 'C');
			$this->Cell(12, 7,  $classe['stat']['FR'], 1, 0 , 'C');
			$this->Cell(14, 7,  $classe['stat']['GR'], 1, 0 , 'C');
			$this->Cell(10, 7,  $classe['stat']['R'], 1, 0 , 'C');
			$this->Ln(7);
			$this->SetFont('Times','',8);
			$this->Cell(60);
			$this->Cell(14, 7, $libNouv[$section], 1, 0 , 'C');
			$this->Cell(12, 7,  $classe['stat']['FN'], 1, 0 , 'C');
			$this->Cell(14, 7,  $classe['stat']['GN'], 1, 0 , 'C');
			$this->Cell(10, 7,  $classe['stat']['N'], 1, 0 , 'C');
			$this->Ln(7);
			$this->SetFont('Times','',8);
			$this->Cell(60);
			$this->Cell(14, 7, $libTot[$section], 1, 0 , 'C');
			$this->Cell(12, 7,  $classe['stat']['F'], 1, 0 , 'C');
			$this->Cell(14, 7,  $classe['stat']['G'], 1, 0 , 'C');
			$this->Cell(10, 7,  $classe['stat']['T'], 1, 0 , 'C');
			$this->Ln(10);

			$this->SetFont('Times','B',10);
			// Je positionne l'entete du tableau
			$this->Cell(10, 6, $this->convert($libNumber[$section]), 1, 0 , 'C',true);
			$this->Cell(28, 6, $this->convert($libMatricule[$section]), 1, 0 , 'C',true);
			$this->Cell(75, 6, $this->convert($libNom[$section]), 1, 0 , 'C',true);
			$this->Cell(9, 6, $this->convert($libSexe[$section]), 1, 0 , 'C',true);
			$this->Cell(13, 6, $this->convert($libStatut[$section]), 1, 0 , 'C',true);
			$this->Cell(55, 6, $this->convert($libDate[$section]), 1, 0 , 'C',true);
			$this->SetFont('Times','',10);
			$this->Ln(6);
			$a = 1;
			for($i=0;$i<count($classe['eleve']);$i++){
				$this->Cell(10, 6, $a, 1, 0 , 'C');
				$this->Cell(28, 6, $this->convert($classe['eleve'][$i]['rne']), 1, 0 , 'C');
				$this->Cell(75, 6, $this->convert($classe['eleve'][$i]['nom_complet']), 1, 0 , 'L');
				$this->Cell(9, 6, $this->convert($classe['eleve'][$i]['sexe']), 1, 0 , 'C');
				$this->Cell(13, 6, $this->convert($classe['eleve'][$i]['statut']), 1, 0 , 'C');
				$dateNaiss = $classe['eleve'][$i]['date_fr'].' at '.ucwords($classe['eleve'][$i]['lieu_naissance']);
				$this->Cell(55, 6, $this->convert($dateNaiss), 1, 0 , 'L');
				$this->Ln(6);
				$a++;
			}

			$faitA['fr'] = "Fait à ".ucwords($_SESSION['information']['ville'])." le ".DATE('d / m / Y');
			$faitA['en'] = "Done at ".ucwords($_SESSION['information']['ville'])." the ".DATE('d / m / Y');
			$signataire['fr'] = $classe['information']['signataire_fr'];
			$signataire['en'] = $classe['information']['signataire_en'];

			$this->Cell(110);
			$this->Cell(70,10, $faitA[$section],0,0,'C');
			$this->Cell(20);
			$this->Ln(5);
			$this->SetFont('Arial','BI',10);
			$this->Cell(110);
			$this->Cell(70,10, $signataire[$section],0,0,'C');
			$this->Cell(20);
		}












		public function listeEleveOld($annee, $classe, $section){
			$titre['fr'] = "liste des eleves de la ".$classe['classe']['nom_classe'];
			$titre['en'] = "student list of ".$classe['classe']['nom_classe'];
			$this->Titre($titre[$section]);
			$libSexe['fr'] = 'Sexe';
			$libMasc['fr'] = 'Masculin'; 
			$libFem['fr'] = 'Feminin';
			$libTot['fr'] = 'Total';
			$libRed['fr'] = 'Redoublant';
			$libNouv['fr'] = 'Nouveau';
			$libSexe['en'] = 'Sex';
			$libMasc['en'] = 'Male'; 
			$libFem['en'] = 'Female';
			$libTot['en'] = 'Global';
			$libRed['en'] = 'Repeater';
			$libNouv['en'] = 'New';
			$libAnnee['fr'] = "Année Scolaire : ".$classe['eleve'][0]['a_s'];
			$libAnnee['en'] = "School Year : ".$classe['eleve'][0]['a_s'];

			$libNumber['fr'] = 'N°';
			$libMatricule['fr'] = 'Matricule';
			$libNom['fr'] = 'Nom Complet';
			$libStatut['fr'] = 'Statut';
			$libDate['fr'] = 'Date et Lieu de Naissance';
			$libNumber['en'] = 'N°';
			$libMatricule['en'] = 'National Id';
			$libNom['en'] = 'Student Name';
			$libStatut['en'] = 'Status';
			$libDate['en'] = 'Date and place of birth';

			// $this->SetFont('Times','',8);
			// $this->Cell(60);
			// $this->Cell(14, 7, $libSexe[$section], 1, 0 , 'C', true);
			// $this->Cell(12, 7, $libFem[$section], 1, 0 , 'C', true);
			// $this->Cell(14, 7, $libMasc[$section], 1, 0 , 'C', true);
			// $this->Cell(10, 7, $libTot[$section], 1, 0 , 'C', true);
			// $this->Ln(7);
			// $this->SetFont('Times','',8);
			// $this->Cell(60);
			// $this->Cell(14, 7, $libRed[$section], 1, 0 , 'C');
			// $this->Cell(12, 7,  $classe['stat']['FR'], 1, 0 , 'C');
			// $this->Cell(14, 7,  $classe['stat']['GR'], 1, 0 , 'C');
			// $this->Cell(10, 7,  $classe['stat']['R'], 1, 0 , 'C');
			// $this->Ln(7);
			// $this->SetFont('Times','',8);
			// $this->Cell(60);
			// $this->Cell(14, 7, $libNouv[$section], 1, 0 , 'C');
			// $this->Cell(12, 7,  $classe['stat']['FN'], 1, 0 , 'C');
			// $this->Cell(14, 7,  $classe['stat']['GN'], 1, 0 , 'C');
			// $this->Cell(10, 7,  $classe['stat']['N'], 1, 0 , 'C');
			// $this->Ln(7);
			// $this->SetFont('Times','',8);
			// $this->Cell(60);
			// $this->Cell(14, 7, $libTot[$section], 1, 0 , 'C');
			// $this->Cell(12, 7,  $classe['stat']['F'], 1, 0 , 'C');
			// $this->Cell(14, 7,  $classe['stat']['G'], 1, 0 , 'C');
			// $this->Cell(10, 7,  $classe['stat']['T'], 1, 0 , 'C');
			// $this->Ln(10);
			$this->Cell(100);
			$this->Cell(45, 6, $this->convert($libAnnee[$section]));
			$this->Ln(10);
			$this->SetFont('Times','B',10);
			// Je positionne l'entete du tableau
			$this->Cell(10, 6, $this->convert($libNumber[$section]), 1, 0 , 'C',true);
			$this->Cell(28, 6, $this->convert($libMatricule[$section]), 1, 0 , 'C',true);
			$this->Cell(75, 6, $this->convert($libNom[$section]), 1, 0 , 'C',true);
			$this->Cell(9, 6, $this->convert($libSexe[$section]), 1, 0 , 'C',true);
			$this->Cell(13, 6, $this->convert($libStatut[$section]), 1, 0 , 'C',true);
			$this->Cell(55, 6, $this->convert($libDate[$section]), 1, 0 , 'C',true);
			$this->SetFont('Times','',10);
			$this->Ln(6);
			$a = 1;
			for($i=0;$i<count($classe['eleve']);$i++){
				$this->Cell(10, 6, $a, 1, 0 , 'C');
				$this->Cell(28, 6, $this->convert($classe['eleve'][$i]['rne']), 1, 0 , 'C');
				$this->Cell(75, 6, $this->convert($classe['eleve'][$i]['nom_complet']), 1, 0 , 'L');
				$this->Cell(9, 6, $this->convert($classe['eleve'][$i]['sexe']), 1, 0 , 'C');
				$this->Cell(13, 6, $this->convert($classe['eleve'][$i]['statut']), 1, 0 , 'C');
				$dateNaiss = $classe['eleve'][$i]['date_naissance'].' at '.ucwords($classe['eleve'][$i]['lieu_naissance']);
				$this->Cell(55, 6, $this->convert($dateNaiss), 1, 0 , 'L');
				$this->Ln(6);
				$a++;
			}

			$faitA['fr'] = "Fait à ".ucwords($_SESSION['information']['ville'])." le ".DATE('d / m / Y');
			$faitA['en'] = "Done at ".ucwords($_SESSION['information']['ville'])." the ".DATE('d / m / Y');
			$signataire['fr'] = $classe['information']['signataire_fr'];
			$signataire['en'] = $classe['information']['signataire_en'];

			$this->Cell(110);
			$this->Cell(70,10, utf8_decode($faitA[$section]),0,0,'C');
			$this->Cell(20);
			$this->Ln(5);
			$this->SetFont('Arial','BI',10);
			$this->Cell(110);
			$this->Cell(70,10, $signataire[$section],0,0,'C');
			$this->Cell(20);
		}
		
		
		
		
		
		
		
		
		
		public function pvSequentielAlpha($section){
			$this->addPage();
			$this->Entete();
			if($_SESSION['sequence']==1){
				$titreSequence['fr'] = 'Premiere Sequence';
				$titreSequence['en'] = 'First Sequence';
			}elseif($_SESSION['sequence']==2){
				$titreSequence['fr'] = 'Deuxieme Sequence';
				$titreSequence['en'] = 'Second Sequence';
			}elseif($_SESSION['sequence']==3){
				$titreSequence['fr'] = 'Troisieme Sequence';
				$titreSequence['en'] = 'Third Sequence';
			}elseif($_SESSION['sequence']==4){
				$titreSequence['fr'] = 'Quatrieme Sequence';
				$titreSequence['en'] = 'Fourth Sequence';
			}elseif($_SESSION['sequence']==5){
				$titreSequence['fr'] = 'Cinquieme Sequence';
				$titreSequence['en'] = 'Fifth Sequence';
			}elseif($_SESSION['sequence']==6){
				$titreSequence['fr'] = 'Sixieme Sequence';
				$titreSequence['en'] = 'Sixth Sequence';
			}
			$titre['fr'] = "Proces Verbal de la ".$titreSequence['fr'];
			$titre['en'] = "report of the ".$titreSequence['en'];
			$classe['fr'] = "Classe : ".strtoupper($_SESSION['nom_classe']);
			$classe['en'] = "Class : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse['fr'] = 'Effectif : '.count($_SESSION['eleve']);
			$effectifClasse['en'] = 'Roll : '.count($_SESSION['eleve']);
			$effectifEvalue['fr'] = 'Evalués : '.$_SESSION['eleve'][0]['classes'];
			$effectifEvalue['en'] = 'Evaluated : '.$_SESSION['eleve'][0]['classes'];

			$this->Titre($titre[$section]);

			$this->SetFont('Times','B',12);
			$this->Cell(85,5,utf8_decode($classe[$section]),0,0,'L');
			$this->Cell(35,5,utf8_decode($effectifClasse[$section]),0,0,'C');
			$this->Cell(35,5,utf8_decode($effectifEvalue[$section]),0,0,'C');
			$this->Ln(5);

			// Construction du tableau Informationnel statistique
			$libelle['fr'] = 'Libellé';
			$libelle['en'] = 'Title';
			$feminin['fr'] = 'Féminin';
			$feminin['en'] = 'Female';
			$masculin['fr'] = 'Masculin';
			$masculin['en'] = 'Male';
			$total['fr'] = 'Total';
			$total['en'] = 'Global';
			$moyennes['fr'] = 'Moyennes';
			$moyennes['en'] = 'Averages';
			$sousMoyennes['fr'] = 'Sous - Moyennes';
			$sousMoyennes['en'] = 'Sub - Averages';
			$moyenneGenerale['fr'] = 'Moyenne Générale';
			$moyenneGenerale['en'] = 'General Average';
			$taux['fr'] = 'Taux Réussite';
			$taux['en'] = 'Percentage';
			$forteMoy['fr'] = 'Forte Moyenne';
			$forteMoy['en'] = 'Max Average';
			$faibleMoy['fr'] = 'Faible Moyenne';
			$faibleMoy['en'] = 'Low Average';
			$this->Cell(55,8,'',0,0,'C');
			$this->Cell(35,8,utf8_decode($libelle[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($feminin[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($masculin[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($total[$section]),1,0,'C',true);
			$this->Ln(8);
			$this->Cell(55);
			$this->SetFont('Times','',10);
			$this->Cell(35,8,utf8_decode($moyennes[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($sousMoyennes[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($moyenneGenerale[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($taux[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5).' %'),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5).' %'),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5).' %'),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($forteMoy[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($faibleMoy[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$this->Ln(10);

			// Informations du PV 
			$pvNumber['fr'] = 'N°';
			$pvNumber['en'] = 'N°';
			$pvMatricule['fr'] = 'Matricule';
			$pvMatricule['en'] = 'Identifier';
			$pvNom['fr'] = 'Noms et Prénoms';
			$pvNom['en'] = 'Student Name';
			$pvSexe['fr'] = 'Sexe';
			$pvSexe['en'] = 'Sex';
			$pvMoyenne['fr'] = 'Moyenne';
			$pvMoyenne['en'] = 'Average';
			$pvRang['fr'] = 'Rang';
			$pvRang['en'] = 'Rank';
			$pvAppr['fr'] = 'Appréc.';
			$pvAppr['en'] = 'Grade';
			$pvCote['fr'] = 'Cote';
			$pvCote['en'] = 'Cote';
			$pvObserv['fr'] = 'Observations';
			$pvObserv['en'] = 'Observations';
			$this->SetFont('Times','B',8);
			$this->Cell(10,5,utf8_decode($pvNumber[$section]	),1,0,'C',true);
			$this->Cell(20,5,utf8_decode($pvMatricule[$section]),1,0,'C',true);
			$this->Cell(55,5,utf8_decode($pvNom[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvSexe[$section]),1,0,'C',true);
			$this->Cell(15,5,utf8_decode($pvMoyenne[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvRang[$section]),1,0,'C',true);
			$this->Cell(15,5,utf8_decode($pvAppr[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvCote[$section]),1,0,'C',true);
			$this->Cell(40,5,utf8_decode($pvObserv[$section]),1,0,'C',true);
			$this->Ln(5);
			$a = 1;
			$this->SetFont('Times','',9);
			for($i=0;$i<count($_SESSION['eleve']);$i++){
				$rneEleve = utf8_decode($_SESSION['eleve'][$i]['rne']);
				$nomEleve = utf8_decode(stripslashes(substr($_SESSION['eleve'][$i]['nom_eleve'],0,28)));
				$sexeEleve = utf8_decode($_SESSION['eleve'][$i]['sexe']);
				$moyenneEleve = $_SESSION['eleve'][$i]['moyenne'];
				$rankEleve = $_SESSION['eleve'][$i]['rang'];
				$apprEleve = $_SESSION['eleve'][$i]['appreciation'];
				$coteEleve = $_SESSION['eleve'][$i]['cote'];
				$this->Cell(10,5,utf8_decode($a),1,0,'C');
				$this->Cell(20,5,$rneEleve,1,0,'C');
				$this->Cell(55,5,$nomEleve,1,0,'L');
				$this->Cell(10,5,$sexeEleve,1,0,'C');
				$this->SetFont('Times','B',9);
				$this->Cell(15,5,$moyenneEleve,1,0,'C',true);
				$this->SetFont('Times','',9);
				$this->Cell(10,5,$rankEleve,1,0,'C');
				$this->Cell(15,5,$apprEleve,1,0,'C');
				$this->Cell(10,5,$coteEleve,1,0,'C');
				$this->Cell(40,5,utf8_decode(''),1,0,'C');
				$this->Ln(5);
				$a++;
			}
			$ville = $_SESSION['information']['ville'];
			$faitA['fr'] = 'Fait à '.strtoupper($ville).', le __________________.';
			$faitA['en'] = 'Done at '.strtoupper($ville).', the __________________.';
			$signataire['fr'] = $_SESSION['information']['signataire_fr'];
			$signataire['en'] = $_SESSION['information']['signataire_en'];
			$this->Ln(2);
			$this->Cell(125);
			$this->Cell(60,5, utf8_decode($faitA[$section]),0,0,'R');
			$this->Ln(5);
			$this->Cell(125);
			$this->SetFont('Times','BI',9);
			$this->Cell(60,5,utf8_decode($signataire[$section]),0,0,'C');
		}









		public function pvTrimestrielAlpha($section){
			$this->addPage();
			$this->Entete();
			if($_SESSION['trimestre']==1){
				$titreTrimestre['fr'] = 'Premier Trimestre';
				$titreTrimestre['en'] = 'First Term';
			}elseif($_SESSION['trimestre']==2){
				$titreTrimestre['fr'] = 'Deuxieme Trimestre';
				$titreTrimestre['en'] = 'Second Term';
			}elseif($_SESSION['trimestre']==3){
				$titreTrimestre['fr'] = 'Troisieme Trimestre';
				$titreTrimestre['en'] = 'Third Term';
			}
			$titre['fr'] = "Proces Verbal du ".$titreTrimestre['fr'];
			$titre['en'] = "report of the ".$titreTrimestre['en'];
			$classe['fr'] = "Classe : ".strtoupper($_SESSION['nom_classe']);
			$classe['en'] = "Class : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse['fr'] = 'Effectif : '.count($_SESSION['eleve']);
			$effectifClasse['en'] = 'Roll : '.count($_SESSION['eleve']);
			$effectifEvalue['fr'] = 'Evalués : '.$_SESSION['eleve'][0]['classes'];
			$effectifEvalue['en'] = 'Evaluated : '.$_SESSION['eleve'][0]['classes'];

			$this->Titre($titre[$section]);

			$this->SetFont('Times','B',12);
			$this->Cell(85,5,utf8_decode($classe[$section]),0,0,'L');
			$this->Cell(35,5,utf8_decode($effectifClasse[$section]),0,0,'C');
			$this->Cell(35,5,utf8_decode($effectifEvalue[$section]),0,0,'C');
			$this->Ln(5);

			// Construction du tableau Informationnel statistique
			$libelle['fr'] = 'Libellé';
			$libelle['en'] = 'Title';
			$feminin['fr'] = 'Féminin';
			$feminin['en'] = 'Female';
			$masculin['fr'] = 'Masculin';
			$masculin['en'] = 'Male';
			$total['fr'] = 'Total';
			$total['en'] = 'Global';
			$moyennes['fr'] = 'Moyennes';
			$moyennes['en'] = 'Averages';
			$sousMoyennes['fr'] = 'Sous - Moyennes';
			$sousMoyennes['en'] = 'Sub - Averages';
			$moyenneGenerale['fr'] = 'Moyenne Générale';
			$moyenneGenerale['en'] = 'General Average';
			$taux['fr'] = 'Taux Réussite';
			$taux['en'] = 'Percentage';
			$forteMoy['fr'] = 'Forte Moyenne';
			$forteMoy['en'] = 'Max Average';
			$faibleMoy['fr'] = 'Faible Moyenne';
			$faibleMoy['en'] = 'Low Average';
			$this->Cell(55,8,'',0,0,'C');
			$this->Cell(35,8,utf8_decode($libelle[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($feminin[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($masculin[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($total[$section]),1,0,'C',true);
			$this->Ln(8);
			$this->Cell(55);
			$this->SetFont('Times','',10);
			$this->Cell(35,8,utf8_decode($moyennes[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($sousMoyennes[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($moyenneGenerale[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($taux[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5).' %'),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5).' %'),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5).' %'),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($forteMoy[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($faibleMoy[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$this->Ln(10);

			// Informations du PV 
			$pvNumber['fr'] = 'N°';
			$pvNumber['en'] = 'N°';
			$pvMatricule['fr'] = 'Matricule';
			$pvMatricule['en'] = 'Identifier';
			$pvNom['fr'] = 'Noms et Prénoms';
			$pvNom['en'] = 'Student Name';
			$pvSexe['fr'] = 'Sexe';
			$pvSexe['en'] = 'Sex';
			$pvMoyenne['fr'] = 'Moyenne';
			$pvMoyenne['en'] = 'Average';
			$pvRang['fr'] = 'Rang';
			$pvRang['en'] = 'Rank';
			$pvAppr['fr'] = 'Appréc.';
			$pvAppr['en'] = 'Grade';
			$pvCote['fr'] = 'Cote';
			$pvCote['en'] = 'Cote';
			$pvObserv['fr'] = 'Observations';
			$pvObserv['en'] = 'Observations';
			$this->SetFont('Times','B',8);
			$this->Cell(10,5,utf8_decode($pvNumber[$section]	),1,0,'C',true);
			$this->Cell(20,5,utf8_decode($pvMatricule[$section]),1,0,'C',true);
			$this->Cell(55,5,utf8_decode($pvNom[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvSexe[$section]),1,0,'C',true);
			$this->Cell(15,5,utf8_decode($pvMoyenne[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvRang[$section]),1,0,'C',true);
			$this->Cell(15,5,utf8_decode($pvAppr[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvCote[$section]),1,0,'C',true);
			$this->Cell(40,5,utf8_decode($pvObserv[$section]),1,0,'C',true);
			$this->Ln(5);
			$a = 1;
			$this->SetFont('Times','',9);
			for($i=0;$i<count($_SESSION['eleve']);$i++){
				$rneEleve = utf8_decode($_SESSION['eleve'][$i]['rne']);
				$nomEleve = utf8_decode(stripslashes(substr($_SESSION['eleve'][$i]['nom_eleve'],0,28)));
				$sexeEleve = utf8_decode($_SESSION['eleve'][$i]['sexe']);
				$moyenneEleve = $_SESSION['eleve'][$i]['moyenne'];
				$rankEleve = $_SESSION['eleve'][$i]['rang'];
				$apprEleve = $_SESSION['eleve'][$i]['appreciation'];
				$coteEleve = $_SESSION['eleve'][$i]['cote'];
				$this->Cell(10,5,utf8_decode($a),1,0,'C');
				$this->Cell(20,5,$rneEleve,1,0,'C');
				$this->Cell(55,5,$nomEleve,1,0,'L');
				$this->Cell(10,5,$sexeEleve,1,0,'C');
				$this->SetFont('Times','B',9);
				$this->Cell(15,5,$moyenneEleve,1,0,'C',true);
				$this->SetFont('Times','',9);
				$this->Cell(10,5,$rankEleve,1,0,'C');
				$this->Cell(15,5,$apprEleve,1,0,'C');
				$this->Cell(10,5,$coteEleve,1,0,'C');
				$this->Cell(40,5,utf8_decode(''),1,0,'C');
				$this->Ln(5);
				$a++;
			}
			$ville = $_SESSION['information']['ville'];
			$faitA['fr'] = 'Fait à '.strtoupper($ville).', le __________________.';
			$faitA['en'] = 'Done at '.strtoupper($ville).', the __________________.';
			$signataire['fr'] = $_SESSION['information']['signataire_fr'];
			$signataire['en'] = $_SESSION['information']['signataire_en'];
			$this->Ln(2);
			$this->Cell(125);
			$this->Cell(60,5, utf8_decode($faitA[$section]),0,0,'R');
			$this->Ln(5);
			$this->Cell(125);
			$this->SetFont('Times','BI',9);
			$this->Cell(60,5,utf8_decode($signataire[$section]),0,0,'C');
		}





		public function pvSequentielMerite($section){
			$this->addPage();
			$this->Entete();
			if($_SESSION['sequence']==1){
				$titreSequence['fr'] = 'Premiere Sequence';
				$titreSequence['en'] = 'First Sequence';
			}elseif($_SESSION['sequence']==2){
				$titreSequence['fr'] = 'Deuxieme Sequence';
				$titreSequence['en'] = 'Second Sequence';
			}elseif($_SESSION['sequence']==3){
				$titreSequence['fr'] = 'Troisieme Sequence';
				$titreSequence['en'] = 'Third Sequence';
			}elseif($_SESSION['sequence']==4){
				$titreSequence['fr'] = 'Quatrieme Sequence';
				$titreSequence['en'] = 'Fourth Sequence';
			}elseif($_SESSION['sequence']==5){
				$titreSequence['fr'] = 'Cinquieme Sequence';
				$titreSequence['en'] = 'Fifth Sequence';
			}elseif($_SESSION['sequence']==6){
				$titreSequence['fr'] = 'Sixieme Sequence';
				$titreSequence['en'] = 'Sixth Sequence';
			}
			$titre['fr'] = "Proces Verbal de la ".$titreSequence['fr'];
			$titre['en'] = "report of the ".$titreSequence['en'];
			$classe['fr'] = "Classe : ".strtoupper($_SESSION['nom_classe']);
			$classe['en'] = "Class : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse['fr'] = 'Effectif : '.count($_SESSION['eleve']);
			$effectifClasse['en'] = 'Roll : '.count($_SESSION['eleve']);
			$effectifEvalue['fr'] = 'Evalués : '.$_SESSION['eleve'][0]['classes'];
			$effectifEvalue['en'] = 'Evaluated : '.$_SESSION['eleve'][0]['classes'];

			$this->Titre($titre[$section]);

			$this->SetFont('Times','B',12);
			$this->Cell(85,5,utf8_decode($classe[$section]),0,0,'L');
			$this->Cell(35,5,utf8_decode($effectifClasse[$section]),0,0,'C');
			$this->Cell(35,5,utf8_decode($effectifEvalue[$section]),0,0,'C');
			$this->Ln(5);

			// Construction du tableau Informationnel statistique
			$libelle['fr'] = 'Libellé';
			$libelle['en'] = 'Title';
			$feminin['fr'] = 'Féminin';
			$feminin['en'] = 'Female';
			$masculin['fr'] = 'Masculin';
			$masculin['en'] = 'Male';
			$total['fr'] = 'Total';
			$total['en'] = 'Global';
			$moyennes['fr'] = 'Moyennes';
			$moyennes['en'] = 'Averages';
			$sousMoyennes['fr'] = 'Sous - Moyennes';
			$sousMoyennes['en'] = 'Sub - Averages';
			$moyenneGenerale['fr'] = 'Moyenne Générale';
			$moyenneGenerale['en'] = 'General Average';
			$taux['fr'] = 'Taux Réussite';
			$taux['en'] = 'Percentage';
			$forteMoy['fr'] = 'Forte Moyenne';
			$forteMoy['en'] = 'Max Average';
			$faibleMoy['fr'] = 'Faible Moyenne';
			$faibleMoy['en'] = 'Low Average';
			$this->Cell(55,8,'',0,0,'C');
			$this->Cell(35,8,utf8_decode($libelle[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($feminin[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($masculin[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($total[$section]),1,0,'C',true);
			$this->Ln(8);
			$this->Cell(55);
			$this->SetFont('Times','',10);
			$this->Cell(35,8,utf8_decode($moyennes[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($sousMoyennes[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($moyenneGenerale[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($taux[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5).' %'),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5).' %'),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5).' %'),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($forteMoy[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($faibleMoy[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$this->Ln(10);

			// Informations du PV 
			$pvNumber['fr'] = 'N°';
			$pvNumber['en'] = 'N°';
			$pvMatricule['fr'] = 'Matricule';
			$pvMatricule['en'] = 'Identifier';
			$pvNom['fr'] = 'Noms et Prénoms';
			$pvNom['en'] = 'Student Name';
			$pvSexe['fr'] = 'Sexe';
			$pvSexe['en'] = 'Sex';
			$pvMoyenne['fr'] = 'Moyenne';
			$pvMoyenne['en'] = 'Average';
			$pvRang['fr'] = 'Rang';
			$pvRang['en'] = 'Rank';
			$pvAppr['fr'] = 'Appréc.';
			$pvAppr['en'] = 'Grade';
			$pvCote['fr'] = 'Cote';
			$pvCote['en'] = 'Cote';
			$pvObserv['fr'] = 'Observations';
			$pvObserv['en'] = 'Observations';
			$this->SetFont('Times','B',8);
			$this->Cell(10,5,utf8_decode($pvNumber[$section]	),1,0,'C',true);
			$this->Cell(20,5,utf8_decode($pvMatricule[$section]),1,0,'C',true);
			$this->Cell(55,5,utf8_decode($pvNom[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvSexe[$section]),1,0,'C',true);
			$this->Cell(15,5,utf8_decode($pvMoyenne[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvRang[$section]),1,0,'C',true);
			$this->Cell(15,5,utf8_decode($pvAppr[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvCote[$section]),1,0,'C',true);
			$this->Cell(40,5,utf8_decode($pvObserv[$section]),1,0,'C',true);
			$this->Ln(5);
			$a = 1;
			$this->SetFont('Times','',9);
			for($i=0;$i<count($_SESSION['eleve2']);$i++){
				$rneEleve = utf8_decode($_SESSION['eleve2'][$i]['rne']);
				$nomEleve = utf8_decode(stripslashes(substr($_SESSION['eleve2'][$i]['nom_eleve'],0,28)));
				$sexeEleve = utf8_decode($_SESSION['eleve2'][$i]['sexe']);
				$moyenneEleve = $_SESSION['eleve2'][$i]['moyenne'];
				$rankEleve = $_SESSION['eleve2'][$i]['rang'];
				$apprEleve = $_SESSION['eleve2'][$i]['appreciation'];
				$coteEleve = $_SESSION['eleve2'][$i]['cote'];
				$this->Cell(10,5,utf8_decode($a),1,0,'C');
				$this->Cell(20,5,$rneEleve,1,0,'C');
				$this->Cell(55,5,$nomEleve,1,0,'L');
				$this->Cell(10,5,$sexeEleve,1,0,'C');
				$this->SetFont('Times','B',9);
				$this->Cell(15,5,$moyenneEleve,1,0,'C',true);
				$this->SetFont('Times','',9);
				$this->Cell(10,5,$rankEleve,1,0,'C');
				$this->Cell(15,5,$apprEleve,1,0,'C');
				$this->Cell(10,5,$coteEleve,1,0,'C');
				$this->Cell(40,5,utf8_decode(''),1,0,'C');
				$this->Ln(5);
				$a++;
			}
			$ville = $_SESSION['information']['ville'];
			$faitA['fr'] = 'Fait à '.strtoupper($ville).', le __________________.';
			$faitA['en'] = 'Done at '.strtoupper($ville).', the __________________.';
			$signataire['fr'] = $_SESSION['information']['signataire_fr'];
			$signataire['en'] = $_SESSION['information']['signataire_en'];
			$this->Ln(2);
			$this->Cell(125);
			$this->Cell(60,5, utf8_decode($faitA[$section]),0,0,'R');
			$this->Ln(5);
			$this->Cell(125);
			$this->SetFont('Times','BI',9);
			$this->Cell(60,5,utf8_decode($signataire[$section]),0,0,'C');
		}









		public function pvTrimestrielMerite($section){
			$this->addPage();
			$this->Entete();
			if($_SESSION['trimestre']==1){
				$titreTrimestre['fr'] = 'Premier Trimestre';
				$titreTrimestre['en'] = 'First Term';
			}elseif($_SESSION['trimestre']==2){
				$titreTrimestre['fr'] = 'Deuxieme Trimestre';
				$titreTrimestre['en'] = 'Second Term';
			}elseif($_SESSION['trimestre']==3){
				$titreTrimestre['fr'] = 'Troisieme Trimestre';
				$titreTrimestre['en'] = 'Third Term';
			}
			$titre['fr'] = "Proces Verbal du ".$titreTrimestre['fr'];
			$titre['en'] = "report of the ".$titreTrimestre['en'];
			$classe['fr'] = "Classe : ".strtoupper($_SESSION['nom_classe']);
			$classe['en'] = "Class : ".strtoupper($_SESSION['nom_classe']);
			$effectifClasse['fr'] = 'Effectif : '.count($_SESSION['eleve']);
			$effectifClasse['en'] = 'Roll : '.count($_SESSION['eleve']);
			$effectifEvalue['fr'] = 'Evalués : '.$_SESSION['eleve'][0]['classes'];
			$effectifEvalue['en'] = 'Evaluated : '.$_SESSION['eleve'][0]['classes'];

			$this->Titre($titre[$section]);

			$this->SetFont('Times','B',12);
			$this->Cell(85,5,utf8_decode($classe[$section]),0,0,'L');
			$this->Cell(35,5,utf8_decode($effectifClasse[$section]),0,0,'C');
			$this->Cell(35,5,utf8_decode($effectifEvalue[$section]),0,0,'C');
			$this->Ln(5);

			// Construction du tableau Informationnel statistique
			$libelle['fr'] = 'Libellé';
			$libelle['en'] = 'Title';
			$feminin['fr'] = 'Féminin';
			$feminin['en'] = 'Female';
			$masculin['fr'] = 'Masculin';
			$masculin['en'] = 'Male';
			$total['fr'] = 'Total';
			$total['en'] = 'Global';
			$moyennes['fr'] = 'Moyennes';
			$moyennes['en'] = 'Averages';
			$sousMoyennes['fr'] = 'Sous - Moyennes';
			$sousMoyennes['en'] = 'Sub - Averages';
			$moyenneGenerale['fr'] = 'Moyenne Générale';
			$moyenneGenerale['en'] = 'General Average';
			$taux['fr'] = 'Taux Réussite';
			$taux['en'] = 'Percentage';
			$forteMoy['fr'] = 'Forte Moyenne';
			$forteMoy['en'] = 'Max Average';
			$faibleMoy['fr'] = 'Faible Moyenne';
			$faibleMoy['en'] = 'Low Average';
			$this->Cell(55,8,'',0,0,'C');
			$this->Cell(35,8,utf8_decode($libelle[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($feminin[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($masculin[$section]),1,0,'C',true);
			$this->Cell(20,8,utf8_decode($total[$section]),1,0,'C',true);
			$this->Ln(8);
			$this->Cell(55);
			$this->SetFont('Times','',10);
			$this->Cell(35,8,utf8_decode($moyennes[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['moyTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($sousMoyennes[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['sousMoyTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($moyenneGenerale[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenFille'],0,5)),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenMasc'],0,5)),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['moyGenTotal'],0,5)),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($taux[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxFille'],0,5).' %'),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxMasc'],0,5).' %'),1,0,'C');
			$this->Cell(20,8,utf8_decode(substr($_SESSION['statistique']['tauxTotal'],0,5).' %'),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($forteMoy[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteForteTotal']),1,0,'C');
			$this->Ln(8);
			$this->Cell(55);
			$this->Cell(35,8,utf8_decode($faibleMoy[$section]),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleFille']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleMasc']),1,0,'C');
			$this->Cell(20,8,utf8_decode($_SESSION['statistique']['noteFaibleTotal']),1,0,'C');
			$this->Ln(10);

			// Informations du PV 
			$pvNumber['fr'] = 'N°';
			$pvNumber['en'] = 'N°';
			$pvMatricule['fr'] = 'Matricule';
			$pvMatricule['en'] = 'Identifier';
			$pvNom['fr'] = 'Noms et Prénoms';
			$pvNom['en'] = 'Student Name';
			$pvSexe['fr'] = 'Sexe';
			$pvSexe['en'] = 'Sex';
			$pvMoyenne['fr'] = 'Moyenne';
			$pvMoyenne['en'] = 'Average';
			$pvRang['fr'] = 'Rang';
			$pvRang['en'] = 'Rank';
			$pvAppr['fr'] = 'Appréc.';
			$pvAppr['en'] = 'Grade';
			$pvCote['fr'] = 'Cote';
			$pvCote['en'] = 'Cote';
			$pvObserv['fr'] = 'Observations';
			$pvObserv['en'] = 'Observations';
			$this->SetFont('Times','B',8);
			$this->Cell(10,5,utf8_decode($pvNumber[$section]	),1,0,'C',true);
			$this->Cell(20,5,utf8_decode($pvMatricule[$section]),1,0,'C',true);
			$this->Cell(55,5,utf8_decode($pvNom[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvSexe[$section]),1,0,'C',true);
			$this->Cell(15,5,utf8_decode($pvMoyenne[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvRang[$section]),1,0,'C',true);
			$this->Cell(15,5,utf8_decode($pvAppr[$section]),1,0,'C',true);
			$this->Cell(10,5,utf8_decode($pvCote[$section]),1,0,'C',true);
			$this->Cell(40,5,utf8_decode($pvObserv[$section]),1,0,'C',true);
			$this->Ln(5);
			$a = 1;
			$this->SetFont('Times','',9);
			for($i=0;$i<count($_SESSION['eleve2']);$i++){
				$rneEleve = utf8_decode($_SESSION['eleve2'][$i]['rne']);
				$nomEleve = utf8_decode(stripslashes(substr($_SESSION['eleve2'][$i]['nom_eleve'],0,28)));
				$sexeEleve = utf8_decode($_SESSION['eleve2'][$i]['sexe']);
				$moyenneEleve = $_SESSION['eleve2'][$i]['moyenne'];
				$rankEleve = $_SESSION['eleve2'][$i]['rang'];
				$apprEleve = $_SESSION['eleve2'][$i]['appreciation'];
				$coteEleve = $_SESSION['eleve2'][$i]['cote'];
				$this->Cell(10,5,utf8_decode($a),1,0,'C');
				$this->Cell(20,5,$rneEleve,1,0,'C');
				$this->Cell(55,5,$nomEleve,1,0,'L');
				$this->Cell(10,5,$sexeEleve,1,0,'C');
				$this->SetFont('Times','B',9);
				$this->Cell(15,5,$moyenneEleve,1,0,'C',true);
				$this->SetFont('Times','',9);
				$this->Cell(10,5,$rankEleve,1,0,'C');
				$this->Cell(15,5,$apprEleve,1,0,'C');
				$this->Cell(10,5,$coteEleve,1,0,'C');
				$this->Cell(40,5,utf8_decode(''),1,0,'C');
				$this->Ln(5);
				$a++;
			}
			$ville = $_SESSION['information']['ville'];
			$faitA['fr'] = 'Fait à '.strtoupper($ville).', le __________________.';
			$faitA['en'] = 'Done at '.strtoupper($ville).', the __________________.';
			$signataire['fr'] = $_SESSION['information']['signataire_fr'];
			$signataire['en'] = $_SESSION['information']['signataire_en'];
			$this->Ln(2);
			$this->Cell(125);
			$this->Cell(60,5, utf8_decode($faitA[$section]),0,0,'R');
			$this->Ln(5);
			$this->Cell(125);
			$this->SetFont('Times','BI',9);
			$this->Cell(60,5,utf8_decode($signataire[$section]),0,0,'C');
		}




		public function bulletinSequentiel($eleve, $section){
			$this->addPage();
			$this->Entete();
			if($_SESSION['sequence']==1){
				$titreSequence['fr'] = 'Premiere Sequence';
				$titreSequence['en'] = 'First Sequence';
			}elseif($_SESSION['sequence']==2){
				$titreSequence['fr'] = 'Deuxieme Sequence';
				$titreSequence['en'] = 'Second Sequence';
			}elseif($_SESSION['sequence']==3){
				$titreSequence['fr'] = 'Troisieme Sequence';
				$titreSequence['en'] = 'Third Sequence';
			}elseif($_SESSION['sequence']==4){
				$titreSequence['fr'] = 'Quatrieme Sequence';
				$titreSequence['en'] = 'Fourth Sequence';
			}elseif($_SESSION['sequence']==5){
				$titreSequence['fr'] = 'Cinquieme Sequence';
				$titreSequence['en'] = 'Fifth Sequence';
			}elseif($_SESSION['sequence']==6){
				$titreSequence['fr'] = 'Sixieme Sequence';
				$titreSequence['en'] = 'Sixth Sequence';
			}
			// On met le titre du document 
			$titre['fr'] = "Bulletin de Notes de la ".$titreSequence['fr'];
			$titre['en'] = "Reported marks of the ".$titreSequence['en'];
			$this->SetFont('Times','BUI',14);
			$this->Text(40,75,strtoupper(utf8_decode($titre[$section])));

			$this->SetFont('Times','',10);
			$lib_nom['fr'] = 'Noms et Prénoms : ';
			$lib_nom['en'] = 'Student Name :';
			$lib_classe['fr'] = 'Classe de  : ';
			$lib_classe['en'] = 'Class  : ';
			$lib_matricule['fr'] = 'Matricule. : ';
			$lib_matricule['en'] = 'Identifier. : ';
			$lib_effectif['fr'] = 'Effectif Classe : ';
			$lib_effectif['en'] = 'Roll : ';
			$lib_dateNaissance['fr'] = 'Date de Naissance : ';
			$lib_dateNaissance['en'] = 'Date of birth : ';
			$lib_lieuNaissance['fr'] = 'à : ';
			$lib_lieuNaissance['en'] = 'at : ';
			$lib_sexe['fr'] = 'Sexe : ';
			$lib_sexe['en'] = 'Sex : ';
			$lib_redoublant['fr'] = 'Redoublant : ';
			$lib_redoublant['en'] = 'Repeater : ';
			$lib_titulaire['fr'] = 'Professeur Principal : ';
			$lib_titulaire['en'] = 'Class Principal : ';
			$this->Text(20,85,utf8_decode($lib_nom[$section]));
			$this->Text(120,85,utf8_decode($lib_classe[$section]));
			$this->Text(20,90,utf8_decode($lib_matricule[$section]));
			$this->Text(120,90,utf8_decode($lib_effectif[$section]));
			$this->Text(20,95,utf8_decode($lib_dateNaissance[$section]));
			$this->Text(100,95,utf8_decode($lib_lieuNaissance[$section]));
			$this->Text(20,100,utf8_decode($lib_sexe[$section]));
			$this->Text(50,100,utf8_decode($lib_redoublant[$section]));
			$this->Text(100,100,utf8_decode($lib_titulaire[$section]));

			$this->SetFont('Times','B',10);
			$nom = substr($eleve['nom_eleve'],0,30);
			$nomClasse = strtoupper($_SESSION['nom_classe']);
			$matricule = $eleve['rne'];
			$effectif = $_SESSION['effectif'];
			$dateNaissance = $eleve['date_fr'];
			$lieuNaissance = $eleve['lieu_naissance'];
			$sexe = $eleve['sexe'];
			$redoublant = $eleve['statut'];
			$titulaire = ''; /*$_SESSION['professeurPrincipal'];*/
			$image =$eleve['photo'];
			$this->Text(50,85,utf8_decode($nom));
			$this->Text(140,85,utf8_decode($nomClasse));
			$this->Text(40,90,utf8_decode($matricule));
			$this->Text(150,90,utf8_decode($effectif));
			$this->Text(55,95,utf8_decode($dateNaissance));
			$this->Text(105,95,utf8_decode($lieuNaissance));
			$this->Text(30,100,utf8_decode($sexe));
			$this->Text(70,100,utf8_decode($redoublant));
			$this->Text(135,100,utf8_decode($titulaire));
			$this->Image($image, 170, 77, 22, 22);

			// On créé un espace supplémentaire entre le tableau et les info du haut
			$this->Ln(40);
			$this->SetFont('Times','B',8);
			$bullMatiere['fr'] = 'Matière';
			$bullMatiere['en'] = 'Subject';
			$bullCompetence['fr'] = 'Competence';
			$bullCompetence['en'] = 'Skill';
			$bullNote['fr'] = 'Note /20';
			$bullNote['en'] = 'Mark /20';
			$bullCoef['fr'] = 'Coef';
			$bullCoef['en'] = 'Coef';
			$bullProduit['fr'] = 'Produit';
			$bullProduit['en'] = 'Product';
			$bullMinMax['fr'] = 'Min - Max';
			$bullMinMax['en'] = 'Min - Max';
			$bullAppr['fr'] = 'Appréciation';
			$bullAppr['en'] = 'Grade';
			$bullCote['fr'] = 'Cote';
			$bullCote['en'] = 'Cote';
			$bullParaphe['fr'] = 'Paraphe Ens.';
			$bullParaphe['en'] = 'Teacher Obs.';
			$this->Cell(8);
			$this->Cell(40,5, utf8_decode($bullMatiere[$section]),1,0,'C',true);
			$this->Cell(35,5, utf8_decode($bullCompetence[$section]),1,0,'C',true);
			$this->Cell(12,5, utf8_decode($bullNote[$section]),1,0,'C',true);
			$this->Cell(10,5, utf8_decode($bullCoef[$section]),1,0,'C',true);
			$this->Cell(15,5, utf8_decode($bullProduit[$section]),1,0,'C',true);
			$this->Cell(18,5, utf8_decode($bullMinMax[$section]),1,0,'C',true);
			// $this->Cell(10,5, utf8_decode('Max'),1,0,'C',true);
			$this->Cell(22,5, utf8_decode($bullAppr[$section]),1,0,'C',true);
			$this->Cell(10,5, utf8_decode($bullCote[$section]),1,0,'C',true);
			$this->Cell(20,5, utf8_decode($bullParaphe[$section]),1,0,'C',true);
			$this->SetFont('Times','',8);
			$this->Ln(5);
			// On ressort une boucle qui liste les groupes définis
			for($b=0;$b<count($_SESSION['groupe']);$b++){
				$codeGroupe = $_SESSION['groupe'][$b]['code_groupe'];
				$idGroupe = $_SESSION['groupe'][$b]['groupe'];
				$nomGroupe = $_SESSION['groupe'][$b]['nom_groupe'];
				$matieresGroupe = $_SESSION['matiereGroupe'][$idGroupe];
				for($c=0;$c<count($matieresGroupe);$c++){
					$codeMatiere = $matieresGroupe[$c]['code_matiere'];
					$competence = strtolower($codeMatiere.'_competence');
					$sekence = strtolower($codeMatiere.'_seq');
					$coef = strtolower($codeMatiere.'_coef');
					$produit = strtolower($codeMatiere.'_total');
					$min = strtolower($codeMatiere.'_min');
					$max = strtolower($codeMatiere.'_max');
					$appr = strtolower($codeMatiere.'_appreciation');
					$cote = strtolower($codeMatiere.'_cote');
					$enseignant = strtolower($codeMatiere.'_enseignant');
					$nomMatiere = strtoupper($matieresGroupe[$c]['nom_matiere']);
					// $this->Cell(12,6, utf8_decode($eleve[$a][$seq1]),1,0,'C');
					// $this->SetFont('Times','B',8);
					$this->Cell(8);
					$this->Cell(40,3, substr($nomMatiere,0,23),'TLR',0,'L');
							
					$this->SetFont('Times','',5);
					$competenceEvaluee = strtolower(utf8_decode(substr($eleve[$competence],0,45)));
					$minMax = "[".$eleve[$min]." - ".$eleve[$max]."]";
					$this->Cell(35,6, $competenceEvaluee,1,0,'L');
					$this->SetFont('Times','',8);
					$this->Cell(12,6, utf8_decode($eleve[$sekence]),1,0,'C');
					$this->Cell(10,6, utf8_decode($eleve[$coef]),1,0,'C');
					$this->SetFont('Times','B',8);
					$this->Cell(15,6, utf8_decode($eleve[$produit]),1,0,'C',true);
					$this->SetFont('Times','',8);
					$this->Cell(18,6, $minMax,1,0,'C');
					// $this->Cell(10,6, utf8_decode($eleve[$a][$max]),1,0,'C');
					$this->Cell(22,6, utf8_decode($eleve[$appr]),1,0,'C');
					$this->Cell(10,6, utf8_decode($eleve[$cote]),1,0,'C');
					$this->Cell(20,6, utf8_decode(''),1,0,'C');
					$this->SetFont('Times','',8);
					// $this->Ln(6);
					$this->Ln(3);
					$this->SetFont('Times','I',7);
					$this->Cell(8);
					$this->Cell(40,3, utf8_decode($eleve[$enseignant]),'LRB',0,'L');
					/*$this->SetFont('Times','',7);
					$this->Cell(35,3, utf8_decode(substr($eleve[$a][$competence],20,35)),1,0,'L');*/
					$this->Ln(3);
					$this->SetFont('Times','',8);
				}
				$this->Cell(8);
				$this->SetFont('Times','B',8);
				$moyenneGroupe = $codeGroupe.'_moyenne';
				$coefGroupe = $codeGroupe.'_coef';
				$totalGroupe = $codeGroupe.'_total';
				$minGroupe = $codeGroupe.'_min';
				$maxGroupe = $codeGroupe.'_max';
				$apprGroupe = $codeGroupe.'_appreciation';
				$coteGroupe = $codeGroupe.'_cote';
				$minMaxGroupe = "[".$eleve[$minGroupe]."- ".$eleve[$maxGroupe]."]";
				$texteTotalGroupe['fr'] = 'Total du Groupe ';
				$texteTotalGroupe['en'] = 'Total of the group ';
				$this->Cell(75,5, utf8_decode(strtoupper($texteTotalGroupe[$section].$nomGroupe)),1,0,'L',true);
				$this->Cell(12,5, utf8_decode(utf8_decode($eleve[$moyenneGroupe])),1,0,'C',true);
				$this->Cell(10,5, utf8_decode($eleve[$coefGroupe]),1,0,'C',true);
				$this->Cell(15,5, utf8_decode($eleve[$totalGroupe]),1,0,'C',true);
				$this->Cell(18,5, $minMaxGroupe,1,0,'C',true);
				// $this->Cell(10,5, $eleve[$a][$maxGroupe],1,0,'C',true);
				$this->Cell(22,5, $eleve[$apprGroupe],1,0,'C',true);
				$this->Cell(10,5, $eleve[$coteGroupe],1,0,'C',true);
				$this->Cell(20,5, '',1,0,'C',true);
				$this->Ln(5);
				$this->SetFont('Times','',7);
			}
			$this->SetFont('Times','B',9);
			$txtTotal['fr'] = 'TOTAL';
			$txtTotal['en'] = 'TOTAL';
			$txtMoy['fr'] = 'Moyenne Obtenue';
			$txtMoy['en'] = 'Average';
			$txtDiscipline['fr'] = 'Discipline';
			$txtDiscipline['en'] = 'Discipline';
			$txtTravail['fr'] = 'Travail';
			$txtTravail['en'] = 'Work';
			$txtProfil['fr'] = 'Profil de la Classe';
			$txtProfil['en'] = 'Class Profile';
			$absNJust['fr'] = 'Abs Non Just.';
			$absNJust['en'] = 'Abs Not Just.';
			$avc['fr'] = 'Avert. Cond.';
			$avc['en'] = 'Avert. Cond.';
			$totalGen['fr'] = 'Total Gén.';
			$totalGen['en'] = 'Global';
			$appreci['fr'] = 'Appréciation';
			$appreci['en'] = 'Grade';
			$moyenneClasse['fr'] = 'Moyenne Générale';
			$moyenneClasse['en'] = 'Class Average';
			$absJust['fr'] = 'Abs Just.';
			$absJust['en'] = 'Abs Just.';
			$bc['fr'] = 'Blâme. Cond.';
			$bc['en'] = 'Blâme. Cond.';
			$ret['fr'] = 'Retards';
			$ret['en'] = 'Retards';
			$exclusion['fr'] = 'Exclusions';
			$exclusion['en'] = 'Exclusions';
			$moyenneEleve['fr'] = 'Moyenne';
			$moyenneEleve['en'] = 'Average';
			$nbMoyenne['fr'] = 'Nb Moyennes';
			$nbMoyenne['en'] = 'Nb Aver.';
			$consigne['fr'] = 'Consignes';
			$consigne['en'] = 'Consignes';
			$exclusionDef['fr'] = 'Excl. Déf.';
			$exclusionDef['en'] = 'Excl. Déf.';
			$coteEleve['fr'] = 'Côte';
			$coteEleve['en'] = 'Cote';
			$taux['fr'] = 'Taux de Réussite';
			$taux['en'] = 'Percentage';
			$rank['fr'] = 'Rang';
			$rank['en'] = 'Rank';
			$ville = $_SESSION['information']['ville'];
			$faitA['fr'] = 'Fait à '.strtoupper($ville).' le ________________';
			$faitA['en'] = 'Done at '.strtoupper($ville).' the ________________';
			$parent['fr'] = 'Le Parent';
			$parent['en'] = 'The Parent';
			$pp['fr'] = 'Le Professeur Principal';
			$pp['en'] = 'The Class Principal';
			$signataire['fr'] = $_SESSION['information']['signataire_fr'];
			$signataire['en'] = $_SESSION['information']['signataire_en'];

			$this->Ln(1);
			$this->Cell(8);
			$this->Cell(87,5, utf8_decode($txtTotal[$section]),1,0,'C',true);
			// $this->Cell(12,6, utf8_decode($eleve[$a]['moyenne']),1,0,'C',true);
			$this->Cell(10,5, utf8_decode($eleve['total_coef']),1,0,'C',true);
			$this->Cell(15,5, utf8_decode($eleve['total_point']),1,0,'C',true);
			$this->Cell(35,5, utf8_decode($txtMoy[$section]),1,0,'C',true);
			$this->Cell(25,5, utf8_decode(ucwords($eleve['moyenne'])),1,0,'L',true);
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(53,6,utf8_decode($txtDiscipline[$section]), 1,0,'C',true);
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(53,6,utf8_decode($txtTravail[$section]), 1,0,'C',true);
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(53,6,utf8_decode($txtProfil[$section]), 1,0,'C',true);
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(20,6,utf8_decode($absNJust[$section]), 1,0,'C');
			$this->Cell(6,6,utf8_decode(''), 1,0,'C');
			$this->Cell(20,6,utf8_decode($avc[$section]), 1,0,'C');
			$this->Cell(7,6,utf8_decode(''), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(17,6,utf8_decode($totalGen[$section]), 1,0,'C');
			$this->Cell(10,6,utf8_decode($eleve['total_point']), 1,0,'C');
			$this->Cell(26,6,utf8_decode($appreci[$section]), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(30,6,utf8_decode($moyenneClasse[$section]), 1,0,'C');
			$this->Cell(23,6,$_SESSION['statistique']['moyGenTotal'], 1,0,'C');
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(20,6,utf8_decode($absJust[$section]), 1,0,'C');
			$this->Cell(6,6,utf8_decode(''), 1,0,'C');
			$this->Cell(20,6,utf8_decode($bc[$section]), 1,0,'C');
			$this->Cell(7,6,utf8_decode(''), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(17,6,utf8_decode('Coef'), 1,0,'C');
			$this->Cell(10,6,utf8_decode($eleve['total_coef']), 1,0,'C');
			$this->Cell(26,6,utf8_decode($eleve['appreciation']), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$minMax = "[ ".$_SESSION['statistique']['noteFaibleTotal'];
			$minMax .= " - ".$_SESSION['statistique']['noteForteTotal'];
			$minMax .= " ]";
			$this->Cell(30,6,utf8_decode('[Min - Max]'), 1,0,'C');
			$this->Cell(23,6,$minMax, 1,0,'C');
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(20,6,utf8_decode($ret[$section]), 1,0,'C');
			$this->Cell(6,6,utf8_decode(''), 1,0,'C');
			$this->Cell(20,6,utf8_decode($exclusion[$section]), 1,0,'C');
			$this->Cell(7,6,utf8_decode(''), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(27,6,utf8_decode($moyenneEleve[$section]), 1,0,'C');
			$this->Cell(26,6,utf8_decode($eleve['moyenne']), 1,0,'C');
			// $this->Cell(26,6,'', 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(30,6,utf8_decode($nbMoyenne[$section]), 1,0,'C');
			$this->Cell(23,6,$_SESSION['statistique']['moyTotal'], 1,0,'C');
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(20,6,utf8_decode($consigne[$section]), 1,0,'C');
			$this->Cell(6,6,utf8_decode(''), 1,0,'C');
			$this->Cell(20,6,utf8_decode($exclusionDef[$section]), 1,0,'C');
			$this->Cell(7,6,utf8_decode(''), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(27,6,utf8_decode($coteEleve[$section]), 1,0,'C');
			$this->Cell(26,6,utf8_decode($eleve['cote']), 1,0,'C');
			// $this->Cell(26,6,'', 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(30,6,utf8_decode($taux[$section]), 1,0,'C');
			$this->Cell(23,6,$_SESSION['statistique']['tauxTotal'].' %', 1,0,'C');
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(46,6,utf8_decode(''), 0,0,'C');
			$this->Cell(7,6,utf8_decode(''), 0,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(27,6,$rank[$section], 1,0,'C');
			$rangEleve = utf8_decode($eleve['rang']).' / '.$eleve['classes'];
			$this->Cell(26,6,$rangEleve, 1,0,'C');
			$this->Cell(5, 6, '',0,0,'C');
			$this->Cell(53,6,utf8_decode(''), 0,0,'C');
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(46,6,utf8_decode(''), 0,0,'C');
			$this->Cell(7,6,utf8_decode(''), 0,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(27,6,'', 0,0,'C');
			$this->Cell(26,6,'', 0,0,'C');
			$this->Cell(5, 6, '',0,0,'C');
			$this->Cell(53,6,utf8_decode($faitA[$section]), 0,0,'C');
			$this->Ln(3);
			$this->Cell(8);

			$this->Cell(46,6,utf8_decode($parent[$section]), 0,0,'C');
			$this->Cell(7,6,utf8_decode(''), 0,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(53,6,$pp[$section], 0,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(53,6,$signataire[$section], 0,0,'C');
			$this->Ln(6);
			$this->Cell(8);
			$this->SetFont('Times','B',9);
		}









		public function bulletinTrimestriel($eleve, $section){
			$this->addPage();
			$this->Entete();
			if($_SESSION['trimestre']==1){
				$titreTrimestre['fr'] = 'Premier Trimestre';
				$titreTrimestre['en'] = 'First Term';
			}elseif($_SESSION['trimestre']==2){
				$titreTrimestre['fr'] = 'Deuxieme Trimestre';
				$titreTrimestre['en'] = 'Second Term';
			}elseif($_SESSION['trimestre']==3){
				$titreTrimestre['fr'] = 'Troisieme Trimestre';
				$titreTrimestre['en'] = 'Third Term';
			}
			// On met le titre du document 
			$titre['fr'] = "Bulletin de Notes du ".$titreTrimestre['fr'];
			$titre['en'] = "Reported marks of the ".$titreTrimestre['en'];
			$this->SetFont('Times','BUI',14);
			$this->Text(40,75,strtoupper(utf8_decode($titre[$section])));

			$this->SetFont('Times','',10);
			$lib_nom['fr'] = 'Noms et Prénoms : ';
			$lib_nom['en'] = 'Student Name :';
			$lib_classe['fr'] = 'Classe de  : ';
			$lib_classe['en'] = 'Class  : ';
			$lib_matricule['fr'] = 'Matricule. : ';
			$lib_matricule['en'] = 'Identifier. : ';
			$lib_effectif['fr'] = 'Effectif Classe : ';
			$lib_effectif['en'] = 'Roll : ';
			$lib_dateNaissance['fr'] = 'Date de Naissance : ';
			$lib_dateNaissance['en'] = 'Date of birth : ';
			$lib_lieuNaissance['fr'] = 'à : ';
			$lib_lieuNaissance['en'] = 'at : ';
			$lib_sexe['fr'] = 'Sexe : ';
			$lib_sexe['en'] = 'Sex : ';
			$lib_redoublant['fr'] = 'Redoublant : ';
			$lib_redoublant['en'] = 'Repeater : ';
			$lib_titulaire['fr'] = 'Professeur Principal : ';
			$lib_titulaire['en'] = 'Class Principal : ';
			$this->Text(40,85,utf8_decode($lib_nom[$section]));
			$this->Text(140,85,utf8_decode($lib_classe[$section]));
			$this->Text(40,90,utf8_decode($lib_matricule[$section]));
			$this->Text(140,90,utf8_decode($lib_effectif[$section]));
			$this->Text(40,95,utf8_decode($lib_dateNaissance[$section]));
			$this->Text(120,95,utf8_decode($lib_lieuNaissance[$section]));
			$this->Text(40,100,utf8_decode($lib_sexe[$section]));
			$this->Text(70,100,utf8_decode($lib_redoublant[$section]));
			$this->Text(120,100,utf8_decode($lib_titulaire[$section]));

			$this->SetFont('Times','B',10);
			$nom = substr($eleve['nom_eleve'],0,30);
			$nomClasse = substr(strtoupper($_SESSION['nom_classe']),0,30);
			$matricule = $eleve['rne'];
			$effectif = $_SESSION['effectif'];
			$dateNaissance = $eleve['date_fr'];
			$lieuNaissance = $eleve['lieu_naissance'];
			$sexe = $eleve['sexe'];
			$redoublant = $eleve['statut'];
			$titulaire = substr($eleve['titulaire'],0,20);
			$image =$eleve['photo'];
			$this->Text(70,85,utf8_decode($nom));
			$this->Text(160,85,utf8_decode($nomClasse));
			$this->Text(60,90,utf8_decode($matricule));
			$this->Text(170,90,utf8_decode($effectif));
			$this->Text(75,95,utf8_decode($dateNaissance));
			$this->Text(125,95,utf8_decode($lieuNaissance));
			$this->Text(50,100,utf8_decode($sexe));
			$this->Text(90,100,utf8_decode($redoublant));
			$this->Text(155,100,utf8_decode($titulaire));
			$this->Image($image, 15, 77, 22, 22);

			// On créé un espace supplémentaire entre le tableau et les info du haut
			$this->Ln(40);
			$this->SetFont('Times','B',8);
			$bullMatiere['fr'] = 'Matière';
			$bullMatiere['en'] = 'Subject';
			$bullCompetence['fr'] = 'Compétences évaluées';
			$bullCompetence['en'] = 'Skills evaluated';
			$bullNote['fr'] = 'N /20';
			$bullNote['en'] = 'M/20';
			$bullNoteTri['fr'] = 'M/20';
			$bullNoteTri['en'] = 'A/20';
			$bullCoef['fr'] = 'Coef';
			$bullCoef['en'] = 'Coef';
			$bullProduit['fr'] = 'M x Coef';
			$bullProduit['en'] = 'A x Coef';
			$bullMinMax['fr'] = 'Min - Max';
			$bullMinMax['en'] = 'Min - Max';
			$bullAppr['fr'] = 'Appréciation';
			$bullAppr['en'] = 'Grade';
			$bullCote['fr'] = 'Cote';
			$bullCote['en'] = 'Cote';
			$bullParaphe['fr'] = 'Paraphe Ens.';
			$bullParaphe['en'] = 'Teacher Obs.';
			$this->Cell(8);
			$this->Cell(40,5, utf8_decode($bullMatiere[$section]),1,0,'C',true);
			$this->Cell(35,5, utf8_decode($bullCompetence[$section]),1,0,'C',true);
			$this->Cell(12,5, utf8_decode($bullNote[$section]),1,0,'C',true);
			$this->Cell(12,5, utf8_decode($bullNoteTri[$section]),1,0,'C',true);
			$this->Cell(10,5, utf8_decode($bullCoef[$section]),1,0,'C',true);
			$this->Cell(15,5, utf8_decode($bullProduit[$section]),1,0,'C',true);
			$this->Cell(10,5, utf8_decode($bullCote[$section]),1,0,'C',true);
			$this->Cell(18,5, utf8_decode($bullMinMax[$section]),1,0,'C',true);
			// $this->Cell(10,5, utf8_decode('Max'),1,0,'C',true);
			// $this->Cell(22,5, utf8_decode($bullAppr[$section]),1,0,'C',true);
			$this->Cell(20,5, utf8_decode($bullParaphe[$section]),1,0,'C',true);
			$this->SetFont('Times','',8);
			$this->Ln(5);
			// // On ressort une boucle qui liste les groupes définis
			for($b=0;$b<count($_SESSION['groupe']);$b++){
				$codeGroupe = $_SESSION['groupe'][$b]['code_groupe'];
				$idGroupe = $_SESSION['groupe'][$b]['groupe'];
				$nomGroupe = $_SESSION['groupe'][$b]['nom_groupe'];
				$matieresGroupe = $_SESSION['matiereGroupe'][$idGroupe];
				for($c=0;$c<count($matieresGroupe);$c++){
					$codeMatiere = $matieresGroupe[$c]['code_matiere'];
					$competence_a = strtolower($codeMatiere.'_competence_a');
					$competence_b = strtolower($codeMatiere.'_competence_b');
					$sekence1 = strtolower($codeMatiere.'_seq1');
					$sekence2 = strtolower($codeMatiere.'_seq2');
					$trimestr = strtolower($codeMatiere.'_trim');
					$coef = strtolower($codeMatiere.'_coef');
					$competenceEvalueeA = strtolower(utf8_decode(substr($eleve[$competence_a],0,45)));
					$competenceEvalueeB = strtolower(utf8_decode(substr($eleve[$competence_b],0,45)));
					$cote = strtolower($codeMatiere.'_cote');
					$produit = strtolower($codeMatiere.'_total');
					$min = strtolower($codeMatiere.'_min');
					$max = strtolower($codeMatiere.'_max');
				// 	$appr = strtolower($codeMatiere.'_appreciation');
				// 	
					$enseignant = strtolower($codeMatiere.'_enseignant');
					$nomMatiere = strtoupper($matieresGroupe[$c]['nom_matiere']);
					$this->Cell(8);
					$this->Cell(40,3, substr($nomMatiere,0,23),'LRT',0,'L');
					$this->Cell(35,3, stripslashes(substr($competenceEvalueeA,0,30)),'LRT',0,'L');
					$this->Cell(12,3, utf8_decode($eleve[$sekence1]),1,0,'C');
					$this->Cell(12,6, utf8_decode($eleve[$trimestr]),1,0,'C');
					$this->Cell(10,6, utf8_decode($eleve[$coef]),1,0,'C');
					$this->Cell(15,6, utf8_decode($eleve[$produit]),1,0,'C',true);
					$this->Cell(10,6, utf8_decode($eleve[$cote]),1,0,'C');
					$minMax = "[".$eleve[$min]." - ".$eleve[$max]."]";
					$this->Cell(18,6, $minMax,1,0,'C');
					$this->Cell(20,6, utf8_decode(''),1,0,'C');
							
					$this->SetFont('Times','',5);
					
				// 	$minMax = "[".$eleve[$min]." - ".$eleve[$max]."]";
					// $this->Cell(35,6, $competenceEvalueeA,1,0,'L');
				// 	$this->SetFont('Times','',8);
				// 	$this->Cell(12,6, utf8_decode($eleve[$sekence]),1,0,'C');
				// 	$this->Cell(10,6, utf8_decode($eleve[$coef]),1,0,'C');
				// 	$this->SetFont('Times','B',8);
				// 	$this->Cell(15,6, utf8_decode($eleve[$produit]),1,0,'C',true);
				// 	$this->SetFont('Times','',8);
				// 	$this->Cell(18,6, $minMax,1,0,'C');
				// 	// $this->Cell(10,6, utf8_decode($eleve[$a][$max]),1,0,'C');
				// 	$this->Cell(22,6, utf8_decode($eleve[$appr]),1,0,'C');
				// 	$this->Cell(10,6, utf8_decode($eleve[$cote]),1,0,'C');
				// 	$this->Cell(20,6, utf8_decode(''),1,0,'C');
					$this->SetFont('Times','',8);
				// 	// $this->Ln(6);
					$this->Ln(3);
					$this->SetFont('Times','I',7);
					$this->Cell(8);
					$this->Cell(40,3, utf8_decode($eleve[$enseignant]),'LRB',0,'L');
					$this->SetFont('Times','',7);
					$this->Cell(35,3, stripslashes(substr($competenceEvalueeB,0,28)),1,0,'L');
					$this->Cell(12,3, utf8_decode($eleve[$sekence2]),1,0,'C');
				// 	/*$this->SetFont('Times','',7);
				// 	$this->Cell(35,3, utf8_decode(substr($eleve[$a][$competence],20,35)),1,0,'L');*/
					$this->Ln(3);
					$this->SetFont('Times','',8);
				}
				$this->Cell(8);
				$this->SetFont('Times','B',8);
				$moyenneGroupe = $codeGroupe.'_moyenne';
				$coefGroupe = $codeGroupe.'_coef';
				$totalGroupe = $codeGroupe.'_total';
				$minGroupe = $codeGroupe.'_min';
				$maxGroupe = $codeGroupe.'_max';
				$apprGroupe = $codeGroupe.'_appreciation';
				$coteGroupe = $codeGroupe.'_cote';
				$minMaxGroupe = "[".$eleve[$minGroupe]."- ".$eleve[$maxGroupe]."]";
				$texteTotalGroupe['fr'] = 'Total de ';
				$texteTotalGroupe['en'] = 'Total of  ';
				$this->Cell(87,5, utf8_decode(strtoupper($texteTotalGroupe[$section].$nomGroupe)),1,0,'L',true);
				$this->Cell(12,5, utf8_decode(utf8_decode($eleve[$moyenneGroupe])),1,0,'C',true);
				$this->Cell(10,5, utf8_decode($eleve[$coefGroupe]),1,0,'C',true);
				$this->Cell(15,5, utf8_decode($eleve[$totalGroupe]),1,0,'C',true);
				$this->Cell(10,5, $eleve[$coteGroupe],1,0,'C',true);
				$this->Cell(18,5, $minMaxGroupe,1,0,'C',true);
				// $this->Cell(10,5, $eleve[$a][$maxGroupe],1,0,'C',true);
				// $this->Cell(22,5, $eleve[$apprGroupe],1,0,'C',true);
				
				$this->Cell(20,5, '',1,0,'C',true);
				$this->Ln(5);
				$this->SetFont('Times','',7);
			}
			$this->SetFont('Times','B',9);
			$txtTotal['fr'] = 'TOTAL';
			$txtTotal['en'] = 'TOTAL';
			$txtMoy['fr'] = 'Moyenne Obtenue';
			$txtMoy['en'] = 'Average';
			$txtDiscipline['fr'] = 'Discipline';
			$txtDiscipline['en'] = 'Discipline';
			$txtTravail['fr'] = 'Travail';
			$txtTravail['en'] = 'Work';
			$txtProfil['fr'] = 'Profil de la Classe';
			$txtProfil['en'] = 'Class Profile';
			$absNJust['fr'] = 'Abs Non Just.';
			$absNJust['en'] = 'Abs Not Just.';
			$avc['fr'] = 'Avert. Cond.';
			$avc['en'] = 'Avert. Cond.';
			$totalGen['fr'] = 'Total Gén.';
			$totalGen['en'] = 'Global';
			$appreci['fr'] = 'Appréciation';
			$appreci['en'] = 'Grade';
			$moyenneClasse['fr'] = 'Moyenne Générale';
			$moyenneClasse['en'] = 'Class Average';
			$absJust['fr'] = 'Abs Just.';
			$absJust['en'] = 'Abs Just.';
			$bc['fr'] = 'Blâme. Cond.';
			$bc['en'] = 'Blâme. Cond.';
			$ret['fr'] = 'Retards';
			$ret['en'] = 'Retards';
			$exclusion['fr'] = 'Exclusions';
			$exclusion['en'] = 'Exclusions';
			$moyenneEleve['fr'] = 'Moyenne';
			$moyenneEleve['en'] = 'Average';
			$nbMoyenne['fr'] = 'Nb Moyennes';
			$nbMoyenne['en'] = 'Nb Aver.';
			$consigne['fr'] = 'Consignes';
			$consigne['en'] = 'Consignes';
			$exclusionDef['fr'] = 'Excl. Déf.';
			$exclusionDef['en'] = 'Excl. Déf.';
			$coteEleve['fr'] = 'Côte';
			$coteEleve['en'] = 'Cote';
			$taux['fr'] = 'Taux de Réussite';
			$taux['en'] = 'Percentage';
			$rank['fr'] = 'Rang';
			$rank['en'] = 'Rank';
			$ville = $_SESSION['information']['ville'];
			$faitA['fr'] = 'Fait à '.strtoupper($ville).' le ________________';
			$faitA['en'] = 'Done at '.strtoupper($ville).' the ________________';
			$parent['fr'] = 'Le Parent';
			$parent['en'] = 'The Parent';
			$pp['fr'] = 'Le Professeur Principal';
			$pp['en'] = 'The Class Principal';
			$signataire['fr'] = $_SESSION['information']['signataire_fr'];
			$signataire['en'] = $_SESSION['information']['signataire_en'];

			$this->Ln(1);
			$this->Cell(8);
			$this->Cell(99,5, utf8_decode($txtTotal[$section]),1,0,'C',true);
			$this->Cell(10,5, utf8_decode($eleve['total_coef']),1,0,'C',true);
			$this->Cell(15,5, utf8_decode($eleve['total_point']),1,0,'C',true);
			$this->Cell(28,5, utf8_decode($txtMoy[$section]),'TBL',0,'C',true);
			$this->Cell(20,5, utf8_decode(ucwords($eleve['moyenne'])),'TRB',0,'L',true);
			
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(53,6,utf8_decode($txtDiscipline[$section]), 1,0,'C',true);
			$this->Cell(5, 6, '',0,0,'C');
			$this->Cell(53,6,utf8_decode($txtTravail[$section]), 1,0,'C',true);
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(53,6,utf8_decode($txtProfil[$section]), 1,0,'C',true);
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(20,6,utf8_decode($absNJust[$section]), 1,0,'C');
			$this->Cell(6,6,utf8_decode($eleve['absence_non_just']), 1,0,'C');
			$this->Cell(20,6,utf8_decode($avc[$section]), 1,0,'C');
			$this->Cell(7,6,utf8_decode(''), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(17,6,utf8_decode($totalGen[$section]), 1,0,'C');
			$this->Cell(10,6,utf8_decode($eleve['total_point']), 1,0,'C');
			$this->Cell(26,6,utf8_decode($appreci[$section]), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(30,6,utf8_decode($moyenneClasse[$section]), 1,0,'C');
			$this->Cell(23,6,$_SESSION['statistique']['moyGenTotal'], 1,0,'C');
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(20,6,utf8_decode($absJust[$section]), 1,0,'C');
			$this->Cell(6,6,utf8_decode($eleve['absence_just']), 1,0,'C');
			$this->Cell(20,6,utf8_decode($bc[$section]), 1,0,'C');
			$this->Cell(7,6,utf8_decode(''), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(17,6,utf8_decode('Coef'), 1,0,'C');
			$this->Cell(10,6,utf8_decode($eleve['total_coef']), 1,0,'C');
			$this->Cell(26,6,utf8_decode($eleve['appreciation']), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$minMax = "[ ".$_SESSION['statistique']['noteFaibleTotal'];
			$minMax .= " - ".$_SESSION['statistique']['noteForteTotal'];
			$minMax .= " ]";
			$this->Cell(30,6,utf8_decode('[Min - Max]'), 1,0,'C');
			$this->Cell(23,6,$minMax, 1,0,'C');
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(20,6,utf8_decode($ret[$section]), 1,0,'C');
			$this->Cell(6,6,utf8_decode(''), 1,0,'C');
			$this->Cell(20,6,utf8_decode($exclusion[$section]), 1,0,'C');
			$this->Cell(7,6,utf8_decode(''), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(27,6,utf8_decode($moyenneEleve[$section]), 1,0,'C');
			$this->Cell(26,6,utf8_decode($eleve['moyenne']), 1,0,'C');
			// $this->Cell(26,6,'', 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(30,6,utf8_decode($nbMoyenne[$section]), 1,0,'C');
			$this->Cell(23,6,$_SESSION['statistique']['moyTotal'], 1,0,'C');
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(20,6,utf8_decode($consigne[$section]), 1,0,'C');
			$this->Cell(6,6,utf8_decode(''), 1,0,'C');
			$this->Cell(20,6,utf8_decode($exclusionDef[$section]), 1,0,'C');
			$this->Cell(7,6,utf8_decode(''), 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(27,6,utf8_decode($coteEleve[$section]), 1,0,'C');
			$this->Cell(26,6,utf8_decode($eleve['cote']), 1,0,'C');
			// $this->Cell(26,6,'', 1,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(30,6,utf8_decode($taux[$section]), 1,0,'C');
			$this->Cell(23,6,$_SESSION['statistique']['tauxTotal'].' %', 1,0,'C');
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(46,6,utf8_decode(''), 0,0,'C');
			$this->Cell(7,6,utf8_decode(''), 0,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(27,6,$rank[$section], 1,0,'C');
			$rangEleve = utf8_decode($eleve['rang']).' / '.$eleve['classes'];
			$this->Cell(26,6,$rangEleve, 1,0,'C');
			$this->Cell(5, 6, '',0,0,'C');
			$this->Cell(53,6,utf8_decode(''), 0,0,'C');
			$this->Ln(6);
			$this->Cell(8);

			$this->Cell(46,6,utf8_decode(''), 0,0,'C');
			$this->Cell(7,6,utf8_decode(''), 0,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(27,6,'', 0,0,'C');
			$this->Cell(26,6,'', 0,0,'C');
			$this->Cell(5, 6, '',0,0,'C');
			$this->Cell(53,6,utf8_decode($faitA[$section]), 0,0,'C');
			$this->Ln(3);
			$this->Cell(8);

			$this->Cell(46,6,utf8_decode($parent[$section]), 0,0,'C');
			$this->Cell(7,6,utf8_decode(''), 0,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(53,6,$pp[$section], 0,0,'C');
			$this->Cell(5, 6, utf8_decode(''),0,0,'C');
			$this->Cell(53,6,$signataire[$section], 0,0,'C');
			$this->Ln(6);
			$this->Cell(8);
			$this->SetFont('Times','B',9);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		function Titre($titre){
			// On crée d'abord un espace pour gérer les informations d'entête
			$this->Ln(3);
			$this->SetFont('Times', 'B', 18);
			// Déplacer à droite
			$this->Cell(5);
			// Bordure du titre
			$this->Cell(180, 8, $this->convert(strtoupper($titre)), 0, 0 , 'C');
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