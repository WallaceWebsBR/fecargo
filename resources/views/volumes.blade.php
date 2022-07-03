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
                <div class="card-header">Guarda Volumes (Modulo 2)</div>
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
                          <button class="nav-link active" id="meusvolumes-tab" data-bs-toggle="tab" data-bs-target="#meusvolumes" type="button" role="tab" aria-controls="meusvolumes" aria-selected="true">Meus Volumes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="cadastraritem-tab" data-bs-toggle="tab" data-bs-target="#cadastraritem" type="button" role="tab" aria-controls="cadastraritem" aria-selected="false">Cadastrar Item (Permissão: ADMINSTRADOR)</button>
                        </li>
                      </ul>
                      <div class="tab-content mb-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="meusvolumes" role="tabpanel" aria-labelledby="meusvolumes-tab">
                          {{-- @foreach($items as $item) --}}
                          <div class="row row-lg-4 m-4 border border-primary">
                            <div class="mb-3 mt-3 col-md-3 text-center">  
                            <img src="{{ asset('img/upload.png') }}" alt="Item" width="250">
                            </div>
                            <div class="mb-3 mt-3 col-md-6">  
                              <label for="nomeDoItem">Nome do Item: </label>
                              <br>
                              <label for="pesoDoItem">Peso do Item: </label>
                              <br>
                              <label for="PreçoDoItem">Preço do Item: </label>
                              <br>
                              <label for="categoriaDoItem">Categoria do Item</label>
                              <br>
                              <label for="custoMensal">Custo Mensal: </label>
                              <br>
                              <label for="custoAnual">Custo Anual: </label>
                              <br>
                            </div>
                          </div>
                          {{-- @endforeach --}}
                        </div>



                        <div class="tab-pane fade" id="cadastraritem" role="tabpanel" aria-labelledby="cadastraritem-tab">
                          <div class="row row-lg-4">
                            <div class="mb-3 mt-3 col-md-3 text-center">
                              <label for="previewImage">Foto do Item</label>
                              <div class="border border-primary">
                                <img id="previewImage" src="{{asset('img/upload.png')}}" alt="Carregar Imagem" width="250" />
                              </div>
                                <input type="file" class="form-control" onchange="previewimage(this);">
                            </div>
                            <div class="mb-3 mt-3 col-md-3 text-center">
                              <label for="nomeItem">Nome do Item</label>
                              <input type="text" class="form-control" id="nomeItem" name="nomeItem" placeholder="Vaso de porcelana">
                              <label for="pesoItem" class="mt-3">Peso do Item (Kg)</label>
                              <input type="number" class="form-control" id="pesoItem" name="pesoItem" placeholder="25.00">
                              <label for="precoItem" class="mt-3">Preço do Item (R$)</label>
                              <input type="number" class="form-control" id="precoItem" name="precoItem" placeholder="120.00">
                            </div>
                            <div class="mb-3 mt-3 col-md-3 text-center">
                              <label for="valorItem">Taxa Mensal (R$)</label>
                              <input type="number" class="form-control" id="valorItem" name="valorItem" placeholder="100.00">
                              <label for="cliente" class="mt-3">Categoria do Item</label>
                              <select class="form-control" id="cliente" name="cliente">
                                <option value="" selected disabled>Selecione a categoria</option>
                                <option value="2">Frágil</option>
                                <option value="3">Não Frágil</option>
                              </select>
                              <br/>
                              <button type="submit" class="btn btn-success mt-3" style="width: 100%;">Cadastrar</button>
                            </div>
                            
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
<script>
       function previewimage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#previewImage')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@endsection
