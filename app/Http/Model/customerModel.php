<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class customerModel extends Model
{
    protected $table = ('tbl_customer');

    protected $order=('cusid');
    public $timastamps = false;

    public static function remove($cusId)
    {
        self::where('cusid',$cusId)->delete();
    }
}
