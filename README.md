# Aplicación de Turnos

## Descripción

Aplicación web para la gestión de turnos, desarrollada con la pila LAMP (Linux, Apache, MySQL, PHP). Permite a los usuarios reservar, modificar y cancelar turnos de manera eficiente.

## Requisitos

- **Sistema Operativo**: Linux
- **Servidor Web**: Apache 2.4+
- **Base de Datos**: MySQL 5.7+
- **Lenguaje**: PHP 7.4+

## Instalación

1. Clona el repositorio:

    ```bash
    git clone https://github.com/usuario/turnos-app.git
    ```

2. Configura Apache:

    ```bash
    sudo cp turnos-app.conf /etc/apache2/sites-available/
    sudo a2ensite turnos-app.conf
    sudo systemctl restart apache2
    ```

3. Configura la base de datos:

    ```bash
    mysql -u root -p < database/schema.sql
    ```

4. Configura la aplicación:

    Renombra `config.sample.php` a `config.php` y edita los parámetros de la base de datos.

5. Accede en el navegador:

    ```
    http://localhost
    ```

## Autor

Desarrollada por Santiago Medina.
