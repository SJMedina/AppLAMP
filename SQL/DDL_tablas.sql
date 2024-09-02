-- Crear la base de datos
CREATE DATABASE DBReservaTurnos;

-- Usar la base de datos
USE DBReservaTurnos;

-- Crear las tablas
CREATE TABLE pais(
    id SERIAL CONSTRAINT pk_id_pais PRIMARY KEY,
    nombre VARCHAR(30) UNIQUE
);


CREATE TABLE provincia(
	id SERIAL CONSTRAINT pk_id_provincia PRIMARY KEY,
	nombre VARCHAR(30) UNIQUE,
	idPais INTEGER CONSTRAINT fk_id_pais REFERENCES pais(id)
);


CREATE TABLE localidad(
	id SERIAL CONSTRAINT pk_id_localidad PRIMARY KEY,
	nombre VARCHAR(30) UNIQUE,
	codigoPostal INTEGER,
	tasaDeRobo FLOAT,
	idProvincia INTEGER CONSTRAINT fk_id_provincia REFERENCES provincia(id)
);


CREATE TABLE domicilio(
	id SERIAL CONSTRAINT pk_id_domicilio PRIMARY KEY,
	numero INTEGER,
	calle VARCHAR(30),
	departamento INTEGER,
	piso INTEGER,
	idLocalidad INTEGER CONSTRAINT fk_id_localidad REFERENCES localidad(id),
	CONSTRAINT unico_domicilio UNIQUE(numero, calle, departamento, piso) 
);


CREATE TABLE usuario(
	id SERIAL CONSTRAINT pk_id_usuario PRIMARY KEY,
	numero VARCHAR(12) UNIQUE NOT NULL,
    username VARCHAR(30) UNIQUE NOT NULL,
    contrasenia VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
	nombre VARCHAR(30) NOT NULL,
	tipo VARCHAR(15) NOT NULL,
	tipoDoc VARCHAR(20),
	nroDoc VARCHAR(10),
	nroCuil VARCHAR(15),
	sexo VARCHAR(10),
    fechaNac DATE,
    permiso VARCHAR(30) NOT NULL,
    correoElectronico VARCHAR(30),
    anioRegistro INTEGER,
    idDomicilio INTEGER CONSTRAINT fk_id_domicilio REFERENCES domicilio(id)
);


CREATE TABLE establecimiento(
    id SERIAL CONSTRAINT pk_id_establecimiento PRIMARY KEY,
    nombre VARCHAR(30) UNIQUE,
    telefono VARCHAR(30),
    correoElectronico VARCHAR(30),
    idDomicilio INTEGER CONSTRAINT fk_id_domicilio REFERENCES domicilio(id)
);


CREATE TABLE reserva(
	id SERIAL CONSTRAINT pk_id_poliza PRIMARY KEY,
	nroReserva VARCHAR(15) UNIQUE,
	fechaSolicitud DATE,
    fechaReserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    motivo TEXT NOT NULL,
	estado VARCHAR(30),
	idUsuario INTEGER CONSTRAINT fk_id_usuario REFERENCES usuario(id),
	idEstablecimiento INTEGER CONSTRAINT fk_id_establecimiento REFERENCES establecimiento(id),
);


--HISTORIALES

CREATE TABLE historial_ajuste_cant_hijos(
	id SERIAL CONSTRAINT pk_id_historial_ajuste_cant_hijos PRIMARY KEY,
	valor INTEGER UNIQUE,
	fechaModificacion DATE,
	cantHijos INTEGER,
	idUsuario INTEGER CONSTRAINT fk_id_usuario REFERENCES usuario(id),
	idAjusteCantHijos INTEGER CONSTRAINT fk_id_ajuste_cant_hijos REFERENCES ajuste_cant_hijos(id)
);




