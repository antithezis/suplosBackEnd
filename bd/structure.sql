CREATE SCHEMA `intelcost_bienes` ;

USE `intelcost_bienes`;

CREATE TABLE `bien` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `direccion` VARCHAR(45) NULL,
  `ciudad_id` INT NULL,
  `telefono` VARCHAR(45) NULL,
  `codigo_postal` VARCHAR(45) NULL,
  `bien_tipo_id` INT NULL,
  `precio` FLOAT NULL,
  `guardado` INT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `bien_tipo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `ciudad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ciudad` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

-- ALTER TABLE `bien` 
-- ADD INDEX `fk_bien_bien_tipo_idx` (`bien_tipo_id` ASC) VISIBLE;
-- ;
ALTER TABLE `bien` 
ADD CONSTRAINT `fk_bien_bien_tipo`
  FOREIGN KEY (`bien_tipo_id`)
  REFERENCES `bien_tipo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

-- ALTER TABLE `bien` 
-- ADD INDEX `fk_bien_ciudad_idx` (`ciudad_id` ASC) VISIBLE;
-- ;
ALTER TABLE `bien` 
ADD CONSTRAINT `fk_bien_ciudad`
  FOREIGN KEY (`ciudad_id`)
  REFERENCES `ciudad` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


INSERT INTO `ciudad` (`id`, `ciudad`) VALUES ('1', 'New York');
INSERT INTO `ciudad` (`id`, `ciudad`) VALUES ('2', 'Orlando');
INSERT INTO `ciudad` (`id`, `ciudad`) VALUES ('3', 'Los Angeles');
INSERT INTO `ciudad` (`id`, `ciudad`) VALUES ('4', 'Houston');
INSERT INTO `ciudad` (`id`, `ciudad`) VALUES ('5', 'Washington');
INSERT INTO `ciudad` (`id`, `ciudad`) VALUES ('6', 'Miami');

INSERT INTO `bien_tipo` (`id`, `tipo`) VALUES ('1', 'Casa');
INSERT INTO `bien_tipo` (`id`, `tipo`) VALUES ('2', 'Casa de Campo');
INSERT INTO `bien_tipo` (`id`, `tipo`) VALUES ('3', 'Apartamento');
