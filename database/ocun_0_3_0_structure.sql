-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 20/02/2020 às 21:41
-- Versão do servidor: 10.3.16-MariaDB
-- Versão do PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ocun_clean`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `abbreviation`
--

CREATE TABLE `abbreviation` (
  `id` bigint(20) NOT NULL,
  `source` int(11) NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `meaning` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chain`
--

CREATE TABLE `chain` (
  `id` bigint(20) NOT NULL,
  `sentence` bigint(20) NOT NULL,
  `position` int(11) NOT NULL,
  `morpheme` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `encode`
--

CREATE TABLE `encode` (
  `id` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `input` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `output` varchar(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `information` mediumtext COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `meaning_classification`
--

CREATE TABLE `meaning_classification` (
  `meaning` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `classification` enum('f','e','p','t') COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `morpheme`
--

CREATE TABLE `morpheme` (
  `id` bigint(20) NOT NULL,
  `source` int(11) NOT NULL,
  `form` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `meaning` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `visibility` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sentence`
--

CREATE TABLE `sentence` (
  `id` bigint(20) NOT NULL,
  `source` int(11) NOT NULL,
  `original` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `translation` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `source`
--

CREATE TABLE `source` (
  `id` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `year` int(11) NOT NULL,
  `license` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT 'private',
  `url` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `separators` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `source_access`
--

CREATE TABLE `source_access` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `source` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usr_level`
--

CREATE TABLE `usr_level` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `abbreviation`
--
ALTER TABLE `abbreviation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `source` (`source`);

--
-- Índices de tabela `chain`
--
ALTER TABLE `chain`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sentence` (`sentence`,`position`,`morpheme`),
  ADD KEY `morpheme` (`morpheme`);

--
-- Índices de tabela `encode`
--
ALTER TABLE `encode`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `source` (`source`,`input`);

--
-- Índices de tabela `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índices de tabela `meaning_classification`
--
ALTER TABLE `meaning_classification`
  ADD PRIMARY KEY (`meaning`);

--
-- Índices de tabela `morpheme`
--
ALTER TABLE `morpheme`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `source` (`source`,`form`,`meaning`);

--
-- Índices de tabela `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sentence`
--
ALTER TABLE `sentence`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `source` (`source`,`original`,`translation`);

--
-- Índices de tabela `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `language` (`language`,`name`);

--
-- Índices de tabela `source_access`
--
ALTER TABLE `source_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `source_access_ibfk_1` (`source`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `level` (`level`);

--
-- Índices de tabela `usr_level`
--
ALTER TABLE `usr_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `abbreviation`
--
ALTER TABLE `abbreviation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `chain`
--
ALTER TABLE `chain`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `encode`
--
ALTER TABLE `encode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `morpheme`
--
ALTER TABLE `morpheme`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sentence`
--
ALTER TABLE `sentence`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `source`
--
ALTER TABLE `source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `source_access`
--
ALTER TABLE `source_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `abbreviation`
--
ALTER TABLE `abbreviation`
  ADD CONSTRAINT `abbreviation_ibfk_1` FOREIGN KEY (`source`) REFERENCES `source` (`id`);

--
-- Restrições para tabelas `chain`
--
ALTER TABLE `chain`
  ADD CONSTRAINT `chain_ibfk_1` FOREIGN KEY (`morpheme`) REFERENCES `morpheme` (`id`),
  ADD CONSTRAINT `chain_ibfk_2` FOREIGN KEY (`sentence`) REFERENCES `sentence` (`id`);

--
-- Restrições para tabelas `encode`
--
ALTER TABLE `encode`
  ADD CONSTRAINT `encode_ibfk_1` FOREIGN KEY (`source`) REFERENCES `source` (`id`);

--
-- Restrições para tabelas `morpheme`
--
ALTER TABLE `morpheme`
  ADD CONSTRAINT `morpheme_ibfk_1` FOREIGN KEY (`source`) REFERENCES `source` (`id`);

--
-- Restrições para tabelas `sentence`
--
ALTER TABLE `sentence`
  ADD CONSTRAINT `sentence_ibfk_1` FOREIGN KEY (`source`) REFERENCES `source` (`id`);

--
-- Restrições para tabelas `source`
--
ALTER TABLE `source`
  ADD CONSTRAINT `source_ibfk_1` FOREIGN KEY (`language`) REFERENCES `language` (`id`);

--
-- Restrições para tabelas `source_access`
--
ALTER TABLE `source_access`
  ADD CONSTRAINT `source_access_ibfk_1` FOREIGN KEY (`source`) REFERENCES `source` (`id`),
  ADD CONSTRAINT `source_access_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Restrições para tabelas `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `usr_level` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
