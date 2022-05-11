@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Beneficio Espécie')

{{-- styles --}}
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prilg.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">

@endsection

@section('content')
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Cadastro</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Beneficio Espécie
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
                    <div class="card-header">
                        <a style="float: right;" href="{{route('especie.index')}}"
                           class="btn btn-success mr-1 mb-1 round"><i class="bx bx-undo"></i><span
                                class="align-middle ml-25">Voltar</span></a>
                        <h4 class="card-title">Formulário - Cadastrar</h4>
                        <div class="mt-3">
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-block">
                                        <strong>{{ $error }}</strong>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{route('especie.salvar')}}"
                                  autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label>Nome do Benefício</label>
                                            <div class="controls">
                                                <input type="text" name="nome" id="nome" class="form-control"
                                                       value="{{ old('nome') }}"
                                                       placeholder="Nome"
                                                       required
                                                       minlength="3"
                                                       onkeyup="maiuscula(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Editável</label>
                                            <div class="controls">
                                                <select name="editavel" id="editavel" class="form-control" required>
                                                    <option value="S">SIM</option>
                                                    <option value="N" selected>NÃO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" id="cadastrar">Cadastrar</button>
                            </form>
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
    <script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('vendors/js/ui/prilg.min.js')}}"></script>
    <script src="{{asset('js/lib/uppercase.js')}}"></script>
@endsection
