<?php echo $this->extend('layout/principal_web'); ?>

<?php echo $this->section('titulo'); ?>

<?php echo $titulo; ?>
<style>

@media only screen and (max-width: 767px){

    #registro{
      min-width: 100% !important;

    }


}
</style>

<?php $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>

<!-- aqui enviamos para o templete principal os estilos -->
<link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>"/>

<?php $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">
        <!-- product -->
        <div id="registro" class="product-content product-wrap clearfix product-deatil center-block" style="max-width: 60%">
            <div class="row">

                <p><?php echo $titulo; ?></p>
                <?php if(session()->has('errors_model')): ?>
                  <ul style="margin-left: -1.6em !important; ">
                       <?php foreach (session('errors_model') as $error): ?>
                         <li class="text-danger"><?php echo $error; ?></li>
                       <?php endforeach; ?>
                  </ul>
                <?php endif;?>

                <?php echo form_open("registrar/criar");?>
              <div class="form-group">
                <label for="nome">Nome completo</label>
                <input type="text" class="form-control" name="nome" value="<?php old('nome');?>">
              </div>
              <div class="form-group">
                <label for="nome">E-mail válido</label>
                <input type="email" class="form-control" name="email" value="<?php old('email');?>">
              </div>
              <div class="form-group">
                <label for="nome">CPF válido</label>
                <input type="text" class="cpf form-control" name="cpf" value="<?php old('cpf');?>">
              </div>
              <div class="form-group">
                <label>Sua senha</label>
                <input type="password"  name="password" class="form-control" placeholder="Password">
              </div>
              <div class="form-group">
                <label>Confirme sua senha</label>
                <input type="password"  name="password_confirmation" class="form-control" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-block btn-food" style="margin-top: 3em;">Criar minha conta</button>
              <?php echo form_close();?>
              </div>
            
        </div>
        <!-- end product -->
</div>
<?php $this->endSection(); ?>
<?php echo $this->section('scripts'); ?>
<script src="<?php echo base_url('admin/vendors/mask/jquery.mask.min.js');?>"></script>
<script src="<?php echo base_url('admin/vendors/mask/app.js');?>"></script>
<!-- aqui enviamos para o templete principal os scripts -->
<?php $this->endSection(); ?>
