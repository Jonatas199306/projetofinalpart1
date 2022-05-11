@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Perfil')

{{-- styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">

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
              <h5 class="content-header-title float-left pr-1 mb-0">Perfil</h5>
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb p-0 mb-0">
                  <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active">Trocar Senha
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
            <a style="float: right;" href="{{route('usuarios.index')}}" class="btn btn-success mr-1 mb-1 round" ><i class="bx bx-undo"></i><span class="align-middle ml-25">Voltar</span></a>
            <h4 class="card-title">Trocar Senha</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
            <form class="form-horizontal" method="POST" action="/perfil/storeChangePassword" novalidate autocomplete="off" onsubmit="verifyIfIsInvalid(event)">
                @csrf
                @method('PATCH')
                <div class="row">
                                
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Senha</label>
                      <div class="controls">
                        <input type="password" name="password" id="senha" class="form-control" placeholder="Senha"
                        data-validation-minlength-message="Mínimo 6 caracteres"
                        minlength="6"
                        autocomplete="off"
                      >

                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Confirmar a senha</label>
                      <div class="controls">
                           <input type="password" name="confirm-password" id="con-senha" class="form-control" placeholder="Confirmar senha"
                            data-validation-match-match="password"
                            data-validation-match-message="As senhas estão diferentes"
                            data-validation-minlength-message="Mínimo 6 caracteres"
                            minlength="6"
                            autocomplete="off"
                          >

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
<script src="{{asset('vendors/js/ui/prism.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('js/usuarios/editar.js')}}"></script>
<script>

    const senha = document.getElementById('senha');
    const conSenha = document.getElementById('con-senha');

  function verifyIfIsInvalid(event) {

    if(!validatePassword()) {
      
      event.preventDefault();
    }
  }

  function validatePassword() {

    return (senha.value.length >= 6) && (senha.value === conSenha.value) ? true : false
  }

</script>

@endsection
