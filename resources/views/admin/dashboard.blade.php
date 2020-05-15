<?php
    use Carbon\Carbon;
    use App\Cartcount;
?>
@extends('admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
       TỔNG QUAN
      </div>
      <?php
    //   $message = Session::get('message');
    //   if($message){
    //       echo $message;
    //       Session::put('message',null);
    //   }
  ?>
		<div class="agil-info-calendar">
      <div class="col-md-6 w3agile-notifications">
        <div class="notifications">
          <!--notification start-->
          {{-- {{ $alert }} --}}
            <header class="panel-heading">
              Lượt truy cập
            </header>
            <div class="notify-w3ls">
              <div class="alert alert-info clearfix">
                <span class="alert-icon"><i class="fa fa-eye"></i></span>
                <div class="notification-info">
                  <ul class="clearfix notification-meta">
                    <li class="pull-left notification-sender"><span><a >Số lượt truy cập hôm nay</a></span></li>
                    <li class="pull-right notification-time">
                      {{ $count->counts }}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          <!--notification end-->
          </div>
      </div>
      <div class="col-md-6 w3agile-notifications">
        <div class="notifications">
          <!--notification start-->
            <header class="panel-heading">
              Thống kê đơn hàng
            </header>
            <div class="notify-w3ls">
              <div class="alert alert-danger">
                <span class="alert-icon"><i class="fa fa-exclamation"></i></span>
                <div class="notification-info">
                  <ul class="clearfix notification-meta">
                    <li class="pull-left notification-sender"><span><a>Đơn chưa hoàn thành</a></span></li>
                    <li class="pull-right notification-time">
                      <?PHP
                        $alertt = Cartcount::all()->where('status',0)->count();
                        echo $alertt;
                        ?>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="alert alert-success ">
                <span class="alert-icon"><i class="fa fa-check-circle"></i></span>
                <div class="notification-info">
                  <ul class="clearfix notification-meta">
                    <li class="pull-left notification-sender"><a>Đã giao xong</a>  </li>
                    <li class="pull-right notification-time">
                      <?PHP
                        $alert = Cartcount::all()->where('status',1)->count();
                        echo $alert;
                        ?>
                    </li>
                  </ul>
                  <p>
                    <a href="#"> </a>
                  </p>
                </div>
              </div>
            </div>
          <!--notification end-->
          </div>
      </div>
      <div class="clearfix"> </div>
      <div class="col-md-6 w3agile-notifications">
        <div class="notifications">
          <!--notification start-->
          {{-- {{ $alert }} --}}
            <header class="panel-heading">
              Doanh thu
            </header>
            <div class="notify-w3ls">
              <div class="alert alert-info clearfix">
                <span class="alert-icon"><i class="fa fa-usd"></i></span>
                <div class="notification-info">
                  <ul class="clearfix notification-meta">
                    <li class="pull-left notification-sender"><span><a >Doanh thu hôm nay</a></span></li>
                    <li class="pull-right notification-time">
                      @php
                          $total = 0;
                      @endphp
                      @foreach ($product_order_date as $product =>$key)
                          @php
                              $subtotal = $key->price;
                              $total += $subtotal;
                          @endphp
                          <?php
                          // $productp = 0;
                          //   $productp += $product->price;
                          //   echo "<pre>";
                          // print_r($product);
                          // echo"</pre>";
                          ?>
                      @endforeach
                          <?php
                          echo number_format($total) .".VNĐ";
                          ?>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="alert alert-success ">
                <span class="alert-icon"><i class="fa fa-usd"></i></span>
                <div class="notification-info">
                  <ul class="clearfix notification-meta">
                    <li class="pull-left notification-sender"><a>Doanh thu trong tháng</a> </li>
                    <li class="pull-right notification-time">
                      @php
                          $total = 0;
                      @endphp
                      @foreach ($product_order_month as $product =>$key)
                          @php
                              $subtotal = $key->price;
                              $total += $subtotal;
                          @endphp
                          <?php
                          // $productp = 0;
                          //   $productp += $product->price;
                          //   echo "<pre>";
                          // print_r($product);
                          // echo"</pre>";
                          ?>
                      @endforeach
                          <?php
                          echo number_format($total) .".VNĐ";
                          ?>
                    </li>
                  </ul>
                  <p>
                  </p>
                </div>
              </div>
            </div>
          <!--notification end-->
          </div>
      </div>
    </div>
@endsection
@section('script')
<script>
  $('#select-all').click(function(event) {   
  if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;                        
      });
  } else {
      $(':checkbox').each(function() {
          this.checked = false;                       
      });
  }
});
</script>
@endsection
@section('dashboard')
     class="active"
@endsection