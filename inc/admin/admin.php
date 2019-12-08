<?php

namespace WP_PRICE_CHART\admin;
use WP_PRICE_CHART;

class Admin {

	/**
	 * Admin Page slug
	 */
	public static $admin_page_slug;

	/**
	 * Admin_Page constructor.
	 */
	public function __construct() {
		/*
		 * Set Page slug Admin
		 */
		self::$admin_page_slug = 'wp-price-chart';
		/*
		 * Setup Admin Menu
		 */
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		/*
		 * Register Script in Admin Area
		 */
		//add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
	}

	/**
	 * Admin Link
	 *
	 * @param $page
	 * @param array $args
	 * @return string
	 */
	public static function admin_link( $page, $args = array() ) {
		return add_query_arg( $args, admin_url( 'admin.php?page=' . $page ) );
	}

	/**
	 * If in Page in Admin
	 *
	 * @param $page_slug
	 * @return bool
	 */
	public static function in_page( $page_slug ) {
		global $pagenow;
		if ( $pagenow == "admin.php" and isset( $_GET['page'] ) and $_GET['page'] == $page_slug ) {
			return true;
		}

		return false;
	}

	/**
	 * Load assets file in admin
	 */
	public function admin_assets() {
		global $pagenow;

		//List Allow This Script
		if ( $pagenow == "admin.php" ) {

			//wp_enqueue_style( 'wp-price-chart', WP_PRICE_CHART::$plugin_url . '/asset/admin/css/style.css', array(), WP_PRICE_CHART::$plugin_version, 'all' );
			//wp_enqueue_script( 'wp-price-chart', WP_PRICE_CHART::$plugin_url . '/asset/admin/js/script.js', array( 'jquery' ), WP_PRICE_CHART::$plugin_version, false );

		}

	}

	/**
	 * Set Admin Menu
	 */
	public function admin_menu() {
		add_menu_page( __( 'Price Chart', 'wp-price-chart' ), __( 'Price Chart', 'wp-price-chart' ), 'manage_options', self::$admin_page_slug, array( Settings::instance(), 'setting_page' ), 'dashicons-chart-area', 90 );
		//add_submenu_page( self::$admin_page_slug, __( 'order', 'wp-price-chart' ), __( 'order', 'wp-price-chart' ), 'manage_options', self::$admin_page_slug, array( $this, 'admin_page' ) );
		//add_submenu_page( 'options-general.php', __( 'Price Chart', 'wp-price-chart' ), __( 'Price Chart', 'wp-price-chart' ), 'manage_options', 'wp_price_chart_option', array( Settings::instance(), 'setting_page' ) );
	}

	/*
	 * Admin Page
	 */
	public function admin_page() {
		//$simple_text = 'Hi';
		//require_once WP_PRICE_CHART::$plugin_path . '/inc/admin/views/default.php';
	}
}