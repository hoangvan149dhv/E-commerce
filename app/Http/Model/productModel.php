<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    protected $table = ('tbl_product');

    protected $primary=('product_id');

}
