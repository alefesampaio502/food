<?php echo $this->extend('layout/principal_web'); ?>

<?php echo $this->section('titulo'); ?>

<?php echo $titulo; ?>

<?php $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>

<!-- aqui enviamos para o templete principal os estilos -->
<link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>"/>

<?php $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <!-- product -->
        <div class="product-content product-wrap clearfix product-deatil">
            <div class="row">
              <?php if($pedido->situacao == 0):?>
                <div class="col-md-12 col-xs-12">
                    <h3 class="section-title pull-left"><?php echo esc($titulo);?></h3>
                </div>
                <?php endif; ?>
                <div class="col-md-12 col-xs-12">
                  <h4> No momento o seu pedido está com o status de <?php echo $pedido->exibeSituacaoPedido(); ?></h4>

                </div>
                            <?php if($pedido->situacao != 3):?>
                              <div class="col-md-12 col-xs-12">
                                  <h4>Quando ocorrer uma mudança no status do seu ppedido, nós notificaremos você por e-mail.</h4>
                              </div>

                            <?php endif; ?>
              <div class="col-md-12">
                <ul class="list-group">


                  <?php foreach ($produtos as $produto): ?>

                  <li class="list-group-item">

                        <h4><?php echo ellipsize($produto['nome'], 100); ?></h4>
                        <p class="text-muted">Quantidade:<?php echo $produto['quantidade']; ?></p>
                        <p class="text-muted">Preço: R$ <?php echo $produto['preco']; ?></p>
                  </li>
                  <?php endforeach; ?>
                    <li class="list-group-item">
                      <span>Data do pedido: </span>
                      <strong><?php echo $pedido->criado_em->humanize();?></strong>
                    </li>
                    <li class="list-group-item">
                      <span>Total de produtos: </span>
                      <strong><?php echo 'R$&nbsp;'.number_format($pedido->valor_produtos, 2); ?></strong>
                    </li>
                    <li class="list-group-item">
                      <span>Taxa de entrega: </span>
                      <strong><?php echo 'R$&nbsp;'.number_format($pedido->valor_entrega, 2); ?></strong>
                    </li>

                    <li class="list-group-item">
                      <span>Valor final do pedido: </span>
                      <strong><?php echo 'R$&nbsp;'.number_format($pedido->valor_pedido, 2); ?></strong>
                    </li>
                    <li class="list-group-item">
                      <span>Endereço de entrega:</span>
                      <strong><?php echo esc($pedido->endereco_entrega); ?></strong>
                    </li>
                    <li class="list-group-item">
                      <span>Forma de pagamento na entrega: </span>
                      <strong><?php echo esc($pedido->forma_pagamento); ?></strong>
                    </li>
                    <li class="list-group-item">
                      <span>Observações do pepedido: </span>
                      <strong><?php echo esc($pedido->observacoes); ?></strong>
                    </li>
                </ul>
                <a href="<?php echo site_url("/");?>" class="btn btn-food">Àcho que quero mais delícias</a>

            </div><!-- Fim col-md-12 -->

        </div>
        <!-- end product -->
    </div>

</div>
</div>

<?php $this->endSection(); ?>
