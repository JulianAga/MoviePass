create database MoviePass;
use MoviePass;

create table Roles
(
	id_rol int auto_increment,
    nombre varchar(30),
    descripcion varchar(30),
    constraint pk_id_rol primary key (id_rol)
);

create table Clientes
(
	id_cliente int auto_increment,
    nombre varchar(30),
    apellido varchar(30),
    dni bigint,
    telefono bigint,
    direccion varchar(50),
    ciudad varchar(30),
    numero_tarjeta bigint,
    constraint pk_id_cliente primary key (id_cliente),
    constraint unq_dni unique (dni),
    constraint unq_telefono unique (telefono),
    constraint unq_numero_tarjeta unique (numero_tarjeta)
);

create table Cuentas
(
	id_cuenta int auto_increment,
    email varchar(30),
    pass varchar(30),
    id_rol int,
    id_cliente int,
    constraint pk_id_cuenta primary key (id_cuenta),
    constraint fk_id_rol foreign key (id_rol) references Roles (id_rol) on delete no action,
    constraint fk_id_cliente foreign key (id_cliente) references Clientes (id_cliente) on delete cascade,
    constraint unq_email unique (email)
);


insert into Roles (nombre,descripcion) values ("ADM","Tareas administrativas"),("User","cliente");
insert into Clientes (nombre,apellido,dni,telefono,direccion,ciudad,numero_tarjeta) values ("Nicolas","Vezzali",31101987,2235443945," Mdq" ,"Santiago  1660",null);
insert into Cuentas (email,pass,id_rol,id_cliente) values ("nico@hotmail.com","1234",1,1);
