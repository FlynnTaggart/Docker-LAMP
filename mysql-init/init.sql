CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
SET names 'utf8';

CREATE TABLE IF NOT EXISTS users (
    user varchar(64) primary key not null, 
    passwd varchar(255)
);

INSERT INTO users VALUES ('flynn', '{SHA}QL0AFWMIX8NRZTKeof9cXsvbvu8='); 

CREATE TABLE IF NOT EXISTS orders (
    id bigint primary key not null AUTO_INCREMENT,
    client_name varchar(64) not null,
    first_dish varchar(64),
    second_dish varchar(64),
    drink varchar(64),
    cost int not null,
    calories int
);

CREATE TABLE IF NOT EXISTS products (
    id bigint primary key not null AUTO_INCREMENT,
    product_name varchar(64) not null,
    amount float not null
);