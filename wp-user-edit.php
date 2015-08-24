<?php

/**
 * Plugin Name: WP User Edit
 * Plugin URI:  https://wordpress.org/plugins/wp-user-edit/
 * Description: Allow site administrators to edit users of their sites
 * Author:      John James Jacoby
 * Version:     0.1.0
 * Author URI:  https://profiles.wordpress.org/johnjamesjacoby/
 * License:     GPL v2 or later
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * This filter is armed and considered dangerous. We *need* to turn it on, even
 * though we'll be re-restricting it again down below.
 *
 * @since 0.1.0
 */
add_filter( 'enable_edit_any_user_configuration', '__return_true' );

/**
 * Override multisite mapped meta-capabilities
 *
 * @since 0.1.0
 */
function wp_user_edit_map_meta_caps( $caps = array(), $cap = '', $user_id = 0, $args = array() ) {

	// What cap are we checking
	switch ( $cap ) {

		// Ability to edit users of sites
		case 'edit_user' :
		case 'edit_users' :
		case 'manage_network_users' :

			// Allow user to edit themsevles
			if ( ( 'edit_user' === $cap ) && isset( $args[0] ) && ( $user_id === $args[0] ) ) {
				break;
			}

			// Already not allowed?
			$index = array_search( 'do_not_allow', $caps );

			// If previously not allowed, undo it; we'll check our own way
			if ( false !== $index ) {
				unset( $caps[ $index ] );
			}

			// If multisite, user must be a member of the site
			if ( is_multisite() && isset( $args[0] ) && ! is_user_member_of_blog( $args[0] ) ) {
				$caps[] = 'do_not_allow';

			// Admins cannot modify super admins
			} elseif ( isset( $args[0] ) && is_super_admin( $args[0] ) ) {
				$caps[] = 'do_not_allow';

			// Fallback on `edit_users`
			} else {
				$caps[] = 'edit_users';
			}
			break;
	}

	// Always return capabilities
	return $caps;
}
add_filter( 'map_meta_cap', 'wp_user_edit_map_meta_caps', 99, 4 );
