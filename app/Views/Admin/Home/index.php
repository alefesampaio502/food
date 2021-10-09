<?= $this->extend('Admin/layout/principal') ?>


<!-- aqui são estilos que serão enviado
<?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>




<!-- aqui são estilos que serão enviado
<?= $this->section('estilos') ?>

<?= $this->endSection() ?>


<!-- aqui são conteudo que são enviados-->
<?= $this->section('conteudo') ?>


    <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link" data-toggle="tab" role="tab" aria-controls="overview" aria-selected="true">Acompanhamento</a>
                 </li>

               </ul>

                    <div class="tab-content py-0 px-0">
                      <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="overview-tab">
                        <div class="d-flex flex-wrap justify-content-xl-between">

                          <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            <i class="mdi mdi-currency-usd mr-3 icon-lg text-primary"></i>
                            <div class="d-flex flex-column justify-content-around">
                              <small class="mb-1 text-muted">Pedidos entregues
                                <span class="badge badge-pill badge-primary"><?php echo $valorPedidosEntregues->total; ?></span>
                              </small>
                              <h5 class="mr-2 mb-0">R$&nbsp;<?php echo number_format($valorPedidosEntregues->valor_pedido, 2); ?></h5>
                            </div>
                          </div>
                          <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i>
                            <div class="d-flex flex-column justify-content-around">
                              <small class="mb-1 text-muted">Pedidos cancelados
                                  <span class="badge badge-pill badge-danger"><?php echo $valorPedidosCancelados->total; ?></span>
                              </small>
                              <h5 class="mr-2 mb-0">R$&nbsp;<?php echo number_format($valorPedidosCancelados->valor_pedido, 2); ?></h5>
                            </div>
                          </div>
                          <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            <i class="mdi mdi-account-multiple mr-3 icon-lg text-success"></i>
                            <div class="d-flex flex-column justify-content-around">
                              <small class="mb-1 text-muted">Clientes ativos
                                <span class="badge badge-pill badge-success"><?php echo esc($totalClientesAtivo); ?></span>
                            </small>

                            </div>
                          </div>
                          <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            <i class="mdi mdi-motorbike mr-3 icon-lg text-warning"></i>
                            <div class="d-flex flex-column justify-content-around">
                              <small class="mb-1 text-muted">Entregadores ativos
                                <span class="badge badge-pill badge-warning text-white"><?php echo esc($totalEntregadoresAtivo); ?></span>


                              </small>

                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8 grid-margin stretch-card">

              <div class="card">
                <ul class="nav nav-tabs px-4">
             <li class="nav-item">
    <a class="nav-link text-primary font-weight-bold text-left"><i class="mdi mdi-shopping menu-icon"></i>&nbsp;Novos pedidos realizados</a>
             </li>

           </ul>
                <div class="card-body">
                  <div class="row">
                  <div id="atualiza" class="table-responsive">
                    <table class="table table-hover">

                        <?php $expedienteHoje = expedienteHoje(); ?>

                          <?php if($expedienteHoje->situacao == false): ?>
                            <h4 class="card-title float-left mt-3 text-info"><i class="mdi mdi-calendar-alert"></i> &nbsp; Hoje é <?php echo esc($expedienteHoje->dia_descricao); ?> &nbsp;estamos fechado portanto, não há novos pedidos.</h4>
                        <?php else: ?>

                         <div id="atualiza">
                           <?php if(!isset($novosPedidos)): ?>

                             <h5 class="card-title float-left mt-3 text-info">Não há novos pedidos no momento &nbsp;<?php echo date('d-m-Y H:i:s'); ?></h5>

                           <?php else: ?>
                             <thead >
                               <tr>
                                 <th>Código do pedido</th>
                               <th>Valor</th>
                               <th class="text-center">Data do pedido</th>
                               </tr>
                             </thead>
                             <tbody>
                             <?php foreach ($novosPedidos as $pedido): ?>
                               <tr>
                               <td>
                                   <a href="<?php echo base_url("admin/pedidos/show/$pedido->codigo");?>"><?php echo $pedido->codigo;?>
                                 </a>
                               </td>
                               <td>R$&nbsp;<?php echo esc(number_format($pedido->valor_pedido, 2)); ?></td>
                               <td class="text-center"><?php echo $pedido->criado_em->humanize(); ?></td>
                             </tr>
                             <?php endforeach; ?>
                           <?php endif; ?>
                         </div><!---Div atualiza -->
                          <?php endif; ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <p class="card-title">Produtos + vendidos</p>
                          <ul class="list-arrow">
                            <?php if(!isset($produtosMaisVendidos)): ?>
                              <p class="card-title float-left mt-3 text-info">Não há novos dados neste momento</p>


                            <?php else: ?>
                            <?php foreach ($produtosMaisVendidos as $produto): ?>

                              <li class="mb-1  active"><?php echo word_limiter($produto->produto, 5);?>
                                <span class="badge badge-pill badge-primary float-right"><?php echo esc($produto->quantidade); ?></span>
                              </li><hr>

                          <?php endforeach; ?>

                        <?php endif; ?>
                          </ul>
                        </div>
                      </div>
                    </div>
    </div>

<div class="row">
  <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Clientes + tops
  <i class="mdi mdi-account-multiple icon-lg text-success float-right"></i>
                </p>
                <hr class="bd-success">
                <ul class="list-arrow">
                  <?php if(!isset($topClientes)): ?>
                    <p class="card-title float-left mt-3 text-info">Não há novos dados neste momento</p>


                  <?php else: ?>
                  <?php foreach ($topClientes as $cliente): ?>

                    <li class="mb-1  active"><?php echo esc($cliente->nome);?>
                      <span class="badge badge-pill badge-success float-right"><?php echo esc($cliente->pedidos); ?></span>
                    </li><hr>

                <?php endforeach; ?>
              <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      <p class="card-title">Entregadores + tops
                    <i class="mdi mdi-motorbike icon-lg text-warning float-right"></i></p>
                        <hr class="bd-warning">
                        <ul class="list-unstyled">
                          <?php if(!isset($topEntregadores)): ?>
                            <p class="card-title float-left mt-3 text-info">Não há novos dados neste momento</p>


                          <?php else: ?>
                          <?php foreach ($topEntregadores as $entregador): ?>

                            <li class="mb-1  active">

                              <?php if($entregador->imagem && $entregador->deletado_em == null): ?>
                              <img  class="rounded-circle" width="40" src="<?php echo site_url("admin/entregadores/imagem/$entregador->imagem"); ?>" alt=""/>
                            <?php else: ?>
                              <img class="rounded-circle" width="40" src="<?php echo base_url("admin");?>/images/user.jpg" alt="Entregador sem imagem">

                            <?php endif;?>

                             <a class="text-dark" href="<?php echo base_url("admin/entregadores/show/$entregador->id");?>"><?php echo $entregador->nome;?>
                             </a>
                              <span class="badge badge-pill badge-warning float-right"><?php echo esc($entregador->entregas); ?></span>
                            </li><hr>

                        <?php endforeach; ?>
                      <?php endif; ?>
                        </ul>
                      </div>
                    </div>
                  </div>

</div>
<?= $this->endSection() ?>

<!-- aqui são scripts que são enviados-->
<?= $this->section('scripts') ?>

  <script>

  setInterval("atualiza();", 120000); //120.000 milisegundos = 2 minutos

  function atualiza() {

    $("#atualiza").toggleClass('');
    $("#atualiza").load('<?php echo site_url('admin/home'); ?>' + ' #atualiza');


  }

  </script>

<?= $this->endSection() ?>
