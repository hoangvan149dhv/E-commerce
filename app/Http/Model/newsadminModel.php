<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class newsadminModel extends Model
{
    protected $table = 'tbl_news';

    protected $primaryKey ='news_id';
    const CREATED_AT ='created_date';


}
