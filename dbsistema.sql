-- MySQL Script generated by MySQL Workbench
-- Tue Feb  9 19:28:15 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema dbsistema
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbsistema
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbsistema` DEFAULT CHARACTER SET utf8 ;
USE `dbsistema` ;

-- -----------------------------------------------------
-- Table `dbsistema`.`area_medica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsistema`.`area_medica` (
  `idarea_medica` INT NOT NULL AUTO_INCREMENT,
  `especialidad` VARCHAR(45) NULL,
  PRIMARY KEY (`idarea_medica`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsistema`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsistema`.`persona` (
  `idpersona` INT NOT NULL AUTO_INCREMENT,
  `ci` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `sexo` VARCHAR(45) NOT NULL,
  `fecha_nac` VARCHAR(45) NOT NULL,
  `edad` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` VARCHAR(12) NULL,
  `telefono2` VARCHAR(12) NULL,
  `nromatricula` VARCHAR(20) NULL,
  `idarea_medica` INT NOT NULL,
  `tipo_persona` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idpersona`),
  INDEX `fk_persona_area_medica_idx` (`idarea_medica` ASC),
  CONSTRAINT `fk_persona_area_medica`
    FOREIGN KEY (`idarea_medica`)
    REFERENCES `dbsistema`.`area_medica` (`idarea_medica`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsistema`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsistema`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `ci` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(100) NULL,
  `telefono` INT NULL,
  `cargo` VARCHAR(45) NOT NULL,
  `login` VARCHAR(45) NOT NULL,
  `clave` VARCHAR(64) NOT NULL,
  `condicion` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsistema`.`ficha`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsistema`.`ficha` (
  `idficha` INT NOT NULL AUTO_INCREMENT,
  `idpersona` INT NOT NULL,
  `idarea_medica` INT NOT NULL,
  `idusuario` INT NOT NULL,
  `nroficha` INT NOT NULL,
  `turno` VARCHAR(45) NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`idficha`),
  INDEX `fk_ficha_area_medica_idx` (`idarea_medica` ASC),
  INDEX `fk_ficha_usuario_idx` (`idusuario` ASC),
  INDEX `fk_ficha_persona_idx` (`idpersona` ASC),
  CONSTRAINT `fk_ficha_area_medica`
    FOREIGN KEY (`idarea_medica`)
    REFERENCES `dbsistema`.`area_medica` (`idarea_medica`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ficha_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `dbsistema`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ficha_persona`
    FOREIGN KEY (`idpersona`)
    REFERENCES `dbsistema`.`persona` (`idpersona`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsistema`.`centromedico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsistema`.`centromedico` (
  `idcentromedico` INT NOT NULL AUTO_INCREMENT,
  `idarea_medica` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`idcentromedico`),
  INDEX `fk_centro_medico_area_medica_idx` (`idarea_medica` ASC),
  CONSTRAINT `fk_centro_medico_area_medica`
    FOREIGN KEY (`idarea_medica`)
    REFERENCES `dbsistema`.`area_medica` (`idarea_medica`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsistema`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsistema`.`permiso` (
  `idpermiso` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idpermiso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsistema`.`usuario_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsistema`.`usuario_permiso` (
  `idusuario_permiso` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  `idpermiso` INT NOT NULL,
  PRIMARY KEY (`idusuario_permiso`),
  INDEX `fk_usuario_permiso_usuario_idx` (`idusuario` ASC),
  INDEX `fk_usuario_permido_permiso_idx` (`idpermiso` ASC),
  CONSTRAINT `fk_usuario_permiso_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `dbsistema`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_permido_permiso`
    FOREIGN KEY (`idpermiso`)
    REFERENCES `dbsistema`.`permiso` (`idpermiso`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;