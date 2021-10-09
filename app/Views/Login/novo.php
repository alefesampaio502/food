<?php echo $this->extend('layout/principal_web'); ?>

<?php echo $this->section('titulo'); ?>

<?php echo $titulo; ?>


<style>

@media only screen and (max-width: 767px){

    #login{
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
        <div id="login" class="product-content product-wrap clearfix product-deatil center-block" style="max-width: 60%">
            <div class="row">

                <p><?php echo $titulo; ?></p>
                <?php if(session()->has('errors_model')): ?>

                  <ul style="margin-left: -1.6em !important; ">
                       <?php foreach (session('errors_model') as $error): ?>

                         <li class="text-danger"><?php echo $error; ?></li>

                       <?php endforeach; ?>

                  </ul>
                <?php endif;?>

                <?php echo form_open('login/criar'); ?>
                  <div class="form-group" style="margin-top: 2em;">
                    <input type="email" name="email" value="<?php echo old('email');?>" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Digite o seu e-mail">
                  </div>
                  <div class="form-group" style="margin-top: 1em;">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Digite a sua sennha">
                  </div>
                  <div class="mt-3 text-center">
                  <button type="submit" class="btn btn-block btn-food" style="margin-top: 2em; padding:13px;">Entrar</button>
                  </div>
                  <div class=" mt-5 my-2  align-items-center center">
                     <div class="form-check" style="margin-top: 1em;">
                     <a href="<?php echo site_url('password/esqueci'); ?>" class="auth-link text-black mb-5">Esqueci a minha senha?</a>
                   </div>
                  <div class="text-center mt-5 font-weight-light" style="margin-top: 1em;">
                    Ainda não tem uma conta? <a href="<?php echo site_url('registrar'); ?>" class="text-primary">Criar conta</a>
                  </div>
                <?php echo form_close(); ?>
              </div>

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
