<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WardModel;
use App\ProvinceModel;
use App\CityModel;
use App\feeShipModel;
class DeliveryController extends AdminController
{
    //LAYOUT_DELIVERY
    public function layout_add_delivery(){
        $this->AuthLogin();
        $city = CityModel::orderby('matp','ASC')->get();

        // $feeship = feeShipModel::orderby('fee_id','desc')->get();

        return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    
    //SELECT STATE DELIVERY
    public function select_delivery(Request $request){

        //$data : data ajax add_delivery
        $data = $request->all();
        
        //action data->action 
        if($data['action']){

            $output = '';

            if($data['action'] == 'city'){

                $select_province = ProvinceModel::where('matp',$data['ma_id'])->orderby('maqh','asc')->get();
                echo '<option value="0"><--Chọn Quận huyện--></option>';

                foreach ($select_province as $key => $province)
                {
                    var_dump($province->name);
                     echo '<option value="'.$province->maqh.'">'.$province->name.'</option>';
                }
            }

            else
            {

                $select_wards = WardModel::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                echo '<option value="0"><--Chọn Xa Phuong--></option>';

                foreach ($select_wards as $key => $wards) 
                {
                    echo '<option value="'.$wards->xaid.'">'.$wards->name.'</option>';
                }

            }
        
        }

    }

    public function select_info_delivery(){
        $feeship = feeShipModel::orderby('fee_id','desc')->get();
        echo '<div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th></th>
              <th>Thành phố / tỉnh</th>
              <th>Quận / huyện</th>
              <th>Phường / xã</th>
              <th>Phí ship</th>
            </tr>
          </thead>
          <tbody>';
        foreach ($feeship as $key => $fee_ship) {
            echo ' <tr>
                    <td>'.$fee_ship->fee_id.'</td>
                    <td>'.$fee_ship->city->name.'</td>
                    <td>'.$fee_ship->province->name.'</td>
                    <td>'.$fee_ship->wards->name.'</td>
                    <td>
                        <input  data-feeship="'.$fee_ship->fee_id.'"  type="text"  value=" '.number_format($fee_ship->fee_feeship,0,',','.').' VNĐ" class="fee_ship">
                    </td>
                    </tr> ';
        }
        echo '</tbody>
            </table>
        </div>';
    }

    public function insert_fee_delivery(Request $request){

        $feeship = new feeShipModel();

        $feeship->fee_matp = $request['city'];

        $feeship->fee_maqh = $request['province'];

        $feeship->fee_xa = $request['wards'];

        $feeship->fee_feeship = $request['fee'];

        // if ($request['city'] == 0 || $request['province'] == 0 || $request['wards'] == 0) {
            
        //     echo "<script>alert('vui lòng điền đầy đủ các trường')</script>";
        // }
        // else{
            $feeship->save();
        // }
    }

    public function update_fee_delivery(Request $request){ 
        
        // $data = $request->all();

        $feeship_update = new feeShipModel();
        
        $data['fee_feeship'] = $request['fee_ship'];        

        $feeship_update->where('fee_id',$request['id_fee_ship'])->update($data);
    }
}