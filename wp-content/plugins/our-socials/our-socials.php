<?php

/**
 * Plugin Name: Apollo Shutters Social Media Networks
 * Plugin URI: http://www.pureagency.co.uk
 * Description: Featured Social Media Networks Plugin
 * Version: 2023
 * Author: Gerhard de Klerk
 * Author URI: mailto:gerhard.de.klerk1987@gmail.com
 **/

add_filter('wp_insert_post_data', 'my_add_ul_class_on_insert_socials');
function my_add_ul_class_on_insert_socials($postarr)
{
    $postarr['post_content'] = str_replace('<ul>', '<ul class="ul">', $postarr['post_content']);
    return $postarr;
}

function register_socials_posttype()
{

    $labels = array(
        'name' => _x('Socials', 'fsocials'),
        'singular_name' => _x('Social', 'fsocial'),
        'add_new' => _x('Add New Social', 'fsocials'),
        'add_new_item' => _x('Add New Socials', 'fsocials'),
        'edit_item' => _x('Edit Socials', 'fsocials'),
        'new_item' => _x('New Socials', 'fsocials'),
        'view_item' => _x('View Socials', 'fsocials'),
        'search_items' => _x('Search Socials', 'fsocials'),
        'not_found' => _x('No Latest Socials found', 'fsocials'),
        'not_found_in_trash' => _x('No Socials found in Trash', 'fsocials'),
        'parent_item_colon' => _x('Socials:', 'fsocials'),
        'menu_name' => _x('Apollo Shutters Social Networks', 'fsocials'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Our Social Media Networks',
        'supports' => array('title', 'thumbnail', 'revisions', 'media'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type('our-socials', $args);
    //flush_rewrite_rules();
}

// Initialize the Socials Post Type
add_action('init', 'register_socials_posttype');


function my_admin_socials()
{
    add_meta_box(
        'socials_meta_box',
        'Social Media Information',
        'display_socials_meta_box',
        'our-socials',
        'normal',
        'high'
    );
}
add_action('admin_init', 'my_admin_socials');


// Generate Custom Newsletter Metabox on Editor
function display_socials_meta_box($socials)
{
    $social_network = get_post_meta($socials->ID, 'social_network', true);
    $social_network_url = get_post_meta($socials->ID, 'social_network_url', true);
?>


    <style>
        .inputfield {
            width: 100%;
        }
    </style>


    <table width="100%">


        <!-- SINGLE TABLE 2 COLS -->
        <tr>
            <td colspan="5" width="100%">

                <table width="100%" style="padding-bottom: 100px;">


                    <!-- SINGLE TABLE 2 COLS -->
                    <tr>
                        <td colspan="5" width="100%">

                            <table width="100%">

                                <tr>


                                    <h3 style="margin-top:25px;">Social Network:</h3>

                                    <td width="80%">

                                        <?php $socials = ['please select...', 'facebook', 'twitter', 'linkedin', 'instagram', 'pinterest', 'youtube']; ?>

                                        <select class="inputfield" required="required" name="social_network">

                                            <?php foreach ($socials as $key => $social) {
                                                if ($social_network == $social) {
                                                    echo "<option value='$social' selected>" . ucfirst($social) . "</option>";
                                                } else {
                                                    echo "<option value='$social'>" . ucfirst($social) . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>

                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>
                    <!-- SINGLE TABLE 2 COLS -->



                    <!-- SINGLE TABLE 2 COLS -->
                    <tr>
                        <td colspan="5" width="100%">

                            <table width="100%">

                                <tr>


                                    <h3 style="margin-top:25px;">Social Network URL:</h3>

                                    <td width="80%">

                                        <input class="inputfield" type="text" name="social_network_url" placeholder="Enter answer here" value="<?php echo $social_network_url; ?>" />

                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>
                    <!-- SINGLE TABLE 2 COLS -->


                </table>
            <?php
        }


        function add_socials_fields($socials_id, $socials)
        {
            // Check post type for Students
            if ($socials->post_type == 'our-socials') {
                // Store data in post meta table if present in post data


                if (isset($_POST['social_network']) && $_POST['social_network'] != '') {
                    update_post_meta($socials_id, 'social_network', $_POST['social_network']);
                }



                if (isset($_POST['social_network_url']) && $_POST['social_network_url'] != '') {
                    update_post_meta($socials_id, 'social_network_url', $_POST['social_network_url']);
                }
            }
        }
        add_action('save_post', 'add_socials_fields', 10, 2);



        function update_edit_form_socials()
        {
            echo ' enctype="multipart/form-data"';
        }

        add_action('post_edit_form_tag', 'update_edit_form_socials'); ?>