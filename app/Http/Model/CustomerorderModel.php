<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerorderModel extends Model
{
    protected $table = 'tbl_orders';

    protected $primary='order_id';
    public $timastamps = false;

    public function productorder()
    {
        return $this->hasMany('App\Http\Model\productModel', 'product_id', 'product_id');
    }
    public function customer()
    {
        return $this->hasOne('App\Http\Model\customerModel','cusid','cusid');
    }
}
