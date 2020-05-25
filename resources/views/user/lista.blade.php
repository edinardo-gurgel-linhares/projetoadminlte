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
        <div class ='panel-body'>
        <div class="box-header">   
            <h3 class="box-title">Lista de Usuários | Adicionar | 
                <a href="{{route('user.create')}}" class="fas fa-folder-plus"></a>
                @if(session('success')) | <span class="alert alert-success">{{session('success')}}@endif</span></h3>

        </div>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            {{-- CABEÇALHO DA TABELA --}}
                            <th>Nome</th>                        
                            <th>E-mail</th>                        
                            <th id="center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lista as $item)
                            <tr>
                                <!-- CAMPOS -->
                                <td>{{$item->name}}</td>                           
                                <td>{{$item->email}}</td>                           
                                <td>
                                  <a class = "btn btn-warning"><i class ="fa fa-edit"></i></a>                           
                                  <a class = "btn btn-danger"><i class ="fa fa-trash"></i></a>
                                </td>                           

                              </tr>
                        @empty
                            <tr>
                                <td>Nenhum registro encontrado!!</td>      
                            </tr>
                        @endforelse
                    </tbody>
                </table>
          </div><!-- /.container-fluid -->
          </div>

    <!-- RODAPÉ -->
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
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
            $(function () {
                $('#table').DataTable({
                        "lengthMenu": [[8, 25, 50, -1], [8, 25, 50, "Todos"]],
                        "language": {
                            "sEmptyTable": "Nenhum registro encontrado",
                            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ".",
                            "sLengthMenu": "_MENU_ resultados por página",
                            "sLoadingRecords": "Carregando...",
                            "sProcessing": "Processando...",
                            "sZeroRecords": "Nenhum registro encontrado",
                            "sSearch": "Procurar",
                            "oPaginate": {
                                "sNext": "Próximo",
                                "sPrevious": "Anterior",
                                "sFirst": "Primeiro",
                                "sLast": "Último"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar colunas de forma ascendente",
                                "sSortDescending": ": Ordenar colunas de forma descendente"
                            }
                        }
                    })
                } )
    </script>