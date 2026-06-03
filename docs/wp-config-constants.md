# Constantes de wp-config.php

**Aplicado:** 31 de mayo de 2026 (Auditoría pre-lanzamiento · Mayo 2026)
**Archivo real:** `wp-config.php` (en `.gitignore` por contener credenciales de BBDD)
**Referencia:** Notion → "Código personalizado del sitio · jcrdesweb"

---

## Por qué este documento existe

`wp-config.php` no se versiona en el repositorio porque contiene credenciales de
base de datos y claves de seguridad. Para mantener contexto en Git de las
constantes añadidas durante la auditoría, se registran aquí con su justificación.

---

## Constantes permanentes añadidas

```php
define( 'WP_POST_REVISIONS', 10 );
define( 'WP_MEMORY_LIMIT', '512M' );
```

### `WP_POST_REVISIONS = 10`

Limita a 10 el número de revisiones almacenadas por entrada. Durante la auditoría
(CASO 05) se detectó que Elementor acumulaba más de 50 revisiones por página, lo
que agotaba la memoria de PHP y provocaba errores fatales al guardar. Limitar las
revisiones evita la acumulación descontrolada en la base de datos.

### `WP_MEMORY_LIMIT = '512M'`

Eleva el límite de memoria disponible para WordPress. Acompaña a la migración del
plan de hosting a Profesional (memory_limit del servidor 256 MB → 512 MB). Da margen
a Elementor y al resto de procesos sin tocar la configuración del servidor.

---

## Bloque de depuración (diagnóstico temporal)

Durante el diagnóstico del error 500 (CASO 05) se activó temporalmente el modo
debug. Tras resolver la causa raíz, `WP_DEBUG` se devolvió a `false`. Estado actual
en producción:

```php
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );
```

**Nota:** con `WP_DEBUG` en `false`, WordPress no escribe en `debug.log`, así que
`WP_DEBUG_LOG = true` queda redundante. Puede limpiarse en una sesión
futura de mantenimiento junto con el borrado de `wp-content/debug.log`.

---

## Verificación

- Guardar páginas en Elementor sin errores fatales de memoria.
- `WP_DEBUG` confirmado en `false` en producción (sin exposición de errores).
