@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Contas Bancárias')

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
                        <li class="breadcrumb-item active">Contas Bancárias</li>
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
                    <form action="{{ route('contas-bancarias.pesquisar') }}" method="POST">
                        <div class="form-row">
                            @csrf
                            <div class="col-sm-4 mb-1">
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="text" name="favorecido" class="form-control" id="favorecido"
                                           placeholder="Favorecido">
                                    <div class="form-control-position">
                                        <i class="bx bx-mail-send"></i>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-sm-6 mb-1">
                                <button type="submit" class="btn btn-dark">Pesquisar</button>
                                <a href="{{ route('contas-bancarias.cadastrar') }}" class="btn btn-primary">Cadastrar</a>
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
                                <th style="min-width: 360px;">Unidade</th>
                                <th style="min-width: 360px;">Favorecido</th>
                                <th>CNPJ</th>
                                <th>Banco</th>
                                <th>Agência</th>
                                <th>Conta</th>
                                <th>Ativa</th>
                                <th width="140px" style="display: flex; justify-content:center;"><i class="text-white bx bxs-cog font-medium-1"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contasBancarias as $contaBancaria)
                                <tr>
                                    <td><?=$contaBancaria->unidade->nome?></td>
                                    <td><?=$contaBancaria->favorecido?></td>
                                    <td><?=
                                        count(str_split((string)$contaBancaria->favorecido_cnpj)) === 14 
                                            ? Helper::mask($contaBancaria->favorecido_cnpj, '##.###.###/####-##') 
                                            : $contaBancaria->favorecido_cnpj 
                                        ?>
                                    </td>
                                    <td><?=$contaBancaria->banco?></td>
                                    <td><?=$contaBancaria->agencia?></td>
                                    <td><?=$contaBancaria->conta?></td>
                                    <td><?=$contaBancaria->ativa === 'S' ? 'SIM' : 'NÃO'?></td>
                                    <td>
                                        <a href="{{ route('contas-bancarias.editar',$contaBancaria->id) }}">
                                            <i class="badge-circle badge-circle-light-primary bx bxs-pencil font-medium-1"></i></a>
                                        <a href="{{ route('contas-bancarias.deletar',$contaBancaria->id) }}"><i
                                                class="badge-circle badge-circle-light-danger bx bx-trash font-medium-1"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                            <div class="mx-auto">
                                <?php if (empty($dataForm) ) { ?>
                                {!! $contasBancarias->links()!!}
                                <?php } else { ?>
                                {{ $contasBancarias->appends($dataForm)->links() }}
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
