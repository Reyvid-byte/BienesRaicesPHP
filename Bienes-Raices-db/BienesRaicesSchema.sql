-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bienes_raices_crud
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bienes_raices_crud
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bienes_raices_crud` DEFAULT CHARACTER SET utf8 ;
USE `bienes_raices_crud` ;

-- -----------------------------------------------------
-- Table `bienes_raices_crud`.`vendedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bienes_raices_crud`.`vendedores` (
  `id_vendedores` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `telefono` VARCHAR(10) NULL,
  PRIMARY KEY (`id_vendedores`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bienes_raices_crud`.`propiedades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bienes_raices_crud`.`propiedades` (
  `id_propiedades` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL,
  `precio` DECIMAL(10,2) NULL,
  `imagen` VARCHAR(200) NULL,
  `descripcion` LONGTEXT NULL,
  `habitaciones` INT(1) NULL,
  `wc` INT(1) NULL,
  `estacionamientos` INT(1) NULL,
  `creado` DATE NULL,
  `vendedores_id_vendedores` INT(11) NOT NULL,
  PRIMARY KEY (`id_propiedades`),
  INDEX `fk_propiedades_vendedores_idx` (`vendedores_id_vendedores` ASC),
  CONSTRAINT `fk_propiedades_vendedores`
    FOREIGN KEY (`vendedores_id_vendedores`)
    REFERENCES `bienes_raices_crud`.`vendedores` (`id_vendedores`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `bienes_raices_crud`.`vendedores`
-- -----------------------------------------------------
START TRANSACTION;
USE `bienes_raices_crud`;
INSERT INTO `bienes_raices_crud`.`vendedores` (`id_vendedores`, `nombre`, `apellido`, `telefono`) VALUES (1, 'Juan', 'De la Torre', '2289076565');
INSERT INTO `bienes_raices_crud`.`vendedores` (`id_vendedores`, `nombre`, `apellido`, `telefono`) VALUES (2, 'Karen', 'Perez', '1275638902');

COMMIT;

