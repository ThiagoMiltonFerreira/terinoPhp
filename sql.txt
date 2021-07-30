create database thiago_milton_Ferreira;
use thiago_milton_Ferreira;
create table clientes(
	id_cliente int not null auto_increment,
	nome_cliente varchar(255),
    email_cliente varchar(255) unique,
    telefone_cliente varchar(255) unique,
    senha_cliente varchar(255) unique,
    data_nasc_cliente date,
    primary key(id_cliente)
);