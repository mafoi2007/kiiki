<?php

define('CLASS_PATH','../../');

require_once(CLASS_PATH.'tcpdf/config/lang/eng.php');
require_once(CLASS_PATH.'tcpdf/tcpdf.php');

require_once(CLASS_PATH."label/class.label.php");



// Creation tableau de données
$data = array();

$info = 'info';

// Création d'une ligne par étiquette (nbre d'etiquettes)
for ($j=0; $j < 5; $j++){
	array_push($data,$info);
}    

// Creation de l'objet label
$pdf = new label( 1, $data , CLASS_PATH.'label/', '', true);

// Afficher les bordures
$pdf->border = true;


/*
echo "<pre>";
print_r($data);
echo "</pre>";
*/


$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ludovic RIAUDEL');
$pdf->SetTitle("Planche d'étiquettes par kiwi");
$pdf->SetSubject("Création d'étiquettes avec CAB en publipostage");

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

$pdf->SetAutoPageBreak( true, 0);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

/*************************/
// Création
$pdf->Addlabel();
/************************/
// Affichage
$pdf->Output("doc.pdf", "I");

?>