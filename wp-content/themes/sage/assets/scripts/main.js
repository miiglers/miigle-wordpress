// Mixpanel init
(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f)}})(document,window.mixpanel||[]);


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

        mixpanel.init("0115ab26ea2dfdb786fb487d17abb428");
        mixpanel.track('page viewed', {
          'page name' : document.title,
          'url' : window.location.pathname
        });

        $(window).load(function() {
          $('.grid').masonry({
            itemSelector: '.grid-item', // use a separate class for itemSelector, other than .col-
            columnWidth: '.grid-sizer',
            percentPosition: true
          });
          $(".dotdotdot").dotdotdot({
            wrap: 'letter',
            height: 44
          });
        });
        
        $('.btn-upvote').on('click', function(e) {
          e.preventDefault();
          var $star = $(this).find('i');
          var $form = $(this).parents('form');
          var upvotes = $form.find('span#upvotes').html() * 1;
          var $this = $(this);

          // just upvoted
            if($form.attr('action') === 'mgl/v1/product/upvote') {
              $this.addClass('upvoted');
              $form.find('span#upvotes').html(upvotes + 1);
            }
            // just downvoted
            else {
              $this.removeClass('upvoted');
              $form.find('span#upvotes').html(upvotes - 1);
            }
          
          apiAjax($form, $form.serialize())
          .then(function(success) {
            // just upvoted
            if($form.attr('action') === 'mgl/v1/product/upvote') {
              $form.attr('action', 'mgl/v1/product/downvote');
            }
            // just downvoted
            else {
              $form.attr('action', 'mgl/v1/product/upvote');
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
        $('#accessModal form').on('submit', function(e) {
          console.log('ayyy');
          e.preventDefault();
          $input = $('input#accessCode');

          if($input.val() === 'M+2016') {
            $input.parents('.form-group')
              .removeClass('has-error')
              .addClass('has-success')
              .find('.help-block')
              .addClass('hidden');
            window.location = '/products';
          }
          else {
            console.log('nope');
            $input.parents('.form-group')
              .addClass('has-error')
              .find('.help-block')
              .removeClass('hidden');
          }

          return false;
        });
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
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
            $productForm = $('form#product'),
            $modal = $('#post-success');

        $modal.on('hidden.bs.modal', function(e) {
          window.location = wpHomeUrl + '/profile-product';
        });
            
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
              $modal.modal('show');
            });
          }
          
          return false;
        });

        $productForm.find('#category .category-list input').on('change', function(e) {
          var $target = $(e.target),
              parentId = $target.attr('id'),
              hasSubCategory = false;

          $productForm.find('#category input:checked').each(function() {
            var id = $(this).attr('id');
            $subCategory = $productForm.find('#sub-category input.' + id);
            console.log($subCategory);
            if($subCategory.length !== 0) {
              hasSubCategory = true;
              return false;
            }
            else {
              hasSubCategory = false;
            }
          });

          if(hasSubCategory) {
            $productForm.find('#category a').attr('href', '#sub-category');
            $productForm.find('#details a.back').attr('href', '#sub-category');
          }
          else {
            $productForm.find('#category a').attr('href', '#details');
            $productForm.find('#details a.back').attr('href', '#category');
          }

          $productForm.find('#sub-category .sub-category').addClass('hidden');

          if($target.is(':checked')) {
            $productForm.find('#sub-category input.' + parentId).parents('.sub-category').removeClass('hidden');
          }
        });

        $productForm.find('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
          var targetId = $(e.target).attr('href'),
              percentDone = '25%';

          if(targetId === '#sub-category') {
            percentDone = '50%';
          }
          else if(targetId === '#details') {
            percentDone = '75%';
          }

          $('.progress-bar').css('width', percentDone);
          $('span#percent-complete').html(percentDone);

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
    'single_mgl_product': {
      init: function() {
        $('.prod-gallery .previews a').on('click', function(e) {
          e.preventDefault();
          var $this = $(this);
          var img = $this.data('img');

          $('.prod-gallery .previews a').removeClass('active');
          $this.addClass('active');

          $('.prod-gallery .full img').attr('src', img);
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
