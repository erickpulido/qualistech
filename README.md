<p align="center" style="padding: 20px;"><img class="hfe-site-logo-img elementor-animation-" src="https://www.qualistech.mx/wp-content/uploads/2023/12/cropped-logo.png" alt="default-logo"></p>

# Evaluación Técnica Validador de CURP

### Descripción del problema

Construir un validador de CURP

### Formato de entrada

```php
<?php
    enum Sexo {
        Masculino = 1,
        Femenino = 2,
    }

    interface DatosEntrada {
        curp: string; // CURP a evaluar
        nombres: string; // Nombres de pila de la persona
        apelldoPaterno: string; // Apellido paterno de la persona
        apellidoMaterno: string; // Apellido materno de la persona
        fechaNacimiento: string; // Fecha de nacimiento de la persona, dato en formato ISO string "1992-07-01T06:00:00.000Z"
        sexo: Sexo; // Género de la persona
        esMexicano: boolean; // Indica si la persona es mexicana o no
    }
?>
```

### Formato de salida

Arreglo de strings, en donde

- Si hay algún error en el CURP respecto al resto de la información:
    - Retorna un arreglo indicando cada uno de los problemas que se encontraron respecto a la información suministrada.
- Si no hay ningún problema:
    - Retorna un arreglo vacío.


### Consideraciones

- El CURP está conformado por 18 caracteres.
- No se considerarán nombres o apellidos compuestos, por ejemplo “De la Cruz”, “De Jesús”.
- No se respetará la definido para los casos de los nombres que comienzan con “María” o “José”.
- Para el caso de CURP de extranjeros, el estado de nacimiento, en el CURP suministrado, debe ser “NE”.



## Requisitos de instalación

- Ubuntu 22
- PHP 8.2
- Apache 2.4
- MySQL 8
- Usuario con privilegios de superusuario

## Instalación

### Virtual Host

Crear archivo de configuración

```console
sudo nano /etc/apache2/sites-available/qualistech.conf
```

En el editor pegar lo siguiente y guardar los cambios:

~~~
<VirtualHost *:80>
    ServerName qualistech.local
    DocumentRoot /var/www/qualistech/public
    <Directory /var/www/qualistech/public>
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
~~~

Habilitar sitio

```console
sudo a2ensite qualistech
```

Recargar apache

```
sudo systemctl restart apache2
```
### Host

Abrir archivo hosts

```
sudo nano /etc/hosts
```

Añadir la siguiente línea y guardar los cambios

```
127.0.0.1 qualistech.local
```
### Instalación del proyecto

Cambiar de directorio

```
cd /var/www
```

Clonado de repositorio

```
sudo git clone https://github.com/erickpulido/qualistech.git
```



Permisos de carpetas
```
sudo chmod -R 777 qualistech
```

Instalación de dependencias

```
cd qualistech
sudo mkdir vendor
composer install
```

Copiar .env.example

```
cp /var/www/qualistech/.env.example /var/www/qualistech/.env
```

En el archivo .env recién creado actualizar o añadir las siguientes constantes: 

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qualistech
DB_USERNAME=<TU_USUARIO>
DB_PASSWORD=<TU_PASSWORD>
```
Generación de application key
```
php artisan key:generate
```

Ejecutar las migraciones para crear la base de datos, las tablas y precargar los datos del sistema.

```
php artisan migrate
```

Ingresar al sistema con la URL:

```
http://qualistech.local/api/documentation
```