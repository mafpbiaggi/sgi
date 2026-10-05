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
$pdf->SetFont('Helvetica', 'B', 11);

//Topo do relatório
$topo = getenv('REPORT_TOP') . "\nRelatório de Membros";

$pdf->SetAutoPageBreak(true, 15);
$pdf->MultiCell(196,7, utf8_decode($topo), 1, 'J', false);
$pdf->Ln(5);

$header = array(utf8_decode('ID'), utf8_decode('Nome'), utf8_decode('Telefone'), utf8_decode('Celular'), utf8_decode('Data de Nascimento'), utf8_decode('Tornou-se Membro'));

$pdf->SetWidths(array(10,58,32,32,32,32));

// To be implemented in your own inherited class
// Seleciona fonte Helvetica bold 15
$pdf->SetFont('Helvetica','B',8);

// Titulo dentro de uma caixa
$pdf->Row($header);

$pdf->headerRow = $header;
$pdf->headerFont = array('Helvetica', 'B', 8);

foreach ($membros as $key => $value) {

	$datamembro = date('d/m/Y', strtotime($value['Membro']['datamembro']));
	$datanascimento = date('d/m/Y', strtotime($value['Membro']['datanascimento']));	

	$pdf->SetFont('Helvetica','', 8);
	$pdf->Row(array(utf8_decode($value['Membro']['id']), utf8_decode($value['Membro']['nome']), utf8_decode($value['Membro']['fone']), utf8_decode($value['Membro']['cel']), utf8_decode($datanascimento), utf8_decode($datamembro)));
}

$pdf->Output();
