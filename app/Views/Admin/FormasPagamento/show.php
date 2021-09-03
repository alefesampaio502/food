  <?= $this->extend('Admin/layout/principal') ?>
  <!-- aqui são estilos que serão enviado
  <?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>
  <!-- aqui são estilos que serão enviado
  <?= $this->section('estilos') ?>
  <?= $this->endSection() ?>
  <!-- aqui são conteudo que são enviados-->
  <?= $this->section('conteudo') ?>

  <div class="col-lg-8 grid-margin stretch-card">
    <div class="card">
      <div class=" card-header bg-primary pb-0 pt-4">
        <h4 class="card-title text-white"><?php echo $titulo; ?></h4>
        </div>
      <div class="card-body">
        <?php if($forma->id == 1):?>
        <div class="alert alert-primary" role="alert">
          A forma de pagamento <strong><?php echo esc($forma->nome);?></strong>
          não pode ser <span class="text-danger">Editada ou Excluida</span>,
          pois essa opção será vinculada ou não o envio do troco para o cliente quando o mesmo estiver no <strong>Checkout</strong>
        </div>
      <?php endif; ?>

        <p class="card-text">
          <span class="font-weight-bold">Nome:</span>
          <?php echo esc($forma->nome);?>
        </p>
        <p class="card-text">
          <span class="font-weight-bold">Ativo:</span>
          <?php echo ($forma->ativo ? 'Sim' : 'Não');?>
        </p>

        <p class="card-text">
          <span class="font-weight-bold">Criado:</span>
          <?php echo $forma->criado_em->humanize(); ?>
        </p>

        <?php if($forma->deletado_em == null): ?>
        <p class="card-text">
          <span class="font-weight-bold">Atualizado:</span>
          <?php echo $forma->atualizado_em->humanize(); ?>
        </p>

      <?php else: ?>
        <p class="card-text">
          <span class="font-weight-bold text-danger">Excluido:</span>
          <?php echo $forma->deletado_em->humanize(); ?>
        </p>

        <?php endif; ?>
        <div class="mt-4">
                <?php if($forma->deletado_em == null): ?>

                  <?php if($forma->id != 1): ?>              
                          <a href="<?php echo base_url("admin/formas/editar/$forma->id"); ?>" class="btn btn-dark btn-sm mr-2">
                                        <i class="mdi mdi-pencil btn-icon-prepend"></i>
                                      Editar
                          </a>
                          <a href="<?php echo base_url("admin/formas/excluir/$forma->id"); ?>" class="btn btn-danger btn-sm mr-2">
                                    <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                                  Excluir
                          </a>
                  <?php endif; ?>

          <a href="<?php echo base_url("admin/formas"); ?>" class="btn btn-light text-dark btn-sm">
            <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
          Voltar
        </a>
              <?php else: ?>
                <a href="<?php echo base_url("admin/formas/desfazerexclusao/$forma->id"); ?>" class="btn btn-dark btn-sm">
                <i class="mdi mdi-undo btn-icon-prepend mr-2"></i>Desfazer</a>
                <a href="<?php echo base_url("admin/formas"); ?>" class="btn btn-light text-dark btn-sm">
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
