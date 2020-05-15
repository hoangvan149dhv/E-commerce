<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerorderModel extends Model
{
    protected $table = 'tbl_order';
    //khóa chinh
    protected $primary='order_id';
    public $timastamps = false;

    public function productorder()
    {
        return $this->belongsTo('App\productModel', 'product_id', 'product_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\customerModel','cusid','cusid');
    }

      //  return $this->hasMany('App\Comment', 'foreign_key', 'local_key');

        //  return $this->belongsTo('App\User', 'foreign_key', 'other_key');
    
  
}
