<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Get the GBT_Dashboard_Setup instance to access base paths
//$gbt_dashboard_setup = GBT_Dashboard_Setup::init();
//$base_paths = $gbt_dashboard_setup->get_base_paths();

if ( ! class_exists( 'Elementor_Gbt_Third_Party_Plugin' ) )
	//include_once( $base_paths['path'] . '/dashboard/inc/third/includes/elementor.php' );
	include_once dirname(__FILE__) . '/includes/elementor.php';
