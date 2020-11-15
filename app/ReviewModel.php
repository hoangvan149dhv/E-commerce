<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    protected $table = ('tbl_review');

    protected $primarykey= ('Rid');
    public function product()
    {
        return $this->belongsTo('App\productModel', 'meta_slug', 'meta_slug');
    }
}
