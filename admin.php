<?php

function cupboard_admin_init()
{
	wp_enqueue_style('wp_bootstrap', CUPBOARD_DIR.'css/bootstrap-wpadmin.css');
	wp_enqueue_style('wp_bootstrap', CUPBOARD_DIR.'css/bootstrap-wpadmin-fixes.css');
	wp_enqueue_script('cupboard_admin', CUPBOARD_DIR.'js/cupboard.js', array('jquery'));
	wp_enqueue_script('cupboard_bootstrap', CUPBOARD_DIR.'js/bootstrap.min.js', array('jquery'));

	wp_localize_script('cupboard_admin', 'cupboard_vars', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('cupboard_nonce'),
	));
}

function cupboard_admin()
{
	include_once(dirname( __FILE__ ).'/admin/index.php');
}

function cupboard_admin_menu()
{
	add_menu_page("Documents", "Documents", "edit_posts", "document_manager", "cupboard_admin", null, 30);
}

function cupboard_admin_manager()
{
	global $wpdb;

	if ( ! wp_verify_nonce($p['cp'], 'cupboard_manager'))
	{
		echo "<div class='alert alert-error'>
		<a href='#' class='close' data-dismiss='alert'>×</a>
		<strong>Process failed!</strong>
		</div>";
	}
	else
	{
		$p = $_POST;
		$f = $_FILES['document'];

		if (wp_verify_nonce($p['process'], 'cupboard_new'))
		{
			preg_match('/\.[^\.]+$/i', $f['name'], $ext);
			$filename = strtolower(preg_replace('/[\s-_]/', '', $p['title'])) . $ext[0];

			$repo = CUPBOARD_REPO . '/cupboard/';
			move_uploaded_file($f['tmp_name'], $repo . $filename);

			$wpdb->query(
				$wpdb->prepare(
					"INSERT INTO {$wpdb->cupboard_document}(category_id, title, description, filename, status, created_at)
					VALUES(%d, %s, %s, %s, 1, NOW())",
					$p['category'], $p['title'], $p['description'], $filename
				)
			);

			echo "<div class='alert alert-success'>
			<a href='#' class='close' data-dismiss='alert'>×</a>
			<strong>Your changes have been successfully saved!</strong>
			</div>";
		}
		elseif (wp_verify_nonce($p['process'], 'cupboard_edit'))
		{
			echo "<div class='alert alert-success'>
			<a href='#' class='close' data-dismiss='alert'>×</a>
			<strong>Your changes have been successfully saved!</strong>
			</div>";
		}
		elseif (wp_verify_nonce($p['process'], 'cupbord_delete'))
		{
			echo "<div class='alert alert-success'>
			<a href='#' class='close' data-dismiss='alert'>×</a>
			<strong>Your changes have been successfully saved!</strong>
			</div>";
		}
		else
		{
			echo "<div class='alert alert-error'>
			<a href='#' class='close' data-dismiss='alert'>×</a>
			<strong>Process failed!</strong>
			</div>";
		}
	}
}

function cupboard_admin_search()
{

}

function cupboard_admin_detail()
{

}

add_action('admin_init', 'cupboard_admin_init');
add_action('admin_menu', 'cupboard_admin_menu');
add_action('cupboard_add', 'cupboard_admin_manager');