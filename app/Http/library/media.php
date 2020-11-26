<?php
namespace App\Http\library;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;

class media extends BaseController
{
    public static function cleanImage($img_del) {
        $del_file   ="public/upload/".$img_del;

        if(file_exists($del_file))
        {
            unlink($del_file);
        }
    }
}
