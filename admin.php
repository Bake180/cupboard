<?php

add_action('admin_menu', 'cupboard_admin_menu');

function cupboard_admin_init()
{
	wp_enqueue_style('wp_bootstrap', CUPBOARD_DIR.'css/bootstrap-wpadmin.css');
	wp_enqueue_style('wp_bootstrap', CUPBOARD_DIR.'css/bootstrap-wpadmin-fixes.css');
	wp_enqueue_script('cupboard_admin', CUPBOARD_DIR.'js/cupboard.js', array('jquery'));
	wp_enqueue_script('cupboard_bootstrap', CUPBOARD_DIR.'js/bootstrap.min.js', array('jquery'));

	wp_localize_script('cupboard_manager', 'cup_vars', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('cupboard_nonce'),
	));
}

add_action('init', 'cupboard_admin_init');

function cupboard_admin()
{
	include_once(dirname( __FILE__ ).'/admin/index.php');
}

function cupboard_admin_menu()
{
	add_menu_page("Documents", "Documents", "edit_posts", "document_manager", "cupboard_admin", null, 30);
}

function cupboard_admin_add()
{

}

add_action('cupboard_admin_add', 'cupboard_admin_add');
