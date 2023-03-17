# Calculadora 🧮
_Esta calculadora es un proyecto para la empresa Izertis. Consta de un plugin WordPress y una API Symfony que ejecuta las operaciones._

# Requerimientos
- Sitio Wordpress operativo
- PHP => 8.2.0
- Composer => 2.5.4
- Symfony => 5.5.1

# Instalación 🚀
- Lo primero es clonar este repositorio en tu directorio escogido.
- Acceder mediante terminal al subdirectorio `/api_calculadora` y ejecutar el comando `composer install` (esto instalará todas las dependencias necesarias).
- Levantamos la API con `symfony server:start`
- Si todo ha ido bien, deberíamos obtener confirmación del servicio y la url ej: (http://localhost:8000).
- Vamos a nuestro sitio de Wordpress y accedemos al panel de administración.
- Accedemos a `Plugins>Añadir Nuevo> Subir Plugin`
- De la ventana de explorador escogemos el comprimido `calculadora.zip`.
- Una vez instalado el plugin, lo activamos.
- Nos dirigimos al nuevo menú de Calculadora y accedemos al submenú de Ajustes.
- Colocamos la URL de nuestra API previamente iniciada ej: (http://localhost:8000).
- Accedemos a la calculadora y si todo ha ido bien, deberíamos tener un aviso de confirmación en verde, el cuál indica que se ha establecido conexión con la API y podemos usar la calculadora.

# Imagenes 🖼️

## Plugin de Calculadora
![Plugin de Calculadora](https://github.com/angelessevilla/calculadora/blob/master/img/imagen1.png?raw=true)

## Ajustes de Calculadora
![Ajustes de Calculadora](https://github.com/angelessevilla/calculadora/blob/master/img/imagen3.png?raw=true)

## Calculadora admin menú 
![Calculadora admin menú ](https://github.com/angelessevilla/calculadora/blob/master/img/imagen2.png?raw=true)
