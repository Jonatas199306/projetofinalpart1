@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title', 'Retorno')

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
                        <li class="breadcrumb-item active">Retorno
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
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input d-none" type="radio" id="importacao" value="importacao" name="action-options" checked>
                                        <label class="form-check-label btn rounded-pill btn-secondary" for="importacao">Importação</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input d-none" type="radio" id="consulta" value="consulta" name="action-options">
                                        <label class="form-check-label btn rounded-pill btn-outline-secondary" for="consulta">Consulta</label>
                                    </div>
    
                                </div>
                            </div>
                            <div class="row" id="container_importacao">
                                <div class="col-lg-4">
                                    <form class="form-group" enctype="multipart/form-data" id="form_arq_retorno">
                                      <label for="arq_retorno" class="btn rounded-pill btn-sm btn-outline-secondary" style="text-align: start">
                                            <i class="bx bx-file"></i>
                                            Importar Arquivo
                                        </label>
                                      <input type="file" class="d-none" name="arq_retorno" id="arq_retorno" aria-describedby="Botão para upload do arquivo de retorno">
                                    </form>
                                </div>
                            </div>
                            <div class="d-none" id="container_consulta">

                                <form action="" id="form_consulta_retorno" class="form-row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                          <label for="competencia">Competência</label>
                                          <input type="month"
                                            class="form-control" name="competencia" id="competencia" placeholder="Competência">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center mb-1">
                                        <button type="submit" class="btn btn-secondary" style="margin-top: auto">Pesquisar</button>
                                    </div>
                                </form>
                            </div>
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
    <script src="{{ asset('js/controle/retornos.js') }}"></script>
@endsection
