<?php
/**
 * Created by PhpStorm.
 * User: yamna
 * Date: 03/12/2019
 * Time: 09:29
 */
function wpdocs_codex_book_init() {
	$labels = array(
		'name'                  => _x( 'Poubelles', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Poubelle', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Poubelles', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Poubelle', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Ajouter', 'textdomain' ),
		'add_new_item'          => __( 'Ajouter une poubelle', 'textdomain' ),
		'new_item'              => __( 'Nouvelle poubelle', 'textdomain' ),
		'edit_item'             => __( 'Modifier une poubelle', 'textdomain' ),
		'view_item'             => __( 'Afficher une poubelle', 'textdomain' ),
		'all_items'             => __( 'Toutes les poubelles', 'textdomain' ),
		'search_items'          => __( 'Rechercher une poubelle', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Bins:', 'textdomain' ),
		'not_found'             => __( 'Aucunes poubelles trouvees.', 'textdomain' ),
		'not_found_in_trash'    => __( 'Aucunes poubelles dans la corbeille.', 'textdomain' ),
		'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
		'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 100,
		'menu_icon'          =>'dashicons-book',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
	);

	register_post_type( 'book', $args );
}

add_action( 'init', 'wpdocs_codex_book_init' );