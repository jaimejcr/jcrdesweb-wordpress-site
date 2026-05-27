<?php
/**
 * Footer template override — child theme
 *
 * LOCAL: renderiza la plantilla Elementor directamente por ID
 * (workaround para entorno sin licencia Pro activa).
 *
 * PRODUCCIÓN: Elementor Pro Theme Builder toma el control
 * a través de elementor_theme_do_location('footer').
 *
 * @since M4.2 · Footer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$is_local = in_array(
    $_SERVER['HTTP_HOST'],
    [ 'jcr-lab.local', 'localhost', 'localhost:8888' ],
    true
);

if ( $is_local ) {

    // Entorno local: render directo por ID de plantilla
    if ( class_exists( '\Elementor\Plugin' ) ) {
        echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( 492 );
    }

} else {

    // Producción: flujo normal de Hello Elementor + Elementor Pro
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
        if ( hello_elementor_display_header_footer() ) {
            if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
                get_template_part( 'template-parts/dynamic-footer' );
            } else {
                get_template_part( 'template-parts/footer' );
            }
        }
    }

}
?>

<?php wp_footer(); ?>

</body>
</html>