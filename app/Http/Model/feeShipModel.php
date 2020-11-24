<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class feeShipModel extends Model
{
    protected $table =('tbl_feeship');
    public $timestamps = false;
    protected $primaryKey = 'fee_id';


    public function city()
    {
        return $this->belongsTo('App\Http\Model\CityModel', 'fee_matp', 'matp');
    }
    public function province()
    {
        return $this->belongsTo('App\Http\Model\ProvinceModel','fee_maqh','maqh');
    }
    public function wards()
    {
        return $this->belongsTo('App\Http\Model\WardModel','fee_xa','xaid');
    }
}
