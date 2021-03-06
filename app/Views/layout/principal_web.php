<!DOCTYPE html>
<html lang="pt-Br" dir="auto">

<!-- BEGIN head -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Meta tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="">
    <meta name="author" content="">
      <title>MisteItz | <?= $this->renderSection('titulo') ?></title>
    <!-- Stylesheets -->

    <link href="<?php echo site_url('web/'); ?>src/assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet" media="all" />
    <link href="<?php echo site_url('web/'); ?>manifest.json"></link>



    <link href="<?php echo site_url('web/'); ?>src/assets/css/fonts.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/slick.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/slick-theme.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/aos.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/scrolling-nav.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/bootstrap-datepicker.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/touch-sideswipe.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/jquery.fancybox.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/main.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url('web/'); ?>src/assets/css/responsive.css" type="text/css" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo site_url('web/'); ?>src/assets/img/favicon/favicon.png" />
    <link rel="icon" type="image/png" sizes="256x256"  href="<?php echo site_url('web/'); ?>src/assets/img/favicon/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo site_url('web/'); ?>src/assets/img/favicon/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo site_url('web/'); ?>src/assets/img/favicon/favicon.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo site_url('web/'); ?>src/assets/img/favicon/favicon.png" />
    <link rel="icon" type="image/png" href="<?php echo site_url('web/'); ?>src/assets/img/favicon/favicon.png" />
    <link rel="manifest" href="<?php echo site_url('web/'); ?>src/assets/img/site.html" />
    <link rel="mask-icon" href="<?php echo site_url('web/'); ?>src/assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5" />
    <meta name="msapplication-TileColor" content="#990100" />
    <meta name="theme-color" content="#ffffff" />
      <style>
          .navbar-nav > li >a{
            line-height:30px;
          }
          .btn-food{
            background-color:#990100;
            color: white !important;
            font-family: 'Montserrat-Bold';
          }
          .fonte-food{
            color:#990100 !important;
            font-family: 'Montserrat-Bold';
          }
          .painel-food{
            background:#990100 !important;
            color:white !important;
            font-family: 'Montserrat-Bold';
          }
          .sites{
            background:#990100 !important;
            color:white !important;
          }

          @media only screen and (max-width: 767px){

              #main-carousel{
                min-width: 50%;

              }

          }

      </style>

    <?= $this->renderSection('estilos') ?>

</head>
<!-- END head -->

<!-- BEGIN body -->

<body data-spy="scroll" data-target=".navbar" data-offset="50">

    <!-- BEGIN  Loading Section -->
    <div class="loading-overlay">
        <div class="spinner">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- END Loading Section -->

    <!-- BEGIN body wrapper -->
    <div class="body-wrapper">

        <!-- Begin header-->
        <header id="header">

            <!-- BEGIN carousel -->
            <div id="main-carousel" class="carousel slide" data-ride="carousel">
                <div id="sliders"class="container pos_rel">

                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#main-carousel" data-slide-to="1"></li>
                        <li data-target="#main-carousel" data-slide-to="2"></li>
                        <li data-target="#main-carousel" data-slide-to="3"></li>
                        <li data-target="#main-carousel" data-slide-to="4"></li>
                    </ol>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                    </a>
                    <a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <!-- Carousel items   -->
                        <div class="item active">
                            <div class="carousel-caption">
                                <div class="fadeUp item_img">
                                    <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/pizza.png" alt="sample" />

                                </div>
                                <div class="fadeUp fade-slow item_details">
                                    <h4 class="item_name">Panelada</h4>
                                    <p class="item_info">Panelada de Imperatriz, este prato ?? um dos mais populares de Imperatriz. mais
                                      saborosos do pa??s, por isso pode ser encontrado nas barracas de rua e tamb??m na maioria dos restaurantes das grandes cidades, inclusive aqui.</p>
                                    <div class="item_link_box">

                                    </div>
                                </div>
                            </div>
                        </div>

                          <?php foreach ($produtos as $produto):?>
                         <div id="slide"class="item"<?php echo esc($produto->categoria_slug); ?>">
                            <div class="carousel-caption">
                                <div class="fadeUp item_img">
                                    <img src="<?php echo site_url("produto/imagem/$produto->imagem"); ?>" alt="sample" />

                                    <?php if(!empty($produto)): ?>
                                    <div class="item_badge">
                                        <span class="badge_btext text-lowercase"style="text-transform: capitalize;"><?php echo esc($produto->desconto);?>%</span>
                                        <span class="badge_stext">R$&nbsp;<?php echo esc(number_format($produto->preco, 2));?></span>
                                    </div>
                                  <?php else : ?>

                                    <div class="item_badge">
                                        <span class="badge_btext text-lowercase" style="text-transform: capitalize;"><?php echo esc($produto->desconto);?>%</span>
                                        <span class="badge_stext">R$&nbsp;<?php echo esc(number_format($produto->preco, 2));?></span>
                                    </div>
                                  <?php endif; ?>

                                </div>
                                <div class="fadeUp fade-slow item_details">
                                    <h4 class="item_name"><?php echo word_limiter($produto->nome,3); ?></h4>
                                    <p class="item_info"><?php echo word_limiter($produto->ingredientes, 20); ?></p>
                                    <div class="item_link_box">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>

                </div>
                <!-- /.container -->
            </div>
            <!-- END carousel -->
            <!-- BEGIN navigation -->
            <div class="navigation">

                <div class="navbar-container" data-spy="affix" data-offset-top="400">
                    <div class="container">

                      <div class="navbar_top hidden-xs">
                          <div class="top_addr">
                            <?php if(empty($sistemas)): ?>
                              <span><i class="fa fa-map-marker" aria-hidden="true"></i> MARANH??O, IMPERATRIZ, 45</span>
                              <span><i class="fa fa-phone" aria-hidden="true"></i> (99) 1794-905</span>

                            <?php else : ?>
                              <?php foreach ($sistemas as $sistema): ?>
                                  <span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc($sistema->estado);?>,&nbsp;<?php echo esc($sistema->cidade);?>, <?php echo esc($sistema->numero);?></span>
                                  <span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc($sistema->telefone);?></span>
                              <?php endforeach;?>
                            <?php endif; ?>

                              <?php $expedienteHoje = expedienteHoje();?>
                              <?php if($expedienteHoje->situacao == false): ?>
                              <span><i class="fa fa-lock" aria-hidden="true"></i> Hoje estamos fechados</span>
                              <?php else :?>
                              <span>Aberto das &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo esc($expedienteHoje->abertura); ?> - <?php echo esc($expedienteHoje->fechamento); ?></span>
                              <?php endif; ?>

                          </div>

                      </div>
                      <!-- /.navbar_top -->
                        <!-- BEGIN navbar -->
                        <nav class="navbar">
                            <div id="navbar_content">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="<?php echo base_url('/'); ?>">

                                        <img src="<?php echo site_url('web/'); ?>src/assets/img/logo.png" alt="logo" />
                                    </a>
                                    <a href="#cd-nav" class="cd-nav-trigger right_menu_icon">
                                        <span><i class="fa fa-bars" aria-hidden="true"></i></span>
                                    </a>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="navbar">
                                      <div class="navbar-right">
                                          <ul class="nav navbar-nav">

                                              <li><a class="page-scroll" href="<?php echo site_url('/');?>">Home</a></li>

                                             <li><a class="page-scroll" href="<?php echo site_url('bairros');?>">Bairros Atendidos</a></li>
                                              <li><a class="page-scroll" href="#footer">Contato</a></li>

                                              <?php if(session()->has('carrinho') && count(session()->get('carrinho')) > 0):?>
                                              <li>
                                                <a class="page-scroll" href="<?php echo site_url('carrinho');?>">
                                                  <i class="fa fa-shopping-cart fa fa-2x"></i>
                                                  <span style="font-size: 25px !important;">
                                                    <?php echo count(session()->get('carrinho'));?>
                                                  </span>

                                                </a>
                                              </li>
                                              <?php endif; ?>
                                              <?php if(usuario_logado()):?>
                                                  <li><a class="page-scroll" href="<?php echo site_url('conta'); ?>">Minha conta</a></li>
                                                  <li><a class="page-scroll" href="<?php echo site_url('login/logout'); ?>">Sair</a></li>
                                              <?php else: ?>
                                                  <li><a class="page-scroll" href="<?php echo site_url('login'); ?>">Entrar</a></li>
                                                  <li><a class="page-scroll" href="<?php echo site_url('registrar'); ?>">Registrar-se</a></li>
                                              <?php endif; ?>

                                          </ul>
                                      </div>
                                  </div>
                                <!-- /.navbar-collapse -->
                            </div>
                        </nav>
                    </div>
                    <!-- END navbar -->
                </div>
                <!-- /.navbar-container -->
            </div>
            <!-- END navigation -->

        </header>
        <!-- End header -->

<div class="container" style="margin-top: 5rem">
      <?php if(session()->has('sucesso')): ?>
          <div class="alert alert-success" role="alert"><?php echo session('sucesso'); ?></div>
          <?php endif; ?>
      <?php if(session()->has('info')): ?>
          <div class="alert alert-info" role="alert"><?php echo session('info'); ?></div>
          <?php endif; ?>
      <?php if(session()->has('atencao')): ?>
          <div class="alert alert-danger" role="alert"><?php echo session('atencao'); ?></div>
          <?php endif; ?>
      <?php if(session()->has('error')): ?>
          <div class="alert alert-danger" role="alert"><?php echo session('error'); ?></div>
          <?php endif; ?>
          <?php if(session()->has('fraude')): ?>
              <div class="alert alert-warning" role="alert"><?php echo session('fraude'); ?></div>
              <?php endif; ?>
           <?php if(session()->has('expediente')): ?>
               <div class="alert alert-warning" role="alert"><?php echo session('expediente'); ?></div>
               <?php endif; ?>
            </div>
      <?php $this->renderSection('conteudo'); ?>
        <!--  Begin Footer  -->
        <footer id="footer">
            <!--Contact-->
            <!--Google map, Social links-->
            <div class="section" id="contact">
                <div id="googleMap" style="max-height: 320px !important"></div>
                <div class="footer_pos">
                    <div class="container">
                        <div class="footer_content">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <h4 class="footer_ttl footer_ttl_padd">Misteitz</h4>
                                    <p class="footer_txt">
                                      Leve-se a outro momento e lugar onde a excel??ncia culin??ria se encontra com a melhor mistura de sabores que voc?? pode encontrar, sem ter que sair de sua cozinha.
                                      N??s da Misteitz fundimos cuidadosamente sabores aut??nticos e diversos das culturas Maranhense e Imperatrizense para trazer a voc?? sabores tradicionais e ousados, orgulhosos da nossa terra.
                                      Oferecemos os pratos aut??nticos, vibrantes e simplesmente deliciosos.
                                    </p>
                                </div>
                                <div class="col-sm-6 col-md-5">
                                      <?php $expedientes = expedientes()?>
                                    <h4 class="footer_ttl footer_ttl_padd">Nosso expediente</h4>
                                    <div class="footer_border">
                                      <?php foreach ($expedientes as $dias): ?>
                                        <div class="week_row clearfix">
                                            <div class="week_day"><?php echo esc($dias->dia_descricao); ?></div>
                                            <?php if($dias->situacao == false): ?>
                                            &nbsp;<div class="week_time text-right">Fechado</div>
                                          <?php else : ?>
                                              &nbsp;<div class="week_time text-right">Aberto</div>
                                              <div class="week_time">
                                                  <span class="week_time_start"><?php echo esc($dias->abertura); ?></span>
                                                  <span class="week_time_node">-</span>
                                                  <span class="week_time_end"><?php echo esc($dias->fechamento); ?></span>
                                              </div>
                                          <?php endif; ?>
                                        </div>
                                      <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <h4 class="footer_ttl footer_ttl_padd">Contato</h4>
                                    <div class="footer_border">
                                        <div class="footer_cnt">
                                            <i class="fa fa-map-marker"></i>
                                              <?php if(!empty($sistemas)): ?>
                                                <?php foreach($sistemas as $sistema): ?>
                                            <span><?php echo esc($sistema->cidade);?> &nbsp;<?php echo esc($sistema->estado);?></span>

                                        </div>
                                        <div class="footer_cnt">
                                            <i class="fa fa-phone"></i>
                                            <span><?php echo esc($sistema->telefone);?></span>
                                        </div>
                                        <div class="footer_cnt">
                                            <i class="fa fa-envelope"></i>
                                            <span><?php echo esc($sistema->email);?></span>
                                        </div>
                                      <?php endforeach; ?>
                                      <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="copyright">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                  <div class="copy_text">
                                        <a class="sites">Misteitz.com</a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="social-links">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="javascript:;" title="">
                                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="https://www.instagram.com/misteitz/" title="">
                                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:;" title="">
                                                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- End Footer -->

    </div>
    <!-- END body-wrapper -->


    <!-- START mobile right burger menu -->

    <nav class="cd-nav-container right_menu" id="cd-nav">
        <div class="header__open_menu">
            <a href="<?php echo site_url('/'); ?>" class="rmenu_logo" title="Miester Itz Delivery">
                <img src="<?php echo site_url('web/'); ?>src/assets/img/logo.png" alt="logo" />
            </a>
        </div>

        <ul class="rmenu_list">


            <li><a class="page-scroll" href="<?php echo site_url('/');?>">Home</a></li>

           <li><a class="page-scroll" href="<?php echo site_url('bairros');?>">Bairros Atendidos</a></li>
            <li><a class="page-scroll" href="#footer">Contato</a></li>

            <?php if(session()->has('carrinho') && count(session()->get('carrinho')) > 0):?>
            <li>
              <a class="page-scroll" href="<?php echo site_url('carrinho');?>">
                <i class="fa fa-shopping-cart fa fa-2x"><?php echo count(session()->get('carrinho'));?></i>


              </a>
            </li>
            <?php endif; ?>
            <?php if(usuario_logado()):?>
                <li><a class="page-scroll" href="<?php echo site_url('conta'); ?>">Minha conta</a></li>
                <li><a class="page-scroll" href="<?php echo site_url('login/logout'); ?>">Sair</a></li>
            <?php else: ?>
                <li><a class="page-scroll" href="<?php echo site_url('login'); ?>">Entrar</a></li>
                <li><a class="page-scroll" href="<?php echo site_url('registrar'); ?>">Registrar-se</a></li>
            <?php endif; ?>

        </ul>
        <div class="right_menu_addr top_addr">
          <?php if(empty($sistemas)): ?>
            <span><i class="fa fa-map-marker" aria-hidden="true"></i> MARANH??O, IMPERATRIZ, 45</span>
            <span><i class="fa fa-phone" aria-hidden="true"></i> (99) 1794-905</span>

          <?php else : ?>
          <?php foreach ($sistemas as $sistema): ?>
                <span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc($sistema->estado);?>,&nbsp;<?php echo esc($sistema->cidade);?>, <?php echo esc($sistema->numero);?></span>
                <span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc($sistema->telefone);?></span>
            <?php endforeach;?>
          <?php endif; ?>

            <?php $expedienteHoje = expedienteHoje();?>
            <?php if($expedienteHoje->situacao == false): ?>
            <span><i class="fa fa-lock" aria-hidden="true"></i> Hoje estamos fechados</span>
            <?php else :?>
            <span>Aberto das &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo esc($expedienteHoje->abertura); ?> - <?php echo esc($expedienteHoje->fechamento); ?></span>
            <?php endif; ?>

        </div>
    </nav>

    <div class="cd-overlay"></div>
    <!-- /.cd-overlay -->


    <!-- END mobile right burger menu -->


    <script src="<?php echo site_url('web/'); ?>src/assets/js/jquery-2.1.1.min.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/jquery.mousewheel.min.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/jquery.easing.min.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/scrolling-nav.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/aos.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/slick.min.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/jquery.touchSwipe.min.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/moment.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/jquery.fancybox.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/loadMoreResults.js"></script>
    <script src="<?php echo site_url('web/'); ?>src/assets/js/main.js"></script>

    <!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcg5Y2D1fpGI12T8wcbtPIsyGdw-_NV1Y&amp;callback=myMap"></script-->



      <!-- area para rederiza????o do scripts da view de deste lalayouts -->
       <?= $this->renderSection('scripts'); ?>

</body>

</html>
