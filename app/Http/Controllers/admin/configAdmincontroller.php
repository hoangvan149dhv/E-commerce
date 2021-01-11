<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
class configAdmincontroller extends AdminController
{
    public function configlayout() {
        return view('admin.config.config');
    }
    public function updateConfig(Request $request)
    {
        $SEO = null;

        if ($request->check_SEO)
        {
            $SEO = 1;
        }
        $myfile = fopen("./config/config_admin.php", "w") or die("Unable to open file!");
        $txt = "
<?php
return [
    'mail' => [
        'publish' => ''
    ],
    'SEO' => '".$SEO."',
    'site_name' => '".$request->webshop_shop."',
    'meta_title' => '".$request->meta_title."',
    'meta_desc' => '".$request->meta_desc."',
    'meta_keywords' => '".$request->meta_keywords."'
];";

        fwrite($myfile, $txt);
        fclose($myfile);
        Session::put('config-success','Lưu thông tin thành công');

        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('view:clear');
        return back();
    }
}
