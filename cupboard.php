<?php
/**
 * @package Cupcake
 */
/*
Plugin Name: Cupcake
Plugin URI: http://www.bake180.com
Description: Document manager plugin
Author: Ahmad Shah Hafizan Hamidin
Version: 1.0
Author URI: http://artificialhead.com
 */

define('CUPBOARD_VERSION', '1.0');
define('CUPBOARD_DIR', plugin_dir_url(__FILE__));

if ( is_admin() )
	require_once dirname( __FILE__ ) . '/admin.php';

function cupboard_init()
{
	//generate tables
	cupboard_table();

	//create cupboard repository
	$upload_dir = wp_upload_dir();
	define('CUPBOARD_REPO', $upload_dir['basedir']);
	define('CUPBOARD_REPO_URL', $upload_dir['baseurl']);

	if (is_writable(CUPBOARD_REPO) and ! is_dir(CUPBOARD_REPO . '/cupboard'))
	{
		mkdir(CUPBOARD_REPO . '/cupboard', 0755, true);
	}
}

function cupboard_table()
{
	global $wpdb;

	$doc_table = $wpdb->prefix . 'cupboard_docs';
	$category_table = $wpdb->prefix . 'cupboard_categories';

	//Verify table exists or not
	if (is_null($wpdb->get_var("SHOW TABLES LIKE {$doc_table}")))
	{
		$create_category_table = "CREATE TABLE {$category_table}(
		id INT(11) NOT NULL AUTO_INCREMENT,
		category VARCHAR(150) NOT NULL,
		status TINYINT(1) NOT NULL DEFAULT 1,
		PRIMARY KEY(id)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

		$create_doc_table = "CREATE TABLE {$doc_table}(
		id INT(11) NOT NULL AUTO_INCREMENT,
		category_id INT(11) NOT NULL,
		title VARCHAR(255) NOT NULL,
		description TEXT NULL,
		filename VARCHAR(255) NOT NULL,
		status TINYINT(1) NOT NULL DEFAULT 1,
		created_at DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
		updated_at DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
		PRIMARY KEY(id),
		INDEX(category_id),
		CONSTRAINT doc_category_id FOREIGN KEY (category_id) REFERENCES {$category_table} (id)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

		$wpdb->query($create_category_table);
		$wpdb->query($create_doc_table);
	}

	//Register category table in wp database objects
	if ( ! isset($wpdb->cupboard_category))
	{
		$wpdb->cupboard_category = $category_table;
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $category_table);
	}

	//Register document table in wp database objects
	if ( ! isset($wpdb->cupboard_document))
	{
		$wpdb->cupboard_document = $doc_table;
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $doc_table);
	}
}

function cupboard_get_categories()
{
	global $wpdb;

	$categories = $wpdb->get_results(
		"
		SELECT * FROM {$wpdb->cupboard_category} WHERE status = 1
		"
		, OBJECT_K);

	return $categories;
}

function cupboard_get_documents()
{
	global $wpdb;

	$docs = $wpdb->get_results(
		"
		SELECT d.*, c.* FROM {$wpdb->cupboard_document} AS d
		LEFT JOIN {$wpdb->cupboard_category} AS c ON d.category_id = c.id
		WHERE d.status = 1
		"
		,OBJECT_K);

	return $docs;
}

add_action('init', 'cupboard_init');
add_action('cupboard_categories', 'cupboard_categories');
add_action('cupboard_documents', 'cupboard_get_documents');