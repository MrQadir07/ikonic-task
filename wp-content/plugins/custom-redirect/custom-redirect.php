<?php
/**
 * Plugin Name: Custom Redirect Based on IP
 */

function redirect_ip_users() {
    $user_ip = $_SERVER['REMOTE_ADDR']; 
    
    if (strpos($user_ip, '77.29') === 0) {
        wp_redirect('https://www.google.com');
        exit;
    }
}
add_action('init', 'redirect_ip_users');
