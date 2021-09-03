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

        <p class="card-text">
          <span class="font-weight-bold">Nome:</span>
        <?php echo esc($bairro->nome);?>
        </p>

        <p class="card-text">
          <span class="font-weight-bold">Valor de entrega:</span>
            R$&nbsp<?php echo esc(number_format($bairro->valor_entrega, 2));?>
        </p>

        <p class="card-text">
          <span class="font-weight-bold">Ativo:</span>
          <?php echo ($bairro->ativo ? 'Sim' : 'Não');?>
        </p>

        <p class="card-text">
          <span class="font-weight-bold">Criado:</span>
          <?php echo $bairro->criado_em->humanize(); ?>
        </p>

        <?php if($bairro->deletado_em == null): ?>
        <p class="card-text">
          <span class="font-weight-bold">Atualizado:</span>
          <?php echo $bairro->atualizado_em->humanize(); ?>
        </p>

      <?php else: ?>
        <p class="card-text">
          <span class="font-weight-bold text-danger">Excluido:</span>
          <?php echo $bairro->deletado_em->humanize(); ?>
        </p>

        <?php endif; ?>
        <div class="mt-4">
                <?php if($bairro->deletado_em == null): ?>

                  <a href="<?php echo base_url("admin/bairros/editar/$bairro->id"); ?>" class="btn btn-dark btn-sm mr-2">
                    <i class="mdi mdi-pencil btn-icon-prepend"></i>
                  Editar
              </a>
              <a href="<?php echo base_url("admin/bairros/excluir/$bairro->id"); ?>" class="btn btn-danger btn-sm mr-2">
                <i class="mdi mdi-trash-can btn-icon-prepend"></i>
              Excluir
          </a>
          <a href="<?php echo base_url("admin/bairros"); ?>" class="btn btn-light text-dark btn-sm">
            <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
          Voltar
        </a>
              <?php else: ?>
                <a href="<?php echo base_url("admin/bairros/desfazerexclusao/$bairro->id"); ?>" class="btn btn-dark btn-sm">
                <i class="mdi mdi-undo btn-icon-prepend mr-2"></i>Desfazer</a>
                <a href="<?php echo base_url("admin/bairros"); ?>" class="btn btn-light text-dark btn-sm">
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
