<?= $this->extend('Admin/layout/principal') ?>

<!-- aqui são estilos que serão enviado-->
<?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>

<!-- aqui são estilos que serão enviado-->
<?= $this->section('estilos') ?>
<link rel="stylesheet" href="<?php echo site_url('admin'); ?>/vendors/select2/select2.min.css">

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

      <?php echo form_open("admin/produtos/cadastrarextras/$produto->id"); ?>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Escolha o extra do produto (opcional)</label>
                      <select class="form-control js-example-basic-single" name="extra_id">
                        <option value="">Escolha...</option>
                          <?php foreach ($extras as $extra): ?>

                            <option value="<?php echo $extra->id;?>"><?php echo esc($extra->nome);?></option>

                          <?php endforeach; ?>
                      </select>
                </div>



            </div>

            <button type="submit" class="btn btn-primary mr-2 btn-sm">
              <i class="mdi mdi-pot btn-icon-prepend mr-1"></i>Ineserir extra
            </button>

        <a href="<?php echo base_url("admin/produtos/show/$produto->id"); ?>" class="btn btn-light text-dark btn-sm">
        <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
        Voltar
        </a>

       <?php echo form_close();?>

      <div class="form-row mt-3">

        <div class="col-md-8">
          <hr>
              <?php if(empty($produtoExtras)): ?>
                <p> Esse produto não possui extras até o momomento.</p>
              <?php else:?>
                  <h4 class="card-title">Extras do produto</h4>
                  <p class="card-description">
                   <code>Àproveite para gerencia os eextras</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Extra</th>
                          <th>Preço</th>
                          <th class="text-center">Remover</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($produtoExtras as $extraProduto): ?>
                        <tr>
                          <td><?php echo esc($extraProduto->extra);?></td>
                          <td>R$&nbsp<?php echo esc(number_format($extraProduto->preco, 2));?></td>
                            <td class="text-center">
                              <?php echo form_open("admin/produtos/excluirextra/$extraProduto->id/$extraProduto->produto_id"); ?>

                            <button type="submit" class="btn badge badge-danger">&nbsp;X&nbsp;</button>
                            <?php form_close(); ?>
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
<script src="<?php echo base_url('admin/vendors/mask/app.js');?>"></script>

<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
  $('.js-example-basic-single').select2({

     placeholder: 'Digite o nome do extra...',
     allowClear: false,

     "language":{

          "noResults": function(){
            return "Extra não encontrado&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='<?php echo site_url('admin/extras/criar');?>'>Cadastrado</a>"
          }
     },
     escapeMarkup: function (markup){
       return markup;

     }
  });
});
</script>


<?= $this->endSection() ?>
