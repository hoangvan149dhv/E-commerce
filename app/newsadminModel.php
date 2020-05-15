<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class newsadminModel extends Model
{
    protected $table = 'tbl_news';
    //khóa chinh
    protected $primaryKey ='news_id';
    // public $timestamps = false;
    // protected $dateFormat = 'd-m-Y';
}
