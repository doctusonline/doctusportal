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

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(BookingRequest $request, Booking $booking)
	{	
		$user = Auth::user();
		$booking = $booking->create($request->all());
		$user->bookings()->attach($booking->id);
		return $request->get('date');
	}


}
