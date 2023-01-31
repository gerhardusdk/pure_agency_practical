<?php
/**
 * Plugin Name: Apollo Shutters FAQ
 * Plugin URI: http://www.pureagency.co.uk
 * Description: Featured FAQs Plugin
 * Version: 2023
 * Author: Gerhard de Klerk
 * Author URI: mailto:gerhard.de.klerk1987@gmail.com
 **/

add_filter('wp_insert_post_data', 'my_add_ul_class_on_insert_faqs');
function my_add_ul_class_on_insert_faqs($postarr)
{
    $postarr['post_content'] = str_replace('<ul>', '<ul class="ul">', $postarr['post_content']);
    return $postarr;
}

function register_faqs_posttype()
{

    $labels = array(
        'name' => _x('FAQs', 'faqs'),
        'singular_name' => _x('FAQ', 'faq'),
        'add_new' => _x('Add New FAQ', 'faqs'),
        'add_new_item' => _x('Add New FAQs', 'faqs'),
        'edit_item' => _x('Edit FAQs', 'faqs'),
        'new_item' => _x('New FAQs', 'faqs'),
        'view_item' => _x('View FAQs', 'faqs'),
        'search_items' => _x('Search FAQs', 'faqs'),
        'not_found' => _x('No Latest FAQs found', 'faqs'),
        'not_found_in_trash' => _x('No FAQs found in Trash', 'faqs'),
        'parent_item_colon' => _x('FAQs:', 'faqs'),
        'menu_name' => _x('Apollo Shutters FAQs', 'faqs'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Our Frequently Asked Questions',
        'supports' => array('title', 'thumbnail', 'revisions', 'media'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-editor-help',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type('our-faqs', $args);
    //flush_rewrite_rules();
}

// Initialize the FAQS Post Type
add_action('init', 'register_faqs_posttype');


function my_admin_faqs()
{
    add_meta_box(
        'faqs_meta_box',
        'FAQ Information',
        'display_faqs_meta_box',
        'our-faqs',
        'normal',
        'high'
    );
}
add_action('admin_init', 'my_admin_faqs');


// Generate Custom Newsletter Metabox on Editor
function display_faqs_meta_box($faqs)
{
    $faqs_heading = get_post_meta($faqs->ID, 'faqs_name', true);
    $faqs_content = get_post_meta($faqs->ID, 'faqs_content', true);
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

                <table width="100%">


                    <!-- SINGLE TABLE 2 COLS -->
                    <tr>
                        <td colspan="5" width="100%">

                            <table width="100%">

                                <tr>
                                    

                                    <h3 style="margin-top:25px;">FAQ Question:</h3>

                                    <td width="80%">

                                        <input class="inputfield" type="text" name="faqs_name" placeholder="Enter answer here" value="<?php echo $faqs_heading; ?>" />

                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>
                    <!-- SINGLE TABLE 2 COLS -->


                    <!-- SINGLE TABLE 1 COLS -->
                    <tr>
                        <td colspan="5" width="100%">

                            <table width="100%">


                                <h3 style="margin-top:25px;">FAQ Answer:</h3>

                                <!-- SPACER 5 PIXELS -->
                                <tr>
                                    <td height="5" colspan="5" width="100%">

                                    </td>
                                </tr>
                                <!-- SPACER 5 PIXELS -->


                                <tr>
                                    <td width="100%">

                                        <?php

                                        $field_value = get_post_meta($faqs->ID, 'faqs_content', false);
                                        wp_editor($faqs_content, 'faqs_content', array('textarea_rows' => '15'));

                                        ?>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <!-- SINGLE TABLE 1 COLS -->

                </table>
            <?php
        }


        function add_faqs_fields($faqs_id, $faqs)
        {
            // Check post type for Students
            if ($faqs->post_type == 'our-faqs') {
                // Store data in post meta table if present in post data


                if (isset($_POST['faqs_name']) && $_POST['faqs_name'] != '') {
                    update_post_meta($faqs_id, 'faqs_name', $_POST['faqs_name']);
                }



                if (isset($_POST['faqs_content']) && $_POST['faqs_content'] != '') {
                    update_post_meta($faqs_id, 'faqs_content', $_POST['faqs_content']);
                }
            }
        }
        add_action('save_post', 'add_faqs_fields', 10, 2);



        function update_edit_form_faqs()
        {
            echo ' enctype="multipart/form-data"';
        }

        add_action('post_edit_form_tag', 'update_edit_form_faqs'); ?>