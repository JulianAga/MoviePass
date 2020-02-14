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
	id_funcion int auto_increment,
    id_sala int,
    id_pelicula int,
    dia date,
    horario time,
    constraint pk_id_cine_id_pelicula primary key (id_funcion),
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

create table QRs(
    id int auto_increment,
    id_entrada int, 
    qr_image varchar(100),
    constraint pk_QRs primary key(id),
    constraint fk_id_entrada foreign key (id_entrada) REFERENCES Entradas (id_entrada));
)


//PROCEDURESSSS

DELIMITER $$
create procedure sp_totalPorCine(in idCineI int,in fechaIN date,In fechaOUT date)
begin
	   SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
    select
	count(numero_entrada)*valor_entrada as totalVendido,
	fecha
	from
	compras inner join entradas on compras.id_compra=entradas.id_compra inner join funciones on entradas.id_funcion= funciones.id_funcion inner join salas on funciones.id_sala=salas.id_sala inner join cines on cines.id_cine=salas.id_cine
	group by cines.id_cine
	having cines.id_cine=idCineI and compras.fecha BETWEEN fechaIN AND fechaOUT; 
end$$


DELIMITER $$
create procedure sp_totalPorPelicula(in idPeliculaI int,in fechaIN date,IN fechaOUT date)
begin
	SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
    select
	monto.id_compra,
	sum(monto.cantidad*salas.valor_entrada) as totalVendido
	from
	funciones inner join salas on funciones.id_sala=salas.id_sala inner join (select
	entradas.id_funcion,
	count(*) as cantidad,
	compras.id_compra,
	compras.fecha
	from
	compras inner join entradas on compras.id_compra=entradas.id_compra
	group by compras.id_compra) as monto on funciones.id_funcion= monto.id_funcion
	where funciones.id_pelicula=idPeliculaI and monto.fecha BETWEEN fechaIN AND fechaOUT;
end$$

DELIMITER $$
create procedure sp_retornarUltimaEntrada(in id_funcionE int)
begin
select entradas.numero_entrada from Entradas where id_funcion = id_funcionE order by entradas.numero_entrada desc limit 1;
end$$