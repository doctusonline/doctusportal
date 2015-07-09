<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Orders;
use App\Mageorders;
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

}
