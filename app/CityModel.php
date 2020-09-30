<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $table =('devvn_tinhthanhpho');
    public $timestamps = false;
    protected $primaryKey = 'matp';
}
