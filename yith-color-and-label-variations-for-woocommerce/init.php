<?php
/**
 * Plugin Name: YITH WooCommerce Color, Image & Label Variation Swatches
 * Plugin URI: https://yithemes.com/
 * Description: The <code><strong>YITH Color and Label Variations for WooCommerce</strong></code> allows you to customize the drop-down select of your variable products and buy product variations directly from shop pages. A must-have for every e-commerce. <a href="https://yithemes.com/" target="_blank">Get more plugins for your e-commerce shop on <strong>YITH</strong></a>.
 * Version: 2.19.0
 * Author: YITH
 * Author URI: https://yithemes.com/
 * Text Domain: yith-color-and-label-variations-for-woocommerce
 * Domain Path: /languages/
 * WC requires at least: 9.7
 * WC tested up to: 9.9
 *
 * @author YITH <plugins@yithemes.com>
 * @package YITH WooCommerce Color and Label Variations
 * @version 2.19.0
 */

/*
Copyright 2015-2024 Your Inspiration Solutions  (email : plugins@yithemes.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'yith_plugin_registration_hook' ) ) {
	require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );

if ( defined( 'YITH_WCCL_PREMIUM' ) ) {
	/**
	 * Message if the premium version is installed
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function yith_wccl_install_free_admin_notice() {
		?>
		<div class="error">
			<p><?php esc_html_e( 'You can\'t activate the free version of YITH WooCommerce Colors and Labels Variations while you are using the premium one.', 'yith-color-and-label-variations-for-woocommerce' ); ?></p>
		</div>
		<?php
	}

	add_action( 'admin_notices', 'yith_wccl_install_free_admin_notice' );

	deactivate_plugins( plugin_basename( __FILE__ ) );

	return;
}

if ( ! defined( 'YITH_WCCL_FREE_INIT' ) ) {
	define( 'YITH_WCCL_FREE_INIT', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'YITH_WCCL' ) ) {
	define( 'YITH_WCCL', true );
}
if ( ! defined( 'YITH_WCCL_URL' ) ) {
	define( 'YITH_WCCL_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'YITH_WCCL_DIR' ) ) {
	define( 'YITH_WCCL_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'YITH_WCCL_VERSION' ) ) {
	define( 'YITH_WCCL_VERSION', '2.19.0' );
}

if ( ! defined( 'YITH_WCCL_FILE' ) ) {
	define( 'YITH_WCCL_FILE', __FILE__ );
}

if ( ! defined( 'YITH_WCCL_SLUG' ) ) {
	define( 'YITH_WCCL_SLUG', 'yith-color-and-label-variations-for-woocommerce' );
}

// Plugin Framework Loader.
if ( file_exists( plugin_dir_path( __FILE__ ) . 'plugin-fw/init.php' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'plugin-fw/init.php';
}

if ( ! function_exists( 'yith_wccl_constructor' ) ) {
	/**
	 * Init.
	 *
	 * @since 1.0.0
	 */
	function yith_wccl_constructor() {
		global $woocommerce;
		if ( ! isset( $woocommerce ) ) {
			return;
		}

        yith_plugin_fw_load_plugin_textdomain( 'yith-color-and-label-variations-for-woocommerce', basename( dirname( __FILE__ ) ) . '/languages' );

		// Load required classes and functions.
		require_once 'includes/functions.yith-wccl.php';
		require_once 'includes/class.yith-wccl-admin.php';
		require_once 'includes/class.yith-wccl-frontend.php';
		require_once 'includes/class.yith-wccl.php';

		// Let's start the game!
		global $yith_wccl;
		$yith_wccl = new YITH_WCCL();
	}
}

add_action( 'plugins_loaded', 'yith_wccl_constructor' );
