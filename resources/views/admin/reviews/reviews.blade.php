<?php
    use Carbon\Carbon;
?>
@extends('admin.admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Đánh giá sản phẩm từ khách
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light table-hover "style="border:1px solid #eae6e6">
          <thead>
                <tr >
                    <th style="text-align:center">ID SP</th>
              <th style="text-align:center">Họ tên </th>
              <th style="text-align:center">Email</th>
              <th style="text-align:center">Nội dung</th>
              <th style="text-align:center">Ngày tháng</th>
              <th style="text-align:center">Tình Thái</th>
            </tr>
          </thead>
          <tbody>
           @foreach ($reviews as $reviewsadmin)
                <tr>
                    <td style="text-align:center">
                        <a href="{{ URL::to('/chi-tiet/'.$reviewsadmin->product->meta_slug) }}"target="_blank">{{ $reviewsadmin->product->product_Name}}</a>
                    </td>
                    <td style="text-align:center">  {{$reviewsadmin->Rname}}</td>
                    <td style="text-align:center">  {{($reviewsadmin->Remail)}}</td>
                    <td style="text-align:center">  {{($reviewsadmin->Rcomment)}}</td>
                    <td style="text-align:center">  {{Carbon::createFromFormat('Y-m-d H:i:s', $reviewsadmin->created_date)->format('d/m/yy | H:i:s')}}</td>
                    <td style="text-align:center;background:#bbecc457">
                    <a href="{{ URL::to('/deletestatus1/'.$reviewsadmin->Rid) }}" style="color:red">Xóa</a>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!! $reviews->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
