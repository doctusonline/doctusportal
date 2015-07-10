<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Classes;
use Auth;
class CheckoutController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function checkout(Request $post)
	{
		$in_page = 'before_submit';
		$json_array = json_decode($post->get('data'));
		$obj = [];
		foreach ($json_array as $key => $item) {
			$obj[$item->name] = $item->value;
		}
		$data = (object)$obj;

		$request = new Classes\CreateDirectPaymentRequest();

	    // Populate values for Customer Object
	    // Note: TokenCustomerID is required when update an exsiting TokenCustomer
	    if (!empty($data->txtTokenCustomerID)) {
	        $request->Customer->TokenCustomerID = $data->txtTokenCustomerID;
	    }

	    $request->Customer->Reference = $data->txtCustomerRef;
	    $request->Customer->Title = $data->ddlTitle;
	    $request->Customer->FirstName = $data->txtFirstName;
	    $request->Customer->LastName = $data->txtLastName;
	    //$request->Customer->CompanyName = $data->txtCompanyName;
	    //$request->Customer->JobDescription = $data->txtJobDescription;
	    $request->Customer->Street1 = $data->txtStreet;
	    $request->Customer->City = $data->txtCity;
	    $request->Customer->State = $data->txtState;
	    $request->Customer->PostalCode = $data->txtPostalcode;
	    $request->Customer->Country = $data->txtCountry;
	    $request->Customer->Email = $data->txtEmail;
	    //$request->Customer->Phone = $data->txtPhone;
	    $request->Customer->Mobile = $data->txtMobile;
	    $request->Customer->Comments = $data->txtComments;
	    //$request->Customer->Fax = $data->txtFax;
	    //$request->Customer->Url = $data->txtUrl;

	    $request->Customer->CardDetails->Name = $data->txtCardName;
	    $request->Customer->CardDetails->Number = $data->txtCardNumber;
	    $request->Customer->CardDetails->ExpiryMonth = $data->ddlCardExpiryMonth;
	    $request->Customer->CardDetails->ExpiryYear = $data->ddlCardExpiryYear;
	    //$request->Customer->CardDetails->StartMonth = $data->ddlStartMonth;
	    $request->Customer->CardDetails->StartYear = $data->ddlStartYear;
	    //$request->Customer->CardDetails->IssueNumber = $data->txtIssueNumber;
	    $request->Customer->CardDetails->CVN = $data->txtCVN;

	    // Populate values for ShippingAddress Object.
	    // This values can be taken from a Form POST as well. Now is just some dummy data.
	    $request->ShippingAddress->FirstName = "John";
	    $request->ShippingAddress->LastName = "Doe";
	    $request->ShippingAddress->Street1 = "9/10 St Andrew";
	    $request->ShippingAddress->Street2 = " Square";
	    $request->ShippingAddress->City = "Edinburgh";
	    $request->ShippingAddress->State = "";
	    $request->ShippingAddress->Country = "gb";
	    $request->ShippingAddress->PostalCode = "EH2 2AF";
	    $request->ShippingAddress->Email = "your@email.com";
	    $request->ShippingAddress->Phone = "0131 208 0321";
	    // ShippingMethod, e.g. "LowCost", "International", "Military". Check the spec for available values.
	    $request->ShippingAddress->ShippingMethod = "LowCost";

	    if ($data->ddlMethod == 'ProcessPayment' || $data->ddlMethod == 'Authorise' || $data->ddlMethod == 'TokenPayment') {
	        // Populate values for LineItems
	        $item1 = new Classes\LineItem();
	        $item1->SKU = "SKU1";
	        $item1->Description = "Description1";
	        $item2 = new Classes\LineItem();
	        $item2->SKU = "SKU2";
	        $item2->Description = "Description2";
	        $request->Items->LineItem[0] = $item1;
	        $request->Items->LineItem[1] = $item2;

	        // Populate values for Payment Object
	        $request->Payment->TotalAmount = $data->txtAmount;
	        $request->Payment->InvoiceNumber = $data->txtInvoiceNumber;
	        $request->Payment->InvoiceDescription = $data->txtInvoiceDescription;
	        $request->Payment->InvoiceReference = $data->txtInvoiceReference;
	        $request->Payment->CurrencyCode = $data->txtCurrencyCode;
	    }

	    // Populate values for Options (not needed since it's in one script)
	    // $opt1 = new eWAY\Option();
	    // $opt1->Value = $data->txtOption1;
	    // $opt2 = new eWAY\Option();
	    // $opt2->Value = $data->txtOption2;
	    // $opt3 = new eWAY\Option();
	    // $opt3->Value = $data->txtOption3;
	    // $request->Options->Option[0]= $opt1;
	    // $request->Options->Option[1]= $opt2;
	    // $request->Options->Option[2]= $opt3;

	    $request->Method = $data->ddlMethod;
	    $request->TransactionType = $data->ddlTransactionType;

	    // Call RapidAPI
	    $eway_params = array();
	    if ($data->ddlSandbox) {
	        $eway_params['sandbox'] = true;
	    }
	    $service = new Classes\RapidAPI($data->APIKey, $data->APIPassword, $eway_params);
	    $result = $service->DirectPayment($request);

	    // Check if any error returns
	    if (isset($result->Errors)) {
	        // Get Error Messages from Error Code.
	        $ErrorArray = explode(",", $result->Errors);
	        $lblError = "";
	        foreach ( $ErrorArray as $error ) {
	            $error = $service->getMessage($error);
	            $lblError .= $error . "<br />\n";;
	        }
	    } else {

			$user = Auth::user();
	    	$to      = $user->email;
			$subject = 'Video Conference - Skype';
			$message = '<p>Please download Skype to see your doctor and click link below to attend your booking: <br />
						Visit Dr Rodney Beckwith
						</p>
						<p><a href="skype:archie.quito?call">Call Doctor</a></p>
						';
			$headers = 'From: no-reply@doctus.com.au' . "\r\n" .
			    'Reply-To: suppor@doctus.com.au' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			mail($to, $subject, $message, $headers);
	        $in_page = 'view_result';
	    }

		return $in_page;

	}

}