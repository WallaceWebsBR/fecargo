@extends('layouts.app')

@section('content')
@section('styles')
<style>
  .btn {
      margin: 10px 20px 20px 20px;
  }
  label {
  cursor: pointer;
  /* Style as you please, it will become the visible UI component. */
  }

  #upload {
    opacity: 0;
    position: absolute;
    z-index: -1;
  }
</style>
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Banco de Dados Interno - Preços</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table data-toggle="table" id="tabela" class="table table-striped">
                          <thead>
                          <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#import-table-modal">Importar Tabela</a>
                          <a href="{{ route('bancodedados.export-table')}}" class="btn btn-info">Exportar tabela</a>
                          <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-table-modal">Deletar Tabela</a>
                            <tr>
                              <th data-field="id">ID</th>
                              <th data-field="cidade">Cidade</th>
                              <th data-field="uf">Estado (UF)</th>
                              <th data-field="taxa_minima">Taxa Minima</th>
                              <th data-field="por_kg">Por Kg</th>
                              <th data-field="por_km">Por Km</th>
                              <th data-field="por_dia">Nome da Tabela</th>
                              <th data-field="SEGURO">Seguro do Produto</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="import-table-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-import" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-import">Importar Tabela</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('bancodedados.import-table') }}" method="POST" enctype="multipart/form-data" id="importar">
          @csrf
          <div class="form-group mb-4">
            <input type="file" name="file" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" onclick="$('#importar').submit()" data-bs-dismiss="modal">Importar Agora</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal2 -->
<div class="modal fade" id="delete-table-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-remove" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-remove">Remover Tabela</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('bancodedados.remove-table') }}" method="POST" id="remover">
          @csrf
          <select class="form-control" name="nome_tabela">
            <option selected disabled>Selecione uma tabela</option>
            @foreach($dados['tabelas'] as $tabela)
              <option value="{{ $tabela->nome_tabela }}">{{ $tabela->nome_tabela }}</option>
            @endforeach
          </select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" onclick="$('#remover').submit()" data-bs-dismiss="modal">Remover Agora</button>
      </div>
    </div>
  </div>
</div>
  @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
    $('#tabela').DataTable({
      buttons: [
        'copy', 'excel', 'pdf'
      ],
      ajax: {
        url: "{{route('bancodedados.api')}}",
        dataSrc: '',
      },
      columns: [
        {data: 'id' },
        {data: 'cidade'},
        {data: 'uf'},
        {data: 'taxa_minima'},
        {data: 'por_kg'},
        {data: 'por_km'},
        {data: 'nome_tabela'},
        {data: 'SEGURO'},
      ],
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
      }
    })
  </script>
  @endsection
@endsection
