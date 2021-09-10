<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12 mb-md-3 mb-sm-3 mb-3">
        <div class="card border border-primary">
            <div class="card-body">
                <h5 class="card-title">Saldo Atual</h5>
                <h6 class="card-subtitle mb-2">R$ 1.625,00</h6>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mb-md-3 mb-sm-3 mb-3">
        <div class="card border border-success">
            <div class="card-body">
                <h5 class="card-title">Receitas</h5>
                <h6 class="card-subtitle mb-2">R$ 2.125,00</h6>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mb-sm-3 mb-3">
        <div class="card border border-danger">
            <div class="card-body">
                <h5 class="card-title">Despesas</h5>
                <h6 class="card-subtitle mb-2">R$ 500,00</h6>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mb-sm-3 mb-3">
        <div class="card border border-info">
            <div class="card-body">
                <h5 class="card-title">Balanço mensal</h5>
                <h6 class="card-subtitle mb-2">R$ 1.625,00</h6>
            </div>
        </div>
    </div>
</div>

<div class="row container-md m-auto p-0">
    <div class="card">
        <div class="row d-flex justify-content-center flex-row my-3">
            <div data-mesano="<?= $ant_mesano ?>" id="antMes" class="col-lg-1 col-md-1 col-sm-1 col-1 d-flex align-items-center justify-content-end selectMesAno" style="cursor:pointer"><i class="fas fa-chevron-left"></i></div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                <input type="text" class="form-control text-center" id="datePicker" placeholder="mês/ano" value="<?=$mes_ano?>">
            </div>
            <div data-mesano="<?= $prox_mesano ?>" id="proxMes" class="col-lg-1 col-md-1 col-sm-1 col-1 d-flex align-items-center selectMesano" style="cursor:pointer"><i class="fas fa-chevron-right"></i></div>
        </div>

        <div class="row my-3">
            <div class="col-6">
                <h4>Transações</h4>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-plus text-white"></i> Novo
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalReceita" type="button">Receita <i class="fas fa-arrow-up text-success"></i></button></li>
                        <li><button class="dropdown-item" type="button">Despesa <i class="fas fa-arrow-down text-danger"></i></button></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive-sm table-responsive-md" id="table-dad">
            <table class="table" id="table-list">
                <thead class="table-light border border-dark">
                    <tr>
                        <th scope="col">Situação</th>
                        <th scope="col">Data</th>
                        <th scope="col">Descricao</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><div><i class="fas fa-check-circle text-success"></i></div></th>
                        <td>08/09/2021</td>
                        <td>parcela do carro</td>
                        <td>transporte</td>
                        <td>R$ 885,00</td>
                        <td>
                            <div class="d-flex flex-row">
                                <div class="me-2"><i class="fas fa-check-circle text-secondary fcc"></i></div>
                                <div class="me-2"><i class="fas fa-pencil-alt text-secondary fpa"></i></div>
                                <div class="me-2"><i class="fas fa-trash-alt text-secondary fta"></i></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><div><i class="fas fa-exclamation-circle text-danger"></i></div></th>
                        <td>10/09/2021</td>
                        <td>Cartão santander</td>
                        <td>cartão de crédito</td>
                        <td>R$ 625,00</td>
                        <td>
                            <div class="d-flex flex-row">
                                <!-- <div class="me-2"><i class="fas fa-check-circle text-secondary fcc"></i></div> -->
                                <div class="me-2"><i class="fas fa-pencil-alt text-secondary fpa"></i></div>
                                <div class="me-2"><i class="fas fa-trash-alt text-secondary fta"></i></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><div><i class="fas fa-check-circle text-success"></i></div></th>
                        <td>08/09/2021</td>
                        <td>Cartão nubank</td>
                        <td>cartão de crédito</td>
                        <td>R$ 711,75</td>
                        <td>
                            <div class="d-flex flex-row">
                                <div class="me-2"><i class="fas fa-check-circle text-secondary fcc"></i></div>
                                <div class="me-2"><i class="fas fa-pencil-alt text-secondary fpa"></i></div>
                                <div class="me-2"><i class="fas fa-trash-alt text-secondary fta"></i></div>                        
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal receitas -->
<div class="modal fade" id="modalReceita" tabindex="-1" aria-labelledby="modalReceitaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalReceitaLabel">Nova receita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="lg-12">
                <input class="form-control form-control-lg" type="text" placeholder="Valor" aria-label=".form-control-lg example">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="base_url" value="<?=$base_url?>">
