-- Insertar datos en la tabla pais
INSERT INTO pais (nombre) VALUES
('Argentina'),
('Brasil'),
('Chile');

-- Insertar datos en la tabla provincia
INSERT INTO provincia (nombre, idPais) VALUES
('Buenos Aires', 1),
('Santa Fe', 1),
('Rio de Janeiro', 2);

-- Insertar datos en la tabla localidad
INSERT INTO localidad (nombre, codigoPostal, idProvincia) VALUES
('La Plata', 1900, 1),
('Rosario', 2000, 2),
('Copacabana', 22000, 3);

-- Insertar datos en la tabla domicilio
INSERT INTO domicilio (numero, calle, departamento, piso, idLocalidad) VALUES
(123, 'Avenida Dr. Joaquín V. González', 1, 3, 1),
(456, 'La Rioja', 0, 0, 2),
(789, 'Rua das Flores', 2, 10, 3);

-- Insertar datos en la tabla usuario
INSERT INTO usuario (numero, username, contrasenia, apellido, nombre, tipo, tipoDoc, nroDoc, nroCuil, sexo, fechaNac, permiso, correoElectronico, anioRegistro, idDomicilio) VALUES
('001', 'user', 'user1234', 'Perez', 'Juan', 'cliente', 'DNI', '12345678', '20123456789', 'Masculino', '1985-05-10', 'crear_reserva', 'juan@example.com', 2023, 1),
('002', 'empleado', 'empleado1234', 'Gomez', 'Maria', 'empleado', 'DNI', '87654321', '20234567890', 'Femenino', '1990-08-25', 'revisar_reserva', 'maria@example.com', 2023, 2);

-- Insertar datos en la tabla establecimiento
INSERT INTO establecimiento (nombre, telefono, correoElectronico, idDomicilio) VALUES
('Establecimiento 1', '1234-5678', 'contacto@hospitalcentral.com', 1),
('Establecimiento 2', '8765-4321', 'info@clinicadelsol.com', 2);

-- Insertar datos en la tabla reserva
INSERT INTO reserva (nroReserva, fechaSolicitud, motivo, estado, idUsuario, idEstablecimiento) VALUES
('RES-001', '2023-09-01', 'Consulta General', 'Pendiente', 1, 1),
('RES-002', '2023-09-02', 'Chequeo Anual', 'Confirmada', 1, 2);

-- Insertar datos en la tabla historial_modificacion_usuario
INSERT INTO historial_modificacion_usuario (modificaciones, fechaModificacion, idUsuario) VALUES
('Cambio de correo electrónico', '2023-09-03', 1),
('Actualización de contraseña', '2023-09-04', 2);

-- Insertar datos en la tabla historial_modificacion_reserva
INSERT INTO historial_modificacion_reserva (modificaciones, fechaModificacion, idReserva) VALUES
('Cambio de fecha de reserva', '2023-09-05', 1),
('Actualización de estado a Confirmada', '2023-09-06', 2);
