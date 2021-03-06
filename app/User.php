<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


use Bican\Roles\Contracts\HasRoleAndPermissionContract;
use Bican\Roles\Traits\HasRoleAndPermission;

use Cmgmyr\Messenger\Traits\Messagable;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, HasRoleAndPermission, Messagable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'telephone', 'skype_id', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function bookings(){
		return $this->belongsToMany('App\Booking');
	}
	public function payments(){
		return $this->belongsToMany('App\Payment');
	}

	public function orders(){
		return $this->belongsToMany('App\Orders');
	}

}
