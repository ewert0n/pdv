-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Set-2022 às 18:55
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `database`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(535) NOT NULL,
  `idade` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  PRIMARY KEY (`cliente_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fatura`
--

DROP TABLE IF EXISTS `fatura`;
CREATE TABLE IF NOT EXISTS `fatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagamento` varchar(20) NOT NULL,
  `valortotal` float NOT NULL,
  `datahora` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fatura`
--

INSERT INTO `fatura` (`id`, `pagamento`, `valortotal`, `datahora`) VALUES
(36, 'CartÃ£o de DÃ©bito', 62.5, '2022-09-13 06:08:01'),
(35, 'CartÃ£o de DÃ©bito', 800.04, '2022-09-09 06:28:28'),
(34, 'Dinheiro', 31.25, '2022-09-09 02:16:15'),
(33, 'CartÃ£o de DÃ©bito', 260, '2022-09-07 05:34:29'),
(32, 'CartÃ£o de DÃ©bito', 260, '2022-09-07 05:33:28'),
(31, 'CartÃ£o de DÃ©bito', 260, '2022-09-07 05:32:57'),
(30, 'CartÃ£o de DÃ©bito', 260, '2022-09-07 05:32:16'),
(29, 'CartÃ£o de DÃ©bito', 332.8, '2022-09-07 05:30:32'),
(28, 'CartÃ£o de DÃ©bito', 36.4, '2022-09-07 05:29:47'),
(27, 'CartÃ£o de DÃ©bito', 10.4, '2022-09-07 05:28:18'),
(26, 'CartÃ£o de DÃ©bito', 30.4, '2022-09-07 05:26:27'),
(25, 'CartÃ£o de DÃ©bito', 104, '2022-09-07 05:23:26'),
(24, 'CartÃ£o de DÃ©bito', 812.5, '2022-09-02 05:35:06'),
(23, 'CartÃ£o de CrÃ©dito', 395, '2022-09-01 10:54:35'),
(22, 'Dinheiro', 395, '2022-09-01 10:49:59'),
(21, 'CartÃ£o de CrÃ©dito', 987.5, '2022-09-01 10:33:51'),
(20, 'Dinheiro', 700, '2022-09-01 10:18:15'),
(37, 'Dinheiro', 1295.35, '2022-09-13 06:17:12'),
(38, 'CartÃ£o de DÃ©bito', 1600.08, '2022-09-13 06:17:40'),
(39, 'CartÃ£o de DÃ©bito', 1850.5, '2022-09-13 06:18:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `pedidos_id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  PRIMARY KEY (`pedidos_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`pedidos_id`, `descricao`, `quantidade`, `valor`, `produto_id`, `cliente_id`) VALUES
(1, 'Heineken 350ml', 12, 10, 166, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `produto_id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  `margemlucro` float NOT NULL,
  `valordevenda` float NOT NULL,
  `estoque` int(11) NOT NULL,
  PRIMARY KEY (`produto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`produto_id`, `codigo`, `descricao`, `valor`, `margemlucro`, `valordevenda`, `estoque`) VALUES
(21, 177, 'Brahma Duplo Malte 350ml', 4, 50, 6, 20),
(17, 166, 'Coca Cola 600ml', 6, 25, 7.5, 10),
(20, 552, 'Heineken 330ml', 5, 25, 6.25, -5),
(18, 555, 'Skol 350ml', 4, 20, 4.8, 5),
(19, 170, 'Lokal 350ml', 2.5, 20, 3, 10),
(23, 500, 'White Horse', 60, 33.34, 80.004, -10),
(22, 200, 'Cantinho do Vale', 8, 30, 10.4, 16),
(24, 600, 'Whisky Johnnie Walker Black Label 750ml', 119, 55.5, 185.05, -7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtosvendidos`
--

DROP TABLE IF EXISTS `produtosvendidos`;
CREATE TABLE IF NOT EXISTS `produtosvendidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fatura_id` int(11) NOT NULL,
  `valor` float NOT NULL,
  `quantidade` int(11) NOT NULL,
  `margemlucro` float NOT NULL,
  `produto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtosvendidos`
--

INSERT INTO `produtosvendidos` (`id`, `fatura_id`, `valor`, `quantidade`, `margemlucro`, `produto_id`) VALUES
(4, 20, 6.25, 50, 25, 552),
(3, 20, 6.25, 50, 25, 552),
(5, 20, 7.5, 10, 25, 166),
(6, 21, 6.25, 50, 25, 552),
(7, 21, 7.5, 90, 25, 166),
(8, 22, 3, 10, 20, 170),
(9, 22, 4.8, 50, 20, 555),
(10, 22, 6.25, 20, 25, 552),
(11, 23, 6.25, 20, 25, 552),
(12, 23, 3, 10, 20, 170),
(13, 23, 4.8, 50, 20, 555),
(14, 24, 6.25, 50, 25, 552),
(15, 24, 6.25, 30, 25, 552),
(16, 24, 6.25, 50, 25, 552),
(17, 25, 10.4, 10, 30, 200),
(18, 26, 5.2, 2, 30, 177),
(19, 26, 4.8, 2, 20, 555),
(20, 26, 10.4, 1, 30, 200),
(21, 27, 10.4, 1, 30, 200),
(22, 28, 5.2, 5, 30, 177),
(23, 28, 10.4, 1, 30, 200),
(24, 29, 10.4, 32, 30, 200),
(25, 32, 10.4, 25, 30, 200),
(26, 33, 10.4, 25, 30, 200),
(27, 34, 6.25, 5, 25, 552),
(28, 35, 80.004, 10, 33.34, 500),
(29, 36, 6.25, 10, 25, 552),
(30, 37, 185.05, 5, 55.5, 600),
(31, 37, 185.05, 2, 55.5, 600),
(32, 38, 80.004, 20, 33.34, 500),
(33, 39, 185.05, 10, 55.5, 600);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
