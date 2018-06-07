// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Mentors', 'Post Type General Name', 'mentorly' ),
		'singular_name'         => _x( 'Mentor', 'Post Type Singular Name', 'mentorly' ),
		'menu_name'             => __( 'Post Types', 'mentorly' ),
		'name_admin_bar'        => __( 'Post Type', 'mentorly' ),
		'archives'              => __( 'Item Archives', 'mentorly' ),
		'attributes'            => __( 'Item Attributes', 'mentorly' ),
		'parent_item_colon'     => __( 'Parent Item:', 'mentorly' ),
		'all_items'             => __( 'All Items', 'mentorly' ),
		'add_new_item'          => __( 'Add New Item', 'mentorly' ),
		'add_new'               => __( 'Add New', 'mentorly' ),
		'new_item'              => __( 'New Item', 'mentorly' ),
		'edit_item'             => __( 'Edit Item', 'mentorly' ),
		'update_item'           => __( 'Update Item', 'mentorly' ),
		'view_item'             => __( 'View Item', 'mentorly' ),
		'view_items'            => __( 'View Items', 'mentorly' ),
		'search_items'          => __( 'Search Item', 'mentorly' ),
		'not_found'             => __( 'Not found', 'mentorly' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'mentorly' ),
		'featured_image'        => __( 'Featured Image', 'mentorly' ),
		'set_featured_image'    => __( 'Set featured image', 'mentorly' ),
		'remove_featured_image' => __( 'Remove featured image', 'mentorly' ),
		'use_featured_image'    => __( 'Use as featured image', 'mentorly' ),
		'insert_into_item'      => __( 'Insert into item', 'mentorly' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'mentorly' ),
		'items_list'            => __( 'Items list', 'mentorly' ),
		'items_list_navigation' => __( 'Items list navigation', 'mentorly' ),
		'filter_items_list'     => __( 'Filter items list', 'mentorly' ),
	);
	$args = array(
		'label'                 => __( 'Mentor', 'mentorly' ),
		'description'           => __( 'Mentorly post type for a mentor', 'mentorly' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'revisions' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => false,
		'show_in_menu'          => false,
		'menu_position'         => 5,
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'query_var'             => 'mentor',
		'rewrite'               => false,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'rest_base'             => 'mentorly',
		'rest_controller_class' => 'WP_Mentorly_Post_Controller',
	);
	register_post_type( 'mentor', $args );

}
add_action( 'init', 'custom_post_type', 0 );