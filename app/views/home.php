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
                        <li><button class="dropdown-item" id="btn-modal-receita" data-bs-toggle="modal" data-bs-target="#modalReceita" type="button">Receita <i class="fas fa-arrow-up text-success"></i></button></li>
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
        <div class="row ">
            <form id="form-receita">
                <div class="input-group lg-12">
                    <span class="input-group-text" id="basic-addon1">R$</span>
                    <input name="tra_valor" type="text" class="form-control money-input" placeholder="Valor" id="valor_receita" aria-label="Valor" aria-describedby="basic-addon1">
                    <div class="invalid-feedback" id="msg_tra_valor"></div>
                </div>
    
                <div class="col-12 mt-3">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input class="form-check-input" type="checkbox" id="gridCheck" name="tra_situacao">
                            Já recebi
                        </label>
                    </div>
                </div>
    
                <div class="mt-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input name="tra_descricao" type="text" class="form-control" id="descricao">
                    <div class="invalid-feedback" id="msg_tra_descricao"></div>
                </div>
    
                <div class="mt-3">
                    <label for="data_recebimento" class="form-label">Data de recebimento</label>
                    <input name="tra_data" type="date" class="form-control" id="data_recebimento">
                    <div class="invalid-feedback" id="msg_tra_data"></div>
                </div>
    
                <div class="mb-3 lg-12 mt-3">
                    <label for="tags" class="form-label">Categoria</label>
                    <select name="tra_categoria" class="form-select" id="tags">
                        <option selected>Selecione</option>
                        <option value="new">Criar nova categoria</option>
                    </select>
                    <div class="invalid-feedback" id="msg_tra_categoria"></div>
                </div>

                <input type="hidden" name="tra_tipo" value="2">
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success" id="salvar-receita">Salvar</button>
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="base_url" value="<?=$base_url?>">
