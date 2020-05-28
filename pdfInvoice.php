
<?php
session_start();
require_once('fpdf/fpdf.php');

//create fpdf object with parameters
$pdf = new fpdf('p','mm','A4');
//add page
$pdf->addPage();
//set font to bold , arial ,14pt
$pdf->setFont('Arial','B',16);
// add cell(width,height,text,border,endline,align)
$pdf->Cell(130,5,'Haarlem Festival',0,0);
$pdf->Cell(59,5,'Invoice',0,1); // end of line

//set font to regular , arial ,12pt
$pdf->setFont('Arial','',11);
$pdf->Cell(130,5,'45 Parklaan Street, 2011KR',0,0);
$pdf->Cell(59,5,'',0,1);

$pdf->Cell(130,5,'Haarlem',0,0);
$pdf->Cell(25,5,'Date:',0,0);
$pdf->Cell(34,5, date("d-m-Y"),0,1);

$pdf->Cell(130,5,'Netherlands',0,0);
$pdf->Cell(25,5,'Invoice #',0,0);
$pdf->Cell(34,5,'4567',0,1);

$pdf->Cell(130,5,'Phone [+263 774 163 923]',0,0);
$pdf->Cell(25,5,'Customer ID:',0,0);
$pdf->Cell(34,5,' 45',0,1);
$pdf->Cell(130,5,'    Fax [+263 774 163 923]',0,0);

// make a dummy empty cells
$pdf->Cell(189,10,'',0,1);
// billing address
$pdf->setFont('Arial','B',12);

$pdf->Cell(100,5,'Bill to',0,1);
$pdf->setFont('Arial','',11);

// make a dummy cells
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(90,5,ucfirst(strtolower($_SESSION['name'])).' '.ucfirst(strtolower($_SESSION['surname'])),0,1);

$pdf->Cell(10,5,'',0,0);
$pdf->Cell(90,5,'Address',0,1);

$pdf->Cell(10,5,'',0,0);
$pdf->Cell(90,5,'Email: '.$_SESSION['email'],0,1);

$pdf->Cell(10,5,'',0,0);
$pdf->Cell(90,5,'Phone: ',0,1);

// make a dummy cell
$pdf->Cell(189,10,'',0,1);

// invoice content
//set set
$pdf->setFont('Arial','',12);

// column headers
$pdf->setFont('Arial','B',12);
$pdf->Cell(10,5,'Qty',1,0);
$pdf->Cell(120,5,'Description',1,0);
$pdf->Cell(25,5,'Unit Price',1,0);
$pdf->Cell(34,5,'Total (Euro)',1,1,'C');


$pdf->setFont('Arial','',11);
// display items
if(isset($_COOKIE['cart'])){
  $total_price = 0;
  $cookie_items = stripslashes($_COOKIE['cart']);
  $cookie_data = json_decode($cookie_items,true);
  foreach ($cookie_data as $key => $value) {
    $pdf->Cell(10,5,$value['quantity'],1,0,'C');
    $pdf->Cell(120,5,$value['artist'].':'.' '.$value['date'].' '.'|'.' '.$value['start_time'].'-'.$value['end_time'],1,0);
    $pdf->Cell(25,5,number_format($value['price'],2),1,'C');
    $pdf->Cell(34,5,number_format($value['price'] * $value['quantity'],2),1,1, 'R');
    $total_price += $value['price'];
  }
}
  $tax = 0.15 * $total_price;
  $Total = $total_price + $tax;
  $ticketOwner = $_SESSION['name']. '-'.$_SESSION['surname'].','.$_SESSION['email'];
  $pdf->image('http://localhost/QrGenerator/qrcodegen.php?user='.$ticketOwner,138,34,30,30,"png");

// summary
$pdf->Cell(130,5,'',0,0);
$pdf->Cell(25,5,'Subtotal',0,0);
$pdf->Cell(34,5,number_format($total_price,2),1,1, 'R');
$pdf->Cell(130,5,'',0,0);
$pdf->Cell(25,5,'Tax 15%',0,0);
$pdf->Cell(34,5,number_format($tax,2),1,1, 'R');

// set set
$Total = $tax + $total_price;
$pdf->setFont('Arial','B',12);
$pdf->Cell(130,5,'',0,0);
$pdf->Cell(25,5,'Total',0,0);
$pdf->Cell(34,5,number_format($Total,2),1,1, 'R');


$pdf->Cell(189,15,'',0,1);
$pdf->Cell(130,5,'NB:',0,1);
$pdf->Cell(130,5,'Visit www.haarlemfestival.com/tickets to print your ticket(s)',0,1);
$pdf->Output();

 ?>
