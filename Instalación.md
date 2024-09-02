# Guía de Instalación y Configuración del Sistema de Gestión de Reservas de Turnos

## Introducción

Esta guía proporciona los pasos necesarios para instalar y configurar el Sistema de Reservas de Turnos.
De esta queda excluida la configuración de HTTPS para asegurar la comunicacion segura del servidor.

## Requisitos

Prerrequisitos: Tener una instalación en Ubuntu de Apache2, MariaDB y PHP (8.0 o superior)

Iniciar y habilitar los servicios:
```bash
sudo systemctl start apache2
sudo systemctl enable apache2
sudo systemctl start mariadb
sudo systemctl enable mariadb
```
### Configuración de la Base de Datos

Acceder a MariaDB desde la línea de comandos:
```bash
sudo mysql -u root
```
Ejecutar los scripts para la creación y llenado:
```bash
create database DBReservaTurnos; use DBReservaTurnos; source [rutaArchivoDDL];
source [rutaArchivoDML];
```
Salir de MariaDB:
```bash
EXIT;
```

### Configuración de Apache

En el directorio /etc/apache2/sites-available crear una copia de 000-default.conf del siguiente modo:
```bash
sudo cp 00-default.conf sr.conf
```
Modificar el archivo sr.conf para ajustarlo a la instalación, como puede ser el siguiente ejemplo:
```sr.conf
<VirtualHost *:80>
        # The ServerName directive sets the request scheme, hostname and port that
        # the server uses to identify itself. This is used when creating
        # redirection URLs. In the context of virtual hosts, the ServerName
        # specifies what hostname must appear in the request's Host: header to
        # match this virtual host. For the default virtual host (this file) this
        # value is not decisive as it is used as a last resort host regardless.
        # However, you must set it for any further virtual host explicitly.
        ServerName sistemaReservas.com
        ServerAlias www.sistemaReservas.com

        ServerAdmin webmaster@sistemaReservas.com
        DocumentRoot /var/www/sr.com/AppLAMP/PHP

        # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
        # error, crit, alert, emerg.
        # It is also possible to configure the loglevel for particular
        # modules, e.g.
        #LogLevel info ssl:warn

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        # For most configuration files from conf-available/, which are
        # enabled or disabled at a global level, it is possible to
        # include a line for only one particular virtual host. For example the
        # following line enables the CGI configuration for this host only
        # after it has been globally disabled with "a2disconf".
        #Include conf-available/serve-cgi-bin.conf

        <Directory /var/www/sr.com>
                DirectoryIndex index.php
        </Directory>
</VirtualHost>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
```
Habilitar el nuevo fichero de configuración y realizar un reload de apache2:
```bash
sudo a2ensite sr.conf
sudo service apache2 reload
```
Se puede verificar que el host virtual se haya establecido correctamente con:
```bash
sudo apache2ctl -S
```

Adicionalmente es necesario configurar el fichero de /etc/hosts y agregar la dirección iPv4 propia para que redireccione a sistemaReservas.com o `www.sistemaReservas.com` y la aplicación se pueda abrir en un navegador.

### Configuración de PHP

El programa cuenta con tres tipos de usuarios, el 'usuario' o cliente, el 'empleado' y el 'admin'.
Para ingresar con un usuario particular se debe modificar `index.php` y agregar tanto el username como passwd de la cuenta a la que se quiera acceder.


