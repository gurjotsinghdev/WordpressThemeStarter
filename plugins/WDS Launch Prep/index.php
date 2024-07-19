<?php
/*
Plugin Name: WDS Launch Prep
Plugin URI: http://yourwebsite.com/wp-godspeed
Description: Completes many tasks like hide menu items, extra widgets to keep wordpress website stable and easy to use. 
Version: 1.0.0
Author: Gurjot Singh
Author URI: http://yourwebsite.com
License: GPL2
*/

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die('Direct access not allowed.');
}

// Hide items from the dashboard 
add_action('admin_menu', 'hide_plugins_submenu', 99);

// Hide widgets from the dashboard
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// add custom welcome widget
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');

// Stop plugin auto updates
add_filter( 'auto_update_plugin', '__return_false' );



function hide_plugins_submenu() {
    if (true) {
        remove_menu_page( 'themes.php' );                 
        remove_menu_page( 'plugins.php' ); 
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'users.php' );  
        remove_menu_page( 'tools.php' );
    }
}

function remove_dashboard_widgets() {
        
    // Remove the 'Activity' widget
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    
    // Remove the 'Quick Draft' widget
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    
    // Remove the 'WordPress News' widget
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    
    // Remove the 'Welcome' panel
    // remove_action('welcome_panel', 'wp_welcome_panel');

    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}

// Function to add custom dashboard widget
function add_custom_dashboard_widget() {
    wp_add_dashboard_widget(
        'custom_dashboard_widget', // Widget slug
        'How to Use This WordPress Website', // Title
        'custom_dashboard_widget_content' // Display function
    );
}

// Function to display content in the custom dashboard widget
function custom_dashboard_widget_content() {
    ?>
    <h3>Welcome to Your WordPress Site!</h3>
    <p>This dashboard panel will guide you on how to use the website effectively. Here are some tips:</p>
    <ul>
        <li><strong>Creating Posts:</strong> Navigate to <a href="<?php echo admin_url('post-new.php'); ?>">Posts > Add New</a> to create a new blog post.</li>
        <li><strong>Handling Media:</strong> Use the <a href="<?php echo admin_url('upload.php'); ?>">Media Library</a> to upload and manage your media files like images and videos.</li>

        <li><strong>Managing Pages:</strong> Go to <a href="<?php echo admin_url('edit.php?post_type=page'); ?>">Pages</a> to view and edit your pages, or <a href="<?php echo admin_url('post-new.php?post_type=page'); ?>">Add New</a> to create a new page.</li>
        <li><strong>Updating Settings:</strong> Access the <a href="<?php echo admin_url('options-general.php'); ?>">Settings</a> page to update site settings, such as site title, tagline, and more.</li>
    </ul>
    <p>If you need further assistance, feel free to reach out to our support team at <a href="mailto:support@yourwebsite.com">support@yourwebsite.com</a>.</p>
    <?php
}

