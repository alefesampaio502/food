-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 13-Set-2021 às 02:01
-- Versão do servidor: 8.0.22-0ubuntu0.20.04.2
-- versão do PHP: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `food`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairros`
--

CREATE TABLE `bairros` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL DEFAULT 'Imperatriz',
  `valor_entrega` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bairros`
--

INSERT INTO `bairros` (`id`, `nome`, `slug`, `cidade`, `valor_entrega`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Bairro Bom Jesus', 'Bairro-Bom-Jesus', 'Imperatriz', '3.00', 1, '2021-08-28 18:25:52', '2021-08-29 03:02:58', NULL),
(2, 'Santa Inês', 'santa-ines', 'Imperatriz', '20.00', 1, '2021-08-29 02:45:38', '2021-08-29 02:45:38', NULL),
(3, 'Bom Jesus', 'bom-jesus', 'Imperatriz', '5.00', 1, '2021-08-29 02:54:41', '2021-08-29 02:54:41', NULL),
(4, 'Vila Redenção', 'vila-redencao', 'Imperatriz', '7.00', 1, '2021-09-08 19:47:44', '2021-09-08 19:47:44', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `slug`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Pízza ', 'pizza', 1, '2021-08-19 16:55:40', '2021-08-30 19:03:11', NULL),
(5, 'Jatinha', 'jatinha', 1, '2021-08-22 05:18:59', '2021-08-30 19:06:21', NULL),
(6, 'Lanche', 'lanche', 1, '2021-08-30 18:53:00', '2021-08-30 19:06:07', NULL),
(15, 'Hambúrguer', 'hamburguer', 1, '2021-08-30 19:03:56', '2021-08-30 19:04:32', NULL),
(16, 'Salada', 'salada', 1, '2021-08-30 19:07:13', '2021-08-30 19:07:13', NULL),
(17, 'Bebidas', 'bebidas', 1, '2021-08-30 19:07:27', '2021-08-30 19:07:33', NULL),
(18, 'Tortas', 'tortas', 1, '2021-08-30 19:08:00', '2021-08-30 19:08:00', NULL),
(19, 'remedio', 'remedio', 1, '2021-09-08 19:38:28', '2021-09-08 20:04:23', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregadores`
--

CREATE TABLE `entregadores` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `cnh` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `veiculo` varchar(255) NOT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entregadores`
--

INSERT INTO `entregadores` (`id`, `nome`, `cpf`, `cnh`, `email`, `telefone`, `endereco`, `imagem`, `veiculo`, `placa`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'João pedro ', '222.025.810-65', '22202581065', 'teste@gmail.com', '(99) 9917-9490', 'Rua almirante teste n 222 Qd 10 ', '1630153870_71f71e4605837b4836db.png', 'Moto yes Suzuki', 'HOP-9007', 1, '2021-08-28 03:53:09', '2021-08-28 09:31:10', NULL),
(2, 'teste de cadastro de entregador', '017.062.640-70', '01706264070', 'alefesampaio@gmail.com', '(99) 9933-3999', 'Rua do teste de novembro', '1630152240_a3de3896dda5001848fa.png', 'Uno vivace ', 'HPK-9599', 1, '2021-08-28 07:05:07', '2021-08-28 09:04:24', NULL),
(3, 'Entregador 01', '962.375.470-10', '01706264072', 'entregador@gmail.com', '(99) 9916-9490', 'Rua do teste de novembro no centro ', NULL, 'Uno vivace ', 'HPK-9577', 1, '2021-08-28 09:35:19', '2021-08-28 09:46:03', '2021-08-28 09:46:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `expediente`
--

CREATE TABLE `expediente` (
  `id` int UNSIGNED NOT NULL,
  `dia` int NOT NULL,
  `dia_descricao` varchar(50) NOT NULL,
  `abertura` time DEFAULT NULL,
  `fechamento` time DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `expediente`
--

INSERT INTO `expediente` (`id`, `dia`, `dia_descricao`, `abertura`, `fechamento`, `situacao`) VALUES
(1, 0, 'Domingo', '18:00:00', '23:00:00', 1),
(2, 1, 'Segunda', '18:00:00', '23:00:00', 0),
(3, 2, 'Terça', '18:00:00', '23:00:00', 1),
(4, 3, 'Quarta', '18:00:00', '23:00:00', 1),
(5, 4, 'Quinta', '18:00:00', '23:00:00', 1),
(6, 5, 'Sexta', '18:00:00', '23:00:00', 1),
(7, 6, 'Sábado', '18:00:00', '23:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `extras`
--

CREATE TABLE `extras` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `extras`
--

INSERT INTO `extras` (`id`, `nome`, `slug`, `preco`, `descricao`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Catupyryssss', 'catupyryssss', '5.00', 'Extras de Catupyry para adiciona ao produtosss teste', 1, '2021-08-19 16:51:38', '2021-08-21 17:33:57', NULL),
(3, 'teste', 'teste', '15.00', 'teste', 1, '2021-08-21 18:04:53', '2021-08-24 00:05:09', NULL),
(4, 'Teste de verificao', 'teste-de-verificao', '20.00', 'teste de verificção em extras', 1, '2021-08-24 02:45:00', '2021-08-24 02:45:00', NULL),
(5, 'vinagrete', 'vinagrete', '14.00', 'teste', 1, '2021-09-08 19:43:38', '2021-09-08 19:43:38', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pagamento`
--

CREATE TABLE `formas_pagamento` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formas_pagamento`
--

INSERT INTO `formas_pagamento` (`id`, `nome`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Dinheiro', 1, '2021-08-27 02:03:20', '2021-08-27 02:03:26', NULL),
(2, 'Cartão de Créditow', 1, '2021-08-27 12:31:05', '2021-08-27 12:31:05', NULL),
(3, 'teste de cadastro  de forma de pagamento', 1, '2021-08-28 00:57:18', '2021-08-28 00:57:22', NULL),
(4, 'Cartão de Debito', 1, '2021-08-28 00:57:42', '2021-08-28 06:34:48', '2021-08-28 06:34:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medidas`
--

CREATE TABLE `medidas` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medidas`
--

INSERT INTO `medidas` (`id`, `nome`, `descricao`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Pizza grande 12 pedaçossss ', 'Ola mundo ', 1, '2021-08-20 19:21:16', '2021-08-21 21:27:07', NULL),
(2, 'Ola teste de medida', 'Ola teste de medida', 1, '2021-08-21 21:35:42', '2021-08-21 21:35:42', NULL),
(3, 'Ola teste  de medida ', 'teste de medida 01', 1, '2021-08-21 21:36:16', '2021-08-21 21:46:56', NULL),
(4, 'Bisteca de carne ', 'Bisteca de carne com frango ', 1, '2021-08-31 23:51:32', '2021-08-31 23:51:32', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(11, '2021-08-11-010950', 'App\\Database\\Migrations\\CriaTabelaUsuarios', 'default', 'App', 1629495941, 1),
(12, '2021-08-20-211105', 'App\\Database\\Migrations\\CriaTabelaCategorias', 'default', 'App', 1629495941, 1),
(13, '2021-08-21-181137', 'App\\Database\\Migrations\\CriaTabelaExtras', 'default', 'App', 1629569837, 2),
(14, '2021-08-21-221740', 'App\\Database\\Migrations\\CriaTabelaMedidas', 'default', 'App', 1629584447, 3),
(15, '2021-08-22-015007', 'App\\Database\\Migrations\\CriaTabelaProdutos', 'default', 'App', 1629598101, 4),
(16, '2021-08-23-164242', 'App\\Database\\Migrations\\CriaTabelaProdutosExtras', 'default', 'App', 1629737955, 5),
(17, '2021-08-25-060607', 'App\\Database\\Migrations\\CriaTabelaProdutosEspecificacoes', 'default', 'App', 1629872380, 6),
(18, '2021-08-27-010648', 'App\\Database\\Migrations\\CriaTabelaFormasPagamento', 'default', 'App', 1630027476, 7),
(19, '2021-08-28-064212', 'App\\Database\\Migrations\\CriaTabelaEntregadores', 'default', 'App', 1630133564, 8),
(20, '2021-08-28-210122', 'App\\Database\\Migrations\\CriaTabelaBairros', 'default', 'App', 1630185071, 9),
(23, '2021-08-29-193708', 'App\\Database\\Migrations\\CriaTabelaExpediente', 'default', 'App', 1630268472, 10),
(24, '2021-09-11-064625', 'App\\Database\\Migrations\\CriaTabelaPedidos', 'default', 'App', 1631344669, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int UNSIGNED NOT NULL,
  `usuario_id` int UNSIGNED NOT NULL,
  `entregador_id` int UNSIGNED DEFAULT NULL,
  `codigo` varchar(10) NOT NULL,
  `forma_pagamento` varchar(50) NOT NULL,
  `situacao` tinyint(1) NOT NULL DEFAULT '0',
  `produtos` text NOT NULL,
  `valor_produtos` decimal(10,2) NOT NULL,
  `valor_entrega` decimal(10,2) NOT NULL,
  `valor_pedido` decimal(10,2) NOT NULL,
  `endereco_entrega` varchar(255) NOT NULL,
  `observacoes` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `entregador_id`, `codigo`, `forma_pagamento`, `situacao`, `produtos`, `valor_produtos`, `valor_entrega`, `valor_pedido`, `endereco_entrega`, `observacoes`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 8, NULL, '80694315', 'Dinheiro', 0, '', '111.00', '5.00', '5.00', 'Valor de entrega para o bairro: Bom Jesus - Imperatriz - Rua São Raimundo - CEP 65915-090 - MA  - Número 343', 'Ponto de referência: ao lado do posto ipiranga  de bairro - Número: 343. Você informou que não precisa de troco', '2021-09-11 07:18:50', '2021-09-11 07:18:50', NULL),
(2, 8, NULL, '40382697', 'Dinheiro', 0, '', '111.00', '5.00', '5.00', 'Valor de entrega para o bairro: Bom Jesus - Imperatriz - Rua São Raimundo - CEP 65915-090 - MA - Número 343', 'Ponto de referência: ao lado do posto ipiranga  de teste - Número: 343. Você informou que precisa de troco para: R$ 200.00', '2021-09-11 07:21:11', '2021-09-11 07:21:11', NULL),
(3, 8, NULL, '84301275', 'Dinheiro', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:60:\"Prato feito com carnes Ola teste  de medida  Com extra teste\";s:4:\"slug\";s:58:\"prato-feito-com-carnes-ola-teste-de-medida-com-extra-teste\";s:5:\"preco\";s:5:\"37.00\";s:10:\"quantidade\";i:3;s:7:\"tamanho\";s:21:\"Ola teste  de medida \";}}', '111.00', '5.00', '5.00', 'Valor de entrega para o bairro: Bom Jesus - Imperatriz - Rua São Raimundo - CEP 65915-090 - MA - Número 34\r\n', 'Ponto de referência: ao lado do posto ipiranga  de teste de produtos - Número: 34. Você informou que não precisa de troco', '2021-09-11 07:22:54', '2021-09-11 07:22:54', NULL),
(4, 12, NULL, '81047965', 'Dinheiro', 0, 'a:2:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:60:\"Prato feito com carnes Ola teste  de medida  Com extra teste\";s:4:\"slug\";s:58:\"prato-feito-com-carnes-ola-teste-de-medida-com-extra-teste\";s:5:\"preco\";s:5:\"37.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:21:\"Ola teste  de medida \";}i:1;a:5:{s:4:\"slug\";s:107:\"pizza-grande-12-pedacossss-metade-prato-feito-com-carnes-metade-pizza-de-verdades-ola-mundo-com-extra-teste\";s:4:\"nome\";s:110:\"Pizza grande 12 pedaçossss  metade Prato feito com carnes metade Pizza de verdades Ola mundo  com extra teste\";s:5:\"preco\";s:5:\"80.55\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:28:\"Pizza grande 12 pedaçossss \";}}', '117.55', '5.00', '5.00', '<span class=\"text-success\"><b>Valor de entrega para o bairro: </b>Bom Jesus - Imperatriz - Rua Santa Luzia - CEP 65915-080 - MA</span> - Número 54', 'Ponto de referência: Ao lado da creche - Número: 54. Você informou que precisa de troco para: R$ 80.00', '2021-09-11 08:33:11', '2021-09-11 08:33:11', NULL),
(5, 8, NULL, '49135028', 'Dinheiro', 0, 'a:2:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:41:\"Prato feito com carnes Bisteca de carne  \";s:4:\"slug\";s:39:\"prato-feito-com-carnes-bisteca-de-carne\";s:5:\"preco\";s:5:\"15.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:17:\"Bisteca de carne \";}i:1;a:5:{s:4:\"slug\";s:120:\"pizza-grande-12-pedacossss-metade-prato-feito-com-carnes-metade-pizza-de-verdades-ola-mundo-com-extra-teste-de-verificao\";s:4:\"nome\";s:123:\"Pizza grande 12 pedaçossss  metade Prato feito com carnes metade Pizza de verdades Ola mundo  com extra Teste de verificao\";s:5:\"preco\";s:5:\"85.55\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:28:\"Pizza grande 12 pedaçossss \";}}', '100.55', '5.00', '5.00', 'Valor de entrega para o bairro:Bom Jesus - Imperatriz - Rua São Raimundo - CEP 65915-090 - MA - Número 12', 'Ponto de referência: teste de formulario - Número: 12. Você informou que não precisa de troco', '2021-09-12 07:05:25', '2021-09-12 07:05:25', NULL),
(6, 8, NULL, '52184039', 'Dinheiro', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:45:\"Prato feito com carnes Ola teste  de medida  \";s:4:\"slug\";s:42:\"prato-feito-com-carnes-ola-teste-de-medida\";s:5:\"preco\";s:5:\"22.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:21:\"Ola teste  de medida \";}}', '22.00', '5.00', '5.00', 'Bom Jesus - Imperatriz - Rua São Raimundo - CEP 65915-090 - MA - Número 34', 'Ponto de referência: ao lado do posto ipiranga   teste - Número: 34. Você informou que não precisa de troco', '2021-09-12 23:18:59', '2021-09-12 23:18:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int UNSIGNED NOT NULL,
  `categoria_id` int UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ingredientes` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `imagem` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `categoria_id`, `nome`, `slug`, `ingredientes`, `ativo`, `imagem`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 5, 'Prato feito com carnes', 'prato-feito-com-carnes', 'Marmitex, sebola carne', 1, '1630464435_5d0c4f20cda17d3dab8f.jpg', '2021-08-20 18:45:56', '2021-08-31 23:49:13', NULL),
(2, 1, 'teste de produto para cadastro', 'teste-de-produto-para-cadastro', 'teste de produto para cadastro', 1, '1630360243_88d32f4bf2d19543efcc.png', '2021-08-22 05:56:55', '2021-08-30 18:50:43', NULL),
(3, 5, 'Pizza de verdades Ola mundo ', 'pizza-de-verdades-ola-mundo', 'Teste de cebola com carne de sol teste ', 1, '1630153041_9e7b500630fd25a0055b.jpg', '2021-08-23 14:17:28', '2021-08-28 09:17:21', NULL),
(4, 1, 'Pízza de Masssa quente', 'pizza-de-masssa-quente', 'Carne, frango, linguiça, queija, tomate', 1, '1630298752_a49c6f93acff3f7f8710.jpg', '2021-08-30 01:41:48', '2021-08-30 01:45:53', NULL),
(5, 19, 'frango', 'frango', 'sal alhor tomate', 1, '1631140900_c2264ffc21a4fdb187b4.png', '2021-09-08 19:39:50', '2021-09-08 19:41:41', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_especificacoes`
--

CREATE TABLE `produtos_especificacoes` (
  `id` int UNSIGNED NOT NULL,
  `produto_id` int UNSIGNED NOT NULL,
  `medida_id` int UNSIGNED NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `customizavel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos_especificacoes`
--

INSERT INTO `produtos_especificacoes` (`id`, `produto_id`, `medida_id`, `preco`, `customizavel`) VALUES
(2, 3, 2, '2500.00', 1),
(9, 2, 3, '25.00', 1),
(10, 2, 2, '32.00', 1),
(14, 1, 4, '15.00', 1),
(16, 4, 4, '12.00', 1),
(17, 1, 3, '22.00', 1),
(18, 3, 4, '59.99', 1),
(19, 3, 1, '65.55', 1),
(20, 1, 1, '12.00', 1),
(22, 5, 4, '26.00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_extras`
--

CREATE TABLE `produtos_extras` (
  `id` int UNSIGNED NOT NULL,
  `produto_id` int UNSIGNED NOT NULL,
  `extra_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos_extras`
--

INSERT INTO `produtos_extras` (`id`, `produto_id`, `extra_id`) VALUES
(3, 3, 3),
(4, 3, 1),
(5, 1, 4),
(6, 2, 3),
(8, 1, 3),
(9, 5, 1),
(10, 5, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  `password_hash` varchar(255) NOT NULL,
  `ativacao_hash` varchar(64) DEFAULT NULL,
  `reset_hash` varchar(64) DEFAULT NULL,
  `reset_expira_em` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `is_admin`, `ativo`, `password_hash`, `ativacao_hash`, `reset_hash`, `reset_expira_em`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(2, 'Dinete', 'admin@admin.com', '187.998.450-40', '(55) 1552-2281', 0, 1, '$2y$10$zHJ4mW5HTqCJqBw.Trp88eZiu5X8YfQM8S9Imma0l.excQgDmtxK2', NULL, NULL, NULL, '2021-08-21 01:38:56', '2021-08-21 01:38:56', NULL),
(1, 'Raimundo Nonato Sampaio', 'alefesampaio@gmail.com', '62070096300', '9999999999', 1, 1, '$2y$10$58toci4bhS4AgCnSc1P17.f7S9dITpqcHBvYnJJj0dVuPrIin30Ba', NULL, NULL, NULL, '2021-08-20 20:13:41', '2021-08-20 19:15:55', NULL),
(10, 'Teste de verificação ', 'alefesampaios@gmail.com', '797.734.553-60', '', 0, 0, '$2y$10$ztz/NG7a2oV0agdXdmPoPutR78G4VbHP1eIkBJ58Fn/fbboUiRXKG', '9ef130ef3f5370c8dc29c22df0b9816d1750e529073c803128814e2551b2472a', NULL, NULL, '2021-09-09 03:25:09', '2021-09-09 03:25:09', NULL),
(6, 'Raimundo novo teste email', 'america1219@uorak.com', '136.673.180-81', '', 0, 0, '$2y$10$/8KTLE4Vo5spD3hZvh7rRuymNXMDt03PUptrt.qV1YjURYrpbnM5K', '97bf891621a9e1fc76babdeedc35f78da6e483c56b94c9ea84b79c52d3c801ef', NULL, NULL, '2021-09-08 08:13:09', '2021-09-08 08:13:09', NULL),
(12, 'Raimundo codeIgniter', 'codelstatus@gmail.com', '547.641.730-34', '', 0, 1, '$2y$10$rlCUkIPYdIkQ2FoVs03gSeQH84Jq9ckHf4kXjvDblCEHCU5ZQRrFS', NULL, NULL, NULL, '2021-09-11 08:23:57', '2021-09-11 08:25:25', NULL),
(9, 'darlan teste', 'entregador@gmail.com', '854.525.290-04', '', 0, 0, '$2y$10$7I3HAWuh9LTvjJzYkdWxlugAa5rg1IzCOd9AbmxTW.QsPGyt/gIoO', 'e223739501d46b2086f04506106fa0cbe31a16aeee64c397d0b8a5d81c3a289e', NULL, NULL, '2021-09-08 19:33:35', '2021-09-08 19:33:35', NULL),
(11, 'verificar link', 'horoja2745@ppp998.com', '071.640.310-29', '', 0, 1, '$2y$10$hJO4VbBPWLkxaGgY.z0vt.lnloT/J1gBlLlF5/2g6Ij3bg/8tdFvm', NULL, NULL, NULL, '2021-09-09 03:54:39', '2021-09-09 03:55:03', NULL),
(8, 'Usuario teste cliente', 'jimeyox834@stvbz.com', '148.020.620-28', '(99) 9999-9999', 0, 1, '$2y$10$G8VhRsmXTTx.k0oiO68S1.fw4GNGJl2SnzXGeM4fjxEjvUi1nYnY.', NULL, NULL, NULL, '2021-09-08 09:01:35', '2021-09-10 03:23:02', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `entregadores`
--
ALTER TABLE `entregadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `cnh` (`cnh`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- Índices para tabela `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_usuario_id_foreign` (`usuario_id`),
  ADD KEY `pedidos_entregador_id_foreign` (`entregador_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `produtos_categoria_id_foreign` (`categoria_id`);

--
-- Índices para tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_especificacoes_produto_id_foreign` (`produto_id`),
  ADD KEY `produtos_especificacoes_medida_id_foreign` (`medida_id`);

--
-- Índices para tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_extras_produto_id_foreign` (`produto_id`),
  ADD KEY `produtos_extras_extra_id_foreign` (`extra_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `ativacao_hash` (`ativacao_hash`),
  ADD UNIQUE KEY `reset_hash` (`reset_hash`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `entregadores`
--
ALTER TABLE `entregadores`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `expediente`
--
ALTER TABLE `expediente`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_entregador_id_foreign` FOREIGN KEY (`entregador_id`) REFERENCES `entregadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Limitadores para a tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  ADD CONSTRAINT `produtos_especificacoes_medida_id_foreign` FOREIGN KEY (`medida_id`) REFERENCES `medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_especificacoes_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  ADD CONSTRAINT `produtos_extras_extra_id_foreign` FOREIGN KEY (`extra_id`) REFERENCES `extras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_extras_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
