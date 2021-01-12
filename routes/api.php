<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/test/{helo}&{xxx}&{abc}','api\test@test');
Route::post('/post',function(Request $request) {
   $request->a = 'hello';
   $request->b = 'name';
   $data['a'] = $request->a;
   $data['b'] = $request->b;
    return response()->json(['data' => $data], 200);
});
