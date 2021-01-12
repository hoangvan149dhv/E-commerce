<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Model\CityModel;
use Illuminate\Http\Request;
use Cart;
class checkoutController extends HomeController
{
    public function checkout(Request $request)
    {
        $city = CityModel::orderby('matp', 'ASC')->get();
        view()->share('city', $city);

        return view('frontend.checkout.checkout');
    }
}
