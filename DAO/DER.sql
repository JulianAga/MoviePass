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
    capacidad int,
    direccion varchar(30),
    nombre varchar(30),
    valor_entrada int,
    habilitado boolean,
    constraint pk_id_cine primary key (id_cine)
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
	id_cine int,
    id_pelicula int,
    dia date,
    horario time,
    constraint pk_id_cine_id_pelicula primary key (id_cine,id_pelicula,dia),
    constraint fk_id_cine foreign key (id_cine) references Cines (id_cine) ,
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

