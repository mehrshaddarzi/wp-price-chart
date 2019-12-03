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
		$sections = array(
			/*array(
				'id'    => 'WP_PRICE_CHART_email_opt',
				'desc'  => __( 'Basic email settings', 'wp-reviews-insurance' ),
				'title' => __( 'Email', 'wp-reviews-insurance' )
			),*/
			array(
				'id'    => 'wp_price_chart_opt',
				'title' => __( 'General', 'wp-reviews-insurance' )
			),
		);

		$fields = array(
			/*'WP_PRICE_CHART_email_opt'     => array(
				array(
					'name'    => 'from_email',
					'label'   => __( 'From Email', 'wp-reviews-insurance' ),
					'type'    => 'text',
					'default' => get_option( 'admin_email' )
				),
				array(
					'name'    => 'from_name',
					'label'   => __( 'From Name', 'wp-reviews-insurance' ),
					'type'    => 'text',
					'default' => get_option( 'blogname' )
				),
				array(
					'name'         => 'email_logo',
					'label'        => __( 'Email Logo', 'wp-reviews-insurance' ),
					'type'         => 'file',
					'button_label' => 'choose logo image'
				),
				array(
					'name'    => 'email_body',
					'label'   => __( 'Email Body', 'wp-reviews-insurance' ),
					'type'    => 'wysiwyg',
					'default' => '<p>Hi, [fullname] </p> For Accept Your Reviews Please Click Bottom Link : <p> [link]</p>',
					'desc'    => 'Use This Shortcode :<br /> [fullname] : User Name <br /> [link] : Accept email link'
				),
				array(
					'name'    => 'email_footer',
					'label'   => __( 'Email Footer Text', 'wp-reviews-insurance' ),
					'type'    => 'wysiwyg',
					'default' => 'All rights reserved',
				)
			),*/
			'wp_price_chart_opt' => array(
				array(
					'name'    => 'update_time',
					'label'   => __( 'Update Time (Minute)', 'wp-reviews-insurance' ),
					'type'    => 'text',
					'default' => '15',
					'desc'    => '',
				),
				array(
					'name'    => 'chart_label_name',
					'label'   => __( 'Label Name', 'wp-reviews-insurance' ),
					'type'    => 'text',
					'default' => 'label',
					'desc'    => '',
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