<?php 

require ('fpdf/fpdf.php');

$oid = $_GET['order_id'];
include('../../../connection/connect.php');
$sql = "SELECT * FROM CLECKSHOP_ORDER where ORDER_ID = $oid";
$qry = oci_parse($conn, $sql);
$execute = oci_execute($qry);
$row = oci_fetch_assoc($qry);
$order_total = $row['ORDER_TOTAL'];
$order_date = $row['ORDER_DATE'];
$cart_id = $row['CART_ID'];
$order_total = $row['ORDER_TOTAL'];


$sql1 = "SELECT * FROM CART where CART_ID = $cart_id";
$qry1 = oci_parse($conn, $sql1);
$execute = oci_execute($qry1);
$row1 = oci_fetch_assoc($qry1);
$cid = $row1['CUSTOMER_ID'];

$sql2 = "SELECT * FROM CUSTOMER where CUSTOMER_ID = $cid";
$qry2 = oci_parse($conn, $sql2);
$execute2 = oci_execute($qry2);
$row2 = oci_fetch_assoc($qry2);
$cname = $row2['CUSTOMER_FNAME']." ". $row2['CUSTOMER_MNAME']." ". $row2['CUSTOMER_LNAME'];
$cno = $row2['CUSTOMER_MOBILENO'];
$cemail = $row2['CUSTOMER_EMAIL'];


$sql3= "SELECT * FROM Payment where order_id = $oid";
$qry3 = oci_parse($conn, $sql3);
$execute3 = oci_execute($qry3);
$row3 = oci_fetch_assoc($qry3);
$payment_id = $row3['PAYMENT_ID'];




//$sql1 = "SELECT * from customer where "


$pdf = new FPDF('p','mm', 'A4');

$pdf -> AddPage();

//setting font

$pdf -> SetFont ('Arial', 'B', 14);

//Cell (width, height, text, border, end line, align)
//$pdf->SetTopMargin(10);
$pdf -> Image('logo.png',10,0,40,15);
$pdf -> Cell(180, 5, 'Sales Reciept',0, 1, 'R');
$pdf -> Cell(180, 5, 'Cleckhuddersfax',0, 1, 'L');
$pdf -> Cell(180, 5, 'Yorkshire, United Kingdom',0, 1, 'L');

//For Bill and order
$pdf -> ln();
$pdf -> ln();
$pdf -> ln();
$pdf -> Cell(90, 5, 'BILL TO',0, 0, 'L');
$pdf -> Cell(70, 5, 'ORDER ID: ',0, 0, 'R');
$pdf -> Cell(20, 5, "$order_total",0, 1, 'R');

//For date
$pdf -> ln();
$pdf -> Cell(90, 5, '',0, 0, 'L');
$pdf -> Cell(70, 5, 'DATE: ',0, 0, 'R');
$pdf -> Cell(20, 5,  " $order_date",0, 1, 'R');

//next font
$pdf -> SetFont ('Arial', '', 12);
$pdf -> ln();
$pdf -> ln();
//Customer details
$pdf -> Cell(180, 5, "$cname",0, 1, 'L');
$pdf -> Cell(180, 5, "$cno",0, 1, 'L');
$pdf -> Cell(180, 5, "$cemail",0, 1, 'L');
$pdf -> ln();
$pdf -> ln();


$pdf->Line(10,95,200,95);
$pdf -> ln();
$pdf -> ln();
$pdf -> Cell(90, 5, 'PAYMENT METHOD',0, 0, 'L');
$pdf -> Cell(70, 5, 'PAYMENT ID: ',0, 0, 'R');
$pdf -> Cell(20, 5,  "$payment_id",0, 1, 'R');

$pdf -> Cell(90, 5, 'paypal',0, 0, 'L');
$pdf -> ln();
$pdf -> ln();
$pdf -> ln();

//For table part
$width_cell = array(10,80,20,20,50);
$pdf -> Cell($width_cell[0], 8, 'SN',1,0,'L');
$pdf -> Cell($width_cell[1], 8, 'Description',1,0,'L');
$pdf -> Cell($width_cell[2], 8, 'Quantity',1,0,'L');
$pdf -> Cell($width_cell[3], 8, 'Unit Price',1,0,'L');
$pdf -> Cell($width_cell[4], 8, 'Total Amount',1,1,'L');

//Insert part
$sql4 = "SELECT * FROM CART_PRODUCT where CART_ID = $cart_id";
$qry4 = oci_parse($conn, $sql4);
$execute = oci_execute($qry4);
$row4 = oci_fetch_assoc($qry4);
$ii = 1;
while($row4 = oci_fetch_assoc($qry4)){
    $pid = $row4['PRODUCT_ID'];
    $qty = $row4['CARTPRODUCT_QUANTITY'];
    $price = $row4['PRODUCT_PRICE'];
    $tprice = $qty * $price;

    $sql5 = "SELECT * FROM PRODUCT where PRODUCT_ID = $pid";
    $qry5 = oci_parse($conn, $sql5);
    $execute = oci_execute($qry5);
    $row5 = oci_fetch_assoc($qry5);
    $pname = $row5['PRODUCT_NAME'];




    $pdf -> Cell($width_cell[0], 8, "$ii",1,0,'L');
    $pdf -> Cell($width_cell[1], 8, "$pname",1,0,'L');
    $pdf -> Cell($width_cell[2], 8, "$qty",1,0,'L');
    $pdf -> Cell($width_cell[3], 8, "$price",1,0,'L');
    $pdf -> Cell($width_cell[4], 8, "$tprice",1,1,'L');

    $ii++;

}




//Total amt
$pdf -> cell(130,8,'Total Amount', '1','0','C');
$pdf -> cell(50,8,"$order_total ", '1','1','C');

$pdf -> Output();


?>
