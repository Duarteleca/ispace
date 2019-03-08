-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2019 at 05:55 PM
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
(1, 'TV     ', '20', '1', 'assets/img/equipamento/tv.jpg'),
(2, 'Tomada', '20', '1', 'assets/img/equipamento/triplas.jpg'),
(3, 'Portatil', '20', '1', 'assets/img/equipamento/portatil.jpg'),
(4, 'Projetor', '20', '1', 'assets/img/equipamento/projetor.jpg'),
(5, 'Cadeira', '20', '0', 'assets/img/equipamento/cadeira.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `requisicao`
--

CREATE TABLE `requisicao` (
  `id` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  `utilizador_id` int(11) NOT NULL,
  `tipologia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requisicao`
--

INSERT INTO `requisicao` (`id`, `data_inicio`, `data_fim`, `hora_inicio`, `hora_fim`, `utilizador_id`, `tipologia_id`) VALUES
(145, '2019-03-13', '2019-03-16', '10:00:00', '18:00:00', 9, 21);

-- --------------------------------------------------------

--
-- Table structure for table `requisicao_has_equipamento`
--

CREATE TABLE `requisicao_has_equipamento` (
  `id` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `equipamento_id` int(11) NOT NULL,
  `requisicao_id` int(11) NOT NULL
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
  `nome` varchar(45) NOT NULL,
  `imagem` varchar(45) NOT NULL,
  `sala_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipologia`
--

INSERT INTO `tipologia` (`id`, `capacidade`, `disponibilidade`, `nome`, `imagem`, `sala_id`) VALUES
(5, 25, 1, 'Sala A', 'assets/img/salas/conferencia.jpg', 1),
(6, 30, 1, 'Sala B', 'assets/img/salas/conferencia.jpg', 2),
(7, 50, 1, 'Sala C', 'assets/img/salas/conferencia.jpg', 3),
(8, 20, 0, ' Sala D', 'assets/img/salas/conferencia.jpg', 4),
(12, 20, 1, 'Sala F', 'assets/img/salas/conferencia.jpg', 4),
(13, 20, 1, 'Sala G', 'assets/img/salas/conferencia.jpg', 4),
(14, 20, 1, 'Sala H', 'assets/img/salas/conferencia.jpg', 4),
(15, 20, 1, 'Sala J', 'assets/img/salas/conferencia.jpg', 2),
(16, 20, 1, 'Sala E', 'assets/img/salas/conferencia.jpg', 2),
(17, 20, 1, 'Sala K', 'assets/img/salas/conferencia.jpg', 2),
(18, 20, 1, 'Sala L', 'assets/img/salas/conferencia.jpg', 2),
(19, 20, 1, 'Sala M', 'assets/img/salas/conferencia.jpg', 2),
(20, 20, 1, 'Sala Q', 'assets/img/salas/conferencia.jpg', 2),
(21, 20, 0, 'Sala W', 'assets/img/salas/conferencia.jpg', 2),
(23, 20, 1, 'Sala T', 'assets/img/salas/conferencia.jpg', 2);

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
(9, 'teste', 'teste', 'teste@teste.com', '$2y$10$doWrzqjWrC6RaoDsjKsS8eA0c7Wso52B6FklmyWk7iKeCOEC4FazS', 3, 'assets/img/utilizadores/25655_111.jpg'),
(11, 'admin', 'admin', 'admi@gmail.com', '$2y$10$2jc7ExKpok0Esyh2uHMz7ux.PZTE7bg6qF1sBmK4n7o0VFb922HzO', 1, 'assets/img/utilizadores/usericon.png');

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
-- Indexes for table `requisicao`
--
ALTER TABLE `requisicao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_requisicao_utilizador1_idx` (`utilizador_id`),
  ADD KEY `fk_requisicao_tipologia1_idx` (`tipologia_id`);

--
-- Indexes for table `requisicao_has_equipamento`
--
ALTER TABLE `requisicao_has_equipamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_requisicao_has_equipamento_equipamento1_idx` (`equipamento_id`),
  ADD KEY `fk_requisicao_has_equipamento_requisicao1_idx` (`requisicao_id`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipologia`
--
ALTER TABLE `tipologia`
  ADD PRIMARY KEY (`id`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requisicao`
--
ALTER TABLE `requisicao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `requisicao_has_equipamento`
--
ALTER TABLE `requisicao_has_equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipologia`
--
ALTER TABLE `tipologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requisicao`
--
ALTER TABLE `requisicao`
  ADD CONSTRAINT `fk_requisicao_tipologia1` FOREIGN KEY (`tipologia_id`) REFERENCES `tipologia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_requisicao_utilizador1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `requisicao_has_equipamento`
--
ALTER TABLE `requisicao_has_equipamento`
  ADD CONSTRAINT `fk_requisicao_has_equipamento_equipamento1` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requisicao_has_equipamento_requisicao1` FOREIGN KEY (`requisicao_id`) REFERENCES `requisicao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tipologia`
--
ALTER TABLE `tipologia`
  ADD CONSTRAINT `fk_tipologia_sala1` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
