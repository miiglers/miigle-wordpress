/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        
        $('.height-100, #profile-sidebar').each(function() {
          var height = $(this).parent().height();
          $(this).css('height', height);
        });
        
        $('.btn-upvote').on('click', function(e) {
          e.preventDefault();
          var $star = $(this).find('i');
          var $form = $(this).parents('form');
          var upvotes = $form.find('span#upvotes').html() * 1;
          
          apiAjax($form, $form.serialize())
          .then(function(success) {
            // just upvoted
            if($form.attr('action') === 'mgl/v1/product/upvote') {
              $star.removeClass('fa-star-o');
              $star.addClass('fa-star');
              $form.attr('action', 'mgl/v1/product/downvote');
              $form.find('span#upvotes').html(upvotes + 1);
            }
            // just downvoted
            else {
              $star.removeClass('fa-star');
              $star.addClass('fa-star-o');
              $form.attr('action', 'mgl/v1/product/upvote');
              $form.find('span#upvotes').html(upvotes - 1);
            }
          });
          
          return false;
        });
        
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    'login': {
      init: function() {
        $('input#user_login').attr('placeholder', 'Email or Username');
        $('input#user_pass').attr('placeholder', 'Password');
      }
    },
    'sign_up': {
      init: function() {
        var $form = $('form#signup-form'),
            data;
            
        $form.on('submit', function(e) {
          e.preventDefault();
          $form.validate();
          
          if($form.valid()) {
            data = {
              username: $form.find('input[name=email]').val(),
              email: $form.find('input[name=email]').val(),
              first_name: $form.find('input[name=firstName]').val(),
              last_name: $form.find('input[name=lastName]').val(),
              password: $form.find('input[name=password]').val()
            };
            
            apiAjax($form, data);
          }
          
          return false;
        });
      }
    },
    'product_post': {
      init: function() {
        var $requestForm = $('form#request-invite'),
            $productForm = $('form#product');
            
        $requestForm.on('submit', function(e) {
          e.preventDefault();
          $requestForm.validate();
          
          if($requestForm.valid()) {
            apiAjax($requestForm, $requestForm.serialize())
            .then(function(success) {
              window.location = wpHomeUrl + '/profile-product';
            });
          }
          
          return false;
        });
        
        $productForm.on('submit', function(e) {
          e.preventDefault();
          $productForm.validate();
          
          if($productForm.valid()) {
            apiAjax($productForm, $productForm.serialize())
            .then(function(success) {
              window.location = wpHomeUrl + '/profile-product';
            });
          }
          
          return false;
        });
        
      }
    },
    'profile_settings': {
      init: function() {
        var $form = $('form#profile-settings');
            
        $form.on('submit', function(e) {
          e.preventDefault();
          $form.validate();
          
          if($form.valid()) {
            apiAjax($form, $form.serialize())
            .then(function(success) {
              window.location = wpHomeUrl + '/profile-product';
            });
          }
          
          return false;
        });
      }
    },
    
  };
  
  var apiAjax = function($form, data) {
    return $.ajax({
      url:  wpApiSettings.root + $form.attr('action'),
      method: $form.attr('method'),
      data: data,
      beforeSend: function(xhr) {
        xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
        $form.find('[type=submit]')
          .attr('disabled', 'disabled')
          .find('.fa-spin')
          .removeClass('hidden');
      },
      complete: function() {
        $form.find('[type=submit]')
          .removeAttr('disabled')
          .find('.fa-spin')
          .addClass('hidden');
      }
    })
    .then(
      function(success) {
        console.log(success);
      },
      function(error) {
        console.log(error);
      }
    );
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
