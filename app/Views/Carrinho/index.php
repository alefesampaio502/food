<?php echo $this->extend('layout/principal_web'); ?>

<?php echo $this->section('titulo'); ?>

<?php echo $titulo; ?>

<?php $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>

<!-- aqui enviamos para o templete principal os estilos -->
<link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>"/>

<?php $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="container-fluid section" id="menu" data-aos="fade-up" style="margin-top: 3em">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <!-- product -->
        <div class="product-content product-wrap clearfix product-deatil">
            <div class="row">

              <?php if (!isset($carrinho)): ?>
              <div class="text-center">  <h2 class="text-center">Seu carrinho de compras está vazio</h2>
                <a href="<?php echo site_url('/');?>" class="btn btn-lg" style="background-color: #990100; color: #fff; margin-top:2em">Voltar</a></div>
              <?php else: ?>

                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>


                      <tr>
                        <th scope="col">Remover</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Tamanho</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Sub total</th>
                      </tr>

                    </thead>
                    <tbody>
                      <?php $total = 0; ?>
                      <?php foreach($carrinho as $produto):?>
                      <tr>
                        <th class="text-center">

                          <a class="btn-danger btn-sm" href="<?php echo site_url("carrinho/remover/$carrinho->slug");?>">X</a>
                        </th>
                        <td><?php echo esc($carrinho->nome);?></td>
                        <td><?php echo esc($carrinho->tamanho);?></td>
                        <td class="text-center">

                          <?php echo form_open("carrinho/atualizar", ['class' =>'form-inline']);?>

                          <div class="form-group">

                            <input type="number" class="form-control" name="produto[quantidade]" value="<?php echo $carrinho->quantidade;?>" min="1" max="10" step="1" required="">
                            <input type="hidden" name="produto[slug]" value="<?php echo $carrinho->slug;?>">

                          </div>
                          <button type="submit" class="btn btn-primary float-right "><i class="fa fa-fa-refresh"></i></button>

                          <?php echo form_close(); ?>

                        </td>
                        <td><?php echo number_format($carrinho->preco, 2);?></td>
                        <td></td>
                      </tr>
                        <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            <?php endif; ?>
            </div>
        </div>
        <!-- end product -->
    </div>

</div>

<?php $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>

</script>
<!-- aqui enviamos para o templete principal os scripts -->

<?php $this->endSection(); ?>
