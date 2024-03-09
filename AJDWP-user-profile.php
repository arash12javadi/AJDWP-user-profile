<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Plugin Name:       AJDWP-user-profile
 * Plugin URI:        https://github.com/arash12javadi/
 * Description:       This plugin seamlessly installs the "User Profile" and "Password Reset" pages, complete with the embedded shortcodes [pl_AJDWP_register_form] & [pl_password_reset_form]. Simply add the pages to your theme menu effortlessly. All codes operate through AJAX. The password reset functionality is automated directly from the live WordPress site (not on a localhost website). Users receive a password reset notification with a link to reset their password, eliminating the need for the standard WordPress password reset. Enjoy the convenience!
 * Version:           240309
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Arash Javadi
 * Author URI:        https://arashjavadi.com/  
 */


//__________________________________________________________________________//
//                       ADD JAVASCRIPTS AND CSS
//__________________________________________________________________________//

wp_enqueue_script('AJDWP_user_profile_JS', plugins_url( '/user_profile/user_profile.js' , __FILE__ ) , array( 'jquery' ), '', true);
wp_enqueue_script( 'AJDWP_jquery-3.6.0', 'https://code.jquery.com/jquery-3.6.0.min.js' );
wp_enqueue_style( 'AJDWP_bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' );    
wp_enqueue_script( 'AJDWP_bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' );    
wp_enqueue_script( 'jquery');

//__________________________________________________________________________//
//                               CODES HERE                   
//__________________________________________________________________________//

include_once plugin_dir_path(__FILE__)."user_profile/pl_user_profile.php";
include_once plugin_dir_path(__FILE__)."user_profile/pl_user_profile_functions.php";

register_activation_hook(__FILE__, 'pl_create_custom_pages_once');
