<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Orders;
use App\Mageorders;
use App\Classes\FPDF;
use App\Files;
use Auth;
use App\User;
use Bican\Roles\Models\Role;
class AjaxController extends Controller {

	// public function __construct()
	// {
	// 	$this->middleware('auth');
	// }

	public function index(User $user, Orders $orders){

		$tracks = $orders->all();
		//dd($tracks);
		return view('generate.index',compact('tracks'));
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

	public function generateDomPdf(){
		$dompdf = new \DOMPDF();
		$pdf = view('generate.dompdf');

		$dompdf->load_html($pdf);
		$dompdf->set_paper('letter', 'portrait');
		$dompdf->render();

		//$dompdf->stream("dompdf_out.pdf", array("Attachment" => true));

		$output = $dompdf->output();
		$file_to_save = 'file2.pdf';
		file_put_contents($file_to_save, $output);
		return $pdf;
	}

	public function updateOrder(Request $request, Orders $orders){
		$user = Auth::user();
		$order_id = $request->get('order_id');
		$status_code = $request->get('status_code');
		$orders->order_id_mage = $order_id;
		$orders->status_code = $status_code;
		$orders->save();
		$orders->user()->detach($user->id);
		$orders->user()->attach($user->id);
	}

	public function generatePDF(Request $request, FPDF $pdf, Files $file, Orders $orders){
		$data = $request->get('data');
		$order_id 			= $data[0]['id'];
		$customer_name 		= $data[0]['name'];
		$street 			= $data[0]['street'];
		$city				= $data[0]['city'];
		$country 			= $data[0]['country'];
		$region 			= $data[0]['region'];
		$postcode 			= $data[0]['postcode'];
		$status_code 			= $data[0]['status'];
		//date('Y-m-d_h-i-s_').
		// $temp_name = $order_id.'_'.str_replace(' ', '-', $customer_name) . '.pdf';
		$temp_name = $order_id.'_'. $customer_name . '.pdf';
		//$temp_name = 'test.pdf';

		$dompdf = new \DOMPDF();
		$pdf = view('generate.dompdf', compact('data'));

		$dompdf->load_html($pdf);
		$dompdf->set_paper('letter', 'portrait');
		$dompdf->render();

		//$dompdf->stream("dompdf_out.pdf", array("Attachment" => true));

		$output = $dompdf->output();
		$file_to_save = 'pdf/'.$temp_name;
		file_put_contents($file_to_save, $output);
		
		// Save the files on DB
		$fileExist = $file->where('order_id',$order_id)->count();
		if($fileExist == 0){
			$file->order_id = $order_id;
			$file->filename = $temp_name;
			$file->save();
		}


		// $pdf->FPDF('P','mm','A4');
		// $pdf->AddPage();
		// //$pdf->Image(public_path().'/images/logo-pdf.png',80,5,-120);
		// $pdf->Image(public_path().'/images/bar-code.png',176,8,-98);
		// //Doctors Details - Header
		// $pdf->ln(-4);
		// $pdf->SetFont('Helvetica','B',10);
		// $pdf->Cell(100,4,'Dr Rodney Beckwith',0);
		// $pdf->ln();
		// $pdf->SetFont('Helvetica','',10);
		// $pdf->Cell(100,4,'Riverside ParkOffice Tower',0);
		// $pdf->ln();
		// $pdf->Cell(100,4,'69 Central Coast Hwy',0);
		// $pdf->ln();
		// $pdf->Cell(100,4,'West Gosford 2250',0);
		// $pdf->ln();
		// $pdf->Cell(100,4,'Ph: 0243041333',0);
		// $pdf->ln(5);
		// $pdf->Cell(18,4,'Prescriber No:',0,0,'R');
		// $pdf->Cell(18,4,'2123963',0,0,'R');
		// $pdf->Line(100,32,4,32);

		// $pdf->ln(7);
		// $pdf->Cell(31,4,"Patient's Medicare No:",0,0,'R');
		// $pdf->Cell(44,4,'',0,0,'R');

		// $pdf->ln(5);		
		// $pdf->Cell(20,3, 'Pharmaceutical',0,0,'L');
		// $pdf->ln();
		// $pdf->Cell(20,3, 'benefits',0,0,'L');
		// $pdf->ln();
		// $pdf->Cell(20,3, 'entitlement no.',0,0,'L');
		// $pdf->Cell(70,8,'',1,35,'L');

		// //$pdf->Line(100,62,8,62);
		// //Patient Details
		// $pdf->ln(20);
		// $pdf->SetFont('Helvetica','B',10);
		// $pdf->Cell(100,4,$customer_name,0);
		// $pdf->ln();
		// $pdf->Cell(100,4,$street.' '.$city,0);
		// $pdf->ln();
		// $pdf->Cell(100,4,$region.' '.$postcode,0);
		// //Date
		// $pdf->ln(10);
		// $pdf->SetFont('Helvetica','',10);
		// $pdf->Cell(100,4,'22/05/2015',0);
		// $pdf->ln();
		// $pdf->Cell(100,4,'XXXXXXXXXXXXX',0);
		// $pdf->ln();
		// $pdf->Cell(100,4,'Non PBS',0);

		// foreach($data as $item){
		// 	//Medication
		// 	if($item['type']=='simple'){
		// 		$pdf->ln(10);
		// 		$pdf->SetFont('Helvetica','B',10);
		// 		$pdf->Cell(100,8,$item['product'],1);
		// 		$pdf->ln();
		// 		$pdf->SetFont('Helvetica','',10);
		// 		$pdf->Cell(100,8,'$AUD '.(float)$item['price'],1);
		// 		$pdf->ln();
		// 	}else{
		// 		$pdf->ln(10);
		// 		$pdf->SetFont('Helvetica','B',10);
		// 		$pdf->Cell(100,8,$item['product'],1);
		// 		$pdf->ln();
		// 		$pdf->SetFont('Helvetica','',10);
		// 		$pdf->Cell(100,8,'$AUD'.(float)$item['price'],1);
		// 		//$pdf->ln();
		// 		//$pdf->Cell(100,8,$item['options'][0]['label'],1);
		// 		$pdf->ln();
		// 		$pdf->Cell(100,8,'Quantity: 12. 2 repeats.',1);
		// 	}
			

		// }
		

		// //Doctors Details - Bottom
		// $pdf->ln(20);
		// $pdf->SetFont('Helvetica','B',10);
		// $pdf->Cell(100,8,'Dr Rodney Beckwith',1);
		// $pdf->ln();
		// $pdf->SetFont('Helvetica','',10);
		// $pdf->Cell(100,8,'MBBS, FRACGP',1);


		// //ERX - Footer
		// $pdf->ln(20);
		// $pdf->SetFont('Helvetica','B',10);
		// $pdf->Cell(100,8,'ERX Bar/QR Code',1);

		// //PDF output path
		// $pdf->Output(public_path() . "/pdf/".$temp_name);
		return $temp_name;
	}

	public function getUsers(User $users){
		return $users->get();
	}
	public function getUser(User $users, $user_id){
		$data = ['user'=>$users->find($user_id),'role'=>$users->find($user_id)->roles()->get()];
		return $data;
	}

}
