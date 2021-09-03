<?= $this->extend('Admin/layout/principal') ?>


<!-- aqui são estilos que serão enviado-->
<?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>

<!-- aqui são estilos que serão enviado-->
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
    <div class="col-lg-6">
      <a href="<?php echo base_url("admin/formas/criar/"); ?>" class="btn btn-info float-right mb-3 sm">
      <i class="mdi mdi-plus btn-icon-prepend"></i>
      Cadastrar
      </a>
    </div>
  </div>
      <div class="ui-widget">
          <input type="text" id="query" name="query" class="form-control bg-light mb-5"
           placeholder="Pesquisa por um forma de pagamento">
        </div>

      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nome</th>

              <th>Data de criação</th>
              <th>Ativo</th>
            <th>Situação</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($formas as $forma): ?>
            <tr>
            <td>
                <a href="<?php echo base_url("admin/formas/show/$forma->id");?>"><?php echo $forma->nome;?>
              </a>
            </td>

            <td><?php echo $forma->criado_em->humanize(); ?></td>

            <td><?php echo ($forma->ativo  && $forma->deletado_em == null ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>' ) ?></td>
            <td><?php echo ($forma->deletado_em == null ? '<label class="badge badge-primary">Disponível</label>' : '<label class="badge badge-danger">Excluindo</label>' ) ?>
                <?php if($forma->deletado_em != null):?>
                  <a href="<?php echo base_url("admin/formas/desfazerexclusao/$forma->id"); ?>" class="badge badge-dark ml-2">
                  <i class="mdi mdi-undo btn-icon-prepend mr-2"></i>Desfazer</a>
                <?php endif;?>
            </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>

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
                url: "<?php echo site_url('admin/formasPagamento/procurar'); ?>",
                dataType: "json",
                data:{
                    term: request.term
                },
                success: function (data) {
                    if(data.length < 1){
                        var data = [{
                            label: 'Forma de pagamento não encontrado',
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
                window.location.href = '<?php echo site_url('admin/formas/show/')?>' + ui.item.id;
            }
        }
    }); // fim auto-complete
});
</script>

<?= $this->endSection() ?>
