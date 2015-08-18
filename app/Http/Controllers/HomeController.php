<?php namespace App\Http\Controllers;

use Auth;
use App\Activities;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

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
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(Activities $activities)
	{
		$user = Auth::user();
		$activities = $activities->user()->orderBy('id','desc')->limit(10)->get();
		//dd($activities);
		$filename = get_avatar($user->id);
		return view('home',compact('user', 'activities','filename'));
	}

}
