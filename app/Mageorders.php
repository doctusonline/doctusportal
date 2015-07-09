<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Mageorders extends Model {


	protected $table = 'mageorders';
	
	protected $fillable = ['order_id','sku','product','name','street','city','country','region','postcode','telephone','email','price','status'];

	protected $hidden = ['remember_token'];   

	//
    public function orders() {
       return $this->belongsToMany('App\Orders');
    }

}
