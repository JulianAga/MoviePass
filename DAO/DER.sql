create database MoviePass;
use MoviePass;

create table Roles
(
	id_roles int auto_increment,
    nombre varchar(30),
    descripcion varchar(30),
    constraint pk_id_roles primary key (id_roles)
);

create table Clientes
(
	id_cliente int auto_increment,
    nombre varchar(30),
    apellito varchar(30),
    dni bigint,
    constraint pk_id_cliente primary key (id_cliente),
    constraint unq_dni unique (dni)
);

create table Cuentas
(
	id_cuenta int auto_increment,
    email varchar(30),
    pass varchar(30),
    id_rol int,
    id_cliente int,
    constraint pk_id_cuenta primary key (id_cuenta),
    constraint fk_id_rol foreign key (id_rol) references Rol (id_rol),
    constraint unq_email unique (email)
);
