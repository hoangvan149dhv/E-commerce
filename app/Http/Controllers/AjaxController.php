<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; //SỬ DỤNG DBS
use Session; // THƯ VIỆN SỬ DỤNG SESSION
use App\Http\Requests; // 
use Illuminate\Support\Facades\Redirect;
session_start();
class AjaxController extends Controller{
 public function GetAjax( $idOption)
    {
      $desc_product = DB::table('tbl_product')->select()->where('product_id',$idOption)->orderby('product_id','desc')->get();
      foreach($desc_product as $product){
          ?>
          <a href=""><img  class="img-fluid" src="public/upload/{{$product->product_image}}" />
											<h5 id="title"><?php echo $product->product_Name?></h5></a>
											<p><?php echo $product->product_Name?> .VNĐ</p>
                                            <a href="{{ URL::to('/chi-tiet/'.$product->product_id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ</a>
       <?php
      }
    }
}