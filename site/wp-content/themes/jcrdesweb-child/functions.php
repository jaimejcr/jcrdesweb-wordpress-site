<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * JCR DesWeb Child — functions.php
 *
 * El footer lo gestiona íntegramente Elementor Pro Theme Builder.
 * Display conditions configuradas: All Pages + Front Page.
 *
 * No se usa hook wp_footer para renderizar el footer.
 * El workaround de M4.2 fue eliminado en M5 al corregir
 * las display conditions del template de footer en Theme Builder.
 *
 * Cualquier lógica PHP futura que no dependa del diseño
 * va en el plugin jcr-site-core, no aquí.
 */