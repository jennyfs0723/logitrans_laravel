# Logitrans - Sistema de Gestión de Envíos y Rutas

**Autor / Estudiante:** Jenny Alexandra Florez Sanchez 
**Institución / Curso:** CEFIT - Analisis y Programacion de Software

---

## Descripción 
**Logitrans** es una aplicación web integral desarrollada para optimizar el control logístico de una empresa de envíos. Permite gestionar de manera eficiente el registro de guías de envíos, la asignación de clientes, la flota de vehículos, el personal de conductores, la planificación de rutas de distribución y el seguimiento en tiempo real de las novedades de cada paquete, es un proyecto con el que he venido trabajando desde hace algun tiempo y ha sido muy interesante ver cada avance y como va aumentando en cada fase su nivel de complejidad en la ejecucion, pero tambien facilita la comprension de cada fase de la creacion del codigo y sus avances.

El sistema tiene autenticación segura, validaciones de integridad de datos en bases de datos relacionales, protección de rutas y una interfaz moderna y responsiva basada en **Bootstrap 5.3 (Tema Oscuro)**, replanteando la idea de la landing page hecha con anterioridad, en este caso solo puedes acceder a las funciones de los modulos crud si estas registrad@.

---

##Tablas Implementadas y Relaciones (Eloquent)
El sistema cuenta con un modelo relacional robusto conformado por las siguientes tablas principales:

1. **`users`**: Almacena los usuarios del sistema con acceso autenticado (vía Laravel Breeze).
2. **`clientes`**: Contiene la información de los clientes remitentes/destinatarios (*Relación 1 a Muchos con Envíos*).
3. **`vehiculos`**: Control de la flota de transporte disponible (*Relación 1 a Muchos con Rutas de Distribución*).
4. **`conductors`**: Registro de conductores activos (*Relación 1 a Muchos con Rutas y con Seguimiento de Envíos*).
5. **`ruta_distribucions`**: Planificación de rutas geográficas asignadas a un vehículo y conductor (*Relación 1 a Muchos con Envíos*).
6. **`envios`**: El núcleo del negocio. Registra cada guía con sus detalles de peso, dimensiones, costos y estados (*Relación con Clientes y Rutas*).
7. **`seguimiento_envios`**: Historial de novedades, ubicación y actividades asociadas a un envío (*Relación de dependencia con Envíos*).

---

## Requisitos del Sistema
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / MariaDB
- Visual Studio Code o cualquier otro editor de codigo fuente.

---

## Instrucciones para Correr Localmente

Sigue estos pasos en tu terminal para clonar y ejecutar el proyecto en tu entorno local:

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/TU_USUARIO/logitrans.git](https://github.com/TU_USUARIO/logitrans.git)
   cd logitrans
2.**Instalar dependencia de php**
  ```composer install  ```
3.**Configurar el entorno:**
    Copiar el archivo de configuración de ejemplo (.env.example) organiza tus vasiables y genera la llave de la aplicación:
    • APP_NAME: El nombre de tu aplicación, se puede dejar logitrans o cambiarla al gusto.
    • APP_ENV: El entorno de trabajo, generalmente es local.
    • APP_URL: La URL local del, por ejemplo: http://localhost:8000 o http://tuproyecto.test.
    despues de que todas las variables esten organizadas puedes generar la clave.
    ```bash
    php artisan key:generate
    ```

4. **Configurar la Base de Datos:**
   Abre el archivo `.env` y configura las credenciales de tu base de datos local:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=logitrans
   DB_USERNAME=root
   DB_PASSWORD=la_contraseña

5.**Ejecutar las migraciones y seeders:**
```php artisan migrate --seed```
esto lo hacemos con --seed porque exactamente lo mismo que migrate solo (crea las tablas), pero además ejecuta los seeders basicamente significa que llena automáticamente las tablas con datos de prueba iniciales que yo ya tenia para que se puedan manejar los crud de forma mas sencilla.

6.**Iniciamos el servidor:**
lo ideal es que si se usa desde herd se active mediante el link ej.tu_proyecto.test

adjunto pruebas de funcionamiento:
landing page:
<img width="1365" height="685" alt="image" src="https://github.com/user-attachments/assets/fdafe244-c09c-4597-b6d6-f52ab7ecd285" />
inicio sesion:
<img width="1365" height="597" alt="image" src="https://github.com/user-attachments/assets/1410f846-2dc3-4057-b15d-36da09e5dd39" />
despues de iniciar sesion ya muestra habilitado el crud:
<img width="1365" height="603" alt="image" src="https://github.com/user-attachments/assets/411a8c13-c870-48ea-8cab-8fecd5bda60b" />
panel de control donde se encuentra el crud:
<img width="1365" height="605" alt="image" src="https://github.com/user-attachments/assets/1eeef575-8e27-4679-89fa-a861ddbd6c1d" />
acceso a clientes:
<img width="1365" height="597" alt="image" src="https://github.com/user-attachments/assets/0635e3e0-3e64-4b4c-8743-7e6444745e66" />
acceso a envios:
<img width="1365" height="598" alt="image" src="https://github.com/user-attachments/assets/65982a25-17a6-44b5-9eff-a273454bdd3a" />
error al intentar eliminar un envio que ya esta en ruta:
<img width="1365" height="594" alt="image" src="https://github.com/user-attachments/assets/69048d75-2c14-4608-a2d6-e48aa4e4f008" />
gestion de vehiculos:
<img width="1365" height="597" alt="image" src="https://github.com/user-attachments/assets/fe4a5782-2b86-4672-aabd-6a295db275d9" />
conductores:
<img width="1365" height="596" alt="image" src="https://github.com/user-attachments/assets/2df48680-62dc-42f3-83f1-a44030d77e09" />
rutas:
<img width="1365" height="593" alt="image" src="https://github.com/user-attachments/assets/c3368c00-c6e0-4754-8ef9-5a62f5da21d6" />
seguimientos:
<img width="1365" height="596" alt="image" src="https://github.com/user-attachments/assets/077efde9-2e53-417c-84e8-89b0217dcf9b" />
Funcionalidad del testing:
<img width="1003" height="173" alt="image" src="https://github.com/user-attachments/assets/151af16b-c9e5-4791-ad2e-12f7e2b2c767" />














