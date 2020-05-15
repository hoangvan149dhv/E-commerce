<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customerModel extends Model
{
    protected $table = ('tbl_customer');
    //khóa chinh
    protected $order=('cusid');
    public $timastamps = false;

}
