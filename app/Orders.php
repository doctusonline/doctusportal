<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model {

	//

	protected $table = 'orders';

	protected $fillable = ['sku'];

	protected $hidden = ['remember_token'];       
      
    public function mageorders() {
       return $this->belongsToMany('App\Mageorders');
    }


}
