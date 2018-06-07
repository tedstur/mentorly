<?php

// this include provides the dropdown box for timezone selection
include( plugin_dir_path( __FILE__ ) . '/tz.php');

	class Mentor {
		
		public $post_type_name;
		public $post_type_args;
		public $post_type_labels;
		
	    public function __construct($name, $args = array(), $labels = array())
		{
			// Constructor here
			$this->post_type_name = strtolower( str_replace( ' ', '_', $name ) );
			$this->post_type_args = $args;
			$this->post_type_labels = $labels;
     
			// Add action to register the post type, if the post type does not already exist
			if( ! post_type_exists( $this->post_type_name ) )
			{
				add_action( 'init', array( &$this, 'register_post_type' ) );
			}
			
			// Watch for the shortcode for the form
			add_shortcode( 'mentorly_mentor_form', array( $this, 'theForm' ) );
     
			// Listen for the save post hook
			$this->save();
		}

		public function Mentor($name, $args = array(), $labels = array())
		{
        // PHP4-style constructor.
        // This will NOT be invoked, unless a sub-class that extends `Mentor`` calls it.
        // In that case, call the new-style constructor to keep compatibility.
			self::__construct($name, $args = array(), $labels = array());
		}
		
		/* Method which registers the post type */
		public function register_post_type()
		{
			//Capitilize the words and make it plural
			$name       = ucwords( str_replace( '_', ' ', $this->post_type_name ) );
			$plural     = $name . 's';
			
			// We set the default labels based on the post type name and plural. We overwrite them with the given labels.
			$labels = array_merge(
			
				// Default
				array(
					'name'                  => _x( $plural, 'post type general name' ),
					'singular_name'         => _x( $name, 'post type singular name' ),
					'add_new'               => _x( 'Add New', strtolower( $name ) ),
					'add_new_item'          => __( 'Add New ' . $name ),
					'edit_item'             => __( 'Edit ' . $name ),
					'new_item'              => __( 'New ' . $name ),
					'all_items'             => __( 'All ' . $plural ),
					'view_item'             => __( 'View ' . $name ),
					'search_items'          => __( 'Search ' . $plural ),
					'not_found'             => __( 'No ' . strtolower( $plural ) . ' found'),
					'not_found_in_trash'    => __( 'No ' . strtolower( $plural ) . ' found in Trash'), 
					'parent_item_colon'     => '',
					'menu_name'             => $plural
				),
				
				// Given labels
				$this->post_type_labels
				
			);
			
			// Same principle as the labels. We set some defaults and overwrite them with the given arguments.
			$args = array_merge(
			
				// Default
				array(
					'label'                 => $plural,
					'labels'                => $labels,
					'public'                => true,
					'show_ui'               => true,
					'supports'              => array( 'title', 'editor' ),
					'show_in_nav_menus'     => true,
					'_builtin'              => false,
				),
				
				// Given args
				$this->post_type_args
				
			);
			
			// Register the post type
			register_post_type( $this->post_type_name, $args );
		}
		 
		/* Method to attach the taxonomy to the post type */
		public function add_taxonomy()
		{
			if( ! empty( $name ) )
			{
				// We need to know the post type name, so the new taxonomy can be attached to it.
				$post_type_name = $this->post_type_name;
		 
				// Taxonomy properties
				$taxonomy_name      = strtolower( str_replace( ' ', '_', $name ) );
				$taxonomy_labels    = $labels;
				$taxonomy_args      = $args;
		 
				/* More code coming */
				if( ! taxonomy_exists( $taxonomy_name ) )
				{
					/* Create taxonomy and attach it to the object type (post type) */
					//Capitilize the words and make it plural
					$name       = ucwords( str_replace( '_', ' ', $name ) );
					$plural     = $name . 's';
					 
					// Default labels, overwrite them with the given labels.
					$labels = array_merge(
					 
						// Default
						array(
							'name'                  => _x( $plural, 'taxonomy general name' ),
							'singular_name'         => _x( $name, 'taxonomy singular name' ),
							'search_items'          => __( 'Search ' . $plural ),
							'all_items'             => __( 'All ' . $plural ),
							'parent_item'           => __( 'Parent ' . $name ),
							'parent_item_colon'     => __( 'Parent ' . $name . ':' ),
							'edit_item'             => __( 'Edit ' . $name ),
							'update_item'           => __( 'Update ' . $name ),
							'add_new_item'          => __( 'Add New ' . $name ),
							'new_item_name'         => __( 'New ' . $name . ' Name' ),
							'menu_name'             => __( $name ),
						),
					 
						// Given labels
						$taxonomy_labels
					 
					);
					 
					// Default arguments, overwritten with the given arguments
					$args = array_merge(
					 
						// Default
						array(
							'label'                 => $plural,
							'labels'                => $labels,
							'public'                => true,
							'show_ui'               => true,
							'show_in_nav_menus'     => true,
							'_builtin'              => false,
						),
					 
						// Given
						$taxonomy_args
					 
					);
					 
					// Add the taxonomy to the post type
					add_action( 'init',
						function() use( $taxonomy_name, $post_type_name, $args )
						{
							register_taxonomy( $taxonomy_name, $post_type_name, $args );
						}
					);
				}
				else
				{
					/* The taxonomy already exists. We are going to attach the existing taxonomy to the object type (post type) */
					add_action( 'init',
						function() use( $taxonomy_name, $post_type_name )
						{
							register_taxonomy_for_object_type( $taxonomy_name, $post_type_name );
						}
					);
				}
			}
		}
		 
		/* Attaches meta boxes to the post type */
		public function add_meta_box()
		{
			if( ! empty( $title ) )
			{
				// We need to know the Post Type name again
				$post_type_name = $this->post_type_name;
		 
				// Meta variables
				$box_id         = strtolower( str_replace( ' ', '_', $title ) );
				$box_title      = ucwords( str_replace( '_', ' ', $title ) );
				$box_context    = $context;
				$box_priority   = $priority;
				 
				// Make the fields global
				global $custom_fields;
				$custom_fields[$title] = $fields;
				 
				add_action( 'admin_init',
					function() use( $box_id, $box_title, $post_type_name, $box_context, $box_priority, $fields )
					{
						add_meta_box(
							$box_id,
							$box_title,
							function( $post, $data )
							{
								global $post;
								 
								// Nonce field for some validation
								wp_nonce_field( plugin_basename( __FILE__ ), 'custom_post_type' );
								 
								// Get all inputs from $data
								$custom_fields = $data['args'][0];
								 
								// Get the saved values
								$meta = get_post_custom( $post->ID );
								 
								// Check the array and loop through it
								if( ! empty( $custom_fields ) )
								{
									/* Loop through $custom_fields */
									foreach( $custom_fields as $label => $type )
									{
										$field_id_name  = strtolower( str_replace( ' ', '_', $data['id'] ) ) . '_' . strtolower( str_replace( ' ', '_', $label ) );
										 
										echo '<label for="' . $field_id_name . '">' . $label . '</label><input type="text" name="custom_meta[' . $field_id_name . ']" id="' . $field_id_name . '" value="' . $meta[$field_id_name][0] . '" />';
									}
								}
							 
							},
							$post_type_name,
							$box_context,
							$box_priority,
							array( $fields )
						);
					}
				);
			} 
		}
		public static function beautify( $string )
		{
			return ucwords( str_replace( '_', ' ', $string ) );
		}
 
		public static function uglify( $string )
		{
			return strtolower( str_replace( ' ', '_', $string ) );
		}
		
		function theForm( $atts ){
			
			ob_start(); ?> 
			
			<div id="responseform">
			<?php echo $response; ?>
			<form action="<?php the_permalink(); ?>" method="post">
			<p><label for="mentorly_first_name">First Name<br><input type="text" name="mentorly_first_name" value="<?php echo esc_attr($_POST['mentorly_first_name']); ?>"></label></p>
			<p><label for="mentorly_last_name">Last Name<br><input type="text" name="mentorly_last_name" value="<?php echo esc_attr($_POST['mentorly_last_name']); ?>"></label></p>
			<p><label for="mentorly_email">Email Address<br><input type="text" name="mentorly_email" value="<?php echo esc_attr($_POST['mentorly_email']); ?>"></label></p>
			<p><label for="mentorly_phone">Phone<br><input type="text" name="mentorly_phone" value="<?php echo esc_attr($_POST['mentorly_phone']); ?>"></label></p>
			<p><label for="mentorly_tz">Your Time Zone<br><?php echo timezone_dropdown($name, $current_value); ?></label></p>
			<p><label for="mentorly_current_role">Current Role<br><input type="text" name="mentorly_current_role" value="<?php echo esc_attr($_POST['mentorly_current_role']); ?>"></label></p>
			<p><label for="mentorly_organization">Organization<br><input type="text" name="mentorly_organization" value="<?php echo esc_attr($_POST['mentorly_organization']); ?>"></label></p>
			<p><label for="mentorly_years_in">Years in Role<br><input type="text" name="mentorly_years_in" value="<?php echo esc_attr($_POST['mentorly_years_in']); ?>"></label>
			<p><label for="mentorly_linkedin">URL for Linkedin Profile<br><input type="text" name="mentorly_linkedin" value="<?php echo esc_attr($_POST['mentorly_linkedin']); ?>"></label></p>
			<p><label for="mentorly_linkedin">Phone<br><input type="text" name="mentorly_linkedin" value="<?php echo esc_attr($_POST['mentorly_linkedin']); ?>"></label></p>
			<p><label for="mentorly_shortbio">Short Bio<br><textarea name="mentorly_shortbio" value="<?php echo esc_attr($_POST['mentorly_shortbio']); ?>"></textarea></label></p>
			<p><label for="mentorly_intensity">Intensity of Mentoring<br><select name="mentorly_intensity">
			<?php 
				$current_selection = esc_attr($_POST['mentorly_intensity']);
				$intensity_array = array("Weekly" => __("Weekly", 'mentorly_plugin'),
										 "Monthly" => __("Monthly", 'mentorly_plugin'),
										 "Quarterly" => __("Quarterly", 'mentorly_plugin'),
										 "Any" => __("Any", 'mentorly_plugin'));
				foreach ($intensity_array as $item) {
					if ($item == $current_selection) {
						echo "<option selected>" . $item . "</option>";
					} else {
						echo "<option>" . $item . "</option>";
					}
				}
			?>
			</select></label></p>
			<p><label for="mentorly_length">Length of Mentoring<br><select name="mentorly_length">
			<?php 
				$current_selection = esc_attr($_POST['mentorly_length']);
				$length_array = array("3" => __("3 Months", 'mentorly_plugin'),
									  "6" => __("6 Months", 'mentorly_plugin'),
									  "9" => __("9 Months", 'mentorly_plugin'),
									  "12" => __("12 Months", 'mentorly_plugin'));
				foreach ($intensity_array as $item) {
					if ($item == $current_selection) {
						echo "<option selected>" . $item . "</option>";
					} else {
						echo "<option>" . $item . "</option>";
					}
				}
			?>
			</select></label></p>
			
			<p><label for="mentorly_mentee_goals">What are your goals in seeking a mentor?<br><textarea name="mentorly_mentee_goals" value="<?php echo esc_attr($_POST['mentorly_mentee_goals']); ?>"></textarea></label></p>
			
			<input type="hidden" name="submitted" value="1">
			<p><input type="submit"></p>
		    </form>
			</div>
			<?php
			return ob_get_clean();
		}
		 
		/* Listens for when the post type being saved */
		public function save()
		{
			// Need the post type name again
			$post_type_name = $this->post_type_name;
			
			add_action( 'save_post',
				function() use( $post_type_name )
				{
					// Deny the WordPress autosave function
					if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
			
					if ( ! wp_verify_nonce( $_POST['custom_post_type'], plugin_basename(__FILE__) ) ) return;
				
					global $post;
					
					if( isset( $_POST ) && isset( $post->ID ) && get_post_type( $post->ID ) == $post_type_name )
					{
						global $custom_fields;
						
						// Loop through each meta box
						foreach( $custom_fields as $title => $fields )
						{
							// Loop through all fields
							foreach( $fields as $label => $type )
							{
								$field_id_name  = strtolower( str_replace( ' ', '_', $title ) ) . '_' . strtolower( str_replace( ' ', '_', $label ) );
								
								update_post_meta( $post->ID, $field_id_name, $_POST['custom_meta'][$field_id_name] );
							}
						
						}
					}
				}
			);
		}
	}
?>

