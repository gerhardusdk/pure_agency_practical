jQuery(document).ready(function ($) {
  var posts_per_page = 3;

  function apollo_load_more_posts(apollo_this, pageNumber) {
    var page_count = 0;
    var str =
      "&pageNumber=" +
      pageNumber +
      "&posts_per_page=" +
      posts_per_page +
      "&action=apollo_load_more_post_ajax";

    if (!apollo_this.hasClass("apollo-disabled")) {
      jQuery.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function (response) {
          if (response) {
            apollo_this.removeClass("apollo-active");
            var json_html = JSON.parse(response);
            if (json_html.html.length) {
              page_count = parseInt(pageNumber) + parseInt(1);
              apollo_this.attr("data-page", page_count);
              apollo_this
                .parents(".faq-section")
                .find(".faq-content")
                .append(json_html.html);
            } else {
              apollo_this.attr("disabled", true);
              apollo_this.addClass("apollo-disabled");
            }
          }
        },
      });
    }
    return false;
  }

  /* ACCORDION FUNCTIONALITY */
  jQuery(document).on("click", ".faq-accordion", function () {
        var thisAccordion = jQuery(this);
        if (thisAccordion.hasClass('show'))
        {
            $(".faq-accordion").removeClass('show');
            thisAccordion.removeClass('show');
        }
        else
        {
            $(".faq-accordion").removeClass('show');
            thisAccordion.addClass('show');
        }
  });

  /* LOAD MORE BUTTON FUNCTIONALITY */
  jQuery(document).on("click", ".load-more-button", function () {
    var apollo_this = jQuery(this);
    var paged = apollo_this.attr("data-page");
    apollo_this.addClass("apollo-active");
    apollo_load_more_posts(apollo_this, paged);
  });
});
