<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    protected $table = ('tbl_review');

    protected $primarykey= ('Rid');
    public function product()
    {
        return $this->belongsTo('App\productModel', 'product_id', 'product_id');
    }
}
