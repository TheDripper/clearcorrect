<?php


// Clean up wordpres <head>
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    $manifest = json_decode(file_get_contents('build/assets.json', true));
    $main = $manifest->main;
    wp_enqueue_style('fonts', get_template_directory_uri() . "/build/fonts.css",  false, null);
    wp_enqueue_style('theme-css', get_template_directory_uri() . "/build/" . $main->css,  ['fonts'], null);
    wp_enqueue_script('theme-js', get_template_directory_uri() . "/build/" . $main->js, ['jquery'], null, true);
}, 100);

// add_action('admin_enqueue_scripts', function () {
//     $manifest = json_decode(file_get_contents('build/assets.json', true));
//     $main = $manifest->main;
//     wp_enqueue_style('fonts', get_template_directory_uri() . "/build/fonts.css",  false, null);
//     wp_enqueue_style('theme-css', get_template_directory_uri() . "/build/" . $main->css,  ['fonts'], null);
// });
/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');
    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');
    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'mini')
    ]);
    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    // add_theme_support('customize-selective-refresh-widgets');


}, 20);


add_action('rest_api_init', function () {
    $namespace = 'presspack/v1';
    register_rest_route($namespace, '/path/(?P<url>.*?)', array(
        'methods'  => 'GET',
        'callback' => 'get_post_for_url',
    ));
});

/**
 * This fixes the wordpress rest-api so we can just lookup pages by their full
 * path (not just their name). This allows us to use React Router.
 *
 * @return WP_Error|WP_REST_Response
 */
function get_post_for_url($data)
{
    $postId    = url_to_postid($data['url']);
    $postType  = get_post_type($postId);
    $controller = new WP_REST_Posts_Controller($postType);
    $request    = new WP_REST_Request('GET', "/wp/v2/{$postType}s/{$postId}");
    $request->set_url_params(array('id' => $postId));
    return $controller->get_item($request);
}

add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
    return $classes;
}
function wporg_custom_post_type() {
    register_post_type('case',
        array(
            'labels'      => array(
                'name'          => __('cases', 'textdomain'),
                'singular_name' => __('case', 'textdomain'),
            ),
                'public'      => true,
                'has_archive' => true,
                'show_in_rest' => true,
                'rewrite'=>array('slug'=>'cases'),
                'exclude_from_search'=>FALSE,
                'supports'=>array('thumbnail','title','editor','author')
        )
    );
    register_post_type('doctor',
        array(
            'labels'      => array(
                'name'          => __('doctors', 'textdomain'),
                'singular_name' => __('doctor', 'textdomain'),
            ),
                'public'      => true,
                'has_archive' => true,
                'show_in_rest' => true,
                'rewrite'=>array('slug'=>'doctors'),
                'exclude_from_search'=>FALSE,
                'supports'=>array('thumbnail','title','editor','author')
        )
    );
    register_post_type('banner-ad',
        array(
            'labels'      => array(
                'name'          => __('banner-ads', 'textdomain'),
                'singular_name' => __('banner-ad', 'textdomain'),
            ),
                'public'      => true,
                'has_archive' => true,
                'show_in_rest' => true,
                'rewrite'=>array('slug'=>'banner-ads'),
                'exclude_from_search'=>FALSE,
                'supports'=>array('thumbnail','title','editor','author')
        )
    );
}
add_action('init', 'wporg_custom_post_type');

function register_taxonomies() {

	$labels = array(
		'name'                       => 'classification',
		'singular_name'              => 'classification',
		'menu_name'                  => 'classification',
		'all_items'                  => 'All Items',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Item Name',
		'add_new_item'               => 'Add New Item',
		'edit_item'                  => 'Edit Item',
		'update_item'                => 'Update Item',
		'view_item'                  => 'View Item',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Items list',
		'items_list_navigation'      => 'Items list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'has_archive'                => true,
        'rewrite'                    => array('slug'=>'classifications')
	);
	register_taxonomy( 'classification', array( 'case' ), $args );
	$labels = array(
		'name'                       => 'technical_condition',
		'singular_name'              => 'technical_condition',
		'menu_name'                  => 'technical_condition',
		'all_items'                  => 'All Items',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Item Name',
		'add_new_item'               => 'Add New Item',
		'edit_item'                  => 'Edit Item',
		'update_item'                => 'Update Item',
		'view_item'                  => 'View Item',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Items list',
		'items_list_navigation'      => 'Items list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'has_archive'                => true,
        'rewrite'                    => array('slug'=>'technical_conditions')
	);
	register_taxonomy( 'technical_condition', array( 'case' ), $args );
	$labels = array(
		'name'                       => 'treatment_technique',
		'singular_name'              => 'treatment_technique',
		'menu_name'                  => 'treatment_technique',
		'all_items'                  => 'All Items',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Item Name',
		'add_new_item'               => 'Add New Item',
		'edit_item'                  => 'Edit Item',
		'update_item'                => 'Update Item',
		'view_item'                  => 'View Item',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Items list',
		'items_list_navigation'      => 'Items list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'has_archive'                => true,
        'rewrite'                    => array('slug'=>'treatment_techniques')
	);
	register_taxonomy( 'treatment_technique', array( 'case' ), $args );
	$labels = array(
		'name'                       => 'aligner_wear_schedule',
		'singular_name'              => 'aligner_wear_schedule',
		'menu_name'                  => 'aligner_wear_schedule',
		'all_items'                  => 'All Items',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Item Name',
		'add_new_item'               => 'Add New Item',
		'edit_item'                  => 'Edit Item',
		'update_item'                => 'Update Item',
		'view_item'                  => 'View Item',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Items list',
		'items_list_navigation'      => 'Items list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'has_archive'                => true,
        'rewrite'                    => array('slug'=>'aligner_wear_schedules')
	);
	register_taxonomy( 'aligner_wear_schedule', array( 'case' ), $args );
	$labels = array(
		'name'                       => 'level_of_difficulty',
		'singular_name'              => 'level_of_difficulty',
		'menu_name'                  => 'level_of_difficulty',
		'all_items'                  => 'All Items',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Item Name',
		'add_new_item'               => 'Add New Item',
		'edit_item'                  => 'Edit Item',
		'update_item'                => 'Update Item',
		'view_item'                  => 'View Item',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Items list',
		'items_list_navigation'      => 'Items list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'has_archive'                => true,
        'rewrite'                    => array('slug'=>'level_of_difficultys')
	);
	register_taxonomy( 'level_of_difficulty', array( 'case' ), $args );
	$labels = array(
		'name'                       => 'gender',
		'singular_name'              => 'gender',
		'menu_name'                  => 'gender',
		'all_items'                  => 'All Items',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Item Name',
		'add_new_item'               => 'Add New Item',
		'edit_item'                  => 'Edit Item',
		'update_item'                => 'Update Item',
		'view_item'                  => 'View Item',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Items list',
		'items_list_navigation'      => 'Items list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'has_archive'                => true,
        'rewrite'                    => array('slug'=>'genders')
	);
	register_taxonomy( 'gender', array( 'case' ), $args );
	$labels = array(
		'name'                       => 'country',
		'singular_name'              => 'country',
		'menu_name'                  => 'country',
		'all_items'                  => 'All Items',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Item Name',
		'add_new_item'               => 'Add New Item',
		'edit_item'                  => 'Edit Item',
		'update_item'                => 'Update Item',
		'view_item'                  => 'View Item',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Items list',
		'items_list_navigation'      => 'Items list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'has_archive'                => true,
        'rewrite'                    => array('slug'=>'countrys')
	);
	register_taxonomy( 'country', array( 'case' ), $args );

}
add_action( 'init', 'register_taxonomies', 0 );

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
// add_filter('upload_mimes', 'cc_mime_types');
// function my_acf_init() {
	
// 	acf_update_setting('google_api_key', 'AIzaSyCttO3DiKRKOeTdh0MNVbFjC2xs46ECs_8');
// }

// add_action('acf/init', 'my_acf_init');
function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyCttO3DiKRKOeTdh0MNVbFjC2xs46ECs_8';
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');