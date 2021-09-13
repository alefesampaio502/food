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
              <div class="col-md-12 col-xs-12">
                  <h3 class="section-title pull-left"><?php echo esc($titulo); ?></h3>
              </div>
              <div class="col-md-6">
                <ul class="list-group">
                  <?php $total = 0; ?>

                  <?php foreach ($carrinho as $produto): ?>
                    <?php $subTotal = $produto['preco'] * $produto['quantidade'];?>

                    <?php $total += $subTotal; ?>
                  <li class="list-group-item">

                        <h4><?php echo ellipsize($produto['nome'], 60); ?></h4>
                        <p class="text-muted">Quantidade:<?php echo $produto['quantidade']; ?></p>
                        <p class="text-muted">Preço: R$ <?php echo $produto['preco']; ?></p>
                        <p class="text-muted">Sub-Total: R$ <?php echo number_format($subTotal, 2); ?></p>


                  </li>
                  <?php endforeach; ?>
                    <li class="list-group-item">
                      <span>Total de produtos: </span>
                      <strong><?php echo 'R$&nbsp;'.number_format($total, 2); ?></strong>
                    </li>
                    <li class="list-group-item">
                      <span>Taxa de entrega: </span>
                      <strong id="valor_entrega" class="text-danger">Obrigatório *</strong>
                    </li>
                    <li class="list-group-item">
                      <span>Valor do pedido: </span>
                      <strong id="total"><?php echo 'R$&nbsp;'.number_format($total, 2); ?></strong>
                    </li>
                    <li class="list-group-item">
                      <span>Endereço de entrega: </span>
                      <strong id="endereco" class="text-danger">Obrigatório *</strong>
                    </li>
                </ul>
                <a href="<?php echo site_url("/");?>" class="btn btn-food">Àcho que quero mais delícias</a>
                <a href="<?php echo site_url("carrinho");?>" class="btn btn-primary" style="font-family: 'Montserrat-Bold';">Ver o que tenho no carrinho</a>
            </div><!-- Fim col-md-7 -->
            <div class="col-md-6">
              <?php if(session()->has('errors_model')): ?>

                <ul style="margin-left: -1.6em !important;">
                     <?php foreach (session('errors_model') as $error): ?>

                       <li class="text-danger"><?php echo $error; ?></li>

                     <?php endforeach; ?>

                </ul>
              <?php endif;?>
              <p style="font-size: 18px; font-weight: bold;">Escolha a forma de pagamento na entrega</p>
              <?php echo  form_open('checkout/processar', ['id' => 'form-checkout']); ?>
               <div class="form-row">
                 <?php foreach ($formas as $forma): ?>
                 <div class="radio">
                     <label style="font-size: 16px;">
                         <input id="forma" type="radio" name="forma" style="margin-top: 2px;" class="forma" data-forma="<?php echo $forma->id; ?>">
                         <?php echo esc($forma->nome); ?>
                     </label>

                 </div>

                 <?php endforeach;?>
                 <!--- Essa div será exibida quando for escolhida na forma de pagamento 'Dinheiro'-->
                 <div id="troco" class="hidden">
                   <hr>
                   <div class="form-group col-md-12" style="padding-left: 0">
                     <label>Troco para </label>
                     <input type="text" id="troco_para" name="checkout[troco_para]" class="form-control money" placeholder="Troco para">
                     <label>
                       <input type="checkbox" id="sem_troco" name="checkout[sem_troco]">
                       Não preciso de troco
                     </label>
                   </div>
                 </div><!-- fim do troco-->
                 <hr>
                 <div class="col-md-12" style="padding-left: 0">
                   <label>Consulte a taxa de entrega</label>
                   <input type="text" id="troco_para" name="cep" class="form-control cep" placeholder="Informe seu CEP" value="">
                   <div id="cep"></div>
               </div>
               <div class="col-md-9" style="padding-left: 0; margin-top: 10px;">
                 <label>Rua *</label>
                 <input type="text" id="rua" name="checkout[rua]" class="form-control" required="" readonly="">

             </div>
             <div class="col-md-3" style="padding-left: 0;margin-top: 10px;">
               <label>Número *</label>
               <input type="text" id="troco_para" name="checkout[numero]" class="form-control" required="">

             </div>
               <div class="col-md-12" style="padding-left: 0;margin-top: 10px;">
                 <label>Ponto de refêrencia </label>
                 <input type="text" id="troco_para" name="checkout[referencia]" class="form-control" required="">

             </div>
             <hr>
             <div class="form-group col-md-12">
               <input type="text" id="forma_id" name="checkout[forma_id]" class="form-control"placeholder="checkout[forma_id]">
               <input type="text" id="bairro_slug" name="checkout[bairro_slug]" class="form-control"placeholder="checkout[bairro_slug]">
             </div>

             <div class="form-group col-md-12" style="padding-left: 0;margin-top: 10px;">
               <input type="submit" id="btn-checkout" class="btn btn-food" value="Antes, consulte a texa de entrega">

             </div>
                <?php echo form_close();?>
            </div>
            </div>
        </div>
        <!-- end product -->
    </div>

</div>

<?php $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script src="<?php echo base_url('admin/vendors/mask/jquery.mask.min.js');?>"></script>
<script src="<?php echo base_url('admin/vendors/mask/app.js');?>"></script>

<script>

$("#btn-checkout").prop('disabled', true);

 $(".forma").on('click', function(){

   var forma_id = $(this).attr('data-forma');

   $("#forma_id").val(forma_id);

   if(forma_id == 1){

     $("#troco").removeClass('hidden');
   }else{
    $("#troco").addClass('hidden');
   }
 });// fim troco

 $("#sem_troco").on('click', function(){

   if(this.checked){

     $("#troco_para").prop('disabled', true);
     $("#troco_para").val('Não preciso de troco, pois tenho o valor certinho');
     $("#troco_para").attr('placeholder', 'Não preciso de troco, pois tenho o valor certinho');
   }else{

     $("#troco_para").prop('disabled', false);
     $("#troco_para").attr('placeholder', 'Enviar troco para');
      $("#troco_para").val('');
   }

 });// fim sem_troco


$("[name=cep]").focusout(function (){

   var cep = $(this).val();

   if(cep.length === 9){

     $.ajax({
         type: 'get',
         url: '<?php echo site_url('checkout/consultacep');?>',
         dataType: 'json',
         data: {
           cep: cep
         },
         beforeSend: function(){
           $("#cep").html('Consultando....');

           $("[name=cep]").val('');

           $("#btn-checkout").prop('disabled', true);
           $("#btn-checkout").val('Consultando a texa de entrega...');

         },
         success: function (response){
          if (!response.erro){
            /* CEP valido */

            $("#valor_entrega").html(response.valor_entrega);

            $("#bairro_slug").val(response.bairro_slug);

            $("#btn-checkout").prop('disabled', false);
            $("#btn-checkout").val('Processar esse pedido');

            if(response.logradouro){

              $("#rua").val(response.logradouro);
            }else{
              $("#rua").prop('readonly', false);
            }

            $("#endereco").html(response.endereco);

            $("#total").html(response.total);

            $("#cep").html(response.bairro);

          }else{
            /* Erro de validação etc.... */
            $("#cep").html(response.erro);
            $("#btn-checkout").prop('disabled', true);
            $("#btn-checkout").val('Antes consulte a texa de entrega');
          }

         },
         error: function (){
           alert('Não possível consultar a taxa de entrega. Por favor entre em contato com nossa equipe e informe o error: CONSULTA-ERRO-TAXA-ENTREGA-CHEKOUT');
           $("#btn-checkout").prop('disabled', true);
           $("#btn-checkout").val('Antes consulte a texa de entrega');
         }

     });
   }

});

$("form").submit(function(){
  $(this).find(":submit").attr('disabled', 'disabled');
    $("#btn-checkout").val('Estamos processando seu pedido...');
});
  $(window).keydown(function(event){
    if(event.keyCode == 13){
    event.preventDefault();
    return false;
  }
});


</script>
<!-- aqui enviamos para o templete principal os scripts -->

<?php $this->endSection(); ?>
