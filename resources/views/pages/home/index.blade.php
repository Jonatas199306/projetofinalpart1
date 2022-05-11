@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Dashboard')

{{-- styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Acessos</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div id="chart-acessos"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

{{-- scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/ui/prism.min.js')}}"></script>
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('js/home/app.js')}}"></script>
@endsection
