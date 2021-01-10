<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class test extends Controller
{
    
    public function test($a,$b, $d)
    {
        $data['a'] = $a;
        $data['b'] = $b;
        $data['c'] = $d;
        return response()->json(['data' => $data], 200);
    }
}
