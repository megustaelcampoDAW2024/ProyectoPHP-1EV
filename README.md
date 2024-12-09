# Proyecto PHP 1a Evaluación: Aplicación Web de Gestión de Tareas para una Constructora
## Funcionalidades

- **Gestión de Tareas**
  - **Crear nuevas tareas**: Permite a los usuarios crear una nueva tarea proporcionando detalles como el nombre del cliente, descripción de la tarea, fecha de creación, etc. Esta funcionalidad se encuentra en el método ``Tareas.crearTarea``
  - **Modificar tareas existentes**: Permite a los usuarios editar los detalles de una tarea existente. Esta funcionalidad se encuentra en el método ``Tareas.modificarTarea``
  - **Listar todas las tareas**: Muestra una lista de todas las tareas registradas en el sistema, con opciones de filtrado y paginación. Esta funcionalidad se encuentra en el método ``Tareas.listarTareas``
  - **Eliminar tareas**: Permite a los usuarios eliminar una tarea específica del sistema. Esta funcionalidad se encuentra en el método ``Tareas.eliminarTarea``
  - **Adjuntar archivos y fotos a las tareas**: Permite a los usuarios adjuntar archivos y fotos relevantes a una tarea. Esta funcionalidad se maneja en el modelo ``Task``
  - **Filtrar tareas por estado y otros criterios**: Permite a los usuarios filtrar la lista de tareas según diferentes criterios como estado, fecha, etc. Esta funcionalidad se encuentra en el método ``Tareas.listarTareas``

- **Gestión de Usuarios**
  - **Crear nuevos usuarios**: Permite a los administradores crear nuevos usuarios proporcionando detalles como nombre, correo electrónico, contraseña, y rol. Esta funcionalidad se encuentra en el método ``Tareas.crearUsuario``
  - **Editar usuarios existentes**: Permite a los administradores editar los detalles de un usuario existente. Esta funcionalidad se encuentra en el método ``Tareas.editarUsuario``
  - **Asignar roles a los usuarios (Administrador u Operario)**: Permite a los administradores asignar roles específicos a los usuarios, determinando sus permisos dentro del sistema. Esta funcionalidad se encuentra en el método ``Tareas.asignarRol``

 ## Tecnologías Utilizadas

 - Laravel: Framework PHP para el desarrollo de aplicaciones web.
 - Blade: Motor de plantillas de Laravel.
 - PHP: Lenguaje de programación del lado del servidor.
 - HTML/Bootstrap: Tecnologías para la interfaz de usuario.
 - MySQL: Base de datos para almacenar la información de las tareas y usuarios.

## Estructura del Proyecto

```plaintext
ProyectoPHP-1EV/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Tareas.php
│   │   │   └── Controller.php
│   ├── Models/
│   │   ├── dbModel.php
│   │   ├── GestorErrores.php
│   │   ├── SessionUsuario.php
│   │   ├── SingletonDB.php
│   │   ├── Task.php
│   │   └── Utiles.php
├── resources/
│   ├── views/
│   │   ├── layout/
│   │   │   └── plantilla.blade.php
│   │   ├── administrarUsuarios.blade.php
│   │   ├── crearUsuario.blade.php
│   │   ├── detallesTarea.blade.php
│   │   ├── eliminarTarea.blade.php
│   │   ├── formTarea.blade.php
│   │   ├── listarTareas.blade.php
│   │   ├── logIn.blade.php
│   │   ├── welcome.blade.php
│   │   ├── inicio.blade.php
│   │   └── editarUsuario.blade.php
├── routes/
│   ├── helpers.php
│   └── web.php
├── storage/
│   ├── app
│   │   ├── public
│   │   │   └── ....
```
## Descripción de Directorios y Ficheros

### app/Http/Controllers/

- **Tareas.php**: Controlador principal para la gestión de tareas.
- **Controller.php**: Controlador base.

### app/Models/

- **dbModel.php**: Modelo para la interacción con la base de datos.
- **GestorErrores.php**: Clase para la gestión de errores.
- **SingletonDB.php**: Clase Singleton enlace BDD.
- **SessionUsuario.php**: Clase para la gestión de sesiones de usuario.
- **Task.php**: Modelo de tarea.
- **Utiles.php**: Clase con funciones utilitarias.

### resources/views/

- **layout/plantilla.blade.php**: Plantilla base para las vistas.
- **administrarUsuarios.blade.php**: Vista para administrar usuarios.
- **crearUsuario.blade.php**: Vista para crear un nuevo usuario.
- **detallesTarea.blade.php**: Vista para mostrar los detalles de una tarea.
- **eliminarTarea.blade.php**: Vista para confirmar la eliminación de una tarea.
- **formTarea.blade.php**: Vista para el formulario de creación/modificación de tareas.
- **listarTareas.blade.php**: Vista para listar las tareas.
- **logIn.blade.php**: Vista para el inicio de sesión.
- **welcome.blade.php**: Vista de bienvenida.
- **inicio.blade.php**: Vista de la página de inicio.
- **editarUsuario.blade.php**: Vista para editar un usuario.

### routes/

- **helpers.php**: Funciones activas en todoel código
- **web.php**: Gestor de rutas con controlador  

### storage/public/

- **Archivos adjuntos de tareas**
