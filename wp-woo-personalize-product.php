<?php

/*
Plugin Name: WP-Woo-Personalize-Product
Plugin URI:
Description: Plugin de creación de productos personalizados, para ser usado en conjunto con WooCommerce, por parte de posibles clientes.
Version: 1.0
Author: Coodesoft
Author URI: https://www.coodesoft.com.ar
License: GPL v3
*/

function coode_WPP_short_code_tour() {
    return '<div>Esto es el contenido</div>';
}

function coode_WPP_on_activate()
{
    //add_option('mi_opcion',255,'','yes');
}


add_shortcode('WPP_tour', 'coode_WPP_short_code_tour');
register_activation_hook(__FILE__,'coode_WPP_on_activate');
?>
