<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( is_checkout() ) {
    // Load CSS
    wp_register_style( 'wc_cashapp_checkout', WCCASHAPP_PLUGIN_DIR_URL . 'assets/css/checkout.css' );
    wp_enqueue_style( 'wc_cashapp_checkout' );
    $copy_js = 'copy.js';
    if ( !wp_script_is( $copy_js, 'enqueued' ) ) {
        wp_register_script(
            $copy_js,
            WCCASHAPP_PLUGIN_DIR_URL . 'assets/js/' . $copy_js,
            array('jquery', 'wc_cashapp_qrcode'),
            null,
            true
        );
        wp_enqueue_script( $copy_js );
        // wp_enqueue_script( 'wc_cashapp_copy', WCCASHAPP_PLUGIN_DIR_URL . 'assets/js/copy.js' );
    }
    $qrcode_styling = 'qr-code-styling.min.js';
    if ( !wp_script_is( $qrcode_styling, 'enqueued' ) ) {
        wp_register_script( $qrcode_styling, WCCASHAPP_PLUGIN_DIR_URL . 'assets/js/' . $qrcode_styling );
        wp_enqueue_script( $qrcode_styling );
        // wp_enqueue_script( 'wc_cashapp_qrcode_styling', WCCASHAPP_PLUGIN_DIR_URL . 'assets/js/qr-code-styling.min.js' );
    }
    $qrcode_generator = 'qr-code-generator.js';
    if ( !wp_script_is( $qrcode_generator, 'enqueued' ) ) {
        wp_register_script( $qrcode_generator, WCCASHAPP_PLUGIN_DIR_URL . 'assets/js/' . $qrcode_generator );
        wp_enqueue_script( $qrcode_generator );
        // wp_enqueue_script( 'wc_cashapp_qrcode_generator', WCCASHAPP_PLUGIN_DIR_URL . 'assets/js/qr-code-generator.js' );
    }
    wp_enqueue_script(
        'wc_cashapp_qrcode',
        WCCASHAPP_PLUGIN_DIR_URL . 'assets/js/qrcode.js',
        array('jquery', $qrcode_styling, $qrcode_generator),
        null,
        true
    );
    global $woocommerce;
    $amount = $woocommerce->cart->total;
    $payment_url = $this->wc_cashapp_payment_url( $amount );
    $wc_cashapp_qrcode = array(
        "url" => $this->wc_cashapp_payment_url( $amount ),
    );
    $wc_cashapp_qrcode['logo'] = '';
    $wc_cashapp_qrcode['width'] = 150;
    $wc_cashapp_qrcode['height'] = 150;
    $wc_cashapp_qrcode['darkcolor'] = '#000000';
    $wc_cashapp_qrcode['lightcolor'] = '#ffffff';
    $wc_cashapp_qrcode['backgroundcolor'] = '#ffffff';
    $wc_cashapp_qrcode['dotsType'] = 'dots';
    $wc_cashapp_qrcode['cornersSquareType'] = 'extra-rounded';
    $wc_cashapp_qrcode['cornersDotType'] = 'square';
    wp_localize_script( 'wc_cashapp_qrcode', 'wc_cashapp_qrcode', $wc_cashapp_qrcode );
    // // jquery-dialog on checkout/thankyou with countdown https://jqueryui.com/demos/dialog/
    // wp_enqueue_script( 'jquery-ui-dialog' );
}
// if ( ! is_cart() || ! is_checkout() || ! isset( $_GET['pay_for_order'] ) ) { }