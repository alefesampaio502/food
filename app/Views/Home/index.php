<?= $this->extend('layout/principal_web') ?>


<!-- aqui são estilos que serão enviado-->
<?php echo $this->section('titulo') ;?><?php echo $titulo; ?><?php echo $this->endSection() ;?>




<!-- aqui são estilos que serão enviado-->
<?= $this->section('estilos') ?>

<?= $this->endSection() ?>


<!-- aqui são conteudo que são enviados-->
<?= $this->section('conteudo') ?>

<!-- Begin Sections-->


<!--    Menus   -->
<div class="container section " id="menu" data-aos="fade-up" style="margin-top: 4em">
    <div class="title-block">
        <h1 class="section-title">Conheça as nossas Delícias </h1>
    </div>

    <!--    Menus filter    -->
    <div class="menu_filter text-center ">
        <ul class="list-unstyled list-inline d-inline-block">

          <li id="todas" class="item active">
              <a href="javascript:;" class="filter-button" data-filter="todas">Todas</a>
          </li>

          <?php foreach ($categorias as $categoria):?>
            <li class="item ">
                <a href="javascript:;" class="filter-button" data-filter="<?php echo esc($categoria->slug); ?>"><?php echo esc($categoria->nome); ?></a>
            </li>
          <?php endforeach;?>


        </ul>
    </div>

    <!--    Menus items     -->
    <div id="menu_items">

      <div class="row">

        <?php foreach ($produtos as $produto):?>

        <div class="col-sm-6 filtr-item image filter active <?php echo esc($produto->categoria_slug); ?>">
            <a href="<?php echo site_url("produto/detalhes/$produto->slug"); ?>" class="block fancybox" data-fancybox-group="fancybox">
                <div class="content">
                    <div class="filter_item_img">
                        <i class="fa fa-search-plus"></i>
                        <img src="<?php echo site_url("produto/imagem/$produto->imagem"); ?>" alt="<?php echo esc($produto->nome); ?>" />
                    </div>
                    <div class="info">
                        <div class="name"><?php echo esc($produto->nome); ?></div>
                        <div class="short"><?php echo word_limiter($produto->ingredientes, 5); ?></div>
                        <span class="filter_item_price">A partir de R$&nbsp;<?php echo esc(number_format($produto->preco, 2));?></span>
                    </div>
                </div>
            </a>
        </div>
      <?php endforeach; ?>
      </div>



    </div>
</div>


<!-- End Sections -->

<?= $this->endSection() ?>



<!-- aqui são scripts que são enviados-->
<?= $this->section('scripts') ?>

<?= $this->endSection() ?>
