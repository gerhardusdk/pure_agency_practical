<?php

function theme_styles()
{
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');

	wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css');

	wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
}
add_action('wp_enqueue_scripts', 'theme_styles');


function theme_scripts()
{
	wp_enqueue_script('main', get_template_directory_uri() . '/js/jquery.min.js');

	wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js');

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js');

	wp_enqueue_script('font-awesome', get_template_directory_uri() . '/js/fontawesome.min.js');
}
add_action('wp_enqueue_scripts', 'theme_scripts');

add_theme_support('post-thumbnails');




function getSocialNetworks()
{

	$query = new WP_Query(array('post_type' => 'our-socials', 'posts_per_page' => 999));

	if ($query->have_posts()) :

		while ($query->have_posts()) : $query->the_post();

			$social_network = strip_tags(get_post_meta(get_the_id(), 'social_network', true));
			$social_network_url = strip_tags(get_post_meta(get_the_id(), 'social_network_url', true));

			echo '<li><a target="self" href="' . $social_network_url . '"><i class="fa fa-' . $social_network . '"></i></a></li>';

		endwhile;

		wp_reset_postdata();
	else :
		echo "<h2>No social media icons posted at this time!</h2>";
	endif;
}



function getFeaturedBanners()
{

	$query = new WP_Query(array('post_type' => 'featured-banners', 'posts_per_page' => 999));

	if ($query->have_posts()) :

		while ($query->have_posts()) : $query->the_post();

			$banner_overview = strip_tags(get_post_meta(get_the_id(), 'banner_overview', true));
			$banner_image = get_the_post_thumbnail_url();

			echo "<!-- Single Hero Slide -->
<div class='hero-slides' style='background-image:url(" . $banner_image . ");'>
	<div class='hero-slide-caption'>
		<div class='hero-slide-container'>
			<h2>" . $banner_overview . "</h2>
		</div>
	</div>
</div>
<!-- Single Hero Slide Ends -->";

		endwhile;

		wp_reset_postdata();
	else :
		echo "<h2>No banners posted at this time!</h2>";
	endif;
}


function getFAQs()
{

	$query = new WP_Query(array('post_type' => 'our-faqs', 'posts_per_page' => 3));

	if ($query->have_posts()) :

		while ($query->have_posts()) : $query->the_post();

			$faqs_heading = strip_tags(get_post_meta(get_the_id(), 'faqs_name', true));
			$faqs_content = strip_tags(get_post_meta(get_the_id(), 'faqs_content', true));

			echo "<!-- Accordion Start Here -->
		<div class='faq-accordion'>
			<div class='faq-accordion-header'>
				<p>" . $faqs_heading . "</p>
				<i class='fa fa-chevron-down' aria-hidden='true'></i>
			</div>
			<div class='faq-accordion-content'>
				<p>" . $faqs_content . "</p>
			</div>
		</div>
		<!-- Accordion End Here -->";

		endwhile;

		wp_reset_postdata();
	else :
		echo "<h2>No FAQs posted at this time!</h2>";
	endif;
}

add_action('wp_enqueue_scripts', 'apollo_theme_enqueue_script_style');

function apollo_theme_enqueue_script_style()
{

	wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/main.js', array('jquery'));
	// Localize the script with new data
	wp_localize_script('custom-script', 'ajax_posts', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'noposts' => __('No older posts found', 'apollo-noposts'),
	));
}

add_action('wp_ajax_nopriv_apollo_load_more_post_ajax', 'apollo_load_more_posts_ajax');
add_action('wp_ajax_apollo_load_more_post_ajax', 'apollo_load_more_posts_ajax');

function apollo_load_more_posts_ajax()
{

	$posts_per_page = (isset($_POST["posts_per_page"])) ? $_POST["posts_per_page"] : 3;
	$page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 2;

	$args = array(
		'post_type' => 'our-faqs',
		'posts_per_page' => $posts_per_page,
		'post_status' => 'publish',
		'paged'    => $page,
	);

	$the_query = new WP_Query($args);

	$html = '';
	ob_start();

	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();

			$faqs_heading = strip_tags(get_post_meta(get_the_id(), 'faqs_name', true));
			$faqs_content = strip_tags(get_post_meta(get_the_id(), 'faqs_content', true));

			echo "<!-- Accordion Start Here -->
		<div class='faq-accordion'>
			<div class='faq-accordion-header'>
				<p>" . $faqs_heading . "</p>
				<i class='fa fa-chevron-down' aria-hidden='true'></i>
			</div>
			<div class='faq-accordion-content'>
				<p>" . $faqs_content . "</p>
			</div>
		</div>
		<!-- Accordion End Here -->";
		}
	}

	wp_reset_postdata();
	$html .= ob_get_clean();

	wp_send_json(array('html' => $html));
}
