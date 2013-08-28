/**
 * Manage ajax submition if <form data-remote="true">
 * Require Spin.js
 * Available attributes:
 *   - data-reset: if true: empty fields
 *   - data-target: if set (ie: '#content'): add html to id defined
 *   - data-notifier: if set (ie: '#notifications'): add notification success or error
 */
jQuery(function ($) {

  var spinnerOpts = {
    lines: 13, // The number of lines to draw
    length: 3, // The length of each line
    width: 2, // The line thickness
    radius: 4, // The radius of the inner circle
    corners: 1, // Corner roundness (0..1)
    rotate: 0, // The rotation offset
    direction: 1, // 1: clockwise, -1: counterclockwise
    color: '#fff', // #rgb or #rrggbb
    speed: 1, // Rounds per second
    trail: 60, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    hwaccel: false, // Whether to use hardware acceleration
    className: 'spinner', // The CSS class to assign to the spinner
    zIndex: 2e9, // The z-index (defaults to 2000000000)
    top: '0', // Top position relative to parent in px
    left: '0' // Left position relative to parent in px
  };

  //Add spinner:
  var spinner = new Spinner(spinnerOpts).spin();
  $('.spinner').html(spinner.el);


  $.fn.extend({
    callRemote: function() {
      var datas,
          el = $(this),
          reset_after_success = el.data('reset') || false,
          $target = $(el.data('target')) || false,
          $notifier = $(el.data('notifier'));

      // Show spinner:
      el.find('.spinner').css('display', 'inline-block');

      if(el.is('form')) {
        datas = el.serialize();
      } else {
        datas = el.data('datas');
      }

      if (!$notifier.length) {
        $notifier = el.find('.notifications');
      }

      $notifier.hide();

      $.ajax({
        type: 'post',
        url: ajax_var.url,
        data: datas+'&nonce='+ajax_var.nonce,
        success: function (datas) {
          el.find('.spinner').css('display', 'none');
          if (datas.status === true) {
            if (reset_after_success) {
              el.find('input[type=text], input[type=password], input[type=email], input[type=phone], textarea').val('');
            }
            if ($target && datas.content) {
              $target.html(datas.content);
            }
            $notifier.html('<p class="alert alert-success">'+datas.message+'</p>').fadeIn();
          } else {
            $notifier.html('<p class="alert alert-error">'+datas.error+'</p>').fadeIn();
          }
          if (datas.nonce) {
            ajax_var.nonce = datas.nonce;
          }
        }
      });
    }
  });

  $('body').on('submit', 'form[data-remote=true]', function (e) {
    $(this).callRemote();
    e.preventDefault();
  });

  $('body').on('click', 'a[data-remote=true]', function (e) {
    $(this).callRemote();
    e.preventDefault();
  });
});