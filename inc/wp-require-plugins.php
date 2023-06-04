<?php
/*!
 * WordPress Require plugins v1.0.0-beta.3 (https://martonlente.com/)
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

      // Sanitize required plugin name for ID js notice
      $required_plugin_slug = sanitize_title($required_plugin_name);

      // If plugin is active, show notice success
      ?>
      <div class="is-dismissible notice notice-success wp-require-plugins-js-notice" id="<?php echo 'wp-require-plugins-js-notice-' . $required_plugin_slug; ?>" style="display: none;">
        <p>
          <?php _e( 'Kötelező bővítmény aktív: '. $required_plugin_name, 'my-theme'); ?>
        </p>
      </div>
    <?php
    else:
      // Set required plugin name
      $required_plugin_name = $required_plugin['name'];

      // If plugin is inactive, show notice error
      ?>
      <div class="notice notice-error">
        <p>
          <?php _e( 'Kötelező bővítmény inaktív: ' . $required_plugin_name, 'my-theme'); ?>
        </p>
      </div>
    <?php
    endif;
  endforeach;
}

add_action('admin_notices', 'require_plugins');

// Add js to prevent a message from re-appearing once the page re-loads, or another page is loaded
wp_enqueue_script('my-theme-js-cookie', get_template_directory_uri() . '/node_modules/js-cookie/dist/js.cookie.min.js', array('jquery'), '1.0.0-beta');

wp_enqueue_script('my-theme-wp-require-plugins', get_template_directory_uri() . '/js/wp-require-plugins.js', array('jquery'), '1.0.0-beta');
