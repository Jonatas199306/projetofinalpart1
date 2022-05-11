@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Unidades')

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
                        <li class="breadcrumb-item active">Unidades
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
                    <form action="{{ route('unidades.index') }}" class="w-100">
                        <div class="form-row">
                            <div class="col-md-5 mb-1">
                                <fieldset class="has-icon-left">
                                    <input type="text" name="nome" id="nome" class="form-control"
                                           placeholder="Nome">
                                    <div class="form-control-position">
                                        <i class="bx bx-buildings"></i>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-3 mb-1">
                                <fieldset class="has-icon-left">
                                    <input type="text" name="cnpj" id="cnpj" class="form-control"
                                           placeholder="CNPJ">
                                    <div class="form-control-position">
                                        <i class="bx bx-fingerprint"></i>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-4 mb-1">
                                <button type="submit" class="btn btn-dark">Pesquisar</button>
                                <a href="{{ route('unidades.cadastrar') }}" class="btn btn-primary">Cadastrar</a>
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
                                <th>CNPJ</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th style="display: flex; justify-content:center;"><i class="text-white bx bxs-cog font-medium-1"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($unidades as $unidade)
                                <tr>
                                    <td><?=$unidade['id']?></td>
                                    <td><?=
                                        count(str_split((string)$unidade['cnpj'])) === 14 
                                            ? Helper::mask($unidade['cnpj'], '##.###.###/####-##') 
                                            : $unidade['cnpj'] 
                                        ?>
                                    </td>
                                    <td><?=$unidade['nome']?></td>
                                    <td><?=$unidade['tipo']?></td>
                                    <td width="140px">
                                        <a href="{{ route('unidades.editar',$unidade->id) }}"><i
                                                class="badge-circle badge-circle-light-primary bx bxs-pencil font-medium-1"></i></a>
                                        <a href="{{ route('unidades.deletar',$unidade->id) }}"><i
                                                class="badge-circle badge-circle-light-danger bx bx-trash font-medium-1"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                            <div class="mx-auto">
                                <?php if (empty($dataForm) ) { ?>
                                {!! $unidades->links()!!}
                                <?php } else { ?>
                                {{ $unidades->appends($dataForm)->links() }}
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
    <script>addMasks()</script>
@endsection
