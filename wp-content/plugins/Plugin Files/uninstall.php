<?php

/**
 * The code in this file runs when a plugin is uninstalled from the WordPress dashboard.
 */
/* If uninstall is not called from WordPress exit. */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}
global $wpdb, $license_box_api;

require_once plugin_dir_path( __FILE__ ) . 'wp-amp.php';
include_once( 'includes/class-amphtml-license.php' );
/* Place uninstall code below here. */

$license_code = get_option( 'amphtml_license_code' );
$license_name = get_option( 'amphtml_license_name' );
$result       = $license_box_api->deactivate_license( $license_code, $license_name );

if ( empty( $result[ 'status' ] ) ) {
    add_settings_error( 'license_message', 'settings_updated', $result[ 'message' ], 'error' );
} else {
    add_settings_error( 'license_message', 'settings_updated', $result[ 'message' ], 'updated' );
    delete_option( 'amphtml_license_true' );
}

$prefix = 'amphtml';

// Delete options
$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '{$prefix}%';" );
