<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvinceModel extends Model
{
    protected $table =('devvn_quanhuyen');
    public $timestamps = false;
    protected $primaryKey = 'matqh';
}
