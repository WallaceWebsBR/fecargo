@extends('layouts.app')

@section('content')
@section('styles')
<style>
  .btn {
      margin-top: 10px;
      margin-bottom: 10px;
  }
</style>
@endsection
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Calculo de Fretes (Modulo 1)</div>
                <div class="card-body">
                  @if($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                  </div>
                  @endif
                   <form action="{{ route('home.calcular') }}" class="form-group" id="form-frete" role="form" method="POST">
                       @csrf
                       <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="peso-tab" data-bs-toggle="tab" data-bs-target="#peso" type="button" role="tab" aria-controls="peso" aria-selected="true">Peso</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="rota-tab" data-bs-toggle="tab" data-bs-target="#rota" type="button" role="tab" aria-controls="rota" aria-selected="false">Rota</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="cotacoes-tab" data-bs-toggle="tab" data-bs-target="#cotacoes" type="button" role="tab" aria-controls="cotacoes" aria-selected="false">Últimas Cotações</button>
                        </li>
                      </ul>
                      <div class="tab-content mb-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="peso" role="tabpanel" aria-labelledby="peso-tab">
                          <div class="clone-peso" >
                            <div class="row row-lg-6 border border-primary m-4">
                                  <div class="mb-3 mt-3 col-md-3">
                                    <label for="cargas[1][tipo]" class="form-label">Tipo</label>
                                    <select class="form-control" id="tipo" name="tipo">
                                      <option value="1">Alimento</option>
                                      <option value="2">Frágil</option>
                                      <option value="3">Não Frágil</option>
                                    </select>
                                  </div>
                                  <div class="mb-3 mt-3 col-md-6">
                                    <label for="valor_declarado" class="form-label">Valor Declarado NF (R$)</label>
                                    <input type="number" class="form-control" id="valor_declarado" name="cargas[1][nf]" placeholder="300.00">
                                  </div>
                                  <div class="mb-3 mt-3 col-md-3">
                                    <label for="valor_seguro" class="form-label">Valor do Seguro (R$)</label>
                                    <input type="number" class="form-control" id="valor_seguro" name="cargas[1][seguro]" placeholder="300.00">
                                  </div>
                                  <div class="mb-3 mt-3 col-md-3">
                                    <label for="qtd" class="form-label">Quantidade</label>
                                    <input required type="number" class="form-control" id="qtd" name="cargas[1][qtd]" placeholder="1">
                                  </div>
                                  <div class="mb-3 mt-3 col-md-3">
                                    <label for="peso" class="form-label">Peso em Kg</label>
                                    <input required type="number" class="form-control" id="peso" name="cargas[1][peso]" placeholder="1.00">
                                  </div>
                                  <div class="mb-3 mt-3 col-md-3">
                                    <div class="d-flex flex-row">
                                      <div class="col-md-7">
                                          <label for="volume" class="form-label">Altura (m)</label>
                                          <input required type="number" class="form-control col-sm-2" id="volume" name="cargas[1][altura]" placeholder="1">
                                        </div>
                                        <div class="col-md-7">
                                          <label for="largura" class="form-label">Largura (m)</label>
                                          <input required type="number" class="form-control col-sm-2" id="largura" name="cargas[1][largura]" placeholder="1">
                                        </div>
                                        <div class="col-md-9">
                                          <label for="comprimento" class="form-label">Comprimento (m)</label>
                                          <input required type="number" class="form-control col-sm-2" id="comprimento" name="cargas[1][comprimento]" placeholder="1">
                                        </div>
                                      </div>
                                  </div>
                            </div>
                          </div>
                            <button type="button" class="btn btn-sm btn-success" onclick="clonar('.clone-peso')"> + </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="rmclone('.clone-peso')"> - </button>
                        </div>
                        <div class="tab-pane fade" id="rota" role="tabpanel" aria-labelledby="rota-tab">
                          <div class="row row-lg-4">
                            <div class="mb-3 mt-3 col-md-3">
                                <label for="cep" class="form-label">Digite o cep de destino</label>
                                <input type="cep" class="form-control" id="cep" name="cep" placeholder="00000-000" data-rule-postalcodeBR="true">
                            </div>
                            <div class="mb-3 mt-3 col-md-3">
                                <label for="UF" class="form-label">UF</label>
                                <input type="text" class="form-control" id="uf" name="uf" placeholder="UF" maxlength="2">
                            </div>
                            <div class="mb-3 mt-3 col-md-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="cotacoes" role="tabpanel" aria-labelledby="cotacoes-tab">

                        <table data-toggle="table" id="tabela" aria-describedby="tabela" class="table table-striped" style="width: 300">
                          <thead>
                          <a href="{{ route('cotacoes.export-table')}}" class="btn btn-success">Exportar tabela</a>
                            <tr>
                              <th data-field="id">ID</th>
                              <th data-field="cidade">Cidade</th>
                              <th data-field="uf">Estado (UF)</th>
                              <th data-field="cep">CEP</th>
                              <th data-field="peso">Peso</th>
                              <th data-field="valor">Valor</th>
                              <th data-field="created_at">Data</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <button class="btn btn-primary" id="calcular" value="Calcular"> Calcular</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
  $("#form-frete").validate({
    ignore: [],
    rules: {
      cep: {
          required: true,
        },
      },
    messages: {
      cep: {
        required: "Por favor, digite o CEP de destino",
      },
      uf: {
        required: "Por favor, digite o UF",
      },
      cidade: {
        required: "Por favor, digite a cidade",
      },
    },
  });

  $('#cep').keyup(function() {
    if ($(this).val().length == 9) {
      $.ajax({
        url: 'https://brasilapi.com.br/api/cep/v2/'+$(this).val(),
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          $('#uf').val(data.state);
          $('#cidade').val(data.city);
        },
        error: function(data) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'CEP não encontrado!',
          });
        }
      });
    }
  });
  
  $('#tabela').DataTable({
    ajax: {
      url: "{{route('cotacoes.api')}}",
      dataSrc: '',
    },
    columns: [
      {data: 'id' },
      {data: 'cidade'},
      {data: 'uf'},
      {data: 'cep'},
      {data: 'peso'},
      {data: 'valor'},
      {data: 'created_at'},
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
    }
  })

</script>
@endsection

@endsection
