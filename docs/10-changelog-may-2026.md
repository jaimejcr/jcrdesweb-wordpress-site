# Changelog — Mayo 2026

Registro de hitos del proyecto entre el 21 y el 28 de mayo de 2026.
La mayor parte del trabajo de este período vive en base de datos,
DNS o servicios externos, sin impacto directo en el repositorio.
Este changelog deja constancia para mantener trazabilidad.

---

## 21 mayo — Bloque A · Rediseño de popups de servicios (M5.1)

Decisión de diseño cerrada. Los 6 popups originales sobre fondo
crema #EDE0C4 se sustituyen por versión oscura #0C1A0D con borde
superior 2px por color de servicio. Contenido redactado para los
6 popups. Implementación en Elementor pendiente.

Impacto en repo: ninguno (Elementor → BBDD).

---

## 21 mayo — Bloque B · Página Proyectos y 4 cards (M5.2)

Cards construidas en Elementor para ProspectMap, jcrdesweb.com,
Caléndula Floristería y Camaleónico Digital. Banner adaptado con
CTA directo a Contacto. Documentación de case studies creada en
Notion con plantilla consistente. Páginas individuales con
contenido redactado, build pendiente.

Impacto en repo: ninguno (BBDD + Notion).

---

## 24 mayo — Bloque D · Traslado local → producción

jcrdesweb.com publicado en Dinahosting Hosting App WordPress Basic.
Footer global funcionando con Elementor Pro Theme Builder. Bug del
footer doble en local aceptado como deuda conocida; en producción
con licencia Pro activa no se reproduce.

Impacto en repo: child theme actualizado (commits d9910fe y afa7471
del 28 mayo, ver Bloque F).

---

## 26 mayo — Bloque C · M5.3 Contacto cerrado

Página construida y publicada en producción. Formulario WPForms Lite
con campos nombre, email, mensaje y RGPD. SMTP profesional configurado
con Brevo. DKIM, SPF y DMARC configurados en DNS de Dinahosting.
Email operativo hola@jcrdesweb.com. Honeypot activo, sin reCAPTCHA.
Entrega real verificada.

Impacto en repo: ninguno (configuración en BBDD + DNS + Brevo).

---

## 27 mayo — Bloque E · Auditoría pre-lanzamiento

### E.1 — Baseline medido
PageSpeed, Lighthouse, Securityheaders, robots.txt y sitemap.xml
sobre 4 páginas en mobile y desktop. Documentado en la página del proyecto en jcrdesweb.com.

### E.2 — Limpieza de plugins (19 → 9 activos)
Desinstalados: Contact Form 7, Autoptimize, WordPress Optimizado,
Polylang, Events Manager, Newsletter, Feed Them Social, MonsterInsights,
Twentig, Importador de WordPress.
Pendiente desinstalar: Really Simple Security.
Activos finales: Elementor, Elementor Pro, WPForms Lite, Yoast SEO,
WPvivid Backup, Proxy Cache Purge, Limit Login Attempts Reloaded,
Antispam Bee, WP Mail SMTP.

### E.3 — Yoast SEO configurado
Site representation Person con usuario admin real. Bug histórico
detectado: dos usuarios admin en BBDD (cuenta real y jaimedev.local).
Se eligió la cuenta real para Schema. Deuda documentada: evaluar
eliminar usuario jaimedev.local en hardening futuro.

Configuración avanzada aplicada: archivos autor, fecha, formato y
adjuntos deshabilitados. Migas de pan activadas. Schema por defecto
WebPage + Article. llms.txt activo, generator oculto, bots IA
bloqueados (GPTBot, CCBot, Google-Extended).

F1 sitemap resuelto: /sitemap_index.xml responde XML válido con
4 sub-sitemaps. F7 schema resuelto vía Yoast.

### E.4 — Decisiones técnicas cerradas
F2 (cabeceras de seguridad) se hará vía .htaccess directo, no con
Really Simple Security. Backup obligatorio con WPvivid antes de tocar
.htaccess o functions.php a partir de ahora.

Impacto en repo: ninguno en esta sesión. F2 tendrá impacto futuro.

---

## 28 mayo — Bloque F · Sincronización del child theme al repo

Detectado que footer.php y functions.php del child theme existían en
LocalWP pero nunca habían sido commiteados al repositorio. Copiados
al directorio site/wp-content/themes/jcrdesweb-child/ y commiteados.

Commits:
- d9910fe — feat: add child theme footer override with local dev workaround
- afa7471 — merge: add child theme footer files into develop

Impacto en repo: footer.php creado, functions.php limpiado y documentado.

---

## Fixes pendientes para próximas sesiones

- F2: cabeceras de seguridad vía .htaccess + ocultar versión WP en
  functions.php (impacto en repo)
- F3: meta descriptions por página (BBDD)
- F4: optimización de imágenes hero LCP mobile, preload en
  functions.php (impacto en repo)
- F5: CLS Home desktop, probablemente CSS en child theme
  (impacto en repo)
- F6: accessibility Proyectos, CSS y alts en BBDD
- Eliminación del usuario jaimedev.local en hardening futuro
- Construcción de las 3 páginas individuales de proyecto restantes
  (M5.2.2, M5.2.3, M5.2.4)