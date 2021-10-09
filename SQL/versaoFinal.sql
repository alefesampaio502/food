-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 04-Out-2021 às 02:26
-- Versão do servidor: 8.0.26-0ubuntu0.20.04.3
-- versão do PHP: 7.4.24

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
(19, 'remedio', 'remedio', 1, '2021-09-08 19:38:28', '2021-09-24 17:14:20', '2021-09-24 17:14:20');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `entregadores`
--

INSERT INTO `entregadores` (`id`, `nome`, `cpf`, `cnh`, `email`, `telefone`, `endereco`, `imagem`, `veiculo`, `placa`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'teste ', '017.062.640-70', '22202581065', 'alefesampaio@gmail.com', '(99) 1794-905', 'Rua do teste de novembro no centro ', NULL, 'Uno vivace ', 'HPK-9599', 1, '2021-10-01 11:47:33', '2021-10-01 11:47:33', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `expediente`
--

INSERT INTO `expediente` (`id`, `dia`, `dia_descricao`, `abertura`, `fechamento`, `situacao`) VALUES
(1, 0, 'Domingo', '18:00:00', '23:00:00', 1),
(2, 1, 'Segunda', '18:00:00', '23:00:00', 1),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `formas_pagamento`
--

INSERT INTO `formas_pagamento` (`id`, `nome`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Dinheiro', 1, '2021-10-01 11:20:15', '2021-10-01 11:20:15', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(45, '2021-08-11-010950', 'App\\Database\\Migrations\\CriaTabelaUsuarios', 'default', 'App', 1633097782, 1),
(46, '2021-08-20-211105', 'App\\Database\\Migrations\\CriaTabelaCategorias', 'default', 'App', 1633097783, 1),
(47, '2021-08-21-181137', 'App\\Database\\Migrations\\CriaTabelaExtras', 'default', 'App', 1633097783, 1),
(48, '2021-08-21-221740', 'App\\Database\\Migrations\\CriaTabelaMedidas', 'default', 'App', 1633097783, 1),
(49, '2021-08-22-015007', 'App\\Database\\Migrations\\CriaTabelaProdutos', 'default', 'App', 1633097783, 1),
(50, '2021-08-23-164242', 'App\\Database\\Migrations\\CriaTabelaProdutosExtras', 'default', 'App', 1633097783, 1),
(51, '2021-08-25-060607', 'App\\Database\\Migrations\\CriaTabelaProdutosEspecificacoes', 'default', 'App', 1633097783, 1),
(52, '2021-08-27-010648', 'App\\Database\\Migrations\\CriaTabelaFormasPagamento', 'default', 'App', 1633097783, 1),
(53, '2021-08-28-064212', 'App\\Database\\Migrations\\CriaTabelaEntregadores', 'default', 'App', 1633097783, 1),
(54, '2021-08-28-210122', 'App\\Database\\Migrations\\CriaTabelaBairros', 'default', 'App', 1633097784, 1),
(55, '2021-08-29-193708', 'App\\Database\\Migrations\\CriaTabelaExpediente', 'default', 'App', 1633097784, 1),
(56, '2021-09-11-064625', 'App\\Database\\Migrations\\CriaTabelaPedidos', 'default', 'App', 1633097784, 1),
(57, '2021-09-16-131343', 'App\\Database\\Migrations\\CriaTabelaPedidosProdutos', 'default', 'App', 1633097784, 1),
(58, '2021-10-01-002342', 'App\\Database\\Migrations\\CriaTabelaSistema', 'default', 'App', 1633097784, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_produtos`
--

CREATE TABLE `pedidos_produtos` (
  `id` int UNSIGNED NOT NULL,
  `pedido_id` int UNSIGNED NOT NULL,
  `produto` varchar(255) NOT NULL,
  `quantidade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int UNSIGNED NOT NULL,
  `categoria_id` int UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `desconto` varchar(155) NOT NULL,
  `ingredientes` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `imagem` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `categoria_id`, `nome`, `slug`, `desconto`, `ingredientes`, `ativo`, `imagem`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 5, 'Prato feito', 'prato-feito', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 1, '1633129855_e822fad0fb6641f2d3ef.png', '2021-08-20 18:45:56', '2021-10-01 20:10:55', NULL),
(2, 1, 'Hambúrguer', 'hamburguer', '', 'teste de produto para cadastro', 1, '1630360243_88d32f4bf2d19543efcc.png', '2021-08-22 05:56:55', '2021-09-20 16:52:29', NULL),
(3, 5, 'Pizza de verdade Data de criação', 'pizza-de-verdade-data-de-criacao', '', 'Teste de cebola com carne de sol teste ', 1, '1630153041_9e7b500630fd25a0055b.jpg', '2021-08-23 14:17:28', '2021-09-20 16:56:06', NULL),
(4, 1, 'Pízza', 'pizza', '', 'Carne, frango, linguiça, queija, tomate', 1, '1630298752_a49c6f93acff3f7f8710.jpg', '2021-08-30 01:41:48', '2021-09-20 16:51:12', NULL),
(5, 5, 'frango teste desconto', 'frango-teste-desconto', '5', 'sal alhor tomate', 1, '1631140900_c2264ffc21a4fdb187b4.png', '2021-09-08 19:39:50', '2021-10-01 11:45:50', NULL),
(6, 5, 'Teste deconto', 'teste-deconto', '50', 'teste de desconto para home', 1, '1633130009_8e5bae53eae8caecbaa0.png', '2021-10-01 11:51:07', '2021-10-01 20:13:29', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `produtos_especificacoes`
--

INSERT INTO `produtos_especificacoes` (`id`, `produto_id`, `medida_id`, `preco`, `customizavel`) VALUES
(1, 6, 2, '12.00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_extras`
--

CREATE TABLE `produtos_extras` (
  `id` int UNSIGNED NOT NULL,
  `produto_id` int UNSIGNED NOT NULL,
  `extra_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `produtos_extras`
--

INSERT INTO `produtos_extras` (`id`, `produto_id`, `extra_id`) VALUES
(1, 6, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistemas`
--

CREATE TABLE `sistemas` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cnpj` varchar(150) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `telefone` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cep` varchar(150) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `numero` varchar(150) NOT NULL,
  `cidade` varchar(150) NOT NULL,
  `estado` varchar(150) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `sistemas`
--

INSERT INTO `sistemas` (`id`, `nome`, `cnpj`, `imagem`, `telefone`, `email`, `cep`, `endereco`, `numero`, `cidade`, `estado`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'MasteItz', '80.190.665/0001-44', NULL, '(99) 1794-905', 'masteitz@masteitz.com', '65900', 'Rua são josé', '453', 'Imperatriz', 'Maranhão', 1, '2021-10-01 12:26:24', '2021-10-01 19:03:48', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `is_admin`, `ativo`, `password_hash`, `ativacao_hash`, `reset_hash`, `reset_expira_em`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Raimundo Nonato Sampaio', 'alefesampaio@gmail.com', '808.398.050-12', '(63) 99999 - 9966', 1, 1, '$2y$10$p1zJo3.nY/zv.t0sMFGaDuGpCAh8.Y.cKo.4nnkkVaBFUrrQl/rva', NULL, NULL, NULL, '2021-10-01 11:20:34', '2021-10-01 11:20:34', NULL);

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
-- Índices para tabela `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_produtos_pedido_id_foreign` (`pedido_id`);

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
-- Índices para tabela `sistemas`
--
ALTER TABLE `sistemas`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `entregadores`
--
ALTER TABLE `entregadores`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `sistemas`
--
ALTER TABLE `sistemas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Limitadores para a tabela `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  ADD CONSTRAINT `pedidos_produtos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
