<?= $this->extend('Admin/layout/principal') ?>

<!-- aqui são estilos que serão enviado-->
<?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>

<!-- aqui são estilos que serão enviado-->
<?= $this->section('estilos') ?>

<?= $this->endSection() ?>
<!-- aqui são conteudo que são enviados-->
<?= $this->section('conteudo') ?>

<div class="col-lg-10 grid-margin stretch-card">
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

      <?php echo form_open_multipart("admin/produtos/upload/$produto->id"); ?>

      <div class="form-group mb-4">
                      <label>Upload de imagem</label>
                      <input type="file" name="foto_produto" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Escolha uma imagem">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-danger" type="button">Escolher</button>
                        </span>
                      </div>
                    </div>

      <button type="submit" class="btn btn-primary mr-2 btn-sm"><i class=" mdi mdi mdi-file-image btn-icon-prepend mr-1"></i>Salvar
      </button>
        <a href="<?php echo base_url("admin/produtos/show/$produto->id"); ?>" class="btn btn-light text-dark btn-sm">
        <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
        Voltar
        </a>

       <?php echo form_close();?>


    </div>

  </div>
</div>


<?= $this->endSection() ?>
<!-- aqui são scripts que são enviados-->
<?= $this->section('scripts'); ?>

<script src="<?php echo base_url()?>/admin/js/file-upload.js"></script>

<?= $this->endSection() ?>
