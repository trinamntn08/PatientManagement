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
	$query = "SELECT `id`, `patient_name`, `diachi`, `tuoi`,
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
		$tuoi = $row['tuoi'];
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
		// Set font and style
/*
		// Set styles for the cells
		$pdf->SetFillColor(230, 230, 230); // Light gray background color for cells
		$pdf->SetTextColor(0); // Black text color
*/
	//	$pdf->SetDrawColor(255, 255, 255); // White border color
		// Tên // Tuổi // Giơi tính
		$labelWidth = 22;
		$valueWidth = 80;
		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(22, 10, "Họ và tên :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $patientName, 0, 0, 'L', false);

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(10, 10, "Tuổi :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(30, 10, $tuoi, 0, 0, 'L', false);

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(20, 10, "Giới tính :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(30, 10, $gender, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		// Địa chỉ // SĐT // 
		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(22, 10, "Địa chỉ :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $diachi, 0, 0, 'L', false);

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(10, 10, "SĐT :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(30, 10, $phone_number, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line
		// Ngay kham
		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(22, 10, "Ngày khám :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $dob, 0, 0, 'L', false);

		$cellWidth = 120; // Width of the cell
		$lineHeight = 0.1; // Height of the dotted line
		$segmentLength = 1.5; // Length of each line segment
		$gapLength = 1; // Length of each gap between line segments
		
		$startX = 50; // Get current X position
		$startY = $pdf->GetY() + 10; // Get current Y position and add offset for the line
		
		// Draw dotted line segment by segment
		for ($x = $startX; $x < $startX + $cellWidth; $x += $segmentLength + $gapLength) {
			$endX = min($x + $segmentLength, $startX + $cellWidth); // Calculate end position for the line segment
			$pdf->SetDrawColor(0,255,0);
			$pdf->Line($x, $startY, $endX, $startY); // Draw a line segment
		}
		$pdf->Ln(); // Move to the next line
		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "1. Chẩn đoán :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $chandoan, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "2. Lâm sàng :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $lamsang, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "3. Gan :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $gan, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "4. Đường mật :",0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $duongmat, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(28, 10, "5. Ống mật chủ :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $ongmatchu, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "6. Túi mật :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $tuimat, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "7. Thận trái :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $thantrai, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "8. Thận phải :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $thanphai, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "9. Tụy :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $tuy, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "10. Lách :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $lach, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(35, 10, "11. Bàng quang :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $bangquang, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(35, 10, "12. Túi cùng :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $tuicung, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(35, 10, "13. Buồn trứng trái :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $buongtrungtrai, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(35, 10, "14. Buồn trứng phải :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $buongtrungphai, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(35, 10, "15. Ghi nhận khác :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $ghinhankhac, 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line

		// Print the image
		$imageWidth = 120; // Adjust the width of the image as needed
		$imageHeight = 120; // Adjust the height of the image as needed
		// Check if there is enough space for the image
		if ($pdf->GetY() + $imageHeight + 15 > $pdf->GetPageHeight()) {
			$pdf->AddPage(); // Start a new page
		}

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "16. Hình ảnh siêu âm :", 0, 0, 'L', false);
		$pdf->Ln(); // Move to the next line

		// Save current y-coordinate
		$currentY = $pdf->GetY();
		$imagePath = "anhsieuam/" . $hinhanhsieuam;

		// Calculate x-coordinate to center the image
		$imageX = ($pdf->GetPageWidth() - $imageWidth) / 2;

		$pdf->Image($imagePath, $imageX, $currentY + 5, $imageWidth, $imageHeight);
		$pdf->SetY($currentY + $imageHeight + 10); // Set the y-coordinate for the next line

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(25, 10, "17. KẾT LUẬN :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(60, 10, $ketluan, 0, 0, 'L', false);
		$pdf->Ln(); // Move to the next line

		$startY = $pdf->GetY() + 10; // Get current Y position and add offset for the line
		
		// Draw dotted line segment by segment
		for ($x = $startX; $x < $startX + $cellWidth; $x += $segmentLength + $gapLength) {
			$endX = min($x + $segmentLength, $startX + $cellWidth); // Calculate end position for the line segment
			$pdf->SetDrawColor(0,255,0);
			$pdf->Line($x, $startY, $endX, $startY); // Draw a line segment
		}
		$pdf->Ln(); // Move to the next line
		$pdf->Ln(); // Move to the next line
		$pdf->SetTextColor(0,0,255); // Set blue color		
		$cellWidth = $pdf->GetStringWidth("Ngày ........ tháng ........ năm ........"); // Get the width of the text
		$pdf->SetX($pdf->GetX() - $cellWidth - 55); // Adjust the X position by subtracting the cell width and an additional value (e.g., 5) for extra left spacing
		$pdf->Cell($cellWidth, 10, "Ngày ...... tháng ...... năm ......", 0, 0, 'R', false);

		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255,0,0); // Set red color		
		$cellWidth = $pdf->GetStringWidth("BÁC SĨ SIÊU ÂM "); // Get the width of the text
		$pdf->SetX($pdf->GetX() - $cellWidth - 65); // Adjust the X position by subtracting the cell width and an additional value (e.g., 5) for extra left spacing
		$pdf->Cell($cellWidth, 10, "BÁC SĨ SIÊU ÂM  ", 0, 0, 'R', false);

		$pdf->Ln(); // Move to the next line
		$pdf->Ln(); // Move to the next line
		$pdf->Ln(); // Move to the next line
		$pdf->Ln(); // Move to the next line

		$pdf->SetTextColor(255, 0, 0); // Set red color
		$pdf->Cell(20, 10, "Lời khuyên :", 0, 0, 'L', false);
		$pdf->SetTextColor(0,0,255); // Reset to black color
		$pdf->Cell(40, 10, "Kiêng: Rượu, bia, cafe  | ", 0, 0, 'L', false);
		$pdf->Cell(40, 10, "Hạn chế: hành, tiêu, ớt, tỏi, dầu mỡ, rau sống", 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line
		$pdf->SetTextColor(0, 0, 255); // Set red color
		$pdf->Cell(35, 10, "Hẹn tái khám sau 1 tuần !", 0, 0, 'L', false);

		$pdf->Ln(); // Move to the next line
		$pdf->SetTextColor(0, 0, 255); // Set red color
		$pdf->Cell(35, 10, "TS dị ứng thuốc : ", 0, 0, 'L', false);
		

		} catch(PDOException $ex) {
		echo $ex->getMessage();
		echo $ex->getTraceAsString();
		exit;
	}

$pdf->Output('print_patient_visits.pdf', 'I');
?>