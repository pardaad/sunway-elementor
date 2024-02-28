<?php

/**
 * Plugin Name: پلاگین اختصاصی سان‌وی
 * Description: با این پلاگین قادر خواهید بود به فرم‌های المنتوری سایت خود امکان ارسال پیامک را اضافه کنید
 * Plugin URI:  https://sunwaysms.com/
 * Version:     1.0.1
 * Author:      SunWay SMS
 * Author URI:  https://sunwaysms.com/
 * Text Domain: sunway
 *
 * Elementor tested up to: 3.19.4
 * Elementor Pro tested up to: 3.19.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sunway_form_action( $form_actions_registrar ) {
	include_once( __DIR__ .  '/elementor-action.php' );
	$form_actions_registrar->register( new SunWay_Action_After_Submit() );
}
add_action( 'elementor_pro/forms/actions/register', 'sunway_form_action' );
