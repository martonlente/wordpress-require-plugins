/*!
 * WordPress Require plugins v1.0.0-beta.2 (https://martonlente.com/)
 * Copyright 2023 Márton Lente
 * Licensed under Apache 2.0 (https://github.com/martonlente/wordpress-require-plugins/blob/main/LICENSE)
 */

(function() {
  // Put jQuery into no-conflict mode
  jQuery.noConflict();

  jQuery(document).ready(function($) {
    // Create variable $wpRequirePluginsNotice
    var $wpRequirePluginsNotice = $('.wp-require-plugins-js-notice');

    function dismissedCheck() {
      $wpRequirePluginsNotice.each(function() {
        var $this = $(this);
        var id = $this.attr('id');

        // Check if notice is dismissed
        if (Cookies.get(id + '-is-dismissed') == 'true') {
        } else {
          // If is not dismissed, show
          $this.css('display', '');
        }
      });
    }

    function dismissedSet() {
      // Create event $wpRequirePluginsNotice on click
      $wpRequirePluginsNotice.on('click', 'button', function() {
        // Get id from button parent notice
        var id = $(this).parent($wpRequirePluginsNotice)
          .attr('id');

        // Create cookie id -is-dismissed on click for 30 days
        Cookies.set(id + '-is-dismissed', 'true', {expires: 30});
      });
    }

    function init() {
      // Call functions dismissed
      dismissedCheck();
      dismissedSet();
    }

    // Call init when DOM is ready
    init();
  });
}());
