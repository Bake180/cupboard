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

function cupboard_init()
{
	//generate tables
	cupboard_table();
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
}

add_action('init', 'cupboard_init');