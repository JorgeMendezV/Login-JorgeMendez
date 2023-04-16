create database php_login_database;
use php_login_database;

CREATE TABLE Users (
	id int primary key auto_increment,
    usuario varchar(10),
    contrasena varchar(200)
);

select * from Users;
#Contrasena prueba
#@Holamundo123

DELETE FROM Users;




