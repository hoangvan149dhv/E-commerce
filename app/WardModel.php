<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WardModel extends Model
{
    protected $table =('devvn_xaphuongthitran');
    public $timestamps = false;
    protected $primaryKey = 'xaid';
}
