<?php	

/*
To add custom PHP functions to the theme, create a new 'custom-functions.php' file in the theme folder. 
They will be added to the theme automatically.
*/

/* 	Enqueue Stylesheets and Scripts
/***************************************************************************/
add_action('wp_enqueue_scripts', 'themify_theme_enqueue_scripts');
function themify_theme_enqueue_scripts(){

	///////////////////
	//Enqueue styles
	///////////////////
	
	//Themify base styling
	wp_enqueue_style( 'theme-style', get_bloginfo('stylesheet_url'), array(), wp_get_theme()->display('Version'));
	
	//User stylesheet
	if(is_file(TEMPLATEPATH . "/custom_style.css"))
		wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/custom_style.css');

	///////////////////
	//Enqueue scripts
	///////////////////
	
	//Themify internal scripts
	wp_enqueue_script( 'theme-script',	get_template_directory_uri() . '/js/themify.script.js', array('jquery'), false, true );
	
	//WordPress internal script to move the comment box to the right place when replying to a user
	if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' );
	
}

/**
 * Add spacing on mobile
 * @package themify
 */
function themify_viewport_spacing(){
	echo "\n".'<meta name="viewport" content="width=1024" />'."\n";
}
add_action( 'wp_head', 'themify_viewport_spacing' );

/**
 * Make IE behave like a standards-compliant browser 
 */
function themify_ie_standards_compliant() {
	echo "\n".'<!--[if lt IE 9]>
	<script src="http://s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
	<![endif]-->'."\n";
}
add_action('wp_head', 'themify_ie_standards_compliant');

/* Custom Write Panels
/***************************************************************************/

	///////////////////////////////////////
	// Setup Write Panel Options
	///////////////////////////////////////
	
	// Post Meta Box Options
	$post_meta_box_options = array(
	// Layout
	array(
		  "name" 		=> "layout",	
		  "title" 		=> __('Single Layout', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "layout",			
		  "meta"		=> array(
		  						array("value" => "default", "img" => "images/layout-icons/default.png", "selected" => true),

								 array("value" => "sidebar1", 	"img" => "images/layout-icons/sidebar1.png"),
								 array("value" => "sidebar1 sidebar-left", 	"img" => "images/layout-icons/sidebar1-left.png"),
								 array("value" => "sidebar-none",	 	"img" => "images/layout-icons/sidebar-none.png")
								 )			
		),
   	// Post Image
	array(
		  "name" 		=> "post_image",
		  "title" 		=> __('Featured Image', 'themify'),
		  "description" => '',
		  "type" 		=> "image",
		  "meta"		=> array()
		),
   	// Featured Image Size
	array(
		'name'	=>	'feature_size',
		'title'	=>	__('Image Size', 'themify'),
		'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="admin.php?page=regenerate-thumbnails">Regenerated</a>', 'themify'),
		'type'		 =>	'featimgdropdown'
		),
	// Image Width
	array(
		  "name" 		=> "image_width",	
		  "title" 		=> __('Image Width', 'themify'), 
		  "description" => "", 				
		  "type" 		=> "textbox",			
		  "meta"		=> array("size"=>"small")			
		),
	// Image Height
	array(
		  "name" 		=> "image_height",	
		  "title" 		=> __('Image Height', 'themify'), 
		  "description" => __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify'), 				
		  "type" 		=> "textbox",			
		  "meta"		=> array("size"=>"small")			
		),
	// Hide Post Title
	array(
		  "name" 		=> "hide_post_title",	
		  "title" 		=> __('Hide Post Title', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('Yes', 'themify')),
								 array("value" => "no",	'name' => __('No', 'themify'))
								 )			
		),
	// Unlink Post Title
	array(
		  "name" 		=> "unlink_post_title",	
		  "title" 		=> __('Unlink Post Title', 'themify'), 	
		  "description" => __('Unlink post title (it will display the post title without link)', 'themify'), 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('Yes', 'themify')),
								 array("value" => "no",	'name' => __('No', 'themify'))
								 )			
		),

	// Hide Post Meta
	array(
		  "name" 		=> "hide_post_meta",	
		  "title" 		=> __('Hide Post Meta', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('Yes', 'themify')),
								 array("value" => "no",	'name' => __('No', 'themify'))
								 )			
		),
	// Hide Post Date
	array(
		  "name" 		=> "hide_post_date",	
		  "title" 		=> __('Hide Post Date', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('Yes', 'themify')),
								 array("value" => "no",	'name' => __('No', 'themify'))
								 )			
		),
	// Hide Post Image
	array(
		  "name" 		=> "hide_post_image",	
		  "title" 		=> __('Hide Featured Image', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('Yes', 'themify')),
								 array("value" => "no",	'name' => __('No', 'themify'))
								 )			
		),
		// Unlink Post Image
	array(
		  "name" 		=> "unlink_post_image",	
		  "title" 		=> __('Unlink Featured Image', 'themify'), 	
		  "description" => __('Display the Featured Image without link', 'themify'), 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('Yes', 'themify')),
								 array("value" => "no",	'name' => __('No', 'themify'))
								 )			
		),
	// External Link
	array(
		  "name" 		=> "external_link",	
		  "title" 		=> __('External Link', 'themify'), 	
		  "description" => __('Link Featured Image to external URL', 'themify'), 				
		  "type" 		=> "textbox",			
		  "meta"		=> array()			
		)
	);
								
	
	// Page Meta Box Options
	$page_meta_box_options = array(
	  	// Page Layout
		array(
			  "name" 		=> "page_layout",
			  "title"		=> __('Sidebar Option', 'themify'),
			  "description"	=> "",
			  "type"		=> "layout",
			  "meta"		=> array(
				array("value" => "default", "img" => "images/layout-icons/default.png", "selected" => true),
				array("value" => "sidebar1", 	"img" => "images/layout-icons/sidebar1.png"),
				array("value" => "sidebar1 sidebar-left", 	"img" => "images/layout-icons/sidebar1-left.png"),
				array("value" => "sidebar-none",	 	"img" => "images/layout-icons/sidebar-none.png")
				)
			),
		// Hide page title
		array(
			  "name" 		=> "hide_page_title",
			  "title"		=> __('Hide Page Title', 'themify'),
			  "description"	=> "",
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									array("value" => "yes", 'name' => __('Yes', 'themify')),
									array("value" => "no",	'name' => __('No', 'themify'))
								)	
			),
	   // Query Category
		array(
			  "name" 		=> "query_category",
			  "title"		=> __('Query Category', 'themify'),
			  "description"	=> __('Select a category or enter multiple category IDs (eg. 2,5,6). Enter 0 to display all category.', 'themify'),
			  "type"		=> "query_category",
			  "meta"		=> array()
			),
		// Section Categories
		array(
			  "name" 		=> "section_categories",	
			  "title" 		=> __('Section Categories', 'themify'), 	
			  "description" => __('Display multiple query categories separately', 'themify'), 				
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									array("value" => "yes", 'name' => __('Yes', 'themify')),
									array("value" => "no",	'name' => __('No', 'themify'))
								)			
			),
		// Post Layout
		array(
			  "name" 		=> "layout",
			  "title"		=> __('Query Post Layout', 'themify'),
			  "description"	=> "",
			  "type"		=> "layout",
			  "meta"		=> array(
					array("value" => "list-post", "img" => "images/layout-icons/list-post.png", "selected" => true),
					array("value" => "grid4", "img" => "images/layout-icons/grid4.png"),
					array("value" => "grid3", "img" => "images/layout-icons/grid3.png"),
					array("value" => "grid2", "img" => "images/layout-icons/grid2.png"),
					array("value" => "list-large-image", "img" => "images/layout-icons/list-large-image.png"),
					array("value" => "list-thumb-image", "img" => "images/layout-icons/list-thumb-image.png"),
					array("value" => "grid2-thumb", "img" => "images/layout-icons/grid2-thumb.png")
				)
			),
		// Posts Per Page
		array(
			  "name" 		=> "posts_per_page",
			  "title"		=> __('Posts per page', 'themify'),
			  "description"	=> "",
			  "type"		=> "textbox",
			  "meta"		=> array("size" => "small")
			),
		
		// Display Content
		array(
			  "name" 		=> "display_content",
			  "title"		=> __('Display Content', 'themify'),
			  "description"	=> "",
			  "type"		=> "dropdown",
			  "meta"		=> array(
					array('name' => __('Full Content', 'themify'),"value"=>"content","selected"=>true),
					array('name' => __('Excerpt', 'themify'),"value"=>"excerpt"),
					array('name' => __('None', 'themify'),"value"=>"none")
				)
			),
		// Featured Image Size
		array(
			'name'	=>	'feature_size_page',
			'title'	=>	__('Image Size', 'themify'),
			'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="admin.php?page=regenerate-thumbnails">Regenerated</a>', 'themify'),
			'type'		 =>	'featimgdropdown'
			),
		// Image Width
		array(
			  "name" 		=> "image_width",	
			  "title" 		=> __('Image Width', 'themify'), 
			  "description" => "", 				
			  "type" 		=> "textbox",			
			  "meta"		=> array("size"=>"small")			
			),
		// Image Height
		array(
			  "name" 		=> "image_height",	
			  "title" 		=> __('Image Height', 'themify'), 
			  "description" => __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify'), 				
			  "type" 		=> "textbox",			
			  "meta"		=> array("size"=>"small")			
			),
		// Hide Title
		array(
			  "name" 		=> "hide_title",
			  "title"		=> __('Hide Post Title', 'themify'),
			  "description"	=> "",
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									array("value" => "yes", 'name' => __('Yes', 'themify')),
									array("value" => "no",	'name' => __('No', 'themify'))
								)
			),
		// Unlink Post Title
		array(
			  "name" 		=> "unlink_title",	
			  "title" 		=> __('Unlink Post Title', 'themify'), 	
			  "description" => __('Unlink post title (it will display the post title without link)', 'themify'), 				
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									 array("value" => "yes", 'name' => __('Yes', 'themify')),
									 array("value" => "no",	'name' => __('No', 'themify'))
									 )			
			),
		// Hide Post Date
		array(
			  "name" 		=> "hide_date",
			  "title"		=> __('Hide Post Date', 'themify'),
			  "description"	=> "",
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									 array("value" => "yes", 'name' => __('Yes', 'themify')),
									 array("value" => "no",	'name' => __('No', 'themify'))
									 )
			),
		// Hide Post Meta
		array(
			  "name" 		=> "hide_meta",
			  "title"		=> __('Hide Post Meta', 'themify'),
			  "description"	=> "",
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									 array("value" => "yes", 'name' => __('Yes', 'themify')),
									 array("value" => "no",	'name' => __('No', 'themify'))
									 )
			),
		// Hide Post Image
		array(
			  "name" 		=> "hide_image",	
			  "title" 		=> __('Hide Featured Image', 'themify'), 	
			  "description" => "", 				
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									 array("value" => "yes", 'name' => __('Yes', 'themify')),
									 array("value" => "no",	'name' => __('No', 'themify'))
									 )			
			),
		// Unlink Post Image
		array(
			  "name" 		=> "unlink_image",	
			  "title" 		=> __('Unlink Featured Image', 'themify'), 	
			  "description" => __('Display the Featured Image without link', 'themify'), 				
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									 array("value" => "yes", 'name' => __('Yes', 'themify')),
									 array("value" => "no",	'name' => __('No', 'themify'))
									 )			
			),
		// Page Navigation Visibility
		array(
			  "name" 		=> "hide_navigation",
			  "title"		=> __('Hide Page Navigation', 'themify'),
			  "description"	=> "",
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									 array("value" => "yes", 'name' => __('Yes', 'themify')),
									 array("value" => "no",	'name' => __('No', 'themify'))
									 )
			)
		
	);
								 
	///////////////////////////////////////
	// Build Write Panels
	///////////////////////////////////////
	themify_build_write_panels(array(
		array(
			 "name"		=> __('Post Options', 'themify'),			// Name displayed in box
			 "options"	=> $post_meta_box_options, 	// Field options
			 "pages"	=> "post"					// Pages to show write panel
			 ),
		array(
			 "name"		=> __('Page Options', 'themify'),	
			 "options"	=> $page_meta_box_options, 		
			 "pages"	=> "page"
			 )
	)
								);
	
/* 	Custom Functions
/***************************************************************************/	
	
	///////////////////////////////////////
	// Enable WordPress feature image
	///////////////////////////////////////
	add_theme_support( 'post-thumbnails' );
	remove_post_type_support( 'page', 'thumbnail' );
	
	// Register Custom Menu Function
	function themify_register_custom_nav() {
		if (function_exists('register_nav_menus')) {
			register_nav_menus( array(
				'main-nav' => __( 'Main Navigation', 'themify' ),
			) );
		}
	}
	
	// Register Custom Menu Function - Action
	add_action('init', 'themify_register_custom_nav');
	
	// Default Main Nav Function
	function themify_default_main_nav() {
		echo '<ul id="main-nav" class="main-nav clearfix">';
		wp_list_pages('title_li=');
		echo '</ul>';
	}

	// Register Sidebars
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => __('Sidebar', 'themify'),
			'id' => 'sidebar-main',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Social Widget', 'themify'),
			'id' => 'social-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<strong>',
			'after_title' => '</strong>',
		));
	}

	// Footer Sidebars
	if ( function_exists('register_sidebar') ) {
		$data = themify_get_data();
		$columns = array('footerwidget-4col' 			=> 4,
						 'footerwidget-3col'			=> 3,
						 'footerwidget-2col' 			=> 2,
						 'footerwidget-1col' 			=> 1,
						 'none'			 			=> 0, );
		$option = ($data['setting-footer_widgets'] == "" || !isset($data['setting-footer_widgets'])) ?  "footerwidget-3col" : $data['setting-footer_widgets'];
		for($x=1;$x<=$columns[$option];$x++){
			register_sidebar(array(
				'name' => __('Footer Widget', 'themify') . ' ' .$x,
				'id' => 'footer-widget-'.$x,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widgettitle">',
				'after_title' => '</h4>',
			));			
		}
	}

	// Custom Theme Comment
	function themify_theme_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; 
	   ?>
	   <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<p class="comment-author">
				<?php echo get_avatar($comment,$size='54'); ?>
				<?php printf('<cite>%s</cite>', get_comment_author_link()) ?><br />
				<small class="comment-time"><strong><?php comment_date('M d, Y'); ?></strong> @ <?php comment_time('H:i:s'); ?><?php edit_comment_link( __('Edit', 'themify'),' [',']') ?></small>
			</p>
			<div class="commententry">
				<?php if ($comment->comment_approved == '0') : ?>
				<p><em><?php _e('Your comment is awaiting moderation.', 'themify') ?></em></p>
				<?php endif; ?>
			
				<?php comment_text() ?>
			</div>
			<p class="reply">
			<?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'reply_text' => __( 'Reply' , 'themify' ), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</p>
		<?php
	}

	// Themify Theme Key
	add_filter('themify_theme_key', create_function('$k', "return '4avsftmg4o1qknrggvcfe9mrc27ilw9jm';"));

?>