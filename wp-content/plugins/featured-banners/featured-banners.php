<?php

/**
 * Plugin Name: Apollo Shutters Featured Banners
 * Plugin URI: http://www.pureagency.co.uk
 * Description: Featured Banners Plugin
 * Version: 2023
 * Author: Gerhard de Klerk
 * Author URI: mailto:gerhard.de.klerk1987@gmail.com
 **/


add_filter('wp_insert_post_data', 'my_add_ul_class_on_insert_banners');
function my_add_ul_class_on_insert_banners($postarr)
{
    $postarr['post_content'] = str_replace('<ul>', '<ul class="ul">', $postarr['post_content']);
    return $postarr;
}



// Custom Courses Post Type
function register_banners_posttype()
{

    $labels = array(
        'name' => _x('Featured Banners', 'fbanners'),
        'singular_name' => _x('Featured Banner', 'fbanner'),
        'add_new' => _x('Add New Featured Banners', 'fbanners'),
        'add_new_item' => _x('Add New Featured Banners', 'fbanners'),
        'edit_item' => _x('Edit Featured Banners', 'fbanners'),
        'new_item' => _x('New Featured Banners', 'fbanners'),
        'view_item' => _x('View Featured Banners', 'fbanners'),
        'search_items' => _x('Search Featured Banners', 'fbanners'),
        'not_found' => _x('No Featured Banners found', 'fbanners'),
        'not_found_in_trash' => _x('No Featured Banners found in Trash', 'fbanners'),
        'parent_item_colon' => _x('Parent Banners:', 'fbanners'),
        'menu_name' => _x('Apollo Shutters Banners', 'fbanners'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Featured Banners filterable by category',
        'supports' => array('title', 'thumbnail', 'revisions', 'media'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-gallery',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type('featured-banners', $args);
    //flush_rewrite_rules();
}


add_action('init', 'register_banners_posttype');


function my_admin_banners()
{
    add_meta_box(
        'banners_meta_box',
        'Banners Information',
        'display_banners_meta_box',
        'featured-banners',
        'normal',
        'high'
    );
}
add_action('admin_init', 'my_admin_banners');


function display_banners_meta_box($banners)
{
    $banner_overview = get_post_meta($banners->ID, 'banner_overview', true);
?>

    <table width="100%">


        <h3 style="font-size:16px; font-weight: bold; float:left;">Description on Banner</h3>

        <hr>
        <tr>
            <td width="100%">
                <?php
                $field_value1 = get_post_meta($banners->ID, 'banner_overview', false);
                wp_editor($banner_overview, 'banner_overview', array('textarea_rows' => '8'));
                ?>
            </td>
        </tr>
    </table>




<?php
}


function add_banners_fields($banners_id, $banners)
{
    // Check post type for Students
    if ($banners->post_type == 'featured-banners') {
        // Store data in post meta table if present in post data


        if (isset($_POST['banner_overview']) && $_POST['banner_overview'] != '') {
            update_post_meta($banners_id, 'banner_overview', $_POST['banner_overview']);
        }
    }
}
add_action('save_post', 'add_banners_fields', 10, 2);




function update_edit_form_banners()
{
    echo ' enctype="multipart/form-data"';
}

add_action('post_edit_form_tag', 'update_edit_form_banners'); ?>