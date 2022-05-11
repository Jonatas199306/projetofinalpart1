@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Usuários')

{{-- styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection

@section('content')

@if ($message = Session::get('success'))
<script>
   window.onload = function(e){
        Swal.fire('', '<?php echo $message ?>', 'success');
   };
   </script>
@endif
        <div class="content-header-left col-12 mb-2 mt-1">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h5 class="content-header-title float-left pr-1 mb-0">Segurança</h5>
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb p-0 mb-0">
                  <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active">Usuários
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
            <div class="row ">
                <form action="{{ route('usuarios.pesquisar') }}"  method="POST" class="form-inline">
                @csrf
                <div class="col-sm-6">
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="email" name="email" class="form-control" id="iconLeft1" placeholder="E-mail">
                        <div class="form-control-position">
                            <i class="bx bx-mail-send"></i>
                        </div>
                    </fieldset>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-dark">Pesquisar</button>
                    <a href="{{ route('usuarios.cadastrar') }}" class="btn btn-primary">Cadastrar</a>
                 </div>
                </form>
            </div>
        </div>

        <div class="card-content">
          <!-- table head dark -->
          <div class="table-responsive">
            <table class="table mb-0">
              <thead class="thead-dark">
                <tr>
                  <th>Nome</th>
                  <th >E-mail</th>
                  <th width="200">Grupos</th>
                  <th style="display: flex; justify-content:center;"><i class="text-white bx bxs-cog font-medium-1"></i></th>
                </tr>
              </thead>
              <tbody>
            @foreach($usuarios as $usuario)
                        @if(!empty($usuario->getRoleNames()))
                            @foreach($usuario->getRoleNames() as $v)
                                @if(($v <> 'Paciente') && ($v <> 'Médico'))
                                          <tr>
                                            <td>{{ $usuario['name'] }}</td>
                                            <td><?=$usuario['email']?></td>
                                            <td >
                                          <div class="badge badge-primary  d-inline-flex align-items-center mb-1">
                                              <i class="bx bxl-pocket mr-25"></i>
                                              <span>{{ $v }}</span>
                                          </div>
                                          </td>
                                          <td width="140px">
                                                <a href="{{ route('usuarios.editar',$usuario->id) }}"><i class="badge-circle badge-circle-light-primary bx bxs-pencil font-medium-1"></i></a> <a href="{{ route('usuarios.deletar',$usuario->id) }}"><i class="badge-circle badge-circle-light-danger bx bx-trash font-medium-1"></i></a>
                                            </td>
                                        </tr>
                                @endif
                              @endforeach
                         @endif
                    @endforeach
              </tbody>
            </table>
                      <div class="d-flex">
                          <div class="mx-auto">
                              <?php if (empty($dataForm) ) { ?>
                                  {!! $usuarios->links()!!}
                              <?php } else { ?>
                                  {{ $usuarios->appends($dataForm)->links() }}
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
