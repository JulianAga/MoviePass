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

insert into Clientes (nombre,apellido,dni,telefono,direccion,ciudad,numero_tarjeta) values ("Cliente","Anonimo",21456743,22354987," Mdq" ,"Lopez 666",null);
insert into Cuentas (email,pass,id_rol,id_cliente) values ("cliente@hgmail.com","1234",2,2);

/*
*/
create table Cines
(
	id_cine int auto_increment,
    direccion varchar(30),
    nombre varchar(30),
    habilitado boolean,
    constraint pk_id_cine primary key (id_cine)
);
/*
*/
create table Salas
(
    id_sala int auto_increment,
    nombre varchar(30),
    capacidad smallint,
    valor_entrada smallint,
    id_cine int,

    constraint pk_id_sala primary key (id_sala),
    constraint fk_sala_id_cine foreign key (id_cine) references Cines (id_cine)
);

insert into Cines (capacidad,direccion, nombre,valor_entrada,habilitado) values (100,'palma 1132','galleguitos',300,true);
/*
*/
create table Peliculas
(
    id_api int,
    duracion int,
    imagen varchar(300),
    lenguaje varchar(30),
    titulo varchar(50),
    descripcion varchar(1500),
    habilitada boolean default true,
    constraint pk_id_pelicula primary key (id_api)
);


/*
*/
create table Funciones
(
	id_sala int,
    id_pelicula int,
    dia date,
    horario time,
    constraint pk_id_cine_id_pelicula primary key (id_sala,id_pelicula,dia),
    constraint fk_id_sala foreign key (id_sala) references Salas (id_sala) ,
    constraint fk_id_peliculas foreign key (id_pelicula) references Peliculas (id_api)
);
insert into Funciones (id_cine,id_pelicula,dia,horario) values (10,301528,"2014-05-09",'23:00');
/*
*/
create table Generos
(
	id_genero int,
    nombre_genero varchar(30),
    constraint pk_id_genero primary key (id_genero)
);

insert into Generos (id_genero,nombre_genero) values (1,'accion');
/*
*/
create table PeliculasXgenero
(
	id_pelicula int,
    id_genero int,
    constraint pk_id_pelicula_id_genero primary key (id_pelicula,id_genero),
    constraint fk_id_pelicula foreign key (id_pelicula) references Peliculas (id_api),
    constraint fk_id_genero foreign key (id_genero) references Generos (id_genero)
);

insert into PeliculasXgenero (id_pelicula,id_genero) values (1,1);

create table CuentasCredito
(
	id_cuenta_credito int auto_increment,
    empresa varchar(30),
    numero_tarjeta bigint,
    constraint pk_id_cuenta_credito primary key (id_cuenta_credito),
    constraint unq_numero_tarjeta unique (numero_tarjeta)
);
/*
    COMPRAS
*/
create table Compras
(
	id_compra int auto_increment,
    id_cuenta int,
    fecha date,
    descuento int,
    subtotal int,
    total int,
    constraint pk_id_compra primary key (id_compra),
    constraint fk_id_cuenta foreign key (id_cuenta) references Cuentas (id_cuenta)
);

create table Entradas
(
	id_entrada int auto_increment,
    id_funcion int,
    id_compra int,
    numero_entrada int,
    qr varchar(50),
    constraint pk_id_entrada primary key (id_entrada),
    constraint fk_id_funcion foreign key (id_funcion) references Funciones (id_funcion),
    constraint fk_id_compra foreign key (id_compra) references Compras (id_compra)
);

create table PagoTC
(
	id_pagoTC int auto_increment,
    id_compra int,
    id_cuenta_credito int,
    cod_aut bigint,
    fecha date,
    total int,
    constraint pk_id_pagoTC primary key (id_pagoTC),
    constraint fk_id_compra_pago foreign key (id_compra) references Compras (id_compra),
    constraint fk_id_cuenta_credito foreign key (id_cuenta_credito) references CuentasCredito (id_cuenta_credito)
);