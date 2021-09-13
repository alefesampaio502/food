<?php echo $this->extend('layout/principal_web'); ?>

<?php echo $this->section('titulo'); ?>

<?php echo $titulo; ?>

<?php $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>

<!-- aqui enviamos para o templete principal os estilos -->
<link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/conta.css"); ?>"/>

<?php $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em; min-height: 300px;">
  <?php echo $this->include("Conta/sidebar"); ?>
    <div class="row" style="margin-top:2em;">
      <div class="col-md-12 col-xs-12">
          <h3 class="section-title pull-left"><?php echo esc($titulo); ?></h3>
      </div>
      <div class="col-md-6">
      <?php echo form_open('conta/processaautenticacao');?>
        <div class="panel panel-default">
            <div class="panel-body">

              <div>
                <label>Sua senha atual</label>
                <input type="password" name="password" class="form-control well">
                <hr>
              </div>
            </div>
            <div class="panel-footer">
              <button type="submit" class="btn btn-primary"><i clas="fa fa-save"></i>Autenticar</button>
              <a href="<?php echo site_url('conta/show');?>" class="btn btn-default">Cancelar</a>


            </div>
          </div>
            <?php echo form_close();?>
      </div>
    </div>

</div>

<?php $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script src="<?php echo base_url('admin/vendors/mask/jquery.mask.min.js');?>"></script>
<script src="<?php echo base_url('admin/vendors/mask/app.js');?>"></script>

<script>

  /* Menu usuarios componetes do cliente */
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}

</script>
<!-- aqui enviamos para o templete principal os scripts -->

<?php $this->endSection(); ?>
