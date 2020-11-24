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
    protected $primaryKey=('idd');

        public function comments()
        {
            return $this->hasMany('App\Http\Model\Comment', 'foreign_key', 'local_key');
        }

    protected $array = ['idName','idDesc'];
}
