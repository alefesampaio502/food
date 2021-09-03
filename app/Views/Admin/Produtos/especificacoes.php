<?= $this->extend('Admin/layout/principal') ?>

<!-- aqui são estilos que serão enviado-->
<?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>

<!-- aqui são estilos que serão enviado-->
<?= $this->section('estilos') ?>
<link rel="stylesheet" href="<?php echo site_url('admin'); ?>/vendors/select2/select2.min.css">
<style>

.select2-container .select2-selection--single{
    display: block;
    width: 100%;
    height: 2.875rem;
    padding: 0.875rem 1.375rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #495057;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 2px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
  line-height: 18px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow b{
  top:80%;
}

</style>

<?= $this->endSection() ?>
<!-- aqui são conteudo que são enviados-->
<?= $this->section('conteudo') ?>

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class=" card-header bg-primary pb-0 pt-4">
      <h4 class="card-title text-white"><?php echo $titulo; ?></h4>
      </div>
    <div class="card-body">

      <?php if(session()->has('errors_model')): ?>

        <ul>
             <?php foreach (session('errors_model') as $error): ?>

               <li class="text-danger"><?php echo $error; ?></li>

             <?php endforeach; ?>

        </ul>
      <?php endif;?>

      <?php echo form_open("admin/produtos/cadastrarespecificacoes/$produto->id"); ?>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Escolha a medida do produto <a href="jJavascript:void"
                      class=""  data-toggle="popover" title="Medida do produto"
                       data-placement="top"
                       data-content="Exemplo de uso para pizza: Pizza Grande, Pizza Média, Pizza Família">Veja as dica</a></label>
                      <select class="form-control js-example-basic-single" name="medida_id">
                        <option value="">Escolha...</option>
                          <?php foreach ($medidas as $medida): ?>

                            <option value="<?php echo $medida->id;?>"><?php echo esc($medida->nome);?></option>

                          <?php endforeach; ?>
                      </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="nome">Preço: <span class="text-danger">*</span> </label>
                  <input type="text" class="money form-control" name="preco" id="preco" value="<?php echo old('preco');?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Produto customizável <a href="jJavascript:void"
                      class=""  data-toggle="popover" title="Produto meio a meio"
                       data-placement="top"
                       data-content="Exemplo de uso para pizza: Metade calabresa e metade de queijo">Veja as dica</a></label>
                      <select class="form-control" name="customizavel">
                        <option value="">Escolha...</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                      </select>
                </div>
            </div>

            <a href="<?php echo base_url("admin/produtos/show/$produto->id"); ?>" class="btn btn-light text-dark btn-sm mt-4">
            <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
            Voltar
            </a>
            <button type="submit" class="btn btn-primary mr-2 btn-sm mt-4">
              <i class="mdi mdi-pot btn-icon-prepend mr-1"></i>Ineserir especificacão
            </button>



       <?php echo form_close();?>

      <div class="form-row mt-3">

        <div class="col-md-8">
          <hr>
              <?php if(empty($produtoEspecificacoes)): ?>
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Atencâo!</h4>
                    <p>Esse produto não possui especificacôes até o momomento. Portanto ele <strong>não será exibido</strong> como opção de compra na área pública</p>
                    <hr>
                    <p class="mb-0">Àproveite para cadastra pelo menos uma eespecificacão para o prproduto<strong> <?php echo esc($produto->nome);?></strong>.</p>
                  </div>
              <?php else:?>
                  <h4 class="card-title">Especificacôes do produto</h4>
                  <p class="card-description">
                   <code>Àproveite para gerencia as Especificacôes</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Medida</th>
                          <th>Preço</th>
                          <th>Customizável</th>
                          <th class="text-center">Remover</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($produtoEspecificacoes as $especificacao): ?>
                        <tr>
                          <td><?php echo esc($especificacao->medida);?></td>
                          <td>R$&nbsp<?php echo esc(number_format($especificacao->preco, 2));?></td>
                            <td><?php echo ($especificacao->customizavel ? '<label class="badge badge-primary">Sim </label>' : '<label class="badge badge-warning">Não</label>');?>

                            <td class="text-center">
                              <a href="<?php echo base_url("admin/produtos/excluirespecificacao/$especificacao->id/$especificacao->produto_id"); ?>" class="btn badge badge-danger">
                              &nbsp;X&nbsp;
                          </a>

                          </td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                    <div class="mt-3">
                         <?= $pager->links(); ?>
                    </div>
                  </div>
              <?php endif; ?>

        </div>

      </div>
    </div>

  </div>
</div>


<?= $this->endSection() ?>
<!-- aqui são scripts que são enviados-->
<?= $this->section('scripts'); ?>
<script src="<?php echo base_url('admin/vendors/select2/select2.min.js');?>"></script>
<script src="<?php echo base_url('admin/vendors/mask/jquery.mask.min.js');?>"></script>
<script src="<?php echo base_url('admin/vendors/mask/app.js');?>"></script>

<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {

  $(function () {
    $('[data-toggle="popover"]').popover()

  })


  $('.js-example-basic-single').select2({

     placeholder: 'Digite o nome do medida...',
     allowClear: false,

     "language":{

          "noResults": function(){
            return "Medida não encontrada &nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='<?php echo site_url('admin/medidas/criar');?>'>Cadastrado</a>"
          }
     },
     escapeMarkup: function (markup){
       return markup;

     }
  });
});
</script>


<?= $this->endSection() ?>
