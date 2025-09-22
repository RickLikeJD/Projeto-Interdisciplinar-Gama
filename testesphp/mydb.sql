-- Compatibilidade com MariaDB
SET FOREIGN_KEY_CHECKS=0;

-- Criação do Schema
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8;
USE `mydb`;

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS `tbUser` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB;

-- Tabela de administradores
CREATE TABLE IF NOT EXISTS `tbAdmin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tbUser_id` INT NOT NULL,
  `nivel_acesso` ENUM('total', 'conteudo', 'moderador') NOT NULL,
  `data_criacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbUser_id_UNIQUE` (`tbUser_id`),
  CONSTRAINT `fk_tbAdmin_tbUser`
    FOREIGN KEY (`tbUser_id`)
    REFERENCES `tbUser` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela de trilhas
CREATE TABLE IF NOT EXISTS `tbTrilhas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT,
  `status` ENUM('ativo','inativo') DEFAULT 'ativo',
  `duracao` INT,
  `nivel` VARCHAR(45),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Tabela de avaliações
CREATE TABLE IF NOT EXISTS `tbAvaliacoes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome_trilha` VARCHAR(100) NOT NULL,
  `feedback_texto` VARCHAR(255) NOT NULL,
  `estrelas` INT NOT NULL CHECK (`estrelas` BETWEEN 1 AND 5),
  `data_avaliacao` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Tabela de produtos
CREATE TABLE IF NOT EXISTS `tbProdutos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `descricao` TEXT NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `tbVendedor_id` INT NOT NULL,
  `data_criacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_tbProdutos_tbVendedor`
    FOREIGN KEY (`tbVendedor_id`)
    REFERENCES `tbVendedor` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;]

-- Tabela vendedor
CREATE TABLE IF NOT EXISTS `tbVendedor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tbUser_id` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  CONSTRAINT `fk_tbVendedor_tbUser`
    FOREIGN KEY (`tbUser_id`)
    REFERENCES `tbUser` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;



SET FOREIGN_KEY_CHECKS=1;