/*!
 * WordPress Require plugins v1.0.0-beta.1 (https://martonlente.com/)
 * Copyright 2023 Márton Lente
 * Licensed under Apache 2.0 (https://github.com/martonlente/wordpress-require-plugins/blob/main/LICENSE)
 */

(function() {
  // Put jQuery into no-conflict mode
  jQuery.noConflict();

  jQuery(document).ready(function($) {
    // Create variable $notice
    var $notice = $('.js-notice');

    function dismissedCheck() {
      $notice.each(function() {
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
      // Create event $notice on click
      $notice.on('click', 'button', function() {
        // Get id from button parent notice
        var id = $(this).parent($notice)
          .attr('id');

        // Create cookie id -is-dismissed on click for 7 days
        Cookies.set(id + '-is-dismissed', 'true', {expires: 7});
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