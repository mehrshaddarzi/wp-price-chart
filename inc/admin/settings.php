<?php

namespace WP_PRICE_CHART\admin;

use WP_PRICE_CHART\core\SettingAPI;

/**
 * Class Settings
 * @see https://github.com/tareq1988/wordpress-settings-api-class
 */
class Settings {
	/**
	 * Plugin Option name
	 */
	public $setting;

	/**
	 * The single instance of the class.
	 */
	protected static $_instance = null;

	/**
	 * Main Instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Admin_Setting_Api constructor.
	 */
	public function __construct() {
		/**
		 * Set Admin Setting
		 */
		add_action( 'admin_init', array( $this, 'init_option' ) );
	}

	/**
	 * Display the plugin settings options page
	 */
	public function setting_page() {

		echo '<div class="wrap">';
		settings_errors();

		$this->setting->show_navigation();
		$this->setting->show_forms();

		echo '</div>';
	}

	/**
	 * Registers settings section and fields
	 */
	public function init_option() {
		global $wpdb;

		$sections = array(
			array(
				'id'    => 'wp_price_chart_opt',
				'title' => __( 'General', 'wp-reviews-insurance' )
			),
		);

		// Get List Symbol
		$symbol_list = $wpdb->get_results( "SELECT SYMBOL_ID, SYMBOL FROM {$wpdb->prefix}socks_symbol", ARRAY_A );
		$list        = array();
		foreach ( $symbol_list as $r ) {
			$list[ $r['SYMBOL_ID'] ] = $r['SYMBOL'];
		}

		$fields = array(
			'wp_price_chart_opt' => array(
				array(
					'name'    => 'default_symbol',
					'label'   => __( 'Default Symbol', 'wedevs' ),
					'desc'    => __( 'Use [price-chart] ShortCode in WordPress', 'wedevs' ),
					'type'    => 'select',
					'options' => $list
				),
				array(
					'name'    => 'chart_height',
					'label'   => __( 'Chart Height', 'wp-reviews-insurance' ),
					'type'    => 'text',
					'default' => '130',
					'desc'    => '',
				),
				array(
					'name'    => 'default_show_ago',
					'label'   => __( 'Show ago Hour (default)', 'wp-reviews-insurance' ),
					'type'    => 'text',
					'default' => '5',
					'desc'    => '',
				),
			),

		);

		$this->setting = new SettingAPI();

		//set sections and fields
		$this->setting->set_sections( $sections );
		$this->setting->set_fields( $fields );

		//initialize them
		$this->setting->admin_init();
	}

}