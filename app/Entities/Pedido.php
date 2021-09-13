<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Pedido extends Entity
{

	protected $dates   = [
		'criado_em',
		'atualizado_em',
		'deletado_em',
	];

	public function exibeSituacaoPedido(){

			switch ($this->situacao) {
					case 0:
					echo "<i class='fa fa-thumbs-up fa fa-lg text-primary' arria-hidden='true'></i>&nbsp; Pedido realizado";
					break;
					case 1:
						echo "<i class='fa fa-motorcycle fa fa-lg text-success' arria-hidden='true'></i>&nbsp; Saiu  para entrega";
						break;
				  case 2:
							echo "<i class='fa fa-money fa fa-lg text-success' arria-hidden='true'></i>&nbsp; Pedido  entregue";
							break;
					case 3:
								echo "<i class='fa fa-thumbs-down fa fa-lg text-danger' arria-hidden='true'></i>&nbsp; Pedido  cancelado";
								break;
			}
	}

}
