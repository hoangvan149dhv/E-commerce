<?php
use Carbon\Carbon;
use App\Http\Model\OrderModel;
?>
@extends('admin.index')
@section('content')
    <!-- //market-->
    <div class="market-updates">
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-1">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-eye"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Lượt truy cập</h4>
                    <h3>{{ $count->counts }}</h3>
                    <p>Số lượt truy cập</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-exclamation-circle"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Đơn hàng chưa xác nhận</h4>
                    <h3><?php
                        $order_status_notcomplete = OrderModel::all()->where('status', 0)->count();
                        echo $order_status_notcomplete;
                        ?>
                    </h3>
                    <p>Đơn hàng chưa được hoàn thành</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-3">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-usd"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Đã bán</h4>
                    <h3>@php
                            $total = 0;
                        @endphp
                        @foreach ($product_order_month as $product => $key)
                            @php
                                $subtotal = $key->total;
                                $total += $subtotal;
                            @endphp
                        @endforeach
                        <?php
                        echo number_format($total).".VNĐ";
                        ?>
                    </h3>
                    <p>Đơn hàng đã bán được trong tháng này</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Tổng đơn hàng</h4>
                    <h3>{{ count($totalOder) }}</h3>
                    <p>Tổng đơn hàng đã đặt</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="agile-last-grid">
        <div class="area-grids-heading">
            <h3>Doanh thu trong 12 tháng năm {{Carbon::now()->format('Y')}}</h3>
        </div>
        <div id="graph8"></div>
        <script>
            var dataString = '{{$dataOderofMonth}}';
            var dataJson = JSON.parse(dataString.replace(/&quot;/g,'"'));
            var month_data = dataJson;
            Morris.Bar({
                element: 'graph8',
                data: month_data,
                xkey: 'Month',
                ykeys: ['Total'],
                labels: ['Total'],
                xLabelAngle: 10,
                barColors: function (row, series, type) {
                    if (type === 'bar') {
                        var red = Math.ceil(255 * row.y / this.ymax);
                        return 'rgb(' + red + ',0,0)';
                    }
                    else {
                        return '#000';
                    }}
            });
        </script>
    </div>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                TỔNG QUAN
            </div>
            <div class="agil-info-calendar">
                <div class="col-md-6 w3agile-notifications">
                    <div class="notifications">
                        <!--notification start-->
                        <header class="panel-heading">
                            Thống kê đơn hàng
                        </header>
                        <div class="notify-w3ls">
                            <div class="alert alert-info clearfix">
                                <span class="alert-icon"><i class="fa fa-shopping-cart"></i></span>
                                <div class="notification-info">
                                    <ul class="clearfix notification-meta">
                                        <li class="pull-left notification-sender"><span><a>Doanh thu hôm nay</a></span>
                                        </li>
                                        <li class="pull-right notification-time">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($product_order_date as $product =>$key)
                                                @php

                                                    $subtotal = $key->total;
                                                    $total += $subtotal;
                                                @endphp
                                                <?php
                                                $productp = 0;
                                                $productp += $key->price;
                                                echo "<pre>";
                                                print_r($product);
                                                echo"</pre>";
                                                ?>
                                            @endforeach
                                            <?php
                                            echo number_format($total).".VNĐ";
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--notification end-->
                    </div>
                </div>
                <!-- calendar -->
                <div class="col-md-6 agile-calendar">
                    <div class="calendar-widget">
                        <div class="panel-heading ui-sortable-handle">
					<span class="panel-icon">
                      <i class="fa fa-calendar-o"></i>
                    </span>
                        </div>
                        <!-- grids -->
                        <div class="agile-calendar-grid">
                            <div class="page">

                                <div class="w3l-calendar-left">
                                    <div class="calendar-heading">

                                    </div>
                                    <div class="monthly" id="mycalendar"></div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //calendar -->
            </div>
            @endsection
            @section('script')
                <script src="{{asset('public/admin/js/monthly.js')}}"></script>
                <script type="text/javascript">
                    $(window).load(function () {

                        $('#mycalendar').monthly({
                            mode: 'event',

                        });

                        $('#mycalendar2').monthly({
                            mode: 'picker',
                            target: '#mytarget',
                            setWidth: '250px',
                            startHidden: true,
                            showTrigger: '#mytarget',
                            stylePast: true,
                            disablePast: true
                        });

                        switch (window.location.protocol) {
                            case 'http:':
                            case 'https:':
                                // running on a server, should be good.
                                break;
                            case 'file:':
                                alert('Just a heads-up, events will not work when run locally.');
                        }

                    });
                </script>
                <!-- //calendar -->
            @endsection
            @section('dashboard')
                class="active"
@endsection
