<?php
ob_end_clean();

require('../fpdf/fpdf.php');

if (isset($_GET['id_hoadon']) ) {
    $id_hoadon = $_GET['id_hoadon'];
}

$query = hoadon_join_phim($id_hoadon); 
$tenphim = array();
foreach ($query as $row) {
    $tenphim[] = $row['tenphim'];
}
$tenphim = implode(',', $tenphim);

$query_1 = hoadon_join_rap($id_hoadon);
$tenrap = array();
foreach ($query_1 as $row_1) {
    $tenrap[] = $row_1['tenrap'];
}
$tenrap = implode(',', $tenrap);

$query_2 = hoadon_join_ghe($id_hoadon);
$hang = array();
foreach ($query_2 as $row_2) {
    $hang[] = $row_2['Hang'];
}
$hang = implode(',', $hang);

$query_3 = hoadon_join_ghe($id_hoadon);
$cot = array();
foreach ($query_3 as $row_3) {
    $cot[] = $row_2['Cot'];
}
$cot = implode(',', $cot);


class PDF extends FPDF
{
    public $id_hoadon;

    function Header()
    {   
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Myshowz', 0, 1, 'C');
        $this->Cell(0, 10, 'Hoa don #' . $this->id_hoadon, 0, 1, 'C');
        $this->Cell(0, 10, 'Ngay in: ' . date('Y-m-d H:i:s'), 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'R');
    }
}

$pdf = new PDF();
$pdf->id_hoadon = $id_hoadon;
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

foreach ($query as $row) {
    $pdf->Cell(0, 10, 'Ten phim: ' . $row['tenphim'], 0, 1, 'L');
    $pdf->Cell(0, 10, 'Ten rap: ' . $tenrap, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Ghe: ' . $hang . $cot, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Thoi gian ra ve: ' . $row['thoigian_rave'], 0, 1, 'L');
    $pdf->Cell(0, 10, 'Thanh tien: ' . $row['thanhtien'], 0, 1, 'L');
}

$filename = 'hoadon.pdf';
$pdf->Output($filename, 'D');
?>