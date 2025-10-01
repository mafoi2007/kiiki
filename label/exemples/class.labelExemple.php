<?php

class labelExemple extends label{

	/**
	 * Template d'impression étiquette
	 */
	function template($x, $y, $dataPrint){

	$x += $this->labelMargin;
	$y += $this->labelMargin;
	 
		// Etiquette
		$aff_border = 0;
		$ref_font = max($this->labelWidth, $this->labelHeight);
		$des_font = 0.5* min($this->labelWidth, $this->labelHeight);

		$this->setX($x);
		$this->setY($y, false);

		$this->SetFont("helvetica", "BI", 1.2*$des_font);
		$this->setX($x);
		$this->Cell(0 , 0,"Classe Label",$aff_border,1,'L',0);
		$this->SetFont("helvetica", "BI", $des_font);
		$this->setX($x);
		$this->Cell(0 , 0,"http://cab.madvic.net/",$aff_border,1,'L',0);
		$this->setX($x);
		$this->Cell(0 , 0,"madvic@gmail.com",$aff_border,1,'L',0);

	}

}//End of class labels

?>