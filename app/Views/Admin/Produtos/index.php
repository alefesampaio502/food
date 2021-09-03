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
    <div class="col-lg-6">
      <a href="<?php echo base_url("admin/produtos/criar/"); ?>" class="btn btn-info float-right mb-3 sm">
      <i class="mdi mdi-plus btn-icon-prepend"></i>
      Cadastrar
      </a>
    </div>
  </div>
      <div class="ui-widget">
          <input type="text" id="query" name="query" class="form-control bg-light mb-5"
           placeholder="Pesquisa por um  produto">
        </div>

      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nome</th>
              <th>Categoria</th>
              <th>Data de criação</th>
              <th>Especificações</th>
              <th>Ativo</th>
            <th>Situação</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($produtos as $produto): ?>
            <tr>
              <td class="py-1">
                <?php if($produto->imagem && $produto->deletado_em == null): ?>
                  <img class="card-img-top" height="200"  src="<?php echo site_url("admin/produtos/imagem/$produto->imagem"); ?>" alt="<?php echo esc($produto->nome);?>">
                              <?php else: ?>
                  <img class="card-img-top" height="200"  src="<?php echo base_url('admin/images/semfoto.jpeg');?>"  alt="Produto sem imagem por enquanto">

                <?php endif;?>
                </a>
              </td>
                <td>
                <a href="<?php echo base_url("admin/produtos/show/$produto->id");?>"><?php echo $produto->nome;?>
              </a>
            </td>
            <td><?php echo esc($produto->categoria); ?></td>
            <td><?php echo $produto->criado_em->humanize(); ?></td>
            <td>

                                          <?php foreach ($especificacoes as $especificacao): ?>

                                          <?php if($produto->id == $especificacao->produto_id): ?>

                                          <p>

                                              <?php echo esc($especificacao->nome); ?> : R$&nbsp;<?php echo esc($especificacao->preco); ?>

                                          </p>

                                          <?php endif; ?>

                                          <?php endforeach;?>

                                      </td>
            <td><?php echo ($produto->ativo  && $produto->deletado_em == null ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>' ) ?></td>
            <td><?php echo ($produto->deletado_em == null ? '<label class="badge badge-primary">Disponível</label>' : '<label class="badge badge-danger">Excluindo</label>' ) ?>
                <?php if($produto->deletado_em != null):?>
                  <a href="<?php echo base_url("admin/produtos/desfazerexclusao/$produto->id"); ?>" class="badge badge-dark ml-2">
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
                url: "<?php echo site_url('admin/produtos/procurar'); ?>",
                dataType: "json",
                data:{
                    term: request.term
                },
                success: function (data) {
                    if(data.length < 1){
                        var data = [{
                            label: 'Produto não encontrado',
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
                window.location.href = '<?php echo site_url('admin/produtos/show/')?>' + ui.item.id;
            }
        }
    }); // fim auto-complete
});
</script>

<?= $this->endSection() ?>
