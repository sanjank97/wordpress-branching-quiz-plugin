<?php
/*
Plugin Name: Branching Question Quiz System
Plugin URI: https://myvirtualteams.com/
Description: This Plugin provide special type of Quiz system that means next Question will be generated according user selected answer.
Author:MVT
Version: 1.0
Author URI: https://myvirtualteams.com/
*/

define('PLUGIN_DIR_PATH',plugin_dir_path( __FILE__ ));
define('PLUGIN_URL',plugin_dir_url(__FILE__ ));
define('TABLE_NAME','wp_branching_quiz');


function register_admin_page_menu()
{
    add_menu_page(
        "branching_quiz", // menu name
        'Branching Quiz', // menu title
        'manage_options', // menu level
        'branching-quiz', // slug
        'add_new_function', // callback function
        'dashicons-welcome-learn-more', // wordpress built icon
        11 //position 
    );
    add_submenu_page(
        'branching-quiz', // parent slug
        'Add New',        // page title
        'Add New',        // menu title
        'manage_options', // capability
        'branching-quiz',        // current slug
        'add_new_function', // callback       
    );
    add_submenu_page(
        'branching-quiz', // parent slug
        'All Quizes',        // page title
        'All Quizes',        // menu title
        'manage_options', // capability
        'all-quizes',        // current slug
        'add_all_quizes_function', // callback       
    );

}
function add_new_function()
{
    //include menu page
    include_once(PLUGIN_DIR_PATH.'view/add-new.php');
}
function add_all_quizes_function()
{   //include menu page
    include_once(PLUGIN_DIR_PATH.'view/all-quizes.php');
}


// add admin menu ans submenu page
add_action( 'admin_menu', 'register_admin_page_menu' );


//activate plugin
register_activation_hook( __FILE__,'myplugin_activate');
//activate callback function
function myplugin_activate()
{
    global $wpdb;
    //include built page
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $sql="CREATE TABLE IF NOT EXISTS ".TABLE_NAME." (
        `id` int NOT NULL AUTO_INCREMENT,
        `question_set` json  NULL,
        `answer_set` json NULL,
        `terminate_set` json NULL,
        `prize_msg` json NULL,
        `html_content` longtext NULL,
        PRIMARY KEY (`id`)
       )";
    //call function from upgrade.php 
    dbDelta( $sql );

}
//Enqueue css and js file
function add_plugin_script()
{
    wp_enqueue_style(
    'quiz_fontawesome_style', //unique name
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', //path url
    );
    wp_enqueue_style(
        'quiz_style', //unique name
        PLUGIN_URL.'assets/css/style.css', //path url
        '', //dependencies
        time() //ver
    );

     wp_enqueue_script(
        'quiz_jquery_script', //unique name
        'https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js', // path url
        '',
        time() //ver

    );
    
    wp_enqueue_script(
        'quiz_script', //unique name
        PLUGIN_URL.'assets/js/script.js', // path url
        '',
        time(),
        

    );


    wp_enqueue_script(
        'ajax_script', //unique name
         PLUGIN_URL.'assets/js/ajax-script.js', // path url
         '',
         time(),
         true 
    );
    wp_localize_script('ajax_script','branching_quiz_ajaxurl', array('ajax_url' => admin_url( 'admin-ajax.php' )));
}
// init action for enqueue script in plugin
add_action('init','add_plugin_script');


//Handle Admin-ajax call for add and update Quiestions
add_action( 'wp_ajax_add_new_quiz', 'add_new_quiz' );

function add_new_quiz() {
    include_once(PLUGIN_DIR_PATH.'includes/quiz_handler.php');
}

//Handle Admin-ajax call for fetch all quest-set and delete quiz set
add_action( 'wp_ajax_all_fetch_quiz', 'all_fetch_quiz' );
function all_fetch_quiz()
{
    include_once(PLUGIN_DIR_PATH.'includes/quiz_ajax.php');
}


register_deactivation_hook(PLUGIN_DIR_PATH.'branching-question-quiz.php','myplugin_deactivate');
function myplugin_deactivate(){
    global $wpdb;
    $sql=" DROP TABLE IF EXISTS ".TABLE_NAME.";";
    $wpdb->query($sql);
    delete_option("my_plugin_db_version");
}

//Make shortcode of each post via post id using $atts
function add_shortcode_braching_quiz( $atts )
{
        // print_r($atts);
        global $wpdb;  
        $atts = shortcode_atts( array('id' => null),$atts,'braching_quiz');     

        $shortcode_value = $wpdb->get_results("SELECT * FROM ".TABLE_NAME." where id = '". $atts['id']."'");
        if(!empty( $shortcode_value ))
        {
            include_once(PLUGIN_DIR_PATH.'includes/quiz_test.php');
        }
        else
        {
        echo "empty";
        }

    }
    add_shortcode( 'braching_quiz', 'add_shortcode_braching_quiz' );

?>
