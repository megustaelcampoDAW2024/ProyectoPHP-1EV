# Proyecto PHP 1a Evaluación
## Aplicación Web de Gestión de Tareas para una Constructora

## Este proyecto es una aplicación web desarrollada con el framework Laravel, diseñada para gestionar las tareas de una constructora. La aplicación permite a los usuarios autenticados realizar diversas operaciones relacionadas con la gestión de tareas, tales como:

 - **Inicio de Sesión**: Los usuarios pueden iniciar sesión en la aplicación utilizando sus credenciales.
 - **Listado de Tareas**: Visualización de todas las tareas registradas, con la opción de filtrar tareas incompletas.
 - **Creación de Tareas**: Los usuarios pueden crear nuevas tareas proporcionando detalles como el nombre del cliente, descripción de la tarea, fecha de realización, etc.
 - **Modificación de Tareas**: Los usuarios pueden modificar los detalles de las tareas existentes.
 - **Eliminación de Tareas**: Los usuarios con permisos de administrador pueden eliminar tareas.
 - **Detalles de Tareas**: Visualización de los detalles completos de una tarea específica.
La aplicación utiliza sesiones para manejar la autenticación de usuarios y asegurar que solo los usuarios autenticados puedan acceder a ciertas funcionalidades.

## Estructura del Proyecto:

 - Controladores: Manejan la lógica de la aplicación y las interacciones del usuario.
 - Modelos: Representan los datos y las operaciones de la base de datos.
 - Vistas: Plantillas Blade que generan la interfaz de usuario.
 - Rutas: Definen los endpoints de la aplicación y los controladores asociados.
 - Sesiones: Utilizadas para manejar la autenticación y mantener el estado del usuario.

## Tecnologías Utilizadas:

 - Laravel: Framework PHP para el desarrollo de aplicaciones web.
 - Blade: Motor de plantillas de Laravel.
 - PHP: Lenguaje de programación del lado del servidor.
 - HTML/CSS/JavaScript: Tecnologías para la interfaz de usuario.
 - MySQL: Base de datos para almacenar la información de las tareas y usuarios.
