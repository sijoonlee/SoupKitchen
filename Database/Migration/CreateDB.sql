-- by Nikita and Rob
drop database if  exists SoupKitchen;
create database SoupKitchen;
use SoupKitchen;

-- create and drop accounts table 
drop table if exists Accounts; 
create table Accounts
(
    account_id int primary key auto_increment,
    account_username varchar (30) not null,
    account_password varchar (50) not null,
    account_email varchar(50),
    account_privilage smallint
);

-- drop and create products table
drop table if exists Products;
create table Products
(
    product_id varchar(20) primary key,
    product_name varchar(30),
    product_quantity int,
    product_type varchar(30),
    product_image image
);