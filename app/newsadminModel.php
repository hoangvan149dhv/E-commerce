<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class newsadminModel extends Model
{
    protected $table = 'tbl_news';

    protected $primaryKey ='news_id';
}
