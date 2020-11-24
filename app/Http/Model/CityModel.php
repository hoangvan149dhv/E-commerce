<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $table =('tbl_city');
    public $timestamps = false;
    protected $primaryKey = 'matp';
}
