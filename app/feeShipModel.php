<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feeShipModel extends Model
{
    protected $table =('devvn_feeship');
    public $timestamps = false;
    protected $primaryKey = 'fee_id';

    
    public function city()
    {
        return $this->belongsTo('App\CityModel', 'fee_matp', 'matp');
    }
    public function province()
    {
        return $this->belongsTo('App\ProvinceModel','fee_maqh','maqh');
    }
    public function wards()
    {
        return $this->belongsTo('App\WardModel','fee_xa','xaid');
    }

      //  return $this->hasMany('App\Comment', 'foreign_key', 'local_key');

        //  return $this->belongsTo('App\User', 'foreign_key', 'other_key');
    
}
