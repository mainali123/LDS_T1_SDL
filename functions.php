<?php

function custom_title_dynamic() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
}

add_action( 'after_setup_theme', 'custom_title_dynamic' );

function custom_enqueue_styles() {
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '1.0.0' );
	wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/assets/css/icomoon.css', array(), '1.0.0' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '1.0.0' );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/css/flexslider.css', array(), '1.0.0' );
	wp_enqueue_style( 'owlcarousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '1.0.0' );
	wp_enqueue_style( 'owltheme', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css', array(), '1.0.0' );
	wp_enqueue_style( 'customStyle', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0' );
}

function custom_enqueue_scripts(): void {
	// Enqueue jQuery from WordPress
	wp_enqueue_script( 'jquery' );

	// Enqueue other scripts that depend on jQuery
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/assets/js/respond.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'jqueryeasingq', get_template_directory_uri() . '/assets/js/jquery.easing.1.3.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'jquerywaypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'jqueryflexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'mainScript', get_template_directory_uri() . '/assets/js/main.js', array(
		'jquery',
		'jqueryeasingq',
		'jquerywaypoints',
		'jqueryflexslider'
	), null, true );

	// Output inline script in footer to ensure jQuery is loaded
	add_action('wp_footer', function() {
		echo '<script>jQuery(document).ready(function() { console.log(jQuery.fn.jquery); });</script>';
	});
}

// Hook the function to wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'custom_enqueue_scripts' );


function custom_enqueue_ajax_scripts(): void {
	wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/assets/js/ajax-script.js', array( 'mainScript' ), '1.0.0', true );
	wp_localize_script( 'ajax-script', 'ajax_params', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	) );
}

add_action( 'wp_enqueue_scripts', 'custom_enqueue_ajax_scripts', 2 );
add_action( 'wp_enqueue_scripts', 'custom_enqueue_styles', 1 );


function custom_menues() {
	$location = array(
		'primary' => 'Top Navbar',
		'footer'  => 'Footer Menu Items'
	);

	register_nav_menus( $location );
}

add_action( 'init', 'custom_menues' );

// Register custom post type
function create_blog_post_type() {
	$labels = array(
		'name'               => _x( 'Blogs', 'Post Type General Name', 'text_domain' ),
		'singular_name'      => _x( 'Blog', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'          => _x( 'Blogs', 'Admin Menu text', 'text_domain' ),
		'name_admin_bar'     => _x( 'Blog', 'Add New on Tool', 'text_domain' ),
		'add_new'            => __( 'Add Blog', 'text_domain' ),
		'add_new_item'       => __( 'Add New Blog', 'text_domain' ),
		'new_item'           => __( 'New Blog', 'text_domain' ),
		'edit_item'          => __( 'Edit Blog', 'text_domain' ),
		'view_item'          => __( 'View Blog', 'text_domain' ),
		'all_items'          => __( 'All Blogs', 'text_domain' ),
		'search_items'       => __( 'Search Blog', 'text_domain' ),
		'not_found'          => __( 'Not found', 'text_domain' ),
		'not_found_in_trash' => __( 'Not found in trash', 'text_domain' ),
	);

	$args = array(
		'labels'           => $labels,
		'public'           => true,
		'public_queryable' => true,
		'show_ui'          => true,
		'show_in_menu'     => true,
		'query_var'        => true,
		'rewrite'          => array( 'slug' => 'blog' ),
		'capability_type'  => 'post',
		'has_archive'      => true,
		'hierarchical'     => false,
		'menu_position'    => null,
		'supports'         => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
	);
	register_post_type( 'blog', $args );
}

add_action( 'init', 'create_blog_post_type' );


// Register custom taxonomy
function create_blog_taxonomy() {
	$labels = array(
		'name'          => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name' => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
		'search_items'  => __( 'Search Categories', 'text_domain' ),
		'all_items'     => __( 'All Categories', 'text_domain' ),
		'parent_item'   => __( 'Parent Category', 'text_domain' ),
		'edit_item'     => __( 'Edit Category', 'text_domain' ),
		'update_item'   => __( 'Update Category', 'text_domain' ),
		'add_new_item'  => __( 'Add New Category', 'text_domain' ),
		'new_item_name' => __( 'New Category Name', 'text_domain' ),
		'menu_name'     => __( 'Category', 'text_domain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'category' ),
	);
	register_taxonomy( 'category', array( 'blog' ), $args );
}

add_action( 'init', 'create_blog_taxonomy' );

// Add meta box
function custom_add_blog_meta_box() {
	add_meta_box(
		'blog_meta_box',
		'Blog Details',
		'display_blog_meta_box',
		'blog',
		'normal',
		'high'
	);
}

add_action( 'add_meta_boxes', 'custom_add_blog_meta_box' );

// Display meta box

function display_blog_meta_box( $post ) {
	wp_nonce_field( 'save_blog_meta_box_data', 'blog_meta_box_nonce' );
	$blog_author = get_post_meta( $post->ID, 'blog_author', true );
	$blog_rating = get_post_meta( $post->ID, 'blog_rating', true );
	?>
    <label for="blog_author">Author:</label>
    <input type="text" name="blog_author" id="blog_author" value="<?= esc_attr( $blog_author ); ?>"/>
    <br> <br>
    <label for="blog_rating">Rating:</label>
    <input type="number" name="blog_rating" id="blog_rating" value="<?= esc_attr( $blog_rating ); ?>" min="1" max="5"/>
	<?php
}

// Save meta box data
function save_blog_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['blog_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['blog_meta_box_nonce'], 'save_blog_meta_box_data' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && 'blog' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	$blog_author = sanitize_text_field( $_POST['blog_author'] );
	$blog_rating = intval( $_POST['blog_rating'] );

	update_post_meta( $post_id, 'blog_author', $blog_author );
	update_post_meta( $post_id, 'blog_rating', $blog_rating );
}

add_action( 'save_post', 'save_blog_meta_box_data' );

function filter_custom_posts() {
	$term = isset( $_POST['term'] ) ? sanitize_text_field( $_POST['term'] ) : '';

	$args = array(
		'post_type' => 'blog',
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $term,
			),
		),
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
		}
	} else {
		echo '<p>No blogs found.</p>';
	}
	wp_die();
}

add_action( 'wp_ajax_filter_custom_posts', 'filter_custom_posts' );
add_action( 'wp_ajax_nopriv_filter_custom_posts', 'filter_custom_posts' );

function load_more_posts() {
	$args = array(
		'post_type'      => 'blog',
		'posts_per_page' => 3,
		'paged'          => $_POST['page']
	);

	$blog_query = new WP_Query( $args );

	if ( $blog_query->have_posts() ) {
		while ( $blog_query->have_posts() ) {
			$blog_query->the_post();
			?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php
		}
	}
	wp_reset_postdata();
}

add_action( 'wp_ajax_load_more_posts', 'load_more_posts' );
add_action( 'wp_ajax_nopriv_load_more_posts', 'load_more_posts' );