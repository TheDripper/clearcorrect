import Masonry from "masonry-layout";
import visible from "../util/visible";
import $ from "jquery";

export default {
  init() {
    // JavaScript to be fired on all pages
    console.log("common");
    var grid = document.querySelector(".arrows");
    if (visible($(".spread"))) {
      setTimeout(function () {
        $(".spread").find(".middle").addClass("bounce-in-1");
        $(".spread").find(".l1").addClass("bounce-in-2");
        $(".spread").find(".r1").addClass("bounce-in-2");
        $(".spread").find(".l2").addClass("bounce-in-3");
        $(".spread").find(".r2").addClass("bounce-in-3");
      }, 1000);
    }

    $(".lazy-fade-1").each(function () {
      if (visible($(this))) {
        $(this).removeClass("lazy-fade-1");
        $(this).addClass("fade-in-1");
      }
    });
    $(".lazy-fade-2").each(function () {
      if (visible($(this))) {
        var el = $(this);
        setTimeout(function () {
          el.removeClass("lazy-fade-2");
          el.addClass("fade-in-1");
        }, 300);
      }
    });
    $(".lazy-fade-3").each(function () {
      if (visible($(this))) {
        var el = $(this);
        setTimeout(function () {
          el.removeClass("lazy-fade-3");
          el.addClass("fade-in-1");
        }, 700);
      }
    });
    $(".lazy-fade-bounce-1").each(function () {
      if (visible($(this))) {
        var el = $(this);
        el.removeClass("lazy-fade-bounce-1");
        el.addClass("fade-bounce-1");
      }
    });
    $(".lazy-fade-bounce-2").each(function () {
      if (visible($(this))) {
        var el = $(this);
        setTimeout(function () {
          el.removeClass("lazy-fade-bounce-2");
          el.addClass("fade-bounce-1");
        }, 500);
      }
    });
    $(".lazy-fade-bounce-3").each(function () {
      if (visible($(this))) {
        var el = $(this);
        setTimeout(function () {
          el.removeClass("lazy-fade-bounce-3");
          el.addClass("fade-bounce-1");
        }, 700);
      }
    });
    $(document).on("scroll", function () {
      if (visible($(".spread"))) {
        setTimeout(function () {
          $(".spread").find(".middle").addClass("bounce-in-1");
          $(".spread").find(".l1").addClass("bounce-in-2");
          $(".spread").find(".r1").addClass("bounce-in-2");
          $(".spread").find(".l2").addClass("bounce-in-3");
          $(".spread").find(".r2").addClass("bounce-in-3");
        }, 1000);
      }
      $(".lazy-fade-1").each(function () {
        if (visible($(this))) {
          $(this).removeClass("lazy-fade-1");
          $(this).addClass("fade-in-1");
        }
      });
      $(".lazy-fade-2").each(function () {
        if (visible($(this))) {
          var el = $(this);
          setTimeout(function () {
            el.removeClass("lazy-fade-2");
            el.addClass("fade-in-1");
          }, 300);
        }
      });
      $(".lazy-fade-3").each(function () {
        if (visible($(this))) {
          var el = $(this);
          setTimeout(function () {
            el.removeClass("lazy-fade-3");
            el.addClass("fade-in-1");
          }, 700);
        }
      });
      $(".lazy-fade-bounce-1").each(function () {
        if (visible($(this))) {
          var el = $(this);
          el.removeClass("lazy-fade-bounce-1");
          el.addClass("fade-bounce-1");
        }
      });
      $(".lazy-fade-bounce-2").each(function () {
        if (visible($(this))) {
          var el = $(this);
          setTimeout(function () {
            el.removeClass("lazy-fade-bounce-2");
            el.addClass("fade-bounce-1");
          }, 500);
        }
      });
      $(".lazy-fade-bounce-3").each(function () {
        if (visible($(this))) {
          var el = $(this);
          setTimeout(function () {
            el.removeClass("lazy-fade-bounce-3");
            el.addClass("fade-bounce-1");
          }, 700);
        }
      });
    });
    // console.log(grid.length);
    // if (grid) {
    //   console.log("test");
    //   var msnry = new Masonry(grid, {
    //     // options...
    //     itemSelector: ".wp-block-image",
    //     columnWidth: 280,
    //   });
    // }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
