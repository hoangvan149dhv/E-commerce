<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    protected $table = ('tbl_review');

    //khóa chính
    protected $primarykey= ('Rid');
    public function product()
    {
        return $this->belongsTo('App\productModel', 'meta_slug', 'meta_slug');
    }
    // public function orderby()
    // {
    //     $orderby = $this->orderby('Rid','desc');
    //     return $orderby;
    // }
}
