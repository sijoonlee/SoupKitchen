-- by Nikita and Rob
drop database if  exists SoupKitchen;
create database SoupKitchen;
use SoupKitchen;
drop table if exists Accounts;
create table Accounts
(account_id int primary key auto_increment,
account_username varchar(30) not null,
account_password varchar(50) not null,
account_email varchar(50),
account_privilage smallint
);

drop table if exists Products;
create table Products
(product_id varchar(20) primary key,
 product_name varchar(30),
 product_quantity int,
 product_type varchar(30),
 product_image blob
);

insert into Accounts values
(0, 'admin', 'admin', 'admin@gmail.com', 10);

insert into Products values
('VP001', 'potato', 10, 'vegitable', null),
('VT001', 'tomato', 11, 'vegitable', null),
('MCH001', 'chicken legs', 12, 'meat', null),
('MCH002', 'chicken breasts', 12, 'meat', null),
('SP001', 'pepper', 'spice', 12, null),
('SS001', 'salt', 'spice', 12, null);