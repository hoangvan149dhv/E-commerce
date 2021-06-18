<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Model\CustomerorderModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Model\OrderModel;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class OrderController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($status)
    {
        $orderModel = new OrderModel();

        $order_item = is_numeric($status) ? $orderModel->where('status', $status)->orderby('orderid',
            'desc')->paginate(15)
            : $orderModel->orderby('orderid', 'desc')->paginate(15);

        session::put('message', DB::table('tbl_orders')->where('status', 0)->count());

        return view('admin.order.order')->with('product_order', $order_item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($orderid = null)
    {
        if (!$orderid)
        {
            return back();
        }
        $infocustomer = CustomerorderModel::where('orderid', $orderid)->get();
        $orderItems = $infocustomer[0]->toArray();

        $getProductItems = explode(',', $orderItems['product_id']);
        $order_item_qty_value = explode(',', $orderItems['qty']);

        return view('admin.infoOrder.infoOrder')
            ->with('getProductItems', $getProductItems)
            ->with('infocustomerorder', $infocustomer)
            ->with('order_item_qty_value', $order_item_qty_value);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update($orderid, $order_status)
    {
        try {
            $data['status'] = $order_status;

            DB::table('tbl_orders')->where('orderid', $orderid)->update($data);
        }
        catch (\Exception $e)
        {

        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->orderid;
        $id ? DB::table('tbl_orders')->whereIn('orderid', $id)->delete() : "";

        return back();
    }
}
