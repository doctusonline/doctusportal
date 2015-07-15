<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Booking;
use Auth;
class BookingController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('booking.index');
	}
	public function test()
	{
		return view('booking.test');
	}
	public function iframe()
	{
		return view('booking.iframe');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(BookingRequest $request, Booking $booking)
	{	
		$user = Auth::user();
		$booking = $booking->create($request->all());
		$booking->date = date('Y-m-d',strtotime($request->date));
		$booking->save();
		$user->bookings()->attach($booking->id);
		return $booking->id;
	}


}
