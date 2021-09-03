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
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="product-image">


                      <img src="<?php echo site_url("produto/imagem/$produto->imagem"); ?>" alt="<?php echo esc($produto->nome);?>" />


                    </div>
                </div>


                <?php echo form_open("carrinho/adicionar");?>

                <div class="col-md-7 col-md-offset-1 col-sm-12 col-xs-12">

                  <?php if(session()->has('errors_model')): ?>

                    <ul style="margin-left: -1.6em !important; list-style: decimal">
                         <?php foreach (session('errors_model') as $error): ?>

                           <li class="text-danger"><?php echo $error; ?></li>

                         <?php endforeach; ?>

                    </ul>
                  <?php endif;?>
                    <h2 class="name">

                        <?php echo esc($produto->nome)?>


                    </h2>
                    <hr />
                    <h3 class="price-container">


                        <p class="small">Escolha o valor</p>

                        <?php foreach ($especificacoes as $especificacao): ?>

                        <div class="radio">

                            <label style="font-size: 16px;">

                                <input type="radio" style="margin-top: 2px;" class="especificacao" data-especificacao="<?php echo $especificacao->especificacao_id; ?>"
                                       name="produto[preco]" value="<?php echo $especificacao->preco; ?>">

                                <?php echo esc($especificacao->nome);?>
                                R$&nbsp;<?php echo esc(number_format($especificacao->preco, 2));?>

                            </label>

                        </div>

                        <?php endforeach;?>


                        <?php if(isset($extras)): ?>

                        <hr>

                        <p class="small">Extras do produto</p>

                        <div class="radio">

                            <label style="font-size: 16px;">

                                <input type="radio" style="margin-top: 2px;" class="extra" name="extra" checked="">Sem extra

                            </label>

                        </div>


                        <?php foreach ($extras as $extra): ?>

                        <div class="radio">

                            <label style="font-size: 16px;">

                                <input type="radio" style="margin-top: 2px;" class="extra" data-extra="<?php echo $extra->id; ?>"
                                       name="extra" value="<?php echo $extra->preco; ?>">

                                <?php echo esc($extra->nome);?>
                                <?php echo esc(number_format($extra->preco, 2));?>

                            </label>

                        </div>

                        <?php endforeach;?>

                        <?php endif;?>
                      <div class="row" style="margin-top: 4">
                        <div class="col-md-4">

                          <label style="font-size: 16px;">Quantidade</label>
                          <input type="number" class="form-control" name="produto[quantidade]" value="1" min="1" max="10" step="1" required="">
                        </div>

                      </div>
                    </h3>

                    <hr />
                    <div class="description description-tabs">

                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" style="font-size: 16px;" id="more-information">
                                <br />
                                <strong>É uma delicia</strong>
                                <p>
                                    <?php echo esc($produto->ingredientes); ?>
                                </p>
                            </div>



                        </div>
                    </div>
                    <hr />

                    <div>

                        <input type="hidden" name="produto[slug]" placeholder="produto[slug]" value="<?php echo $produto->slug; ?>">
                        <input type="hidden" id="especificacao_id" placeholder="produto[especificacao_id]" name="produto[especificacao_id]">
                        <input type="hidden" id="extra_id" placeholder="produto[extra_id]" name="produto[extra_id]">


                    </div>

                    <div class="row">

                        <div class="col-sm-4">
                            <input  id="btn-adiciona"type="submit" class="btn btn-success btn-block" style="margin-top: 1rem" value="Adicionar">
                        </div>
                      <?php foreach ($especificacoes as $especificao): ?>
                          <?php if ($especificao->customizavel): ?>
                        <div class="col-sm-4">
                            <a href="<?php echo site_url("produto/customizar/$produto->slug");?>" class="btn btn-primary btn-block" style="margin-top: 1rem">Customizar</a>
                        </div>
                              <?php break; ?>
                            <?php endif; ?>
                      <?php endforeach; ?>


                        <div class="col-sm-4 "style="margin-top: 1rem">

                            <a href="<?php echo site_url("/");?>" class="btn btn-info btn-block">Mais delícias</a>
                        </div>

                    </div>
                </div>

                <?php echo form_close();?>

            </div>
        </div>
        <!-- end product -->
    </div>

</div>

<?php $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>

$(document).ready(function(){

  var especificacao_id;


  if(!especificacao_id){
    ///Desabilita o botão submit enquanto não e escolhido o cardapio///
    $("#btn-adiciona").prop("disabled", true);

    $("#btn-adiciona").prop("value", "Seleccione um valor");


  }

     $(".especificacao").on('click', function(){

          especificacao_id = $(this).attr('data-especificacao');

            $("#especificacao_id").val(especificacao_id);
   ///Habilita o botão submit enquanto não e escolhido o cardapio///
      $("#btn-adiciona").prop("disabled", false);

      $("#btn-adiciona").prop("value", "Adicionar");



     });


     ///Habilita o botão submit enquanto não e escolhido o extra///

     $(".extra").on('click', function(){

          var extra_id = $(this).attr('data-extra');

            $("#extra_id").val(extra_id);



     });

});


</script>
<!-- aqui enviamos para o templete principal os scripts -->

<?php $this->endSection(); ?>
