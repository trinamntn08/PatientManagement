<?php

include("./pdflib/logics-builder-pdf.php");
include './config/connection.php';

$reportTitle = "Phòng khám bác sĩ Đợi";

$pdf = new LB_tPDF('P', false, $reportTitle);
//$pdf = new tFPDF('P');
$pdf->SetMargins(15, 10);
$pdf->AliasNbPages();
$pdf->AddPage();

/*
$from = $_GET['from'];
$to = $_GET['to'];
$fromArr = explode("/", $from);
$toArr = explode("/", $to);
$fromMysql = $fromArr[2].'-'.$fromArr[0].'-'.$fromArr[1];
$toMysql = $toArr[2].'-'.$toArr[0].'-'.$toArr[1];
$pdf = new LB_PDF('L', false, $reportTitle, $from, $to);
$pdf->SetMargins(15, 10);
$pdf->AliasNbPages();
$pdf->AddPage();
$titlesArr = array('S.No', 'Visit Date', 'Patient Name', 
'Address', 'Contact#', 'Disease');
$pdf->SetWidths(array(15, 25, 50, 70, 30, 70));
$pdf->SetAligns(array('L', 'L', 'L', 'L', 'L', 'L'));
// $pdf->Ln();
// $pdf->Ln();
 $pdf->Ln(15);

$pdf->AddTableHeader($titlesArr);
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
// Set the font and font size
//$pdf->SetFont('Arial', '', 12);
try {
	$id = $_GET['patientId'];
	$query = "SELECT `id`, `patient_name`, `diachi`, 
	`cmnd`, date_format(`visit_date`, '%m/%d/%Y') as `visit_date`,  `phone_number`, `gender`, `weight`, `patient_diagnostic_id`, `chandoan`, `lamsang`, `gan`,
	`duongmat`, `ongmatchu`, `tuimat`, `thantrai`, `thanphai`, `tuy`, `lach`,
	`bangquang`, `tuicung`, `tucung`, `buongtrungtrai`, `buongtrungphai`, `ghinhankhac`, `hinhanhsieuam`,
	`ketluan`
	FROM `patient_examen` where `id` = $id;";
	
	  $stmtPatient1 = $con->prepare($query);
	  $stmtPatient1->execute();
	  $row = $stmtPatient1->fetch(PDO::FETCH_ASSOC);
	  $gender = $row['gender'];
	  $dob = $row['visit_date']; 
	  $patientName = $row['patient_name'];
	  $diachi= $row['diachi'];
	  $cmnd = $row['cmnd'];
	  $phone_number= $row['phone_number'];
	  $chandoan = $row['chandoan'];
	  $lamsang= $row['lamsang'];
	  $gan= $row['gan'];
	  $duongmat = $row['duongmat'];
	  $ongmatchu= $row['ongmatchu'];
	  $tuimat= $row['tuimat'];
	  $thantrai = $row['thantrai'];
	  $thanphai= $row['thanphai'];
	  $tuy= $row['tuy'];
	  $lach = $row['lach'];
	  $bangquang= $row['bangquang'];
	  $tuicung = $row['tuicung'];
	  $buongtrungtrai= $row['buongtrungtrai'];
	  $buongtrungphai= $row['buongtrungphai'];
	  $ghinhankhac = $row['ghinhankhac'];
	  $hinhanhsieuam= $row['hinhanhsieuam'];
	  $ketluan= $row['ketluan'];

	  // Output the form data in the PDF
	  $pdf->Cell(0, 10, "Tên bệnh nhân: $patientName", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Địa chỉ: $diachi", 0, 1, 'L');
	  $pdf->Cell(0, 10, "CMND: $cmnd", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Ngày khám: $dob", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Số điện thoại: $phone_number", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Giới tính: $gender", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Chẩn đoán: $chandoan", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Lâm sàng: $lamsang", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Gan: $gan", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Đường mật: $duongmat", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Ống mật chủ: $ongmatchu", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Túi mật: $tuimat", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Thận trái: $thantrai", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Thận phải: $thanphai", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Tụy: $tuy", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Lách: $lach", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Bàng quang: $bangquang", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Túi cùng: $tuicung", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Buồn trứng trái: $buongtrungtrai", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Buồn trứng phải: $buongtrungphai", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Ghi nhận khác: $ghinhankhac", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Đường mật: $ghinhankhac", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Ống mật chủ: $ongmatchu", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Túi mật: $tuimat", 0, 1, 'L');
	  $pdf->Cell(0, 10, "Hình ảnh siêu âm: ", 0, 1, 'L');
	  // Print the image
	  // Save current y-coordinate
	  $currentY = $pdf->GetY();
	  $imagePath = "anhsieuam/" . $hinhanhsieuam;
	  $imageWidth = 190; // Adjust the width of the image as needed
	  $imageHeight = 200; // Adjust the height of the image as needed
	  $pdf->Image($imagePath, 10, $currentY + 5, $imageWidth, $imageHeight);
	  $pdf->SetY($currentY + $imageHeight + 10); // Set the y-coordinate for the next line
	  $pdf->Cell(0, 10, "Kết luận: $ketluan", 0, 1, 'L');
	} catch(PDOException $ex) {
	  echo $ex->getMessage();
	  echo $ex->getTraceAsString();
	  exit;
	}

$pdf->Output('print_patient_visits.pdf', 'I');
?>