<?php

include("./pdflib/logics-builder-pdf.php");
include './config/connection.php';

$reportTitle = "Patients Visits";

$pdf = new LB_tPDF('L', false, $reportTitle);
//$pdf = new tFPDF();

//$pdf->SetMargins(15, 10);
//$pdf->AliasNbPages();
$pdf->AddPage();
// Add a Unicode font (uses UTF-8)
//$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
//$pdf->SetFont('DejaVu', '', 14);
$pdf->Cell(0, 10, 'Tiếng Việt', 0, 1, 'C');
/*
$query = "SELECT `p`.`patient_name`, `p`.`address`, 
`p`.`phone_number`, `pv`.`visit_date`, `pv`.`disease` 
from `patients` as `p`, `patient_visits` as `pv` 
where `pv`.`visit_date` between '$fromMysql' and '$toMysql' and 
    `pv`.`patient_id` = `p`.`id` 
    order by `pv`.`visit_date` asc;";
$stmt = $con->prepare($query);
$stmt->execute();

$i = 0;
while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$i++;

	$data = array($i, 
		$r['visit_date'],
		$r['patient_name'],
		$r['address'],
		$r['phone_number'],
		$r['disease']
	);

	$pdf->AddRow($data);

}
*/
$pdf->Output('print_patient_visits.pdf', 'I');
?>