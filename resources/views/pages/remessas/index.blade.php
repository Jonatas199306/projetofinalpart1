@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title', 'Remessa')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Geração</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Remessa
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
                            <form id="formGerarRemessa" class="form-horizontal" method="POST" autocomplete="off">
                                {{-- {{ route('remessas.gerarRemessa') }} --}}

                                @csrf
                                <div class="form-row d-flex align-items-end">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Competência</label>
                                            <div class="controls">
                                                <input type="month" name="competencia" id="competencia"
                                                    class="form-control" value="{{ old('cnpj') }}" placeholder="CNPJ"
                                                    required minlength="14">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 mb-1 d-flex">
                                        <button type="submit" class="btn btn-secondary mr-1" id="atualizarLista">
                                            <i class="bx bx-refresh"></i>
                                            Atualizar Lista
                                        </button>
                                        <button type="submit" class="btn btn-primary mr-1" id="cadastrar">
                                            <i class="bx bx-file" id="cadastar-icon"></i>
                                            <span id="cadastrar-text">Gerar Remessa</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-0 mb-4">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th style="width: 150px">Unidade</th>
                                                    <th>Afiliada</th>
                                                    <th style="width: 150px">Qtd. Atual</th>
                                                    <th style="width: 150px">Qtd. Novos</th>
                                                    <th style="width: 150px">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($afiliadas as $afiliada)
                                                    <tr>
                                                        <td>{{ $afiliada->unidade_sigla }}</td>
                                                        <td id="afiliada_nome_{{ $afiliada->id }}">{{ $afiliada->nome }}
                                                        </td>
                                                        <td>{{ $afiliada->qtde_associados }}</td>
                                                        <td>{{ $afiliada->qtde_novos_associados }}</td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-sm badge-circle btn-icon btn-secondary"
                                                                data-toggle="tooltip" title="Ver associados"
                                                                onclick="getNewAssociados({{ $afiliada->id }})">
                                                                <i class="bx bx-search-alt" style="transform: translateY(-23%)"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('pages.remessas.modal_show_associado')
    </section>

    <!-- fim do formulário -->


@endsection

{{-- scripts --}}
@section('vendor-scripts')
    <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
    {{-- <script src="{{ asset('vendors/js/ui/prilg.min.js') }}"></script> --}}
    <script src="{{ asset('js/lib/uppercase.js') }}"></script>
    <script src="{{ asset('js/cep.js') }}"></script>
    <script>

        const formGerarRemessa = document.getElementById('formGerarRemessa');
        const cadastarBtn = document.getElementById('cadastrar');
        const cadastrarText = document.getElementById('cadastrar-text');
        const cadastrarIcon = document.getElementById('cadastar-icon');
        addMasks();

        function getNewAssociados(idAfiliada) {

            $('#showModalAssociados').modal('show');

            modalAfiliadaNome.textContent = document.getElementById('afiliada_nome_' + idAfiliada).textContent
            $('#modalTableAssociados tbody').empty();

            $.get('/remessa/getNewAssociados/' + idAfiliada, function(response) {

                response.forEach(associado => {
                    $('#modalTableAssociados tbody').append(`
                <tr>
                  <td>${associado.beneficio}</td>
                  <td>${associado.nome}</td>
                  <td>${associado.cpf}</td>
                  <td>${associado.admissao}</td>
                  <td>${associado.desconto}</td>
                <tr>
              `);
                })
            })
        }

        formGerarRemessa.onsubmit = event => {
            event.preventDefault();
            
            const { competencia } = formGerarRemessa;
            addLoader();

            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content') },
                url: "/remessa/gerar",
                data: {competencia: competencia.value},
                dataType: "json",
                success: function (response) {

                    const {fileUrl, fileName} = response;

                    removeLoader();
                    downloadRemessa(fileUrl, fileName);
                },
                error: function(response) {

                    removeLoader();
                    toastr.warning(response.responseJSON.message);
                    console.log(response.responseJSON.message);
                }
            });
        }

        function downloadRemessa(fileUrl, fileName) {

            var a = document.createElement("a");
            a.href = fileUrl;
            a.setAttribute("download", fileName);
            a.click();
        }

        function addLoader() {

            cadastarBtn.setAttribute('disabled', '');
            cadastrarText.textContent = "Gerando Remessa...";
            cadastrarIcon.classList = "bx bx-loader spin";
        }

        function removeLoader() {

            cadastarBtn.removeAttribute('disabled');
            cadastrarText.textContent = "Gerar Remessa";
            cadastrarIcon.classList = "bx bx-file";
        }

    </script>
@endsection
