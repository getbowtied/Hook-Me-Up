<?php
// @codingStandardsIgnoreFile

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

require_once $_tests_dir . '/includes/functions.php';

function _manually_load_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/kirki.php';
}
tests_add_filter( 'after_setup_theme', '_manually_load_plugin' );

require $_tests_dir . '/includes/bootstrap.php';
