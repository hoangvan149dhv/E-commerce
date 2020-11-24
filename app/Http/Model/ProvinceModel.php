<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ProvinceModel extends Model
{
    protected $table =('tbl_province');

    public $timestamps = false;

    protected $primaryKey = 'matqh';
}
