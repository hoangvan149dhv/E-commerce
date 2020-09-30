<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerorderModel extends Model
{
    protected $table = 'tbl_order';

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
}
