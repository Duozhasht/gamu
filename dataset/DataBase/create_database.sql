-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema gamu
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gamu
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gamu` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `gamu` ;

-- -----------------------------------------------------
-- Table `gamu`.`Instrumento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Instrumento` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Instrumento` (
  `id_instrumento` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nome` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id_instrumento`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Curso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Curso` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Curso` (
  `id_curso` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `designacao` VARCHAR(45) NOT NULL COMMENT '',
  `duracao` INT NOT NULL COMMENT '',
  `id_instrumento` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_curso`)  COMMENT '',
  INDEX `fk_curso_instrumento_idx` (`id_instrumento` ASC)  COMMENT '',
  CONSTRAINT `fk_curso_instrumento`
    FOREIGN KEY (`id_instrumento`)
    REFERENCES `gamu`.`Instrumento` (`id_instrumento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Professor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Professor` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Professor` (
  `id_professor` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nome` VARCHAR(45) NOT NULL COMMENT '',
  `data_de_nascimento` DATE NOT NULL COMMENT '',
  `habilitacoes` VARCHAR(45) NOT NULL COMMENT '',
  `id_curso` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_professor`)  COMMENT '',
  INDEX `fk_professor_curso_idx` (`id_curso` ASC)  COMMENT '',
  CONSTRAINT `fk_professor_curso`
    FOREIGN KEY (`id_curso`)
    REFERENCES `gamu`.`Curso` (`id_curso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Aluno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Aluno` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Aluno` (
  `id_aluno` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nome` VARCHAR(45) NOT NULL COMMENT '',
  `data_de_nascimento` DATE NOT NULL COMMENT '',
  `id_curso` INT NOT NULL COMMENT '',
  `ano_curso` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_aluno`)  COMMENT '',
  INDEX `fk_aluno_curso_idx` (`id_curso` ASC)  COMMENT '',
  CONSTRAINT `fk_aluno_curso`
    FOREIGN KEY (`id_curso`)
    REFERENCES `gamu`.`Curso` (`id_curso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Periodo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Periodo` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Periodo` (
  `id_periodo` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nome` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id_periodo`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Compositor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Compositor` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Compositor` (
  `id_compositor` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nome` VARCHAR(45) NOT NULL COMMENT '',
  `bio` VARCHAR(5000) NOT NULL COMMENT '',
  `data_de_nascimento` DATETIME NOT NULL COMMENT '',
  `data_de_obito` DATETIME NOT NULL COMMENT '',
  `id_periodo` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_compositor`)  COMMENT '',
  INDEX `fk_compositor_periodo_idx` (`id_periodo` ASC)  COMMENT '',
  CONSTRAINT `fk_compositor_periodo`
    FOREIGN KEY (`id_periodo`)
    REFERENCES `gamu`.`Periodo` (`id_periodo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Obra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Obra` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Obra` (
  `id_obra` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nome` VARCHAR(45) NOT NULL COMMENT '',
  `descricao` VARCHAR(45) NOT NULL COMMENT '',
  `ano` VARCHAR(45) NOT NULL COMMENT '',
  `periodo` VARCHAR(45) NOT NULL COMMENT '',
  `id_compositor` INT NOT NULL COMMENT '',
  `duracao` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_obra`)  COMMENT '',
  INDEX `fk_obra_compositor_idx` (`id_compositor` ASC)  COMMENT '',
  CONSTRAINT `fk_obra_compositor`
    FOREIGN KEY (`id_compositor`)
    REFERENCES `gamu`.`Compositor` (`id_compositor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Audicao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Audicao` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Audicao` (
  `id_audicao` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `titulo` VARCHAR(45) NOT NULL COMMENT '',
  `subtitulo` VARCHAR(45) NOT NULL COMMENT '',
  `tema` VARCHAR(45) NOT NULL COMMENT '',
  `data` DATETIME NOT NULL COMMENT '',
  `local` VARCHAR(45) NOT NULL COMMENT '',
  `organizador` VARCHAR(45) NOT NULL COMMENT '',
  `duracao` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id_audicao`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Actuacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Actuacao` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Actuacao` (
  `id_actuacao` INT NOT NULL COMMENT '',
  `id_audicao` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_actuacao`)  COMMENT '',
  INDEX `fk_actuacao_audicao_idx` (`id_audicao` ASC)  COMMENT '',
  CONSTRAINT `fk_actuacao_audicao`
    FOREIGN KEY (`id_audicao`)
    REFERENCES `gamu`.`Audicao` (`id_audicao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Actuacao_Obra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Actuacao_Obra` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Actuacao_Obra` (
  `id_actuacao` INT NOT NULL COMMENT '',
  `id_obra` INT NOT NULL COMMENT '',
  INDEX `fk_actuacao_obra_obra_idx` (`id_obra` ASC)  COMMENT '',
  INDEX `fk_actuacao_obra_actuacao_idx` (`id_actuacao` ASC)  COMMENT '',
  PRIMARY KEY (`id_actuacao`, `id_obra`)  COMMENT '',
  CONSTRAINT `fk_actuacao_obra_obra`
    FOREIGN KEY (`id_obra`)
    REFERENCES `gamu`.`Obra` (`id_obra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actuacao_obra_actuacao`
    FOREIGN KEY (`id_actuacao`)
    REFERENCES `gamu`.`Actuacao` (`id_actuacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Participante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Participante` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Participante` (
  `id_actuacao` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `id_professor` INT NULL COMMENT '',
  `id_aluno` INT NULL COMMENT '',
  INDEX `fk_participante_actuacao_idx` (`id_actuacao` ASC)  COMMENT '',
  INDEX `fk_participante_professor_idx` (`id_professor` ASC)  COMMENT '',
  INDEX `fk_participante_aluno_idx` (`id_aluno` ASC)  COMMENT '',
  CONSTRAINT `fk_participante_actuacao`
    FOREIGN KEY (`id_actuacao`)
    REFERENCES `gamu`.`Actuacao` (`id_actuacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_participante_aluno`
    FOREIGN KEY (`id_aluno`)
    REFERENCES `gamu`.`Aluno` (`id_aluno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_participante_professor`
    FOREIGN KEY (`id_professor`)
    REFERENCES `gamu`.`Professor` (`id_professor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
