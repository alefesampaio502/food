<?= $this->extend('Admin/layout/principal') ?>
<!-- aqui são estilos que serão enviado-->
<?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>

<!-- aqui são estilos que serão enviado-->
<?= $this->section('estilos') ?>

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

      <?php echo form_open("admin/medidas/cadastrar"); ?>

        <?php echo $this->include('Admin/Medidas/form'); ?>
        <a href="<?php echo base_url("admin/medidas"); ?>" class="btn btn-light text-dark btn-sm">
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
<script src="<?php echo base_url('admin/vendors/mask/jquery.mask.min.js');?>"></script>
<script src="<?php echo base_url('admin/vendors/mask/app.js');?>"></script>


<?= $this->endSection() ?>
