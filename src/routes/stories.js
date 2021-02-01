import $ from "jquery";
export default {
  init() {
    $("#load-more a").on("click", function () {
      var offset = Number($("section").attr("data-offset"));
      $.ajax({
        url: wp.ajax.settings.url,
        type: "POST",
        data: {
          action: "get_data",
          offset: offset,
        },
        success: function (res) {
          offset += 12;
          $("section").attr("data-offset", offset);
          $("section").append(res);
          $(".new-feather").on("click", function (e) {
            $.featherlight($(this));
          });
          $(".new-feather").each(function () {
            $(this).fadeIn(200, function () {
              $(this).removeClass("new-feather");
            });
          });
        },
      });
    });
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
