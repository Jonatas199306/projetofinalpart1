@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Unidades')

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
                        <li class="breadcrumb-item active">Unidades
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
                        <a style="float: right;" href="{{route('unidades.index')}}"
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
                            <form class="form-horizontal" method="POST" action="{{route('unidades.salvar')}}"
                                  autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>CNPJ</label>
                                            <div class="controls">
                                                <input type="text" name="cnpj" id="cnpj" class="form-control"
                                                       value="{{ old('cnpj') }}"
                                                       placeholder="CNPJ"
                                                       required
                                                       minlength="14">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label>Nome</label>
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
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Sigla </label>
                                            <div class="controls">
                                                <input type="text" name="sigla" id="sigla" class="form-control"
                                                       value="{{ old('sigla') }}"
                                                       placeholder="Sigla"
                                                       minlength="1"
                                                       required
                                                       onkeyup="maiuscula(this)">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <div class="controls">
                                                <select name="tipo" id="tipo" class="form-control" required>
                                                    <option value="ESTADUAL">Estadual</option>
                                                    <option value="NACIONAL">Nacional</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <div class="controls">
                                                <input type="email" name="email" id="email" class="form-control"
                                                       value="{{ old('email') }}"
                                                       required
                                                       placeholder="E-mail"
                                                       autocomplete="off"
                                                       onkeyup="maiuscula(this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Telefone</label>
                                            <div class="controls">
                                                <input type="text" name="telefone" id="telefone" class="form-control"
                                                       value="{{ old('telefone') }}"
                                                       placeholder="(xx) xxxx-xxxx"
                                                       autocomplete="off"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Celular (Opcional)</label>
                                            <div class="controls">
                                                <input type="text" name="celular" id="celular" class="form-control"
                                                       value="{{ old('celular') }}"
                                                       placeholder="(xx) xxxx-xxxx"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>CEP</label>
                                            <div class="controls">
                                                <input type="number" name="cep" id="cep" class="form-control"
                                                       value="{{ old('cep') }}"
                                                       placeholder="CEP"
                                                       autocomplete="off"
                                                       required
                                                       >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label>Endereço</label>
                                            <div class="controls">
                                                <input type="text" name="endereco" id="endereco" class="form-control"
                                                       value="{{ old('endereco') }}"
                                                       placeholder="AV. Teste"
                                                       autocomplete="off"
                                                       required
                                                       onkeyup="maiuscula(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Número</label>
                                            <div class="controls">
                                                <input type="number" name="numero" id="numero" class="form-control"
                                                       value="{{ old('numero') }}"
                                                       required
                                                       placeholder="45"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Complemento (Opcional)</label>
                                            <div class="controls">
                                                <input type="text" name="complemento" id="complemento"
                                                       value="{{ old('complemento') }}"
                                                       class="form-control" placeholder="Complemento"
                                                       autocomplete="off"
                                                       onkeyup="maiuscula(this)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label>Bairro</label>
                                            <div class="controls">
                                                <input type="text" name="bairro" id="bairro" class="form-control"
                                                       value="{{ old('bairro') }}"
                                                       placeholder="Bairro"
                                                       autocomplete="off"
                                                       required
                                                       onkeyup="maiuscula(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label>Cidade</label>
                                            <div class="controls">
                                                <input type="text" name="cidade" id="cidade" class="form-control"
                                                       placeholder="Cidade"
                                                       autocomplete="off"
                                                       required
                                                       onkeyup="maiuscula(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <div class="controls">
                                                <input type="text" name="estado" id="estado" class="form-control"
                                                       value="{{ old('estado') }}"
                                                       placeholder="Estado"
                                                       autocomplete="off"
                                                       minlength="2"
                                                       maxlength="2"
                                                       required
                                                       onkeyup="maiuscula(this)">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Ativo</label>
                                            <div class="controls">
                                                <select name="ativo" id="ativo" class="form-control" required>
                                                    <option value="S">SIM</option>
                                                    <option value="N">NÃO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Taxa Administrativa (Obrigatório)</label>
                                            <div class="controls">
                                                <input type="number" placeholder="0" name="taxa_administrativa"
                                                       value="{{ old('taxa_administrativa') }}"
                                                       id="taxa_administrativa" class="form-control"
                                                       step="any"
                                                       required>
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
    <script src="{{asset('js/cep.js')}}"></script>
    <script>addMasks()</script>
@endsection
