@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Contas Bancárias')

{{-- styles --}}
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prilg.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
{{--     <style>
        input, textarea, select {
            text-transform: uppercase;
        }
    </style> --}}
@endsection

@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>
                window.onload = function (e) {
                    toastr.error('<?php echo $error?>');
                };
            </script>
        @endforeach
    @endif

    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Cadastro</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="/contas-bancarias">Contas Bancárias</a>
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
                        <a style="float: right;" href="{{route('contas-bancarias.index')}}"
                           class="btn btn-success mr-1 mb-1 round"><i class="bx bx-undo"></i><span
                                class="align-middle ml-25">Voltar</span></a>
                        <h4 class="card-title">Formulário - Editar</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST"
                                  action="/contas-bancarias/atualizar/<?=$contaBancaria->id?>"
                                  autocomplete="off">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Unidade</label>
                                            <div class="controls">
                                                <select name="unidades_id" id="unidade" class="form-control">
                                                    <option value="" selected disabled>Selecione uma opção</option>
                                                    @foreach($unidades as $unidade)
                                                        <option value="{{$unidade->id}}" {{$contaBancaria->unidades_id == $unidade->id ? 'selected' : ''}}>{{$unidade->nome}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Favorecido</label>
                                                <div class="controls">
                                                    <input type="text" name="favorecido" id="favorecido" class="form-control"
                                                        value="{{ $contaBancaria->favorecido }}"
                                                        placeholder="FAVORECIDO"
                                                        required
                                                        minlength="3"
                                                        onkeyup="maiuscula(this)"
                                                        >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>CNPJ do Favorecido (Somente números)</label>
                                            <div class="controls">
                                                <input type="text" name="favorecido_cnpj" id="favorecido_cnpj" class="form-control"
                                                       value="{{ $contaBancaria->favorecido_cnpj }}"
                                                       placeholder="CNPJ"
                                                       required
                                                       maxlength="14"
                                                       minlength="14">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Banco</label>
                                            <div class="controls">
                                                <select name="banco" id="banco" class="form-control">
                                                    <option value="" selected disabled>Selecione uma opção</option>
                                                    @foreach($bancos as $banco)
                                                        <option value="{{$banco->id}}" {{$banco->id == $banco->id ? 'selected' : ''}}>{{$banco->nome}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Agência (SOMENTE NÚMEROS E TRAÇO -)</label>
                                            <div class="controls">
                                                <input type="text" name="agencia" id="agencia" class="form-control"
                                                       value="{{ $contaBancaria->agencia }}"
                                                       placeholder="Agência"
                                                       required
                                                       pattern="[0-9-]+$"
                                                       minlength="3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Conta (SOMENTE NÚMEROS E TRAÇO -)</label>
                                            <div class="controls">
                                                <input type="text" name="conta" id="conta" class="form-control"
                                                       value="{{ $contaBancaria->conta }}"
                                                       placeholder="Conta"
                                                       required
                                                       pattern="[0-9-]+$"
                                                       minlength="3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Ativa</label>
                                            <div class="controls">
                                                <select name="ativa" id="ativa" class="form-control" required>
                                                    <option value="" selected disabled>SELECIONE</option>
                                                    <option value="S" {{$contaBancaria->ativa == 'S' ? 'selected' : ''}}>
                                                        SIM
                                                    </option>
                                                    <option value="N" {{$contaBancaria->ativa == 'N' ? 'selected' : ''}}>
                                                        NÃO
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" id="cadastrar">Atualizar</button>
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
    <script src="{{asset('js/jquerymask/jquery.mask.js')}}"></script>
    {{-- <script src="{{asset('js/contas-bancarias/editar.js')}}"></script> --}}
    <script src="{{asset('js/lib/uppercase.js')}}"></script>
    <script>addMasks()</script>
@endsection
