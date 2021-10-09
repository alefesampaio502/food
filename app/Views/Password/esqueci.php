<?= $this->extend('Admin/layout/principal_autenticacao') ?>
<!-- aqui são estilos que serão enviado-->
<?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>
<!-- aqui são estilos que serão enviado-->
<?= $this->section('estilos') ?>
<?= $this->endSection() ?>
<!-- aqui são conteudo que são enviados-->
<?= $this->section('conteudo') ?>
<div class="container-fluid page-body-wrapper full-page-wrapper">
  <div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
      <div class="col-lg-5 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                   <?php if (session()->has('sucesso')): ?>
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Pefeito!</strong> <?php echo session('sucesso'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                   <?php endif; ?>
                   <?php if (session()->has('info')): ?>
                     <div class="alert alert-info alert-dismissible fade show" role="alert">
                      <strong>Informação!</strong> <?php echo session('info'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                   <?php endif; ?>
                            <?php if (session()->has('atencao')): ?>
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                               <strong>Atencâo!</strong> <?php echo session('atencao'); ?>
                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                               </button>
                             </div>
                            <?php endif; ?>
                        <?php if (session()->has('error')): ?>
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <strong>Error!</strong> <?php echo session('error'); ?>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                        <?php endif; ?>
          <div class="brand-logo">
            <img src="<?= base_url('admin')?>/images/mister.png" alt="logo">
          </div>
          <h4>Recuperando a senha!</h4>
          <h6 class="font-weight-light mb-3"><?php echo $titulo; ?></h6>
          <?php echo form_open('password/processaesqueci'); ?>
            <div class="form-group">
              <input type="email" name="email" value="<?php echo old('email');?>" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Digite o seu e-mail">
            </div>
            <div class="mt-3 text-center">
            <input id="btn-reset-senha"  type="submit" class="btn  btn-primary btn-lg font-weight-medium auth-form-btn" value="Recuperar senha"></input>
            </div>
            <div class=" mt-5 my-2  align-items-center center">
               <div class="form-check"><a href="<?php echo site_url('login'); ?>" class="auth-link text-black mb-5">Lembrei a minha senha</a>
             </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->
<?= $this->endSection() ?>
<!-- aqui são scripts que são enviados-->
<?= $this->section('scripts') ?>

<script>

    $("form").submit(function(){

      $(this).find(":submit").attr('disabled', 'disabled');
      $("#btn-reset-senha").val("Enviando e-mail de recuperação...");

    });

</script>

<?= $this->endSection() ?>
