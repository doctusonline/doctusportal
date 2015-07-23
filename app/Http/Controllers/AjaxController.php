<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Orders;
use App\Mageorders;
use App\Classes\FPDF;
use App\Files;

class AjaxController extends Controller {

	public function index(){
		return view('generate.index');
	}

	public function orders(Request $request){
		$data = $request->get('data');
		$range = $request->get('range');

		switch ($range) {
			case 'month':
				$orders_obj = json_decode($data);
				print_r($orders_obj);
				foreach ($orders_obj as $key => $value) {
					$orders = new Orders;
					$mageorders = new Mageorders;

					if($orders->where('sku',$value->sku)->count()){						
						$orders->where('sku',$value->sku);
						$mageorders->where('sku', $value->sku);
					}
					$orders->sku = $value->sku;
					$orders->product = $value->product;
					$orders->save();
					$orders->mageorders()->attach($value->id);
					$mageorders->order_id = $value->id;
					$mageorders->sku = $value->sku;
					$mageorders->product = $value->product;
					$mageorders->save();

				}
				break;
			
			default:
				# code...
				break;
		}

		return $range;
	}

	public function pdfError(){
		return view('errors.503');
	}


	public function generatePDF(Request $request, FPDF $pdf, Files $file){
		$data = $request->get('data');

		$order_id 			= $data[0]['id'];
		$customer_name 		= $data[0]['name'];
		$street 			= $data[0]['street'];
		$city				= $data[0]['city'];
		$country 			= $data[0]['country'];
		$region 			= $data[0]['region'];
		$postcode 			= $data[0]['postcode'];
		//date('Y-m-d_h-i-s_').
		$temp_name = $order_id.'_'.str_replace(' ', '-', $customer_name) . '.pdf';
		//$temp_name = 'test';

		// Save the files on DB
		$file->order_id = $order_id;
		$file->filename = $temp_name;
		$file->save();

		$pdf->FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->Image(public_path().'/images/logo-pdf.png',80,5,-120);
		$pdf->Image(public_path().'/images/bar-code.png',175,25,-100);
		//Doctors Details - Header
		$pdf->ln(15);
		$pdf->SetFont('Helvetica','B',10);
		$pdf->Cell(100,4,'Dr Rodney Beckwith',0);
		$pdf->ln();
		$pdf->SetFont('Helvetica','',10);
		$pdf->Cell(100,4,'Riverside ParkOffice Tower',0);
		$pdf->ln();
		$pdf->Cell(100,4,'69 Central Coast Hwy',0);
		$pdf->ln();
		$pdf->Cell(100,4,'West Gosford 2250',0);
		$pdf->ln();
		$pdf->Cell(100,4,'Ph: 0243041333',0);
		$pdf->ln();$pdf->ln();
		$pdf->Cell(24,4,'Prescriber No:',0,0,'R');
		$pdf->Cell(50,4,'2123963',0,0,'R');
		$pdf->Line(100,54,8,54);

		$pdf->ln();$pdf->ln();
		$pdf->Cell(37,4,"Patient's Medicare No:",0,0,'R');
		$pdf->Cell(44,4,'xxxxxxx0000',0,0,'R');
		$pdf->Line(100,62,8,62);
		//Patient Details
		$pdf->ln(20);
		$pdf->SetFont('Helvetica','B',10);
		$pdf->Cell(100,4,$customer_name,0);
		$pdf->ln();
		$pdf->Cell(100,4,$street.' '.$city,0);
		$pdf->ln();
		$pdf->Cell(100,4,$region.' '.$postcode,0);

		//Date
		$pdf->ln(10);
		$pdf->SetFont('Helvetica','',10);
		$pdf->Cell(100,4,'22/05/2015',0);
		$pdf->ln();
		$pdf->Cell(100,4,'XXXXXXXXXXXXX',0);
		$pdf->ln();
		$pdf->Cell(100,4,'Non PBS',0);

		foreach($data as $item){
			//Medication
			if($item['type']=='simple'){
				$pdf->ln(10);
				$pdf->SetFont('Helvetica','B',10);
				$pdf->Cell(100,8,$item['product'],1);
				$pdf->ln();
				$pdf->SetFont('Helvetica','',10);
				$pdf->Cell(100,8,'$AUD '.(float)$item['price'],1);
				$pdf->ln();
			}else{
				$pdf->ln(10);
				$pdf->SetFont('Helvetica','B',10);
				$pdf->Cell(100,8,$item['product'],1);
				$pdf->ln();
				$pdf->SetFont('Helvetica','',10);
				$pdf->Cell(100,8,'$AUD'.(float)$item['price'],1);
				//$pdf->ln();
				//$pdf->Cell(100,8,$item['options'][0]['label'],1);
				$pdf->ln();
				$pdf->Cell(100,8,'Quantity: 12. 2 repeats.',1);
			}
			

		}
		

		//Doctors Details - Bottom
		$pdf->ln(20);
		$pdf->SetFont('Helvetica','B',10);
		$pdf->Cell(100,8,'Dr Rodney Beckwith',1);
		$pdf->ln();
		$pdf->SetFont('Helvetica','',10);
		$pdf->Cell(100,8,'MBBS, FRACGP',1);


		//ERX - Footer
		$pdf->ln(20);
		$pdf->SetFont('Helvetica','B',10);
		$pdf->Cell(100,8,'ERX Bar/QR Code',1);

		//PDF output path
		$pdf->Output(public_path() . "/pdf/".$temp_name);
		return public_path() . "/pdf/".$temp_name;
	}


}
