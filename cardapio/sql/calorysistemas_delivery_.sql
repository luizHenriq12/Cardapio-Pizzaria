-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/10/2023 às 01:21
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `calorysistemas_delivery.`
--
CREATE DATABASE IF NOT EXISTS `calorysistemas_delivery.` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `calorysistemas_delivery.`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `imagem`, `status`) VALUES
(1, 'Bebidas', '', 1),
(3, 'pizzas', '', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `forma_pgto`
--

CREATE TABLE `forma_pgto` (
  `id` int(11) NOT NULL,
  `opcao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `forma_pgto`
--

INSERT INTO `forma_pgto` (`id`, `opcao`) VALUES
(1, 'Pix'),
(2, 'Cartão'),
(3, 'Dinheiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `montar`
--

CREATE TABLE `montar` (
  `id` int(11) NOT NULL,
  `id_variedades` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `montar`
--

INSERT INTO `montar` (`id`, `id_variedades`, `nome`, `price`, `imagem`, `status`) VALUES
(1, 1, 'Chocolate', 0, '', 1),
(2, 1, 'Nutella', 0, '', 1),
(3, 1, 'Brigadeiro', 0, '', 1),
(4, 1, 'Chocolate Branco', 0, '', 1),
(5, 2, 'Calabresa', 0, '', 1),
(6, 2, 'Bacon', 0, '', 1),
(7, 2, 'Havaiana', 0, '', 1),
(8, 2, 'Moda da Casa', 0, '', 1),
(9, 2, 'Frango', 0, '', 1),
(10, 2, 'Lombinho', 0, '', 1),
(11, 2, 'Camarão', 0, '', 1),
(12, 2, 'Salame', 0, '', 1),
(13, 4, 'Borda Catupiry', 0, '', 1),
(14, 4, 'Borda Cheddar', 0, '', 1),
(15, 3, 'Massa Comum', 0, '', 1),
(16, 3, 'Massa Premium', 10, '', 1),
(17, 3, 'Massa Integral', 10, '', 1),
(18, 4, 'Borda Chocolate', 0, '', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidosvendas`
--

CREATE TABLE `pedidosvendas` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `cliente_nome` varchar(200) NOT NULL,
  `cliente_contato` varchar(50) NOT NULL,
  `cliente_endereco` text NOT NULL,
  `cliente_opc_pgt` int(11) NOT NULL,
  `observacao` text NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `name`, `id_categoria`, `price`, `description`, `images`, `status`) VALUES
(1, 'Pizza P', 3, 50, 'Maximo 1 Sabor\r\n\r\n4 Pedaços', 'Pizza-Calabresa.jpg', 1),
(2, 'Pizza M', 3, 60, 'Maximo 2 Sabores\r\n\r\n6 Pedaços', 'Pizza-Calabresa.jpg', 1),
(3, 'Pizza G', 3, 70, 'Maximo 3 Sabores\r\n\r\n10 Pedaços', 'Pizza-Calabresa.jpg', 1),
(4, 'Pizza Big', 3, 90, 'Maximo 4 Sabores\r\n\r\n15 Pedaços', 'Pizza-Calabresa.jpg', 1),
(6, 'Coca Cola 2L', 1, 9, 'Coca cola 2L gelada', 'Coca-Cola.jpg', 1),
(7, 'Guarana 2L', 1, 8, 'Guarana 2L gelada', 'Guarana.jpg', 1),
(8, 'Fanta', 1, 8, 'Fanta 2L gelada', 'fanta.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `variedade`
--

CREATE TABLE `variedade` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `staus_var` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `variedade`
--

INSERT INTO `variedade` (`id`, `nome`, `imagem`, `staus_var`) VALUES
(1, 'sabores doces', '', 1),
(2, 'sabores salgados', '', 1),
(3, 'massas', '', 1),
(4, 'bordas', '', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `forma_pgto`
--
ALTER TABLE `forma_pgto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `montar`
--
ALTER TABLE `montar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`id_variedades`);

--
-- Índices de tabela `pedidosvendas`
--
ALTER TABLE `pedidosvendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `cliente_opc_pgt` (`cliente_opc_pgt`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `variedade`
--
ALTER TABLE `variedade`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `forma_pgto`
--
ALTER TABLE `forma_pgto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `montar`
--
ALTER TABLE `montar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `pedidosvendas`
--
ALTER TABLE `pedidosvendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `variedade`
--
ALTER TABLE `variedade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `montar`
--
ALTER TABLE `montar`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`id_variedades`) REFERENCES `variedade` (`id`);

--
-- Restrições para tabelas `pedidosvendas`
--
ALTER TABLE `pedidosvendas`
  ADD CONSTRAINT `pedidosvendas_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `pedidosvendas_ibfk_2` FOREIGN KEY (`cliente_opc_pgt`) REFERENCES `forma_pgto` (`id`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
