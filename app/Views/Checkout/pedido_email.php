<h5>Pedido <?php echo esc($pedido->codigo);?> realizado com sucesso!</h5>
    <p><strong><?php echo esc($pedido->usuario->nome);?></strong>, recebemos seu pedido <?php echo esc($pedido->codigo);?></p>
    <p>Estamos acelerando do lado de cá para que o seu pedido fique pronto rapadinho. Logo logo ele sairá para entrega</p>
    <p>Não se preocupe, quando isso acontecer, avisaremos você por e-mail, beleza? </p>
    <p>Equanto isso, <a href="<?php echo base_url('conta'); ?>">clique aqui para ver os seus pedidos</a></p>
