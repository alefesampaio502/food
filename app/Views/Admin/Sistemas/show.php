<?= $this->extend('Admin/layout/principal') ?>
  <!-- aqui são estilos que serão enviado
  <?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>
  <!-- aqui são estilos que serão enviado
  <?= $this->section('estilos') ?>
  <?= $this->endSection() ?>
  <!-- aqui são conteudo que são enviados-->
  <?= $this->section('conteudo') ?>
  <div class="col-lg-5 grid-margin stretch-card">
    <div class="card">
      <div class=" card-header bg-primary pb-0 pt-4">
        <h4 class="card-title text-white"><?php echo $titulo; ?></h4>
        </div>
      <div class="card-body">
        <div class="row marcador align-items-center">
      <div class="mx-auto text-center">
        <?php if($sistema->imagem && $sistema->deletado_em == null): ?>
          <img class="card-img-top" height="200"  src="<?php echo site_url("admin/sistemas/imagem/$sistema->imagem"); ?>" alt="<?php echo esc($sistema->nome);?>">
        <?php else: ?>
          <img class="card-img-top" height="200"  src="<?php echo base_url('admin/images/user.jpg');?>"  alt="sistema sem imagem por enquanto">
        <?php endif; ?>
        </div>
        </div>
        <hr>
      <?php if($sistema->deletado_em == null): ?>
        <a href="<?php echo base_url("admin/sistemas/editarimagem/$sistema->id"); ?>" class="btn btn-secondary btn-sm text-white ">
          <i class="mdi mdi-image btn-icon-prepend"></i>
        Editar imagem
    </a>
    <hr>
      <?php endif; ?>
        <p class="card-text mt-3">
          <span class="font-weight-bold">Nome:</span>
          <?php echo esc($sistema->nome);?>
        </p>
        <p class="card-text">
          <span class="font-weight-bold">Telefone:</span>
          <?php echo esc($sistema->telefone);?>
        </p>
        <p class="card-text">
          <span class="font-weight-bold">Cnpj:</span>
          <?php echo esc($sistema->cnpj);?> 
        </p>
        <p class="card-text">
          <span class="font-weight-bold">Ativo:</span>
          <?php echo ($sistema->ativo ? 'Sim' : 'Não');?>
        </p>
        <p class="card-text">
          <span class="font-weight-bold">Criado:</span>
          <?php echo $sistema->criado_em->humanize(); ?>
        </p>
        <?php if($sistema->deletado_em == null): ?>
        <p class="card-text">
          <span class="font-weight-bold">Atualizado:</span>
          <?php echo $sistema->atualizado_em->humanize(); ?>
        </p>
      <?php else: ?>
        <p class="card-text">
          <span class="font-weight-bold text-danger">Excluido:</span>
          <?php echo $sistema->deletado_em->humanize(); ?>
        </p>
        <?php endif; ?>
        <div class="mt-4">
                <?php if($sistema->deletado_em == null): ?>
                  <a href="<?php echo base_url("admin/sistemas/editar/$sistema->id"); ?>" class="btn btn-outline-github btn-sm ">
                    <i class="mdi mdi-pencil btn-icon-prepend"></i>
                  Editar
              </a>


              <a href="<?php echo base_url("admin/sistemas/excluir/$sistema->id"); ?>" class="btn btn-danger btn-sm">
                <i class="mdi mdi-trash-can btn-icon-prepend"></i>
              Excluir
              </a>
          <a href="<?php echo base_url("admin/sistemas"); ?>" class="btn btn-light text-dark btn-sm">
            <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
          Voltar
        </a>
              <?php else: ?>
                <a href="<?php echo base_url("admin/sistemas/desfazerexclusao/$sistema->id"); ?>" class="btn btn-dark btn-sm">
                <i class="mdi mdi-undo btn-icon-prepend mr-2"></i>Desfazer</a>
                <a href="<?php echo base_url("admin/sistemas"); ?>" class="btn btn-light text-dark btn-sm">
                  <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                Voltar
              </a>
                <?php endif; ?>
        </div>

      </div>

    </div>
  </div>
  <?= $this->endSection() ?>
  <!-- aqui são scripts que são enviados-->
  <?= $this->section('scripts'); ?>
  <?= $this->endSection() ?>
