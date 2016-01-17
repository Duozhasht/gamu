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
  `data_de_nascimento` DATE NOT NULL COMMENT '',
  `data_de_obito` DATE NOT NULL COMMENT '',
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
  `duracao` TIME NOT NULL COMMENT '',
  `id_periodo` INT NOT NULL COMMENT '',
  `id_compositor` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_obra`)  COMMENT '',
  INDEX `fk_obra_compositor_idx` (`id_compositor` ASC)  COMMENT '',
  INDEX `fk_obra_periodo_idx` (`id_periodo` ASC)  COMMENT '',
  CONSTRAINT `fk_obra_compositor`
    FOREIGN KEY (`id_compositor`)
    REFERENCES `gamu`.`Compositor` (`id_compositor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_obra_periodo`
    FOREIGN KEY (`id_periodo`)
    REFERENCES `gamu`.`Periodo` (`id_periodo`)
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
  `duracao` TIME NOT NULL COMMENT '',
  PRIMARY KEY (`id_audicao`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gamu`.`Actuacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gamu`.`Actuacao` ;

CREATE TABLE IF NOT EXISTS `gamu`.`Actuacao` (
  `id_actuacao` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `id_audicao` INT NOT NULL COMMENT '',
  `designacao` VARCHAR(100) NOT NULL COMMENT '',
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
  `id_actuacao` INT NOT NULL COMMENT '',
  `id_obra` INT NOT NULL COMMENT '',
  `id_professor` INT NULL COMMENT '',
  `id_aluno` INT NULL COMMENT '',
  INDEX `fk_participante_professor_idx` (`id_professor` ASC)  COMMENT '',
  INDEX `fk_participante_aluno_idx` (`id_aluno` ASC)  COMMENT '',
  INDEX `fk_participante_actuacao_idx` (`id_actuacao` ASC, `id_obra` ASC)  COMMENT '',
  CONSTRAINT `fk_participante_actuacao`
    FOREIGN KEY (`id_actuacao` , `id_obra`)
    REFERENCES `gamu`.`Actuacao_Obra` (`id_actuacao` , `id_obra`)
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


-- -----------------------------------------------------
-- View `gamu`.`aluno_model`
-- -----------------------------------------------------

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `aluno_model`
AS SELECT
   `aluno`.`id_aluno` AS `id_aluno`,
   `aluno`.`nome` AS `nome`,
   `aluno`.`data_de_nascimento` AS `data_de_nascimento`,
   `aluno`.`id_curso` AS `id_curso`,
   `aluno`.`ano_curso` AS `ano_curso`,
   `curso`.`designacao` AS `curso`,
   `instrumento`.`nome` AS `instrumento`,
   `instrumento`.`id_instrumento` AS `id_instrumento`
FROM ((`aluno` join `curso` on((`aluno`.`id_curso` = `curso`.`id_curso`))) join `instrumento` on((`curso`.`id_instrumento` = `instrumento`.`id_instrumento`)));


-- -----------------------------------------------------
-- View `gamu`.`compositor_model`
-- -----------------------------------------------------

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `compositor_model`
AS SELECT
   `compositor`.`id_compositor` AS `id_compositor`,
   `compositor`.`nome` AS `nome`,
   `compositor`.`bio` AS `bio`,
   `compositor`.`data_de_nascimento` AS `data_de_nascimento`,
   `compositor`.`data_de_obito` AS `data_de_obito`,
   `compositor`.`id_periodo` AS `id_periodo`,
   `periodo`.`nome` AS `periodo`
FROM (`compositor` left join `periodo` on((`compositor`.`id_periodo` = `periodo`.`id_periodo`)));

-- -----------------------------------------------------
-- View `gamu`.`curso`
-- -----------------------------------------------------

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `curso_model`
AS SELECT
   `curso`.`id_curso` AS `id_curso`,
   `curso`.`designacao` AS `designacao`,
   `curso`.`duracao` AS `duracao`,
   `curso`.`id_instrumento` AS `id_instrumento`,
   `professor`.`nome` AS `professor`
FROM (`curso` left join `professor` on((`curso`.`id_curso` = `professor`.`id_curso`)));

-- -----------------------------------------------------
-- View `gamu`.`obra_model`
-- -----------------------------------------------------

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `obra_model`
AS SELECT
   `obra`.`id_obra` AS `id_obra`,
   `obra`.`nome` AS `nome`,
   `obra`.`descricao` AS `descricao`,
   `obra`.`ano` AS `ano`,
   `obra`.`duracao` AS `duracao`,
   `obra`.`id_periodo` AS `id_periodo`,
   `obra`.`id_compositor` AS `id_compositor`,
   `periodo`.`nome` AS `periodo`,
   `compositor`.`nome` AS `compositor`
FROM ((`obra` join `periodo` on((`obra`.`id_periodo` = `periodo`.`id_periodo`))) join `compositor` on((`obra`.`id_compositor` = `compositor`.`id_compositor`)));

-- -----------------------------------------------------
-- View `gamu`.`professor_model`
-- -----------------------------------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `professor_model`
AS SELECT
   `professor`.`id_professor` AS `id_professor`,
   `professor`.`nome` AS `nome`,
   `professor`.`data_de_nascimento` AS `data_de_nascimento`,
   `professor`.`habilitacoes` AS `habilitacoes`,
   `professor`.`id_curso` AS `id_curso`,
   `curso`.`designacao` AS `curso`,
   `instrumento`.`nome` AS `instrumento`,
   `instrumento`.`id_instrumento` AS `id_instrumento`
FROM ((`professor` join `curso` on((`professor`.`id_curso` = `curso`.`id_curso`))) join `instrumento` on((`curso`.`id_instrumento` = `instrumento`.`id_instrumento`)));


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO gamu.Periodo VALUES (1, 'Medieval');
INSERT INTO gamu.Periodo VALUES (2, 'Renascimento');
INSERT INTO gamu.Periodo VALUES (3, 'Barroco');
INSERT INTO gamu.Periodo VALUES (4, 'Clássico');
INSERT INTO gamu.Periodo VALUES (5, 'Romântico');
INSERT INTO gamu.Periodo VALUES (6, 'Século XX');
INSERT INTO gamu.Periodo VALUES (7, 'Contemporâneo');