<?php
/**
 * wp-postratings-pretty Admin.
 *
 * @package WordPress
 * @subpackage wp-postratings-pretty Plugin
 */


/**
 * Security check
 * Prevent direct access to the file.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Ratings Admin
 *
 * @since 1.84
 */
class WPPostRatingsAdmin {

	/*
	 * Constructor
	 */
	public function __construct() {

		// Administration Menu
		add_action( 'admin_menu', array( $this, 'ratings_menu' ) );

		// Add rating column to the admin
		add_filter( 'manage_posts_columns', array( $this, 'postrating_admin_column_title' ) );
		add_filter( 'manage_pages_columns', array( $this, 'postrating_admin_column_title' ) );

		// Fill rating column in the admin
		add_action( 'manage_posts_custom_column', array( $this, 'postrating_admin_column_content' ) );
		add_action( 'manage_pages_custom_column', array( $this, 'postrating_admin_column_content' ) );

		// Sort rating column in the admin
		add_filter( 'manage_edit-post_sortable_columns', array( $this, 'postrating_admin_column_sort' ) );
		add_filter( 'manage_edit-page_sortable_columns', array( $this, 'postrating_admin_column_sort' ) );

	}

	/*
	 * Add admin menus
	 */
	public function ratings_menu() {

		// Main Ratings Menu
		add_menu_page(
			__( 'Ratings', 'wp-postratings-pretty' ),
			__( 'Ratings', 'wp-postratings-pretty' ),
			'manage_ratings',
			'wp-postratings-pretty/postratings-manager.php',
			'',
			'dashicons-star-filled'
		);

		// Manage Ratings
		add_submenu_page(
			'wp-postratings-pretty/postratings-manager.php',
			__( 'Manage Ratings', 'wp-postratings-pretty' ),
			__( 'Manage Ratings', 'wp-postratings-pretty' ),
			'manage_ratings',
			'wp-postratings-pretty/postratings-manager.php'
		);

		// Ratings Options
		add_submenu_page(
			'wp-postratings-pretty/postratings-manager.php',
			__( 'Ratings Options', 'wp-postratings-pretty' ),
			__( 'Ratings Options', 'wp-postratings-pretty' ),
			'manage_ratings',
			'wp-postratings-pretty/postratings-options.php'
		);

		// Manage Templates
		add_submenu_page(
			'wp-postratings-pretty/postratings-manager.php',
			__( 'Ratings Templates', 'wp-postratings-pretty' ),
			__( 'Ratings Templates', 'wp-postratings-pretty' ),
			'manage_ratings',
			'wp-postratings-pretty/postratings-templates.php'
		);

	}

	/*
	 * Add rating column to the admin
	 */
	function postrating_admin_column_title( $defaults ) {

		$defaults['ratings'] = esc_html__( 'Ratings', 'wp-postratings-pretty' );
		return $defaults;

	}

	/*
	 * Fill rating column in the admin
	 */
	function postrating_admin_column_content( $column_name ) {

		global $post;

		if ( $column_name == 'ratings' ) {
			if ( function_exists( 'the_ratings' ) ) {
				$template = str_replace( '%RATINGS_IMAGES_VOTE%', '%RATINGS_IMAGES%<br />', stripslashes( get_option( 'postratings_template_vote' ) ) );
				echo expand_ratings_template( $template, $post, null, 0, false );
			}
		}

	}

	/*
	 * Sort rating column in the admin
	 */
	function postrating_admin_column_sort( $defaults ) {

		$defaults['ratings'] = 'ratings';
		return $defaults;

	}

}
new WPPostRatingsAdmin();
