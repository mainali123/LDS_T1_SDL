<?php
$dm_baseurl = get_template_directory_uri() . '/';
//?>


<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by FreeHTML5.co"/>
    <meta name="keywords"
          content="free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive"/>
    <meta name="author" content="FreeHTML5.co"/>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700" rel="stylesheet">

	<?php wp_head(); ?>
</head>
<body>


<div id="fh5co-page">
	<?php get_header(); ?>

    <div class="container" id="posts-container">

		<?php

		//        if (function_exists( 'the_custom_logo')){
		//            the_custom_logo();
		//        }

		//		if ( have_posts() ) {
		//			while ( have_posts() ) {
		//                    the_post();
		//
		//                    the_title();
		//                    the_content();
		//			}
		//		}
		?>

        <label for="filter">Filter by Category:</label>
        <select id="filter">
            <option value="" disabled selected>Select a category...</option>
			<?php
			$categories = get_terms( array(
				'taxonomy'   => 'category',
				'hide_empty' => false,
			) );
			foreach ( $categories as $category ) {
				echo '<option value="' . esc_attr( $category->slug ) . '">' . esc_html( $category->name ) . '</option>';
			}
			?>
        </select>

        <div class="blogs-container" id="blogs-container">
			<?php
			$args = array(
				'post_type'      => 'blog',
				'posts_per_page' => 3,
				'paged'          => 1
			);

			$blog_query = new WP_Query( $args );

			if ( $blog_query->have_posts() ) {
				while ( $blog_query->have_posts() ) {
					$blog_query->the_post();
					?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php
				}
			} else {
				echo '<p>No blog posts found.</p>';
			}
			wp_reset_postdata();
			?>
        </div>
    </div>
    <button id="load-more">Load More</button>
	<?php get_footer(); ?>
</div>

<?php wp_footer(); ?>

</body>
</html>

