<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bookings';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['date', 'time'];

	public function users(){
		return $this->belongsToMany('App\User');
	}

}
