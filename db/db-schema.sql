/*Estructura de base de datos 
normalizados para login con tipos de usuarios*/
CREATE DATABASE php_login_db;

USE php_login_db;

CREATE TABLE tipo_usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_tipo VARCHAR(50) NOT NULL
);

CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dui VARCHAR(10) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    tipo_usuario_id INT NOT NULL,
    FOREIGN KEY (tipo_usuario_id) REFERENCES tipo_usuario(id)
);

INSERT INTO tipo_usuario (nombre_tipo) VALUES ('Administrador');
select * from tipo_usuario;

select * from usuarios;
select nombre, dui, contrasena, TU.nombre_tipo FROM usuarios u 
	INNER JOIN tipo_usuario tu ON u.tipo_usuario_id = tu.id;
    
#Contrasena prueba
#@Holamundo123

DELETE FROM usuarios;




