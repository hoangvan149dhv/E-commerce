<?php
    use Carbon\Carbon;
?>
@extends('admin.index')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liên hệ từ phía khách hàng
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light table-hover "style="border:1px solid #eae6e6">
          <thead>
            <tr >
              <th style="text-align:center">Họ tên </th>
              <th style="text-align:center">Email</th>
              <th style="text-align:center">Nội dung</th>
              <th style="text-align:center">Ngày tháng</th>
              <th style="text-align:center">Tình Thái</th>
            </tr>
          </thead>
          <tbody>
           @foreach ($contact as $contactadmin)
                <tr>
                    <td style="text-align:center">  {{$contactadmin->Con_Name}}</td>
                    <td style="text-align:center">  {{($contactadmin->Con_Email)}}</td>
                    <td style="text-align:center">  {{($contactadmin->Con_Content)}}</td>
                    <td style="text-align:center">  {{Carbon::createFromFormat('Y-m-d H:i:s', $contactadmin->created_at)->format('d/m/yy | H:i:s')}}</td>
                    @if ($contactadmin->status == 1)
                    <td style="text-align:center;background:#bbecc457">
                        <a href="{{ URL::to('/admin/update_status_contact/'.$contactadmin->id.'/0') }}" style="color:green;">Đã Đọc</a>
                        ||
                        <a href="{{ URL::to('/admin/delete_status/'.$contactadmin->id) }}" style="color:red">Xóa</a>
                    @else
                    <td style="text-align:center;background:#f0bcb470;">
                        <a href="{{ URL::to('/admin/update_status_contact/'.$contactadmin->id.'/1') }}" style="color:red">Chưa Đọc</a>
                    </td>
                    @endif
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!! $contact->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
