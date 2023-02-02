<?php
// Load the PHP Spreadsheet library
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

include 'config.php';

global $conn;

// Query to fetch data from the database
$supQuery = "SELECT * FROM supply";
$supResult = mysqli_query($conn, $supQuery);

$inQuery = "SELECT * FROM stockin";
$inResult = mysqli_query($conn, $inQuery);

$stQuery = "SELECT product, SUM(pcs) as total_pcs, id, company, type, price FROM stockin GROUP BY product ORDER BY id ASC";
$stResult = mysqli_query($conn, $stQuery);

$ssQuery = "SELECT * FROM stockout";
$ssResult = mysqli_query($conn, $ssQuery);

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set the active sheet index to the first sheet, and add data to it
$spreadsheet->setActiveSheetIndex(0)
    ->mergeCells("B2:F2")
    ->setCellValue('B2', 'SUPPLY')
    ->setCellValue('B3', 'NO')
    ->setCellValue('C3', 'ID')
    ->setCellValue('D3', 'COMPANY')
    ->setCellValue('E3', 'TYPE')
    ->setCellValue('F3', 'PRODUCT');

$spreadsheet->setActiveSheetIndex(0)
    ->mergeCells("H2:N2")
    ->setCellValue('H2', 'STOCK-IN')
    ->setCellValue('H3', 'NO')
    ->setCellValue('I3', 'ID')
    ->setCellValue('J3', 'DATE')
    ->setCellValue('K3', 'TYPE')
    ->setCellValue('L3', 'PRODUCT')
    ->setCellValue('M3', 'PRICE')
    ->setCellValue('N3', 'PCS');

$spreadsheet->setActiveSheetIndex(0)
    ->mergeCells("P2:V2")
    ->setCellValue('P2', 'STOCK')
    ->setCellValue('P3', 'NO')
    ->setCellValue('Q3', 'ID')
    ->setCellValue('R3', 'COMPANY')
    ->setCellValue('S3', 'TYPE')
    ->setCellValue('T3', 'PRODUCT')
    ->setCellValue('U3', 'PRICE')
    ->setCellValue('V3', 'PCS');

$spreadsheet->setActiveSheetIndex(0)
    ->mergeCells("X2:AE2")
    ->setCellValue('X2', 'STOCK-OUT/SOLD')
    ->setCellValue('X3', 'NO')
    ->setCellValue('Y3', 'ID')
    ->setCellValue('Z3', 'DATE')
    ->setCellValue('AA3', 'TYPE')
    ->setCellValue('AB3', 'PRODUCT')
    ->setCellValue('AC3', 'PRICE * 5%')
    ->setCellValue('AD3', 'PCS')
    ->setCellValue('AE3', 'PROFIT (5%)');

// Add data to the sheet
$supRow = 4;
$supBorderRow = 3;
for ($s = 1; $supRowData = mysqli_fetch_assoc($supResult); $s++, $supRow++, $supBorderRow++) {
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('B' . $supRow, $s)
        ->setCellValue('C' . $supRow, $supRowData['id'])
        ->setCellValue('D' . $supRow, $supRowData['company'])
        ->setCellValue('E' . $supRow, $supRowData['type'])
        ->setCellValue('F' . $supRow, $supRowData['product']);
}

$inRow = 4;
$inBorderRow = 3;
for ($i = 1; $inRowData = mysqli_fetch_assoc($inResult); $i++, $inRow++, $inBorderRow++) {
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('H' . $inRow, $i)
        ->setCellValue('I' . $inRow, $inRowData['id'])
        ->setCellValue('J' . $inRow, $inRowData['date'])
        ->setCellValue('K' . $inRow, $inRowData['type'])
        ->setCellValue('L' . $inRow, $inRowData['product'])
        ->setCellValue('M' . $inRow, $inRowData['price'])
        ->setCellValue('N' . $inRow, $inRowData['pcs']);
}

$stRow = 4;
$stBorderRow = 3;
for ($t = 1; $stRowData = mysqli_fetch_assoc($stResult); $t++, $stRow++, $stBorderRow++) {
    $spreadsheet->setActiveSheetindex(0)
        ->setCellValue('P' . $stRow, $t)
        ->setCellValue('Q' . $stRow, $stRowData['id'])
        ->setCellValue('R' . $stRow, $stRowData['company'])
        ->setCellValue('S' . $stRow, $stRowData['type'])
        ->setCellValue('T' . $stRow, $stRowData['product'])
        ->setCellValue('U' . $stRow, $stRowData['price'])
        ->setCellValue('V' . $stRow, $stRowData['total_pcs']);
}

$ssRow = 4;
$ssBorderRow = 3;
for ($ss = 1; $ssRowData = mysqli_fetch_assoc($ssResult); $ss++, $ssRow++, $ssBorderRow++) {
    $spreadsheet->setActiveSheetindex(0)
        ->setCellValue('X' . $ssRow, $ss)
        ->setCellValue('Y' . $ssRow, $ssRowData['id'])
        ->setCellValue('Z' . $ssRow, $ssRowData['date'])
        ->setCellValue('AA' . $ssRow, $ssRowData['type'])
        ->setCellValue('AB' . $ssRow, $ssRowData['product'])
        ->setCellValue('AC' . $ssRow, $ssRowData['price'])
        ->setCellValue('AD' . $ssRow, $ssRowData['pcs'])
        ->setCellValue('AE' . $ssRow, $ssRowData['profit']);
}

// Add center alignment to the text
$spreadsheet->getActiveSheet()->getStyle("B2:F3")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("B4:B$supBorderRow")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("B2:F2")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffc000');
$spreadsheet->getActiveSheet()->getStyle("B3:F3")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('fcd5b4');
$spreadsheet->getActiveSheet()->getStyle("B4:B$supBorderRow")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('fcd5b4');
$spreadsheet->getActiveSheet()->getStyle("B2:F2")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("B3:F3")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("B4:C$supBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("E4:E$supBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()->getStyle("H2:N3")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("H4:H$inBorderRow")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("H2:N2")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffc000');
$spreadsheet->getActiveSheet()->getStyle("H3:N3")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('fcd5b4');
$spreadsheet->getActiveSheet()->getStyle("H4:H$inBorderRow")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('fcd5b4');
$spreadsheet->getActiveSheet()->getStyle("H2:N2")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("H3:N3")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("H4:K$inBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("M4:M$inBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
$spreadsheet->getActiveSheet()->getStyle("N4:N$inBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('M4:M' . $inBorderRow)->getNumberFormat()->setFormatCode('"Rp.   " #,##0');

$spreadsheet->getActiveSheet()->getStyle("P2:V3")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("P4:P$stBorderRow")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("P2:V2")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffc000');
$spreadsheet->getActiveSheet()->getStyle("P3:V3")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('fcd5b4');
$spreadsheet->getActiveSheet()->getStyle("P4:P$stBorderRow")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('fcd5b4');
$spreadsheet->getActiveSheet()->getStyle("P2:V2")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("P3:V3")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("P4:Q$stBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("S4:S$stBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("V4:V$stBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("U4:U$stBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
$spreadsheet->getActiveSheet()->getStyle('U4:U' . $stBorderRow)->getNumberFormat()->setFormatCode('"Rp.   " #,##0');

$spreadsheet->getActiveSheet()->getStyle("X2:AE3")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("X4:X$inBorderRow")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("X2:AE2")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffc000');
$spreadsheet->getActiveSheet()->getStyle("X3:AE3")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('fcd5b4');
$spreadsheet->getActiveSheet()->getStyle("X4:X$ssBorderRow")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('fcd5b4');
$spreadsheet->getActiveSheet()->getStyle("X2:AE2")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("X3:AE3")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("X4:AA$ssBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle("AC4:AC$ssBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
$spreadsheet->getActiveSheet()->getStyle("AE4:AE$ssBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
$spreadsheet->getActiveSheet()->getStyle("AD4:AD$ssBorderRow")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('AC4:AC' . $ssBorderRow)->getNumberFormat()->setFormatCode('"Rp.   " #,##0');
$spreadsheet->getActiveSheet()->getStyle('AE4:AE' . $ssBorderRow)->getNumberFormat()->setFormatCode('"Rp.   " #,##0');



// Add all border to table
$spreadsheet->getActiveSheet()->getStyle("B2:F$supBorderRow")->applyFromArray(
    array(
        'borders' => array(
            'allBorders' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
        )
    )
);

$spreadsheet->getActiveSheet()->getStyle("H2:N$inBorderRow")->applyFromArray(
    array(
        'borders' => array(
            'allBorders' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
        )
    )
);

$spreadsheet->getActiveSheet()->getStyle("P2:V$stBorderRow")->applyFromArray(
    array(
        'borders' => array(
            'allBorders' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
        )
    )
);

$spreadsheet->getActiveSheet()->getStyle("X2:AE$ssBorderRow")->applyFromArray(
    array(
        'borders' => array(
            'allBorders' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
        )
    )
);

// Auto fit the table
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);

$spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);

$spreadsheet->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);

// Set the sheet title
$spreadsheet->getActiveSheet()->setTitle('Inventory');

$filename = "Inventory_Report_" . date("Y-m-d") . ".xls";

// Redirect output to a client's web browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Create a new Xls writer object
$writer = new Xls($spreadsheet);

// Save the spreadsheet to a file
$writer->save('php://output');
?>