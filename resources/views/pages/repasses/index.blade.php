@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title', 'Repasse')

{{-- styles --}}
@section('vendor-styles')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/ui/prilg.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/extensions/toastr.css') }}">

@endsection

@section('content')
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Controle</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Repasse
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- inicio do formulário -->
    <section class="multiple-validation">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">
                            kekeke
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- fim do formulário -->
@endsection

{{-- scripts --}}
@section('vendor-scripts')

@endsection
