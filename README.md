# Logitrans - Sistema de Gestión de Envíos y Rutas

**Autor / Estudiante:** Jenny Alexandra Florez Sanchez  
**Institución / Curso:** CEFIT - Análisis y Programación de Software  

---

## 📋 Descripción General

**Logitrans** es una aplicación web integral desarrollada para optimizar el control logístico de una empresa de envíos. Permite gestionar de manera eficiente el registro de guías de envíos, la asignación de clientes, la flota de vehículos, el personal de conductores, la planificación de rutas de distribución y el seguimiento en tiempo real de las novedades de cada paquete. 

Es un proyecto con el que he venido trabajando desde hace algún tiempo y ha sido muy interesante ver cada avance y cómo va aumentando en cada fase su nivel de complejidad en la ejecución, pero también facilita la comprensión de cada fase de la creación del código y sus avances.

El sistema cuenta con autenticación segura, validaciones de integridad de datos en bases de datos relacionales, protección de rutas y una interfaz moderna y responsiva basada en Bootstrap 5.3 (Tema Oscuro), replanteando la idea de la landing page hecha con anterioridad. En este caso, solo puedes acceder a las funciones de los módulos CRUD si estás registrad@.

---

## 🛠️ Tecnologías y Servicios Utilizados

* **Backend / Framework:** PHP >= 8.2 / Laravel 13.39.0
* **Frontend:** Bootstrap 5.3 (Tema Oscuro), Blade Templates
* **Base de Datos:** MySQL / MariaDB (con migraciones y seeders de Eloquent)
* **Control de Versiones:** Git y GitHub
* **Despliegue y Hosting:** Render (con soporte de Docker / PHP nativo)
* **Servicios Externos Integrados:**
  * **Resend:** Envío de correos electrónicos transaccionales y de verificación de registro de nuevos usuarios.
  * **Backblaze B2 (S3 Compatible):** Almacenamiento seguro y remoto para los respaldos de la aplicación.
  * **Sentry:** Monitoreo de errores y excepciones en tiempo real en producción.
  * **Better Stack:** Control de disponibilidad, salud (*health checks*) y observabilidad del sistema.

---

## 🗄️ Estructura de la Base de Datos y Relaciones principales (Eloquent)

El sistema cuenta con un modelo relacional robusto conformado por las siguientes tablas principales:

1. **`users`**: Almacena los usuarios del sistema con acceso autenticado (vía Laravel Breeze).
2. **`clientes`**: Contiene la información de los clientes remitentes/destinatarios (Relación 1 a Muchos con Envíos).
3. **`vehiculos`**: Control de la flota de transporte disponible (Relación 1 a Muchos con Rutas de Distribución).
4. **`conductors`**: Registro de conductores activos (Relación 1 a Muchos con Rutas y con Seguimiento de Envíos).
5. **`ruta_distribucions`**: Planificación de rutas geográficas asignadas a un vehículo y conductor (Relación 1 a Muchos con Envíos).
6. **`envios`**: El núcleo del negocio. Registra cada guía con sus detalles de peso, dimensiones, costos y estados (Relación con Clientes y Rutas).
7. **`seguimiento_envios`**: Historial de novedades, ubicación y actividades asociadas a un envío (Relación de dependencia con Envíos).

---

## ⚙️ Integraciones con Servicios Externos

* **Resend (`resend-laravel`):** Configurado como el driver principal de correo electrónico (`MAIL_MAILER=resend`) para garantizar una entrega rápida y segura de notificaciones de registro y códigos/enlaces de verificación de cuenta mediante el dominio oficial verificado.
* **Backblaze B2 (S3 Compatible):** Integrado a través del sistema de almacenamiento de Laravel mediante el disco S3. Permite almacenar de forma automatizada y remota los archivos de respaldo (*backups*) de la base de datos y la aplicación.
* **Sentry:** Integrado en el ciclo de excepciones de Laravel (`bootstrap/app.php`) para capturar automáticamente cualquier error crítico o fallo de ejecución en el servidor de producción y reportarlo en tiempo real.
* **Better Stack:** Vinculado al endpoint de salud de la aplicación (`/up`) para supervisar el tiempo de actividad (*uptime*) y alertar de manera inmediata ante cualquier caída del servicio.

---

## 🔒 Privacidad y Eliminación de Cuentas

La aplicación cumple con estrictas normativas de privacidad y control de datos de usuario:
* **Autonomía del usuario:** Cada usuario registrado cuenta en su panel de perfil con la opción directa para solicitar y ejecutar la eliminación definitiva de su cuenta.
* **Limpieza en cascada:** Al eliminar la cuenta, el sistema remueve de forma segura los registros asociados en la base de datos para garantizar la confidencialidad y el derecho al olvido, liberando recursos y protegiendo la información personal.

---

## 🚀 Instrucciones para Correr Localmente

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

6. **🔐 Variables de Entorno Necesarias**
A continuación se muestra la estructura de las variables requeridas en el archivo .env o en los paneles de despliegue, omitiendo valores netamente personales:

Fragmento de código
APP_NAME=Logitrans
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=(https://logitrans.space)

MAIL_MAILER=resend
RESEND_API_KEY=re_...
MAIL_FROM_ADDRESS=soporte@logitrans.space
MAIL_FROM_NAME="Logitrans"

AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_DEFAULT_REGION=us-west-004
AWS_BUCKET=...
AWS_ENDPOINT=[https://s3.us-west-004.backblazeb2.com](https://s3.us-west-004.backblazeb2.com)
AWS_USE_PATH_STYLE_ENDPOINT=true

SENTRY_LARAVEL_DSN=https://...

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
**BETTERSTACK:**
<img width="1365" height="650" alt="image" src="https://github.com/user-attachments/assets/37957926-5358-4931-96db-a43bf1ee7a46" />
<img width="1365" height="686" alt="image" src="https://github.com/user-attachments/assets/7379c4bc-b4ec-4e24-b479-748745892fbb" />
**BACKBLAZE:**
<img width="1365" height="667" alt="image" src="https://github.com/user-attachments/assets/b4716310-d355-4271-b82d-f1df7d021078" />
<img width="1365" height="675" alt="image" src="https://github.com/user-attachments/assets/7d5fa15f-0bee-44b6-bebd-fed681ede325" />
<img width="1364" height="676" alt="image" src="https://github.com/user-attachments/assets/f08026d5-6b16-4805-98e4-7280480b6268" />
**SENTRY:**
<img width="1365" height="675" alt="image" src="https://github.com/user-attachments/assets/aaa8e96f-fb65-445f-ad8b-cba0a9e9306c" />
<img width="1365" height="681" alt="image" src="https://github.com/user-attachments/assets/c9e6f512-fc35-4394-ae05-e79efafcce5e" />
<img width="1365" height="665" alt="image" src="https://github.com/user-attachments/assets/7cae700c-3bc4-4271-bf00-367e805be751" />
**RESEND:**
<img width="1365" height="686" alt="image" src="https://github.com/user-attachments/assets/994a0ec1-05e0-4be1-bbb0-1d44f37b2405" />
<img width="1365" height="678" alt="image" src="https://github.com/user-attachments/assets/52f96f43-7f22-4a3e-9da1-5e36efa060d2" />
<img width="1365" height="683" alt="image" src="https://github.com/user-attachments/assets/c21cc99c-dbe3-432b-9c81-57e940473981" />
<img width="1365" height="671" alt="image" src="https://github.com/user-attachments/assets/b4e3f326-6f8d-449f-87c2-82da21a265f5" />

**AVISO DE PRIVACIDAD**
<img width="1365" height="678" alt="image" src="https://github.com/user-attachments/assets/1f917455-a49a-4a4a-a66a-433ffaac08df" />
<img width="1365" height="681" alt="image" src="https://github.com/user-attachments/assets/87ea22ee-a890-45c0-a0f0-93ed7439ab4f" />
**ELIMINAR CUENTA O CAMBIAR CONTRASEÑA**
<img width="1365" height="678" alt="image" src="https://github.com/user-attachments/assets/bb09776f-6152-4ea3-8bb4-b263d9c9c36f" />
<img width="1365" height="677" alt="image" src="https://github.com/user-attachments/assets/0ae058fe-9163-4f33-ad94-28cea4c43a0e" />
<img width="1364" height="675" alt="image" src="https://github.com/user-attachments/assets/92e33c5f-4b40-4ad6-a149-3ecffd975781" />
**VERIFICACION DE CUENTA PARA EVITAR QUE SE REGISTRE CUALQUIER USUARIO:**
<img width="1365" height="674" alt="image" src="https://github.com/user-attachments/assets/eb8112d5-dd72-4a4d-821f-89768ae1921f" />
<img width="1365" height="679" alt="image" src="https://github.com/user-attachments/assets/5d77149d-b3bd-4d95-a60f-8f0481e1ec3f" />



























