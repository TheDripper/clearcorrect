import Masonry from "masonry-layout";
import visible from "../util/visible";
import $ from "jquery";

export default {
  init() {
    // JavaScript to be fired on all pages
    console.log("common");
    var grid = document.querySelector(".arrows");
    setTimeout(function () {
      $(".spread").find(".middle").addClass("bounce-in-1");
      $(".spread").find(".l1").addClass("bounce-in-2");
      $(".spread").find(".r1").addClass("bounce-in-2");
      $(".spread").find(".l2").addClass("bounce-in-3");
      $(".spread").find(".r2").addClass("bounce-in-3");
    }, 1000);
    $(document).on("scroll", function () {
      setTimeout(function () {
        $(".lazy-fade-1").each(function () {
          $(this).removeClass("lazy-fade-1");
          $(this).addClass("fade-in-1");
        });
        $(".lazy-fade-2").each(function () {
          $(this).removeClass("lazy-fade-2");
          $(this).addClass("fade-in-2");
        });
        $(".lazy-fade-3").each(function () {
          $(this).removeClass("lazy-fade-3");
          $(this).addClass("fade-in-3");
        });
        $(".lazy-fade-bounce-1").each(function () {
          $(this).removeClass("lazy-fade-bounce-1");
          $(this).addClass("fade-bounce-1");
        });
        $(".lazy-fade-bounce-2").each(function () {
          $(this).removeClass("lazy-fade-bounce-2");
          $(this).addClass("fade-bounce-2");
        });
        $(".lazy-fade-bounce-3").each(function () {
          $(this).removeClass("lazy-fade-bounce-3");
          $(this).addClass("fade-bounce-3");
        });
      },500);
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
