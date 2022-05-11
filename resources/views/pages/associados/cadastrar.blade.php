@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Associados')

{{-- styles --}}
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">

@endsection

@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>
                window.onload = function(e){
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
                            <a href="/associados">Associados</a>
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
                        <a style="float: right;" href="{{route('associados.index')}}"
                           class="btn btn-success mr-1 mb-1 round"><i class="bx bx-undo"></i><span
                                class="align-middle ml-25">Voltar</span></a>
                        <h4 class="card-title">Formulário - Cadastrar</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{route('associados.salvar')}}"
                                  autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Número do Benefício</label>
                                            <div class="controls">
                                                <input type="number" name="beneficio" id="beneficio" class="form-control"
                                                       value="{{ old('beneficio') }}"
                                                       placeholder="Benefício"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label>Espécie</label>
                                            <div class="controls">
                                                <select name="beneficio_especie" id="beneficio_especie" class="form-control" required>
                                                    <option value="" selected disabled>Selecione</option>
                                                    @foreach($especies as $especie)
                                                        <option value="{{$especie->id}}">{{$especie->id}} - {{$especie->nome}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Afiliada</label>
                                            <div class="controls">
                                                <select name="afiliadas_id" id="afiliada" class="form-control" required>
                                                    <option value="" selected disabled>Selecione</option>
                                                    @foreach($afiliadas as $afiliada)
                                                        <option value="{{$afiliada->id}}">{{$afiliada->nome}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-9">
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
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>CPF</label>
                                            <div class="controls">
                                                <input type="text" name="cpf" id="cpf" class="form-control"
                                                       value="{{ old('cpf') }}"
                                                       placeholder="CPF"
                                                       required
                                                       minlength="14"
                                                       maxlength="14">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nascimento</label>
                                            <div class="controls">
                                                <input type="date" name="nascimento" id="nascimento" class="form-control"
                                                       value="{{ old('nascimento') }}"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Ativo</label>
                                            <div class="controls">
                                                <select name="ativo" id="ativo" class="form-control">
                                                    <option value="S" {{old('ativo') == 'S' ? 'selected' : ''}}>SIM</option>
                                                    <option value="N" {{old('ativo') == 'N' ? 'selected' : ''}}>NÃO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Entrada</label>
                                            <div class="controls">
                                                <input type="date" name="admissao" id="admissao" class="form-control"
                                                       value="{{ old('admissao') }}"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Desconto - %</label>
                                            <div class="controls">
                                                <input type="number" placeholder="0" name="desconto"
                                                       value="{{ old('desconto') }}"
                                                       id="desconto" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Ficha Arquivada</label>
                                            <div class="controls">
                                                <select name="ficha_autorizacao" id="ficha_autorizacao" class="form-control">
                                                    <option value="S" {{old('ficha_autorizacao') == 'S' ? 'selected' : ''}}>SIM</option>
                                                    <option value="N" {{old('ficha_autorizacao') == 'N' ? 'selected' : ''}}>NÃO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Exclusão</label>
                                            <div class="controls">
                                                <input type="date" name="solicitacao_exclusao" id="solicitacao_exclusao" class="form-control"
                                                       value="{{ old('solicitacao_exclusao') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Reativação</label>
                                            <div class="controls">
                                                <input type="date" name="cancelamento_exclusao" id="cancelamento_exclusao" class="form-control"
                                                       value="{{ old('cancelamento_exclusao') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Readmissão</label>
                                            <div class="controls">
                                                <input type="date" name="readmissao" id="readmissao" class="form-control"
                                                       value="{{ old('readmissao') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">


                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="controls">
                                                <input type="text"
                                                       class="form-control"
                                                       disabled
                                                       value="N/A">
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
    <script src="{{asset('vendors/js/ui/prism.min.js')}}"></script>
    <script src="{{asset('js/lib/uppercase.js')}}"></script>
    <script>addMasks()</script>
@endsection
