-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 10-Mar-2019 às 01:47
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `db_login`
--
CREATE DATABASE IF NOT EXISTS `db_movimentacao` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_movimentacao`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_beneficiario`
--

CREATE TABLE IF NOT EXISTS `tb_beneficiario` (
  `cd_beneficiario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_beneficiario` varchar(200) NOT NULL,
  PRIMARY KEY (`cd_beneficiario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categoria`
--

CREATE TABLE IF NOT EXISTS `tb_categoria` (
  `cd_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nm_categoria` varchar(200) NOT NULL,
  PRIMARY KEY (`cd_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_forma`
--

CREATE TABLE IF NOT EXISTS `tb_forma` (
  `cd_forma` int(11) NOT NULL AUTO_INCREMENT,
  `nm_forma` varchar(200) NOT NULL,
  PRIMARY KEY (`cd_forma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tb_forma`
--

INSERT INTO `tb_forma` (`cd_forma`, `nm_forma`) VALUES
(1, 'Dinheiro'),
(2, 'Debito'),
(3, 'Boleto'),
(4, 'Cartao Bradesco'),
(5, 'Cartao Itau'),
(6, 'Cartao Santander');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_movimentacao`
--

CREATE TABLE IF NOT EXISTS `tb_movimentacao` (
  `cd_movimentacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_beneficiario` int(11) DEFAULT NULL,
  `id_forma` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `vl_movimentacao` float(10,2) DEFAULT '0.00',
  `ds_movimentacao` varchar(200) NOT NULL,
  `dt_movimentacao` date NOT NULL,
  PRIMARY KEY (`cd_movimentacao`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_tipo` (`id_tipo`),
  KEY `id_beneficiario` (`id_beneficiario`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_forma` (`id_forma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo`
--

CREATE TABLE IF NOT EXISTS `tb_tipo` (
  `cd_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nm_tipo` varchar(200) NOT NULL,
  PRIMARY KEY (`cd_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_tipo`
--

INSERT INTO `tb_tipo` (`cd_tipo`, `nm_tipo`) VALUES
(1, 'Entrada'),
(2, 'Saída');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `cd_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(200) NOT NULL,
  `ds_senha` varchar(200) NOT NULL,
  `ds_email` varchar(200) NOT NULL,
  `vl_rg` varchar(200) NOT NULL,
  `vl_cpf` varchar(200) NOT NULL,
  `dt_criacao` date NOT NULL,
  PRIMARY KEY (`cd_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`cd_usuario`, `nm_usuario`, `ds_senha`, `ds_email`, `vl_rg`, `vl_cpf`, `dt_criacao`) VALUES
(7, 'Igor Oliveira', '202cb962ac59075b964b07152d234b70', 'igor.etecita@gmail.com', '12.312.312-3', '123.123.123-12', '2019-03-09'),
(8, 'Juan Pablo', '202cb962ac59075b964b07152d234b70', 'juan@gmail.com', '44.444.444-4', '444.444.444-44', '2019-03-09');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_movimentacao`
--
ALTER TABLE `tb_movimentacao`
  ADD CONSTRAINT `tb_movimentacao_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`cd_categoria`),
  ADD CONSTRAINT `tb_movimentacao_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tb_tipo` (`cd_tipo`),
  ADD CONSTRAINT `tb_movimentacao_ibfk_3` FOREIGN KEY (`id_beneficiario`) REFERENCES `tb_beneficiario` (`cd_beneficiario`),
  ADD CONSTRAINT `tb_movimentacao_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`cd_usuario`),
  ADD CONSTRAINT `tb_movimentacao_ibfk_5` FOREIGN KEY (`id_forma`) REFERENCES `tb_forma` (`cd_forma`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
