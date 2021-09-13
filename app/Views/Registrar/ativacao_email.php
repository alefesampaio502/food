<h5><?php echo esc($usuario->nome);?>, agora falta muito pouco!</h5>
    <p>Clique no link abaixo para ativar a sua conta e aproveitar às delecias que a <b>Mister Eats</b> tem para oferecer.</p>
    <p><a href="<?php echo base_url('registrar/ativar/' . $usuario->token); ?>">Ativa minha conta</p>
