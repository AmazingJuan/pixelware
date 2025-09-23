# Proyecto Laravel - Pixelware

## Descripción
Este es un proyecto web desarrollado en **Laravel 12** con base de datos **MySQL**.  
El sistema cuenta con dos secciones principales:
- **Sección Usuario Final (`/`)** → los usuarios pueden navegar por los productos/servicios, realizar acciones como compras o visualización detallada.
- **Sección Administrador (`/admin/*`)** → solo accesible para administradores mediante login. Aquí se pueden gestionar (CRUD) dos clases principales del proyecto.

---

## Instalación y Ejecución

**ANTES DE COMENZAR, TENER INSTALADO XAMPP E INICIALIZAR APACHE Y MYSQL**

### 1. Clonar repositorio
```bash
git clone https://github.com/AmazingJuan/pixelware.git
cd pixelware
```

### 2. Instalar dependencias
```bash
composer install
```

### 3. Configurar entorno

Copiar el archivo `.env.example` a `.env` y configurar:

```bash
cp .env.example .env
```

El archivo .env.example viene con unos valores "recomendados" para la base de datos, en caso de ser necesario, actualizar las variables de conexión:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

Aparte de esto, también colocar tu API Key de Open AI para la funcionalidad de IA integrada en el proyecto:

```bash
OPENAI_API_KEY=sk-xxxxxx
```

### 4. Generar clave de la aplicación

```bash
php artisan key:generate
```

### 5. Levantar el servidor local
```bash
php artisan serve
```

La aplicación quedará disponible en [http://127.0.0.1:8000](http://127.0.0.1:8000)