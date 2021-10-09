<?php echo $this->extend('layout/principal_web'); ?>

<?php echo $this->section('titulo'); ?>

<?php echo $titulo; ?>

<?php $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<style>

@media only screen and (max-width: 767px){
.section-title {
    font-size: 20px !important;
    margin-top: -6em !important;
 }
}
</style>

<!-- aqui enviamos para o templete principal os estilos -->
<link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>"/>

<?php $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="container section" id="menu" data-aos="fade-up" style="margin-top:1em;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <!-- product -->
        <div class="product-content product-wrap clearfix product-deatil"style="border-radius: 7px;">
            <div class="row">


              <?php if(empty($bairros)):?>
                <p></p>
                <h3 class="section-title" style="margin-top:1em; margin-bottom:2em">Não há dados para exibir</h3>
              <?php else: ?>
                <div class="col-md-12 col-xs-12">
                    <h3 class="section-title" style="margin-top:1em; margin-bottom:2em"><?php echo esc($titulo); ?></h3>
                </div>
              <?php foreach ($bairros as $bairro): ?>
                <div class="col-md-4">
                  <div class="panel panel-default">
                  <div class="panel-heading painel-food"><?php echo esc($bairro->nome);?> - <?php echo esc($bairro->cidade);?> - MA</div>
                  <div class="panel-body fonte-food">Taxa de entrega: R$ &nbsp;<?php  echo esc(number_format($bairro->valor_entrega, 2));?></div>
                </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
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
