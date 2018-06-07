// uninstall.php for Mentorly

if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}
check_admin_referer( 'bulk-plugins' );

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	return;
}

// Uninstallation actions here
global $wpdb;

$plugin_options = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE 'mmatch_%'" );

foreach( $plugin_options as $option ) {
    delete_option( $option->option_name );
}