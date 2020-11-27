<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table =('tbl_orders');

    protected $primaryKey ='orderid';

    public function count()
    {
        return $this->where('status',0)->count();
    }

    public function getOrderId($id) {
        if (empty($id)) {
            Session::put('error', 'Đơn Hàng Không Tồn Tại');
            return Redirect::to('/trang-chu');
        }

        $data = self::find($id);
        return $data;
    }
    public function customer()
    {
        return $this->hasOne('App\Http\Model\customerModel','cusid','cusid');
    }
    public function getProduct()
    {
        return $this->hasMany('App\Http\Model\OrderModel','product_id','product_id');
    }
}
