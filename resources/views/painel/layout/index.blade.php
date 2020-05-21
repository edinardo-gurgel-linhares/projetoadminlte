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
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                @inject('user', 'App\User')
                <h3>{{$user->count()}}</h3>

                <p>Lista de Usuários</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{route('user.lista')}}" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                @inject('calibre', 'App\Models\Arma\Calibre')
                <h3>{{$calibre->count()}}</h3>

                <p>Lista de Calibres</p>
              </div>
              <div class="icon">
                <i class="fas fa-crosshairs"></i>
              </div>
              <a href="{{route('arma.calibre.lista')}}" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>Diárias Registradas</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">Mais Informações<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Auditorias</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Mais Informações<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div><!-- /.container-fluid -->

    </section>

    <section class="content">
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