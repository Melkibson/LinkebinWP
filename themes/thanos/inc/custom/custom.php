<?php
/**
 * Created by PhpStorm.
 * User: yamna
 * Date: 03/12/2019
 * Time: 09:29
 */

function city_init()
{
	$labels = array('title');
	$work = register_cuztom_post_type('ville', array(
		'has_archive'         => true,
		'supports'            => $labels,
		'menu_position'       => 100,
		'rewrite'            => array( 'slug' => 'city' ),
		'menu_icon'          =>'dashicons-hammer',
	));

	$work->add_meta_box(
		'meta-city-info',
		'Coordonnées',
		array(

			array(
				'id'    => '_data_name',
				'type'  => 'text',
				'label' => 'Nom',
			),

			array(
				'id'    => '_data_region',
				'type'  => 'text',
				'label' => 'Région',
			),

			array(

				'id'    => '_data_county',
				'type'  => 'text',
				'label' => 'Département',
			),

			array(
				'id'    => '_data_json',
				'type'  => 'file',
				'label' => 'Envoyer un fichier',
			),

		)
	);

}

add_action( 'init', 'city_init' );