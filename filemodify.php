<?php
/*
* Plugin Name: .htaccess Last Modified
* Plugin URI: https://osdeibi.dev/
* Description: Displays the last modified date of the .htaccess file on the options page.
* Version: 1.0
* Author: Osdeibi Acurero
* Author URI: https://osdeibi.dev/
*/

function htaccess_last_modified_admin_menu() {
    add_options_page(
        '.htaccess Last Modified',
        '.htaccess Last Modified',
        'manage_options',
        'htaccess-last-modified',
        'htaccess_last_modified_options_page'
    );
}
add_action( 'admin_menu', 'htaccess_last_modified_admin_menu' );

function htaccess_last_modified_options_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $htaccess_file = ABSPATH . '.htaccess';

    if ( ! file_exists( $htaccess_file ) ) {
        echo '<div class="error"><p>The .htaccess file does not exist.</p></div>';
        return;
    }

    $last_modified = date( 'F d, Y H:i:s', filemtime( $htaccess_file ) );

    echo '<div class="wrap">';
    echo '<h1>'. esc_html( get_admin_page_title() ) .'</h1>';
    echo '<p>The .htaccess file was last modified on ' . esc_html( $last_modified ) . '.</p>';
    echo '</div>';
}
