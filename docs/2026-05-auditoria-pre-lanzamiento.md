# Auditoría pre-lanzamiento · Mayo 2026

**Periodo:** 27 de mayo – 1 de junio de 2026
**Sitio:** jcrdesweb.com
**Páginas en scope:** Home, Servicios, Proyectos, Contacto
**Referencia completa:** Notion → "Auditoría pre-lanzamiento · Mayo 2026"

---

## Contexto

Auditoría técnica de las cuatro páginas en scope antes de abrir el sitio a tráfico
real. Los fixes se aplicaron directamente en producción validando con herramientas
externas (Lighthouse, PageSpeed Insights, securityheaders.com), sin código que
requiriera CI/CD. Este documento registra el bloque de trabajo en el repositorio.
Los cambios de código se commitean por separado en sus ramas correspondientes.

---

## Fixes aplicados (F0–F8)

| Fix | Descripción | Resultado |
|-----|-------------|-----------|
| F0 | Desactivado el checkbox "Disuade a los motores de búsqueda" en Ajustes → Lectura | +39 pts SEO global |
| F1 | Sitemap roto reparado (instalación de Yoast SEO) | XML válido en producción |
| F2 | Cabeceras de seguridad añadidas vía `.htaccess` | Nota A en securityheaders.com |
| F3 | Meta descriptions y títulos configurados por página (Yoast) | SEO 100/100 en las 4 páginas |
| F4 | Imágenes hero optimizadas a WebP (Squoosh) | LCP −34% a −69% según página |
| F5 | Regresión de CLS tras F4 identificada y resuelta con filtro de dimensiones | CLS < 0.1 en las 4 páginas |
| F7 | Schema markup vía Yoast (Person + WebSite + BreadcrumbList) | Datos estructurados válidos |
| F8 | Stack de caché reorganizado: Varnish + Proxy Cache Purge | Sin plugins de caché de terceros |

---

## Cambios de infraestructura (vía soporte de Dinahosting)

| Cambio | Fecha | Notas |
|--------|-------|-------|
| PHP 7.4.33 → 8.5.6 (php-fpm) | 30 mayo | Principal cuello de botella de TTFB resuelto |
| Varnish activado | 31 mayo | No estuvo activo durante el baseline |
| OPcache activado | 31 mayo | — |
| Plan de hosting → Profesional | 31 mayo | memory_limit: 256 MB → 768 MB |

---

## Código personalizado añadido al sitio

Commiteado en ramas separadas. Ver cada rama para el diff a nivel de archivo.

- Filtro `jcr_set_image_dimensions` en el `functions.php` del child theme — fuerza
  `width` y `height` explícitos en todas las imágenes renderizadas para prevenir
  layout shift (`fix/cls-image-dimensions`).
- Constantes `WP_POST_REVISIONS = 10` y `WP_MEMORY_LIMIT = 512M` en `wp-config.php`
  (`docs/wp-config-constants`).
- Bloque de cabeceras de seguridad en `.htaccess` (`feature/security-headers`).

---

## Puntuaciones finales (1 junio 2026)

| Página | SEO | Seguridad | Perf desktop | Perf mobile | CLS |
|--------|-----|-----------|--------------|-------------|-----|
| Home   | 100 |      A    |     97–99    |     72–81   |< 0.1|
| Servicios|100|     A     |       99     |     ~78     | < 0.1|
| Proyectos | 100 | A      |     98       |      82     | < 0.1 |
| Contacto | 100 |   A     |       99     |     87      | < 0.1 |

---

## Hallazgos clave documentados para portfolio

- **CASO 04 — checkbox noindex:** el sitio estuvo bloqueando la indexación de Google
  durante 4 días tras el traslado a producción. Solo detectable con Lighthouse SEO
  sobre la URL real de producción.
- **CASO 05 — agotamiento de memoria:** más de 50 revisiones de Elementor por página
  provocaban errores fatales de PHP al guardar. La causa raíz era la acumulación de
  revisiones, no el plan de hosting. Fix: `WP_POST_REVISIONS = 10`.
- **Hallazgo Varnish:** la caché de servidor no estuvo activa durante todo el baseline.
  Confirmar siempre explícitamente que la caché está activa antes de empezar una
  auditoría de rendimiento.
- **Disciplina de medición:** el CLS de Home desktop pareció resuelto a mitad de
  auditoría y regresó tras F4. Se detectó porque cada bloque de fix se midió por
  separado.

---

## Deuda menor pendiente (no bloqueante)

- 4 imágenes residuales sin dimensiones explícitas (logos / iconos de widgets).
- Cabeceras Cache-Control en `.htaccess`.
- Evaluación de los Experiments de Elementor Pro (Improved CSS Loading, Improved Asset Loading).
- Limpieza de revisiones acumuladas con WP-Optimize (sesión dedicada).
- Search Console: alta de propiedad + verificación DNS + envío de sitemap.
- Actualización de Elementor Pro 3.29 → 4.x (sesión dedicada con backup en local).
