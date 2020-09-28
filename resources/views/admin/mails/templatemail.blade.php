<?php
    // use Carbon\Carbon;
?>
@extends('admin.admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        @foreach ($template as $item)
        <a href="{{URL::to('/chi-tiet-template/'.$item->id)}}"style='color:green;font-size:20px' class="active" ui-toggle-class="">
            <i class="fa fa-pencil-square-o text-success text-active"></i></a>
        @endforeach
        <div class="container">
            <div class="col-sm-12 content">
                {!! $item->template !!}
            </div>
        </div>
    </div>
  </div>
@endsection
@section('mail')
     class="active"
@endsection
