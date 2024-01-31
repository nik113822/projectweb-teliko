-- Sample SQL Query
--create database emergency_items kai create table item exoyn ginei sto mysql shell--

CREATE DATABASE emergency_items;
use emergency_items;

create table item(
  id int NOT NULL,
  name varchar(128) NOT NULL,
  category int NOT NULL,
  detail_name varchar(255) NOT NULL,
  detail_value varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

create table users(
    onoma VARCHAR(45) NOT NULL,
    eponimo VARCHAR(45) NOT NULL,
    tilefono VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    onoma_xristi VARCHAR(45) NOT NULL,
    kodikos VARCHAR(45) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (onoma_xristi)  
);
 
 SELECT * from item;










