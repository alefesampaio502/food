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
      <?php if(session()->has('errors_model')): ?>

        <ul style="margin-left: -1.6em !important; list-style: decimal">
             <?php foreach (session('errors_model') as $error): ?>

               <li class="text-danger"><?php echo $error; ?></li>

             <?php endforeach; ?>

        </ul>
      <?php endif;?>
      <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-body">
                <dl>
                  <dt>Nome completo</dt>
                  <dd><?php echo esc($usuario->nome); ?></dd>
                    <hr>
                  <dt>E-mail de acesso</dt>
                  <dd><?php echo esc($usuario->email); ?></dd>
                    <hr>
                  <dt>Telefone</dt>
                  <dd><?php echo esc($usuario->telefone); ?></dd>
                    <hr>
                  <dt>CPF</dt>
                  <dd><?php echo esc($usuario->cpf); ?></dd>
                  <hr>
                  <dt>Cliente desde</dt>
                  <dd><?php echo ($usuario->criado_em->humanize())?></dd>

                </dl>
            </div>
            <div class="panel-footer">
              <a href="<?php echo site_url('conta/editar');?>" class="btn btn-primary">Editar</a>
              <a href="<?php echo site_url('conta/editarsenha');?>" class="btn btn-danger">Alterar senha</a>
            </div>
          </div>
      </div>
    </div>

</div>

<?php $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
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
