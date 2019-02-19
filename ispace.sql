-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2019 at 10:21 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ispace`
--

-- --------------------------------------------------------

--
-- Table structure for table `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `e-mail` varchar(64) NOT NULL,
  `mensagem` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `quantidade` varchar(45) NOT NULL,
  `disponibilidade` varchar(45) NOT NULL,
  `imagem` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipamento`
--

INSERT INTO `equipamento` (`id`, `nome`, `quantidade`, `disponibilidade`, `imagem`) VALUES
(1, 'TV', '10', '1', 'assets/img/equipamento/tv.jpg'),
(2, 'Extensão de Tomada', '20', '1', 'assets/img/equipamento/triplas.jpg'),
(3, 'Portatil', '20', '1', 'assets/img/equipamento/portatil.jpg'),
(4, 'Projetor', '20', '1', 'assets/img/equipamento/projetor.jpg'),
(5, 'Cadeira', '60', '1', 'assets/img/equipamento/cadeira.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `requesicao_has_equipamento`
--

CREATE TABLE `requesicao_has_equipamento` (
  `equipamento_id` int(11) NOT NULL,
  `requisicao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `requisicao`
--

CREATE TABLE `requisicao` (
  `id` int(11) NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `hora_inicio` varchar(45) DEFAULT NULL,
  `hora_fim` varchar(45) DEFAULT NULL,
  `utilizador_id` int(11) NOT NULL,
  `sala_id1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `tipo_sala` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sala`
--

INSERT INTO `sala` (`id`, `tipo_sala`) VALUES
(1, 'Reunião'),
(2, 'Lazer'),
(3, 'Formação'),
(4, 'Conferência');

-- --------------------------------------------------------

--
-- Table structure for table `tipologia`
--

CREATE TABLE `tipologia` (
  `id` int(11) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `disponibilidade` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `imagem` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipologia`
--

INSERT INTO `tipologia` (`id`, `capacidade`, `disponibilidade`, `sala_id`, `nome`, `imagem`) VALUES
(5, 25, 1, 1, 'Sala A', 'assets/img/salas/conferencia.jpg'),
(6, 30, 1, 2, 'Sala B', 'assets/img/salas/conferencia.jpg'),
(7, 50, 1, 3, 'Sala C', 'assets/img/salas/conferencia.jpg'),
(8, 20, 1, 4, 'Sala D', 'assets/img/salas/conferencia.jpg'),
(12, 20, 1, 4, 'Sala F', 'assets/img/salas/conferencia.jpg'),
(13, 20, 1, 4, 'Sala G', 'assets/img/salas/conferencia.jpg'),
(14, 20, 1, 4, 'Sala H', 'assets/img/salas/conferencia.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `utilizador`
--

CREATE TABLE `utilizador` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` int(11) NOT NULL,
  `imagem` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilizador`
--

INSERT INTO `utilizador` (`id`, `nome`, `username`, `email`, `password`, `tipo`, `imagem`) VALUES
(1, 'admin', 'admin', 'admin@ispace.com', '1234', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requesicao_has_equipamento`
--
ALTER TABLE `requesicao_has_equipamento`
  ADD PRIMARY KEY (`equipamento_id`,`requisicao_id`),
  ADD KEY `fk_requesicao_has_equipamento_requisicao1_idx` (`requisicao_id`);

--
-- Indexes for table `requisicao`
--
ALTER TABLE `requisicao`
  ADD PRIMARY KEY (`id`,`utilizador_id`,`sala_id1`),
  ADD KEY `fk_requisicao_utilizador1_idx` (`utilizador_id`),
  ADD KEY `fk_requisicao_sala1_idx` (`sala_id1`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipologia`
--
ALTER TABLE `tipologia`
  ADD PRIMARY KEY (`id`,`sala_id`),
  ADD KEY `fk_tipologia_sala1_idx` (`sala_id`);

--
-- Indexes for table `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requisicao`
--
ALTER TABLE `requisicao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipologia`
--
ALTER TABLE `tipologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requesicao_has_equipamento`
--
ALTER TABLE `requesicao_has_equipamento`
  ADD CONSTRAINT `fk_requesicao_has_equipamento_equipamento` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requesicao_has_equipamento_requisicao1` FOREIGN KEY (`requisicao_id`) REFERENCES `requisicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `requisicao`
--
ALTER TABLE `requisicao`
  ADD CONSTRAINT `fk_requisicao_sala1` FOREIGN KEY (`sala_id1`) REFERENCES `sala` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requisicao_utilizador1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tipologia`
--
ALTER TABLE `tipologia`
  ADD CONSTRAINT `fk_tipologia_sala1` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
