<?php
/*!
 * WordPress Require plugins v0.1.0 (https://martonlente.com/)
 * Copyright 2023 Márton Lente
 * Licensed under Apache 2.0 (https://github.com/martonlente/wordpress-require-plugins/blob/main/LICENSE)
 */

 function require_plugins() {
  // Create variable array required_plugins
  $required_plugins = array(
    // Examples
    array(
      // Create key file_path for required plugin
      'file_path' => 'pods/init.php',
      // Create key name for required plugin when inactive
      'name' => 'Pods - Custom Content Types and Fields'
    ));

  foreach ($required_plugins as $required_plugin):
    // Init required plugin name
    $required_plugin_name = '';

    if (is_plugin_active($required_plugin['file_path'])):
      // Get required plugin name
      $required_plugin_data = get_plugin_data(ABSPATH . 'wp-content/plugins/' . $required_plugin['file_path']);
      $required_plugin_name = $required_plugin_data['Name'];

      // Init static $index for ID js notice index
      static $index = 0;

      // If plugin is active, show notice success
      ?>
      <div class="is-dismissible js-notice notice notice-success" id="<?php echo 'js-notice-' . $index; ?>">
        <p><?php _e( 'Kötelező bővítmény aktív: '. $required_plugin_name, 'wordpress-require-plugins'); ?></p>
      </div>
    <?php
    // Increment $index
    $index++;

    else:
      // Set required plugin name
      $required_plugin_name = $required_plugin['name'];

      // If plugin is inactive, show notice error
      ?>
      <div class="notice notice-error">
        <p><?php _e( 'Kötelező bővítmény inaktív: ' . $required_plugin_name, 'wordpress-require-plugins'); ?></p>
      </div>
    <?php
    endif;
  endforeach;
}

add_action('admin_notices', 'require_plugins');

// Add js to prevent a message from re-appearing once the page re-loads, or another page is loaded
wp_enqueue_script('wordpress-require-plugins-js-cookie', get_template_directory_uri() . '/node_modules/js-cookie/dist/js.cookie.min.js', array('jquery'), '0.1.0');

wp_enqueue_script('wordpress-require-plugins-wordpress-require-plugins', get_template_directory_uri() . '/js/wordpress-require-plugins.js', array('jquery'), '0.1.0');
