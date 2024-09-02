# Documentación del Sistema de Gestión de Reservas de Turnos

## Introducción

El Sistema de Gestión de Reservas de Turnos es una aplicación web de práctica diseñada con las herramientas LAMP (Linux, Apache2, MariaDB y PHP8.0) para gestionar la solicitud y seguimiento de reservas en establecimientos de finalidad X. El sistema permite a los usuarios realizar una reserva, y a los empleados revisarlas, y proporciona un historial de modificaciones para usuarios y reservas accesible con un usuario admin.

## Funcionalidad del Sistema

### Acceso de Usuarios

- **Usuarios**: Pueden crear nuevas reservas y consultar el estado de sus reservas.
- **Empleados**: Pueden revisar todas las reservas realizadas en el sistema.
- **Admin**: Pueden revisar todas las modificaciones realizadas en el sistema.

### Gestión de Reservas

- **Solicitud de Reserva**: Los clientes pueden solicitar reservas indicando la fecha y el motivo. La reserva se almacena en la base de datos y se asocia al usuario y al establecimiento seleccionado.
- **Historial de Reservas**: Se mantiene un historial de las reservas para cada usuario y establecimiento.

### Historial de Modificaciones

- **Usuarios**: Se registra cualquier cambio en la información del usuario (como cambio de correo electrónico o contraseña).
- **Reservas**: Se registra cualquier cambio en la información de las reservas (como cambio de fecha o estado).

## Seguridad

- **Autenticación y Autorización**: Solo los usuarios autenticados con el tipo adecuado pueden acceder a ciertas funcionalidades. Los clientes pueden crear reservas, mientras que los empleados tienen permisos para revisar todas las reservas.
- **Sanitización de Datos**: Se utilizan funciones para sanitizar y validar datos ingresados por el usuario para prevenir ataques como XSS desde un apartado de backend.
