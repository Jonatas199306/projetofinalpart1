@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Beneficio Espécie')

{{-- styles --}}
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection

@section('content')

    @if ($message = Session::get('success'))
        <script>
            window.onload = function (e) {
                Swal.fire('', '<?php echo $message ?>', 'success');
            };
        </script>
    @endif
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
    <!-- Tabela  -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('especie.index') }}">
                        <div class="form-row">
                            <div class="col-sm-4 mb-1">
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="nome" name="nome" class="form-control" id="iconLeft1"
                                           placeholder="Nome">
                                    <div class="form-control-position">
                                        <i class="bx bx-mail-send"></i>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6 mb-1">
                                <button type="submit" class="btn btn-dark">Pesquisar</button>
                                <a href="{{ route('especie.cadastrar') }}" class="btn btn-primary">Cadastrar</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-content">
                    <!-- table head dark -->
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Editável</th>
                                <th style="display: flex; justify-content:center;"><i class="text-white bx bxs-cog font-medium-1"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($especies as $especie)
                                <tr>
                                    <td><?=$especie['id']?></td>
                                    <td><?=$especie['nome']?></td>
                                    <td><?=$especie['editavel'] === 'S' ? 'SIM' : 'NÃO'?></td>
                                    <td width="140px">
                                        <a href="{{ route('especie.editar',$especie->id) }}"><i
                                                class="badge-circle badge-circle-light-primary bx bxs-pencil font-medium-1"></i></a>
                                        <a href="{{ route('especie.deletar',$especie->id) }}"><i
                                                class="badge-circle badge-circle-light-danger bx bx-trash font-medium-1"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                            <div class="mx-auto">
                                <?php if (empty($dataForm) ) { ?>
                                {!! $especies->links()!!}
                                <?php } else { ?>
                                {{ $especies->appends($dataForm)->links() }}
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fim da tabela -->
@endsection

{{-- scripts --}}
@section('vendor-scripts')
    <script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('vendors/js/ui/prism.min.js')}}"></script>
@endsection
