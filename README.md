
API REST construida con Laravel 
Multi-tenancy y authjwt


## Tecnologías

- **Laravel 11** + PHP 8.5
- **JWT** — Autenticación con tokens
- **stancl/tenancy** 


## Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/2024030365-cloud/app.git
cd app

# 2. Instalar dependencias
composer install

# 3. Configurar entorno
cp .env.example .env
# Abrir .env y cambiar: CACHE_STORE=file

# 4. Generar llaves y migrar base de datos
php artisan migrate
php artisan jwt:secret
php artisan tenants:migrate

# 5. Iniciar servidor
php artisan serve
```

---

## Estructura destacada

| Elemento | Descripción |
|---|---|
| `app/Http/Controllers/Api/V1/` | Controladores versionados de la API |
| `routes/api.php` | Definición de endpoints |
| `app/Http/Resources/` | Filtro de datos en las respuestas |

---

## Endpoints

Las rutas usan el subdominio de la empresa:

```
http://{empresa}.localhost:8000/api/v1/
```

**Ejemplo:** `http://pr1.localhost:8000/api/v1/users`

---

## Estructura
- **Versionado (V1):** Permite agregar nuevas versiones sin romper la API actual.
- **JWT:** Autenticación.
- **Resources:** Filtran la respuesta.
- **Multi-tenancy:** Cada empresa tiene su propia base de datos.
- **JWT:** Autenticación sin sesiones — el usuario recibe un token al iniciar sesión y lo usa en cada petición.
- **Resources:** Filtran la respuesta para no exponer datos sensibles (como contraseñas).
- **Multi-tenancy:** Cada empresa tiene su propia base de datos; sus datos son invisibles para las demás.
