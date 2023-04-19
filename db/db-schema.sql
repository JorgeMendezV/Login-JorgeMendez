/*Posible estructura de base 
de datos normalizada para login con tipos de usuarios*/
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

select * from Users;
#Contrasena prueba
#@Holamundo123

DELETE FROM Users;




