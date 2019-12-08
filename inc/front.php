<?php

namespace WP_PRICE_CHART;

use WP_PRICE_CHART;


class Front {

	/**
	 * Asset Script name
	 */
	public static $asset_name = 'wp-price-chart';

	/**
	 * constructor.
	 */
	public function __construct() {
		/*
		 * Add Script
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_style' ) );
		/**
		 * Add ShortCode
		 */
		add_shortcode( 'price-chart', array( $this, 'wp_price_chart' ) );
	}

	/**
	 * Register Asset
	 */
	public function wp_enqueue_style() {

		//Jquery Chart Js
		wp_register_style( 'chart-js', WP_PRICE_CHART::$plugin_url . '/asset/public/chartjs/chart.min.css', array(), '2.8.0', 'all' );
		wp_register_script( 'chart-js', WP_PRICE_CHART::$plugin_url . '/asset/public/chartjs/chart.min.js', array(), '2.8.0', true );

		// Flat Pickr
		wp_register_style( 'flat-pickr', WP_PRICE_CHART::$plugin_url . '/asset/public/flatpickr/flatpickr.min.css', array(), '4.6.3', 'all' );
		wp_register_script( 'flat-pickr', WP_PRICE_CHART::$plugin_url . '/asset/public/flatpickr/flatpickr.min.js', array(), '4.6.3', true );

		//Native Plugin
		//wp_enqueue_style( self::$asset_name, WP_PRICE_CHART::$plugin_url . '/asset/style.css', array(), WP_PRICE_CHART::$plugin_version, 'all' );
		//$custom_css = ".test {color: " . WP_PRICE_CHART::$option['star_color'] . ";}";
		//wp_add_inline_style( self::$asset_name, $custom_css );

		wp_register_script( self::$asset_name, WP_PRICE_CHART::$plugin_url . '/asset/public/script.js', array( 'jquery' ), WP_PRICE_CHART::$plugin_version, true );
//		wp_enqueue_script( self::$asset_name, WP_PRICE_CHART::$plugin_url . '/asset/script.js', array( 'jquery' ), WP_PRICE_CHART::$plugin_version, false );
//		wp_localize_script( self::$asset_name, 'wp_reviews_js', array(
//			'ajax'          => home_url() . '/?WP_PRICE_CHART_check_notification=yes&time=' . current_time( 'timestamp' ),
//			'is_login_user' => ( is_user_logged_in() ? 1 : 0 )
//		) );
	}


	/**
	 * Price chart ShortCode
	 *
	 * @param $atts
	 * @return string
	 */
	public function wp_price_chart( $atts ) {
		global $wpdb;

		// Load Chart Js
		wp_enqueue_style( 'chart-js' );
		wp_enqueue_script( 'chart-js' );

		// Flat Pickr
		wp_enqueue_style( 'flat-pickr' );
		wp_enqueue_script( 'flat-pickr' );

		// native
		wp_enqueue_script( self::$asset_name );

		// Symbol
		$opt                 = get_option( 'wp_price_chart_opt' );
		$default_symbol      = $opt['default_symbol'];
		$default_symbol_name = '';
		if ( isset( $_GET['symbol'] ) and ! empty( $_GET['symbol'] ) and $_GET['symbol'] > 0 ) {
			$default_symbol = esc_html( $_GET['symbol'] );
		}
		$symbol_list = $wpdb->get_results( "SELECT SYMBOL_ID, SYMBOL FROM {$wpdb->prefix}socks_symbol", ARRAY_A );
		foreach ( $symbol_list as $r ) {
			if ( $r['SYMBOL_ID'] == $default_symbol ) {
				$default_symbol_name = $r['SYMBOL'];
			}
		}

		// Get From and to
		$current_time       = current_time( 'timestamp' );
		$current_time_x_ago = $current_time - ( 3600 * WP_PRICE_CHART::$option['wp_price_chart_opt']['default_show_ago'] );
		$from_input         = date( "Y-m-d H:i", $current_time_x_ago );
		$to_input           = date( "Y-m-d H:i", $current_time );
		if ( isset( $_GET['to-date'] ) and isset( $_GET['from-date'] ) and Helper::validateDate( $_GET['from-date'], "Y-m-d H:i" ) and Helper::validateDate( $_GET['to-date'], "Y-m-d H:i" ) ) {
			$from_input         = $_GET['from-date'];
			$to_input           = $_GET['to-date'];
			$current_time       = strtotime( $to_input );
			$current_time_x_ago = strtotime( $from_input );
		}

		// Start content
		$text = '';

		// Show Select Date
		ob_start();
		include WP_PRICE_CHART::$plugin_path . '/templates/select-date.php';
		$text .= ob_get_clean();

		// Show Chart
		ob_start();
		include WP_PRICE_CHART::$plugin_path . '/templates/chart.php';
		$text .= ob_get_clean();

		return $text;
	}

}