-- Compatibilidade com MariaDB: Ajustes iniciais desnecessários podem ser removidos, ou mantidos se usados em scripts maiores
SET FOREIGN_KEY_CHECKS=0;

-- Criação do Schema
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8;
USE `mydb`;

-- Tabela tbUser
CREATE TABLE IF NOT EXISTS `tbUser` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45),
  `email` VARCHAR(50),
  `password` VARCHAR(255),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE = InnoDB;

-- Tabela tbAdmin
CREATE TABLE IF NOT EXISTS `tbAdmin` (
  `id` INT NOT NULL,
  `nome` VARCHAR(45),
  `tbUser_id` INT NOT NULL,
  `nivel_acesso` ENUM('total', 'conteudo', 'moderador') NOT NULL,
  `data_criacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbUser_id_UNIQUE` (`tbUser_id`),
  KEY `fk_tbAdmin_tbUser_idx` (`tbUser_id`),
  CONSTRAINT `fk_tbAdmin_tbUser`
    FOREIGN KEY (`tbUser_id`)
    REFERENCES `tbUser` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- Tabela tbTrilhas
CREATE TABLE IF NOT EXISTS `tbTrilhas` (
  `id` INT NOT NULL,
  `nome` VARCHAR(45),
  `descricao` VARCHAR(45),
  `status` VARCHAR(45),
  `duracao` INT,
  `nivel` VARCHAR(45),
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Tabela tbAvaliacoes
CREATE TABLE IF NOT EXISTS `tbAvaliacoes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome_trilha` VARCHAR(45) NOT NULL,
  `feedback_texto` VARCHAR(100) NOT NULL,
  `estrelas` INT NOT NULL,
  `data_avaliacao` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

SET FOREIGN_KEY_CHECKS=1;
