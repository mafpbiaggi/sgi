<?php
	//Inicia Uma nova página de PDF
	$pdf->AddPage('P', 'A4');
	$pdf->SetY(6);
	$pdf->SetX(7);

	//Setando valores da margem
	$pdf->SetMargins(7, 5, 9);

	//Quebra de Linha com 1mm
	$pdf->Ln(1);

	//Passa parametros para Fonte
	$pdf->SetFont('Helvetica', 'B', 12);

	//Topo do relatório
	$topo = getenv('REPORT_TOP') . "\nLista de Presença - ASSEMBLÉIA";
	
	$pdf->SetAutoPageBreak(true, 15);
	$pdf->MultiCell(196,7, utf8_decode($topo), 1, 'J', false);
	$pdf->Ln(5);

	$header = array(utf8_decode('Nome'), utf8_decode('Assinatura'));
    $pdf->SetWidths(array(98,98));

	// Seleciona fonte Helvetica bold 15
	$pdf->SetFont('Helvetica','B',12);

	$pdf->headerRow = $pdf->RowCustom($header, 10);
	$pdf->headerFont = array('Helvetica', 'B', 12);

	foreach ($membros as $key => $value) {
		$pdf->SetFont('Helvetica','', 12);
		$pdf->RowCustom(array(utf8_decode($value['Membro']['nome']),''), 10);
	}

	$pdf->Output();
?>
