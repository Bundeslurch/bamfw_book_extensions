<?php 
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_62b872bec615d',
	'title' => 'Autorenbox',
	'fields' => array(
		array(
			'key' => 'field_6255840a93ffe',
			'label' => 'author',
			'name' => 'author',
			'type' => 'user',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'role' => array(
				0 => 'author',
				1 => 'administrator',
				2 => 'editor',
				3 => 'contributor',
				4 => 'subscriber',
			),
			'allow_null' => 0,
			'multiple' => 1,
			'return_format' => 'array',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'product',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));

endif;		