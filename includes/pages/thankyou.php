<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$thankyou_html = '';
// $order = wc_get_order( $order_id );
$amount = $order->get_total();
$currency = $order->get_currency();
// $total = "$amount $currency";
// $total = $order->get_total();
$total = $order->get_formatted_order_total();
$note = '';
$payment_url = $this->wc_cashapp_payment_url( $amount, $note );
$qr_code_url = $this->wc_cashapp_qrcode_url( $amount, $note );
$qr_code = $this->wc_cashapp_qrcode_html( $amount, $note );
$thankyou_html .= '<div id="wc-' . esc_attr( $this->id ) . '-form" data-plugin="' . wp_kses_post( WCCASHAPP_PLUGIN_VERSION ) . '">';
$thankyou_html .= '<h2>' . esc_html__( 'Cash App Notice', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . '</h2>';
$thankyou_html .= '<p><strong style="font-size:large;">' . sprintf( esc_html__( 'Please use your Order Number: %s as the payment reference', WCCASHAPP_PLUGIN_TEXT_DOMAIN ), $order_id ) . '.</strong></p>';
// $thankyou_html .= '<p class="wc-cashapp">' . esc_html__('Click', WCCASHAPP_PLUGIN_TEXT_DOMAIN) . ' > ';
// $thankyou_html .= '<a href="https://cash.app/', esc_attr( wp_kses_post( $this->ReceiverCashApp ) ), '/' , esc_attr( wp_kses_post( $amount  ) ), '" target="_blank"><img width="150" height="150" class="logo-qr" alt="Cash App Link" src="' . esc_attr( WCCASHAPP_PLUGIN_DIR_URL . 'assets/images/cashapp.png' ) . '"></a>';
// $thankyou_html .= ' ' . esc_html__( 'or Scan', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . ' > <a href="https://cash.app/', esc_attr( wp_kses_post( $this->ReceiverCashApp ) ), '/' , esc_attr( wp_kses_post( $amount  ) ), '" target="_blank"><img width="150" height="150" class="logo-qr" alt="Cash App Link" src="https://emailreceipts.io/qr?d=100&t=https://cash.app/', esc_attr( wp_kses_post( $this->ReceiverCashApp ) ), '/' , esc_attr( wp_kses_post( $amount  ) ), '"></a></p>';
$thankyou_html .= $qr_code;
$thankyou_html .= '<p><strong>' . esc_html__( 'Disclaimer', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . ': </strong>' . esc_html__( 'Your order will not be processed until funds have cleared in our Cash App account', WCCASHAPP_PLUGIN_TEXT_DOMAIN ) . '.</p>';
$thankyou_html .= '</div><br><hr><br>';
echo $thankyou_html;
// return $thankyou_html;