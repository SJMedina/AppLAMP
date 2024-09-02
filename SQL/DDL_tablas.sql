
-- Crear las tablas
CREATE TABLE IF NOT EXISTS pais(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) UNIQUE
);


CREATE TABLE IF NOT EXISTS provincia(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(30) UNIQUE,
	idPais INTEGER REFERENCES pais(id)
);


CREATE TABLE IF NOT EXISTS localidad(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(30) UNIQUE,
	codigoPostal INTEGER,
	idProvincia INTEGER REFERENCES provincia(id)
);


CREATE TABLE IF NOT EXISTS domicilio(
	id INT AUTO_INCREMENT PRIMARY KEY,
	numero INTEGER,
	calle VARCHAR(30),
	departamento INTEGER,
	piso INTEGER,
	idLocalidad INTEGER REFERENCES localidad(id),
	CONSTRAINT unico_domicilio UNIQUE(numero, calle, departamento, piso) 
);


CREATE TABLE IF NOT EXISTS usuario(
	id INT AUTO_INCREMENT PRIMARY KEY,
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
    idDomicilio INTEGER REFERENCES domicilio(id)
);


CREATE TABLE IF NOT EXISTS establecimiento(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) UNIQUE,
    telefono VARCHAR(30),
    correoElectronico VARCHAR(30),
    idDomicilio INTEGER REFERENCES domicilio(id)
);


CREATE TABLE IF NOT EXISTS reserva(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nroReserva VARCHAR(15) UNIQUE,
	fechaSolicitud DATE,
    fechaReserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    motivo TEXT NOT NULL,
	estado VARCHAR(30),
	idUsuario INTEGER REFERENCES usuario(id),
	idEstablecimiento INTEGER REFERENCES establecimiento(id)
);


--Historiales

CREATE TABLE IF NOT EXISTS historial_modificacion_usuario(
	id INT AUTO_INCREMENT PRIMARY KEY,
	modificaciones TEXT,
	fechaModificacion DATE,
	idUsuario INTEGER REFERENCES usuario(id)
	
);

CREATE TABLE IF NOT EXISTS historial_modificacion_reserva(
	id INT AUTO_INCREMENT PRIMARY KEY,
	modificaciones TEXT,
	fechaModificacion DATE,
	idReserva INTEGER REFERENCES reserva(id)
);




