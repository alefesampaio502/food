<h3>Obaaa, o seu pedido<?php echo esc($pedido->codigo);?>, já saiu para entrega!</h3>
    <p>Olá <strong><?php echo esc($pedido->nome);?>,</strong> o seu pedido <?php echo esc($pedido->codigo);?></p>
      <p>A forma de pagamento na entrega: <strong><?php echo esc($pedido->forma_pagamento);?></p>
          <p>Endereço de entrega: <strong><?php echo esc($pedido->endereco_entrega);?></p>
              <p>Observações do pedido é <strong><?php echo esc($pedido->observacoes);?></p>
              <hr>
            <p>Nome do entregador: <strong><?php echo esc($pedido->entregador->nome);?>
          </strong>,<span class="text-danger">Para sua segurança casso deseje,você poderá vericar as características do veículo do entregador</span><br>
        Veículo:<b> <?php echo esc($pedido->entregador->veiculo);?> </b>| Plaça: <b><?php echo esc($pedido->entregador->placa);?></b>
      </p>
  <hr>

    <p>Aproveite para ver os seus <a href="<?php echo base_url('conta'); ?>">pedidos</p>
