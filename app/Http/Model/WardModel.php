<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class WardModel extends Model
{
    protected $table =('tbl_ward');

    public $timestamps = false;

    protected $primaryKey = 'xaid';
}
