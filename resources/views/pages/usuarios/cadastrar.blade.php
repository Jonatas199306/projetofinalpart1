@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Usuários')

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

<!-- inicio do formulário -->
<section class="multiple-validation">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a style="float: right;" href="{{route('usuarios.index')}}" class="btn btn-success mr-1 mb-1 round" ><i class="bx bx-undo"></i><span class="align-middle ml-25">Voltar</span></a>
            <h4 class="card-title">Formulário - Cadastrar</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
            <form class="form-horizontal"  method="POST" action="{{route('usuarios.salvar')}}" novalidate autocomplete="off">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nome completo *</label>
                      <div class="controls">
                        <input type="text" name="name" id="nome" class="form-control" placeholder="Nome"
                          required
                          data-validation-required-message="Preencher o campo nome"
                          data-validation-minlength-message="Mínimo 4 caracteres"
                          data-validation-required-message="Preencher o campo nome"
                          data-validation-regex-regex="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s ]+"
                          data-validation-regex-message="Números e caracteres especiais não permitido"
                          minlength="4">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>E-mail *</label>
                      <div class="controls">
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail"
                          required
                          data-validation-email-message= "Formato de e-mail incorreto"
                          data-validation-required-message="Preencher o campo e-mail"
                          autocomplete="off"
                          >
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Senha *</label>
                      <div class="controls">
                        <input type="password" name="password" id="senha" class="form-control" placeholder="Senha"
                          required
                          data-validation-required-message="Preencher o campo senha"
                          data-validation-minlength-message="Mínimo 6 caracteres"
                          minlength="6"
                          autocomplete="off"
                          >
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Confirmar a senha *</label>
                      <div class="controls">
                        <input type="password" name="confirm-password" id="con-senha" class="form-control"
                            placeholder="Confirmar senha"
                            required
                            data-validation-match-match="password"
                            data-validation-match-message="As senhas estão diferentes"
                            data-validation-required-message="Preencher o campo confirmação de senha"
                            data-validation-minlength-message="Mínimo 6 caracteres"
                            minlength="6"
                            autocomplete="off"
                            >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <fieldset class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="Grupo">Grupo</label>
                            </div>
                            <select class="form-control" id="grupos" name="roles"
                            required
                            data-validation-required-message="É necessário selecionar um grupo">
                                <option value='' disabled hidden selected> Selecionar</option>
                                @foreach($roles as $role)
                                     <option value="<?=$role?>"><?=$role?></option>
                                @endforeach
                            </select>
                          </div>
                        </fieldset>
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
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('js/usuarios/cadastrar.js')}}"></script>

@endsection
