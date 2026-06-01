SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `administrador` (
  `idadministrador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(45) NOT NULL,
  PRIMARY KEY (`idadministrador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `experienciaprofiss` (
  `idExpProfiss` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `empresa` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idExpProfiss`),
  KEY `iduser_IDX` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `formacaoacademica` (
  `idformAcademica` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idformAcademica`),
  KEY `idusuario_IDX` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `outrasformacoes` (
  `idoutrasFormacoes` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idoutrasFormacoes`),
  KEY `idusuarioOF_IDX` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



ALTER TABLE `experienciaprofiss`
  ADD CONSTRAINT `iduser` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `formacaoacademica`
  ADD CONSTRAINT `idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `outrasformacoes`
  ADD CONSTRAINT `idusuarioOF` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


INSERT INTO `administrador` (`idadministrador`, `nome`, `cpf`, `senha`) VALUES
(null, 'Bia', '22222222222', 'bia123');


INSERT INTO `experienciaprofiss` (`idExpProfiss`, `idusuario`, `inicio`, `fim`, `descricao`, `empresa`) VALUES
(null, 1, '0000-00-00', '0000-00-00', ' ', ' ');

INSERT INTO `formacaoacademica` (`idformAcademica`, `idusuario`, `inicio`, `fim`, `descricao`) VALUES
(null, 1, '2023-11-09', '2023-12-29', 'Des Sistemas');


INSERT INTO `usuario` (`idusuario`, `nome`, `cpf`, `email`, `dataNascimento`, `senha`) VALUES
(null, 'uira', '123', 'uira@uira', '1970-01-01', '123');

