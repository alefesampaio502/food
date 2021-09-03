<?= $this->extend('Admin/layout/principal') ?>


<!-- aqui são estilos que serão enviado
<?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>




<!-- aqui são estilos que serão enviado
<?= $this->section('estilos') ?>

<?= $this->endSection() ?>


<!-- aqui são conteudo que são enviados-->
<?= $this->section('conteudo') ?>

<div class="col-lg-6 grid-margin stretch-card">
  <div class="card">
    <div class=" card-header bg-primary pb-0 pt-4">
      <h4 class="card-title text-white"><?php echo $titulo; ?></h4>
      </div>
    <div class="card-body">

      <?php if(session()->has('errors_model')): ?>

        <ul>
             <?php foreach (session('errors_model') as $error): ?>

               <li class="text-danger"><?php echo $error; ?><li>

             <?php endforeach; ?>

        </ul>
      <?php endif;?>

      <?php echo form_open("admin/entregadores/excluir/$entregador->id"); ?>

      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Atenção: </strong> Tem certeza que deseja excluir o usuário
          <strong><?php echo esc($entregador->nome);?>
          ?.</strong>
      </div>
      <button type="submit" class="btn btn-danger mr-2 btn-sm">
        <i class=" mdi mdi-trash-can btn-icon-prepend mr-1"></i>excluir
      </button>
        <a href="<?php echo base_url("admin/entregadores/show/$entregador->id"); ?>" class="btn btn-light text-dark btn-sm">
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
