<?php
//TEST 
namespace App;

use Illuminate\Database\Eloquent\Model;
//SỬ DỤNG CLASS modeltext bên controllerText
class modeltext extends Model
{   
    //tbl
    protected $table = ('tbl_text'); //KHAI BÁO  TABLE TRONG DBS

    //KHÓA CHINH
    protected $primaryKey=('idd'); // LƯU Ý, KHAI BÁO KHÓA CHÍNH, NẾU KHÔNG MẶC ĐỊNH SẼ LÀ (id)

        public function comments()
        {
            return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
        }
    
    //KHAI BÁO thêm CÁC THÀNH PHẦN TRONG TABLE
    protected $array = ['idName','idDesc']; //TRONG tbl
}
