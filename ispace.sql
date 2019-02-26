-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Fev-2019 às 16:12
-- Versão do servidor: 10.1.33-MariaDB
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
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `e-mail` varchar(64) NOT NULL,
  `mensagem` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `quantidade` varchar(45) NOT NULL,
  `disponibilidade` varchar(45) NOT NULL,
  `imagem` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`id`, `nome`, `quantidade`, `disponibilidade`, `imagem`) VALUES
(1, 'TV ', ' 10', '1 ', 'assets/img/equipamento/tv.jpg'),
(2, 'Extensão de Tomada', '20', '1', 'assets/img/equipamento/triplas.jpg'),
(3, 'Portatil', '20', '1', 'assets/img/equipamento/portatil.jpg'),
(4, 'Projetor', '6', '1', 'assets/img/equipamento/projetor.jpg'),
(5, 'Cadeira', '60', '1', 'assets/img/equipamento/cadeira.jpg'),
(6, ' Cadeira Gaming ', ' 5', '0', 'assets/img/equipamento/cadeiragaming.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao`
--

CREATE TABLE `requisicao` (
  `id` int(11) NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `hora_inicio` varchar(45) DEFAULT NULL,
  `hora_fim` varchar(45) DEFAULT NULL,
  `utilizador_id` int(11) NOT NULL,
  `tipologia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `requisicao`
--

INSERT INTO `requisicao` (`id`, `data_inicio`, `data_fim`, `hora_inicio`, `hora_fim`, `utilizador_id`, `tipologia_id`) VALUES
(4, '2019-02-22', '2019-02-22', '08:00', '10:00', 3, 0),
(5, '2019-02-22', '2019-02-22', '08:00', '08:00', 5, 0),
(8, '2019-02-25', '2019-02-25', '08:00', '10:00', 3, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao_has_equipamento`
--

CREATE TABLE `requisicao_has_equipamento` (
  `equipamento_id` int(11) NOT NULL,
  `requisicao_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `requisicao_has_equipamento`
--

INSERT INTO `requisicao_has_equipamento` (`equipamento_id`, `requisicao_id`, `quantidade`) VALUES
(4, 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `tipo_sala` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`id`, `tipo_sala`) VALUES
(1, 'Reunião'),
(2, 'Lazer'),
(3, 'Formação'),
(4, 'Conferência');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipologia`
--

CREATE TABLE `tipologia` (
  `id` int(11) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `disponibilidade` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `imagem` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipologia`
--

INSERT INTO `tipologia` (`id`, `capacidade`, `disponibilidade`, `sala_id`, `nome`, `imagem`) VALUES
(5, 25, 1, 1, 'Sla iiiiiiii', 'assets/img/salas/reuniao.jpg'),
(6, 30, 1, 2, 'Sala  tttt', 'assets/img/salas/lazer.jpg'),
(7, 50, 1, 3, 'Sala J', 'assets/img/salas/formacao.jpg'),
(8, 22, 1, 4, 'Sala U', 'assets/img/salas/conferencia.jpg'),
(9, 55, 1, 2, ' Sala asdasd', 'assets/img/salas/lazer.jpg'),
(32, 55, 1, 2, 'ddddd', 'assets/img/salas/25655_1.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
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
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id`, `nome`, `username`, `email`, `password`, `tipo`, `imagem`) VALUES
(3, 'user', 'user', 'user@gmail.com', '$2y$10$JZwMTj1E3.VQVqV/j5l0xOaXtfU28h66UhVm0gwfachKGC0Rjk/uO', 0, 'assets/img/utilizadores/marco.png'),
(4, 'Marco', 'admin', 'marco2010_2011@ispace.pt', '$2y$10$i1vSm/j36H8RMCJnXEri0ecnd7F8MS6HmKvjIY/oII1tS31aiy5G6', 1, 'assets/img/utilizadores/marco.png'),
(5, 'jose', 'jmiguel99', 'asdas@gmail.com', '$2y$10$M5jbtdGopMxggUgm2IyDT.m0Jsql.kubpT51XbnO9nQrlEuBd0AYW', 1, 'assets/img/utilizadores/');

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
  ADD PRIMARY KEY (`id`,`utilizador_id`,`tipologia_id`),
  ADD KEY `fk_requisicao_utilizador1_idx` (`utilizador_id`),
  ADD KEY `fk_requisicao_tipologia1_idx` (`tipologia_id`);

--
-- Indexes for table `requisicao_has_equipamento`
--
ALTER TABLE `requisicao_has_equipamento`
  ADD PRIMARY KEY (`equipamento_id`,`requisicao_id`),
  ADD KEY `fk_requesicao_has_equipamento_requisicao1_idx` (`requisicao_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requisicao`
--
ALTER TABLE `requisicao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipologia`
--
ALTER TABLE `tipologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `requisicao`
--
ALTER TABLE `requisicao`
  ADD CONSTRAINT `fk_requisicao_tipologia1` FOREIGN KEY (`tipologia_id`) REFERENCES `tipologia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requisicao_utilizador1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `requisicao_has_equipamento`
--
ALTER TABLE `requisicao_has_equipamento`
  ADD CONSTRAINT `fk_requesicao_has_equipamento_equipamento` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requesicao_has_equipamento_requisicao1` FOREIGN KEY (`requisicao_id`) REFERENCES `requisicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tipologia`
--
ALTER TABLE `tipologia`
  ADD CONSTRAINT `fk_tipologia_sala1` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
