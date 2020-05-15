<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartcount extends Model
{
    protected $table =('tbl_order');
    public function count(){
        return $this->where('status',0)->count();
    }
}