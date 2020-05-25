<!DOCTYPE html>
<html>

<!-- Head com os assets e cdns -->
@includeif('painel.layout.head')

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Menu Central -->
    @includeif('painel.layout.navbar')

    <!-- Menu Lateral -->
    @includeif('painel.layout.main_sidebar')

    <!-- Cabecalho da pagina -->
    @includeif('painel.layout.cabecalho')

    <!-- Conteudo da pagina -->
    @yield('content')
    <!-- conteúdo da Pagina -->

    <!-- Main content -->
    <section class="content">
    <div class ="panel panel-primary">
        <div class ="col-xs-12">
        <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Cadastrando Usuários</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" method="POST" action="{{ route('user.store') }}">
                    {{ csrf_field() }}

                    @if('session'('error'))
                      <span class="alert alert-danger">{{ session('error')}}</span>
                    @endif
                  <div class="row">
                    <div class="col-sm-10">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="control-label" for="name">
                          <i class="far fa-times-circle-o"></i> Nome Completo</label>

                        <input type="text" class="form-control" id="name" placeholder="Digite o Nome Completo" name="name" value="{{ old('name')}}" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="email">
                          <i class="far fa-times-circle-o"></i> Email</label>

                        <input type="text" class="form-control" id="email" placeholder="Digite o Email" name="email" value="{{ old('email')}}" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="password">
                          <i class="far fa-times-circle-o"></i> Senha</label>

                        <input type="text" class="form-control" id="password" placeholder="Digite a Senha " name="password" value="{{ old('password')}}" required>
                      </div>
                      <div class="form-group">
                        <label>Função</label>
                        <select class="form-control" name="role_id">
                            <option value="">Escolha uma opção</option>
                            @foreach ($roles as $role)
                              <option value="{{$role->id ?? ''}}">{{$role->name ?? ''}} </option>
                                
                            @endforeach
                            <option></option>

                        </select>
                      </div>  
                      <div class="box-footer">
                      <button type="submit" class="btn btn-success">Cadastrar</button>
                          <a href= "user.store" type="submit" class="btn btn-primary">Cancelar</a>
                      </div>
                    </div>
                  </div>
                  <!-- input states -->
                </form>
              </div>
              <!-- /.card-body -->
            </div>
    
        </div>
    </div>

    </section>


    <!-- /.content -->
  </div>



  <!-- Rodapé Sidebar -->
  @includeif('painel.layout.footer')

  @includeif('painel.layout.javascript')

  </div>
  <!-- ./wrapper -->
</body>

</html>
