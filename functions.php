<?php
/**
 * Plugin Name: Tainacan Unsecure Legacy PDFJS
 * Description: A plugin to integrate a legacy but unsecure version of PDF.js back to Tainacan. Use this at your own risk if you really need PDF file preview in mobile or older browsers.
 * Version: 1.0.0
 * Author: mateuswetah
 * License: GPL2
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function tainacan_unsecure_legacy_pdfjs_embed_handler($matches, $attr, $url, $rawattr) {

    $viewer_url = plugin_dir_url( __FILE__ ) . '/pdfjs-dist/web/viewer.html?file=' . $url;

    $defaults = array(
        'width' => '100%',
        'height' => '640px'
    );

    $args = array_merge($attr, $defaults);

    $dimensions = '';
    if ( ! empty( $args['width'] ) && ! empty( $args['height'] ) ) {
        $dimensions .= sprintf( "width='%s' ", $args['width'] );
        $dimensions .= sprintf( "height='%s' ", $args['height'] );
    }
    
    $pdf = "<iframe id='iframePDF' name='iframePDF' src='$viewer_url' $dimensions allowfullscreen webkitallowfullscreen></iframe>";
    return $pdf;
}
wp_embed_register_handler( 'pdf', '#^https?://.+?\.(pdf)$#i', 'tainacan_unsecure_legacy_pdfjs_embed_handler', 4 );
