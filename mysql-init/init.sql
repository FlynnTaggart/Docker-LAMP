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
    cost int not null
);

INSERT INTO orders (client_name, first_dish, second_dish, drink, cost) VALUES ('Вася', 'Карбонара', 'Борщ', 'Яблочный сок', '1000'); 
INSERT INTO orders (client_name, drink, cost) VALUES ('Коля', 'Китайский чай', '200');
INSERT INTO orders (client_name, first_dish, cost) VALUES ('Петя', 'Пицца', '500');