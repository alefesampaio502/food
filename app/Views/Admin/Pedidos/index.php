<?= $this->extend('Admin/layout/principal') ?>


<!-- aqui são estilos que serão enviado
<?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>

<!-- aqui são estilos que serão enviado
<?= $this->section('estilos') ?>

<link rel="stylesheet" href="<?php echo  site_url('admin/vendors/auto-complete/jquery-ui.css');?>">

<?= $this->endSection() ?>


<!-- aqui são conteudo que são enviados-->
<?= $this->section('conteudo') ?>

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
      <h4 class="card-title float-left mt-3"><?php echo $titulo; ?></h4>
    </div>

  </div>
      <div class="ui-widget">
          <input type="text" id="query" name="query" class="form-control bg-light mb-5"
           placeholder="Pesquisa por um código de pedido">
        </div>

        <?php if(empty($pedidos)):?>
          <p>Não há dados para exibir</p>

        <?php else: ?>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Código do pedido</th>
                  <th>Data do pedido</th>
                  <th>Nome do cliente</th>
                  <th>Valor</th>
                <th>Situação</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($pedidos as $pedido): ?>
                <tr>
                <td>
                    <a href="<?php echo base_url("admin/pedidos/show/$pedido->codigo");?>"><?php echo $pedido->codigo;?>
                  </a>
                </td>
                <td><?php echo $pedido->criado_em->humanize(); ?></td>
                <td><?php echo esc($pedido->cliente); ?></td>

                <td>R$&nbsp;<?php echo esc(number_format($pedido->valor_pedido, 2)); ?></td>
                    <td><?php $pedido->exibeSituacaoPedido(); ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>


        <?php endif; ?>

      <div class="mt-3">
       <?= $pager->links(); ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
<!-- aqui são scripts que são enviados-->
<?= $this->section('scripts'); ?>
<script src="<?php echo base_url('admin/vendors/auto-complete/jquery-ui.js');?>"></script>

<script>
$(function (){
    $( "#query" ).autocomplete({
        source: function (request, response){
            $.ajax({
                url: "<?php echo site_url('admin/pedidos/procurar'); ?>",
                dataType: "json",
                data:{
                    term: request.term
                },
                success: function (data) {
                    if(data.length < 1){
                        var data = [{
                            label: 'pedidos não encontrado',
                            value: -1,
                            }
                        ];
                    }
                    response(data); //retorno com valor da busca
                }
            }); // fim Ajax
        },
        minLength: 1,
        select: function (event, ui) {
            if(ui.item.value == -1){
                $(this).val("");
                return false;
            }else {
                window.location.href = '<?php echo site_url('admin/pedidos/show/')?>' + ui.item.value;
            }
        }
    }); // fim auto-complete
});
</script>

<?= $this->endSection() ?>
