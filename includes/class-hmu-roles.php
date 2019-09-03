<?php

/**
 * Manage user roles
 *
 * @link       getbowtied.com
 * @since      1.2.4
 * @package    HMU
 * @subpackage HMU/includes
 * @author     GetBowtied
 */

class HookMeUp_User_Roles {

	/**
	 * HookMeUp_User_Roles constructor
	 *
	 * @since 1.2.4
	 */
	public function __construct() {

	}

	/**
	 * Retrieve user role names
	 *
	 * @since 1.2.4
	 *
	 * @return array
	 */
	public static function get_user_roles() {
        global $wp_roles;

        if ( ! isset( $wp_roles ) )
            $wp_roles = new WP_Roles();

            $user_roles = $wp_roles->get_names();
            if( $user_roles['administrator'] ) unset( $user_roles['administrator'] );

        return $user_roles;
	}

    /**
	 * Check if the logged in user has admin or super admin role
	 *
	 * @since 1.2.4
	 *
	 * @return array
	 */
	public static function user_is_admin() {

        return is_admin() || is_super_admin();
	}
}
