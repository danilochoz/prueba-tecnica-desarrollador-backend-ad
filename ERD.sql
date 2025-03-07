CREATE DATABASE `activos_digitales` CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci';

USE  `activos_digitales`;

SET FOREIGN_KEY_CHECKS=0
; 
/* Drop Tables */

DROP TABLE IF EXISTS `autores` CASCADE
;

DROP TABLE IF EXISTS `libros` CASCADE
;

DROP TABLE IF EXISTS `users` CASCADE
;

/* Create Tables */

CREATE TABLE `autores`
(
	`autor_id` INT NOT NULL AUTO_INCREMENT,
	`nombre_completo` VARCHAR(100) NOT NULL,
	`nacionalidad` VARCHAR(100) NULL,
	`fecha_nacimiento` DATE NULL,
	CONSTRAINT `PK_autores` PRIMARY KEY (`autor_id` ASC)
)

;

CREATE TABLE `libros`
(
	`libro_id` INT NOT NULL AUTO_INCREMENT,
	`titulo` VARCHAR(100) NOT NULL,
	`descripcion` TEXT NULL,
	`fecha_publicacion` DATE NULL,
	`autor_id` INT NULL,
	CONSTRAINT `PK_libros` PRIMARY KEY (`libro_id` ASC)
)

;

CREATE TABLE `users`
(
	`user_id` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(100) NOT NULL,
	`password` VARCHAR(256) NOT NULL,
	`remember_token` VARCHAR(100) NULL,
	CONSTRAINT `PK_usuarios` PRIMARY KEY (`user_id` ASC)
)

;

/* Create Primary Keys, Indexes, Uniques, Checks */

ALTER TABLE `libros` 
 ADD INDEX `IXFK_libros_autores` (`autor_id` ASC)
;

/* Create Foreign Key Constraints */

ALTER TABLE `libros` 
 ADD CONSTRAINT `FK_libros_autores`
	FOREIGN KEY (`autor_id`) REFERENCES `autores` (`autor_id`) ON DELETE Restrict ON UPDATE Restrict
;

SET FOREIGN_KEY_CHECKS=1
; 
