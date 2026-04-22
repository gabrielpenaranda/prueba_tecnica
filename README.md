# Prueba Técnica Laravel - Edición de Empresa y Generación de Imágenes

Este proyecto es una aplicación Laravel para la gestión de los datos de la empresa. El usuario autenticado puede editar los datos de su empresa, generar imágenes de la empresa y del usuario, además de generar un pdf con los datos de la empresa.

## Requisitos

- PHP >= 8.1
- Composer
- Extensión GD de PHP (necesaria para Intervention Image)
- MySQL o MariaDB

## Instalación

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/gabrielpenaranda/prueba_tecnica.git
   cd prueba_tecnica
   ```

2. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Configuración del entorno:**
   Copia el archivo de ejemplo y configura tus credenciales de base de datos:
   ```bash
   cp .env.example .env
   ```
   Edita el archivo `.env` y ajusta las siguientes variables:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_tu_base_de_datos
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_password
   ```

4. **Generar la clave de la aplicación:**
   ```bash
   php artisan key:generate
   ```

5. **Configurar el almacenamiento:**
   Crea el enlace simbólico para que las imágenes sean accesibles desde la web:
   ```bash
   php artisan storage:link
   ```

## Base de Datos

Ejecuta las migraciones y los seeders para tener datos de prueba (empresas):
```bash
php artisan migrate --seed
```

## Ejecución


1. **Compilar assets (Vite):**
   ```bash
   npm install
   npm run dev
   ```

2. **Iniciar el servidor de desarrollo:**
   ```bash
   php artisan serve
   ```


## Características Principales

- **Edición de Empresa:** El usuario autenticado puede editar los datos de su empresa.
- **Generación de Imágenes:** Al registrarse o iniciar sesión, el sistema genera automáticamente una tarjeta visual del usuario y de su empresa en `public/storage/images`.
- **Exportación a PDF:** Permite generar un documento PDF con las tarjetas de datos utilizando la librería `laravel-dompdf`.

---
Desarrollado como parte de una prueba técnica.
