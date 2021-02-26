<?php

	include_once("../fpdf/fpdf.php");

	if($_GET["cName"]){
		
		$pdf = new FPDF;
		$pdf->AddPage();

		//set font style
		$pdf->SetFont("Arial", "B", 24);
		$pdf->cell(190, 10, "Inventory Management",0,1,"C");

		$pdf->SetFont("Arial", null, 10);
		$pdf->cell(50, 10, "Date: ",0,0);
		$pdf->cell(50, 10,$_GET["date"], 0,1);
		$pdf->cell(50,10,"Customer Name: ", 0,0);
		$pdf->cell(50,10,$_GET["cName"], 0,0);

		$pdf->cell(50,10,"", 0,1);

		$pdf->cell(10,10,"#", 1,0, "C");
		$pdf->cell(80,10,"Product Name", 1,0, "C");
		$pdf->cell(20,10,"Quantity", 1,0, "C");
		$pdf->cell(40,10,"Price", 1,0, "C");
		$pdf->cell(40,10,"Total", 1,1, "C");

		$pdf->SetFont("Arial", null, 8);

		for($i=0; $i < count($_GET["pro_name"]); $i++){
			$pdf->cell(10,10,($i + 1),1,0, "C");
			$pdf->cell(80,10,$_GET["pro_name"][$i], 1,0, "C");
			$pdf->cell(20,10,$_GET["qty"][$i], 1,0, "C");
			$pdf->cell(40,10,$_GET["price"][$i], 1,0, "C");
			$pdf->cell(40,10,($_GET["qty"][$i] * $_GET["price"][$i]), 1,1, "C");
		}

		$pdf->cell(50,10,"", 0,1);

		$pdf->cell(50,8,"Sub Total: ", 1,0);
		$pdf->cell(50,8,$_GET["sub"], 1,1);
		$pdf->cell(50,8,"Tax: ", 1,0);
		$pdf->cell(50,8,$_GET["tax"], 1,1);
		$pdf->cell(50,8,"Discount: ", 1,0);
		$pdf->cell(50,8,$_GET["dis"], 1,1);
		$pdf->cell(50,8,"Net Total: ", 1,0);
		$pdf->cell(50,8,$_GET["net"], 1,1);
		$pdf->cell(50,8,"Paid: ", 1,0);
		$pdf->cell(50,8,$_GET["paid"], 1,1);
		$pdf->cell(50,8,"Due: ", 1,0);
		$pdf->cell(50,8,$_GET["due"], 1,1);

		$pdf->cell(50,10,"", 0,1);
		$pdf->cell(50,10,"", 0,1);
		$pdf->cell(50,10,"", 0,1);

		$pdf->cell(180, 10, "Signature",0,1,"R");

		$pdf->Output();
	}